<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <link rel="stylesheet" type="text/css" href="home.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .contact-card {
            margin-bottom: 30px;
        }
        .contact-card h4 {
            margin-top: 0;
        }
        .contact-card img {
            width: 100%;
            height: auto;
            border-radius: 50%;
            margin-bottom: 15px;
        }
        .panel {
            transition: transform 0.3s;
        }
        .panel:hover {
            transform: translateY(-10px);
        }
        .contact-card .panel-body {
            text-align: center;
        }
        .contact-card .panel-body p {
            width: 100%;
            margin: 10px 0;
        }
        .contact-card .panel-body .bio {
            font-size: 14px;
            color: #777;
        }
        .contact-card .panel-body .social-icons {
            margin-top: 10px;
        }
        .contact-card .panel-body .social-icons a {
            margin: 0 10px;
            color: #333;
            font-size: 20px;
            transition: color 0.3s;
        }
        .contact-card .panel-body .social-icons a:hover {
            color: #007bff;
        }
        .header, .footer {
            background-color: #007bff;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .header h1, .footer p {
            margin: 0;
        }
        .main {
            padding: 20px;
        }
        .navigation ul {
            list-style-type: none;
            padding: 10px;
            margin: 10px;
            display: flex;
            justify-content: center;
            font-weight: bold;
            font-size:35px;
            background-color:rgb(100, 100, 100);

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
        .navigation ul li a:hover{
            background-color: rgb(100, 100, 100);
            color:rgb(14, 14, 14);
        }
        .navigation ul li a.active {
            background:rgb(46, 127, 212);
            color:rgb(255, 255, 255);
        }
    
        .panel-body img{
            border-radius: 50%;
    width: 100px;
    height: 100px;
    object-fit: cover;
    margin-bottom: 10px; 

        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>Contact Us</h1>
        </div>
        <div class="navigation">
            <ul class="hor">
                <li><a href="home.php">Home</a></li>
                <li role="presentation"><a href="subscribe.php">Get Premium</a></li>
                <li role="presentation"><a href="matches.php">Matches</a></li>
                <li role="presentation"><a href="upload.php">Try our Model</a></li>
                <li><a href="players.php">Players</a></li>
                <li><a href="https://friendlychat-541c2.firebaseapp.com/">Fans Section</a></li>
                <li><a href="contact.php" class="active">Contact Us</a></li>
            </ul>
        </div>
       
        <div class="main dashboard">
            <h1 class="text-center color-animation">Meet Our Team</h1><br><br>
            <div class="row">
                <div class="col-md-4 col-sm-6 contact-card">
                    <div class="panel panel-default" style="margin-left: 30px;">
                        <div class="panel-body">
                            <img src="images\Team\zeinab.jpg" alt="Zeinab Salah">
                            <h4>Zeinab Salah</h4>
                            <p><strong>Role:</strong> Backend Developer</p>
                            <p class="bio">Zeinab is an experienced backend developer with a passion for creating robust and scalable server-side applications.</p>
                            <div class="social-icons">
                                <a href="https://www.facebook.com/zeinab salah" target="_blank"><i class="fab fa-facebook"></i></a>
                                <a href="https://wa.me/1234567890" target="_blank"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 contact-card">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <img src="images\Team\hussain.jpg" alt="Hussein Shaban">
                            <h4>Hussein Shaban</h4>
                            <p><strong>Role:</strong> Frontend Developer</p>
                            <p class="bio">Hussein specializes in crafting beautiful and responsive user interfaces that provide an excellent user experience.</p>
                            <div class="social-icons">
                                <a href="https://www.facebook.com/hussein Eissa" target="_blank"><i class="fab fa-facebook"></i></a>
                                <a href="https://wa.me/1234567890" target="_blank"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 contact-card">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <img src="images\Team\ziad.jpg" alt="Ziad Mohamed">
                            <h4>Ziad Mohamed</h4>
                            <p><strong>Role:</strong> Data Analyst</p>
                            <p class="bio">Ziad is a data analyst who excels at turning raw data into actionable insights to drive business decisions.</p>
                            <div class="social-icons">
                                <a href="https://www.facebook.com/ziad Mady" target="_blank"><i class="fab fa-facebook"></i></a>
                                <a href="https://wa.me/1234567890" target="_blank"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-2 col-sm-6 contact-card">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <img src="images\Team\samar.jpg" alt="Samar Ibrahim">
                            <h4>Samar Ibrahim</h4>
                            <p><strong>Role:</strong> Data Analyst</p>
                            <p class="bio">Samar is skilled in data analysis and visualization, helping teams understand complex data through clear and concise reports.</p>
                            <div class="social-icons">
                                <a href="https://www.facebook.com/samar ibrahim" target="_blank"><i class="fab fa-facebook"></i></a>
                                <a href="https://wa.me/1234567890" target="_blank"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 contact-card">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <img src="images\Team\malak.jpg" alt="Malak AbdAlfatah">
                            <h4>Malak AbdAlfatah</h4>
                            <p><strong>Role:</strong> Bio Analyst</p>
                            <p class="bio">Malak is a bio analyst with expertise in biological data analysis, contributing to research and development projects.</p>
                            <div class="social-icons">
                                <a href="https://www.facebook.com/malak abdalfatah" target="_blank"><i class="fab fa-facebook"></i></a>
                                <a href="https://wa.me/1234567890" target="_blank"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-2 col-sm-6 contact-card">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <img src="images\Team\shahd.jpg" alt="Shahd Moataz">
                            <h4>Shahd Moataz</h4>
                            <p><strong>Role:</strong> AI Specialist</p>
                            <p class="bio">Shahd is an AI specialist with a focus on developing intelligent systems and machine learning models.</p>
                            <div class="social-icons">
                                <a href="https://www.facebook.com/shahd moataz" target="_blank"><i class="fab fa-facebook"></i></a>
                                <a href="https://wa.me/1234567890" target="_blank"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 contact-card">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <img src="images\Team\ahmad.jpg" alt="Ahmad Said">
                            <h4>Ahmad Said</h4>
                            <p><strong>Role:</strong> Mobile App Developer</p>
                            <p class="bio">Ahmad is a mobile app developer who creates user-friendly and high-performance mobile applications.</p>
                            <div class="social-icons">
                                <a href="https://www.facebook.com/ahmadsaid" target="_blank"><i class="fab fa-facebook"></i></a>
                                <a href="https://wa.me/1234567890" target="_blank"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p>Developed by:<br>
           Zeinab Salah | FCAI| IS</p>
        </div>
    </div>
</body>
</html>