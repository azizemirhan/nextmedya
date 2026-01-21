import pexpect

HOST = "167.235.141.242"
SSH_USER = "root"
SSH_PASS = "Kx7#mP9$Lz4!"

def main():
    # List email accounts
    cmd = f"ssh {SSH_USER}@{HOST} \"docker exec nextmedya_mail setup email list\""
    try:
        child = pexpect.spawn(cmd, encoding='utf-8', timeout=30)
        index = child.expect(['password:', pexpect.EOF])
        if index == 0:
            child.sendline(SSH_PASS)
        child.expect(pexpect.EOF)
        print("Email accounts:")
        print(child.before)
    except Exception as e:
        print(e)

if __name__ == "__main__":
    main()
