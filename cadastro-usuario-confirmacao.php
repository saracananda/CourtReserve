<?php
    session_start(); //inicia sessão

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){ //se tá logado (passou pelo login)
        // echo "<script>window.location = 'index.php'</script>"; //se já taá logado ele é redirecionado de volta para a página inicial
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
    <link rel="stylesheet" href="style/cadastro-usuario.css">
    <title>Cadastro | New Trends</title>
    <style>
        .content-confirmacao-cadastro{
    background-color: #ffffff;
    border-radius: 20px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 50%;
}

.orientacoes-cadastro-usuario{
    text-align: center;
}
    </style>
</head>

<body>
    <section class="cadastro-usuario">
        <div class="identicacao-page-cadastro">
            <h1 class="title-cadastro-usuario">Seja bem-vindo!</h1>
            <h1 class="divisa-title-cadastro-usuario">|</h1>
            <img src="logotipo.png" alt="Logotipo do Sistema" class="logotipo-cadastro-usuario">
        </div>
        <div class="content-confirmacao-cadastro">
            <h1 class="title-confirmacao-cadastro-usuario">Cadastro Concluído!</h1>
            <p class="orientacoes-cadastro-usuario">Obrigado por se cadastrar em nossa plataforma! Aproveite todas as funções do CourtReserve para simplificar suas reservas de quadras.</p>
        </div>
    </section>
    <script>
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 2000); // 2000 milissegundos = 2 segundos
    </script> 
</body>

</html>