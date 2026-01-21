import pexpect

HOST = "167.235.141.242"
SSH_USER = "root"
SSH_PASS = "Kx7#mP9$Lz4!"

def run_cmd(cmd, desc):
    print(f"=== {desc} ===")
    try:
        child = pexpect.spawn(f"ssh {SSH_USER}@{HOST} \"{cmd}\"", encoding='utf-8', timeout=30)
        index = child.expect(['password:', pexpect.EOF])
        if index == 0:
            child.sendline(SSH_PASS)
        child.expect(pexpect.EOF)
        print(child.before)
    except Exception as e:
        print(f"Error: {e}")

def main():
    # Check cert details for port 143
    print("Checking Port 143 (IMAP)...")
    run_cmd("echo | openssl s_client -connect localhost:143 -starttls imap 2>/dev/null | openssl x509 -noout -text | grep -E 'Subject:|DNS:'", "Port 143 Cert")

    # Check cert details for port 587
    print("\nChecking Port 587 (SMTP)...")
    run_cmd("echo | openssl s_client -connect localhost:587 -starttls smtp 2>/dev/null | openssl x509 -noout -text | grep -E 'Subject:|DNS:'", "Port 587 Cert")

if __name__ == "__main__":
    main()
