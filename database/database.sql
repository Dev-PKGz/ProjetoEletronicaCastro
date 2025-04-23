CREATE DATABASE login_system;

USE login_system;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    sector VARCHAR(50) NOT NULL,
    email VARCHAR(255)
);

-- Inserir um usuário de exemplo
--INSERT INTO users (username, password) VALUES ('admin', PASSWORD('admin123'));

CREATE DATABASE fila_senha;

USE fila_senha;

CREATE TABLE senhas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    senha VARCHAR(10) NOT NULL,
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atendida BOOLEAN DEFAULT FALSE,
    usuario_atendeu VARCHAR(255) NULL
);
