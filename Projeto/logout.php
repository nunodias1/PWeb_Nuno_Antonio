<?php
// Remove as variáveis de sessão associadas ao utilizador e ao filme
    unset($_SESSION['username']);
    unset($_SESSION['movieID']);
// Destrói a sessão
    session_destroy();
// Redireciona para a login page
    header('Location: login.php');
?>