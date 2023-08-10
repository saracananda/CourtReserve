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

$idSolicitante = $_POST['id'];
$codReserva = $_POST['codigo'];


// Consulta SQL para obter os detalhes do solicitante
$sqlSolicitante = "SELECT * FROM Solicitante WHERE id = :idSolicitante";
$retornoSolicitante = $conexao->prepare($sqlSolicitante);
$retornoSolicitante->bindParam(':idSolicitante', $idSolicitante, PDO::PARAM_INT);
$retornoSolicitante->execute();

// Armazena os detalhes do solicitante em $detalhesSolicitante
$detalhesSolicitante = $retornoSolicitante->fetch();

// Consulta SQL para obter os detalhes da reserva correspondente ao código
$sqlReserva = "SELECT * FROM Reserva WHERE Solicitante_id = :idSolicitante AND codigo = :codReserva";
$retornoReserva = $conexao->prepare($sqlReserva);
$retornoReserva->bindParam(':idSolicitante', $idSolicitante, PDO::PARAM_INT);
$retornoReserva->bindParam(':codReserva', $codReserva, PDO::PARAM_INT);
$retornoReserva->execute();

// Armazena os detalhes da reserva em $detalhesReserva
$detalhesReserva = $retornoReserva->fetch();

//Verifica se a ação foi enviada
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao'])) {
    $acao = $_POST['acao']; // Valor do botão que foi clicado

    if ($acao === 'aprovar' || $acao === 'recusar') {
        $adminID = $_SESSION['admin_id']; // ID do administrador logado

        // Verificar ação e definir novo status
        $novoStatus = ($acao === 'aprovar') ? 'Aprovado' : 'Reprovado';

        // Atualizar o status da reserva no banco de dados
        $sqlAtualizarStatus = "UPDATE Reserva SET andamento = :novoStatus, Administrador_id = :adminID WHERE Solicitante_id = :idSolicitante AND codigo = :codReserva";
        $retornoAtualizarStatus = $conexao->prepare($sqlAtualizarStatus);
        $retornoAtualizarStatus->bindParam(':novoStatus', $novoStatus, PDO::PARAM_STR);
        $retornoAtualizarStatus->bindParam(':adminID', $adminID, PDO::PARAM_INT);
        $retornoAtualizarStatus->bindParam(':idSolicitante', $idSolicitante, PDO::PARAM_INT);
        $retornoAtualizarStatus->bindParam(':codReserva', $codReserva, PDO::PARAM_INT);
        $retornoAtualizarStatus->execute();

        header("Location: listarsolicitacoes.php"); // Substitua "nova_pagina.php" pela URL da página para a qual deseja redirecionar
        exit;
        // Redirecionar para a página de detalhes da reserva ou outra página relevante
//         header('Location: outra-pagina.php?id=' . $idSolicitante . '&codigo=' . $codReserva);
// exit();

    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Sora:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/solicitacoes.css">
    <link rel="stylesheet" href="style/header.css">
    <!-- Adicione o link para o CSS do Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Painel de Controle</title>
    <style>
        th {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="Conteudo">
        <div class="titulo-Eventos">
            <h1>Solicitação de Reserva/Evento</h1>
        </div>
        <hr id="hr-linha">
        <div class="Eventos-solicitacoes">
            <div class="eventos-dados">
                <!-- Dados do Solicitante -->
                <p id="texto-solicitante"><b> Dados do Solicitante: </b></p>
                <table class="table table-bordered">
                    <tr>
                        <th>Nome Completo:</th>
                        <td><?php echo htmlspecialchars($detalhesSolicitante['nome_Solicitante']); ?></td>
                    </tr>
                    <tr>
                        <th>Matrícula:</th>
                        <td><?php echo htmlspecialchars($detalhesSolicitante['matricula']); ?></td>
                    </tr>
                    <tr>
                        <th>Data de Nascimento</th>
                        <td><?php echo htmlspecialchars($detalhesSolicitante['nascimento']); ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?php echo htmlspecialchars($detalhesSolicitante['email']); ?></td>
                    </tr>
                </table>

                <!-- Dados da Reserva -->
                <p id="texto-solicitacao"><b> Reserva: </b></p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Data e horário de início da reserva</th>
                            <th>Data e horário final da reserva</th>
                            <!-- Outras colunas relevantes -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $detalhesReserva['codigo'] ?></td>
                            <td><?php echo $detalhesReserva['datahorarioSolicitado'] ?></td>
                            <td><?php echo $detalhesReserva['datahorarioSolicitadoFinal'] ?></td>
                            <!-- Outras colunas relevantes -->
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mostrar-justificativa">
                <p id="texto-justificativa"><b>Justificativa:</b> </p>
                <div class="conteudo-justificativa"><?php echo $detalhesReserva['justificativa'] ?></div>
            </div>

        </div>
        <<div class="footer">
            <form method="post" action="analisarsolicitacao.php">
                <input type="hidden" name="id" value="<?php echo $idSolicitante ?>">
                <input type="hidden" name="codigo" value="<?php echo $codReserva ?>">
                <button class="btn btn-danger btm-recusar" name="acao" value="recusar">Recusar</button>
                <button class="btn btn-success btm-aprovar" name="acao" value="aprovar"><b>Aprovar</b></button>
            </form>
    </div>

    </div>

    <!-- Adicione o script do Bootstrap no final do body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>