<?php
    session_start(); //inicia sessão

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){ //se tá logado (passou pelo login)
        echo "<script>window.location = 'index.php'</script>"; //se já taá logado ele é redirecionado de volta para a página inicial
    }else{
        if(isset($_SESSION['adm']) && is_array($_SESSION['adm'])){ //se tá logado (passou pelo login)
            echo "<script>window.location = 'paginainicial-adm.php'</script>"; //se já taá logado ele é redirecionado de volta para a página inicial
        }else{
            
        }
        
    }

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/login.css">
    <script type="text/javascript" src="script/jquery.js"></script>
    <script type="text/javascript" src="script/acesso.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Login | New Trends</title>
</head>

<body>
    <section class="login-usuario">
        <img src="img/bolavolei.png" alt="Bola de Vôlei" id="bola-login">
        <div class="login-convidativo">
            <img src="img/logotipo.png" alt="Logotipo do sistema">
            <h1 class="title-login">Que comecem <br> os jogos!</h1>
        </div>

        <div class="form-usuario">
            <div class="circle-form">
                <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                <lord-icon
                    src="https://cdn.lordicon.com/hbvyhtse.json"
                    trigger="hover"
                    colors="primary:#13510e"
                    style="width:80px;height:80px">
                </lord-icon>
            </div>
            <div class="form-with-background">

                <div id="mensagem"></div>
                    <form id="formularioLogin">

                        <div class="linha input-login">
                            <label for="email">Seu email:</label>
                            <input type="email" name="email" id="email">
                        </div>

                        <div class="linha input-login">
                            <label for="senha">Sua senha:</label>
                            <input type="password" name="senha" id="senha">
                        </div>

                        <a href="recuperacao-senha-usuario.html" class="recuperacao-senha-usuario">Esqueceu a sua senha?</a>

                        <div id="button">
                            <button id="button-entrar-login">Entrar</button> <!-- botao personalizado no arquivo js -->
                        </div>

                    </form>

                    <div class="cadastro-usuario">
                        <p id="mensagem-cadastro">Ainda não tem uma conta?</p>
                        <a href="cadastro-usuario.php" class="link-cadastro-usuario">Crie sua conta agora</a>
                    </div>
                    <div class="acesso-adm">
                    <a href="acesso-adm.php" class="link-acesso-adm">Acesso do Administrador</a>
                </div>
            </div>
        </div>
    </section>


</body>

</html>