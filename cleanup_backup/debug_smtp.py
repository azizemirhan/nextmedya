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
    # Check mail logs for SMTP/submission errors
    print("Checking logs for SMTP errors...")
    run_cmd("docker logs nextmedya_mail --tail 50 2>&1 | grep -E 'postfix/submission|sasl|error|warning|reject'", "SMTP Logs")

if __name__ == "__main__":
    main()
