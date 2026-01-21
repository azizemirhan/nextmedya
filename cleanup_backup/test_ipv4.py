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
    # 1. Check inet_protocols
    print("Checking inet_protocols...")
    run_cmd("docker exec nextmedya_mail postconf inet_protocols", "Check Config")
    
    # 2. Send Test Mail
    print("\nSending Test Mail...")
    # Using sendmail
    test_mail = '''
FROM:info@nextmedya.com
TO:azizemirhanozdemir@gmail.com
SUBJECT: Test Mail IPv4

This is a test mail to verify IPv4 delivery.
.
'''
    # We pipe this into sendmail
    # Note: docker exec -i needs stdin?
    # Easier: Use python execution inside container? Or just simple bash echo piping
    cmd = f"docker exec nextmedya_mail bash -c 'echo \"Subject: IPv4 Test\" | sendmail -v azizemirhanozdemir@gmail.com'"
    run_cmd(cmd, "Send Test Mail")
    
    # 3. Check logs immediately
    print("\nChecking Logs...")
    run_cmd("docker logs nextmedya_mail --tail 20", "Mail Log")

if __name__ == "__main__":
    main()
