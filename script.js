// --- Elementos dos Modais ---
const modalAdd = document.getElementById("modal");
const modalEdit = document.getElementById("editModal");
const btnAdd = document.getElementById("openModal");

// --- Funções de Controlo ---

// Função genérica para abrir qualquer modal
function openModal(m) {
    m.classList.add("show");
    document.body.style.overflow = "hidden";
}

// Função genérica para fechar qualquer modal aberto
function closeAllModals() {
    const openModals = document.querySelectorAll('.modal.show');
    openModals.forEach(m => m.classList.remove("show"));
    document.body.style.overflow = "auto";
}

// --- Eventos do Modal de Adicionar ---
btnAdd.onclick = () => openModal(modalAdd);

// --- Eventos do Modal de Editar ---
// Usamos delegação de eventos para capturar o clique nos botões de editar
document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.onclick = function() {
        // Preencher os campos do modal de edição com os dados (dataset) do botão
        document.getElementById('edit-id').value = this.dataset.id;
        document.getElementById('edit-title').value = this.dataset.title;
        document.getElementById('edit-desc').value = this.dataset.desc;
        
        openModal(modalEdit);
    };
});

// --- Fechar Modais (Botão X, Clicar Fora, Tecla Esc) ---

// Seleciona todos os botões de fechar (x) de ambos os modais
document.querySelectorAll(".close-modal").forEach(btn => {
    btn.onclick = closeAllModals;
});

// Fechar ao clicar no fundo escuro
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        closeAllModals();
    }
}

// Fechar com a tecla Escape
document.addEventListener('keydown', function(event) {
    if (event.key === "Escape") {
        closeAllModals();
    }
});