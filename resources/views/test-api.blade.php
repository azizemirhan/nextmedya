<!DOCTYPE html>
<html>
<head>
    <title>API Test</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .test-section {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #ddd;
        }

        button {
            padding: 10px 15px;
            margin: 5px;
            cursor: pointer;
        }

        .result {
            background: #f5f5f5;
            padding: 10px;
            margin: 10px 0;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Chat API Test</h1>

    <div class="test-section">
        <h3>1. Login Test</h3>
        <input type="email" id="email" placeholder="Email" value="test@example.com">
        <input type="password" id="password" placeholder="Password" value="password123">
        <button onclick="testLogin()">Login</button>
        <div id="login-result" class="result"></div>
    </div>

    <div class="test-section">
        <h3>2. Get Sessions</h3>
        <button onclick="testGetSessions()">Get Sessions</button>
        <div id="sessions-result" class="result"></div>
    </div>

    <div class="test-section">
        <h3>3. Send Message</h3>
        <input type="text" id="session-id" placeholder="Session ID">
        <input type="text" id="message" placeholder="Message" value="Test mesajı">
        <button onclick="testSendMessage()">Send Message</button>
        <div id="message-result" class="result"></div>
    </div>

    <div class="test-section">
        <h3>4. Dashboard Stats</h3>
        <button onclick="testDashboardStats()">Get Stats</button>
        <div id="stats-result" class="result"></div>
    </div>

    <div class="test-section">
        <h3>5. Logout</h3>
        <button onclick="testLogout()">Logout</button>
        <div id="logout-result" class="result"></div>
    </div>
</div>

<script src="{{ asset('resources/js/api-client.js') }}"></script>
<script>
    async function testLogin() {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const result = document.getElementById('login-result');

        try {
            const response = await ChatAPIClient.login(email, password);
            result.innerHTML = `<span class="success">Login başarılı!</span><br><pre>${JSON.stringify(response, null, 2)}</pre>`;
        } catch (error) {
            result.innerHTML = `<span class="error">Login hatası: ${error.message}</span>`;
        }
    }

    async function testGetSessions() {
        const result = document.getElementById('sessions-result');

        try {
            const response = await ChatAPIClient.getSessions();
            result.innerHTML = `<span class="success">Sessions alındı!</span><br><pre>${JSON.stringify(response, null, 2)}</pre>`;

            // İlk session ID'sini otomatik doldur
            if (response.data && response.data.length > 0) {
                document.getElementById('session-id').value = response.data[0].id;
            }
        } catch (error) {
            result.innerHTML = `<span class="error">Sessions hatası: ${error.message}</span>`;
        }
    }

    async function testSendMessage() {
        const sessionId = document.getElementById('session-id').value;
        const message = document.getElementById('message').value;
        const result = document.getElementById('message-result');

        try {
            const response = await ChatAPIClient.sendMessage(sessionId, message);
            result.innerHTML = `<span class="success">Mesaj gönderildi!</span><br><pre>${JSON.stringify(response, null, 2)}</pre>`;
        } catch (error) {
            result.innerHTML = `<span class="error">Mesaj hatası: ${error.message}</span>`;
        }
    }

    async function testDashboardStats() {
        const result = document.getElementById('stats-result');

        try {
            const response = await ChatAPIClient.getDashboardStats();
            result.innerHTML = `<span class="success">Stats alındı!</span><br><pre>${JSON.stringify(response, null, 2)}</pre>`;
        } catch (error) {
            result.innerHTML = `<span class="error">Stats hatası: ${error.message}</span>`;
        }
    }

    async function testLogout() {
        const result = document.getElementById('logout-result');

        try {
            await ChatAPIClient.logout();
            result.innerHTML = `<span class="success">Logout başarılı!</span>`;
        } catch (error) {
            result.innerHTML = `<span class="error">Logout hatası: ${error.message}</span>`;
        }
    }
</script>
</body>
</html>
