$(function(){
    $("button#button-login-adm").on("click", function(e){
        e.preventDefault(); //quando clica no botão não acontece nada

        var campoId = $("form#formLoginAdm #id-adm").val(); //pega os campos
        var campoSenhaadm = $("form#formLoginAdm #senha-adm").val();
        

        if(campoId.trim() == "" || campoSenhaadm.trim() == ""){ //trim elimina os campos vazios antes e depois do que for digitado
            $("div#mensagem").show().removeClass("red").html("Preencha todos os campos."); //exibe se nn tiver preenchido os campos
        }else{
            //ajax
            $.ajax({
                url: "acoes/logar-adm.php", //action do formulario (como tá sendo executado no login, dá certo o link direto pra pasta)
                type: "POST", //metodo
                data:{ //parametros
                    id: campoId, //nome do post: valor do post
                    senhaadm: campoSenhaadm
                },

                success: function(retorno){
                    retorno = JSON.parse(retorno); 

                    if(retorno["erro"]){
                        $("div#mensagem").show().addClass("red").html(retorno["mensagem"]); //mostra qual foi o erro
                    }else{
                        window.location = "paginainicial-adm.php"; //redirecionar
                    }
                },

                error: function(){
                    $("div#mensagem").show().addClass("red").html("Ocorreu um erro durante a solicitação."); //avisa que ocorreu erro na solicitação (tlvz de conexão)
                }
            });
        }
    });

});