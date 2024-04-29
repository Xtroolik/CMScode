<?php
session_start();
$u = $_SESSION['user'];

if(isset($_REQUEST['oldpassword']) && isset($_REQUEST['newpasswordRepeat']) && isset($_REQUEST['newpasswordInputRepeat'])) {
    $oldPassword = $_REQUEST['oldpassword'];
    $newpassword = $_REQUEST['newpasswordRepeat'];
    $newpasswordRepeat = $_REQUEST['newpasswordInputRepeat'];
    if($newpassword == $newpasswordRepeat) {
        $success = $u->changePassword();
        if($success)
            $result = "Hasło zostało zmienione.";
        else
        $result = "Nie udało sie zmienić hasła";
    } else {
        $result = "Hasła nie są zgodne. Hasło nie zostało zmienione!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="logout.php">
        <button id="logOut">Wyloguj się</button>
    </a>
    <div id="container">
        <form action="profile.php">
        <label for="login">Login: </label> <br>
        <input type="email" name="login" id="login" required value="<?php echo $u->getEmail(); ?> readonly"><br>
        <label for="oldpassword">Stare hasło: </label> <br>
        <input type="password" name="oldpassword" id="oldpassword"> <br>
        
        <label for="passwordRepeat">Nowe hasło: </label> <br>
        <input type="password" name="newpasswordRepeat" id="newpasswordRepeat"> <br>
        <label for="passwordInputRepeat">Nowe hasło: </label> <br>
        <input type="password" id="newpasswordInputRepeat" name="newpasswordInputRepeat"> <br>
        <button type="submit" name="submit">Zmień hasło</button> <br>
        <?php
            if(isset($result)) {
                echo $result;
            }
        ?>
        </form>
               
    </div>
    
</body>
</html>