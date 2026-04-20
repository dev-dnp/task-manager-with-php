<?php
session_start();
include 'db.php'; 

// 1. Verificamos se o utilizador está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

try {
    // --- ADICIONAR TAREFA ---
    if (isset($_POST['add'])) {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $desc = mysqli_real_escape_string($conn, $_POST['description']);
        
        $sql = "INSERT INTO tasks (title, description, user_id) VALUES ('$title', '$desc', '$user_id')";
        $conn->query($sql);
        header("Location: index.php");
        exit();
    }

    // --- ATUALIZAR TAREFA (NOVO) ---
    if (isset($_POST['update'])) {
        $id = intval($_POST['task_id']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $desc = mysqli_real_escape_string($conn, $_POST['description']);
        
        // Segurança: Só atualiza se a tarefa pertencer ao utilizador logado
        $sql = "UPDATE tasks SET title='$title', description='$desc' 
                WHERE id=$id AND user_id=$user_id";
        
        $conn->query($sql);
        header("Location: index.php");
        exit();
    }

    // --- ELIMINAR TAREFA ---
    if (isset($_GET['delete'])) {
        $id = intval($_GET['delete']);
        
        $sql = "DELETE FROM tasks WHERE id=$id AND user_id=$user_id";
        $conn->query($sql);
        header("Location: index.php");
        exit();
    }

    // --- ALTERNAR STATUS ---
    if (isset($_GET['toggle'])) {
        $id = intval($_GET['toggle']);
        $current = mysqli_real_escape_string($conn, $_GET['status']);
        $newStatus = ($current == 'pendente') ? 'concluida' : 'pendente';
        
        $sql = "UPDATE tasks SET status='$newStatus' WHERE id=$id AND user_id=$user_id";
        $conn->query($sql);
        header("Location: index.php");
        exit();
    }

} catch (Exception $e) {
    // Captura falhas de base de dados e redireciona para a página de erro profissional
    header("Location: error.php");
    exit();
}
?>