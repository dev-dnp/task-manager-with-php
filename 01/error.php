<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Serviço Indisponível | Taskly</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-page">
    <div class="background-circles">
        <div class="circle circle-1" style="background: #fecaca;"></div> </div>

    <div class="auth-container glass" style="text-align: center;">
        <div style="color: #ef4444; margin-bottom: 20px;">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                <line x1="12" y1="9" x2="12" y2="13"></line>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
            </svg>
        </div>
        <h1 style="font-size: 1.5rem; margin-bottom: 10px;">Serviço Indisponível</h1>
        <p style="color: var(--text-muted); line-height: 1.6;">
            Pedimos desculpa, mas perdemos a ligação com a base de dados. 
            <br><small>(Pode ser um erro de credenciais ou o servidor está em manutenção).</small>
        </p>
        <div style="margin-top: 30px;">
            <a href="index.php" class="btn-block" style="text-decoration: none; display: block;">Tentar Novamente</a>
        </div>
    </div>
</body>
</html>