<?php 

session_start();

	 $login = $_POST['login'];
	 $entrar = $_POST['entrar'];
	 $senha = md5($_POST['senha']);
	 $connect = mysql_connect('mysql01.nanuv1.hospedagemdesites.ws','nanuv1','sistemanuv014!');
	 $db = mysql_select_db('nanuv1');
	 if (isset($entrar)) 
		{
			
			$verifica = mysql_query("SELECT id, login, senha FROM usuarios WHERE login = '$login' AND senha = '$senha'") or die("erro ao selecionar");
			if (mysql_num_rows($verifica)<=0)
			{
				echo "<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='index.html';</script>";
				echo "<script type='text/JavaScript'>document.location.reload();</script>";
				die();
			}
			else
			{	
				$dados = mysql_fetch_array($verifica);
				$_SESSION["id_usuario"] = $dados["id"];
				$login = MD5($dados['login']);
				setcookie("login", $login);
				header("Location:home");
			}
		}
	 include "index.html";
	 
?>