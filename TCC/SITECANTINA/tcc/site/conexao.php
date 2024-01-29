<?php
 // Conexão com o banco de dados
 $servername = 'localhost';
 $username = 'root';
 $password = 'mysql';
 $dbname = 'cantina';

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);


// Verifica a conexão
if ($conn->connect_error) {
    die('Erro na conexão com o banco de dados: ' . $conn->connect_error);
}
?>
