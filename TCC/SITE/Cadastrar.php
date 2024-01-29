<?php 
    session_start();
    include("Conexao.php");

    $nome = mysqli_real_escape_string($conexao, trim($_POST['nomeCad']));
    $email = mysqli_real_escape_string($conexao, trim($_POST['emailCad']));
    $senha = mysqli_real_escape_string($conexao, trim(md5($_POST['senhaCad'])));

    $sql = "select count(*) as total from tblUsuario where emailUsuario = '$email'";
    $resultado = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_assoc($resultado);

    if($row['total'] == 1){
        $_SESSION['usuario_existe'] = true;
        header('Location: Site.php');
        exit;
    }

    $sql = "INSERT INTO tblUsuario(nomeUsuario, emailUsuario, senhaUsuario, dataUsuario)
    VALUES ('$nome', '$email', '$senha', NOW())";

    if($conexao->query($sql) === TRUE) {
        $_SESSION['status_cadastro'] = true;

    }

    $conexao->close();

    header('Location: Site.php');
    exit;
?>