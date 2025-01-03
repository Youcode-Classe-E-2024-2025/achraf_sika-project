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

    CREATE TABLE IF NOT EXISTS categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE
    );

    CREATE TABLE IF NOT EXISTS projects (
    project_id INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(255) NOT NULL,
    project_owner_id INT,
    category_id INT,
    status ENUM('Planned', 'Active', 'On Hold', 'Completed', 'Cancelled') DEFAULT 'Planned',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE SET NULL,
    FOREIGN KEY (project_owner_id) REFERENCES users(user_id) ON DELETE SET NULL
    );

    CREATE TABLE IF NOT EXISTS Tasks (
    task_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    project_id INT,
    status ENUM('To Do', 'In Progress', 'Done') DEFAULT 'To Do',
    task_type ENUM('Simple', 'Bug', 'Feature') DEFAULT 'Simple',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(project_id)
    );

    CREATE TABLE IF NOT EXISTS UserTasks (
    user_id INT,
    task_id INT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (task_id) REFERENCES Tasks(task_id) ON DELETE CASCADE
    );
    insert into categories(category_name) values('Frontend'),('Backend'),('UI'),('UX');
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