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
    # 1. Check Dovecot auth settings
    print("Testing Dovecot auth mechanisms...")
    run_cmd("docker exec nextmedya_mail doveconf -n | grep -i auth", "Dovecot Auth Config")
    
    # 2. Check if user exists in passwd file
    print()
    run_cmd("docker exec nextmedya_mail cat /tmp/docker-mailserver/postfix-accounts.cf", "Postfix Accounts")
    
    # 3. Check mail logs for auth errors
    print()
    run_cmd("docker logs nextmedya_mail --tail 20 2>&1 | grep -i -E 'auth|login|error'", "Recent Auth Logs")

if __name__ == "__main__":
    main()
