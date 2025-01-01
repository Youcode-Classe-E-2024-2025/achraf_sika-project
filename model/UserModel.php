<?php
include("../database/Database.php");

class Auth extends connect {
    public function insertUser($firstname, $lastname, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->connect->prepare("INSERT INTO Users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
        return $this->connect->execute([$firstname, $lastname, $email, $hashedPassword]);
    }

    public function getUserByEmail($email) {
        $stmt = $this->connect->query("SELECT * FROM Users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
