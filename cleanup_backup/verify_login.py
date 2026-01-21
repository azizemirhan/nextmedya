import pexpect
import sys

HOST = "167.235.141.242"
SSH_USER = "root"
SSH_PASS = "Kx7#mP9$Lz4!"
USER = "info@nextmedya.com"
PASS = "NextMedyaInfo2024!"

def run_test(cmd, desc):
    print(f"=== {desc} ===")
    try:
        # Run passed command on remote host
        ssh_cmd = f"ssh {SSH_USER}@{HOST} \"{cmd}\""
        child = pexpect.spawn(ssh_cmd, encoding='utf-8', timeout=10)
        index = child.expect(['password:', pexpect.EOF])
        if index == 0:
            child.sendline(SSH_PASS)
        
        # We expect connection output, then we send login
        # Allow time for connection
        child.expect(pexpect.TIMEOUT, timeout=2) 
        
        # Send Login
        # . does not mean valid IMAP command prefix, usually a tag like a1
        # But this is just piping input or interacting?
        # Verify using interaction if possible, or prepared input.
        # Sending input via 'sendline' to the running openssl command
        
        # Actually, simpler to use a script on the server that pipes echo into openssl
        # But let's try reading output first
        print(child.before)
        
    except Exception as e:
        print(f"Error: {e}")

def main():
    # We will write a script to the server to test locally on the server to avoid network lag issues interacting with openssl
    
    test_script = f'''
# Test 993 SSL
echo "Testing 993 SSL..."
echo -e "a1 LOGIN {USER} {PASS}\\na2 LOGOUT" | openssl s_client -connect localhost:993 -quiet -crlf 2>/dev/null
echo "--------------------------------"

# Test 143 STARTTLS
echo "Testing 143 STARTTLS..."
echo -e "a1 LOGIN {USER} {PASS}\\na2 LOGOUT" | openssl s_client -connect localhost:143 -starttls imap -quiet -crlf 2>/dev/null
echo "--------------------------------"
'''
    
    with open("test_login_final.sh", "w") as f:
        f.write(test_script)
    
    # Upload and run
    try:
        child = pexpect.spawn(f"scp test_login_final.sh {SSH_USER}@{HOST}:/tmp/test_login_final.sh", encoding='utf-8')
        child.expect('password:')
        child.sendline(SSH_PASS)
        child.expect(pexpect.EOF)
        
        child = pexpect.spawn(f"ssh {SSH_USER}@{HOST} \"bash /tmp/test_login_final.sh\"", encoding='utf-8')
        child.expect('password:')
        child.sendline(SSH_PASS)
        child.expect(pexpect.EOF)
        print(child.before)
        
    except Exception as e:
        print(e)

if __name__ == "__main__":
    main()
