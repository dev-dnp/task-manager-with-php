-- 1. Criar e usar a Base de Dados
CREATE DATABASE IF NOT EXISTS task_manager;
USE task_manager;

-- 2. Eliminar tabelas existentes para evitar conflitos de estrutura
DROP TABLE IF EXISTS tasks;
DROP TABLE IF EXISTS users;

-- 3. Criar Tabela de Utilizadores
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 4. Criar Tabela de Tarefas
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status ENUM('pendente', 'concluida') DEFAULT 'pendente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Chave Estrangeira: Garante que o user_id existe na tabela users
    CONSTRAINT fk_user_task FOREIGN KEY (user_id) 
        REFERENCES users(id) 
        ON DELETE CASCADE
) ENGINE=InnoDB;