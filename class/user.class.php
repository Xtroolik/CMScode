<?php
class User {
    private $id;
    private $email;
    private $password;

    public function __construct(int $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    public static function Register(string $email, string $password) : bool {
        $db = new mysqli("localhost", "root", "", "breaddit");
        $q = $db->prepare("INSERT INTO user (email, password) VALUES (?, ?)");
        $passwordHash = password_hash($password, PASSWORD_ARGON2I);
        $q->bind_param("ss", $login, $passwordHash);
        $result = $q->execute();
        return $result;
    }
    public static function Login(string $email, string $password) : bool {

        $db = new mysqli("localhost", "root", "", "breaddit");
        $q = "SELECT * FROM user WHERE login = ? LIMIT 1";
        $q = $db->prepare($q);
        $q->bind_param("s", $email);
        $q->execute();
        $result = $q->get_result();
        $row = $result->fetch_assoc();
        $id = $row['ID'];
        $passwordHash = $row['Password'];
        if(password_verify($password, $passwordHash)) {
            $user = new User($id, $email);
            $_SESSION['user'] = $user;
        } else {
            return false;
        }
    }
    public function LogOut() {

    }
}


?>