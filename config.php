<?php
require 'vendor/autoload.php'; // Include Composer's autoloader

// MongoDB connection
$client = new MongoDB\Client("mongodb://localhost:27017");

// Select the database and collections
$db = $client->livescore;
$userCollection = $db->users;  // Collection for users
$videoCollection = $db->Videos; // Collection for videos
$premiumCollection = $db->premium; // Collection for premium subscriptions
$matchesCollection = $db->matches; // Collection for matches
?>