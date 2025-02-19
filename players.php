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
<style>
* {
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Poppins', sans-serif;
    background: url("images/Background.jpg") no-repeat center center fixed;
    background-size: cover;
    color: #333;
}

.wrapper {
    max-width: 1200px;
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

@media (max-width: 768px) {
    .card {
        flex: 1 1 calc(50% - 40px);
        max-width: calc(50% - 40px);
    }
}

@media (max-width: 480px) {
    .card {
        flex: 1 1 100%;
        max-width: 100%;
    }
}
</style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="header-left">
                <img src="<?php echo htmlspecialchars($profileImage); ?>" alt="User Image">
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
        <div class="card-container">
            <!-- Add your card elements here -->
            <div class="card">
                <img src="https://th.bing.com/th/id/R.5bbd42b9191111fb6d1ea30e6b7ad562?rik=gbZJrYLOLNNuag&pid=ImgRaw&r=0" alt="Mohamed Salah">
                <h3>Mohamed Salah</h3>
                <p>Position: Forward</p>
                <p>Age: 29</p>
                <p>Nationality: Egypt</p>
            </div>
            <div class="card">
                <img src="https://th.bing.com/th/id/OIP.Ch9NbCdTluY1N4QyGj3BPgHaE7?rs=1&pid=ImgDetMain" alt="Trezeguet">
                <h3>Trezeguet</h3>
                <p>Position: Midfielder</p>
                <p>Age: 27</p>
                <p>Nationality: Egypt</p>
            </div>
            <div class="card">
                <img src="https://th.bing.com/th/id/OIP.rLmN-7-Peh4oRYXoLMTlVAHaHa?rs=1&pid=ImgDetMain" alt="Ahmed Hegazi">
                <h3>Ahmed Hegazi</h3>
                <p>Position: Defender</p>
                <p>Age: 30</p>
                <p>Nationality: Egypt</p>
            </div>
            <div class="card">
                <img src="https://th.bing.com/th/id/OIP.S4ty7l8bbvTCoflEVS0mdAHaE8?rs=1&pid=ImgDetMain" alt="Essam El-Hadary">
                <h3>Essam El-Hadary</h3>
                <p>Position: Goalkeeper</p>
                <p>Age: 48</p>
                <p>Nationality: Egypt</p>
            </div>
            <!-- Add more cards as needed -->
        </div>
    </div>
</body>
</html>