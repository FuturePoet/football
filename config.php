<?php
require 'vendor/autoload.php';

use MongoDB\Client;

// MongoDB Atlas connection string
$client = new Client("mongodb+srv://husseinshaban1322:NENOo332003@cluster0.wqs8erb.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0");

// Select the database
$db = $client->livescore;

// Define collections
$userCollection = $db->users;
$videoCollection = $db->Videos;
$premiumCollection = $db->premium;
$matchesCollection = $db->matches;
$adminCollection = $db->admin;
?>