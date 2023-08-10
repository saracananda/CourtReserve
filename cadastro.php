<?php
// inclui de conexão com o banco de dados
require("./acoes/conexao.php");

// para realizar o cadastro de usuário
function cadastro($conexao, $nomeCompleto,$dtaNascimento, $email, $senha, $matricula) {
    // Monta a consulta SQL para inserir os dados na tabela 'usuario'
    $query = "INSERT INTO  Solicitante (nome_solicitante, nascimento, email, senha, matricula) 
    VALUES ('$nomeCompleto','$dtaNascimento', '$email', '$senha', '$matricula' )";
    
    // Executa a consulta e verifica se o cadastro foi realizado com sucesso
    if (mysqli_query($conexao, $query)) {
        // Inicia uma sessão para armazenar informações do usuário cadastrado
        session_start();
        $_SESSION["usuario"] = array($nomeCompleto, 0);
         // Redireciona para a página de confirmação após o cadastro bem-sucedido
        header("Location: cadastro-usuario-confirmacao.php");
        exit(); // Certifique-se de sair do script após o redirecionamento
        // Retorna uma resposta em formato JSON indicando sucesso no cadastro
        return json_encode(array("erro" => 0));
    } else {
        // Retorna uma resposta em formato JSON indicando erro no cadastro
        return json_encode(array("erro" => 1, "mensagem" => "Ocorreu um erro ao cadastrar usuário."));
    }
}

// Verifica se a requisição é do tipo POST e se a ação é de cadastro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se os campos necessários foram enviados no formulário
    if (isset($_POST["nomeCompleto"]) && isset($_POST["matricula"]) && isset($_POST["dtaNascimento"])
    && isset($_POST["email"]) &&isset($_POST["senha"])) {
        // Conecta-se ao banco de dados
        $conexao = mysqli_connect('localhost', 'root', '', 'CourtReserve');

        // Verifica se a conexão foi bem sucedida
        if ($conexao) {
            // Chama a função de cadastro e exibe o resultado
            echo cadastro($conexao, $_POST["nomeCompleto"], $_POST["dtaNascimento"], $_POST["email"], $_POST["senha"], $_POST["matricula"], $_POST["email"] );
            
            // Fecha a conexão com o banco de dados
            mysqli_close($conexao);
        } else {
            // Retorna uma resposta em formato JSON indicando erro na conexão com o banco
            echo json_encode(array("erro" => 1, "mensagem" => "Erro na conexão com o banco."));
        }
    } else {
        // Retorna uma resposta em formato JSON indicando campos ausentes no formulário
        echo json_encode(array("erro" => 1, "mensagem" => "Campos necessários não foram enviados."));
    }
}
