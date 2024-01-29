<?php
$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "cantina";

// Criando a conexão
$conexao = mysqli_connect($servername, $username, $password, $dbname);

// Verificando a conexão
if (!$conexao) {
  die("Conexão falhou: " . mysqli_connect_error());
}
  echo "Conexão bem-sucedida!";
?>
