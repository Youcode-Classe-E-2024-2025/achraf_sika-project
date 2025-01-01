<link rel="stylesheet" href="style.css">
<?php
include_once __DIR__ . "/config.php";

class Database {
    protected $db;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USERNAME, PASSWORD);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            try {
                $conn = new PDO("mysql:host=" . HOST, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->exec("CREATE DATABASE IF NOT EXISTS " . DBNAME);
                $conn->exec("USE " . DBNAME);
                $conn->exec(SQL_DATABASE);
                
                
                $this->db = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USERNAME, PASSWORD);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }
}

class connect extends Database {
    protected $connect;
    public function __construct() {
        $this->connect=(new Database)->db;
        return $this->connect;
    }
}
class task extends connect {
    protected $connect;
    private $taskInfo;
    private $id, $title, $descrption, $status, $type, $creation_date;
    public function __construct() {
        $this->connect = (new connect())->connect;
        $task = $this->connect->query("SELECT * FROM tasks ORDER BY task_id DESC");
        while ($tasks= $task->fetch(PDO::FETCH_ASSOC)) {
            $this->taskInfo[] = $tasks;
        }
    }
    public function viewTask($stat) {
        try {
            if ($this->taskInfo === null) {
                throw new Exception("Create a New Task");
            }
            foreach ($this->taskInfo as $task) {
                if (in_array($stat,$task)) {
                    echo '<div id="taskCard" class="task-card">
                            <div class="task-content">
                                <div class="task-header">
                                    <h2 id="taskName" class="task-title">'.$task["title"].'</h2>
                                    <span id="taskType" class="task-type">'.$task["task_type"].'</span>
                                </div>
                                <p id="taskDescription" class="task-description">'.$task["description"].'</p>
                                <div class="task-footer">
                                    <div class="task-meta">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="task-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Created: <span id="taskDate">'.$task["created_at"].'</span>
                                    </div>
                                    <div class="manage-task">
                                        <form action="./Database.php?action=delete" method="post">
                                            <input id="taskId" type="hidden" name="delete" value="'.$task["task_id"].'">
                                            <input type="submit" class="delete-button" value="Delete">
                                        </form>
                                        <button id="editButton" onclick="edit(this.previousElementSibling.firstElementChild.value,this.parentElement.parentElement.previousElementSibling,this.parentElement.parentElement.previousElementSibling.previousElementSibling.firstElementChild,this.parentElement.parentElement.previousElementSibling.previousElementSibling.lastElementChild,parentElement.parentElement.parentElement.nextElementSibling.lastElementChild.lastElementChild.textContent)" class="edit-button">Edit</button>
                                    </div>
                                </div>
                            </div>
                            <div class="task-footer-bg">
                                <div class="task-footer-content">
                                    <div class="user-meta">
                                        <span class="user-name">Sarah Johnson</span>
                                    </div>
                                    <span id="taskStatus" class="task-status">'.$task["status"].'</span>
                                </div>
                            </div>
                        </div>  
                    ';
                }
            }
        }catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function editTask($title,$description,$status,$task_type,$id) {
        $stmt = $this->connect->prepare("UPDATE tasks set title = ?, description = ?, status = ?, task_type = ? where task_id = ?");
        $res = $stmt->execute([$title,$description,$status,$task_type,$id]);
    }
    public function deleteTask($id) {
        $stmt = $this->connect->prepare("DELETE FROM tasks where task_id = ?");
        $res = $stmt->execute([$id]);
    }
    public function insertTask($title,$description,$status,$task_type) {
        $stmt = $this->connect->prepare("INSERT INTO tasks(title, description, status, task_type) VALUE(?,?,?,?)");
        $res = $stmt->execute([$title,$description,$status,$task_type]);
    }
}
if (isset($_GET["action"])) {
    if ($_GET["action"]=="add") {
        if(isset($_POST["title"])) { 
            $title = $_POST["title"];
            $description = $_POST["description"];
            $status = $_POST["status"];
            $type = $_POST["type"];
            if(empty($title) || empty($description) || empty($status) || empty($type)) {
                header("Location: ./index.php?mess=error");
            }else {
                (new task)->insertTask($title,$description, $status, $type);
                header("Location: ./index.php");
            }
        }
    }elseif ($_GET["action"]=="delete") {
        $id = $_POST["delete"];
        (new task)->deleteTask($id);
        header("Location: ./index.php");
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
                header("Location: ./index.php");
            }
        }
    }
}
new connect();
?>