
# Test 993 SSL
echo "Testing 993 SSL..."
echo -e "a1 LOGIN info@nextmedya.com NextMedyaInfo2024!\na2 LOGOUT" | openssl s_client -connect localhost:993 -quiet -crlf 2>/dev/null
echo "--------------------------------"

# Test 143 STARTTLS
echo "Testing 143 STARTTLS..."
echo -e "a1 LOGIN info@nextmedya.com NextMedyaInfo2024!\na2 LOGOUT" | openssl s_client -connect localhost:143 -starttls imap -quiet -crlf 2>/dev/null
echo "--------------------------------"
