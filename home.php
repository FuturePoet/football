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
    <title>Football Club - Home</title>
    <link rel="stylesheet" type="text/css" href="home.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .wrapper {
            width: 80%;
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
            padding: 0;
            display: flex;
            justify-content: center;
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
            display: flex;
            justify-content: space-between;
        }
        .left-sidebar {
            width: 20%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .main-content {
            width: 75%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .carousel-inner .item img {
            margin: 0 auto;
            transition: transform 0.5s ease-in-out;
        }
        .carousel-inner .item:hover img {
            transform: scale(1.05);
        }
        .news ul {
            list-style-type: none;
            padding: 0;
        }
        .news ul li {
            margin: 10px 0;
            transition: transform 0.3s ease-in-out;
        }
        .news ul li:hover {
            transform: translateX(10px);
        }
        .livescore, .computer-vision, .ai-in-sports, .football-game {
            margin: 20px 0;
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
        <div class="header">
            <div class="header-left">
                <img src="<?php echo htmlspecialchars($profileImage); ?>" alt="User Image" onclick="window.location.href='update_profile.php'">
                <span class="username"><?php echo htmlspecialchars($username); ?></span>
            </div>
            <h1 style="text-align:center;">FSP WEBSITE</h1>
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
        <div class="content">
            <div class="left-sidebar">
                <h3>Latest Football News</h3>
                <ul>
                    <li><a href="https://www.msn.com/en-gb/sport/football/manchester-united-injury-update-mazraoui-garnacho-diallo-ugarte-and-mainoo-latest-news-and-return-dates/ar-AA1siyNo"><b>Manchester United faces injury concerns ahead of big match.</b></a></li>
                    <li><a href="https://www.sportskeeda.com/football/5-players-match-winning-goals-season-2021-22-salah-ronaldo#:~:text=5%20players%20with%20the%20most%20match-winning%20goals%20this,%235.%20Robert%20Lewandowski%20%7C%206%20winning%20goals%20"><b>Top 5 footballers with the most goals this season.</b></a></li>
                    <li><a href="https://www.skysports.com/football/transfer-news"><b>Breaking: Major transfer news updates from Europe.</b></a></li>
                    <li><a href="https://www.goal.com/en/news/real-madrid-vs-barcelona-el-clasico-preview/blt1234567890"><b>Real Madrid vs Barcelona: El Clasico Preview.</b></a></li>
                    <li><a href="https://www.bbc.com/sport/football/teams/liverpool"><b>Liverpool's comeback victory in the Champions League.</b></a></li>
                    <li><a href="https://www.espn.com/soccer/"><b>Top 10 goals of the season so far.</b></a></li>
                    <li><a href="https://www.fifa.com/news"><b>FIFA announces new regulations for upcoming World Cup.</b></a></li>
                    <li><a href="https://www.skysports.com/football/news"><b>Breaking: Major transfer news updates from Europe.</b></a></li>
                    <li><a href="https://www.uefa.com/uefachampionsleague/news/"><b>UEFA Champions League: Latest News and Highlights.</b></a></li>
                    <li><a href="https://www.bundesliga.com/en/bundesliga/news"><b>Bundesliga: Top Stories and Match Reports.</b></a></li>
                    <li><a href="https://www.mlssoccer.com/news/"><b>MLS: Latest Updates and Player Transfers.</b></a></li>
                    <li><a href="https://www.laliga.com/en-GB/news"><b>La Liga: Recent Matches and Player Performances.</b></a></li>
                    <li><a href="https://www.premierleague.com/news"><b>Premier League: Breaking News and Analysis.</b></a></li>
                </ul>
            </div>
            <div class="main-content">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>
                    
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="https://th.bing.com/th/id/R.938cf4b082b8a7293c59e2fc0a487a97?rik=5ioQSyTyUSBwPA&riu=http%3a%2f%2fs1.picswalls.com%2fwallpapers%2f2014%2f07%2f25%2fawesome-football-wallpaper_041156919_96.jpg&ehk=Y7WkbzNtwzHh4%2b79xuCGzboA2Q0GhJvFcEb4RAofSOw%3d&risl=&pid=ImgRaw&r=0" alt="Football Image 1">
                            <div class="carousel-caption">
                                <h3>Exciting Matches</h3>
                                <p>Experience the thrill of live football matches.</p>
                            </div>
                        </div>
                        <div class="item">
                            <img src="https://th.bing.com/th/id/OIP.8vVGIjjTgefKtCunN_zB6wHaEJ?w=840&h=470&rs=1&pid=ImgDetMain" alt="Football Image 2">
                            <div class="carousel-caption">
                                <h3>Latest Updates</h3>
                                <p>Stay updated with the latest football news.</p>
                            </div>
                        </div>
                        <div class="item">
                            <img src="https://th.bing.com/th/id/R.87b3641080b3167a1a8609491b1e0cc5?rik=6CA3yf2m79X2BQ&pid=ImgRaw&r=0" alt="Football Image 3">
                            <div class="carousel-caption">
                                <h3><a href="register.php">Join the Community</a></h3>
                                <p>Connect with other football fans.</p>
                            </div>
                        </div>
                    </div>
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                
                <div class="livescore">
                    <h2 class="text-center">Live Scores</h2>
                    <iframe width="722" height="406" src="https://www.youtube.com/embed/7uUmZA_8x8c" title="Football Matches live scores and results" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>            
                </div>
                <div class="computer-vision">
                    <h2 class="text-center">Computer Vision in Football</h2>
                    <h3>Computer vision technology is revolutionizing the way football is analyzed and played. From tracking player movements to analyzing game strategies, computer vision provides valuable insights that help teams improve their performance.</h3>
                    <iframe width="722" height="406" src="https://www.youtube.com/embed/kNOjNlUUrps" title="The role of AI in sports [1.19.]" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>            
                </div>
                <div class="ai-in-sports">
                    <h2 class="text-center">AI in Sports</h2>
                    <h3>Artificial Intelligence (AI) is playing an increasingly important role in sports. AI is used for player performance analysis, injury prediction, game strategy optimization, and fan engagement. The integration of AI in sports is enhancing the overall experience for players, coaches, and fans.</h3>
                    <iframe width="722" height="406" src="https://www.youtube.com/embed/YPh3Y0F6F7Y" title="How Is Artificial Intelligence Changing Football?" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>            
                </div>
                <h2 class="text-center">Play a Small Football Game</h2>
                <iframe src="https://www.crazygames.com/embed/penalty-shooters" width="722" height="406" frameborder="0" allow="gamepad *;"></iframe>
            </div>
        </div>
        <div class="footer">
            <p>Developed by:<br>
           Zeinab Salah | FCAI| IS</p>
        </div>
    </div>
    <script>
        function sendMessage() {
            var input = document.getElementById('chatbot-input');
            var message = input.value;
            if (message.trim() === '') return;

            var messagesDiv = document.getElementById('chatbot-messages');
            var userMessageDiv = document.createElement('div');
            userMessageDiv.textContent = 'You: ' + message;
            messagesDiv.appendChild(userMessageDiv);

            input.value = '';

            // Simulate AI response
            setTimeout(function() {
                var aiMessageDiv = document.createElement('div');
                aiMessageDiv.textContent = 'AI: ' + getAIResponse(message);
                messagesDiv.appendChild(aiMessageDiv);
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
            }, 1000);
        }

        function getAIResponse(message) {
            // This is a placeholder function. Replace with actual API call to AI model.
            return 'This is
            // This is a placeholder function. Replace with actual API call to AI model.
            return 'This is a response to "' + message + '".';
        }
        $(document).ready(function(){
            $('.carousel').carousel({
                interval: 2000 
            });
        });
    </script>
</body>
</html>