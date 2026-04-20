<?php
// 1. Inicia o buffer. Isso "segura" qualquer erro na memória em vez de enviar para o ecrã.
ob_start();

// 2. Desativa a exibição de erros brutos para o utilizador
ini_set('display_errors', 0);
error_reporting(0);

// Configurações do Banco (Docker)
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
    // 3. Limpa qualquer aviso que tenha ficado no buffer
    ob_end_clean();
    
    // 4. Agora o redirecionamento vai funcionar sem o erro de "headers already sent"
    header("Location: error.php");
    exit();
}