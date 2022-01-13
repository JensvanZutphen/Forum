<?php
$conn = new PDO("mysql:host=localhost;dbname=forum", "root", "");
    session_start();
    if ($_SESSION['loggedin'] != true){
        header ("Location: Login.php");
        die();
    }
    $gebruiker = $_SESSION['gebruiker'];
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM gebruiker WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->fetchAll();
    echo "Gebruikersnaam ".$result[0]["gebruiker"], "<br>id ".$result[0]["id"];
    ?>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.rawgit.com/kimeiga/bahunya/css/bahunya-0.1.3.css"/>
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Forum</title>
    </head>
    <body>
    <div class="topnav">
        <a class="Home" href="index.php">Home</a>
        <a href="Admin.php">Admin</a>
        <a href="CreatePost.php">Create Post</a>
        <a href="Posts.php">Posts</a>
        <a href="Logout.php">Logout</a>
    </div> 
    </body>
    </html>