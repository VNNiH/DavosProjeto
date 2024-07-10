<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Adicionar Novo</h1>
        <form action="cadastrandoAluno/cadastro_script.php" method="POST">
            <div class="mb-3 row">
                <label for="inputNome" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputNome" name="inputNome" placeholder="Nome" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="email@email.com" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputTelefone" class="col-sm-2 col-form-label">Telefone</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputTelefone" name="inputTelefone" placeholder="(99) 9999-9999" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputMensalidade" class="col-sm-2 col-form-label">Mensalidade</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputMensalidade" name="inputMensalidade" placeholder="R$" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputSenha" class="col-sm-2 col-form-label">Senha</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="password" class="form-control" id="inputSenha" name="inputSenha" placeholder="****" required>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-eye" id="showPassword" style="cursor: pointer;"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="ativo" name="ativo">
                <label class="form-check-label" for="ativo">Ativo</label>
            </div>
            <div class="mb-3 row">
                <label for="inputTxtArea" class="col-sm-2 col-form-label">Observações</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="inputTxtArea" name="inputTxtArea" rows="3" placeholder="Máx 500 caracteres..."></textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="index.php" class="btn btn-danger">Voltar</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Adicionando o JavaScript para alternar a visibilidade da senha -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('inputSenha');
            const togglePassword = document.getElementById('showPassword');

            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>

</html>
