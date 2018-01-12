<html>
    <head>
        <meta charset="utf-8" />
		<title>Nanuv</title>
		<link rel="sortcut icon" href="icons/cloud-icon.png" type="image/png" width="16px" height="16px"/>
		<link rel='stylesheet' href='css/normalize.css'>
		<link rel='stylesheet' href='css/botao.css' >
		<link rel='stylesheet' href='css/nanuv.css'>
		<link rel='stylesheet' href='css/bootstrap.css'>
		<script src='jquery/prefixfree.min.js'></script>
		<!--<script src="lib/sweet-alert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="lib/sweet-alert.css">-->
		<script src="dist/sweetalert2.min.js"></script>
		<link rel="stylesheet" type="text/css" href="dist/sweetalert2.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
		<script src="http://malsup.github.com/jquery.form.js"></script>
		<style>
			#progresso { position:relative; width:400px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
			#barra { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
			#percent { position:absolute; display:inline-block; top:3px; left:48%; }
		</style>
<script language=JavaScript>

var mensagem="";
function clickIE() {if (document.all) {(mensagem);return false;}}
function clickNS(e) {if 
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(mensagem);return false;}}}
if (document.layers) 
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
document.oncontextmenu=new Function("return false")

</script>
    </head>
	
    <body style="background: #EEF0FB;">

		<!--BARRA DE NAVEGAÇÃO-->
		<nav class="navbar navbar-default">
		  <div class="container-fluid"  style="font-family:Century Gothic; font-size: 23px" >
				  <a><img vspace="5px" hspace="5px"src='icons/cloud-icon.png' width="38px" height="38px"/>nanuv</a>
					<a href="logout.php"><img vspace="5px" hspace="5px"src='icons/ic_close_black_48dp.png' width="38px" height="38px" align="right"/></a>
					
		  </div>
	</nav>

		<!--MENU DE OPÇÕES DE ENVIO DE ARQUIVOS-->
		
		<div class='container' align="center">
			<div class='places'>
				 <div class='place'>
					 	<form  id="myForm" action="home.php" method="post" enctype="multipart/form-data" autocomplete="off">
							<input type="hidden" name="usuario_id" value="<?php print_r($protocolo); ?>" />
							<label class="customFileInput clearfix">
								<span class="btn btn-success fileinput-button">
								<i class="glyphicon glyphicon-plus"></i>
								<span style="font-family:Century Gothic">Add arquivos</span>
								</span>
								<input type="file" name="anexo" />
							</label>
							<button type="submit"  name="Cadastrar" class="btn btn-primary start">
								<i class="glyphicon glyphicon-upload"></i>
								<span style="font-family:Century Gothic">Iniciar upload</span>
							</button>
							
							<div id="progresso">
								<div id="barra"></div>
								<div id="percent">0%</div >
							</div>
							<br/>
							<div id="message"></div>
							<script>
							$(document).ready(function()
							{

								var options = { 
								beforeSend: function() 
								{
									$("#progresso").show();
									$("#barra").width('0%');
									$("#message").html("");
									$("#percent").html("0%");
								},
								uploadProgress: function(event, position, total, percentComplete) 
								{
									$("#barra").width(percentComplete+'%');
									$("#percent").html(percentComplete+'%');

								
								},
								success: function() 
								{
									$("#barra").width('100%');
									$("#percent").html('100%');
									location.reload();

								},
								complete: function(response) 
								{
									
								},
								error: function()
								{
									$("#message").html("<font color='red'> ERROR: unable to upload files</font>");

								}
								 
							}; 

								 $("#myForm").ajaxForm(options);

							});

							</script>
						</form>
				 </div>
			</div>
			
			<!--LISTA DE ARQUIVOS-->
			<div class='places'>
				<div style="font-family:Century Gothic" class="panel panel-default">
					<div class="panel-heading">MEUS ARQUIVOS</div>
					<table class="table">
						<tr>
							<th>Arquivo</th>
							<th>Opções</th>
						</tr>
							<?php foreach($anexos as $anexo): ?>
								<tr>
									<td><?php echo icones_anexo($anexo['nome']); ?> <?php if (strlen($anexo['nome']) > 40) echo substr($anexo['nome'], 0, 40) . "..."; else echo $anexo['nome']; ?></td>
									<td>
										<a style="color: #2E9AFE" class="glyphicon glyphicon-save" href="anexos/<?php print_r($local.$anexo['arquivo']); ?> "></a>
										<a style="color: #2E9AFE; padding-left:10px" class="glyphicon glyphicon-trash" href="remover.php?id=<?php echo $anexo['id']; ?>"></a>
										<a style="color: #2E9AFE; padding-left:10px" href="#" class="glyphicon glyphicon-link b" onclick ="swal({title: 'Endereço para arquivo', html: 'nanuv.com/anexos/<?php echo $local.$anexo['arquivo']; ?>', width: 600, imageUrl: 'icons/ic_link_black_48dp.png'});"> </a>
									</td>
								</tr>
							<?php endforeach; ?>
					</table>
				</div>
			</div>
			
			<!--RODAPE-->
			<div class='footer clear'>
				<p style="font-family: Century Gothic">Nanuv © 2015 · Português (Brasil)· BETA </p>
			</div>
		</div>
    </body>
</html>