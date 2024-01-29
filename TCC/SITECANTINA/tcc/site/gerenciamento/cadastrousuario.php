<?php
include '../conexao.php';
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $nomeUsuario = $_POST['nomeUsuario'];
    $sobrenomeUsuario = $_POST['sobrenomeUsuario'];
    $emailUsuario = $_POST['emailUsuario'];
    $senhaUsuario = md5($_POST['senhaUsuario']);

   
   // Prepara a query SQL para inserção dos dados
$sql = "INSERT INTO tblUsuario (nomeUsuario, sobrenomeUsuario, emailUsuario, senhaUsuario, dataUsuario) VALUES ('$nomeUsuario', '$sobrenomeUsuario', '$emailUsuario', '$senhaUsuario', current_time())";


    // Executa a query SQL
    if ($conn->query($sql) === TRUE) {
        echo 'Usuario cadastrado com sucesso.';
    } else {
        echo 'Erro ao cadastrar o Usuario: ' . $conn->error;
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
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Cadastro de usuarios </title>
    <link rel="stylesheet" href="../../../tcc/site/gerenciamento/CssCadastroUsuario2.css">
    
      
      
        
</head>
<body>
<div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus icon'></i>
        <div class="logo_name">Etec</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
          <i class='bx bx-search' ></i>
         <input type="text" placeholder="Search...">
         <span class="tooltip">Search</span>
      </li>
      <li>
        <a onclick="window.location.href = '../../../tcc/site/home/home.php'">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Menu Principal</span>
        </a>
         <span class="tooltip">Menu Principal</span>
      </li>
        
      <li>
        
       <a href="../../../tcc/site/gerenciamento/cadastrousuario.php">
       <i class="material-icons">person_add</i>
         <span class="links_name">Cadastrar Usuario</span>
       </a>
       <span class="tooltip">Cadastrar<br>Usuario</span>
     </li>
     <li>
       <a onclick="window.location.href = '../../../tcc/site/gerenciamento/editusuario.php'">
       <i class='bx bx-user' ></i>
         <span class="links_name">Gerenciar Usuarios</span>
       </a>
       <span class="tooltip">Gerenciamento <br> de Usuarios</span>
     </li>
     <li>
       <a onclick="window.location.href = '../../../tcc/site/gerenciamento/cadastroprodutos.php'"">
       <i class="material-icons">store</i>
         <span class="links_name"> Cadastrar Produtos</span>
       </a>
       <span class="tooltip">cadastrar <br>Produtos</span>
     </li>
     <li>
       <a onclick="window.location.href = '../../../tcc/site/gerenciamento/editprodutos.php'">
       <i class="material-icons">assignment</i>
         <span class="links_name">Gerenciar Produtos</span>
       </a>
       <span class="tooltip">Gerenciar<br> Produtos</span>
     </li>
     <li>
       <a onclick="window.location.href = '../../../tcc/site/gerenciamento/editcompras.php'">
       <i class="material-icons">local_grocery_store</i>
         <span class="links_name">Gerenciar Compras</span>
       </a>
       <span class="tooltip">Gerenciar Compras</span>
     </li>
     <li>
       <a href="#">
         <i class='bx bx-heart' ></i>
         <span class="links_name">Saved</span>
       </a>
       <span class="tooltip">Saved</span>
     </li>
     <li>
       <a href="#">
         <i class='bx bx-cog' ></i>
         <span class="links_name">Setting</span>
       </a>
       <span class="tooltip">Setting</span>
     </li>
    
            
           </div>
         </div>
        
     </li>
    </ul>
  </div>
 
  <script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");

  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
  });

  searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
    sidebar.classList.toggle("open");
    menuBtnChange(); //calling the function(optional)
  });

  // following are the code to change sidebar button(optional)
  function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
   }else {
     closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
   }
  }
  </script>

   
       
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            
        </form>
        
        
        
<section class="wrapper">
      <div class="form signup">
        <header>Cadastro</header>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
          <input type="text" placeholder="Nome" id="nomeUsuario" name="nomeUsuario" required>
          <input type="text" placeholder="Sobrenome" id="sobrenomeUsuario" name="sobrenomeUsuario" required>
          <input type="text" placeholder="Email " id="emailUsuario" name="emailUsuario"  required>
          <input type="password" placeholder="Senha" id="senhaUsuario" name="senhaUsuario" required>
          <div class="checkbox">
            
          </div>
          <input type="submit" value="Cadastrar" />
        </form>
      </div>
      
    </section>
    
</body>
</html>
