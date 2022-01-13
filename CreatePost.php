<?php
session_start();
$conn = new PDO("mysql:host=localhost;dbname=forum", "root", "");
    if(isset($_POST['naam']) && isset($_POST['categorie']) && isset($_POST['text'])){
        $naam = $_POST['naam'];
        $categorie = $_POST['categorie'];
        $text = $_POST['text'];
        $user_id = $_SESSION['id'];
        $sql = "INSERT INTO posts (naam, categorie, text, user_id) VALUES ('$naam', '$categorie', '$text', '$user_id') ON DUPLICATE KEY UPDATE text = '$text', categorie = '$categorie'";
        $conn->exec($sql);
    }
    if (!isset($_SESSION['Administrator'])){
        $_SESSION['Administrator'] = false;
    }
    if ($_SESSION['Administrator'] != true){
        echo "You are not loggedin as an administrator.";
    }
if ($_SESSION['loggedin'] != true){
    header ("Location: Login.php");
    die();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.rawgit.com/kimeiga/bahunya/css/bahunya-0.1.3.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
<form action="CreatePost.php" method="post">
    <label for="naam">naam:</label>
    <input type="text" name="naam" id="naam" value="">
    <label for="categorie">categorie:</label>
    <input type="text" name="categorie" id="categorie" value="">
    <label for="text">text:</label>
    <input type="text" name="text" id="text" value="">
    <input type="submit" value="Submit">
</form>
</body>
</html>
