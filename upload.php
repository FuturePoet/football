<?php
// Start the session
session_start();

// Assuming you have set the username in the session after login
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if a file is uploaded
    if (isset($_FILES['video']) && $_FILES['video']['error'] == 0) {
        // Define the upload directory
        $uploadDir = 'uploads/';
        // Define the upload file path
        $uploadFile = $uploadDir . basename($_FILES['video']['name']);

        // Move the uploaded file to the upload directory
        if (move_uploaded_file($_FILES['video']['tmp_name'], $uploadFile)) {
            // File uploaded successfully
            $message = 'Video uploaded successfully.';

            // Send the video to Roboflow
            $apiKey = 'DNYKZgnl33b5Mmi12jfr';
            $modelId = 'football-players-detection-3zvbc/12';
            $uploadUrl = "https://api.roboflow.com/dataset/$modelId/upload";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $uploadUrl);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, [
                'api_key' => $apiKey,
                'name' => $_FILES['video']['name'],
                'split' => 'train',
                'file' => new CURLFile($uploadFile)
            ]);

            $response = curl_exec($ch);
            curl_close($ch);

            if ($response) {
                $responseData = json_decode($response, true);
                if (isset($responseData['url'])) {
                    $message .= ' Video sent to Roboflow successfully.';
                    echo "<script>alert('Video uploaded and sent to Roboflow successfully.'); window.location.href='home.php';</script>";
                    exit();
                } else {
                    $message .= ' Failed to get annotated video URL from Roboflow.';
                }
            } else {
                $message .= ' Failed to send video to Roboflow.';
            }
        } else {
            // Failed to upload file
            $message = 'Failed to upload video.';
        }
    } else {
        // No file uploaded or upload error
        $message = 'No video uploaded or upload error.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Football Club - Upload Video</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="google-site-verification" content="uU3ATrc7MD6evWJv7dRbuLE7O8wZz8n7GFiftx7F7gg" />
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .wrapper {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .header {
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .navigation ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .navigation ul li {
            margin: 0 10px;
        }
        .navigation ul li a {
            text-decoration: none;
            color: #333;
            font-size: 1.1rem;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .navigation ul li a:hover,
        .navigation ul li a.active {
            background-color: #007BFF;
            color: #fff;
        }
        .content {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007BFF;
            border-color: #007BFF;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">FOOTBALL CLUB WEBSITE</div>
        <div class="navigation">
            <ul class="hor">
                <li><a href="home.php">Home</a></li>
                <li><a href="subscribe.php">Get Premium</a></li>
                <li><a href="matches.php">Matches</a></li>
                <li><a class="active" href="upload.php">Try our Model</a></li>
                <li><a href="players.php">Players</a></li>
                <li><a href="https://friendlychat-541c2.firebaseapp.com/">Fans Section</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </div>
        <div class="content">
            <h2 class="text-center">Upload Your Football Video</h2>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="video">Select video to upload:</label>
                    <input type="file" name="video" id="video" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload Video</button>
            </form>
            <?php if (isset($message) && !empty($message)): ?>
                <div class="alert alert-info"><?php echo $message; ?></div>
            <?php endif; ?>
        </div>
        <div class="footer">
            <p>Developed by:<br>
           Zeinab Salah | FCAI| IS</p>
        </div>
    </div>
</body>
</html>