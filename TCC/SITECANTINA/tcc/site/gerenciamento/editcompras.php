<!DOCTYPE html>
<html>
<head>
    <title>Gerenciamento de Compras da Cantina</title>
    <link rel="stylesheet" type="text/css" href="EstiloEditCompra1.css">
</head>
<body>
    <h1>Gerenciamento de Compras da Cantina</h1>
    <div class="box">
    <?php
    include '../../../tcc/site/conexao.php';

    // Verifica se o formulário de exclusão ou edição foi submetido
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idCompra = $_POST['idCompra'];

        if (isset($_POST['excluir'])) {
            // Verifica se a Compra existe no banco de dados
            $sql = "SELECT * FROM tblDadosCompraProdutos WHERE idCompra = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $idCompra);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows === 1) {
                // Exclui a Compra do banco de dados
                $sql = "DELETE FROM tblDadosCompraProdutos WHERE idCompra = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $idCompra);
                $stmt->execute();
                echo "Compra excluída com sucesso!";
            } else {
                echo "Compra não encontrada.";
            }
        } elseif (isset($_POST['editar'])) {
            $nomeCompra = $_POST['nomeCompra'];
            $idUsuario = $_POST['idUsuario'];
            $precoCompra = $_POST['precoCompra'];
            $quantidadeComprada = $_POST['quantidadeComprada'];

            // Atualiza a Compra no banco de dados
            $sql = "UPDATE tblDadosCompraProdutos SET nomeCompra=?, idUsuario=?, precoCompra=?, quantidadeComprada=? WHERE idCompra=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdii", $nomeCompra, $idUsuario, $precoCompra, $quantidadeComprada, $idCompra);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Compra editada com sucesso!";
            } else {
                echo "Compra não encontrada ou nenhuma alteração foi feita.";
            }
        }
    }

    // Consulta todos os Produtos no banco de dados
    $sql = "SELECT tblDadosCompra.idCompra, tblDadosCompra.nomeCompra, tblUsuario.nomeUsuario, tblDadosCompra.precoCompra, tblDadosCompraProdutos.quantidadeComprada
            FROM tblDadosCompra
            INNER JOIN tblUsuario ON tblDadosCompra.idUsuario = tblUsuario.idUsuario
            INNER JOIN tblDadosCompraProdutos ON tblDadosCompra.idCompra = tblDadosCompraProdutos.idCompra";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nome do Produto</th>";
        echo "<th>Nome Usuario</th>";
        echo "<th>Preço total da compra</th>";
        echo "<th>Quantidade Comprada</th>";
        echo "<th>Ações</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
    
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['idCompra'] . "</td>";
            echo "<td>" . $row['nomeCompra'] . "</td>";
            echo "<td>" . $row['nomeUsuario'] . "</td>";
            echo "<td>" . $row['precoCompra'] . "</td>";
            echo "<td>" . $row['quantidadeComprada'] . "</td>";
            echo "<td>";
            echo "<div class='action-buttons'>";
            echo "<button type='button' class='toggle-buttons'>Mostrar/Esconder</button>"; // Botão para esconder os botões de ação
            echo "<div class='hidden-buttons hidden'>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='idCompra' value='" . $row['idCompra'] . "'>";
            echo "<label for='nomeCompra" . $row['idCompra'] . "'>Nome do Produto:</label>";
            echo "<input type='text' name='nomeCompra' value='" . $row['nomeCompra'] . "'><br>";
            echo "<label for='idUsuario" . $row['idCompra'] . "'>Nome Usuario:</label>";
            echo "<input type='text' name='idUsuario' value='" . $row['nomeUsuario'] . "'><br>";
            echo "<label for='precoCompra" . $row['idCompra'] . "'>Preço total da compra:</label>";
            echo "<input type='text' name='precoCompra' value='" . $row['precoCompra'] . "'><br>";
            echo "<label for='quantidadeComprada" . $row['idCompra'] . "'>Quantidade Comprada:</label>";
            echo "<input type='text' name='quantidadeComprada' value='" . $row['quantidadeComprada'] . "'><br>";   
            echo "<input type='submit' name='editar' value='Editar' class='button edit' onclick='return confirm(\"Tem certeza que deseja editar a Compra?\");'>";
            echo "<input type='submit' name='excluir' value='Excluir' class='button delete' onclick='return confirm(\"Tem certeza que deseja excluir a Compra?\");'>";
            echo "</div>";
            echo "</div>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "Nenhuma Compra cadastrada.";
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
