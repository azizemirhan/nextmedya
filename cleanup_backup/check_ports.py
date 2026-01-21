import pexpect

HOST = "167.235.141.242"
SSH_USER = "root"
SSH_PASS = "Kx7#mP9$Lz4!"

def main():
    # Check if port 993 is listening
    cmd = f"ssh {SSH_USER}@{HOST} \"ss -tlnp | grep -E '(993|587|25)'\""
    try:
        child = pexpect.spawn(cmd, encoding='utf-8', timeout=30)
        index = child.expect(['password:', pexpect.EOF])
        if index == 0:
            child.sendline(SSH_PASS)
        child.expect(pexpect.EOF)
        print("Port listening status:")
        print(child.before)
    except Exception as e:
        print(e)

if __name__ == "__main__":
    main()
