<?php

use app\core\Application;

class m0002_todo_table{

    public function up(){
        $db = Application::$app->db;
        $sql = "CREATE TABLE IF NOT EXISTS todo(
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description VARCHAR(1000) NOT NULL,
            user_id INT NOT NULL,
            status TINYINT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id)
        );";
        $db->pdo->exec($sql);

    }

    public function down(){
        $db = Application::$app->db;
        $sql = "DROP TABLE todo;";
        $db->pdo->exec($sql);
    }
}