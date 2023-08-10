<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/header.css">
    <title>Cabeçalho</title>
    <style>
        
    </style>
</head>
<body>
    <header class="header-usuario-registrado">
        <img src="img/logotipo.png" alt="Logotipo do sistema" id="logo-header">
        <div class="btns-usuario-registrado">
        <a href="acesso-adm.php" class="btn-header" >Início</a>
        <a href="listarsolicitacoes.php" class="btn-header">Painel de Controle</a>
    </div>
    <div class="btn-usuario-subst">
        <a href="#" class="btn-subst" id="btn-subst-profile">
            <img src="img/user.png" alt="user" class="photo-usuario">
            <p class="name-usuario"><?php echo $nome;?></p>
        </a>
        <a href="acoes/logout.php" class="btn-subst">Sair</a> <!--Sair da sessão -->
    </div>
    </header>
</body>
</html>