<?php
require 'config.php';
session_start();

// Initialize variables for errors and success messages
$errorMessage = $successMessage = "";
// Fetch the current user's information
if (isset($_SESSION['user'])) {
    $currentUser = $userCollection->findOne(['username' => $_SESSION['username']]);
    if (!$currentUser) {
        $errorMessage = "User not found.";
    }
}
// Handle user update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $age = $_POST['age'] ?? '';
    $phone = $_POST['phone'] ?? '';

    // Input validation
    if (empty($username) || empty($email) || empty($age) || empty($phone)) {
        $errorMessage = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email format.";
    } elseif (!is_numeric($age) || $age <= 0) {
        $errorMessage = "Age must be a positive number.";
    } elseif (!preg_match('/^\d{11}$/', $phone)) {
        $errorMessage = "Phone number must be 11 digits.";
    } else {
        // Prepare updated data
        $updatedData = [
            'username' => $username,
            'email' => $email,
            'age' => (int)$age,
            'phone' => $phone,
        ];

        // Update the user in the database
        $result = $userCollection->updateOne(
            ['username' => $_SESSION['username']],
            ['$set' => $updatedData]
        );

        if ($result->getModifiedCount() > 0) {
            $successMessage = "Profile updated successfully.";
            $_SESSION['username'] = $username; // Update session username
        } else {
            $errorMessage = "No changes were made.";
        }
    }
}

// Handle user deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $result = $userCollection->deleteOne(['username' => $_SESSION['username']]);
    if ($result->getDeletedCount() > 0) {
        session_destroy();
        header("Location: login.php");
        exit;
    } else {
        $errorMessage = "Failed to delete the account.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .delete-button {
            background-color: #d9534f;
        }

        .delete-button:hover {
            background-color: #c9302c;
        }

        .message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 4px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Your Profile</h1>

        <?php if ($errorMessage): ?>
            <div class="message error"><?php echo htmlspecialchars($errorMessage); ?></div>
        <?php endif; ?>

        <?php if ($successMessage): ?>
            <div class="message success"><?php echo htmlspecialchars($successMessage); ?></div>
        <?php endif; ?>

        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" 
                   value="<?php echo htmlspecialchars($currentUser['username'] ?? ''); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" 
                   value="<?php echo htmlspecialchars($currentUser['email'] ?? ''); ?>" required>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" 
                   value="<?php echo htmlspecialchars($currentUser['age'] ?? ''); ?>" required min="1">

            <label for="phone">Phone:</label>
            <input type="number" id="phone" name="phone" 
                   value="<?php echo htmlspecialchars($currentUser['phone'] ?? ''); ?>" required pattern="\d{11}">

            <button type="submit" name="update">Update Profile</button>
        </form>
<br><br>
        <form method="POST">
            <button type="submit" name="delete" class="delete-button">Delete Account</button>
        </form>

        <br>
        <a href="home.php">Back to Home Page</a>
    </div>
</body>
</html>