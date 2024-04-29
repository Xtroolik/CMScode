<?php
session_start();
require("./class/user.class.php");
?>
<?php
if (isset($_REQUEST['action']) && $_REQUEST['action'] == "login") {
    $result = User::Login($_REQUEST['login'], $_REQUEST['password']);
    if($result)
        echo "Login Successful";
    else
        echo "Login Failed";
}
if(isset($_REQUEST['action']) && $_REQUEST['action'] == "register" && isset($_REQUEST['login']) && isset($_REQUEST['password']) &&isset($_REQUEST['passwordRepeat'])) {
    $result = User::Register($_REQUEST['login'], $_REQUEST['password']);
    if($result)
        echo "Account Creation Successful";
    else
        echo "Account Creation Failed";
}


//$d = mysqli_connect("localhost", "root", "", "breaddit");
//mysqli_query($d, "SELECT * FROM user");

?>
<form action="login.php" method="post">
    <label for="login">Login: </label> <br>
    <input type="email" name="login" id="login"><br>
    <label for="password">Hasło: </label> <br>
    <input type="password" name="password" id="password"> <br>
    <input type="hidden" name="action" value="login">
    <input type="submit" value="Zaloguj">
</form>
<h1>Register</h1>
<form action="login.php" method="post">
<label for="login">Login: </label> <br>
    <input type="email" name="login" id="login"><br>
    <label for="password">Hasło: </label> <br>
    <input type="password" name="password" id="password"> <br>
    <label for="passwordRepeat">Powtórz hasło: </label> <br>
    <input type="password" name="passwordRepeat" id="passwordRepeat"> <br>
    <input type="hidden" name="action" value="register">
    <input type="submit" value="Zarejestruj">
</form>
<script>
    function redirect() {
        window.location.href = "http://localhost://cms/index.php"
    }
    setTimeout(redirect, 5000)
</script>