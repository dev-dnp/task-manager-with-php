<?php
include 'db.php';
session_start();

try {
    // --- REGISTO DE UTILIZADOR ---
    if (isset($_POST['register'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password_raw = $_POST['password']; // Pegamos a senha bruta para validar

        // Validação extra: Garante que os campos não estão vazios (apenas espaços)
        if (empty(trim($name)) || empty(trim($email)) || empty(trim($password_raw))) {
            header("Location: register.php?error=empty_fields");
            exit();
        }

        $pass_hash = password_hash($password_raw, PASSWORD_DEFAULT);

        // Verificar se o email já existe
        $check = $conn->query("SELECT id FROM users WHERE email='$email'");
        if ($check->num_rows > 0) {
            header("Location: register.php?error=email_exists");
            exit();
        }

        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$pass_hash')";
        $conn->query($sql);
        
        header("Location: login.php?msg=success");
        exit();
    }

    // --- LOGIN ---
    if (isset($_POST['login'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = $_POST['password'];

        $result = $conn->query("SELECT * FROM users WHERE email='$email'");
        
        if ($user = $result->fetch_assoc()) {
            if (password_verify($pass, $user['password'])) {
                // Prevenção de Fixação de Sessão (Boa prática de segurança)
                session_regenerate_id(true); 
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                
                header("Location: index.php");
                exit();
            }
        }
        
        header("Location: login.php?error=invalid");
        exit();
    }

} catch (Exception $e) {
    // Redireciona se a tabela 'users' não existir ou o DB cair
    header("Location: error.php");
    exit();
}
?>