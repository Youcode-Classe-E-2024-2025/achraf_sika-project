<?php

const SQL_DATABASE = "
    CREATE TABLE IF NOT EXISTS Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    lastname VARCHAR(50) NOT NULL,
    firstname Varchar(50) NOT NULL,
    email VARCHAR(100),
    password VARCHAR(250),
    role ENUM('Manager', 'User') DEFAULT 'User',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);

    CREATE TABLE IF NOT EXISTS Tasks (
    task_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    status ENUM('To Do', 'In Progress', 'Done') DEFAULT 'To Do',
    task_type ENUM('Simple', 'Bug', 'Feature') DEFAULT 'Simple',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);

    CREATE TABLE IF NOT EXISTS UserTasks (
    user_id INT,
    task_id INT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (task_id) REFERENCES Tasks(task_id) ON DELETE CASCADE
    );
";

const HOST = "localhost";
const USERNAME = "root";
const PASSWORD = "";
const DBNAME = "PROJECTS";
const SQL_TASKS = 
"SELECT 
    tasks.task_id,
    tasks.title, 
    tasks.description, 
    tasks.status, 
    tasks.task_type, 
    tasks.created_at, 
    users.lastname, 
    users.firstname, 
    users.email, 
    users.role
FROM usertasks 
INNER JOIN users ON usertasks.user_id = users.user_id 
INNER JOIN tasks ON usertasks.task_id = tasks.task_id
WHERE email = ?;
";