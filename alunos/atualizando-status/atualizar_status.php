<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir o arquivo de conexão com o banco de dados
    include "../conexao.php"; 
    
    // Captura os dados do formulário
    $id_aluno = $_POST['id_aluno'];
    $ativo = isset($_POST['ativo']) ? 1 : 0; // Se marcado, ativo=1, senão, ativo=0
    
    // Query para atualizar o estado no banco de dados
    $sql = "UPDATE alunos SET situacao = $ativo WHERE id_aluno = $id_aluno";

    if (mysqli_query($mysqli, $sql)) {
        //forçando a atualização da página
        echo "<script>window.location.href = '../index.php';</script>";
    } else {
        echo "Erro ao atualizar status: " . mysqli_error($mysqli);
    }

    // Fechar a conexão com o banco de dados
    mysqli_close($mysqli);

    exit; // Encerra o script para evitar execução adicional
}
?>