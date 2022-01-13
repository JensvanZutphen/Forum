<?php
session_start();
$conn = new PDO("mysql:host=localhost;dbname=forum", "root", "");
if ($_SESSION['loggedin'] == true) {
        if(isset($_POST['gebruiker']) && isset($_POST['wachtwoord']) && $_SESSION['Administrator'] == true){
            $gebruiker = $_POST["gebruiker"];
            $wachtwoord = $_POST["wachtwoord"];
            $admin = $_POST["admin"];
            $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
            $sql = "INSERT INTO gebruiker (gebruiker, wachtwoord, admin) VALUES ('$gebruiker', '$hash', '$admin')";
            $conn->exec($sql);
        }
    }
    if(isset($_POST['naam']) && isset($_POST['categorie']) && isset($_POST['prijs']) && $_SESSION['Administrator'] == true){
        $naam = $_POST['naam'];
        $categorie = $_POST['categorie'];
        $prijs = $_POST['prijs'];
        $sql = "INSERT INTO items (naam, categorie, prijs) VALUES ('$naam', '$categorie', '$prijs') ON DUPLICATE KEY UPDATE prijs = '$prijs', categorie = '$categorie'";
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
    <link rel="stylesheet" href="https://cdn.rawgit.com/kimeiga/bahunya/css/bahunya-0.1.3.css"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
<form action="Admin.php" method="post">
    <label for="gebruiker">Gebruikersnaam:</label>
    <input type="text" name="gebruiker" id="gebruiker" value="">
    <label for="wachtwoord">Wachtwoord:</label>
    <input type="password" name="wachtwoord" id="wachtwoord" value="">
    <label for="admin">Admin:</label>
    <input type="checkbox" name="admin" id="admin" value="1">
    <input type="submit" value="Submit">
</form>
<form action="Admin.php" method="post">
    <label for="naam">naam:</label>
    <input type="text" name="naam" id="naam" value="">
    <label for="categorie">categorie:</label>
    <input type="text" name="categorie" id="categorie" value="">
    <label for="prijs">prijs:</label>
    <input type="text" name="prijs" id="prijs" value="">
    <input type="submit" value="Submit">
</form>
</body>
</html>
