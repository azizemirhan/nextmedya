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
        print(child.before)
    except Exception as e:
        print(f"Error: {e}")

def main():
    # 1. Generate self-signed cert inside container
    print("=== Generating self-signed SSL certificate ===")
    cert_cmd = '''docker exec nextmedya_mail bash -c "
        mkdir -p /tmp/docker-mailserver/ssl
        openssl req -new -x509 -days 365 -nodes \\
            -out /tmp/docker-mailserver/ssl/mail.nextmedya.com-cert.pem \\
            -keyout /tmp/docker-mailserver/ssl/mail.nextmedya.com-key.pem \\
            -subj '/C=TR/ST=Ankara/L=Ankara/O=Next Medya/CN=mail.nextmedya.com'
    "'''
    run_cmd(cert_cmd, "Generate SSL Cert")
    
    # 2. Update environment to use letsencrypt path (which works with manual certs too)
    # Actually, docker-mailserver with DMS_SSL=self-signed should auto-generate... Let's try DMS_SSL=manual
    # But easier: just restart with proper config
    
    # 3. Restart container
    print("\n=== Restarting mail container ===")
    run_cmd("docker restart nextmedya_mail", "Restart Mail Container")
    
    time.sleep(15)
    
    # 4. Check if port 993 is now listening
    print("\n=== Check port 993 after restart ===")
    run_cmd("docker exec nextmedya_mail ss -tlnp | grep -E ':993|:143'", "Check Ports")
    
    # 5. Check SSL config
    print("\n=== Check SSL config ===")
    run_cmd("docker exec nextmedya_mail doveconf -n | grep -i ssl", "Check SSL Config")

if __name__ == "__main__":
    main()
