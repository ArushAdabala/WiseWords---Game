<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<style>
    #rules{
        width: 1295px;
    }
    table, th, td {
        border: 3px solid black;
    }
</style>
</head>
<body>
<h1 style="text-align:center;" >Welcome to Wordify</h1>
<h2><a href="mainpage.php">PLAY!</a></h2>
<br>

<div class = "row" id = "rules">
<div class = "col">
<h2><b>The rules are simple</b><h2>
<h5>The computer will generate two letters.</h5>
<h5>You just need to enter in a word of any length.</h5>
<h5>However,the first letter of the word must match the first letter generated.</h>
<h5>The last letter of the word must match the second letter generated.</h5>
<h5>You get a point for every acceptable word.</h5>
<h5>The game ends once you type an unacceptable word.</h5>
</div>

<div class = "col">
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "highscore";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $sql = "SELECT score FROM highscore ORDER BY score DESC LIMIT 10;";
    $result = mysqli_query($conn, $sql);

    $counter = 0;
    if (mysqli_num_rows($result) > 0) {
        echo "<table><tr><th>#</th><th>Top Ten Scores</th></tr>";

        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $counter += 1;
            echo "<tr><td>" . $counter . "</td><td>" . $row["score"] . "</td></tr>";
        }

        echo "</table>";
    }
    else {
        echo "0 results";
    }

    mysqli_close($conn);
?>
</div>
</div>
</body>
</html>
