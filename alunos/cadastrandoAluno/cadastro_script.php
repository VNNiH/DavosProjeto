<?php
    // Incluir o arquivo de conexão com o banco de dados
    include "../conexao.php";

    // Receber os dados do formulário
    $nome = $_POST['inputNome'];
    $email = $_POST['inputEmail'];
    $telefone = $_POST['inputTelefone'];
    $mensalidade = $_POST['inputMensalidade'];
    $senha = $_POST['inputSenha'];
    $observacao = $_POST['inputTxtArea'];
    $ativo = isset($_POST['ativo']) ? 1 : 0; // Verifica se o checkbox foi marcado

    // Montar o comando SQL para inserção dos dados
    $sql = "INSERT INTO alunos (nome, email, telefone, valor_mensal, senha, observacao, situacao) 
             VALUES ('$nome', '$email', '$telefone', '$mensalidade', '$senha', '$observacao', '$ativo')";

    // Executar o comando SQL
    if (mysqli_query($mysqli, $sql)) {
        echo "<script>window.location.href = '../index.php';</script>";
    }
    // Fechar a conexão com o banco de dados
    mysqli_close($mysqli);
?>
        