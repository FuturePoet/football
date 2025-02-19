<?php
session_start();
require 'config.php'; // Ensure MongoDB connection is included

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to the MongoDB collection
    $userCollection = $client->livescore->users; // Change "myDatabase" to your actual database name

    // Find user by username
    $user = $userCollection->findOne(['username' => $username]);

    if ($user && password_verify($password, $user['password'])) {
        // Store user data in session
        $_SESSION['username'] = $user['username'];
        $_SESSION['profile_image'] = $user['profile_image'];
        header("Location: home.php"); // Redirect to homepage
        exit;
    } else {
        $error = "⚠️ Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('https://img.freepik.com/premium-photo/soccer-player-stadium-action-mixed-media_641298-21570.jpg?w=1060') no-repeat center center/cover;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4); 
            z-index: 1;
        }

        .container {
            position: relative;
            z-index: 2;
            display: flex;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 80%;
            max-width: 1200px;
            padding: 40px;
            justify-content: space-between;
            align-items: center;
        }

        .container:hover {
            background-color: #ffffffa3;
        }

        .login-form {
            width: 50%;
            padding-right: 20px;
        }

        .title {
            color: #333;
            font-size: 2.5rem;
            margin-bottom: 40px;
            text-align: center;
        }

        label {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #555;
        }

        input {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 80%;
            font-size: 1rem;
            background-color: #f9f9f9;
        }

        button {
            width: 85%;
            padding: 15px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            background-color: #28a745;
            color: #fff;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        .message {
            width: 80%;
            font-size: 1rem;
            color: #555;
            margin: 30px 0 20px;
            background-color: #f0f0f0;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
        }

        a {
            color: #007BFF;
            text-decoration: none;
            font-size: 1.1rem;
            display: block;
            text-align: center;
            margin-top: 15px;
        }

        a:hover {
            text-decoration: underline;
        }

        .image-section {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-section img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="login-form">
            <form action="login.php" method="POST">
                <div class="title">
                    <h2>Login</h2>
                </div>
                <label for="username">User Name:</label>
                <input type="username" name="username" id="username" required>
                
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>

                <button type="submit" name="login">Login</button>

                <?php if (isset($error)): ?>
                    <div class="message">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <div class="message">
                    Don’t have an account?
                </div>

                <a href="register.php">Create a New Account</a>
            </form>
        </div>

        <div class="image-section">
            <img src="https://i.pinimg.com/originals/6c/7d/19/6c7d19c64f00cadd32512dba8b67b5f3.jpg" alt="Football Image">
        </div>
    </div>

</body>
</html>