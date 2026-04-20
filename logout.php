<?php
// 1. Inicia a sessão para ter acesso a ela
session_start();

// 2. Remove todas as variáveis da sessão
session_unset();

// 3. Destrói a sessão completamente no servidor
session_destroy();

// 4. Redireciona o utilizador de volta para a página de login
header("Location: login.php");
exit();
?>