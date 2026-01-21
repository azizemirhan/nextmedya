import pexpect

HOST = "167.235.141.242"
SSH_USER = "root"
SSH_PASS = "Kx7#mP9$Lz4!"
LOCAL_PATH = "/home/aziz/Masaüstü/nextmedya/public/assets/img/email"
REMOTE_PATH = "/var/www/nextmedya/public/assets/img/email"

def main():
    # Upload logo.png and icon.png
    scp_cmd = f"scp {LOCAL_PATH}/logo.png {LOCAL_PATH}/icon.png {SSH_USER}@{HOST}:{REMOTE_PATH}/"
    print("Uploading logo and icon...")
    try:
        child = pexpect.spawn(scp_cmd, encoding='utf-8', timeout=30)
        index = child.expect(['password:', pexpect.EOF])
        if index == 0:
            child.sendline(SSH_PASS)
        child.expect(pexpect.EOF)
        print(child.before)
        print("Done!")
    except Exception as e:
        print(f"Error: {e}")

if __name__ == "__main__":
    main()
