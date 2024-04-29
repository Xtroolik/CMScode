<?php
require_once('class/user.class.php');
session_start();
$_SESSION['user']->LogOut();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="big">
        <h1>Wylogowano pomyślnie</h1>
        <div id="text">
            <a href="index.php">Powrót do strony głównej</a>
        </div>
    </div>
</body>
</html>