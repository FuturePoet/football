<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Your Football Video</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            color: white;
            text-align: center;
            padding: 50px;
        }
        .container {
            width: 80%;
            margin: auto;
        }
        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
        }
        .section {
            background: #1e1e1e;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
            animation: fadeIn 1.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .upload
            display: inline-block;
            font-weight: bold;
            transition: 0.3s;
        }
        .upload-label:hover, .upload-btn:hover {
            background: #e63e00;
        }
        video {
            margin-top: 20px;
            width: 100%;
            border-radius: 15px;
            animation: fadeIn 1s ease-in-out;
        }
        .loading-card {
            width: 100%;
            height: 150px;
            background: linear-gradient(90deg, #1e1e1e 25%, #2a2a2a 50%, #1e1e1e 75%);
            background-size: 200% 100%;
            border-radius: 15px;
            animation: loadingAnimation 1.5s infinite;
        }
        @keyframes loadingAnimation {
            0% { background-position: 100% 0; }
            100% { background-position: -100% 0; }
        }
        .navigation ul {
            list-style-type: none;
            padding: 10px;
            margin: 10px;
            display: flex;
            justify-content: center;
            font-weight: bold;
            font-size:35px;
            background-color:rgba(246, 246, 246, 0.61);
            border-radius: 10px;
        }
        .navigation ul li {
            margin: 0 10px;
            font-weight: bold;
        }
        .navigation ul li a {
            text-decoration: none;
            color:rgb(10, 1, 1);
            font-size: 1.1rem;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .navigation ul li a:hover,
        .navigation ul li a.active {
            background: linear-gradient(135deg, #5d77c5, #ffb6a3, #0048ff);
            color:rgb(255, 255, 255);
        }
        h2 {
            color: #ff4500;
            animation: colorChange 3s infinite;
        }
        @keyframes colorChange {
            0% { color: #ff4500; }
            50% { color: #e63e00; }
            100% { color: #ff4500; }
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
    
    </style>
</head>
<body>
<div class="logo">FSP⚽</div>

    <div class="container">
    <h1>AI-Powered Football Analysis</h1>
        <div class="navigation">
            <ul class="nav nav-pills">
                <li role="presentation" class="active"><a href="home.php">Home</a></li>
                <li role="presentation"><a href="subscribe.php">Get Premium</a></li>
                <li role="presentation"><a href="matches.php">Matches</a></li>
                <li role="presentation"><a href="upload.php">Try our Model</a></li>
                <li role="presentation"><a href="players.php">Players</a></li>
                <li role="presentation"><a href="https://friendlychat-541c2.firebaseapp.com/">Fans Section</a></li>
                <li role="presentation"><a href="contact.php">Contact Us</a></li>
            </ul>
        </div>
        <br>
        <br>
        <h1>Let's take a look at some of the features:</h1><br>
        <div class="section">
            <h2>Player Recognition</h2>
            <p>Identify players on the field using our advanced AI models. This feature helps in tracking player movements and analyzing their performance.</p>
            <video src="player_recognition.mp4" controls></video>
        </div>
        <div class="section">
            <h2>Team Classification</h2>
            <p>Our AI can classify teams based on their kits and playing styles. This feature helps in identifying teams during live matches and provides insights into their strategies.</p>
            <video src="videos/ModelAI.mp4" controls></video>
        </div>
        
        <div class="section">
            <h2>Goal Detection</h2>
            <p>Automatically detect goals and key moments in the match. This feature ensures that you never miss a crucial moment, providing real-time updates and highlights.</p>
            <video src="goal_detection.mp4" controls></video>
        </div>
        
        <div class="section">
            <h2>Offside Detection</h2>
            <p>Identify offsides in real-time using advanced AI models. This feature helps referees and viewers to make accurate decisions during the game.</p>
            <video src="offside_detection.mp4" controls></video>
        </div>
        
    </div>
  
    <p>Our AI model is constantly evolving to provide more accurate and detailed analysis of football matches. Stay tuned for more updates!</p>
    <h1>You can also upload your own football video for analysis:</h1>          
    <label for="video-upload" class="upload-label">Choose Video</label>
    <input type="file" id="video-upload" accept="video/*" style="display: none;">
    <video id="video-preview" controls style="display: none;"></video>
    <button id="upload-btn" class="upload-btn" style="display: none;">Upload Video</button>
    <script>
        const fileInput = document.getElementById("video-upload");
        const videoPreview = document.getElementById("video-preview");
        const uploadBtn = document.getElementById("upload-btn");

        fileInput.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const url = URL.createObjectURL(file);
                videoPreview.src = url;
                videoPreview.style.display = "block";
                uploadBtn.style.display = "inline-block";
            }
        });

        uploadBtn.addEventListener("click", function() {
            const formData = new FormData();
            formData.append("video", fileInput.files[0]);

            fetch("https://jsonplaceholder.typicode.com/users", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => alert("Video uploaded successfully! AI Analysis will be available soon."))
            .catch(error => alert("Error uploading video"));
        });
    </script>
</body>
</html>

