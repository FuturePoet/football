<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Football Rankings</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- AOS (Animate On Scroll) CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --bg-color-light:rgb(241, 238, 238);
            --text-color-light: #000;
            --container-bg-light: #fff;
            --button-bg-light: #007bff;

            --bg-color-dark: #181818;
            --text-color-dark:rgb(156, 154, 154) ;
            --container-bg-dark: #222;
            --button-bg-dark: #ff4500;
        }
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .table {
            transition: transform 0.3s ease-in-out;
        }
        .table:hover {
            transform: scale(1.02);
        }
        h2, h3 {
            font-weight: bold;
        }
        .news-container {
            margin-top: 50px;
        }
        .news-card {
            transition: transform 0.3s ease-in-out;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .news-card:hover {
            transform: scale(1.05);
        }
        .news-image {
            width: 200px;
            height: 100px;
        }
        wrapper {
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
            color:rgb(255, 245, 245);
        }
        .btn-primary {
            width: 100%;
            background: var(--button-bg-light);
            border: none;
            padding: 10px;
            font-size: 18px;
        }

        .dark-mode {
            background-color: var(--bg-color-dark);
            color: var(--text-color-dark);
        }

        .dark-mode .container {
            background: var(--container-bg-dark);
        }

        .dark-mode .btn-primary {
            background: var(--button-bg-dark);
        }

        #darkModeToggle {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="wrapper">
        <div class="header">
        <h1 data-aos="zoom-in"> Football Rankings & News🏆</h1>
            <button id="darkModeToggle">🌙</button>

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
<br>
    <!-- Rankings Section -->
    <section id="rankings" class="container my-5" data-aos="fade-up">
        <h2 class="text-center mb-4"> Top 10 Clubs & Players🔥</h2>
        
        <div class="row">
            <!-- Top Clubs Table -->
            <div class="col-md-6" data-aos="fade-right">
                <h3 class="text-center text-primary"> Top 10 Clubs 🏅</h3>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered shadow-lg">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Club</th>
                                <th>Points</th>
                                <th>Goals</th>
                            </tr>
                        </thead>
                        <tbody id="clubsTable"></tbody>
                    </table>
                </div>
            </div>
            <br><br>
            <!-- Top Players Table -->
            <div class="col-md-6" data-aos="fade-left">
                <h3 class="text-center text-danger"> Top 10 Players 🌟</h3>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered shadow-lg">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Player</th>
                                <th>Club</th>
                                <th>Goals</th>
                            </tr>
                        </thead>
                        <tbody id="playersTable"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <br><br>
<!-- News Section -->
<section id="news" class="container my-5" data-aos="fade-up">
        <h1 class="text-center text-primary mb-4"> Latest Football News📰</h1>

        <div class="row" id="newsContainer">
            <!-- News items will be dynamically added here -->
        </div>
    </section>
        <div class="row" id="newsContainer">
            <!-- News items will be dynamically added here -->
        </div>
    </section>
    <br><br>
   <!-- Match Schedule Section -->
<section class="container my-5" data-aos="fade-up">
    <h1 class="text-center text-danger mb-4 fw-bold">Upcoming Matches 📅 </h1>

    <div class="table-responsive">
        <table class="table table-hover text-center match-table shadow-lg rounded-3 overflow-hidden">
            <thead class="table-danger text-white">
                <tr>
                    <th>Date</th>
                    <th>Match</th>
                    <th>Time</th>
                    <th>Venue</th>
                </tr>
            </thead>
            <tbody class="bg-light">
                <tr>
                    <td><strong>March 10, 2025</strong></td>
                    <td> <span class="fw-bold">Real Madrid</span> vs <span class="fw-bold">Barcelona</span></td>
                    <td>🕗 8:00 PM</td>
                    <td>🏟️ Santiago Bernabéu</td>
                </tr>
                <tr>
                    <td><strong>March 12, 2025</strong></td>
                    <td> <span class="fw-bold">Manchester United</span> vs <span class="fw-bold">Liverpool</span></td>
                    <td>🕖 7:30 PM</td>
                    <td>🏟️ Old Trafford</td>
                </tr>
                <tr>
                    <td><strong>March 14, 2025</strong></td>
                    <td><span class="fw-bold">Bayern Munich</span> vs <span class="fw-bold">PSG</span></td>
                    <td>🕘 9:00 PM</td>
                    <td>🏟️ Allianz Arena</td>
                </tr>
                <tr>
                    <td><strong>March 16, 2025</strong></td>
                    <td><span class="fw-bold">Juventus</span> vs <span class="fw-bold">AC Milan</span></td>
                    <td>🕕 6:45 PM</td>
                    <td>🏟️ Juventus Stadium</td>
                </tr>
                <tr>
                    <td><strong>March 18, 2025</strong></td>
                    <td><span class="fw-bold">Chelsea</span> vs <span class="fw-bold">Arsenal</span></td>
                    <td>🕖 7:00 PM</td>
                    <td>🏟️ Stamford Bridge</td>
                </tr>
                <tr>
                    <td><strong>March 20, 2025</strong></td>
                    <td> <span class="fw-bold">Dortmund</span> vs <span class="fw-bold">Ajax</span></td>
                    <td>🕗 8:15 PM</td>
                    <td>🏟️ Signal Iduna Park</td>
                </tr>
                <tr>
                    <td><strong>March 22, 2025</strong></td>
                    <td><span class="fw-bold">Inter Milan</span> vs <span class="fw-bold">Napoli</span></td>
                    <td>🕡 6:30 PM</td>
                    <td>🏟️ San Siro</td>
                </tr>
                <tr>
                    <td><strong>March 24, 2025</strong></td>
                    <td><span class="fw-bold">Atletico Madrid</span> vs <span class="fw-bold">Sevilla</span></td>
                    <td>🕘 9:00 PM</td>
                    <td>🏟️ Wanda Metropolitano</td>
                </tr>
                <tr>
                    <td><strong>March 26, 2025</strong></td>
                    <td> <span class="fw-bold">Tottenham</span> vs <span class="fw-bold">West Ham</span></td>
                    <td>🕗 8:00 PM</td>
                    <td>🏟️ Tottenham Hotspur Stadium</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
<br><br>
    <!-- Footer -->
    <footer class="text-center py-3 bg-dark text-white">
        <p>© 2025 Football Rankings. All rights reserved.</p>
    </footer>

    <!-- JavaScript -->
    <script>
        // Sample Data for Clubs
        const clubs = [
            { rank: 1, name: "Real Madrid", points: 85, goals: 72 },
            { rank: 2, name: "Barcelona", points: 82, goals: 68 },
            { rank: 3, name: "Manchester City", points: 79, goals: 65 },
            { rank: 4, name: "Bayern Munich", points: 76, goals: 63 },
            { rank: 5, name: "Liverpool", points: 74, goals: 60 },
            { rank: 6, name: "PSG", points: 71, goals: 58 },
            { rank: 7, name: "Juventus", points: 69, goals: 55 },
            { rank: 8, name: "Chelsea", points: 66, goals: 52 },
            { rank: 9, name: "AC Milan", points: 64, goals: 50 },
            { rank: 10, name: "Dortmund", points: 61, goals: 48 },
        ];

        // Sample Data for Players
        const players = [
            { rank: 1, name: "Lionel Messi", club: "Inter Miami", goals: 35 },
            { rank: 2, name: "Cristiano Ronaldo", club: "Al Nassr", goals: 33 },
            { rank: 3, name: "Erling Haaland", club: "Man City", goals: 31 },
            { rank: 4, name: "Kylian Mbappe", club: "PSG", goals: 30 },
            { rank: 5, name: "Harry Kane", club: "Bayern Munich", goals: 28 },
            { rank: 6, name: "Neymar", club: "Al Hilal", goals: 26 },
            { rank: 7, name: "Robert Lewandowski", club: "Barcelona", goals: 25 },
            { rank: 8, name: "Mohamed Salah", club: "Liverpool", goals: 24 },
            { rank: 9, name: "Vinicius Jr.", club: "Real Madrid", goals: 23 },
            { rank: 10, name: "Kevin De Bruyne", club: "Man City", goals: 22 },
        ];

        // Populate Clubs Table
        const clubsTable = document.getElementById("clubsTable");
        clubs.forEach(club => {
            clubsTable.innerHTML += `
                <tr>
                    <td>${club.rank}</td>
                    <td>${club.name}</td>
                    <td>${club.points}</td>
                    <td>${club.goals}</td>
                </tr>
            `;
        });

        // Populate Players Table
        const playersTable = document.getElementById("playersTable");
        players.forEach(player => {
            playersTable.innerHTML += `
                <tr>
                    <td>${player.rank}</td>
                    <td>${player.name}</td>
                    <td>${player.club}</td>
                    <td>${player.goals}</td>
                </tr>
            `;
        });
    </script>

    <!-- Bootstrap & AOS JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // News Data (Title, Image, Content, Likes, Dislikes)
        const newsArticles = [
            {
                id: 1,
                title: "Real Madrid Wins El Clásico 🏆",
                image: "https://th.bing.com/th/id/OIP.B6e9RRTZLReHI5rdSRO70AHaEK?rs=1&pid=ImgDetMain",
                content: "Real Madrid secured a thrilling 2-1 victory over Barcelona in the latest El Clásico match.",
                likes: 0,
                dislikes: 0
            },
            {
                id: 2,
                title: "Cristiano Ronaldo Breaks Goal Record ⚽",
                image: "https://th.bing.com/th/id/OIP.YttZQCD6ur7ZtWRR48JErgHaEK?rs=1&pid=ImgDetMain",
                content: "Cristiano Ronaldo has set a new record, becoming the highest goal scorer in football history.",
                likes: 0,
                dislikes: 0
            },
            {
                id: 3,
                title: "Manchester City Wins Premier League 🏅",
                image: "https://th.bing.com/th/id/OIP.hItwUiK0LvjT6DX9QH1mNQHaE9?rs=1&pid=ImgDetMain",
                content: "Manchester City wins their 5th Premier League title under Pep Guardiola.",
                likes: 0,
                dislikes: 0
            },
            {
                id: 4,
                title: "Messi Wins His 8th Ballon d'Or 🥇",
                image: "https://th.bing.com/th/id/OIP.ecAxUZgpGW4WPnzHhm6HfgHaE8?rs=1&pid=ImgDetMain",
                content: "Lionel Messi has secured his record-breaking 8th Ballon d'Or award.",
                likes: 0,
                dislikes: 0
            },
            {
                id: 5,
                title: "Liverpool Signs New Star Player 🌟",
                image: "https://th.bing.com/th/id/OIP.6WZehY6yWiUEbPr9hw4iVwHaFl?rs=1&pid=ImgDetMain",
                content: "Liverpool has made a major signing, bringing in a young talent for the next season.",
                likes: 0,
                dislikes: 0
            }
        ];

        // Function to render news articles
        function renderNews() {
            const newsContainer = document.getElementById("newsContainer");
            newsContainer.innerHTML = "";

            newsArticles.forEach((news, index) => {
                newsContainer.innerHTML += `
                    <div class="col-md-4 mb-4" data-aos="fade-up">
                        <div class="news-card">
                            <img src="${news.image}" class="news-img" alt="News Image">
                            <div class="p-3">
                                <h4>${news.title}</h4>
                                <p>${news.content}</p>
                                <div>
                                    <span class="like-btn text-success" onclick="updateReaction(${index}, 'like')">👍</span>
                                    <span id="likes-${index}">${news.likes}</span>
                                    <span class="dislike-btn text-danger" onclick="updateReaction(${index}, 'dislike')">👎</span>
                                    <span id="dislikes-${index}">${news.dislikes}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
        }

        // Function to update likes/dislikes
        function updateReaction(index, type) {
            if (type === "like") {
                newsArticles[index].likes++;
                document.getElementById(`likes-${index}`).innerText = newsArticles[index].likes;
            } else {
                newsArticles[index].dislikes++;
                document.getElementById(`dislikes-${index}`).innerText = newsArticles[index].dislikes;
            }
        }

        // Initial render
        renderNews();
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>AOS.init();</script>
    <script>
        document.querySelectorAll('.plan').forEach(plan => {
            plan.addEventListener('click', function() {
                document.querySelectorAll('.plan').forEach(p => p.classList.remove('active'));
                this.classList.add('active');
                document.getElementById('selectedPlan').value = this.getAttribute('data-plan');
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