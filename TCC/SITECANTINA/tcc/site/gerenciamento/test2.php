<?php


include '../conexao.php';


if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenha os dados do formulário
    $idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : 0;

    // Certifique-se de que o ID do usuário seja válido

    $idProduto = isset($_POST['idProduto']) ? $_POST['idProduto'] : array();
    $quantidadeComprada = isset($_POST['quantidadeComprada']) ? $_POST['quantidadeComprada'] : array();

    // Loop para inserir produtos
    for ($i = 0; $i < count($idProduto); $i++) {
        $idProd = $idProduto[$i];
        $quantidade = $quantidadeComprada[$i];

        // Consulta SQL para inserir os dados na tabela
        $sqlDetalhes = "INSERT INTO tblDadosCompraProdutos (idCompra, idProduto, quantidadeComprada) 
                        VALUES ($idCompra, $idProd, $quantidade)";

        if ($conn->query($sqlDetalhes) !== TRUE) {
            echo "Erro ao inserir produto: " . $conn->error;
        }
    }

    // Fechar a conexão com o banco de dados

    echo "Compra cadastrada com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Compra</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <h2>Cadastrar Compra de Usuário</h2>
        
        <label for="idUsuario">Selecione um usuário:</label>
        <select id="idUsuario" name="idUsuario" required onchange="preencherCampoNome(this)">
        <option value="" disabled selected>Selecione um nome</option>
        <?php
        // Consulta e exibição de usuários
            $consultaUsuarios = "SELECT idUsuario, nomeUsuario, sobrenomeUsuario FROM tblUsuario";
            $resultadoUsuarios = $conn->query($consultaUsuarios);

        // Loop para exibir as opções no select
        if ($resultadoUsuarios->num_rows > 0) {
            while ($row = $resultadoUsuarios->fetch_assoc()) {
                $nomeCompleto = $row["nomeUsuario"] . ' ' . $row["sobrenomeUsuario"];
                echo '<option value="' . $row["idUsuario"] . '">' . $nomeCompleto . '</option>';
            }
        } else {
            echo '<option value="0">Nenhum usuário encontrado</option>';
        }
?>
    </select>
        
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                       <select id="idProduto" name="idProduto"  required onchange="preencherCampoProduto(this)" >
        <option value="" disabled selected>Selecione um produto</option>
        <?php
           

            // Consulta SQL para obter os nomes dos produtos
            $consultaProdutos = "SELECT idProduto, nomeProduto, precoProduto FROM tblProdutos";
            $resultadoProdutos = $conn->query($consultaProdutos);

            // Loop para exibir as opções no select
            if ($resultadoProdutos->num_rows > 0) {
                while ($row = $resultadoProdutos->fetch_assoc()) {
                    echo "<option value='" . $row['idProduto'] . "' data-preco='" . $row['precoProduto'] . "'>" . $row['nomeProduto'] . "</option>";    
                }
            } else {
                echo '<option value="0">Nenhum produto encontrado</option>';
            }

            // Fecha a conexão com o banco de dados
            $conn->close();
        ?>
    </select>
                    </td>
                    <td>
                        <input type="number" name="quantidadeComprada[]" value="1" min="1" required>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <button type="button" onclick="adicionarProdutoQuantidade()">Adicionar Produto e Quantidade</button>
        <p><?php echo $mensagem; ?></p>
        <input type="submit" name="submit" value="Confirmar Compra">
    </form>
    
    <script>
    var rowCount = 1;

    function adicionarProdutoQuantidade() {
        rowCount++;

        var tabela = document.querySelector("table tbody");
        var novaLinha = tabela.insertRow(tabela.rows.length);

        var cell1 = novaLinha.insertCell(0);
        var cell2 = novaLinha.insertCell(1);

        // Clonar o select de produtos do primeiro item
        var selectProduto = document.querySelector('select[name="idProduto"]');
        var novoSelect = selectProduto.cloneNode(true);

        // Definir um novo nome para o select clonado
        novoSelect.name = 'idProduto[]';

        // Clonar o input de quantidade do primeiro item
        var inputQuantidade = document.querySelector('input[name="quantidadeComprada[]"]');
        var novoInput = inputQuantidade.cloneNode(true);

        // Definir um novo name para o input clonado
        novoInput.name = 'quantidadeComprada[]';

        cell1.appendChild(novoSelect);
        cell2.appendChild(novoInput);
    }
</script>
</body>
</html>