<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GET & POST Requests</title>
</head>
<body>
<h2>Search Requests</h2>
    <?php

        if (isset ($_SESSION["variableGET"]) || isset ($_SESSION["variablePOST"])) {
            output();
        } else {
            echo "<p>No variables are set</p>";
        }

        function output() {
            if (isset ($_SESSION["variableGET"])) {
                echo "<p>This is my GET search keyword: " . $_SESSION["variableGET"] . "</p>";
            }

            if (isset ($_SESSION["variablePOST"])) {
                echo "<p>This is my POST search keyword: " . $_SESSION["variablePOST"] . "</p>";
            }
        }

    ?>
</body>
</html>