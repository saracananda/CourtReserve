<?php
    session_start(); //abre sessão (sempre que for trabalhar com ela)
    session_destroy(); // destroi sessão
    
    echo "<script>window.location = '../login.php'</script>"; //vai pra página de colocar os dados pra logar
?>