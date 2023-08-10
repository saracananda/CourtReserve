<?php
    session_start(); //inicia sessão

    if(isset($_SESSION['adm']) && is_array($_SESSION['adm'])){ //se tá logado (passou pelo login)
        echo "<script>window.location = 'paginainicial-adm.php'</script>"; //se já taá logado ele é redirecionado de volta para a página inicial
    }else{
        if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){ //se tá logado (passou pelo login)
            echo "<script>window.location = 'index.php'</script>"; //se já taá logado ele é redirecionado de volta para a página inicial
        }else{
            
        }
        
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/acesso-adm.css">
    <link rel="stylesheet" href="style/header.css">
    <script type="text/javascript" src="script/jquery.js"></script>
    <script type="text/javascript" src="script/acesso-adm.js"></script>
    <title>Acesso do Administrador</title>
</head>
<body>
    <div class="container">
    <div class="logo-acesso-adm">
        <h1 class="title-acesso-adm">Acesso do Administrador</h1>
        <img class="logo" src="img/logotipo.png" alt="logo">
    </div> 
        
    <div class="form-acesso-adm">
        <div class="circle-form">
            <img class="perfil" src="img/perfil.png" alt="perfil">
            <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
        </div>
        <div class="form-with-background">
            <div id="mensagem"></div>
            <form id="formLoginAdm">
                <div class="input-acesso-adm">
                    <label for="id-adm">Seu ID:</label> <br>
                    <input type="text" name="id-adm" id="id-adm">
                </div>
                <div class="input-acesso-adm">
                    <label for="senha-adm">Sua senha:</label> <br>
                    <input type="password" name="senha-adm" id="senha-adm">
                </div>
                <button id="button-login-adm">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>