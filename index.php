<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css?v=3">
</head>
<body>
    <div class="main-section">
        <?php if (isset($_SESSION["user"])) {?>
        <div class="add-section" style="margin-bottom: 1rem;">
            <form action="./controller/TaskController.php?action=add" method="post" autocomplete="off">
                <?php if(isset($_GET["mess"]) && $_GET["mess"] == "error"){?>
                    <style>
                        #tasktitle {
                            outline: auto;
                            outline-color: red;
                        }
                    </style>
                <?php }?>
                <input type="text" name="title" id="tasktitle" placeholder="this field is required">
                <input type="text" name="description" id="taskdescription" placeholder="this field is required">
                <select name="status" id="">
                    <option value="To Do">To Do</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Done">Done</option>
                </select>
                <select name="type" id="tasktype">
                    <option value="simple">Simple</option>
                    <option value="bug">Bug</option>
                    <option value="feature">Feature</option>
                </select>
                <button type="submit">add &nbsp; <span>&#43;</span></button>
            </form>
        </div>
    <?php include_once __DIR__. "/view/includes/tasksSection.php";?>
    <script src="./assets/js/script.js"></script>
    <?php include_once __DIR__. "/view/includes/editModal.php";?>
    <?php }?>
</body>
</html>