<?php
require 'config.php';

session_start();

if (isset($_POST['nome']) && !empty($_POST['nome'])){
$nome = addslashes($_POST['nome']);
$password = md5(addslashes($_POST['senha']));

$sql = ("SELECT * FROM usuarios WHERE nome = '$nome' AND senha	 = '$password'");
$sql = $pdo->query($sql);
$sql->execute();

if($sql->rowCount() > 0){
    $dado = $sql->fetch();
    $_SESSION['id'] = $dado['id'];
    header("Location: index.php");
}else{
    echo "usuario nao exite!";
}

}
?>

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="min-h-screen flex items-center justify-center">
    <form method="post" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg">
      
      <!-- Nome com validação para evitar caracteres especiais -->
      <div>
        <label for="nome" class="block text-sm font-medium text-gray-700 text-center">NOME:</label>
        <input 
          type="text" 
          name="nome" 
          id="nome" 
          class="block w-full text-sm font-medium text-gray-700 border border-gray-300 rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" 
          required
          pattern="^[a-zA-Z0-9 ]+$"  
          title="O nome pode conter apenas letras, números e espaços.">
      </div>
      
      <!-- Senha com uma regra mínima de complexidade -->
      <div>
        <label for="senha" class="block text-sm font-medium text-gray-700 text-center">SENHA:</label>
        <input 
          type="password" 
          name="senha" 
          id="senha" 
          class="block w-full text-sm font-medium text-gray-700 border border-gray-300 rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" 
          required
          pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$"  
          title="A senha deve ter pelo menos 6 caracteres e conter pelo menos uma letra e um número.">
      </div>   
      
      <div class="mt-6 flex justify-center space-x-4">
        <button 
          type="submit" 
          class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
          Logar
        </button>
      </div>
   </form>
</div>
