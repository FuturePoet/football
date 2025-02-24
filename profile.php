<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="football/images/logo.jpg" type="image/jpg" style="background-color:(#000000,#434343);redius:50%;">
    <title>FSP Website</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="google-site-verification" content="uU3ATrc7MD6evWJv7dRbuLE7O8wZz8n7GFiftx7F7gg" />
   <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Times New Roman', serif;
}

body {
    background: white;
    color:black ;
    display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            font-family: Arial, sans-serif;
            cursor: url('images/football-cursor.png'), auto; /* Custom cursor */
            transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
}
        
        .wrapper {
            width: 90%;
            margin: 0 auto;
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
        .header-left {
            display: flex;
            align-items: center;
        }
        .header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
            cursor: pointer;
        }
        .header .username {
            font-size: 1.5rem;
            color: #333;
        }
        .logout-button {
            background-color: #d9534f;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .logout-button:hover {
            background-color: #c9302c;
        }
        .navigation ul {
            list-style-type: none;
            padding: 10px;
            margin: 10px;
            display: flex;
            justify-content: center;
            font-weight: bold;
            font-size:35px;
            background-color: #101010;

        }
        .navigation ul li {
            margin: 0 10px;
            font-weight: bold;

        }
        .navigation ul li a {
            text-decoration: none;
            color: #fffefe;
            font-size: 1.1rem;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .navigation ul li a:hover,
        .navigation ul li a.active {
            background: linear-gradient(135deg, #5d77c5, #ffb6a3, #0048ff);
            color: #000000;
        }
        .content {
            display: flex;
            justify-content: space-between;
        }
      
        .main-content {
            width: 100%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
            border-radius: 10px;
            width: 100%;
        }
        .container {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            justify-content: center;
            background: linear-gradient(135deg, #5d77c5, #ffb6a3, #0048ff);
            width: 100%;
        }
        .card {
            width: 350px;
            background-color: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s; /* Add transition for animation */
            padding: 20px;
            margin-top: 40px;
            margin-bottom: 40px;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3); /* Enhance hover effect */
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card-content {
            padding: 20px;
        }
        .card h4 {
            color: #555;
        }
        .card h2 {
            font-size: 25px;
            margin: 10px 0;
        }
        .card p {
            font-size: 14px;
            color: #777;
        }
        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            border-top: 1px solid #ddd;
        }
        .like-btn {
            background: none;
            border: none;
            font-size: 30px;
            cursor: pointer;
            transition: 0.3s;
        }
        .like-btn:hover {
            color: red;
        }
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        /* SERVICES SECTION */
        .services {
            text-align: center;
            padding: 50px;
            background: linear-gradient(135deg, #5d77c5, #ffb6a3, #0048ff);
            color: black;
        }
        .services h2 {
            font-weight: bold;
            font-size: 40px;
            margin-bottom: 20px;
        }
        .services-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .service-box {
            background: white;
            padding: 20px;
            border: 1px solid black;
            width: 350px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s; /* Add transition for animation */
        }
        .service-box:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3); /* Enhance hover effect */
        }
        .service-box h3 {
            margin-bottom: 10px;
            color:rgba(188, 42, 37, 0.72);
            font-weight: bold;


        }
        .service-box button {
            padding: 8px 15px;
            background: white;
            color: rgba(188, 42, 37, 0.72);
            border: 1px solid black;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s; /* Add transition for animation */
            font-weight: bold;

        }
        .service-box button:hover {
            background: black;
            color: white;
            transform: scale(1.05); /* Enhance hover effect */
        }
        /* EVENT DETAILS SECTION */
        .event-details {
            padding: 50px;
            text-align: center;
            background: white;
            font-weight: bold;

        }
        .event-details h2{
            font-size:45px;
            font-weight: bold;

        }
        .event-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            border: 3px solid black;
            padding: 60px;
            max-width: 1050px;
            margin: auto;
            line-height: 2;

        }
        .event-info {
            text-align: left;
            flex: 1;
        }
        .event-info h3 {
            font-weight: bold;
            font-size: 30px;
            margin-bottom: 10px;
        }
        .event-info p {
            font-size: 20px;
            margin-bottom: 8px;
        }
        .details-btn {
            padding: 15px 25px;
            background: black;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s; /* Add transition for animation */
        }
        .details-btn:hover {
            background: gray;
            transform: scale(1.05); /* Enhance hover effect */
        }
        .event-image img {
            width: 500px;
            height: auto;
        }
        /* ABOUT OUR MISSION */
        .about-mission {
            padding: 60px 5%;
        }
        .about-mission h2 {
            font-size: 30px;
            text-align: left;
            margin-bottom: 20px;
        }
        .about-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 30px;
            text-align: left;
        }
        .about-image {
            width: 500px;
            height: auto;
        }
        .about-text {
            max-width: 500px;
        }
        .about-text span {
            font-size: 20px;
            margin-bottom: 15px;
            line-height: 2;

        }
        .learn-more {
            padding: 10px 20px;
            border: 1px solid black;
            background: transparent;
            cursor: pointer;
            transition: 0.3s, transform 0.3s; /* Add transition for animation */
        }
        .learn-more:hover {
            background: black;
            color: white;
            transform: scale(1.05); /* Enhance hover effect */
        }
        /* FOOTBALL STAR PREDICTOR SECTION */
        .football-star {
            position: relative;
            width: 100%;
            max-width: 900px;
            margin: 30px auto;
        }
        .football-star img {
            width: 100%;
            height: auto;
        }
        .overlay {
            position: absolute;
            top: 50%;
            left: 10%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.3);
            padding: 20px;
            color: black;
            font-size: 20px;
            font-weight: bold;
        }
        /* CONTACT INFORMATION */
        footer {
            text-align: right;
            padding: 20px 5%;
            font-size: 14px;
        }
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Georgia', serif;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Georgia', serif;
}

body {
    transition: background 0.3s ease-in-out;
}

.hero {
    display: flex;
    justify-content: left;
    align-items: left;
    position: relative;
    width: 100%;
    height: 70vh;
    background: url('images/welcome.avif') no-repeat center center/cover;
    border-radius: 10px;
    animation: fadeIn 2s ease-in-out; /* Add fade-in animation */
}

.hero-text {
    
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: white;
}

h1 {
    font-size: 35px;
    font-weight: bold;
    line-height: 2;
}

p {
    font-size: 2rem;
    width: 40%;
}

#darkModeToggle {
    position: fixed;
    top: 10px;
    left: 10px;
    background: black;
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    border-radius: 50%;
}


body.dark-mode {
    background: #111;
    color: #ddd;
}

.dark-mode .header, .dark-mode .main-content, .dark-mode .footer, .dark-mode .service-box, .dark-mode .card, .dark-mode .event-details, .dark-mode .about-mission {
    background-color: #333;
    color: #ddd;
}

.dark-mode .navigation ul {
    background-color: #222;
}

.dark-mode .navigation ul li a {
    color: #ddd;
}

.dark-mode .navigation ul li a:hover,
.dark-mode .navigation ul li a.active {
    background: linear-gradient(135deg, #444, #666, #888);
    color: #fff;
}

.dark-mode .details-btn, .dark-mode .learn-more, .dark-mode .service-box button {
    background: #444;
    color: #ddd;
}

.dark-mode .details-btn:hover, .dark-mode .learn-more:hover, .dark-mode .service-box button:hover {
    background: #555;
    color: #fff;
}
.dark-mode .hero {
    filter: brightness(0.5);
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.hero-text span {
    opacity: 0;
    display: inline-block;
    animation: fadeInWord 0.5s forwards;
}

@keyframes fadeInWord {
    to {
        opacity: 1;
    }
}
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1 style="text-align:center;">FSP WEBSITE <img src="images/logo.jpg"></h1>
            <button class="logout-button" onclick="window.location.href='Login.php'">Login</button>
            <button id="darkModeToggle">🌙</button>

        </div>
        <div class="navigation">
            <ul class="nav nav-pills">
                <li role="presentation" class="active"><a href="home.php">Home</a></li>
                <li role="presentation"><a href="#services">Services</a></li>
                <li role="presentation"><a href="#event-details">Event Details</a></li>
                <li role="presentation"><a href="#future-models">Future Models</a></li>
                <li role="presentation"><a href="#about-mission">About Our Mission</a></li>
                <li role="presentation"><a href="register.php">Join To Us</a></li>
            </ul>
        </div>
      
        <header class="hero">
        <div class="hero-text" style="text-align:left;margin-left:20px;margin-top:40px;line-height: 2;">
            <h1>EXPLORE<br>FOOTBALL<br>WORLD</h1><br>
            <p style="font-size:15px;">Welcome to Football Star Predictor, where AI meets football to provide valuable insights 
                and recommendations for clubs seeking emerging talent.</p>
            <button><a style="font-size:20px;padding:3px;" href="register.php">Join To Us</a></button>
    
        </div>
    </header>
    <br>
        <br>
        <br>
            <div class="main-content">
                <!-- SERVICES SECTION -->
                <section class="services" id="services">
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
                <br>
        <br>
        <br>
                <!-- EVENT DETAILS SECTION -->
                <section class="event-details" id="event-details">
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
                <section id="future-models">
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
        <br>
        <br>
        <br>
        <!-- ABOUT OUR MISSION SECTION -->
        <section class="about-mission" id="about-mission">
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
        <br>
        <br>
        <br>
        <!-- FOOTBALL STAR PREDICTOR SECTION -->

        <div class="footer">
            <p>Developed by:<br>
            Zeinab Salah | FCAI| IS</p>
        </div>
    <script >

function getAIResponse(message) {
    // This is a placeholder function. Replace with actual API call to AI model.
    return 'This is a response to "' + message + '".';
}
$(document).ready(function(){
    $('.carousel').carousel({
        interval: 2000 
    });
});  
const darkModeToggle = document.getElementById('darkModeToggle');

darkModeToggle.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    if (document.body.classList.contains('dark-mode')) {
        darkModeToggle.textContent = '☀️'; // Change to sun icon for light mode
    } else {
        darkModeToggle.textContent = '🌙'; // Change to moon icon for dark mode
    }
});
    </script>
</body>
</html>