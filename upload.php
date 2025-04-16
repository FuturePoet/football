<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Your Football Video</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
            text-align: center;
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

        .loadingSection {
            background-color: rgba(0, 0, 0, 0.85);
            z-index: 10000;
            width: 100%;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
        }

        .loader {
            position: relative;
            font-size: 16px;
            width: 5.5em;
            height: 5.5em;
            }

            .loader:before {
            content: '';
            position: absolute;
            transform: translate(-50%, -50%) rotate(45deg);
            height: 100%;
            width: 4px;
            background: #fff;
            left: 50%;
            top: 50%;
            }

            .loader:after {
            content: '';
            position: absolute;
            left: 0.2em;
            bottom: 0.18em;
            width: 1em;
            height: 1em;
            background-color: orange;
            border-radius: 15%;
            animation: rollingRock 2.5s cubic-bezier(.79, 0, .47, .97) infinite;
            }

            @keyframes rollingRock {
            0% {
                transform: translate(0, -1em) rotate(-45deg)
            }

            5% {
                transform: translate(0, -1em) rotate(-50deg)
            }

            20% {
                transform: translate(1em, -2em) rotate(47deg)
            }

            25% {
                transform: translate(1em, -2em) rotate(45deg)
            }

            30% {
                transform: translate(1em, -2em) rotate(40deg)
            }

            45% {
                transform: translate(2em, -3em) rotate(137deg)
            }

            50% {
                transform: translate(2em, -3em) rotate(135deg)
            }

            55% {
                transform: translate(2em, -3em) rotate(130deg)
            }

            70% {
                transform: translate(3em, -4em) rotate(217deg)
            }

            75% {
                transform: translate(3em, -4em) rotate(220deg)
            }

            100% {
                transform: translate(0, -1em) rotate(-225deg)
            }
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
        
        <div class="section d-none">
        <h2>🚩 Offside Detection</h2>
        <p>Identify offsides in real-time using advanced AI models. This feature helps referees and viewers to make accurate decisions during the game.</p>
            <video src="FF.mp4" controls></video>
        </div>
        
    </div>
  
    <p>Our AI model is constantly evolving to provide more accurate and detailed analysis of football matches. Stay tuned for more updates!</p>
    <h1>You can also upload your own football video for analysis</h1>
    <!-- <label for="video-upload" class="upload-label">Choose Video</label> -->
    <input type="file" id="video-upload" accept="video/*" style="display: none;">
    <div id="VSec" class="container" style="display: none;">
        <div class="section" id="video-preview" style="display: none;">
            <video  controls ></video>
        </div>
    </div>



    <section>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-lg btn-dark border border-primary m-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Try The Model
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Try Model</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="btn-group container-fluid mb-3" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradio" model="Players" id="btnradio1" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="btnradio1">Detect Players</label>

                            <input type="radio" class="btn-check" name="btnradio" model="Teams" id="btnradio2" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btnradio2">Classefy Teams</label>

                            <input type="radio" class="btn-check" name="btnradio" model="Offside" id="btnradio3" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btnradio3">Offside Detection</label>

                            <input type="radio" class="btn-check" name="btnradio"  model="Goal" id="btnradio4" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btnradio4">Goal Detection</label>
                        </div>
                        <div class="input-group container-fluid">
                            <input type="file" id="UploadedFile" class="form-control" placeholder="Input group example" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            <div class="input-group-text" id="btnGroupAddon">.mp4</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="UPBTN" class="btn btn-primary" data-bs-dismiss="modal">Upload</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="toast align-items-center text-bg-danger border-0 position-fixed bottom-0 end-0 m-3" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    File must be in .mp4 format
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </section>

    <section id="loading" class="loadingSection d-flex justify-content-center align-items-center">
        <div class="loader"></div>
    </section>


    <script>
        const fileInput = document.getElementById("video-upload");
        const videoPreview = document.getElementById("video-preview");
        const VSec = document.getElementById("VSec");
        const videopreview = document.getElementById("video-preview");
        const loading = document.getElementById("loading");

        loading.classList.remove('d-flex');
        loading.style.display = 'none';

        const apiUrl = "https://0a82-35-230-24-214.ngrok-free.app";

        fileInput.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const url = URL.createObjectURL(file);
                videoPreview.src = url;
                videoPreview.style.display = "block";
            }
        });

        async function uploadVideo (file, type) {
            loading.style.display = 'flex';
            try {
                console.log('Uploading Video...');
                const formData = new FormData();
                formData.append('file', file);
                formData.append('type', type);
                const response = await fetch(`${apiUrl}/upload`, {
                    method: 'POST',
                    mode: 'cors',
                    body: formData,
                });
                console.log("ResUP", response);
                if (!response.ok && response.json.error) throw new Error('Failure uploading video');
                const data = await response.json();
                console.log('ReturnUP: ', data);
                const FileID = data['file_id'];
                console.log('Uploaded File ID:', FileID);
                console.log('Video Uploaded and processed');
                getVideo(FileID);
            } catch (error) {
                console.error('Error', error);
            }
        }
        
        async function getVideo (FILEID) {
            try {
                console.log('Getting Video...');
                console.log('FileID:', FILEID);
                const response = await fetch(`${apiUrl}/get`, {
                    method: 'POST',
                    mode: 'cors',
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
                // console.log("URL: ",videoURL);
                
                VSec.style.display = "block";
                videopreview.style.display = "block";
                console.log('Video Fetched Successfully');
            } catch (error) {
                console.error('Error', error);
            }
            loading.style.display = 'none';
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
                // getVideo("27005cf1da");
            } else {
                console.log('No option selected');
            }
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

