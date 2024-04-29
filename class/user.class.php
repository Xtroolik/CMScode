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
    public function getEmail() : string {
        return $this->email;
    }

    public static function Register(string $email, string $password) : bool {
        $db = new mysqli("localhost", "root", "", "breaddit");
        $q = $db->prepare("INSERT INTO user (login, password) VALUES (?, ?)");
        $passwordHash = password_hash($password, PASSWORD_ARGON2I);
        $q->bind_param("ss", $email, $passwordHash);
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
            return true;
        } else {
            return false;
        }
    }
    public static function isLogged() {
        if(isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }
    public function LogOut() {
        session_destroy();
    }
    public function changePassword(string $oldpassword, string $newpassword) : bool  {
        $db = new mysqli("localhost", "root", "", "breaddit");
        $sql = "SELECT password FROM user WHERE user.id = ?";
        $q = $db->prepare($sql);
        $q->bind_param("i", $this->id);
        $q->execute();
        $result = $q->get_result();
        $row = $result->fetch_assoc();
        $oldpasswordHash = $row['password'];

        if(password_verify($oldpassword, $oldpasswordHash)){
            $newpasswordHash = password_hash($newpassword, PASSWORD_ARGON2I);
            $sql = "UPDATE user SET password = ? WHERE user.id = ?";
            $q = $db->prepare($sql);
            $q->bind_param("si", $newpasswordHash, $this->id);
            $result = $q->execute();
            return $result;
        } else {
            return false;
        }
    }
}



?>