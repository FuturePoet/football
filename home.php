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
    <link rel="icon" href="images/logo.jpg" type="image/jpg" style="background-color:(#000000,#434343);redius:50%;">
    <title>FSP Website</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="home.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="google-site-verification" content="uU3ATrc7MD6evWJv7dRbuLE7O8wZz8n7GFiftx7F7gg" />
</head>
<body>
    
    <div class="wrapper">
        <div class="header">
            
            <div class="header-left">
                <img src="<?php echo htmlspecialchars($profileImage); ?>" alt="User Image" onclick="window.location.href='update_profile.php'">
                <span class="username"><?php echo htmlspecialchars($username); ?></span>
            </div>
            <h1 style="text-align:center;"> FSP WEBSITE</h1>
            <button class="logout-button" onclick="window.location.href='logout.php'">Logout</button>
        </div>
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
        <header class="hero" >
        <button id="darkModeToggle">🌙</button>
        <div class="hero-text" style="text-align:left;margin-left:20px;margin-top:40px;line-height: 2;">
            <h1 id="welcomeText">Welcome To<br>FSP <br>Website</h1><br>
            
            <p style="font-size:15px;"> Football Star Predictor, where AI meets football to provide valuable insights 
                and recommendations for clubs seeking emerging talent.</p>
        </div>
    </header>
            <div class="main-content">
                <!-- SERVICES SECTION -->
                <section class="services">
                    <h2 >SERVICES With Our AI Modek</h2><br>
                    <div class="services-container">
                        <div class="service-box">
                            <h3>Analytics Dashboard</h3><br>
                            <span style="text-align:left;">Gain insights into player performance, team dynamics, and match statistics with our comprehensive analytics dashboard.</span>
                            <h4>199 US$</h4><br>
                            <a href="subscribe.php"><button>Get Premium</button></a>
                        </div>
                        <div class="service-box">
                           <h3>Injury Prediction</h3><br>
                            <span style="text-align:left;">Utilize our AI-driven injury prediction model to minimize risks and enhance player safety by forecasting potential injuries.</span>
                            <h4>300 US$</h4><br>
                            <a href="subscribe.php"><button>Get Premium</button></a>
                        </div>
                        <div class="service-box">
                            <h3>Talent Discovery</h3><br>
                            <span style="text-align:left;">Discover emerging football talent with our advanced AI algorithms that analyze player performance and potential.</span>
                            <h4>150 US$</h4><br>
                            <a href="subscribe.php"><button>Get Premium</button></a>
                        </div>
                    </div>
                </section>

                <!-- EVENT DETAILS SECTION -->
                <section class="event-details">
                    <h2 style="font-size:45px;font-weight: bold;color:rgba(188, 42, 37, 0.72);margin-bottom: 20px;">EVENT DETAILS</h2><br>
                    <br>
                    <div class="event-container">
                        <div class="event-info">
                            <h3>AI in Football: Future of Talent Scouting</h3>
                            <p>📅 2025-03-18</p>
                            <p>📍 Wembley Stadium, London, UK</p>
                            <button class="details-btn">Details</button>
                        </div>
                        <div class="event-image">
                            <img src="images/aimodel.png" alt="Event Image">
                        </div>
                    </div>
                </section>
                <br>
                <section>
                <h2 style="font-size:45px;font-weight: bold;color:rgba(188, 42, 37, 0.72);margin-bottom: 20px;">The Future Models</h2><br>
                <br>
                <div class="container">
                    <div class="card">
                        <img src="images/flog1.png" alt="AI in Football">
                        <div class="card-content">
                            <h2>Maximize Player Performance: AI Insights for Football Clubs</h2><br><br>
                            <span>When it comes to identifying future football stars and maximizing player performance, clubs are constantly on the lookout for innovative...</span>
                            <div class="card-footer">
                                <span>👁️ 0</span>
                                <button class="like-btn">❤️</button>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <img src="images/flog2.png" alt="AI in Football">
                        <div class="card-content">
                            <h2>Revolutionize Football Talent Scouting with AI Predictions</h2><br><br>
                            <span>In the fast-paced world of football, staying ahead of the competition is crucial. With advancements in technology, the game is evolving...</span>
                          <br><br>  <div class="card-footer">
                                <span>👁️ 0</span>
                                <button class="like-btn">❤️</button>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <img src="images/flog3.png" alt="AI in Football">
                        <div class="card-content">
                            <h2>Injury Prediction and Talent Discovery: AI in Football Analysis</h2><br><br>
                            <span>As technology continues to revolutionize the sports industry, a groundbreaking project known as Football Star Predictor (FSP) is set to...</span>
                            <br><br> <div class="card-footer">
                                <span>👁️ 0</span>
                                <button class="like-btn">❤️</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>

        <!-- ABOUT OUR MISSION SECTION -->
        <section class="about-mission">
            <h2 style="font-size:45px;font-weight: bold;color:rgba(188, 42, 37, 0.72);margin-bottom: 20px;">ABOUT OUR MISSION</h2>
            <div class="about-container">
                <img src="images/mission.png" alt="Kids Playing Football" class="about-image">
                <div class="about-text">
                    <span>At Football Star Predictor, we are dedicated to revolutionizing talent scouting and player management in football. Our AI-driven platform offers talent discovery, injury prediction, analytics, educational content, and a vibrant community forum.</span>
                    <br>
                    <br>
                    <br>
                    <button class="learn-more">Learn More</button>
                </div>
            </div>
        </section>

        <!-- FOOTBALL STAR PREDICTOR SECTION -->

        <div class="footer">
            <p>Developed by:<br>
            Zeinab Salah | FCAI| IS</p>
        </div>
    <script src="home.js"></script>
</body>
</html>