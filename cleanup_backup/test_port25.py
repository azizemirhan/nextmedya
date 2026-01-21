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
    # Test Port 25 outbound to Google
    print("Testing Outbound Port 25...")
    run_cmd("nc -zv gmail-smtp-in.l.google.com 25", "Connect Google SMTP")
    
    # Test Port 587 (should work usually)
    print("\nTesting Outbound Port 587...")
    run_cmd("nc -zv smtp.gmail.com 587", "Connect Gmail 587")

if __name__ == "__main__":
    main()
