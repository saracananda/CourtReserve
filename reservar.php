<?php
    session_start(); //inicia sessão

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){ //se tá logado (passou pelo login)
        require("acoes/conexao.php"); //incluir conexão quando sessão existir
        $nome = $_SESSION['usuario'][0]; //tá no índice 0 do array (primeiro)
        $id = $_SESSION['usuario'][1];
    }else{
        if(isset($_SESSION['adm']) && is_array($_SESSION['adm'])){ //se tá logado (passou pelo login)
            echo "<script>window.location = 'paginainicial-adm.php'</script>"; //se já taá logado ele é redirecionado de volta para a página inicial
        }else{
        echo "<script>window.location = 'login.php'</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Sora:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet" >
    <link rel="stylesheet" href="style/reserva-usuario.css">
    <link rel="stylesheet" href="style/header.css">
    
    <title>Reserva</title>
</head>
<body>
<?php include_once('components/header.php') ?>
    <main class="reserva-usuario">
        <div class="reserva-analise-disponibilidade-usuario">
            <div class="busca-disponibilidade">
                <div class="text-disponibilidade">
                    <h1 id="title-reservas">Reserva</h1>
                </div>
            </div>
        </div>

<?php

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $datahorarioinicial = $_POST["datahorarioinicial"];
        $datahorariofinal = $_POST["datahorariofinal"];
        $justificativa= $_POST["justificativa"];


        $sql = "INSERT INTO Reserva(datahorarioSolicitado, datahorarioSolicitadoFinal, justificativa, andamento, datahorarioSolicitacao, aprovacaoEquipamentos, Solicitante_id, Administrador_id) 
                VALUES('$datahorarioinicial','$datahorariofinal','$justificativa', 'pendente', NOW(), 'pendente', '$id', 'aguardando')";


        ##junta o codigo sql com a conexao do banco
        $sqlcombanco = $conexao->prepare($sql);

        ##executa o sql no banco de dados
        if($sqlcombanco->execute()):?>

        <div class="conteudo-enviado">
        <div class="mensagem">
        <h1>Solicitação Enviada!</h1>
        <p id="mensagem-solicitacao-enviada">Acesse a aba "Acompanhar Solicitação" para ver o progresso da sua solicitação</p>
        <script>
        // Aguarda 5 segundos e redireciona
        setTimeout(function() {
            window.location.href = "index.php"; 
        }, 5000);
        </script>

        </div>
        </div>

<?php   endif; 
}

?>
</body>
</html>
