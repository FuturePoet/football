<?php
// Include database configuration file
include 'config.php';

// Fetch last matches from the database
$lastMatches = $matchesCollection->find(['date' => ['$lt' => new MongoDB\BSON\UTCDateTime()]], ['sort' => ['date' => -1]])->toArray();

// Fetch future matches in 2025 from the database
$futureMatches2025 = $matchesCollection->find([
    'date' => [
        '$gte' => new MongoDB\BSON\UTCDateTime(strtotime('2025-01-01T00:00:00Z') * 1000),
        '$lt' => new MongoDB\BSON\UTCDateTime(strtotime('2026-01-01T00:00:00Z') * 1000)
    ]
], ['sort' => ['date' => 1]])->toArray();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Matches Dashboard</title>
    <link rel="stylesheet" type="text/css" href="home.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .dashboard {
            padding: 20px;
        }
        .match-card {
            margin-bottom: 20px;
        }
        .match-card h4 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">Matches Dashboard</div>
        <div class="navigation">
            <ul class="hor">
                <li><a href="home.php">Home</a></li>
                <li><a href="subscribe.php">Get Premium</a></li>
                <li><a class="active" href="matches.php">Matches</a></li>
                <li><a href="upload.php">Try Our Model</a></li>
                <li><a href="players.php">Players</a></li>
                <li><a href="https://friendlychat-541c2.firebaseapp.com/">Fans Section</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </div>
       
        <div class="main dashboard">
            <h2 class="text-center">Last Matches</h2>
            <div class="row">
                <?php if (!empty($lastMatches)): ?>
                    <?php foreach ($lastMatches as $match): ?>
                        <div class="col-md-4 match-card">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4><?php echo $match['team_a']; ?> vs <?php echo $match['team_b']; ?></h4>
                                </div>
                                <div class="panel-body">
                                    <p><strong>Date:</strong> <?php echo $match['date']->toDateTime()->format('Y-m-d H:i:s'); ?></p>
                                    <p><strong>Location:</strong> <?php echo $match['location']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">No matches found.</p>
                <?php endif; ?>
            </div>

            <h2 class="text-center">Future Matches in 2025</h2>
            <div class="row">
                <?php if (!empty($futureMatches2025)): ?>
                    <?php foreach ($futureMatches2025 as $match): ?>
                        <div class="col-md-4 match-card">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4><?php echo $match['team_a']; ?> vs <?php echo $match['team_b']; ?></h4>
                                </div>
                                <div class="panel-body">
                                    <p><strong>Date:</strong> <?php echo $match['date']->toDateTime()->format('Y-m-d H:i:s'); ?></p>
                                    <p><strong>Location:</strong> <?php echo $match['location']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">No matches found.</p>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="footer">
            <p>Developed by:<br>
           Zeinab Salah | FCAI| IS</p>
        </div>
    </div>
</body>
</html>