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
    # 1. Create postfix-main.cf to force IPv4
    print("Creating postfix-main.cf...")
    config_content = "inet_protocols = ipv4"
    
    # Write to local temp file then scp
    with open("postfix-main.cf", "w") as f:
        f.write(config_content)
        
    # Upload
    scp_cmd = f"scp postfix-main.cf {SSH_USER}@{HOST}:/var/www/nextmedya/docker/mail/config/postfix-main.cf"
    
    try:
        child = pexpect.spawn(scp_cmd, encoding='utf-8', timeout=30)
        index = child.expect(['password:', pexpect.EOF])
        if index == 0:
            child.sendline(SSH_PASS)
        child.expect(pexpect.EOF)
        print("Uploaded postfix-main.cf")
    except Exception as e:
        print(f"Upload Error: {e}")
        
    # 2. Restart mail container
    print("\nRestarting mail container...")
    run_cmd("docker restart nextmedya_mail", "Restart Container")
    
    # 3. Flush queue (retry sending)
    print("\nFlushing mail queue...")
    run_cmd("docker exec nextmedya_mail postqueue -f", "Flush Queue")

if __name__ == "__main__":
    main()
