import pexpect
import time

HOST = "167.235.141.242"
SSH_USER = "root"
SSH_PASS = "Kx7#mP9$Lz4!"

def run_cmd(cmd, desc):
    print(f"Running: {desc}...")
    try:
        child = pexpect.spawn(f"ssh {SSH_USER}@{HOST} \"{cmd}\"", encoding='utf-8', timeout=60)
        index = child.expect(['password:', pexpect.EOF])
        if index == 0:
            child.sendline(SSH_PASS)
        child.expect(pexpect.EOF)
        print(f"Done: {desc}")
        print(child.before)
    except Exception as e:
        print(f"Error: {e}")

def main():
    # 1. Stop mail server temporarily to free up resources/ports
    run_cmd("docker stop nextmedya_mail", "Stop Mail Server")
    
    # 2. Install certbot
    run_cmd("apt-get update && apt-get install -y certbot", "Install Certbot")
    
    # 3. Get Certificate (standalone mode needs port 80)
    print("Getting Let's Encrypt Certificate...")
    # Using standalone mode on port 80. Nginx might be using port 80?
    # Check if port 80 is used
    run_cmd("ss -tlnp | grep :80", "Check Port 80")
    
    # If nginx is running, we might need to use --webroot
    # Assuming nginx serves /var/www/nextmedya/public
    
    # Trying certbot with webroot
    cert_cmd = "certbot certonly --webroot -w /var/www/nextmedya/public -d mail.nextmedya.com --email info@nextmedya.com --agree-tos --non-interactive --keep-until-expiring"
    run_cmd(cert_cmd, "Run Certbot")
    
    # 4. Configure permissions so docker can read it
    run_cmd("mkdir -p /var/www/nextmedya/docker/mail/config/ssl/letsencrypt", "Create LE Dir")
    run_cmd("cp /etc/letsencrypt/live/mail.nextmedya.com/fullchain.pem /var/www/nextmedya/docker/mail/config/ssl/letsencrypt/cert.pem", "Copy Cert")
    run_cmd("cp /etc/letsencrypt/live/mail.nextmedya.com/privkey.pem /var/www/nextmedya/docker/mail/config/ssl/letsencrypt/key.pem", "Copy Key")
    run_cmd("chmod 644 /var/www/nextmedya/docker/mail/config/ssl/letsencrypt/cert.pem", "Chmod Cert")
    run_cmd("chmod 600 /var/www/nextmedya/docker/mail/config/ssl/letsencrypt/key.pem", "Chmod Key")
    
    # 5. Start mail server (will be reconfigured in next step, but start to make sure checking works)
    run_cmd("docker start nextmedya_mail", "Start Mail Server")

if __name__ == "__main__":
    main()
