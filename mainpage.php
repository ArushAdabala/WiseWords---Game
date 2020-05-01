<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<style>    
    #ltrs {
      text-align: center;
      font-size: 100px;
      padding-top: 150px;
      padding-bottom: 150px;
      font-family: "Arial Black"
    }
    
    #userWord {
      width: 600px;
    }
    
    #userInput {
      padding-top: 20px;
    }
</style>

</head>

<body>
<div id = "ltrs" class = "container">
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tempscore";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $counter = 0;

    $words = explode("\n", file_get_contents('Dictionary.txt'));
    
    if (empty($_POST)) {
        $randWord = $words[rand(0,58109)];

        $letter1 = substr($randWord,0,1);
        $letter2 = substr($randWord,-3,1);

        echo $letter1 . "_ _ _ _" . $letter2;
    }
    else{
        $word = $_POST["word"];
        $inputLetter1 = substr($word, 0, 1);
        $inputLetter2 = substr($word, -1);
        $letter1 = $_POST["letter1"];
        $letter2 = $_POST["letter2"];

        if (strcasecmp($letter1, $inputLetter1) == 0 && strcasecmp($letter2, $inputLetter2) == 0){
            for($i = 0; $i < 58110; $i++){
                $temp = substr($words[$i],0,-1);
                if(strcasecmp($temp, $word) == 0){
                    $counter += 1;

                    $sql = "INSERT INTO tempscore (letter) VALUE ('a')";
                    mysqli_query($conn, $sql);

                    header("Location: mainpage.php");
                }
                else{
                    if($counter == 0){
                        header("Location: gameover.php");
                    }
                }
            }
        }
        else{
            header("Location: gameover.php");
        }
    }
?>
</div>


<div id = "userWord" class = "container">
    <div class = "card bg-light">
        <div class = "card-body text-center">
            <form method = "post">
                <div id = "userInput" class="input-group mb-3">
                    <input type="text" class="form-control" name="word">
                    <input type="hidden" name="letter1" value="<?php echo $letter1; ?>" />
                    <input type="hidden" name="letter2" value="<?php echo $letter2; ?>" />

                    <div class="input-group-prepend">
                        <button class="btn btn-outline-primary" type="submit">Enter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
