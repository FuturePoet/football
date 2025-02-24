<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Your Football Video</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: black;
            text-align: center;
            padding: 50px;
            transition: background-color 0.3s, color 0.3s;
        }
        .dark-mode {
            background-color: #121212;
            color: white;
        }
        .container {
            width: 80%;
            margin: auto;
        }
        .section {
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: background-color 0.3s;
        }
        .dark-mode .section {
            background: #1e1e1e;
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.1);
        }
        .toggle-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background: #ff4500;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            transition: background 0.3s;
        }
        .toggle-btn:hover {
            background: #e63e00;
        }
    </style>
</head>
<body>
    <button class="toggle-btn" onclick="toggleMode()">Toggle Mode</button>
    <h1>FSP WEBSITE</h1>
    <div class="container">
        <h1>AI-Powered Football Match Analysis ⚽</h1>
        <div class="section">
            <h2>Player Recognition</h2>
            <p>Identify players on the field using our advanced AI models.</p>
            <video src="player_recognition.mp4" controls></video>
        </div>
    </div>
    <script>
        function toggleMode() {
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('mode', document.body.classList.contains('dark-mode') ? 'dark' : 'light');
        }

        window.onload = function() {
            if (localStorage.getItem('mode') === 'dark') {
                document.body.classList.add('dark-mode');
            }
        };
    </script>
</body>
</html>
