<?php
session_start();
include_once("./config/config.php");
if (!isset($_SESSION["user"])) {
    header("location: view/login/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css?v=3">
    <script>
        document.addEventListener("DOMContentLoaded",()=>{
            if (window.location.href!="http://localhost/project_oop/index.php") {
                window.location.href="http://localhost/project_oop/index.php";
            }
        })
    </script>
</head>
<body>
<?php require_once __DIR__."/view/includes/navBar.php"?>
<div class="bg-seal-900 p2">
    <button onclick="opendesc()" id="desc-btn">description</button>
    <button onclick="openkanban()" id="kanban-btn">kanban</button>
</div>

<div id="task-main-section" style="display: none;">
<div class="popup-overlay" id="popup">
    <div class="popup-content">
        <h2>Add New Task</h2>
        <form action="./controller/TaskController.php?action=add" method="post" autocomplete="off">
            <?php if(isset($_GET["mess"]) && $_GET["mess"] == "error"){?>
                <style>
                    #tasktitle {
                        outline: auto;
                        outline-color: red;
                    }
                </style>
            <?php }?>
            <input type="text" name="title" id="tasktitle" placeholder="Task title" required>
            <input type="text" name="description" id="taskdescription" placeholder="Task description" required>
            <select name="status" id="">
                <option value="To Do">To Do</option>
                <option value="In Progress">In Progress</option>
                <option value="Done">Done</option>
            </select>
            <select name="assign" id="">
                <?php
                $connect = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USERNAME, PASSWORD);
                $team = $connect->prepare(TEAM);
                $team->execute([$_SESSION["project_id"]]);
                while ($teams = $team->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value='.(int)$teams["user_id"].'>'.$teams["firstname"].' '.$teams["lastname"].'</option>';
                }
                ?>
            </select>
            
            <select name="type" id="tasktype">
                <option value="simple">Simple</option>
                <option value="bug">Bug</option>
                <option value="feature">Feature</option>
            </select>
            <button type="submit">Add &nbsp; <span>&#43;</span></button>
        </form>
        <button class="close-button" onclick="closePopup()">Close</button>
    </div>
</div>

<div class="header">
    <a href="#" class="blue-button" onclick="openPopup()">Create New Task</a>
</div>
</div>
<style>
    .bg-seal-900{
        background-color:rgb(60, 77, 103);
        color: white;
    }
    .p2{
        padding: 4px;
        display: flex;
        gap: 10px;
    }
    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000; 
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .popup-overlay[style*="display: flex"] {
        opacity: 1;
    }

    .popup-content {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        width: 400px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
        text-align: center;
        position: relative;
        z-index: 1001;
    }

    .popup-content input,
    .popup-content select {
        width: 90%;
        margin: 10px 0;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .popup-content button {
        padding: 12px 24px;
        background-color: #1d4ed8;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
    }

    .popup-content button:hover {
        background-color: #1e40af;
    }

    .close-button {
        background-color: #d9534f;
    }

    .close-button:hover {
        background-color: #c9302c;
    }

    .blue-button {
        display: inline-block;
        padding: 12px 24px;
        background-color: #2563eb;
        color: white;
        font-size: 16px;
        text-decoration: none;
        border-radius: 8px;
        margin: 30px;
    }

    .blue-button:hover {
        background-color: #1e3a8a;
    }
    .tasks-container{
        width: 27%;
    }
    #status-section::-webkit-scrollbar {
    display: none;
    }

    #status-section {
        width: 100%;
    -ms-overflow-style: none;
    scrollbar-width: none;
    }
</style>

<script>
    function openPopup() {
        document.getElementById('popup').style.display = 'flex';
    }

    function closePopup() {
        document.getElementById('popup').style.display = 'none';
    }

    function openkanban() {
        document.getElementById("desc-section").style.display = "none";
        document.querySelector('.main-section').style.display = 'block';
        document.getElementById('task-main-section').style.display = 'block';
    }
    function opendesc() {
        document.getElementById("desc-section").style.display = "block";
        document.querySelector('.main-section').style.display = 'none';
        document.getElementById('task-main-section').style.display = 'none';
    }
</script>
    <div class="main-section" style="margin-bottom: 50px; display: none;">
        <?php if (isset($_SESSION["user"])) {


    include_once __DIR__. "/view/includes/tasksSection.php";
    include_once __DIR__. "/view/includes/editModal.php";
    }
    if (isset($_GET["project_id"])) {
        $_SESSION["project_id"] = $_GET["project_id"];
    }
    ?>
    <div id="desc-section">
        <?php
        include_once __DIR__."/controller/projcontroller.php";
        $proj = projectview($_SESSION["project_id"]);
        if ($proj =="" || $proj ==null) {
            include_once __DIR__. "/view/profile/project_detail.php";
        }
        else {
            echo $proj ["description"];
        }
        ?>
</div>
    <script src="./assets/js/script.js"></script>
</body>
</html>