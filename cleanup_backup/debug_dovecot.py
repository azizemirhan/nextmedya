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
    print("=== Dovecot listening ports inside container ===")
    run_cmd("docker exec nextmedya_mail ss -tlnp | grep -E 'dovecot|:993|:143'")
    
    print("\n=== Dovecot config for SSL ===")
    run_cmd("docker exec nextmedya_mail doveconf -n | grep -i ssl")
    
    print("\n=== Check if SSL cert exists ===")
    run_cmd("docker exec nextmedya_mail ls -la /etc/ssl/certs/selfsigned.crt 2>/dev/null || echo 'No self-signed cert'")

if __name__ == "__main__":
    main()
