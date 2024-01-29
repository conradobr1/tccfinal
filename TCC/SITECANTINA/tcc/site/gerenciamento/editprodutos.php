<!DOCTYPE html>
<html>
<head>
    <title>Gerenciamento de Produtos da Cantina</title>
    <link rel="stylesheet" type="text/css" href="EstiloProduto2.css">
    
</head>
<body>


    
    <h1>Gerenciamento de Produtos da Cantina</h1>
    <div class="conteiner">

    <div class="box">
    <div class="tabela">
    <?php
    include '../../../tcc/site/conexao.php';

    // Verifica se o formulário de exclusão ou edição foi submetido
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idProduto = $_POST['idProduto'];

        if (isset($_POST['excluir'])) {
            // Verifica se o Produto existe no banco de dados
            $sql = "SELECT * FROM tblProdutos WHERE idProduto = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $idProduto);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows === 1) {
                // Exclui o Produto do banco de dados
                $sql = "DELETE FROM tblProdutos WHERE idProduto = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $idProduto);
                $stmt->execute();
                echo "Produto excluído com sucesso!";
            } else {
                echo "Produto não encontrado.";
            }
        } elseif (isset($_POST['editar'])) {
            $nomeProduto = $_POST['nomeProduto'];
            $descricaoProduto = $_POST['descricaoProduto'];
            $precoProduto = $_POST['precoProduto'];
            $quantidadeProduto = $_POST['quantidadeProduto'];

            // Atualiza o Produto no banco de dados
            $sql = "UPDATE tblProdutos SET nomeProduto=?, descricaoProduto=?, precoProduto=?, quantidadeProduto=? WHERE idProduto=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdii", $nomeProduto, $descricaoProduto, $precoProduto, $quantidadeProduto, $idProduto);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Produto editado com sucesso!";
            } else {
                echo "Produto não encontrado ou nenhuma alteração foi feita.";
            }
        }
    }
        
    // Consulta todos os Produtos no banco de dados
    $sql = "SELECT * FROM tblProdutos";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nome do Produto</th>";
        echo "<th>Descrição</th>";
        echo "<th>Preço</th>";
        echo "<th>Quantidade</th>";
        echo "<th>Ações</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
    
       
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['idProduto'] . "</td>";
            echo "<td>" . $row['nomeProduto'] . "</td>";
            echo "<td>" . $row['descricaoProduto'] . "</td>";
            echo "<td>" . $row['precoProduto'] . "</td>";
            echo "<td>" . $row['quantidadeProduto'] . "</td>";
            echo "<td>";
            echo "<div class='action-buttons'>";
            echo "<button type='button' class='toggle-buttons'>Mostrar/Esconder</button>"; // Botão para esconder os botões de ação
            echo "<div class='hidden-buttons hidden'>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='idProduto' value='" . $row['idProduto'] . "'>";
            echo "<label for='nomeProduto" . $row['idProduto'] . "'>Nome do Produto:</label>";
            echo "<input type='text' name='nomeProduto' value='" . $row['nomeProduto'] . "'><br>";
            echo "<label for='descricaoProduto" . $row['idProduto'] . "'>Descrição:</label>";
            echo "<input type='text' name='descricaoProduto' value='" . $row['descricaoProduto'] . "'><br>";
            echo "<label for='precoProduto" . $row['idProduto'] . "'>Preço:</label>";
            echo "<input type='text' name='precoProduto' value='" . $row['precoProduto'] . "'><br>";
            echo "<label for='quantidadeProduto" . $row['idProduto'] . "'>quantidadeProduto:</label>";
            echo "<input type='text' name='quantidadeProduto' value='" . $row['quantidadeProduto'] . "'><br>";   
            echo "<input type='submit' name='editar' value='Editar' class='button edit' onclick='return confirm(\"Tem certeza que deseja editar o Produto?\");'>";
            echo "<input type='submit' name='excluir' value='Excluir' class='button delete' onclick='return confirm(\"Tem certeza que deseja excluir o Produto?\");'>";
            echo "</div>";
            echo "</div>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";

        }


        
        echo "</tbody>";
        echo "</table>";
        
    } else {
        echo "Nenhum Produto cadastrado.";
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
