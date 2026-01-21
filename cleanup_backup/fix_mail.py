import pexpect
import time

HOST = "167.235.141.242"
SSH_USER = "root"
SSH_PASS = "Kx7#mP9$Lz4!"
REMOTE_PATH = "/var/www/nextmedya"

EMAILS = [
    ("info@nextmedya.com", "NextMedyaInfo2024!"),
    ("azizemirhanozdemir@nextmedya.com", "AzizEmirhan2024!"),
    ("demirhanozdemir@nextmedya.com", "Demirhan2024!")
]

def run_command(command, password, description):
    print(f"Running: {description}...")
    try:
        child = pexpect.spawn(command, encoding='utf-8', timeout=120)
        index = child.expect(['password:', 'continue connecting', pexpect.EOF, pexpect.TIMEOUT])
        if index == 1:
            child.sendline('yes')
            child.expect('password:')
            child.sendline(password)
        elif index == 0:
            child.sendline(password)
        child.expect(pexpect.EOF)
        print(f"Done: {description}")
        print(child.before)
        return True
    except Exception as e:
        print(f"Error: {e}")
        return False

def main():
    # 1. Restart mail container
    print("=== Restarting mail container ===")
    restart_cmd = f"ssh {SSH_USER}@{HOST} \"docker restart nextmedya_mail\""
    run_command(restart_cmd, SSH_PASS, "Restart Mail Container")
    
    time.sleep(15)
    
    # 2. Delete existing accounts and recreate
    print("\n=== Recreating accounts ===")
    for email, password in EMAILS:
        # Delete first
        del_cmd = f"ssh {SSH_USER}@{HOST} \"docker exec nextmedya_mail setup email del -y {email}\""
        run_command(del_cmd, SSH_PASS, f"Delete {email}")
        
        # Add
        add_cmd = f"ssh {SSH_USER}@{HOST} \"docker exec nextmedya_mail setup email add {email} '{password}'\""
        run_command(add_cmd, SSH_PASS, f"Add {email}")
    
    # 3. List accounts to verify
    print("\n=== Verifying accounts ===")
    list_cmd = f"ssh {SSH_USER}@{HOST} \"docker exec nextmedya_mail setup email list\""
    run_command(list_cmd, SSH_PASS, "List Accounts")

if __name__ == "__main__":
    main()
