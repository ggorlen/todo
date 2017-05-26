CREATE DATABASE test_todolist;

USE test_todolist;

DROP TABLE IF EXISTS tasks;

CREATE TABLE tasks (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
  description VARCHAR(255) NOT NULL, 
  due TIMESTAMP NULL,
  created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL 
);