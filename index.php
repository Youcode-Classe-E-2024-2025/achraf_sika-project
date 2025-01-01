<?PHP
include_once __DIR__ . "/Database.php";
new task();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css?v=3">
</head>
<body>
    <div class="main-section">
        <div class="add-section">
            <form action="./Database.php?action=add" method="post" autocomplete="off">
                <?php if(isset($_GET["mess"]) && $_GET["mess"] == "error"){?>
                    <style>
                        #tasktitle {
                            border-color: red;
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
        <div class="task-main-section">
            <div class="tasks-container">
                <h2 style="background-color: #d9d7d7;">To Do</h2>
                <div class="show-todo-section" id="status-section">
                    <?php (new task)->viewTask("To Do"); ?>
                </div>
            </div>
            <div class="tasks-container">
                <h2 style="background-color: #c5c5ff;">In Progress</h2>
                <div class="show-inprogress-section" id="status-section">
                    <?php (new task)->viewTask("In Progress"); ?>
                </div>
            </div>
            <div class="tasks-container">
                <h2 style="background-color: #d1fae5;">Done</h2>
                <div class="show-done-section" id="status-section">
                    <?php (new task)->viewTask("Done"); ?>
                </div>
            </div>
        </div>
    </div>
    <script src="./script.js"></script>
    <?php include_once __DIR__. "/editModal.php";?>
</body>
</html>