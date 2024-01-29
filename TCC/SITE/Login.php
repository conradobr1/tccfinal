<?php
    include("Conexao.php");



    if(isset($_POST['email']) || isset($_POST['senha'])) {

        $email = $conexao->real_escape_string($_POST['email']);
        $senha = $conexao->real_escape_string(md5($_POST['senha']));

        $sql = "SELECT * FROM tblUsuario WHERE emailUsuario = '$email' AND senhaUsuario = '$senha'";

        $sql_query = $conexao->query($sql) or die("Falha na execução: ".$conexao->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1){
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)){
                session_start();
            }

            $_SESSION['idUsuario'] = $usuario['idUsuario']; 
            $_SESSION['nomeUsuario'] = $usuario['nomeUsuario'];

            header("Location: Tabela.php");
            
        }
        else{
            echo "Falha ao logar! Email ou senha incorretos ";
        }
    }

?>