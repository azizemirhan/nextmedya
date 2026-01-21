import pexpect
import time

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
    # Wait for service to be up
    print("Waiting 10s...")
    time.sleep(10)
    
    # Flush
    print("Flushing queue...")
    run_cmd("docker exec nextmedya_mail postqueue -f", "Flush")
    
    print("Waiting 5s for delivery...")
    time.sleep(5)
    
    # Check logs specifically for success "status=sent" or failure "status=bounced"
    print("Checking Delivery Logs...")
    run_cmd("docker logs nextmedya_mail --tail 50 2>&1 | grep -E 'status='", "Status Log")

if __name__ == "__main__":
    main()
