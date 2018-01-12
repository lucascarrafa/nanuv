<?php 

session_start();

	 $login = $_POST['login'];
	 $senha = MD5($_POST['senha']);
	 $celular = $_POST['celular'];
	 $nome = $_POST['nome'];
	 $connect = mysql_connect('mysql01.nanuv1.hospedagemdesites.ws','nanuv1','sistemanuv014!');
	 $db = mysql_select_db('nanuv1');
	 $query_select = "SELECT login FROM usuarios WHERE login = '$login'";
	 $select = mysql_query($query_select,$connect);
	 $array = mysql_fetch_array($select);
	 $logarray = $array['login'];
	 
	 $er = "/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/";
	 $resultado = preg_match($er, $login);
	 
	  $exp_regular = "/^([0-9]{2})([9]{1})?([0-9]{9})$/";
	  $ret = preg_match($exp_regular, $celular); 
	 
	  $res = preg_match("/^([A-Z,a-z,0-9,_,-]){4,}$/", $senha);
	  $res1 = preg_match("/^([A-Z,a-z]){4,}$/", $senha);
	 
	 if(!($resultado && $ret && ($res||$res1)))
	 {
		echo"<script language='javascript' type='text/javascript'>alert('Preenchida os campos corretamente');window.location.href='cadastro.html';</script>";
	 }
	 else
	 {
		if($logarray == $login)
		{
			echo"<script language='javascript' type='text/javascript'>alert('Esse login ja existe');window.location.href='cadastro.html';</script>";
			die();
		}
		else 
		{
			$query = "INSERT INTO usuarios (login,senha,celular,nome) VALUES ('$login','$senha','$celular','$nome')";
			$insert = mysql_query($query,$connect);
			$pasta = MD5($login);
			mkdir("anexos/$pasta/");
			if($insert)
			{
				echo"<script language='javascript' type='text/javascript'>alert('Cadastrado feito com sucesso!');window.location.href='index.html'</script>";
			}
			else
			{
				echo"<script language='javascript' type='text/javascript'>alert('Algo deu errado, tente novamente!');window.location.href='cadastro.html'</script>";
			}
		}
	 }
	 include "cadastro.html";
?>