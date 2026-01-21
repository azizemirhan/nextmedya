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
    # Test IMAP login with nc
    print("Testing direct IMAP auth...")
    # Using openssl to test STARTTLS
    imap_test = '''echo -e "a1 LOGIN info@nextmedya.com NextMedyaInfo2024!\na2 LOGOUT" | nc localhost 143'''
    run_cmd(imap_test, "IMAP Login Test")
    
    # Check if STARTTLS is advertised
    print()
    starttls_test = '''echo -e "a1 CAPABILITY\na2 LOGOUT" | nc localhost 143'''
    run_cmd(starttls_test, "IMAP Capabilities")

if __name__ == "__main__":
    main()
