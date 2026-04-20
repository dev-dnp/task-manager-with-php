<?php
$host = "localhost";
$db   = "gestor_tarefas";
$user = "root";
$pass = "MinhaSenha!123";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>