<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Projects</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .blue-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #1d4ed8;  /* Bleu intense */
            color: white;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .blue-button:hover {
            background-color: #1e40af;  /* Bleu plus foncé au survol */
            transform: scale(1.05);     /* Effet de zoom subtil */
        }

        .blue-button:active {
            background-color: #1e3a8a;  /* Bleu encore plus foncé lorsqu'appuyé */
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .project-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .project-item {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            transition: box-shadow 0.3s ease;
        }

        .project-item:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .project-item a {
            text-decoration: none;
            color: #333;
            font-size: 20px;
            font-weight: bold;
        }

        .status {
            margin: 10px 0;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
<?php require_once __DIR__."/view/includes/navBar.php"?>
    <div style="display: flex; justify-content: center; margin-top: 10px;">
        <a href="./newproject.php" class="blue-button">Creat new project</a>
    </div>
    <div class="container">
        <div class="project-list">
            <!-- Dynamically loaded project links -->
            <?php 
                include_once("./config/config.php");
                include_once("./database/Database.php");
                $taskInfo;
                $connect = (new Database)->db;
                $project = $connect->prepare("SELECT * FROM projects where project_owner_id = ?;");
                if (isset($_SESSION["user"])) {
                    $project->execute([$_SESSION["user"]]);
                }else {
                    echo '<script>window.location.href="http://localhost/project_oop/view/login/login.php"</script>';
                }
                while ($projects = $project->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                        <a href="index.php?project_id='.$projects["project_id"].'" class="project-item">
                            <p style="font-weight: 800; font-size: x-large;">'.$projects["project_name"].'</p>
                            <p class="status">Status: '.$projects["status"];
                    $team = $connect->prepare(TEAM);
                    $team->execute([$projects["project_id"]]);
                    echo '<p>team members: ';
                    while ($teams = $team->fetch(PDO::FETCH_ASSOC)) {
                        echo '<span>'.$teams["firstname"].'</span>'.'<span> '.$teams["lastname"].', </span>';
                    }
                    echo '</p>';
                    echo '</p></a>';
                }
            ?>
        </div>
    </div>

</body>
</html>

