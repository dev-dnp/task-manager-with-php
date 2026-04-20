<?php
ob_start();

ini_set('display_errors', 0);
error_reporting(0);

// Configurações
$host = 'db'; 
$user = 'root';
$pass = 'MinhaSenha!123';
$db   = 'task_manager';


// Ativar o relatório de erros do MySQLi para lançar exceções
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Tenta a conexão
    $conn = new mysqli($host, $user, $pass, $db);
    $conn->set_charset("utf8mb4");
} catch (Exception $e) {
    // Limpa qualquer aviso que tenha ficado no buffer
    ob_end_clean();
    
    // redirecionamento 
    header("Location: error.php");
    exit();
}