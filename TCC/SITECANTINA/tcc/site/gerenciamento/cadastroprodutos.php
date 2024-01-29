<?php
include '../conexao.php';
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $nomeProduto = $_POST['nomeProduto'];
    $descricaoProduto = $_POST['descricaoProduto'];
    $precoProduto = $_POST['precoProduto'];
    $quantidadeProduto = $_POST['quantidadeProduto'];

   
    // Prepara a query SQL para inserção dos dados
    $sql = "INSERT INTO tblProdutos (nomeProduto, descricaoProduto, precoProduto, quantidadeProduto) VALUES ('$nomeProduto', '$descricaoProduto', $precoProduto, $quantidadeProduto)";

    // Executa a query SQL
    if ($conn->query($sql) === TRUE) {
        echo 'Produto cadastrado com sucesso.';
    } else {
        echo 'Erro ao cadastrar o Produto: ' . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Produtos da Cantina</title>
    <link rel="stylesheet" href="../../../tcc/site/gerenciamento/estilocadastro1.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      
      
        
</head>
<body>
   <div class="box"></div>
        <h1 class="titulo" >
            <img src="https://fontmeme.com/permalink/230621/f140374919c81aff63749bf04773d637.png" alt="fonte-do-uno" border="0"></a></h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="formulario"> 
            <label for="nomeProduto">Nome do Produto</label>
            <input type="text" id="nomeProduto" name="nomeProduto" required>

            <label for="descricaoProduto">Descrição</label>
            <textarea id="descricaoProduto" name="descricaoProduto" required></textarea>

            <label for="precoProduto">Preço</label>
            <input type="number" id="precoProduto" name="precoProduto" step="0.01" required>

            <label for="quantidadeProduto">Quantidade</label>
            <input type="number" id="quantidadeProduto" name="quantidadeProduto" required>
            </h1>
            
            <input type="submit" value="Salvar Produto">
            </div>
            </div>
        </form>
        <button onclick="window.location.href = '../../../tcc/site/home/home.php'" class="btnVoltar">
            <span class="material-icons md-36">
                home
                </span>
                
        </button></button>
        
    
</body>
</html>
