import pexpect

HOST = "167.235.141.242"
SSH_USER = "root"
SSH_PASS = "Kx7#mP9$Lz4!"

def run_cmd(cmd):
    try:
        child = pexpect.spawn(f"ssh {SSH_USER}@{HOST} \"{cmd}\"", encoding='utf-8', timeout=30)
        index = child.expect(['password:', pexpect.EOF])
        if index == 0:
            child.sendline(SSH_PASS)
        child.expect(pexpect.EOF)
        print(child.before)
    except Exception as e:
        print(e)

def main():
    print("=== UFW Status ===")
    run_cmd("ufw status")
    
    print("\n=== Opening ports ===")
    run_cmd("ufw allow 993/tcp comment 'IMAP SSL'")
    run_cmd("ufw allow 587/tcp comment 'SMTP Submission'")
    run_cmd("ufw allow 25/tcp comment 'SMTP'")
    
    print("\n=== UFW Status After ===")
    run_cmd("ufw status")

if __name__ == "__main__":
    main()
