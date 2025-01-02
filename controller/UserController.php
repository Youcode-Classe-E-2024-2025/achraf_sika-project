<?php
session_start();
include("./../model/UserModel.php");

class UserController extends Auth {
    public function signUp($firstname, $lastname, $email, $password) {
        return $this->insertUser($firstname, $lastname, $email, $password);
    }
    
    public function login($email, $password) {
        $user = $this->getUserByEmail($email);
        if ($user) {
            // Verify the entered password against the stored hashed password
            if (password_verify($password, $user['password'])) {
                echo "Password is correct!<br>";
                return $user;
            } else {
                echo "Password is incorrect!<br>";
                header("Location: ../view/login/login.php?error=Password_or_email_incorrect");
                return false;
            }
        } else {
            header("Location: ../view/login/login.php?error=Password_or_email_incorrect");
            return false;
        }
    }
    public function __construct() {
        if (isset($_GET['action']) && $_GET['action'] == 'signup' && $_SERVER["REQUEST_METHOD"] == "POST") {
            $firstname = $_POST['first_name'];
            $lastname = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $result = $this->signUp($firstname, $lastname, $email, $password);
            if ($result) {
                header("Location: ../view/login/login.php");
                exit();
            } else {
                echo "Erreur lors de l'inscription.";
            }
        }

        if (isset($_GET['action']) && $_GET['action'] == 'login' && $_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $result = $this->login($email, $password);
            if ($result) {
                $_SESSION["user"] = $email;
                if($result['role'] == "User"){
                    header('Location: ../index.php');
                }else{
                    header('Location: ../view/layouts/admin.php');
                }
                // Redirect or start session, etc.
            } else {
                echo "Erreur lors de la connexion. Vérifiez vos identifiants.";
            }
        }
    }
}
new UserController();
?>
