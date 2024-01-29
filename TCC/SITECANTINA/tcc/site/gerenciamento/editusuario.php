<!DOCTYPE html>
<html>
<head>
    <title>Gerenciamento de Usuarios da Cantina</title>
    <link rel="stylesheet" type="text/css" href="estiloeditpaga3.css">
    
</head>
<body>  



    <h1>Gerenciamento de usuarios da Cantina</h1>
    <div class="box">
    <?php
    include '../../../tcc/site/conexao.php';

    // Verifica se o formulário de exclusão ou edição foi submetido
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idUsuario = $_POST['idUsuario'];

        if (isset($_POST['excluir'])) {
            // Verifica se o produto existe no banco de dados
            $sql = "SELECT * FROM tblUsuario WHERE idUsuario  = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows === 1) {
                // Exclui o produto do banco de dados
                $sql = "DELETE FROM tblUsuario WHERE idUsuario  = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $idUsuario);
                $stmt->execute();
                echo "Usuario excluído com sucesso!";
            } else {
                echo "Usuario não encontrado.";
            }
        } elseif (isset($_POST['editar'])) {
            $nomeUsuario = $_POST['nomeUsuario'];
            $sobrenomeUsuario = $_POST['sobrenomeUsuario'];
            $emailUsuario = $_POST['emailUsuario'];
            $senhaUsuario = md5($_POST['senhaUsuario']);

            // Atualiza o produto no banco de dados
            $sql = "UPDATE tblUsuario SET nomeUsuario=?, sobrenomeUsuario=?, emailUsuario=?, senhaUsuario=? WHERE idUsuario =?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $nomeUsuario, $sobrenomeUsuario, $emailUsuario, $senhaUsuario, $idUsuario );
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Usuario editado com sucesso!";
            } else {
                echo "Usuario não encontrado ou nenhuma alteração foi feita.";
            }
        }
    }

    // Consulta todos os produtos no banco de dados
    $sql = "SELECT * FROM tblUsuario";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>IDUsuario</th>";
        echo "<th>Nome do Usuario</th>";
        echo "<th>Sobrenome do Usuario</th>";
        echo "<th>Email do Usuario</th>";
        echo "<th>Senha do Usuario</th>";
        echo "<th>Ações</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
    
       
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['idUsuario'] . "</td>";
            echo "<td>" . $row['nomeUsuario'] . "</td>";
            echo "<td>" . $row['sobrenomeUsuario'] . "</td>";
            echo "<td>" . $row['emailUsuario'] . "</td>";
            echo "<td>" . $row['senhaUsuario'] . "</td>";
            echo "<td>";
            echo "<div class='action-buttons'>";
            echo "<button type='button' class='toggle-buttons'>Mostrar/Esconder</button>"; // Botão para esconder os botões de ação
            echo "<div class='hidden-buttons hidden'>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='idUsuario' value='" . $row['idUsuario'] . "'>";
            echo "<label for='nome_" . $row['idUsuario'] . "'>Nome do Usuario:</label>";
            echo "<input type='text' name='nomeUsuario' value='" . $row['nomeUsuario'] . "'><br>";
            echo "<label for='sobrenomeUsuario" . $row['idUsuario'] . "'>sobrenomeUsuario:</label>";
            echo "<input type='text' name='sobrenomeUsuario' value='" . $row['sobrenomeUsuario'] . "'><br>";
            echo "<label for='emailUsuario" . $row['idUsuario'] . "'>emailUsuario:</label>";
            echo "<input type='text' name='emailUsuario' value='" . $row['emailUsuario'] . "'><br>";
            echo "<label for='senhaUsuario" . $row['idUsuario'] . "'>senhaUsuario:</label>";
            echo "<input type='text' name='senhaUsuario' value='" . $row['senhaUsuario'] . "'><br>";   
            echo "<input type='submit' name='editar' value='Editar' class='button edit' onclick='return confirm(\"Tem certeza que deseja editar o produto?\");'>";
            echo "<input type='submit' name='excluir' value='Excluir' class='button delete' onclick='return confirm(\"Tem certeza que deseja excluir o produto?\");'>";
            echo "</div>";
            echo "</div>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";

        }


        
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "Nenhum produto cadastrado.";
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
    ?>

<script>
        var toggleButtons = document.querySelectorAll(".toggle-buttons");
        toggleButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                var hiddenButtons = this.parentElement.querySelector(".hidden-buttons");
                if (hiddenButtons.classList.contains("hidden")) {
                    hiddenButtons.classList.remove("hidden");
                } else {
                    hiddenButtons.classList.add("hidden");
                }
            });
        });
    </script>

    <button onclick="window.location.href = '../../../tcc/site/home/home.php'">Voltar ao menu</button>
    </div>
</body>
</html>
