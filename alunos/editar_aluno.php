<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Aluno</h1>

        <?php
        // Incluir o arquivo de conexão com o banco de dados
        include "conexao.php";

        // Verificar se o formulário foi submetido
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Capturar os dados do formulário
            $id_aluno = $_POST['id_aluno'];
            $nome = $_POST['inputNomeEdit'];
            $email = $_POST['inputEmailEdit'];
            $telefone = $_POST['inputTelefoneEdit'];
            $mensalidade = $_POST['inputMensalidadeEdit'];
            $senha = $_POST['inputSenhaEdit'];
            $observacao = $_POST['inputTxtAreaEdit'];
            $ativo = isset($_POST['ativoEdit']) ? 1 : 0;

            // Verificar se o campo de senha foi preenchido
            if (empty($senha)) {
                $sql = "UPDATE alunos SET nome=?, email=?, telefone=?, valor_mensal=?, observacao=?, situacao=? WHERE id_aluno=?";
                $stmt = $mysqli->prepare($sql);
                // ssssiii -> especifica os tipos e ddados dos parametros
                $stmt->bind_param("ssssiii", $nome, $email, $telefone, $mensalidade, $observacao, $ativo, $id_aluno);
            } else {
                $sql = "UPDATE alunos SET nome=?, email=?, telefone=?, valor_mensal=?, senha=?, observacao=?, situacao=? WHERE id_aluno=?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("ssssssii", $nome, $email, $telefone, $mensalidade, $senha, $observacao, $ativo, $id_aluno);
            }

            if ($stmt->execute()) {
                // mandando de volta pra pagina principal
                echo "<script>window.location.href = 'index.php';</script>";
            } else {
                echo "<div class='alert alert-danger' role='alert'>Erro ao atualizar aluno: " . $stmt->error . "</div>";
            }
            $stmt->close();
        }

        // Verificar se o ID do aluno está presente na URL
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id_aluno = $_GET['id'];

            // Consulta SQL para obter os dados do aluno
            $sql_select = "SELECT * FROM alunos WHERE id_aluno = ?";
            $stmt = $mysqli->prepare($sql_select);
            $stmt->bind_param("i", $id_aluno);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $stmt->close();
            // Verifica se a consulta SQL retornou dados do aluno. Se $row não for null, os dados foram encontrados e o formulário será preenchido com esses dados.
            if ($row) {
                 
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="id_aluno" value="<?php echo $id_aluno; ?>">
            
            <div class="mb-3 row">
                <label for="inputNomeEdit" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputNomeEdit" name="inputNomeEdit" value="<?php echo htmlspecialchars($row['nome']); ?>" placeholder="Nome">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputEmailEdit" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmailEdit" name="inputEmailEdit" value="<?php echo htmlspecialchars($row['email']); ?>" placeholder="email@email.com">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputTelefoneEdit" class="col-sm-2 col-form-label">Telefone</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputTelefoneEdit" name="inputTelefoneEdit" value="<?php echo htmlspecialchars($row['telefone']); ?>" placeholder="(99) 9999-9999">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputMensalidadeEdit" class="col-sm-2 col-form-label">Mensalidade</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputMensalidadeEdit" name="inputMensalidadeEdit" value="<?php echo htmlspecialchars($row['valor_mensal']); ?>" placeholder="R$">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputSenhaEdit" class="col-sm-2 col-form-label">Senha</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="password" class="form-control" id="inputSenhaEdit" name="inputSenhaEdit" placeholder="****" value="<?php echo htmlspecialchars($row['senha']); ?>">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-eye" id="showPasswordEdit" style="cursor: pointer;"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="ativoEdit" name="ativoEdit" <?php if ($row['situacao'] == 1) echo 'checked'; ?>>
                <label class="form-check-label" for="ativoEdit">Ativo</label>
            </div>

            <div class="mb-3 row">
                <label for="inputTxtAreaEdit" class="col-sm-2 col-form-label">Observações</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="inputTxtAreaEdit" name="inputTxtAreaEdit" rows="3" placeholder="Máx 500 caracteres..."><?php echo htmlspecialchars($row['observacao']); ?></textarea>
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="index.php" class="btn btn-danger">Voltar</a>
                </div>
            </div>
        </form>

        <?php
        // Caso não seja encontrado um aluno com o ID especificado na URL,
        // exibe uma mensagem de erro informando que o aluno não foi encontrado
            } else {
                echo "<div class='alert alert-danger' role='alert'>Aluno não encontrado.</div>";
            }
        } 

        // Fechar a conexão com o banco de dados
        $mysqli->close();
        ?>
    </div>

    <!-- Adicionando o JavaScript para alternar a visibilidade da senha -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInputEdit = document.getElementById('inputSenhaEdit');
            const togglePasswordEdit = document.getElementById('showPasswordEdit');

            togglePasswordEdit.addEventListener('click', function() {
                const type = passwordInputEdit.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInputEdit.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>
</html>
