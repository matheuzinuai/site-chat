<?php
// Inicia a sessão
session_start();

// Verifica se a variável de sessão 'id' está definida e não está vazia
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    // Limpa todas as variáveis de sessão
    session_unset();
    
    // Destrói a sessão
    session_destroy();
    
    // Remove o cookie de sessão, se houver
    if (ini_get("session.use_cookies")) {
        setcookie(session_name(), '', time() - 42000, '/');
    }

    // Redireciona para a página de login
    header("Location: loginUser.php");
    exit(); // Não se esqueça de adicionar 'exit()' para garantir que o script pare aqui
}
?>
