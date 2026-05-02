<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskly | Criar Conta</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
</head>
<body class="auth-page">
    <div class="background-circles">
        <div class="circle circle-1"></div>
        <div class="circle circle-2"></div>
    </div>

    <div class="auth-container glass">
        <div class="auth-header">
            <div class="logo-area" style="justify-content: center; margin-bottom: 10px;">
                <span class="logo-icon">t/</span>
            </div>
            <h1>Criar nova conta<span class="dot">.</span></h1>
            <p>Junta-te a nós e organiza a tua rotina.</p>
        </div>

        <form action="auth_actions.php" method="POST">
            <div class="form-group">
                <label>Nome Completo</label>
                <input type="text" name="name" required placeholder="Ex: Domingos Pedro">
            </div>
            
            <div class="form-group">
                <label>Email Profissional</label>
                <input type="email" name="email" required placeholder="exemplo@mail.com">
            </div>

            <div class="form-group">
                <label>Palavra-passe</label>
                <input type="password" name="password" required placeholder="Mínimo 6 caracteres" minlength="6">
            </div>

            <button type="submit" name="register" class="btn-block">Criar minha conta</button>
            
            <p class="auth-footer">Já tens uma conta? <a href="login.php">Entrar agora</a></p>
        </form>
    </div>
</body>
</html>