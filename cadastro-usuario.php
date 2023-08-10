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
    <link rel="stylesheet" href="style/cadastro-usuario.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Cadastro | New Trends</title>
</head>


<body>
    <section class="cadastro-usuario">
        <div class="identicacao-page-cadastro">
            <h1 class="title-cadastro-usuario">Seja bem-vindo!</h1>
            <h1 class="divisa-title-cadastro-usuario">|</h1>
            <img src="img/logotipo.png" alt="Logotipo do Sistema" class="logotipo-cadastro-usuario">
        </div>
        <div class="alert alert-danger" style="display: none;" id="alert-div"></div>
        <div class="form-with-background-cadastro">
            <div class="circle-form">
                <img src="img/user.png" alt="imagem usuario">
            </div>
            <form action="cadastro.php" method="post" class="cadastro-usuario">
                <div class="dois-inputs">
                    <div class="input-cadastro-usuario">
                        <label for="nomeCompleto">Nome completo:</label>
                        <input type="text" name="nomeCompleto" id="nomeCompleto">
                    </div>
                    <div class="input-cadastro-usuario" id="campoMatricula">
                        <label for="matricula">Matrícula:</label>
                        <input type="text" name="matricula" id="matricula">
                        <p class="observacao-cadastro-estudante">Caso não seja aluno(a) da Instituição, deixe em branco
                        </p>
                    </div>
                </div>
                <div class="dois-inputs">
                    <div class="input-cadastro-usuario">
                        <label for="dtaNascimento">Data de nascimento:</label>
                        <input type="date" name="dtaNascimento" id="dtaNascimento">
                    </div>
                    <div class="input-cadastro-usuario">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email">
                    </div>
                </div>
                <div class="dois-inputs">

                    <div class="input-cadastro-usuario">
                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" id="senha">
                    </div>
                </div>
                <button type="submit" id="button-cadastrar-usuario">Cadastrar</button>
            </form>
            <p class="login-usuario">Possui uma conta? <a href="login.php">Acesse sua conta agora</a></p>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita o envio normal do formulário

            const nomeCompleto = document.getElementById('nomeCompleto').value;
            const matricula = document.getElementById('matricula').value;
            const dtaNascimento = document.getElementById('dtaNascimento').value;
            const email = document.getElementById('email').value;
            const senha = document.getElementById('senha').value;

            const alertDiv = document.createElement('div');
            alertDiv.id = 'alert-div';
            alertDiv.className = 'alert';
            alertDiv.style.display = 'none';

            // Verificações de validação
            const nomeRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s]{8,}$/;
            const isNomeValid = nomeRegex.test(nomeCompleto);

            const isMatriculaValid = matricula.length >= 15;

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const isEmailValid = emailRegex.test(email);

            const isSenhaValid = senha.length >= 6;

            // Array para armazenar os campos inválidos
            const camposInvalidos = [];

            if (!isNomeValid) {
                camposInvalidos.push('Nome Completo');
            }
            if (!isMatriculaValid) {
                camposInvalidos.push('Matrícula');
            }
            if (!isEmailValid) {
                camposInvalidos.push('E-mail');
            }
            if (!isSenhaValid) {
                camposInvalidos.push('Senha');
            }

            if (camposInvalidos.length === 0) {
                // Se todos os campos obrigatórios estiverem preenchidos corretamente, exiba mensagem de sucesso
                document.querySelector('form').submit();
            } else {
                // Se algum campo obrigatório estiver vazio ou incorreto, exiba mensagem de erro
                alertDiv.className = 'alert alert-danger';
                alertDiv.textContent = `Erro ao cadastrar. Verifique os seguintes campos: ${camposInvalidos.join(', ')}.`;
                alertDiv.style.display = 'block';
            }

            // Adicione a div de alerta logo após a mensagem de boas-vindas
            const identificacaoDiv = document.querySelector('.identicacao-page-cadastro');
            identificacaoDiv.parentNode.insertBefore(alertDiv, identificacaoDiv.nextSibling);

            // Faça a mensagem de alerta sumir após 10 segundos
            setTimeout(function() {
                alertDiv.style.display = 'none';
            }, 3000);
        });
    });
</script>


</body>

</html>