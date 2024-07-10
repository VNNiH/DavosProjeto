<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Scroll para a tabela de lista de alunos */
        .table-wrapper {
            max-height: 400px;
            overflow-y: auto;
        }

        /* Removendo estilo da tag <a> */
        a {
            text-decoration: none;
            color: inherit;
            cursor: pointer;
        }

        /* Ajustes de estilo */
        .table th, .table td {
            vertical-align: middle;
        }

        .table thead th {
            background-color: #007bff;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Alunos</h1>
        <div id="alunosDiv">
            <div id="listaAlunos" class="table-wrapper">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Descrição</th>
                            <th>Situação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Incluir o arquivo de conexão com o banco de dados
                        include "conexao.php";

                        // Consulta SQL para obter os alunos cadastrados
                        $sql = "SELECT * FROM alunos";
                        $result = mysqli_query($mysqli, $sql);

                        // Loop para exibir os alunos
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td><a href='editar_aluno.php?id={$row['id_aluno']}'>{$row['nome']}</a></td>";
                            echo "<td>{$row['observacao']}</td>";
                            echo '<td>';
                            echo '<form action="atualizando-status/atualizar_status.php" method="POST">';
                            echo '<input type="hidden" name="id_aluno" value="' . $row['id_aluno'] . '">';
                            echo '<input type="checkbox" name="ativo" value="1" ' . ($row['situacao'] ? 'checked' : '') . ' onchange="this.form.submit()"> ';
                            echo ($row['situacao'] ? 'Ativo' : 'Inativo');
                            echo '</form>';
                            echo '</td>';
                            echo "</tr>";
                        }

                        // Fechar a conexão com o banco de dados
                        mysqli_close($mysqli);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-3 row">
            <div class="col">
                <a href="add_aluno.php" class="btn btn-primary">Adicionar Novo Aluno</a>
            </div>
        </div>
    </div>
</body>

</html>
