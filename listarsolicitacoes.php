<?php
    session_start(); //inicia sessão

    if(isset($_SESSION['adm']) && is_array($_SESSION['adm'])){ //se tá logado (passou pelo login)
        require("acoes/conexao.php"); //incluir conexão quando sessão existir
        $nome = $_SESSION['adm'][0]; //tá no índice 0 do array (primeiro)
        
    }else{
        if(isset($_SESSION['adm']) && is_array($_SESSION['adm'])){ //se tá logado (passou pelo login)
            echo "<script>window.location = 'paginainicial-adm.php'</script>"; //se já taá logado ele é redirecionado de volta para a página inicial
        }else{
        echo "<script>window.location = 'acesso-adm.php'</script>";
        }
    }
?>

<?php
require("components/header-adm.php");
$retorno = $conexao->prepare("SELECT a.*, b.nome_Solicitante , b.id FROM Reserva a, Solicitante b WHERE a.Solicitante_id = b.id and a.Andamento = 'pendente'");
$retorno->execute();
$resultados = $retorno->fetchAll(); // Obter os resultados da consulta
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Sora:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/solicitacoes.css">
    <link rel="stylesheet" href="style/header.css">
    <title>Painel de Controle</title>

</head>

<body>

    <div class="Conteudo">
        <div class="titulo-Eventos">
            <h1>Solicitação de Reserva/Evento</h1>
        </div>
        <hr id="hr-linha">
        <div class="eventos-solicitacoes">
            <table>
                <thead>
                    <tr>
                        <th>Solicitação </th>
                        <th>Usuário</th>
                        <th>Data de Reserva</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($resultados as $value) { ?>
                    <tr>
                        <td> <?php echo $value['codigo'] ?> </td>
                        <td> <?php echo $value['nome_Solicitante'] ?> </td>
                        <td> <?php echo $value['datahorarioSolicitado'] ?> </td>
                        <td>
                            <form method="POST" action="analisarsolicitacao.php">
                                <input name="codigo" type="hidden" value="<?php echo $value['codigo']; ?>" />
                                <input name="id" id="professor" type="hidden" value="<?php echo $value['id']; ?>" />
                                <button name="alterar" type="submit" class="btn btn-primary">Analisar</button>
                            </form>

                        </td>

                    </tr>
                <?php  }  ?>
                </tr>
                </tbody>
            </table>
        </div>
        <table>
        </table>
</body>

</html>