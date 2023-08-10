<?php
    define('SERVER', 'localhost'); //servidor
    define('USUARIO', 'root'); //usuario
    define('SENHA', ''); //senha da conexão
    define('DATABASE', 'CourtReserve'); //nome da database

    try{ //se conseguir fazer o que tem aq, beleza, se não, entra no catch
        $conexao = new pdo('mysql:host='.SERVER.';dbname='.DATABASE, USUARIO, SENHA);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //seta relatorio de erro
    } catch(PDOexception $erro){
        // echo "Ocorreu um erro de conexão: {$erro->getMessage()}"; //mostra o erro certinho {} = concatenar variavel dentro de echo
        $conexao = null; //variável nn existe aq dentro, ent tem que add
    }

?>