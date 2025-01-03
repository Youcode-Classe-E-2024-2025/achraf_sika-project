<?php
require 'db_connect.php';

$user_id = $_SESSION['user_id'];  // Get logged-in user ID
$stmt = $db->prepare("SELECT * FROM projects WHERE project_owner_id = ?");
$stmt->execute([$user_id]);
$projects = $stmt->fetchAll();

foreach ($projects as $project) {
    echo '<div class="project-item">';
    echo '<a href="project_details.php?project_id=' . $project['project_id'] . '">' . $project['project_name'] . '</a>';
    echo '<p class="status">Status: ' . $project['status'] . '</p>';
    echo '</div>';
}
?>