<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Compras</title>
    <script>
        function adicionarCompra() {
            // Clone do formulário
            var formularioClonado = document.getElementById('formulario').cloneNode(true);

            // Limpar os campos do novo formulário
            var campos = formularioClonado.querySelectorAll('input, select');
            campos.forEach(function (campo) {
                campo.value = '';
            });

            // Adicionar o novo formulário ao final da lista de compras
            document.getElementById('compras').appendChild(formularioClonado);
        }
    </script>
</head>
<body>
    <h1>Lista de Compras</h1>
    <div id="compras">
        <form id="formulario">
            <label for="produto">Produto:</label>
            <input type="text" name="produto" id="produto">
            <br>
            <label for="quantidade">Quantidade:</label>
            <input type="text" name="quantidade" id="quantidade">
            <br>
            <label for="preco">Preço:</label>
            <input type="text" name="preco" id="preco">
            <br>
            <button type="button" onclick="adicionarCompra()">Adicionar mais compras</button>
        </form>
    </div>
</body>
</html>
