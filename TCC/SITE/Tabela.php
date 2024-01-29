<?php 

    include_once "Conexao.php";
    session_start();
    $sql = "SELECT * FROM tblDadosCompra WHERE idUsuario = $_SESSION[idUsuario]";
    $sql2 = "SELECT * FROM tblUsuario WHERE idUsuario = $_SESSION[idUsuario]";
    $sql3 = "SELECT MIN(vencimentoCompra) FROM tblDadosCompra WHERE idUsuario = $_SESSION[idUsuario]";
    $resultado = mysqli_query($conexao, $sql);
    $resultado2 = mysqli_query($conexao, $sql2);
    $resultado3 = mysqli_query($conexao, $sql3);
    $dados2 = mysqli_fetch_assoc($resultado2);
    $dados3 = mysqli_fetch_assoc($resultado3);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleTabela.css">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"> 
    <title>Document</title>
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
        </nav>

        <form action="#" class="search-bar">
            <input type="text" placeholder="Search...">
            <button type="submit"><i class="bx bx-search"></i></button>
        </form>

    </header>

    <div class="background"></div>
    
    <div class="container">
       
            
        <div class="logreg-box">
        
                <div class="form-box">
                    <h1>Tabela de produtos Creditados</h1>
                    
                    <div class="tbl-header">
                        <table cellpadding="0" cellspacing="0" >
                        <thead>
                            <tr>
                            <th>Data Da Compra</th>
                            <th>Produto</th>
                            <th>Preço do Produto</th>
                            <th>Horario da Compra</th>
                            <th>Data de Vencimento</th>
                            </tr>
                        </thead>
                        </table>
                    </div>
                    <div class="tbl-content">
                        <table cellpadding="0" cellspacing="0" >
                            <tbody>
                                <?php
                                    $i = 0;
                                    while($dados = mysqli_fetch_assoc($resultado)){
                                        $i = $dados["precoCompra"] + $i;
                                        echo "<tr>";
                                        echo "<td>".$dados["dataCompra"]."</td>";
                                        echo "<td>".$dados["nomeCompra"]."</td>";
                                        echo "<td>".$dados["precoCompra"]."</td>";
                                        echo "<td>".$dados["horarioCompra"]."</td>";
                                        echo "<td>".$dados["vencimentoCompra"]."</td>";
                                    }
                                   
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    <div class="container2">
           
        <div class="logreg-box2">
            <?php              
                echo "<div class='form-box2'>";
                echo    "<div class='coluna'>";
                echo        "<h2>Nome: ".$dados2["nomeUsuario"]."</h2>";
                echo        "<h2>E-Mail: ".$dados2["emailUsuario"]."</h2>";
                echo        "<h2>Nome Completo: ".$dados2["sobrenomeUsuario"]."</h2>";
                echo    "</div>";
                echo    "<div class='coluna'>";
                echo        "<h2>valor Atual (R$): ".$i."</h2>";
                echo        "<h2>Próximo vencimento: ".$dados3["MIN(vencimentoCompra)"]."</h2>";
                echo        "<h2>Dias restantes:</h2>";                
                echo    "</div>";
                echo "</div>";
            ?>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="scriptTabela.js"></script>
</body>
</html>