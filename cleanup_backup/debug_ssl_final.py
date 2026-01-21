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
    # 1. Check permissions of SSL files inside container
    run_cmd("docker exec nextmedya_mail ls -la /tmp/docker-mailserver/ssl/", "SSL Cert Permissions")
    
    # 2. Check Dovecot logs for SSL errors
    run_cmd("docker logs nextmedya_mail --tail 50 2>&1 | grep -i -E 'ssl|error|warning'", "Dovecot SSL Logs")
    
    # 3. Check if Dovecot is actually listening on 993 now
    run_cmd("docker exec nextmedya_mail ss -tlnp | grep 993", "Dovecot Port 993")

if __name__ == "__main__":
    main()
