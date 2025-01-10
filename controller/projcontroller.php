<?php
function projectview($id){
    $connect = (new Database)->db;
    $stmt = $connect->prepare("SELECT * FROM projects where project_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>