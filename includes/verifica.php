<?php
// Inicia sess�es
session_start();

// Verifica se existe os dados da sess�o de login
if(!isset($_SESSION["valid_user"]))
{
    // Usu�rio n�o logado! Redireciona para a p�gina de login
    header("Location: index.php");
    exit;
}
?>