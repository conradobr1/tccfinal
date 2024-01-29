    <?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <title>Document</title>
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <a href="#">Home</a>
            <a href="Test/CardSlider.html">Menu</a>
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
        <div class="content">
            <h2 class="logo"><i class='bx bxs-buildings'></i>ETEC - CENTRO PAULA SOUZA</h2>

            <div class="text-sci">
                <h2>Bem Vindo!<br><span>Seu gestor de crédito a prazo aqui...</span></h2>
                <p>ETEC - Centro Paula Souza é um instituto 
                    de ensino que se adequa ao futuro! Acompanhe-nos
                    nessa jornada para a sua e a nossa formação!
                </p>

                    <div class="social-icons">
                        <a href="#"><i class='bx bxl-linkedin-square'></i></a>
                        <a href="#"><i class='bx bxl-facebook-square' ></i></a>
                        <a href="#"><i class='bx bxl-instagram-alt' ></i></a>
                        <a href="#"><i class='bx bxl-twitter' ></i></a>
                    </div>
            </div>
        </div>
            
        <div class="logreg-box">
            <div class="form-box login">
                <form action="Login.php" method="post">
                    <h2>Entrar</h2>

                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-envelope' ></i></span>
                        <input name="email" type="email" required>
                        <label>Email</label>
                    </div>

                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-lock-alt' ></i></span>
                        <input name="senha" type="password" required>
                        <label>Senha</label> 
                    </div>

                    <div class="remember-forgot">
                        <label><input type="checkbox"> Remember me</label>
                        <a href="#">Esqueceu sua Senha?</a>
                    </div>

                    <button type="submit" class="btn">Entrar</button>

                    <div class="login-register">
                        <p>Não possui uma conta?
                            <a href="#" class="register-link">Crie uma</a>
                        </p>
                    </div>
                </form>
            </div>

            <div class="form-box register">
                <form action="Cadastrar.php" method="post">
                    <h2>Cadastrar</h2>

                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-user' ></i></span>
                        <input name="nomeCad" type="" required>
                        <label>Nome</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-envelope' ></i></span>
                        <input name="emailCad" type="email" required>
                        <label>Email</label>
                    </div>

                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-lock-alt' ></i></span>
                        <input name="senhaCad" type="password" required>
                        <label>Senha</label> 
                    </div>

                    <div class="remember-forgot">
                        <label><input type="checkbox" required >Eu concordo com os termos e condições</label>
                        <a href="#" class="information"><i class='bx bx-info-circle' ></i></a>
                    </div>

                    <button type="submit" class="btn">Entrar</button>

                    <div class="login-register">
                        <p>Já possui uma conta?
                            <a href="#" class="login-link">Entrar</a>
                        </p>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <?php
        if($_SESSION['usuario_existe'] == true)
        {
            header('Location: Conexao.php');
        }
    ?>

    <script src="script.js"></script>
</body>
</html>