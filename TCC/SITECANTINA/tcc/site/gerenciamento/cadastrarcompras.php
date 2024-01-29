<?php
    include '../conexao.php';

    $mensagem = '';
    $idUsuarioSelecionado = '';
    $idProdutoSelecionado = '';
    $quantidadeComprada = '';
    $precoProdutoSelecionado = 0; // Inicializado com 0

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtém os dados do formulário 
        $idUsuario = $_POST['idUsuario'];
        $idProduto = $_POST['idProduto'];
        $quantidadeComprada = $_POST['quantidadeComprada'];

        // Verifica a quantidade atual do produto no banco de dados
        $consultaQuantidade = "SELECT quantidadeProduto FROM tblProdutos WHERE idProduto = $idProduto";
        $resultadoQuantidade = $conn->query($consultaQuantidade);
        $rowQuantidade = $resultadoQuantidade->fetch_assoc();
        $quantidadeDisponivel = $rowQuantidade['quantidadeProduto'];

        if ($quantidadeComprada <= $quantidadeDisponivel) {
            // Calcula o preço total da compra
            $consultaPreco = "SELECT precoProduto FROM tblProdutos WHERE idProduto = $idProduto";
            $resultadoPreco = $conn->query($consultaPreco);
            $rowPreco = $resultadoPreco->fetch_assoc();
            $precoProduto = $rowPreco['precoProduto'];
            $precoTotal = $precoProduto * $quantidadeComprada;
    // Obtém o nome do produto selecionado
    $consultaNomeProduto = "SELECT nomeProduto FROM tblProdutos WHERE idProduto = $idProduto";
    $resultadoNomeProduto = $conn->query($consultaNomeProduto);
    $rowNomeProduto = $resultadoNomeProduto->fetch_assoc();
    $nomeProdutoComprado = $rowNomeProduto['nomeProduto'];


        // Insere os dados da compra na tabela tblDadosCompra
    $sqlCompra = "INSERT INTO tblDadosCompra (nomeCompra, dataCompra, horarioCompra, precoCompra, vencimentoCompra, idUsuario) 
    VALUES ('$nomeProdutoComprado', CURDATE(), CURTIME(), $precoTotal, DATE_ADD(CURDATE(), INTERVAL 30 DAY), $idUsuario)";
    if ($conn->query($sqlCompra) === TRUE) {
    $idCompra = $conn->insert_id; // Obtém o idCompra gerado automaticamente

                // Insere os detalhes da compra na tabela tblDadosCompraProdutos
                $sqlDetalhes = "INSERT INTO tblDadosCompraProdutos (idCompra, idProduto, quantidadeComprada) 
                                VALUES ($idCompra, $idProduto, $quantidadeComprada)";
                if ($conn->query($sqlDetalhes) === TRUE) {
                    echo 'Compra cadastrada com sucesso.';
                } else {
                    echo 'Erro ao cadastrar os detalhes da compra: ' . $conn->error;
                }
            } else {
                echo 'Erro ao cadastrar a compra: ' . $conn->error;
            }
        } else {
            echo 'Quantidade solicitada indisponível.';
        }

        
    }





    ?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Associação de Produto com Usuário</title>
        <!-- Adicione aqui seus links de estilo -->
    </head>

    <body>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="formulario">    
                    <!-- Campos do formulário -->
                    <h2>Cadastrar Compras de usuarios</h2>
    <label for="nomePesquisa">Nome do Usuário</label>
    <input type="text" id="nomePesquisa" onkeyup="searchSelect()" placeholder="Digite um nome">
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
                

                    <!-- Campos adicionais aqui -->
                    <label for="nomeProduto">Nome do Produto</label>
    <input type="text" id="nomeProduto" onkeyup="searchSelectP()" placeholder="Digite um produto">
    
    <select id="idProduto" name="idProduto"  required onchange="preencherCampoProduto(this)">
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

                    <label for="quantidadeComprada">Quantidade</label>
                    <input type="number" id="quantidadeComprada" name="quantidadeComprada" value="1" min="1" required onchange="atualizarPreco()">
                    
                    <!-- Exibição do preço -->
                    <span id="precoProduto">Preço: R$ <?php echo number_format($precoProdutoSelecionado, 2, ',', '.'); ?></span>

                    <!-- Exibição da mensagem de sucesso ou erro -->
                    <p><?php echo $mensagem; ?></p>

                

                    <input type="submit" name="submit" value="Confirmar Compra">
                </div>
            </form>

        <button onclick="adicionarProdutos()">Adicionar à Tabela</button>

    <h2>Tabela de Produtos Selecionados</h2>
    <table id="tabelaProdutos">
        <thead>
            <tr>
                <th>ID do Usuario/</th>
                <th>Produto/</th>
                <th>Quantidade</th>
            </tr>
        </thead>
    
    </table>


        <script>
          

            // Chamada inicial para exibir o preço inicial
            atualizarPreco();

            // Função para atualizar o preço
            function atualizarPreco() {
                var selectProduto = document.getElementById("idProduto");
                var precoProduto = parseFloat(selectProduto.options[selectProduto.selectedIndex].getAttribute("data-preco")) || 0;
                var quantidadeComprada = parseFloat(document.getElementById("quantidadeComprada").value) || 0;
                var precoTotal = precoProduto * quantidadeComprada;
                
                document.getElementById("precoProduto").textContent = "Preço: R$ " + precoTotal.toFixed(2);
            }
            
            // Adiciona um evento "input" ao campo de quantidade
            document.getElementById("quantidadeComprada").addEventListener("input", atualizarPreco);
            document.getElementById("idProduto").addEventListener("change", atualizarPreco); // Adicione este evento

            function adicionarProdutos() {
                const selecProdutos = document.getElementById("idProduto");
                const tabelaProdutos = document.getElementById("tabelaProdutos");
                const quantidadeComprada = document.getElementById("quantidadeComprada");          
                const selectedOptions = selecProdutos.selectedOptions;
                const quantidade = quantidadeComprada.value; // Obtenha a quantidade do campo de entrada


                for (let i = 0; i < selectedOptions.length; i++) {
                    const option = selectedOptions[i];
                    const idUsuario = option.value;
                    const nomeUsuario = option.text;
                    const quantidadeComprada = option.number;

                    // Crie uma nova linha na tabela para cada Produto adicionado
                    const newRow = tabelaProdutos.insertRow();
                    const cell3 = newRow.insertCell(0);
                    const cell4 = newRow.insertCell(1);
                    const cell5 = newRow.insertCell(2);

                    cell3.innerHTML = idUsuario;
                    cell4.innerHTML = nomeUsuario;
                    cell5.innerHTML = quantidade;
                }
            }





            function filtrarNomes() {
            var input, filtro, select, options, option, i, txtValue;
            input = document.getElementById("nomePesquisa");
            filtro = input.value.toUpperCase();
            select = document.getElementById("idUsuario");
            options = select.getElementsByTagName("option");
            var resultados = document.getElementById("resultadoPesquisa");

            // Limpar resultados anteriores
            resultados.innerHTML = '';

            for (i = 0; i < options.length; i++) {
                option = options[i];
                txtValue = option.textContent || option.innerText;
                if (txtValue.toUpperCase().indexOf(filtro) > -1) {
                    // Clonar a opção do select e adicioná-la aos resultados
                    var cloneOption = option.cloneNode(true);
                    resultados.appendChild(cloneOption);
                }
            }

            // Mostrar a lista suspensa dos resultados
            select.style.display = "none";
            resultados.style.display = "block";
        }

     
            

        //textbox usuarios
       function searchSelect() {
            var input, filter, select, options, option, i;
            input = document.getElementById("nomePesquisa");
            filter = input.value.toUpperCase();
            select = document.getElementById("idUsuario");
            options = select.getElementsByTagName("option");

            for (i = 0; i < options.length; i++) {
                option = options[i];
                if (option.textContent.toUpperCase().indexOf(filter) > -1) {
                    option.style.display = "";
                } else {
                    option.style.display = "none";
                }
            }
        }

        function preencherCampoNome(select) {
            var nomeSelecionado = select.options[select.selectedIndex].text;
            document.getElementById("nomePesquisa").value = nomeSelecionado;
        }

        
            //textbox produtos

            function searchSelectP() {
            var input, filter, select, options, option, i;
            input = document.getElementById("nomeProduto");
            filter = input.value.toUpperCase();
            select = document.getElementById("idProduto");
            options = select.getElementsByTagName("option");

            for (i = 0; i < options.length; i++) {
                option = options[i];
                if (option.textContent.toUpperCase().indexOf(filter) > -1) {
                    option.style.display = "";
                } else {
                    option.style.display = "none";
                }
            }
        }

        function preencherCampoProduto(select) {
            var nomeSelecionado = select.options[select.selectedIndex].text;
            document.getElementById("nomeProduto").value = nomeSelecionado;
        }


        </script>
    </body>

    </html>