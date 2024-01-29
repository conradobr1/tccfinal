<?php
include '../../tcc/site/conexao.php';

    
?>

  <!DOCTYPE html>
  <html>
  <head>
      <title>HOME da Cantina</title>
      <link rel="stylesheet" type="text/css" href="CssHome2.css">
      <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
         <i class='bx bx-log-out' id="log_out" ></i>
     </li>
    </ul>
  </div>
  
      <div class="text"></div>
  </section>
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
</body>
</html>
      <div class="blur">
      <div class="whiteBox">
      <h1>  <img src="https://fontmeme.com/permalink/231023/1578d7025e4d800a668c929ec74961ab.png" alt="efeito-de-brilho" border="0"></a><h1>
        <div class=" buttons">









</div>



<button class="btnCadastrarUsuario" onclick="window.location.href = '../../../tcc/site/gerenciamento/cadastrarcompras.php'"</button><span class="shadow"></span>
  <span class="edge"></span>
  <span class="front text"> Cadastrar Compras
  </span>
</button>
</div>
    </div>
    </div>
  </body>
  </html>
