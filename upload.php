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
            <video src="images/Player_Recognition.mp4" controls></video>
        </div>
        <div class="section">
            <h2>🏆 Team Classification</h2>
            <p>Our AI can classify teams based on their kits and playing styles. This feature helps in identifying teams during live matches and provides insights into their strategies.</p>
            <video src="images/Team_Classification.mp4" controls></video>
        </div>
        
        <div class="section">
        <h2> Goal Detection🥅</h2>
        <p>Automatically detect goals and key moments in the match. This feature ensures that you never miss a crucial moment, providing real-time updates and highlights.</p>
            <video src="images/Goal_Detection_1.mp4" controls type="video/mp4"></video>
        </div>

        <div class="section">
        <h2> Ball out Detection</h2>
        <p>Detect when the ball get out of the Field</p>
            <video src="images/BallOut.mp4" controls type="video/mp4"></video>
        </div>
        
        <!-- <div class="section d-none">
        <h2>🚩 Offside Detection</h2>
        <p>Identify offsides in real-time using advanced AI models. This feature helps referees and viewers to make accurate decisions during the game.</p>
            <video src="uploads/FF.mp4" controls></video>
        </div> -->
        
    </div>
  
    <p>Our AI model is constantly evolving to provide more accurate and detailed analysis of football matches. Stay tuned for more updates!</p>
    <h2>You can also Try our model on your own football video or live video for analysis</h2>
    <!-- <label for="video-upload" class="upload-label">Choose Video</label> -->
    <input type="file" id="video-upload" accept="video/*" style="display: none;">
    <div id="VSec" class="container" style="display: none;">
        <div class="section" id="video-preview" style="display: none;">
            <video  controls ></video>
        </div>
    </div>



    <section>
        <!-- Button trigger modal -->
        <button id="UploadBTN" type="button" class="btn btn-lg btn-dark border border-primary border-2 rounded-5 m-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Upload Video
        </button>
        <button id="LiveBTN" type="button" class="btn btn-lg btn-dark border border-primary border-2 rounded-5 m-5">
            Live Video
        </button>
        <button id="ScreenBTN" type="button" class="btn btn-lg btn-dark border border-primary border-2 rounded-5 m-5" data-bs-toggle="modal" data-bs-target="#screenModal" onclick="startScreenProcessing()">
            Screen Detection
        </button>

        <!-- Live Modal -->
        <div class="modal fade" id="liveModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content bg-dark">
                    <div class="modal-header text-white">
                        <h5 class="modal-title" id="liveModalLabel">Live Player Detection</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="stopStreaming()"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="container">
                            <div class="dropdown mb-3">
                                <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Detect Players
                                </button>
                                <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#" data-model="Players">Detect Players</a></li>
                                    <li><a class="dropdown-item" href="#" data-model="Teams">Classify Teams</a></li>
                                    <li><a class="dropdown-item" href="#" data-model="Offside">Offside Detection</a></li>
                                    <li><a class="dropdown-item" href="#" data-model="Goal">Goal Detection</a></li>
                                    <li><a class="dropdown-item" href="#" data-model="Hand">Hand Error Detection</a></li>
                                    <li><a class="dropdown-item" href="#" data-model="BallOut">Ball-out Detection</a></li>
                                    <li><a class="dropdown-item" href="#" data-model="All">All Models</a></li>
                                </ul>
                            </div>
                            <!-- Hidden input to store the selected value -->
                            <!-- <input type="hidden" id="selectedModel" name="selectedModel" value="Players"> -->
                            <input type="hidden" id="liveSelectedModel" value="Players">
                        </div>
                        
                        <video id="liveVideo" autoplay playsinline class="w-100 h-100 border" style="max-width: 640px; max-height: 480px; border: 1px solid #ccc;"></video>
                        <canvas id="captureCanvas" class="w-100 h-100 border" style="display: none;"></canvas>
                        <img id="annotatedResult" class="w-100 h-100 border" style="margin-top: 10px; max-width: 640px; max-height: 480px;" />
                    </div>
                </div>
            </div>
        </div>


        <!-- Upload Modal -->
        <div class="modal fade w-100" id="staticBackdrop"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-dark">
                    <div class="modal-header text-white">
                        <h4 class="modal-title fs-4" id="staticBackdropLabel">Try Model</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="dropdown mb-3">
                                <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    Detect Players
                                </button>
                                <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#" data-model="Players">Detect Players</a></li>
                                    <li><a class="dropdown-item" href="#" data-model="Teams">Classify Teams</a></li>
                                    <li><a class="dropdown-item" href="#" data-model="Offside">Offside Detection</a></li>
                                    <li><a class="dropdown-item" href="#" data-model="Goal">Goal Detection</a></li>
                                    <li><a class="dropdown-item" href="#" data-model="Hand">Hand Error Detection</a></li>
                                    <li><a class="dropdown-item" href="#" data-model="BallOut">Ball-out Detection</a></li>
                                </ul>
                            </div>

                            <!-- Hidden input to store the selected value -->
                            <!-- <input type="hidden" id="selectedModel" name="selectedModel" value="Players"> -->
                            <input type="hidden" id="uploadSelectedModel" value="Players">
                        </div>


                        <div class="input-group container-fluid">
                            <input type="file" accept=".mp4" id="UploadedFile" class="form-control" placeholder="Input group example" aria-label="Input group example" aria-describedby="btnGroupAddon">
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

        <!-- Screen Modal -->
        <div class="modal fade" id="screenModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content bg-dark">
                    <div class="modal-header text-white">
                        <h5 class="modal-title">Screen Detection</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="stopScreenProcessing()"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="container">
                        <div class="dropdown mb-3">
                            <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="screenModelDropdownBtn" data-bs-toggle="dropdown">
                                Detect Players
                            </button>
                            <ul  class="dropdown-menu w-100">
                            <li><a class="dropdown-item" href="#" data-model="Players">Detect Players</a></li>
                            <li><a class="dropdown-item" href="#" data-model="Teams">Classify Teams</a></li>
                            <li><a class="dropdown-item" href="#" data-model="Offside">Offside Detection</a></li>
                            <li><a class="dropdown-item" href="#" data-model="Goal">Goal Detection</a></li>
                            <li><a class="dropdown-item" href="#" data-model="Hand">Hand Error Detection</a></li>
                            <li><a class="dropdown-item" href="#" data-model="BallOut">Ball-out Detection</a></li>
                            <li><a class="dropdown-item" href="#" data-model="All">All Models</a></li>
                            </ul>
                        </div>

                        <input type="hidden" id="screenModelSelect" value="Players">

                        <video id="screenVideoElement" autoplay muted class="w-100 border" style="display:block; max-width: 640px; max-height: 480px; border: 1px solid #ccc;"></video>
                        <canvas id="screenCanvas" class="w-100 border" style="display:none; margin-top: 10px; max-width: 640px; max-height: 480px;"></canvas>
                        <img id="screenAnnotatedResult" class="w-100 border" />
                        </div>
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

    <section id="loading" class="loadingSection d-flex justify-content-center align-items-center flex-column gap-3">
        <div class="loader"></div>
        <span id="SpanID" class="text-white"></span>
    </section>


    <script>
        const fileInput = document.getElementById("video-upload");
        const videoPreview = document.getElementById("video-preview");
        const VSec = document.getElementById("VSec");
        const videopreview = document.getElementById("video-preview");
        const loading = document.getElementById("loading");
        const SpanID = document.getElementById("SpanID");

        loading.classList.remove('d-flex');
        loading.style.display = 'none';

        const apiUrl = "https://76b3-34-87-242-29.ngrok-free.app";
        // const apiUrl = "Test";

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
                SpanID.innerText = "Uploading and Processing Video..."
                const formData = new FormData();
                formData.append('file', file);
                formData.append('type', type);
                const response = await fetch(`${apiUrl}/upload`, {
                    method: 'POST',
                    mode: 'cors',
                    body: formData,
                });
                console.log("ResUP", response);
                if (!response.ok) {
                    try {
                        const err = await response.json();
                        throw new Error(err.error || "Failure uploading video");
                    } catch {
                        throw new Error("Unknown upload error");
                    }
                }
                const data = await response.json();
                console.log('ReturnUP: ', data);
                const FileID = data['file_id'];
                console.log('Uploaded File ID:', FileID);
                console.log('Video Uploaded and processed');
                SpanID.innerText = "Video Uploaded and processed successfully"
                if (type === 'Offside') {
                    // Handle JSON response for Offside detection
                    console.log('Offside detection result:', data);
                    
                    loading.style.display = 'none';
                    SpanID.innerText = ""
                    
                    // Display the message to the user
                    if (data.message) {
                        alert(data.message);
                    } else {
                        alert('Offside detection completed');
                    }
                    
                } else {
                    getVideo(FileID, type);}
            } catch (error) {
                console.error('Error', error);
            }
        }

        async function getVideo (FILEID, type) {
            try {
                console.log('Getting Video...');
                SpanID.innerText = "Getting Video..."
                console.log('FileID:', FILEID);
                console.log('Type:', type);
                
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
                
                console.log("Start Downloading....");
                SpanID.innerText = "Downloading Result...."
                const data = await response.blob();
                const videoURL = URL.createObjectURL(data);
                
                
                // Create a temporary <a> element to download the video
                const a = document.createElement('a');
                a.href = videoURL;
                a.download = `${FILEID}.mp4`; // Set a desired filename
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                
                console.log("Downloaded Successfully");
                SpanID.innerText = "Downloaded Successfully"
                
                loading.style.display = 'none';
                SpanID.innerText = ""
                
                alert('Video Downloaded Successfully! name: ' + `${FILEID}.mp4`);
                
                // Optional: release the blob URL from memory after download
                URL.revokeObjectURL(videoURL);
                
            } catch (error) {
                console.error('Error', error);
                loading.style.display = 'none';
                alert(`Error processing ${type} detection`);
            }
            loading.style.display = 'none';
        }

        const myModal = document.getElementById('staticBackdrop')
        const UploadedFile = document.getElementById('UploadedFile')
        const UPBTN = document.getElementById('UPBTN')

        document.querySelectorAll('#staticBackdrop .dropdown-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const model = this.getAttribute('data-model');
                document.getElementById('uploadSelectedModel').value = model;
                document.getElementById('dropdownMenuButton2').textContent = this.textContent;
                console.log('Upload Selected Model:', model);
            });
        });

        document.querySelectorAll('#liveModal .dropdown-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const model = this.getAttribute('data-model');
                document.getElementById('liveSelectedModel').value = model;
                document.getElementById('dropdownMenuButton1').textContent = this.textContent;
                console.log('Live Selected Model:', model);
            });
        });

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
            // Updated to work with dropdown instead of radio buttons
            const selectedModel = document.getElementById('uploadSelectedModel').value;
            if (selectedModel) {
                const ModelType = selectedModel;
                const Video = UploadedFile.files[0];
                toastBootstrap.hide()
                uploadVideo(Video, ModelType);
            } else {
                console.log('No option selected');
            }
        });

        const liveVideoButton = document.getElementById('LiveBTN');
        const liveVideo = document.getElementById('liveVideo');
        const captureCanvas = document.getElementById('captureCanvas');
        const annotatedResult = document.getElementById('annotatedResult');
        const ctx = captureCanvas.getContext('2d');
        let streaming = false;
        let frameInterval;

        const liveModalElement = document.getElementById('liveModal');
        const liveModal = new bootstrap.Modal(liveModalElement);

        liveModalElement.addEventListener('hidden.bs.modal', () => {
            if (streaming) {
                stopStreaming();
            }
        });

        liveVideoButton.addEventListener('click', async () => {
            if (streaming) {
                stopStreaming();
                liveModal.hide();
            } else {
                await startStreaming();
                liveModal.show();
            }
        });

        async function startStreaming() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                liveVideo.srcObject = stream;
                streaming = true;
                liveVideoButton.innerText = "Stop Video";
                
                frameInterval = setInterval(async () => {
                    captureCanvas.width = liveVideo.videoWidth;
                    captureCanvas.height = liveVideo.videoHeight;
                    ctx.drawImage(liveVideo, 0, 0);
                    
                    const selectedModel = document.getElementById('liveSelectedModel').value;
                    const ModelType = selectedModel;
                    console.log("Live Selected Model: ", ModelType);
                    
                    const blob = await new Promise(resolve => captureCanvas.toBlob(resolve, 'image/jpeg'));
                    const formData = new FormData();
                    formData.append('frame', blob);
                    formData.append('type', ModelType);
                    
                    const response = await fetch(`${apiUrl}/live_frame`, {
                        method: 'POST',
                        body: formData
                    });
                    
                    if (!response.ok) {
                        try {
                            const errorResponse = await response.json();
                            console.error("Backend error:", errorResponse.error);
                        } catch (jsonError) {
                            const text = await response.text();
                            console.error("Backend error (non-JSON):", text);
                        }
                        return;
                    }
                    
                    const annotatedBlob = await response.blob();
                    annotatedResult.src = URL.createObjectURL(annotatedBlob);
                }, 500);
            } catch (err) {
                console.error("Error accessing webcam:", err);
                liveVideoButton.innerText = "Live Unavailable";
                liveVideoButton.disabled = true;
            }
        }

        function stopStreaming() {
            const stream = liveVideo.srcObject;
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
            
            clearInterval(frameInterval);
            streaming = false;
            liveVideoButton.innerText = "Live Video";
        }




        const screenVideo = document.getElementById('screenVideoElement');
        const screenCanvas = document.getElementById('screenCanvas');
        const screenCtx = screenCanvas.getContext('2d');
        const screenResult = document.getElementById('screenAnnotatedResult');
        const screenModelSelect = document.getElementById('screenModelSelect');
        // let screenInterval = null;
        let screenStreaming = false;

        // Attach dropdown model change
        // document.querySelectorAll('.dropdown-menu .dropdown-item').forEach(item => {
        //     item.addEventListener('click', e => {
        //         e.preventDefault();
        //         const selectedModel = item.getAttribute('data-model');
        //         screenModelSelect.value = selectedModel;
        //         document.getElementById('screenModelDropdownBtn').textContent = item.textContent;
        //         console.log("Screen model changed to:", selectedModel);
        //     });
        // });

        // Ensure dropdown works
        document.querySelectorAll('.dropdown-menu .dropdown-item').forEach(item => {
            item.addEventListener('click', e => {
                e.preventDefault();
                const selectedModel = item.getAttribute('data-model');
                screenModelSelect.value = selectedModel;
                document.getElementById('screenModelDropdownBtn').textContent = item.textContent;
            });
        });

        // Stop everything when modal closes
        document.getElementById('screenModal').addEventListener('hidden.bs.modal', () => {
            if (screenStreaming) stopScreenProcessing();
        });

        async function startScreenProcessing() {
            try {
                const stream = await navigator.mediaDevices.getDisplayMedia({ video: true });
                screenVideo.srcObject = stream;

                // Wait until video is ready
                await new Promise(resolve => {
                    screenVideo.onloadedmetadata = () => {
                        screenVideo.play();
                        resolve();
                    };
                });

                screenStreaming = true;

                screenInterval = setInterval(async () => {
                    if (screenVideo.readyState < 2) return;  // Not enough data

                    screenCanvas.width = screenVideo.videoWidth;
                    screenCanvas.height = screenVideo.videoHeight;
                    screenCtx.drawImage(screenVideo, 0, 0);

                    const blob = await new Promise(resolve =>
                        screenCanvas.toBlob(resolve, 'image/jpeg')
                    );

                    const MT = document.getElementById('screenModelSelect').value;
                    const MoTy = MT;
                    console.log("Live Selected Model: ", MoTy);

                    const formData = new FormData();
                    formData.append('frame', blob);
                    formData.append('type', MoTy);

                    console.log("Sending frame to backend with model");

                    const response = await fetch(`${apiUrl}/live_frame`, {
                        method: 'POST',
                        body: formData
                    });

                    if (!response.ok) {
                        try {
                            const err = await response.json();
                            console.error("Backend error:", err.error);
                        } catch {
                            console.error("Backend error (non-JSON):", await response.text());
                        }
                        return;
                    }

                    // console.log("Frame processed successfully");

                    const annotatedBlob = await response.blob();
                    screenResult.src = URL.createObjectURL(annotatedBlob);
                }, 500);
                // 1000 ms	1 FPS
                // 500 ms	2 FPS
                // 100 ms	10 FPS
                // 50 ms	20 FPS
                // 33 ms	30 FPS
                // 20 ms	50 FPS
                // 16 ms	60 FPS	(max screen refresh)

            } catch (err) {
                console.error('Screen capture failed:', err);
                alert('Permission denied or screen capture failed.');
                stopScreenProcessing();

                const screenModal = bootstrap.Modal.getInstance(document.getElementById('screenModal'));
                if (screenModal) screenModal.hide();
            }
        }

        function stopScreenProcessing() {
            clearInterval(screenInterval);
            screenInterval = null;

            const stream = screenVideo.srcObject;
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                screenVideo.srcObject = null;
            }

            screenStreaming = false;
        }


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

