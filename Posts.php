<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.rawgit.com/kimeiga/bahunya/css/bahunya-0.1.3.css"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Posts</title>
</head>
<body>
<ul class="flex">
  <li class="mr-6">
    <a class="text-blue-500 hover:text-blue-800" href="index.php">Home</a>
  </li>
  <li class="mr-6">
    <a class="text-blue-500 hover:text-blue-800" href="Admin.php">Admin</a>
  </li>
  <li class="mr-6">
    <a class="text-blue-500 hover:text-blue-800" href="CreatePost.php">CreatePost</a>
  </li>
  <li class="mr-6">
    <a class="text-blue-500 hover:text-blue-800" href="Posts.php">Posts</a>
  </li>
  <li class="mr-6">
    <a class="text-blue-500 hover:text-blue-800" href="Logout.php">Logout</a>
  </li>
</ul>
    <form action="zoek.php" method="post">
        <label for="zoekterm">Zoekterm:</label>
        <input type="text" name="zoekterm" id="zoekterm" value="">
        <input type="submit" value="Submit">
    </form>
</body>
</html>
<?php
    session_start();
    if ($_SESSION['loggedin'] != true){
    header ("Location: Login.php");
    die();
}
$conn = new PDO("mysql:host=localhost;dbname=forum", "root", "");
$gebruiker = $_SESSION['gebruiker'];
$sql = "SELECT * FROM posts";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
$posts = "SELECT * FROM `posts` WHERE `categorie` LIKE '%%'";
$result = $conn->query($posts);
if ($result->rowCount() > 0) {
    echo "<table>"."<tr><th>Categorie</th><th>Naam</th></tr>";
    foreach ($result as $row) {
        echo "<tr><td>" .$row['categorie'] . "</td><td>" . $row['naam'] ."</td><td>" .$row['text']. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Geen resultaten gevonden.";
}
?>