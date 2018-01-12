<?php

function tem_post(){
    if (count($_POST) > 0){
        return true;
    }

    return false;
}

function tratar_anexo($anexo, $caminho){
    $padrao = '/^.+(\.bat$|\.pif$)$/';
    $resultado = preg_match($padrao, $anexo['name']);

    if ($resultado) {
        return false;
    }

    move_uploaded_file($anexo['tmp_name'], "anexos/$caminho/{$anexo['name']}");

    return true;
}

function icones_anexo($arquivo){
	
	$extensao = strtolower(end(explode('.',$arquivo)));
			
			switch($extensao){
				case 'jpg':
					$icone = '<img src="icons/jpg.png"/>';
					return $icone;
				case 'pdf':
					$icone = '<img src="icons/pdf.png"/>';
					return $icone;
				case 'png':
					$icone = '<img src="icons/png.png"/>';
					return $icone;
				case 'docx':
					$icone = '<img src="icons/docx.png"/>';
					return $icone;
				case 'doc':
					$icone = '<img src="icons/docx.png"/>';
					return $icone;
				case 'xlsx':
					$icone = '<img src="icons/xls.png"/>';
					return $icone;
				case 'pptx':
					$icone = '<img src="icons/ppt.png"/>';
					return $icone;
				case 'zip':
					$icone = '<img src="icons/zip.svg"/>';
					return $icone;
				case 'mp3':
					$icone = '<img src="icons/audio.svg"/>';
					return $icone;
				case 'rar':
					$icone = '<img src="icons/rar.svg"/>';
					return $icone;
				case 'mp4':
					$icone = '<img src="icons/video.svg"/>';
					return $icone;
				case 'avi':
					$icone = '<img src="icons/video.svg"/>';
					return $icone;
				default:
					$icone = '<img src="icons/file.png"/>';
					return $icone;
			}
}

function make_bitly_url($url,$login,$appkey,$format = 'xml',$version = '2.0.1'){
	//Criar a url
	$bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url).'&login='.$login.'&apiKey='.$appkey.'&format='.$format;

	//Obter url
	// tambem poderia usar cURL aqui
	$response = file_get_contents($bitly);

	//parse depending on desired format
	if(strtolower($format) == 'json')
	{
		$json = @json_decode($response,true);
		return $json['results'][$url]['shortUrl'];
	}
	else //xml
	{
		$xml = simplexml_load_string($response);
		return 'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
	}
}


?>