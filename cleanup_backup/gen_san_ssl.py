import pexpect

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
        # print(child.before) 
    except Exception as e:
        print(f"Error: {e}")

def main():
    print("=== Generating SAN-enabled SSL Cert ===")
    
    # Create OpenSSL config file for SAN
    san_config = """
[req]
distinguished_name = req_distinguished_name
req_extensions = v3_req
prompt = no

[req_distinguished_name]
C = TR
ST = Ankara
L = Ankara
O = NextMedya
CN = mail.nextmedya.com

[v3_req]
keyUsage = keyEncipherment, dataEncipherment
extendedKeyUsage = serverAuth
subjectAltName = @alt_names

[alt_names]
DNS.1 = mail.nextmedya.com
DNS.2 = nextmedya.com
    """
    
    # Write config to temp file on local then upload
    with open("san_openssl.cnf", "w") as f:
        f.write(san_config)
        
    ssh_copy = f"scp san_openssl.cnf {SSH_USER}@{HOST}:/tmp/san_openssl.cnf"
    run_cmd(ssh_copy, "Upload OpenSSL Config")
    
    # Generate cert using config
    gen_cmd = (
        "openssl req -new -newkey rsa:4096 -days 3650 -nodes -x509 "
        "-config /tmp/san_openssl.cnf "
        "-keyout /var/www/nextmedya/docker/mail/config/ssl/key.pem "
        "-out /var/www/nextmedya/docker/mail/config/ssl/cert.pem"
    )
    run_cmd(gen_cmd, "Generate Cert with SAN")
    
    # Fix permissions again
    run_cmd("chmod 600 /var/www/nextmedya/docker/mail/config/ssl/key.pem", "Chmod Key")
    run_cmd("chmod 644 /var/www/nextmedya/docker/mail/config/ssl/cert.pem", "Chmod Cert")
    
    # Restart container to pick up new cert
    run_cmd("docker restart nextmedya_mail", "Restart Mail Container")

    # Clean up
    run_cmd("rm /tmp/san_openssl.cnf", "Cleanup")

if __name__ == "__main__":
    main()
