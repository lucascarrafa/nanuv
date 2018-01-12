<?php 

session_start();

include "config.php";
include "database.php";
include "login.php";

remover_anexo($conexao, $_GET['id'],$_COOKIE['login']);

header('Location: home');

?>