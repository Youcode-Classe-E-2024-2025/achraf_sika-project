<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include __DIR__."/../model/taskModel.php";
if (isset($_GET["action"])) {
    if ($_GET["action"]=="add") {
        if(isset($_POST["title"])) { 
            $title = $_POST["title"];
            $description = $_POST["description"];
            $status = $_POST["status"];
            $type = $_POST["type"];
            $project_id = $_SESSION["project_id"];
            $assign = (int)$_POST["assign"];
            if(empty($title) || empty($description) || empty($status) || empty($type)) {
                header("Location: /project_oop/index.php?mess=error");
            }else {
                (new task)->insertTask($title,$description, $status, $type, $project_id, $assign);
                header("Location: /project_oop/index.php");
            }
        }
    }elseif ($_GET["action"]=="delete") {
        $id = $_POST["delete"];
        (new task)->deleteTask($id);
        header("Location: /project_oop/index.php");
    }elseif ($_GET["action"]=="edit") {
        if(isset($_POST["name"])) { 
            $title = $_POST["name"];
            $description = $_POST["description"];
            $status = $_POST["status"];
            $type = $_POST["type"];
            $id = $_POST["id"];
            if(empty($title) || empty($description) || empty($status) || empty($type) || empty($id)) {

            }else {
                (new task)->editTask($title,$description, $status, $type, $id);
                header("Location: /project_oop/index.php");
            }
        }
    }
}
?>