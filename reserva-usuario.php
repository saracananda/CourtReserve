<?php
    session_start(); //inicia sessão

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){ //se tá logado (passou pelo login)
        require("acoes/conexao.php"); //incluir conexão quando sessão existir
        $nome = $_SESSION['usuario'][0]; //tá no índice 0 do array (primeiro)
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/reserva-usuario.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="style/header.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <title>Reserva | New Trends</title>
    <style>
        .title-itemDisponivel {
            font-size: 35px;
            padding: 20px 0 40px 0;
        }

        .item-reserva {
            padding: 8px;
            gap: 10px;
            border-radius: 10px;
            border: 1px dashed #13510e;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            width: 200px;
            height: 250px;
        }
        .btn-item-reserva {
            width: 100px;
        }
        .tutorial{
            display: flex;
            justify-content: space-around;
            flex-direction: row;
    
        }
        .box{
             border-radius: 20px;
             background-color:#cccccc00;
        }
        .input-justificativa{
            width: 94%;
            height: 200px;
            border: 0.1px solid #ccc;
            padding: 20px;
            border-radius: 20px;
         }
    </style>
</head>

<body>
    <?php
    // session_start();
    include_once("components/header.php");
    include_once("acoes/conexao.php");
    $botaoconcluido = false;

    ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dataReserva = $_POST['dataReserva'];
        $horarioEntradaReserva = $_POST['horarioEntradaReserva'];
        $horarioSaidaReserva = $_POST['horarioSaidaReserva'];


        $submittedDataReserva = htmlspecialchars($_POST['dataReserva']);
        $submittedHorarioEntradaReserva = htmlspecialchars($_POST['horarioEntradaReserva']);
        $submittedHorarioSaidaReserva = htmlspecialchars($_POST['horarioSaidaReserva']);

        $datahorarioinicial = new DateTime($dataReserva . ' ' . $horarioEntradaReserva);
        $datahorariofinal = new DateTime($dataReserva . ' ' . $horarioSaidaReserva);

        $formattedDataHorarioInicial = $datahorarioinicial->format('Y-m-d H:i:s');
        $formattedDataHorarioFinal = $datahorariofinal->format('Y-m-d H:i:s');


        $sql = "SELECT count(*) FROM Reserva WHERE (
        (:dataInicial BETWEEN datahorarioSolicitado AND datahorarioSolicitadoFinal
        OR :dataFinal BETWEEN datahorarioSolicitado AND datahorarioSolicitadoFinal)
        AND andamento = 'Aprovado'
    ) OR (
        (datahorarioSolicitado BETWEEN :dataInicial AND :dataFinal
        OR datahorarioSolicitadoFinal BETWEEN :dataInicial AND :dataFinal)
        AND andamento = 'Aprovado'
    )";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':dataInicial', $formattedDataHorarioInicial, PDO::PARAM_STR);
        $stmt->bindParam(':dataFinal', $formattedDataHorarioFinal, PDO::PARAM_STR);
        $stmt->execute();

        $resultado = $stmt->fetchColumn();

        //echo "Número de linhas que atendem às condições: " . $resultado;

        if ($resultado > 0) {
            $quadraEstaLivre = false;
            $quadraEstaLivreShowMessagem = true;
            
        } else {
            $quadraEstaLivre = true;
            $quadraEstaLivreShowMessagem = true;
            $botaoconcluido = true;
        }
    }
    ?>

    <main class="reserva-usuario">
        <div class="reserva-analise-disponibilidade-usuario">
            <div class="busca-disponibilidade">
                <div class="text-disponibilidade">
                    <h1 id="title-reservas">Reservas</h1>
                    <h4 id="subtitle-descricao">Vamos verificar se não está reservado?</h4>
                </div>
                <form action="reserva-usuario.php" class="busca-dataHorario" method="post">
                    <div class="content-fornecimento-dados">
                        <img src="img/calendar.svg" alt="" class="img-input">
                        <div class="input-dados-reserva">
                            <label for="dataReserva">Data:</label>
                            <p id="descricao-input">Insira uma data para o jogo</p>
                            <input type="date" name="dataReserva" id="dataReserva" value="<?php echo $submittedDataReserva ?? ''; ?>">
                        </div>
                    </div>
                    <div class="content-fornecimento-dados">
                        <img src="img/clock.svg" alt="" class="img-input">
                        <div class="input-dados-reserva">
                            <label for="horarioReserva">Horário:</label>
                            <p id="descricao-data">Insira o horário inicial e final do jogo</p>
                            <div class="horarios">
                                <input type="time" name="horarioEntradaReserva" id="horarioEntradaReserva" value="<?php echo $submittedHorarioEntradaReserva ?? ''; ?>">
                                <input type="time" name="horarioSaidaReserva" id="horarioSaidaReserva" value="<?php echo $submittedHorarioSaidaReserva ?? ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="btn-verificarDisponibilidade">
                        <img src="img/check-circle.svg" alt="" class="img-input">
                        <button type="submit">Verificar</button>
                    </div>
                </form>
            </div>
        </div>

        <div style="display: block; text-align:center; color: #ffffff; background-color: <?= $quadraEstaLivre ? '#9ED2BE' : '#F31559'  ?>; width: 100vw; padding: 20px 0;">
            <?php if (isset($quadraEstaLivreShowMessagem)) {

            ?>

                <?php if ($quadraEstaLivre) { ?>
                    <p>A quadra está disponivel</p>
                <?php } else { ?>
                    <p>A quadra não está disponivel</p>
            <?php }
            } ?>
        </div>

        <div class="conteudo">
            <h4>PASSO A PASSO</h4>
            <p>FÁCIL E RÁPIDO PARA RESERVAR</p>

            <div class="tutorial">
                <div class="box" id="box1"></div>
                <div class="box" id="box2"></div>
                <div class="box" id="box3"></div>
                <div class="box" id="box4"></div>
            </div>
        </div>


        <section class="quadraDisponivel">
    <form action="reservar.php" method="post">
                <h1 class="title-itemDisponivel">Quadras disponíveis:</h1>
                <div class="itens-reserva">
                    <div class="item-reserva">

                        <div class="imagem-item-reserva"><img src="img/quadragrande.jpg" alt=""></div>
                        <div class="informacao-item-reserva">
                            <div class="informacoes-item-reserva">
                                <h1 class="title-item-reserva">Quadra I</h1>
                                <p class="descricao-item-reserva">Poliesportiva</p>
                            </div>
                            <div class="btn-item-reserva">
                                <input type="radio" name="quadra" value="1" require checked>
                                <button>Reservar</button>
                            </div>
                        </div>
                    </div>
                    <div class="item-reserva">

                        <div class="imagem-item-reserva"><img class="imgcomfiltro" src="img/quadrabasquete.jpg" alt=""></div>
                        <div class="informacao-item-reserva">
                            <div class="informacoes-item-reserva">
                                <h1 class="title-item-reserva">Quadra II</h1>
                                <p class="descricao-item-reserva">Basquete</p>
                            </div>
                            <div class="btn-item-reserva">
                                <button>Em manutenção</button>
                            </div>
                        </div>
                    </div>
                    <div class="item-reserva">

                        <div class="imagem-item-reserva"><img class="imgcomfiltro" src="img/ginasio.jpg" alt=""></div>
                        <div class="informacao-item-reserva">
                            <div class="informacoes-item-reserva">
                                <h1 class="title-item-reserva">Quadra III</h1>
                                <p class="descricao-item-reserva">Poliesportiva</p>
                            </div>
                            <div class="btn-item-reserva">
                                <button>Em manutenção</button>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <div class="justificativa">
            <div class="titulo-justificativa">
                <br>
                <h2 id="title-justify">JUSTIFICATIVA:</h2></div> 
                <div class="text-justificativa">
                <textarea class="input-justificativa" type="text" data-ls-module="charCounter" maxlength="200" name="justificativa" id="justificativa" required></textarea>
                </div>
            </div>
        </div>

        <input type="hidden" name="datahorarioinicial" value="<?php echo $formattedDataHorarioInicial ?? ''; ?>">
        <input type="hidden" name="datahorariofinal" value="<?php echo $formattedDataHorarioFinal ?? ''; ?>" >

                <div class="btns-disponibilidade">

                <?php if($botaoconcluido):?>
                    <div class="btn-verificarDisponibilidade">
                        <img src="img/check-circle.svg" alt="" class="img-input">
                        <button type="submit">Concluído</button>
                    </div>
                    <?php endif; ?>
                    <div class="btn-cancelarDisponibilidade">
                        <img src="img/x.svg" alt="" class="img-input">
                        <button type="reset">Cancelar</button>
                    </div>
                </div>
    </form>
        </section>
    </main>

</body>

</html>