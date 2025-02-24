<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Your Football Video</title>
    <link rel="stylesheet" href="styles.css">
    <style>
       :root {
            --bg-color-light: #f4f4f4;
            --text-color-light: #000;
            --container-bg-light: #fff;
            --button-bg-light: #007bff;

            --bg-color-dark: #181818;
            --text-color-dark:rgb(156, 154, 154) ;
            --container-bg-dark: #222;
            --button-bg-dark: #ff4500;
        }

        body {
            background-color: var(--bg-color-light);
            color: var(--text-color-light);
            font-family: Arial, sans-serif;
            transition: all 0.3s ease;
        }
        .header, .navigation, .main, .footer {
            margin-bottom: 20px;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
        .upload {
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
            background: gray;
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
<br><br>
</div>
    <div class="container">
    <h1 style="text-align:center"> AI-Powered Football Match Analysis ⚽</h1>
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
            <video src="images/team_reg.mp4" controls></video>
        </div>
        <div class="section">
            <h2>🏆 Team Classification</h2>
            <p>Our AI can classify teams based on their kits and playing styles. This feature helps in identifying teams during live matches and provides insights into their strategies.</p>
            <video src="images/team_class.mp4" controls></video>
        </div>
        
        <div class="section">
        <h2> Goal Detection🥅</h2>
        <p>Automatically detect goals and key moments in the match. This feature ensures that you never miss a crucial moment, providing real-time updates and highlights.</p>
            <video src="images/goal.mp4" controls type="video/mp4"></video>
        </div>
        
        <div class="section">
        <h2>🚩 Offside Detection</h2>
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
        const videopreview = document.getElementById("video-preview");

        const apiUrl = "https://0730-34-105-44-222.ngrok-free.app";

        fileInput.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const url = URL.createObjectURL(file);
                videoPreview.src = url;
                videoPreview.style.display = "block";
                uploadBtn.style.display = "inline-block";
            }
        });

        async function uploadVideo (file, type) {
            try {
                console.log('type:', type);
                const formData = new FormData();
                formData.append('file', file);
                formData.append('type', type);
                const response = await fetch(`${apiUrl}/upload`, {
                    method: 'POST',
                    body: formData,
                });
                console.log("ResUP", response);
                if (!response.ok && response.json.error) throw new Error('Failure uploading video');
                const data = await response.json();
                console.log('ReturnUP: ', data);
                const FileID = data['file_id'];
                console.log('Uploaded File ID:', FileID);
                getVideo(FileID);
                // return FileID;
            } catch (error) {
                console.error('Error', error);
            }
        }
        
        async function getVideo (FILEID) {
            try {
                console.log('FileID:', FILEID);
                const response = await fetch(`${apiUrl}/get`, {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json',
                        'Connection': 'keep-alive',
                        'Accept': '*/*',
                        'Accept-Encoding': 'gzip, deflate, br'
                    },
                    body: JSON.stringify({'file_id': FILEID}),
                });
                console.log("ResGET", response);
                if (!response.ok) throw new Error('Failure Getting video');
                const data = await response.blob();
                const videoURL = URL.createObjectURL(data);
                console.log('ReturnGET: ', data);
                videopreview.src = videoURL;
                videopreview.load();
                videopreview.play();
                videopreview.style.display = "block";
                console.log('Success');
            } catch (error) {
                console.error('Error', error);
            }
        }

        const myModal = document.getElementById('staticBackdrop')
        const myInput = document.getElementById('myInput')
        const UploadedFile = document.getElementById('UploadedFile')
        const UPBTN = document.getElementById('UPBTN')

        
        UPBTN.disabled = true;
        const toastLiveExample = document.getElementById('liveToast')
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        UploadedFile.addEventListener("change", function() {
            const file = this.files[0];
            if (file && file.name.endsWith('.mp4')) {
                UPBTN.disabled = false;
            } else {
                UPBTN.disabled = true;
                toastBootstrap.show()
            }
        });
        UPBTN.addEventListener("click", async (e) => {
            const selectedRadio = document.querySelector('input[name="btnradio"]:checked');
            if (selectedRadio) {
                const ModelType = selectedRadio.getAttribute('model');
                const Video = UploadedFile.files[0];
                toastBootstrap.hide()
                uploadVideo(Video, ModelType);
                // const FILEID = uploadVideo(Video, ModelType);
                // getVideo(FileID);
                // getVideo('2aafa96dc0');
                // getVideo('90813a9024');
            } else {
                console.log('No option selected');
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
        function toggleMode() {
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('mode', document.body.classList.contains('dark-mode') ? 'dark' : 'light');
        }

        window.onload = function() {
            if (localStorage.getItem('mode') === 'light') {
                document.body.classList.add('light-mode');
            }
        };
    </script>
</body>
</html>

