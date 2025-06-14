<?php
require 'config.php';
$adminCollection = $db->admin;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $phone = $_POST['phone']; 
    $birthDate = $_POST['age']; 
    $birthYear = (int)date('Y', strtotime($birthDate));
    $currentYear = (int)date('Y');
    $age = $currentYear - $birthYear; // Calculate age

    // Handle profile image upload
    $profileImage = '';
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $uploadDir = 'uploads/';
        $profileImage = $uploadDir . basename($_FILES['profile_image']['name']);
        move_uploaded_file($_FILES['profile_image']['tmp_name'], $profileImage);
    }

    $userType = $_POST['user_type']; // Get the user type
    // Determine where to store the user based on the user selected type
    if ($userType === 'admin') {
        // Insert the new admin user
        $result = $adminCollection->insertOne([
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
            'age' => $age,
            'birth_date' => $birthDate, // Optional: store the birthdate as well
            'profile_image' => $profileImage // Store the profile image path
        ]);
        header("Location: login.php"); // Redirect to login page
        exit;
    } else {
        // Insert the new regular user
        $result = $userCollection->insertOne([
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
            'age' => $age,
            'birth_date' => $birthDate, // Optional: store the birthdate as well
            'profile_image' => $profileImage // Store the profile image path
        ]);
        header("Location: login.php"); // Redirect to login page
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #705030;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('https://wallpapershigh.com/wp-content/uploads/football-stadium-16.webp');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .container {
            background-color: #fff;
            border-radius: 5px;
            border: 3px solid rgb(59, 6, 6);
            color: #000000;
            align-items: center;
            width: 500px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container:hover {
            background-color: #ffffffa3;
        }

        form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .title {
            margin-top: 5px;
            color: aliceblue;
            border: 4px solid rgb(219, 209, 200);
            border-radius: 5px;
            text-align: center;
            height: max-content;
        }

        label {
            margin-top: 10px;
            font-size: 18px;
        }

        input, select {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #4a0808;
            border-radius: 3px;
            margin-bottom: 10px;
            width: 100%;
            font-size: 16px;
        }

        button {
            padding: 10px;
            border-radius: 5px;
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            width: 100%;
        }

        button:hover {
            background-color: #b30000;
        }

        p {
            margin-top: 20px;
            font-size: 16px;
        }

        a {
            color: #000000;
            font-size: 16px;
            text-decoration: none;
        }

        a:hover {
            color: #007BFF;
            text-decoration: underline;
        }

        h1 {
            color: brown;
            font-size: 24px;
            text-align: center;
        }

        .message {
            color: brown;
            font-size: 16px;
            padding: 5px;
            background-color: antiquewhite;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    
<div class="register">
    <div class="container">
        <h1>Create new user</h1>
        <form action="register.php" method="POST" enctype="multipart/form-data">
            <label for="username">Name:</label>
            <input type="text" name="username" id="username" required>
            
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            
            <label for="age">Age:</label>
            <input type="date" name="age" id="age" required>
            
            <label for="phone">Phone:</label>
            <input type="number" name="phone" id="phone" required>

            <label for="profile_image">Profile Image:</label>
            <input type="file" name="profile_image" id="profile_image" accept="image/*" required>
            
            <button type="submit"><b>Register</b></button>
            
            <p>You have an account:</p>
            <a href="login.php" class="button">Login</a>  
        </form>   
    </div>
</div>

</body>
</html>