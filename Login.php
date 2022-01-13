<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.rawgit.com/kimeiga/bahunya/css/bahunya-0.1.3.css"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body>
<?php
    session_start();
    if(isset($_POST['gebruiker']) && isset($_POST['wachtwoord'])){
        $conn = new PDO("mysql:host=localhost;dbname=forum", "root", "");
        $gebruiker = $_POST['gebruiker'];
        $sql = "SELECT * FROM gebruiker WHERE gebruiker = :gebruiker";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':gebruiker', $gebruiker);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(password_verify($_POST['wachtwoord'], $result[0]["wachtwoord"]) && $_POST['gebruiker'] == $result[0]["gebruiker"] && $result[0]["Admin"] == "1"){
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $result[0]["id"];
            $_SESSION['Administrator'] = true;
            $_SESSION['gebruiker'] = $_POST['gebruiker'];
            echo "Je hebt Administrator Privilages";
            header("Location: index.php");
        }
        elseif(password_verify($_POST['wachtwoord'], $result[0]["wachtwoord"]) && $_POST['gebruiker'] == $result[0]["gebruiker"]){
            $_SESSION['loggedin'] = true;
            $_SESSION['gebruiker'] = $_POST['gebruiker'];
            $_SESSION['id'] = $result[0]["id"];
            echo "werkt";
            header("Location: index.php");
        }
        elseif(!isset($_SESSION['loggedin'])){
            $_SESSION['loggedin'] = false;
            echo "werkt niet";
        }
    if($_SESSION['loggedin'] != true){
        header("Location: Login.php");
    }
}
?>
<form action="Login.php" method="post">
    <label for="gebruiker">Gebruiker</label>
    <input type="text" name="gebruiker" id="gebruiker" placeholder="gebruiker" required>
    <label for="wachtwoord">Wachtwoord</label>
    <input type="password" name="wachtwoord" id="wachtwoord" placeholder="wachtwoord" required>
    <input type="submit" value="Login">
</form>
</body>
</html>
