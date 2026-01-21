import pexpect

HOST = "167.235.141.242"
SSH_USER = "root"
SSH_PASS = "Kx7#mP9$Lz4!"

def main():
    cmd = f"ssh {SSH_USER}@{HOST} \"docker logs nextmedya_mail --tail 50\""
    try:
        child = pexpect.spawn(cmd, encoding='utf-8', timeout=30)
        index = child.expect(['password:', pexpect.EOF])
        if index == 0:
            child.sendline(SSH_PASS)
        child.expect(pexpect.EOF)
        print(child.before)
    except Exception as e:
        print(e)

if __name__ == "__main__":
    main()
