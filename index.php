<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GET & POST Forms</title>
</head>
<body>
    <?php

        if(isset($_GET["searchGET"]) || isset($_POST["searchPOST"])) {
            
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $_SESSION["variableGET"] = $_GET["searchGET"];
            }
    
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $_SESSION["variablePOST"] = $_POST["searchPOST"];
            }
        }
        
    ?>

    <h2> GET & POST methods to store session variables </h2>

    <p><form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    <label>Enter search keyword for GET method: </label>
    <input type="text" name="searchGET">
    <input type="submit" value="Submit">
    </form></p>

    <p><form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    <label>Enter search keyword for POST method: </label> 
    <input type="text" name="searchPOST">
    <input type="submit" value="Submit">
    </form></p>

    <p><a href="task1_4.php">View my search requests</a></p>
</body>
</html>