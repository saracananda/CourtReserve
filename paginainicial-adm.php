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
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/header.css">
    <!-- Incluir o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Página Inicial | New Trends</title>
</head>

<body>
    <?php include_once('components/header-adm.php') ?>
    <main class="pagina-inicial-usuario">
        <div class="pagina-inicial-carrossel">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

                <!-- Início indicadores para navegar nos slides do carousel -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <!-- Fim indicadores para navegar nos slides do carousel -->

                <!-- Início slide carousel -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/BANNER FAMIF (1).png" class="d-block w-100" alt="Categoria 1">
                    </div>
                    <div class="carousel-item">
                        <img src="img/BANNER JEIF.png" class="d-block w-100" alt="Categoria 2">
                    </div>
                    <div class="carousel-item">
                        <img src="img/BANNER FAMIF3 1350X400.png" class="d-block w-100" alt="Categoria 3">
                    </div>
                </div>
                <!-- Fim slide carousel -->

                <!-- Início anterior e próximo slide carousel -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                <!-- Fim anterior e próximo slide carousel -->

            </div>
        </div>
        <div class="pagina-inicial-proximos-eventos">
            <h1 class="title-section">Próximos eventos</h1>
            <div class="eventos-sistema">
                <div class="evento-sistema">
                    <img src="img/evento.png" alt="" class="banner-evento-sistema">
                    <div class="dados-evento-sistema">
                        <p class="identificacao-evento-sistema">
                            JEIF 2023
                        </p>
                        <p class="data-evento-sistema">
                            <img src="img/calendar.png" alt="">25/04/2023
                        </p>
                    </div>
                </div>
                <div class="evento-sistema">
                <img src="img/evento.png" alt="" class="banner-evento-sistema">
                    <div class="dados-evento-sistema">
                        <p class="identificacao-evento-sistema">
                        JEIF 2023
                        </p>
                        <p class="data-evento-sistema">
                            <img src="img/calendar.png" alt="">25/04/2023
                        </p>
                    </div>
                </div>
                <div class="evento-sistema">
                <img src="img/evento.png" alt="" class="banner-evento-sistema">
                    <div class="dados-evento-sistema">
                        <p class="identificacao-evento-sistema">
                        JEIF 2023
                        </p>
                        <p class="data-evento-sistema">
                            <img src="img/calendar.png" alt="">25/04/2023
                        </p>
                    </div>
                </div>
                <div class="evento-sistema">
                <img src="img/evento.png" alt="" class="banner-evento-sistema">
                    <div class="dados-evento-sistema">
                        <p class="identificacao-evento-sistema">
                        JEIF 2023
                        </p>
                        <p class="data-evento-sistema">
                            <img src="img/calendar.png" alt="">25/04/2023
                        </p>
                    </div>
                </div>
                <div class="evento-sistema">
                <img src="img/evento.png" alt="" class="banner-evento-sistema">
                    <div class="dados-evento-sistema">
                        <p class="identificacao-evento-sistema">
                        JEIF 2023
                        </p>
                        <p class="data-evento-sistema">
                            <img src="img/calendar.png" alt="">25/04/2023
                        </p>
                    </div>
                </div>
                <div class="evento-sistema">
                <img src="img/evento.png" alt="" class="banner-evento-sistema">
                    <div class="dados-evento-sistema">
                        <p class="identificacao-evento-sistema">
                        JEIF 2023
                        </p>
                        <p class="data-evento-sistema">
                            <img src="img/calendar.png" alt="">25/04/2023
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pagina-inical-avaliacao"></div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>