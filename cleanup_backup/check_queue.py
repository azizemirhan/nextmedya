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
    # Check mail queue
    print("Checking mail queue...")
    run_cmd("docker exec nextmedya_mail mailq", "Mail Queue")
    
    # Check for delivery failures in log
    # Looking for lines with 'status=bounced' or 'status=deferred'
    print("\nChecking for bounced/deferred emails...")
    run_cmd("docker logs nextmedya_mail --tail 100 2>&1 | grep -E 'status=bounced|status=deferred|status=sent'", "Delivery Status")

if __name__ == "__main__":
    main()
