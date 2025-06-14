<?php 
require 'config.php';
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $plan = $_POST['plan'];
    $creditCardNumber = $_POST['credit_card_number'];
    $expiryDate = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];

    $insertOneResult = $premiumCollection->insertOne([
        'name' => $name,
        'email' => $email,
        'plan' => $plan,
        'credit_card_number' => $creditCardNumber,
        'expiry_date' => $expiryDate,
        'cvv' => $cvv,
        'subscribed_at' => new MongoDB\BSON\UTCDateTime()
    ]);

    if ($insertOneResult->getInsertedCount() == 1) {
        echo "<script>alert('Now you are a subscriber and able to try our model! Let\'s go.'); window.location.href='upload.php';</script>";
        exit();
    } else {
        $message = "Subscription failed, please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribe to Premium</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        :root {
            --bg-color-light: #f4f4f4;
            --text-color-light: #000;
            --container-bg-light: #fff;
            --button-bg-light: #007bff;

            --bg-color-dark: #181818;
            --text-color-dark:rgb(156, 154, 154) ;
            --container-bg-dark: #222;
            --button-bg-dark: #ff4500;
        }

        body {
            background-color: var(--bg-color-light);
            color: var(--text-color-light);
            font-family: Arial, sans-serif;
            transition: all 0.3s ease;
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
        .container {
            max-width: 600px;
            background: var(--container-bg-light);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            transition: all 0.3s ease;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            width: 100%;
            background: #007bff;
            border: none;
            padding: 10px;
            font-size: 18px;
        }
        .subscription-plans {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .plan {
            padding: 10px;
            background: #ddd;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }
        .plan.active {
            background: #007bff;
            color: black;
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
            color:rgb(223, 217, 217);
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
<div class="header">
<h1 style="text-align:center;">FSP WEBSITE <img src="images/logo.jpg"></h1>
<button id="darkModeToggle">🌙</button>

        </div>
        <nav>
    <div class="navigation">
            <ul class="nav nav-pills">
                <li role="presentation" ><a href="home.php">Home</a></li>
                <li role="presentation"><a href="subscribe.php" class="active">Get Premium</a></li>
                <li role="presentation"><a href="matches.php">Matches</a></li>
                <li role="presentation"><a href="upload.php">Try our Model</a></li>
                <li role="presentation"><a href="players.php">Players</a></li>
                <li role="presentation"><a href="https://friendlychat-541c2.firebaseapp.com/">Fans Section</a></li>
                <li role="presentation"><a href="contact.php">Contact Us</a></li>
            </ul>
    </nav>
        <br>
    <div class="container">
        <h1 class="text-center">Subscribe to Premium</h1><br>
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
                <div class="form-group">
                <label>Choose a Subscription Plan:</label>
                <div class="subscription-plans">
                    <div class="plan" data-plan="Basic">
                    <h3>Basic</h3>
                    <p>$5/month</p>
                    <p>✔ Limited Features</p>
                    <p>✔ Access to basic tools</p></div>
                    <div class="plan active" data-plan="Standard"> 
                    <h3>Standard</h3>
                    <p>$10/month</p>
                    <p>✔ All Basic Features</p>
                    <p>✔ Advanced tools</p></div>
                    <div class="plan" data-plan="Premium"> 
                    <h3>Premium</h3>
                    <p>$20/month</p>
                    <p>✔ All Standard Features</p>
                    <p>✔ Premium Support</p></div>
                </div>
                <input type="hidden" name="plan" id="selectedPlan" value="Standard">
            </div>
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
            <button type="submit" class="btn btn-primary">Subscribe Now</button>
        </form>
        <?php if (!empty($message)): ?>
            <div class="alert alert-danger text-center" style="margin-top: 20px;"> <?php echo $message; ?> </div>
        <?php endif; ?>
    </div>

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
