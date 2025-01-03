<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group select {
            appearance: none;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #4CAF50;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background-color: #1d4ed8;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #1e40af;
            transform: scale(1.05);
        }
        .submit-btn:active {
            background-color: #1e3a8a;  /* Bleu encore plus foncé lorsqu'appuyé */
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Create New Project</h1>
        
        <form action="./controller/ProjectController.php" method="POST">
            
            <div class="form-group">
                <label for="project_name">Project Name</label>
                <input type="text" id="project_name" name="project_name" required>
            </div>

            <div class="form-group">
                <label for="members">Team Members <br><span style="font-size: 14px; color: gray; font-weight: 100;">select multiple by holding:</span> <span style="font-size: 30px; outline: auto; padding: 0px 2px;">ctrl</span> + click</label>
                <select id="members" name="members[]" multiple>
                    <?php 
                    include("./database/Database.php");
                    $taskInfo;
                    $connect = (new Database)->db;
                    $user = $connect->query("SELECT * FROM Users;");
                    while ($users= $user->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="'.$tasks["user_id"].'">'.$tasks["email"].'</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id" required>
                    <option value="" disabled selected>Select Category</option>
                    <?php 
                    $taskInfo=[];
                    $task = $connect->query("SELECT * FROM categories;");
                    while ($tasks= $task->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="'.$tasks["category_id"].'">'.$tasks["category_name"].'</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="submit-btn">Create Project</button>
            
        </form>
    </div>

</body>
</html>