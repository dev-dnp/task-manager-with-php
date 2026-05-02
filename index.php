<?php
date_default_timezone_set('Africa/Luanda');
session_start();
include 'db.php';

// Proteção de Sessão
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// Query filtrada para segurança
$sql = "SELECT * 
        FROM tasks 
        WHERE user_id = $user_id 
        AND DATE(start_date) != CURDATE()
        ORDER BY status DESC, created_at DESC";

$sql2 = "SELECT * 
         FROM tasks 
         WHERE user_id = $user_id 
         AND DATE(start_date) = CURDATE()
         ORDER BY status DESC, created_at DESC";

$result = $conn->query($sql);
$result2 = $conn->query($sql2);

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskly Pro | <?php echo htmlspecialchars($user_name); ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="background-circles">
    <div class="circle circle-1"></div>
    <div class="circle circle-2"></div>
</div>

<div class="container">
    <header class="main-header">
        <div class="logo-area">
            <span class="logo-icon">t/</span>
            <h1>Taskly<span class="dot">.</span></h1>
        </div>
        
        <div style="display: flex; align-items: center; gap: 20px;">
            <div class="user-badge" style="text-align: right;">
                <span style="display: block; font-size: 0.8rem; color: var(--text-muted);">Bem-vindo,</span>
                <strong style="font-size: 0.9rem;"><?php echo explode(' ', $user_name)[0]; ?></strong>
            </div>
            <button id="openModal" class="btn-primary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Nova Tarefa
            </button>
            <a href="logout.php" title="Sair da conta" style="color: var(--danger); display: flex; align-items: center;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            </a>
        </div>
    </header>

    <main class="content-area">
        <div class="section-header">
            <h2>O teu Quadro</h2>
            <p class="subtitle">Organiza as tuas ideias e foca-te no que importa.</p>
        </div>

        <div>
            <h3>Tarefas para hoje</h3>
        </div>

        <div class="task-grid aaa">
            <?php if ($result2->num_rows === 0): ?>
                <div class="empty-state">
                    
                    <h3>Nenhuma tarefa para hoje</span></h3>
                    <button onclick="document.getElementById('openModal').click()" class="btn-empty">
                        Criar Tarefa agora
                    </button>
                </div>
            <?php else: ?>
                <?php while ($task = $result2->fetch_assoc()): 
                    $isDone = ($task['status'] == 'concluida'); 
                ?>
                <div class="task-card <?php echo $task['status']; ?>">
                    <div class="card-header">
                        <span class="status-badge"></span>
                        <div class="card-actions-top">
                            <a href="actions.php?toggle=<?php echo $task['id']; ?>&status=<?php echo $task['status']; ?>" class="action-btn check">
                                <?php if($isDone): ?>
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"></path></svg>
                                <?php else: ?>
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle></svg>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <h3 class="task-title"><?php echo htmlspecialchars($task['title']); ?></h3>
                        <?php if(!empty($task['description'])): ?>
                            <p class="task-desc"><?php echo htmlspecialchars($task['description']); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="card-footer">
                        <span class="task-date">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            <?php echo date('d M', strtotime($task['start_date'])); ?>
                        </span>

                        <div class="footer-actions" style="display: flex; gap: 10px;">
                            <button class="action-btn edit-btn" 
                                    data-id="<?php echo $task['id']; ?>" 
                                    data-title="<?php echo htmlspecialchars($task['title']); ?>" 
                                    data-desc="<?php echo htmlspecialchars($task['description']); ?>"
                                    data-date="<?php echo date('Y-m-d', strtotime($task['start_date'])); ?>"
                                    title="Editar">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            </button>

                            <a href="actions.php?delete=<?php echo $task['id']; ?>" class="action-btn delete" onclick="return confirm('Eliminar permanentemente?')">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        


        <div class="task-grid bbb">

            <?php if ($result->num_rows === 0 AND $result2->num_rows === 0): ?>
                
            <?php else: ?>
                <?php while ($task = $result->fetch_assoc()): 
                    $isDone = ($task['status'] == 'concluida'); 
                ?>
                <div class="task-card <?php echo $task['status']; ?>">
                    <div class="card-header">
                        <span class="status-badge"></span>
                        <div class="card-actions-top">
                            <a href="actions.php?toggle=<?php echo $task['id']; ?>&status=<?php echo $task['status']; ?>" class="action-btn check">
                                <?php if($isDone): ?>
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"></path></svg>
                                <?php else: ?>
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle></svg>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <h3 class="task-title"><?php echo htmlspecialchars($task['title']); ?></h3>
                        <?php if(!empty($task['description'])): ?>
                            <p class="task-desc"><?php echo htmlspecialchars($task['description']); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="card-footer">
                        <span class="task-date">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            <?php echo date('d M', strtotime($task['start_date'])); ?>
                        </span>

                        <div class="footer-actions" style="display: flex; gap: 10px;">
                            <button class="action-btn edit-btn" 
                                    data-id="<?php echo $task['id']; ?>" 
                                    data-title="<?php echo htmlspecialchars($task['title']); ?>" 
                                    data-desc="<?php echo htmlspecialchars($task['description']); ?>"
                                    data-date="<?php echo htmlspecialchars($task['start_date']); ?>"
                                    title="Editar">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            </button>

                            <a href="actions.php?delete=<?php echo $task['id']; ?>" class="action-btn delete" onclick="return confirm('Eliminar permanentemente?')">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </main>
</div>

<div id="modal" class="modal">
    <div class="modal-content glass">
        <div class="modal-header">
            <h2>Nova Tarefa</h2>
            <span class="close-modal">&times;</span>
        </div>
        <form action="actions.php" method="POST">
            <div class="form-group">
                <label>O que precisas de fazer?</label>
                <input type="text" name="title" placeholder="Ex: Estudar Redes de Computadores" required maxlength="255">
            </div>
            <div class="form-group">
                <label>Notas adicionais</label>
                <textarea name="description" placeholder="Algum detalhe importante..." rows="4"></textarea>
            </div>

            <div class="form-group">
                <label>Data de início</label>
                <input type="date" name="start_date" id="" class="input-date">
            </div>
            

            <button type="submit" name="add" class="btn-block">Guardar na Agenda</button>
        </form>
    </div>
</div>

<div id="editModal" class="modal">
    <div class="modal-content glass">
        <div class="modal-header">
            <h2>Editar Tarefa</h2>
            <span class="close-edit-modal close-modal">&times;</span>
        </div>
        <form action="actions.php" method="POST">
            <input type="hidden" name="task_id" id="edit-id">
            <div class="form-group">
                <label>Título</label>
                <input type="text" name="title" id="edit-title" required maxlength="255">
            </div>
            <div class="form-group">
                <label>Descrição</label>
                <textarea name="description" id="edit-desc" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label>Data de início</label>
                <input type="date" name="start_date" id="edit-date" class="input-date">
            </div>

            <button type="submit" name="update" class="btn-block">Atualizar Tarefa</button>
        </form>
    </div>
</div>

<script src="script.js"></script>

</body>
</html>