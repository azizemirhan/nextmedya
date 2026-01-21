import pexpect
import time

HOST = "167.235.141.242"
SSH_USER = "root"
SSH_PASS = "Kx7#mP9$Lz4!"

def run_cmd(cmd, desc):
    print(f"Running: {desc}...")
    try:
        child = pexpect.spawn(f"ssh {SSH_USER}@{HOST} \"{cmd}\"", encoding='utf-8', timeout=60)
        index = child.expect(['password:', pexpect.EOF])
        if index == 0:
            child.sendline(SSH_PASS)
        child.expect(pexpect.EOF)
        print(f"Done: {desc}")
        return True
    except Exception as e:
        print(f"Error: {e}")
        return False

def main():
    # 1. Create cert directory
    run_cmd("mkdir -p /var/www/nextmedya/docker/mail/config/ssl", "Create SSL Dir")
    
    # 2. Generate Cert using openssl locally on server (outside container for easier management)
    print("Generating cert...")
    # Using a single line command to avoid escaping issues
    gen_cmd = (
        "openssl req -new -newkey rsa:4096 -days 365 -nodes -x509 "
        "-subj '/C=TR/ST=Ankara/L=Ankara/O=NextMedya/CN=mail.nextmedya.com' "
        "-keyout /var/www/nextmedya/docker/mail/config/ssl/key.pem "
        "-out /var/www/nextmedya/docker/mail/config/ssl/cert.pem"
    )
    run_cmd(gen_cmd, "OpenSSL Generate")
    
    # 3. Fix Permissions
    # docker-mailserver needs read access
    run_cmd("chmod 600 /var/www/nextmedya/docker/mail/config/ssl/key.pem", "Chmod Key")
    run_cmd("chmod 644 /var/www/nextmedya/docker/mail/config/ssl/cert.pem", "Chmod Cert")

if __name__ == "__main__":
    main()
