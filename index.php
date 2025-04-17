<?php
session_start();
require "config.php";

// Verificação de login
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header("Location: loginUser.php");
    exit; 
}

// Enviar comentário
if (isset($_POST['comentario']) && !empty($_POST['comentario'])) {
    $id = $_SESSION['id'];
    $comentario = $_POST['comentario'];
    $nome = $_POST['nome'];
    

    // Insere o comentário no banco
    $sql = "INSERT INTO comentarios (user_id, comentario, created_at) VALUES (:user_id, :comentario, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':comentario', $comentario);
    $stmt->bindValue(':user_id', $id);

    if ($stmt->execute()) {
        echo "Comentário enviado com sucesso!";
    } else {
        echo "Erro ao enviar o comentário.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentários</title>
    <link rel="stylesheet" href="asset/style.css">
</head>
<body>

    <div class="navBar">
        <div>HOME</div>
        <div>CONTATO</div>
        <div>SOBRE</div>
        <div>PARCERIAS</div>
        <a href="sair.php">Sair</a>
    </div>

    <div class="divHome">
        <!-- Seção de habilidades -->
        <div class="myskills">
            <ul>
                <li>Desenvolvimento Web - Frontend (HTML, CSS, JavaScript)</li>
                <li>Backend (PHP, MySQL, Node.js)</li>
                <li>Frameworks: React, Laravel, Express.js</li>
                <li>Design de UI/UX</li>
                <li>Git e Controle de versão</li>
                <li>Automação e APIs</li>
            </ul>
        </div>

        <!-- Sua imagem -->
        <div class="myimg">       
            <ul>
                <li>Desenvolvimento Web - Frontend (HTML, CSS, JavaScript)</li>
                <li>Backend (PHP, MySQL, Node.js)</li>
                <li>Frameworks: React, Laravel, Express.js</li>
                <li>Design de UI/UX</li>
                <li>Git e Controle de versão</li>
                <li>Automação e APIs</li>
            </ul>
            <ul>
                <li>Desenvolvimento Web - Frontend (HTML, CSS, JavaScript)</li>
                <li>Backend (PHP, MySQL, Node.js)</li>
                <li>Frameworks: React, Laravel, Express.js</li>
                <li>Design de UI/UX</li>
                <li>Git e Controle de versão</li>
                <li>Automação e APIs</li>
            </ul>
        </div>
    </div>

    <div class="construcao404not">
        <p>Em construção, aguarde!</p>
        <img class="imgConstrucao" src="asset/imagens/image.png" alt="Imagem de construção">
    </div>

    <div>
        <h1 style="color: white;">Me envie um comentário!</h1>
    </div>

    <div class="fundoChat">
        <div class="rendeMensagens">
            <?php 
            // Carregar os comentários
            $sql = "SELECT comentarios.comentario, usuarios.nome 
                    FROM comentarios 
                    INNER JOIN usuarios ON comentarios.user_id = usuarios.id 
                    ORDER BY comentarios.created_at DESC";
            
            $stmt = $pdo->query($sql);

            if ($stmt->rowCount() > 0) {
                foreach ($stmt->fetchAll() as $comentario):
                    ?>
                    <div class="comentario-container ">
                        <p><span class="comentario-nome"><?php echo htmlspecialchars($comentario['nome']); ?></span></p>
                        <p class="comentario-texto"><?php echo htmlspecialchars($comentario['comentario']); ?></p>
                    </div>
                    <?php 
                endforeach;
            } else {
                echo '<div style="text-align: center;">Sem novas mensagens..</div>';
            }
            ?>
        </div>

        <!-- Formulário para enviar comentário -->
        <form method="post">
            <div class="divComent">
                <!-- 'nome' deve ser capturado corretamente pelo usuário em vez de pegar do comentário -->
                <input type="hidden" value="<?php echo $nome ?>" name="nome">
                <input type="text" class="btnComent" name="comentario" id="comentario" placeholder="Enviar Comentário!">
                <button type="submit" class="btnenvio"><span>📨</span></button>
            </div>
        </form>
    </div>

</body>
</html>
