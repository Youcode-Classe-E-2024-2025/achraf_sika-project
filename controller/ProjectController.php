<?php
session_start();
include("./../model/UserModel.php");

class ProjectController extends Auth {
    public function __construct() {
        if (!isset( $_POST["members"])) {
            $project = $_POST["project_name"];
            $owner = $_SESSION["user"];
            $category_id = (int) $_POST["category_id"];
            $this->creatproject($project, $owner, $category_id);
            
        }
    }
}
new ProjectController();
?>