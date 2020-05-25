<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Date & Time</title>
</head>
<body>
    <h2> Server Date & Time </h2>

        <?php
            echo "Today is " .date('l, M d, Y') . "<br>";
            echo "The time is " .date('H:i:s');
        ?>
</body>
</html>