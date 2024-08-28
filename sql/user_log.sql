DROP DATABASE IF EXISTS user_log;
CREATE DATABASE user_log CHARACTER SET utf8mb4 ;
use user_log ;

CREATE TABLE Usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(1024),
    passwd VARCHAR(1024)
);
GRANT ALL PRIVILEGES ON user_log.* TO 'root'@'localhost';
FLUSH PRIVILEGES;

INSERT INTO Usuarios (nombre, passwd) VALUES ("xabier","1234");
