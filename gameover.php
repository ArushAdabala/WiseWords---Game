<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<style>
    #gameover{
        position: fixed;
        top: 50%;
        left: 50%;
        margin-top: -75px;
        margin-left: -125px;
    }
</style>
</head>
<body>
<div id = "gameover">
<h1>Game Over</h1>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tempscore";
    $dbname2 = "highscore";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $conn2 = mysqli_connect($servername, $username, $password, $dbname2);

    $sql1 = "SELECT id FROM tempscore";
    $result = mysqli_query($conn,$sql1);
    $score = mysqli_num_rows($result);
    echo "<h2>Score: " . $score . "</h2>";

    $sql2 = "INSERT INTO highscore (score) VALUES ($score)";
    mysqli_query($conn2, $sql2);

    $sql3 = "DROP TABLE tempscore";
    mysqli_query($conn, $sql3);

    $sql4 = "CREATE TABLE tempscore (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    letter VARCHAR(30) NOT NULL
    )";
    mysqli_query($conn, $sql4);

    mysqli_close($conn);
    mysqli_close($conn2);
?>
<h2><a href="homepage.php">Return to Homepage</a></h2>
</div>
</body>
</html>
