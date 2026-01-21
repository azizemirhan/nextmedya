import pexpect
import time

HOST = "167.235.141.242"
SSH_USER = "root"
SSH_PASS = "Kx7#mP9$Lz4!"
LOCAL_COMPOSE = "/home/aziz/Masaüstü/nextmedya/docker-compose.yml"
REMOTE_PATH = "/var/www/nextmedya"

def run_cmd(cmd, desc, timeout=60):
    print(f"Running: {desc}...")
    try:
        child = pexpect.spawn(cmd, encoding='utf-8', timeout=timeout)
        index = child.expect(['password:', pexpect.EOF, pexpect.TIMEOUT])
        if index == 0:
            child.sendline(SSH_PASS)
        child.expect(pexpect.EOF)
        print(f"Done: {desc}")
        print(child.before)
    except Exception as e:
        print(f"Error: {e}")

def main():
    # 1. Upload new docker-compose.yml
    print("=== Uploading docker-compose.yml ===")
    scp_cmd = f"scp {LOCAL_COMPOSE} {SSH_USER}@{HOST}:{REMOTE_PATH}/docker-compose.yml"
    run_cmd(scp_cmd, "Upload docker-compose.yml")
    
    # 2. Recreate mail container
    print("\n=== Recreating mail container ===")
    recreate_cmd = f"ssh {SSH_USER}@{HOST} \"cd {REMOTE_PATH} && docker compose up -d mail --force-recreate\""
    run_cmd(recreate_cmd, "Recreate mail container", timeout=120)
    
    time.sleep(15)
    
    # 3. Check ports
    print("\n=== Check mail ports ===")
    check_cmd = f"ssh {SSH_USER}@{HOST} \"docker exec nextmedya_mail ss -tlnp | grep -E ':143|:993'\""
    run_cmd(check_cmd, "Check ports")

if __name__ == "__main__":
    main()
