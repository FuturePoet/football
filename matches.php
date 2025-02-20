<?php
// Start the session
session_start();

// Assuming you have set the username and profile image in the session after login
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$profileImage = isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : 'path/to/default/image.jpg';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Predictions</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .app-container {
            width: 90%;
            margin: auto;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
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
        .live-match, .upcoming-matches {
            margin-top: 20px;
        }
        .match-card {
            background: #fff;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            margin-top: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .match-card img {
            width: 50px;
            height: 50px;
        }
        .match-card:hover {
            transform: scale(1.05);
            background:rgb(78, 182, 149);
        }
        .team-logos {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .team-logos img {
            width: 80px;
            height: 80px;
        }
        .score {
            font-size: 24px;
            font-weight: bold;
            margin: 0 10px;
        }
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .section-header a {
            color: #007bff;
            text-decoration: none;
        }
        .section-header a:hover {
            text-decoration: underline;
        }
        .league-selector {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .league-selector span {
            font-size: 20px;
            font-weight: bold;
            color:rgb(144, 0, 255);
        }
        .live-match h2  {
            font-size: 24px;
            font-weight: bold;
            color: red;
        }
        .upcoming-matches h2{
            font-size: 24px;
            font-weight: bold;
            color: green;
        }
        .match-time {
            font-size: 18px;
            color: #333;
        }
        
    </style>
</head>
<body>
    <div class="app-container">
        <header>
        <div class="logo">FSP⚽</div>
        
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
         </header>
        <section class="live-match">
            <h2>Live Match</h2>
            <div class="league-selector">
                <span>Premier League</span>
            </div>
            <div class="match-card live">
                <p class="stadium">St James' Park - Week 13</p>
                <div class="team-logos">
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/c/cc/Chelsea_FC.svg/300px-Chelsea_FC.svg.png" alt="Chelsea">
                    <div class="score"> 0 : 3 </div>
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/a/ac/Leicester_Tigers_logo.svg/263px-Leicester_Tigers_logo.png" alt="Leicester City">
                </div><br>
                <p class="match-time"> 83' 
                </p>
            </div>
        </section>

        <section class="upcoming-matches">
            <div class="section-header">
                <h2>Upcoming Matches</h2>
                <a href="#">See all</a>
            </div>
            
            <div class="match-card">
                <div class="teams">
                <div class="team-logos">

                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/0/0c/Liverpool_FC.svg/270px-Liverpool_FC.svg.png" alt="Liverpool">
                    <h1>    VS </h1>
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/7/7a/Manchester_United_FC_crest.svg/315px-Manchester_United_FC_crest.svg.png" alt="Man United">
                </div>
                </div>
                <p class="match-time">06:30 <br> 30 Dec</p>
            </div>
            
            <div class="match-card">
                <div class="teams">
                <div class="team-logos">

                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/f/f9/Swansea_City_AFC_logo.svg/285px-Swansea_City_AFC_logo.svg.png" alt="Swansea">
                    <h1>VS</h1>
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/b/b4/Tottenham_Hotspur.svg/180px-Tottenham_Hotspur.png" alt="Tottenham">
                </div>
                </div>
                <p class="match-time">06:30 <br> 30 Dec</p>
            </div>
            <div class="match-card">
                <div class="teams">
                <div class="team-logos">

                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/5/53/Arsenal_FC.svg/270px-Arsenal_FC.svg.png" alt="Arsenal">
                    <h1>VS</h1>
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/c/c2/West_Ham_United_FC_logo.svg/263px-West_Ham_United_FC_logo.svg.png" alt="West Ham">
                </div>
                </div>
                <p class="match-time">08:45 <br> 30 Dec</p>
            </div>
            <div class="match-card">
                <div class="teams">
                <div class="team-logos">

                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/e/eb/Manchester_City_FC_badge.svg/300px-Manchester_City_FC_badge.svg.png" alt="Man City">
                    <h1>VS</h1>
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/7/7c/Everton_FC_logo.svg/300px-Everton_FC_logo.svg.png" alt="Everton">
                </div>
                </div>
                <p class="match-time">11:00 <br> 30 Dec</p>
            </div>
            <div class="match-card">
                <div class="teams">
                    <div class="team-logos">
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/9/9a/Aston_Villa_FC_new_crest.svg/225px-Aston_Villa_FC_new_crest.svg.png" alt="Aston Villa">
                    <h1>VS</h1>
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/5/54/Leeds_United_F.C._logo.svg/263px-Leeds_United_F.C._logo.svg.png" alt="Leeds United">
                </div>
                </div>
                <p class="match-time">13:15 <br> 30 Dec</p>
            </div>
            <div class="match-card">
                <div class="teams">
                <div class="team-logos">

                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/5/56/Newcastle_United_Logo.svg/300px-Newcastle_United_Logo.svg.png" alt="Newcastle">
                    <h1>VS</h1>
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/a/a2/Crystal_Palace_FC_logo_%282022%29.svg/263px-Crystal_Palace_FC_logo_%282022%29.svg.png" alt="Crystal Palace">
                </div>
                </div>
                <p class="match-time">15:30 <br> 30 Dec</p>
            </div>
            <div class="match-card">
                <div class="teams">
                <div class="team-logos">

                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/d/d0/Brighton_and_Hove_Albion_FC_crest.svg/285px-Brighton_and_Hove_Albion_FC_crest.svg.png" alt="Brighton">
                    <h1>VS</h1>
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/c/c9/Wolverhampton_Wanderers_FC_crest.svg/300px-Wolverhampton_Wanderers_FC_crest.svg.png" alt="Wolves">
                </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
