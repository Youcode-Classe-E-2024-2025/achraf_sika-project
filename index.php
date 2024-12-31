<?PHP
include_once __DIR__ . "/Database.php";
// header("index.php");
new task();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <div class="show-todo-section">
            <?php (new task)->viewTask("To Do"); ?>
            <div class="todo-item">
                <select name="status" id="">
                    <option value="todo">To Do</option>
                    <option value="inprogress">In Progress</option>
                    <option value="done">Done</option>
                </select>
                <h2>this</h2>
                <br>
                <small>created 1-1-2025</small>
            </div>
        </div>
    </div>
    <?php include_once __DIR__. "/editModal.php";?>
</body>
</html>