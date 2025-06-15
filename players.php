<?php
// Start the session
session_start();

// Assuming you have set the username and profile image in the session after login
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$profileImage = isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : 'path/to/default/image.jpg';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Football Club - Players</title>
    <link rel="stylesheet" type="text/css" href="player.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<style>
* {
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Poppins', sans-serif;
    background: url("images/aimodel.png") no-repeat center center fixed;
    background-size: cover;
    color: #333;
}

.wrapper {
    max-width: 1200px;
    min-height: 350px;
    margin: 0 auto;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.header-left {
    display: flex;
    align-items: center;
}

.header-left img {
    border-radius: 50%;
    width: 50px;
    height: 50px;
    margin-right: 10px;
}

.header-left .username {
    font-size: 18px;
    font-weight: bold;
}

.header h1 {
    flex-grow: 1;
    text-align: center;
    margin: 0;
}

.navigation {
    margin-bottom: 20px;
}

.card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.card {
    flex: 1 1 calc(33.333% - 40px); /* Adjust the percentage as needed */
    max-width: calc(33.333% - 40px); /* Adjust the percentage as needed */
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin: 20px;
    text-align: center;
}

.card img {
    width: 100%;
    height: auto;
    border-bottom: 1px solid #ddd;
}

.card h3 {
    margin: 10px 0;
}

.card p {
    margin: 5px 0;
}

/* File upload section styles */
.upload-section {
    background-color: #f8f9fa;
    border: 2px dashed #dee2e6;
    border-radius: 10px;
    padding: 30px;
    margin-bottom: 30px;
    text-align: center;
    transition: all 0.3s ease;
}

.upload-section:hover {
    border-color: #4f29f0;
    background-color: #f0f8ff;
}

.upload-section h3 {
    color: #333;
    margin-bottom: 15px;
}

.file-input-wrapper {
    position: relative;
    display: inline-block;
    margin: 10px;
}

.file-input {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.file-input-label {
    display: inline-block;
    padding: 12px 24px;
    background-color: #4f29f0;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-weight: 500;
}

.file-input-label:hover {
    background-color: #3d1fcc;
}

.upload-btn {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: 500;
    margin-left: 10px;
    transition: background-color 0.3s ease;
}

.upload-btn:hover {
    background-color: #218838;
}

.upload-btn:disabled {
    background-color: #6c757d;
    cursor: not-allowed;
}

.file-info {
    margin-top: 15px;
    padding: 10px;
    background-color: #e9ecef;
    border-radius: 5px;
    display: none;
}

@media (max-width: 768px) {
    .card {
        flex: 1 1 calc(50% - 40px);
        max-width: calc(50% - 40px);
    }
    
    .file-input-label, .upload-btn {
        display: block;
        margin: 10px 0;
        width: 100%;
    }
}

@media (max-width: 480px) {
    .card {
        flex: 1 1 100%;
        max-width: 100%;
    }
}

    #wifi-loader {
        --background: #62abff;
        --front-color: #4f29f0;
        --back-color: #c3c8de;
        --text-color: #414856;
        width: 100%;
        height: 64px;
        margin-top: 60px;
        border-radius: 50px;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #wifi-loader svg {
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #wifi-loader svg circle {
        position: absolute;
        fill: none;
        stroke-width: 6px;
        stroke-linecap: round;
        stroke-linejoin: round;
        transform: rotate(-100deg);
        transform-origin: center;
    }

    #wifi-loader svg circle.back {
        stroke: var(--back-color);
    }

    #wifi-loader svg circle.front {
        stroke: var(--front-color);
    }

    #wifi-loader svg.circle-outer {
        height: 86px;
        width: 86px;
    }

    #wifi-loader svg.circle-outer circle {
        stroke-dasharray: 62.75 188.25;
    }

    #wifi-loader svg.circle-outer circle.back {
        animation: circle-outer135 1.8s ease infinite 0.3s;
    }

    #wifi-loader svg.circle-outer circle.front {
        animation: circle-outer135 1.8s ease infinite 0.15s;
    }

    #wifi-loader svg.circle-middle {
        height: 60px;
        width: 60px;
    }

    #wifi-loader svg.circle-middle circle {
        stroke-dasharray: 42.5 127.5;
    }

    #wifi-loader svg.circle-middle circle.back {
        animation: circle-middle6123 1.8s ease infinite 0.25s;
    }

    #wifi-loader svg.circle-middle circle.front {
        animation: circle-middle6123 1.8s ease infinite 0.1s;
    }

    #wifi-loader svg.circle-inner {
        height: 34px;
        width: 34px;
    }

    #wifi-loader svg.circle-inner circle {
        stroke-dasharray: 22 66;
    }

    #wifi-loader svg.circle-inner circle.back {
        animation: circle-inner162 1.8s ease infinite 0.2s;
    }

    #wifi-loader svg.circle-inner circle.front {
        animation: circle-inner162 1.8s ease infinite 0.05s;
    }

    #wifi-loader .text {
        position: absolute;
        bottom: -40px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-transform: lowercase;
        font-weight: 500;
        font-size: 14px;
        letter-spacing: 0.2px;
    }

    #wifi-loader .text::before, #wifi-loader .text::after {
        content: attr(data-text);
    }

    #wifi-loader .text::before {
        color: var(--text-color);
    }

    #wifi-loader .text::after {
        color: var(--front-color);
        animation: text-animation76 3.6s ease infinite;
        position: absolute;
        left: 0;
    }

    @keyframes circle-outer135 {
        0% {
            stroke-dashoffset: 25;
        }

        25% {
            stroke-dashoffset: 0;
        }

        65% {
            stroke-dashoffset: 301;
        }

        80% {
            stroke-dashoffset: 276;
        }

        100% {
            stroke-dashoffset: 276;
        }
    }

    @keyframes circle-middle6123 {
        0% {
            stroke-dashoffset: 17;
        }

        25% {
            stroke-dashoffset: 0;
        }

        65% {
            stroke-dashoffset: 204;
        }

        80% {
            stroke-dashoffset: 187;
        }

        100% {
            stroke-dashoffset: 187;
        }
    }

    @keyframes circle-inner162 {
        0% {
            stroke-dashoffset: 9;
        }

        25% {
            stroke-dashoffset: 0;
        }

        65% {
            stroke-dashoffset: 106;
        }

        80% {
            stroke-dashoffset: 97;
        }

        100% {
            stroke-dashoffset: 97;
        }
    }

    @keyframes text-animation76 {
        0% {
            clip-path: inset(0 100% 0 0);
        }

        50% {
            clip-path: inset(0);
        }

        100% {
            clip-path: inset(0 0 0 100%);
        }
    }


</style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="header-left">
                <!-- <img src="<?php echo htmlspecialchars($profileImage); ?>" alt="User Image"> -->
                <span class="username"><?php echo htmlspecialchars($username); ?></span>
            </div>
            <h1>FSP WEBSITE</h1>
        </div>
        <div class="navigation">
            <ul class="nav nav-pills">
                <li role="presentation"><a href="home.php">Home</a></li>
                <li role="presentation"><a href="subscribe.php">Get Premium</a></li>
                <li role="presentation"><a href="matches.php">Matches</a></li>
                <li role="presentation"><a href="upload.php">Try our Model</a></li>
                <li role="presentation"><a class="active" href="players.php">Players</a></li>
                <li role="presentation"><a href="https://friendlychat-541c2.firebaseapp.com/">Fans Section</a></li>
                <li role="presentation"><a href="contact.php">Contact Us</a></li>
            </ul>
        </div>

        <!-- File Upload Section -->
        <div class="upload-section">
            <h3>Upload Custom Player Data</h3>
            <p>Select an Excel file (.xlsx, .xls) to analyze player data with our AI model</p>
            
            <div class="file-input-wrapper">
                <input type="file" id="excelFile" class="file-input" accept=".xlsx,.xls" />
                <label for="excelFile" class="file-input-label">Choose Excel File</label>
            </div>
            
            <button id="uploadBtn" class="upload-btn" disabled>Upload & Analyze</button>
            
            <div id="fileInfo" class="file-info">
                <strong>Selected file:</strong> <span id="fileName"></span>
            </div>
        </div>

        <div id="wifi-loader">
            <svg class="circle-outer" viewBox="0 0 86 86">
                <circle class="back" cx="43" cy="43" r="40"></circle>
                <circle class="front" cx="43" cy="43" r="40"></circle>
                <circle class="new" cx="43" cy="43" r="40"></circle>
            </svg>
            <svg class="circle-middle" viewBox="0 0 60 60">
                <circle class="back" cx="30" cy="30" r="27"></circle>
                <circle class="front" cx="30" cy="30" r="27"></circle>
            </svg>
            <svg class="circle-inner" viewBox="0 0 34 34">
                <circle class="back" cx="17" cy="17" r="14"></circle>
                <circle class="front" cx="17" cy="17" r="14"></circle>
            </svg>
            <div class="text" data-text="Loading"></div>
        </div>

        <div id="PlTable" class="container">
            <table class="table table-hover table-striped">
                <thead class="fs-4">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Player Name</th>
                    <th scope="col">Play Probability (%)</th>
                    </tr>
                </thead>
                <tbody id="TBODY" class="fs-5">
                </tbody>
            </table>
        </div>

    </div>
    <script>
        const apiUrl = "https://76b3-34-87-242-29.ngrok-free.app/BModel";

        const Loder = document.getElementById('wifi-loader')
        const PlTable = document.getElementById('PlTable')
        const TBODY = document.getElementById('TBODY')
        const excelFileInput = document.getElementById('excelFile')
        const uploadBtn = document.getElementById('uploadBtn')
        const fileInfo = document.getElementById('fileInfo')
        const fileName = document.getElementById('fileName')
        let d = 1

        PlTable.classList.add('d-none')
        Loder.classList.remove('d-none')

        // File input change handler
        excelFileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file type
                const validTypes = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'];
                const fileExtension = file.name.split('.').pop().toLowerCase();
                
                if (validTypes.includes(file.type) || ['xlsx', 'xls'].includes(fileExtension)) {
                    fileName.textContent = file.name;
                    fileInfo.style.display = 'block';
                    uploadBtn.disabled = false;
                } else {
                    alert('Please select a valid Excel file (.xlsx or .xls)');
                    e.target.value = '';
                    fileInfo.style.display = 'none';
                    uploadBtn.disabled = true;
                }
            } else {
                fileInfo.style.display = 'none';
                uploadBtn.disabled = true;
            }
        });

        // Upload button click handler
        uploadBtn.addEventListener('click', function() {
            const file = excelFileInput.files[0];
            if (file) {
                uploadExcelFile(file);
            }
        });

        function renderdata(Players) {
            TBODY.innerHTML = '';
            d = 1; // Reset counter
            Players.forEach(TRPlayer => {
                const Player = document.createElement('tr');
                Player.innerHTML = `
                <td>${d}</td>
                <td>${TRPlayer['Name']}</td>
                <td>${TRPlayer['Play Probability (%)']}</td>
                `;
                d = d + 1;
                TBODY.appendChild(Player);
            });
            Loder.classList.add('d-none')
            PlTable.classList.remove('d-none')
            
            excelFileInput.value = ''; // Clear the file input
            fileInfo.style.display = 'none'; // Hide file info
            uploadBtn.disabled = true; // Disable upload button
        }

        async function uploadExcelFile(file) {
            try {
                // Show loader
                PlTable.classList.add('d-none')
                Loder.classList.remove('d-none')
                
                // Create FormData
                const formData = new FormData();
                formData.append('data', file);
                
                const response = await fetch(apiUrl, {
                    method: 'POST',
                    mode: 'cors',
                    headers: {
                        'ngrok-skip-browser-warning': 'true' // Add this header for ngrok
                    },
                    body: formData
                });
                
                console.log("Excel Upload Response", response);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                console.log('Excel Upload Return: ', data);
                renderdata(data);
                
            } catch (error) {
                console.error('Error uploading Excel file:', error);
                alert('Error uploading file. Please try again.');
                Loder.classList.add('d-none')
                PlTable.classList.remove('d-none')
            }
        }

        async function BDATA () {
            try {
                const response = await fetch(apiUrl, {
                    method: 'POST',
                    mode: 'cors',
                    headers: {
                        'Content-Type': 'application/json',
                        'ngrok-skip-browser-warning': 'true'
                    },
                    body: JSON.stringify({'test': "test"}),
                });
                console.log("ResUP", response);
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                const data = await response.json();
                console.log('ReturnUP: ', data);
                renderdata(data);
            } catch (error) {
                console.error('Error', error);
                // Hide loader on error
                Loder.classList.add('d-none')
                PlTable.classList.remove('d-none')
            }
        }

        window.onload = function() {
            BDATA();
        }

    </script>
</body>
</html>