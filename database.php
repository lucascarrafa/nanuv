<?php

$conexao = mysqli_connect(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);

if (mysqli_connect_errno($conexao)) {
    echo "Problemas para conectar no banco. Verifique os dados!";
    die();
}

function buscar_anexos($conexao, $id)
{
    $sqlBusca = "SELECT * FROM anexos WHERE usuario_id = {$id} "; 
    $resultado = mysqli_query($conexao, $sqlBusca);

    $anexos = array();

    while ($anexo = mysqli_fetch_assoc($resultado)) {
        $anexos[] = $anexo;
    }

    return $anexos;
}

function gravar_anexo($conexao, $anexo)
{
    $sqlGravar = "INSERT INTO anexos
        (usuario_id, nome, arquivo)
        VALUES
        (	 {$anexo['usuario_id']},
            '{$anexo['nome']}',
            '{$anexo['arquivo']}'
        )
    ";

    mysqli_query($conexao, $sqlGravar);
}

function remover_anexo($conexao, $id, $local){

	    $del = mysql_query("SELECT id, usuario_id, nome ,arquivo FROM anexos WHERE id = '$id'");
		while($dados = mysql_fetch_array($del,MYSQL_ASSOC)){
		$caminho = "anexos/$local";
        unlink($caminho.'/'.$dados['arquivo']);
        }
		
	$sqlRemover = "DELETE FROM anexos WHERE id = {$id}";
	mysqli_query($conexao, $sqlRemover);
	
}

?>