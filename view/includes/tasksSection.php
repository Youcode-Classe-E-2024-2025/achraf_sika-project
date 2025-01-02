<?PHP
include_once __DIR__ . "/../../controller/TaskController.php";
new task();
?>
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