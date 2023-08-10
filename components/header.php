<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/header.css">
    <title>Cabeçalho</title>
</head>
<body>
<?php

    $nome = $_SESSION['usuario'][0]; 
?>
    <header class="header-usuario-registrado">
        <img src="img/logotipo.png" alt="Logotipo do sistema" id="logo-header">
        <div class="btns-usuario-registrado">
        <a href="./index.php" class="btn-header">Início</a>
        <!-- <a href="#" class="btn-header">Eventos</a> -->
        <a href="./reserva-usuario.php" class="btn-header">Reservas</a>
        <a href="acompanhar-solicitacao.php" class="btn-header">Acompanhar Solicitação</a>
        <!-- <a href="#" class="btn-header">Meu perfil</a> -->
    </div>
    <div class="btn-usuario-subst">
        <a href="#" class="btn-subst" id="btn-subst-profile">
            <img src="img/user.png" alt="user" class="photo-usuario">
            <p class="name-usuario" style="margin: 0px;"><?php echo $nome;?></p>
        </a>
        <a href="acoes/logout.php" class="btn-subst">Sair</a>
    </div>
    </header>
</body>
</html>