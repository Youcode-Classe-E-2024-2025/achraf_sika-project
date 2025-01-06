<?php
session_start();
unset($_SESSION["user"]);
header("location: /project_oop/view/login/login.php");
?>