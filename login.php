<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Taskly | Login</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body class="auth-page">
    <div class="background-circles">
        <div class="circle circle-1"></div>
    </div>

    <div class="auth-container glass">
        <div class="auth-header">
            <div class="logo-area" style="justify-content: center; margin-bottom: 20px;">
                <span class="logo-icon">t/</span>
            </div>
            <h1>Bem-vindo de volta<span class="dot">.</span></h1>
            <p>Acede à tua conta para gerir as tuas tarefas.</p>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert error">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 8px;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                Credenciais inválidas. Tenta novamente.
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
            <div class="alert success">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 8px;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                Conta criada! Podes fazer login.
            </div>
        <?php endif; ?>

        <form action="auth_actions.php" method="POST">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required placeholder="teu@email.com">
            </div>
            <div class="form-group">
                <label>Palavra-passe</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>
            <button type="submit" name="login" class="btn-block">Entrar</button>
            <p class="auth-footer">Não tens conta? <a href="register.php">Regista-te</a></p>
        </form>
    </div>
</body>
</html>