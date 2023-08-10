$(function(){
    $("button#button-entrar-login").on("click", function(e){
        e.preventDefault(); //quando clica no botão não acontece nada

        var campoEmail = $("form#formularioLogin #email").val(); //pega os campos
        var campoSenha = $("form#formularioLogin #senha").val();
        

        if(campoEmail.trim() == "" || campoSenha.trim() == ""){ //trim elimina os campos vazios antes e depois do que for digitado
            $("div#mensagem").show().removeClass("red").html("Preencha todos os campos."); //exibe se nn tiver preenchido os campos
        }else{
            //ajax
            $.ajax({
                url: "acoes/logar_solicitante.php", //action do formulario (como tá sendo executado no login, dá certo o link direto pra pasta)
                type: "POST", //metodo
                data:{ //parametros
                    email: campoEmail, //nome do post: valor do post
                    senha: campoSenha
                },

                success: function(retorno){
                    retorno = JSON.parse(retorno); 

                    if(retorno["erro"]){
                        $("div#mensagem").show().addClass("red").html(retorno["mensagem"]); //mostra qual foi o erro
                    }else{
                        window.location = "index.php"; //redirecionar
                    }
                },

                error: function(){
                    $("div#mensagem").show().addClass("red").html("Ocorreu um erro durante a solicitação."); //avisa que ocorreu erro na solicitação (tlvz de conexão)
                }
            });
        }
    });

});