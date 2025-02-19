<?php
// Include database configuration file
include 'config.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $creditCardNumber = $_POST['credit_card_number'];
    $expiryDate = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];

    // Insert subscription details into MongoDB
    $insertOneResult = $premiumCollection->insertOne([
        'name' => $name,
        'email' => $email,
        'credit_card_number' => $creditCardNumber,
        'expiry_date' => $expiryDate,
        'cvv' => $cvv,
        'subscribed_at' => new MongoDB\BSON\UTCDateTime()
    ]);

    if ($insertOneResult->getInsertedCount() == 1) {
        // Subscription stored successfully
        echo "<script>alert('Subscription successful!'); window.location.href='home.php';</script>";
        exit();
    } else {
        $message = "Subscription failed, please try again.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Subscribe to Premium</title>
    <link rel="stylesheet" type="text/css" href="home.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="uU3ATrc7MD6evWJv7dRbuLE7O8wZz8n7GFiftx7F7gg" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="header">Subscribe to Premium</div>
        <div class="navigation">
            <ul class="hor">
                <li><a href="home.php">Home</a></li>
                <li><a class="active" href="subscribe.php">Get Premium</a></li>
                <li><a href="matches.php">Matches</a></li>
                <li><a href="upload.php">Try Our Model</a></li>
                <li><a href="players.php">Players</a></li>
                <li><a href="https://friendlychat-541c2.firebaseapp.com/">Fans Section</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </div>
       
        <div class="main">
            <h2 class="text-center">Subscribe to Premium</h2>
            <form action="subscribe.php" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="credit_card_number">Credit Card Number:</label>
                    <input type="text" name="credit_card_number" id="credit_card_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="expiry_date">Expiry Date:</label>
                    <input type="text" name="expiry_date" id="expiry_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV:</label>
                    <input type="text" name="cvv" id="cvv" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Subscribe</button>
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