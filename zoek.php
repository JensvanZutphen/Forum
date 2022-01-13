<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.rawgit.com/kimeiga/bahunya/css/bahunya-0.1.3.css"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Zoekterm</title>
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
<?php
    $conn = new PDO("mysql:host=localhost;dbname=forum", "root", "");
    session_start();
    if ($_SESSION['loggedin'] != true){
        header ("Location: Login.php");
        die();
    }
    if (isset($_POST['zoekterm'])){
    $zoekterm = $_POST['zoekterm'];
    $sql = "SELECT * FROM `posts` INNER JOIN gebruiker ON posts.user_id = gebruiker.id WHERE `categorie` LIKE '%$zoekterm%'";
    $result = $conn->query($sql);
    if ($result->rowCount() > 0) {
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['naam'] . "</td><br>";
            echo "<td>" . $row['gebruiker'] . "</td><br>";
            echo "<td>" . $row['text'] . "</td>";
            echo "</tr>";
        }
    }
    else {
        echo "Geen resultaten gevonden";
    }
    }
    ?>
    </table>
    </div>