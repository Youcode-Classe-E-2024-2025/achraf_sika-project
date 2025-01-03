<?php
include("./../database/Database.php");

class Auth extends connect {
    public $connect;
    public function insertUser($firstname, $lastname, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->connect = (new Database)->db;
        $stmt = $this->connect->prepare("INSERT INTO Users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$firstname, $lastname, $email, $hashedPassword]);
    }

    public function getUserByEmail($email) {
        $this->connect = (new Database)->db;
        $stmt = $this->connect->prepare("SELECT * FROM Users WHERE email = ?;");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function creatproject($name, $owner, $category) {
        $this->connect = (new Database)->db;
        $stmt = $this->connect->prepare("INSERT INTO projects (project_name, project_owner_id, category_id) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $owner, $category]);
    }
}
?>
