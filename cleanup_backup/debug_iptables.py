import pexpect

HOST = "167.235.141.242"
SSH_USER = "root"
SSH_PASS = "Kx7#mP9$Lz4!"

def run_cmd(cmd):
    try:
        child = pexpect.spawn(f"ssh {SSH_USER}@{HOST} \"{cmd}\"", encoding='utf-8', timeout=30)
        index = child.expect(['password:', pexpect.EOF])
        if index == 0:
            child.sendline(SSH_PASS)
        child.expect(pexpect.EOF)
        print(child.before)
    except Exception as e:
        print(e)

def main():
    print("=== iptables FORWARD rules ===")
    run_cmd("iptables -L FORWARD -n | head -20")
    
    print("\n=== iptables filter for 993 ===")
    run_cmd("iptables -L -n | grep 993")
    
    print("\n=== Test local port 993 inside container===")
    run_cmd("docker exec nextmedya_mail ss -tlnp | grep 993")
    
    print("\n=== Test local connection from server ===")
    run_cmd("nc -zv localhost 993")

if __name__ == "__main__":
    main()
