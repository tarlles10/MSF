<?php

	if ($_POST) 
	{
		// se nao tiver uma imagem válida
		if (empty($_FILES['imagem']) OR $_FILES['imagem']['error'] != UPLOAD_ERR_OK) 
		{
			die ('<strong>Imagem invalida. Por favor coloque imagens do tipo: JPG, JPEG, GIF, PNG ou BMP.</strong>');
		}
	
		if (empty($_POST['marca'])) 
		{
			die('<strong>Por favor coloque um texto válido.</strong>');
		}
	
		$imagepath = $_FILES['imagem']['tmp_name'];
	
		// carregando a imagem
		$image = open_image($imagepath);
	
		if ($image == false) 
		{
			die ('<strong>Você enviou uma Imagem invalida. Por favor volte e envie uma imagem válida.</strong>');
		}
	   // pegando os tamanhos originais
		$width = imagesx($image);
		$height = imagesy($image);
	   
	   // calculando a percentagem
		if (!empty($_POST['percentagem']) AND is_numeric($_POST['percentagem'])) 
		{
			$percentagem = floatval($_POST['percentagem']);
			$percentagem = $percentagem / 100;
	
			$new_width 	= $width * $percentagem;
			$new_height = $height * $percentagem;
		   // Aplicando os novos tamanhos
		} 
		elseif (!empty($_POST['height']) AND is_numeric($_POST['height']) AND !empty($_POST['width']) AND is_numeric($_POST['width'])) 
		{
			$new_height = floatval($_POST['height']);
			$new_width = floatval($_POST['width']);
		} else 
		{
			die ('<strong>Você não especificou qualquer opções de redimensionamento.</strong>');
		}    

	   // Imagem com os novos tamanhos //
		$image_resized = imagecreatetruecolor($new_width, $new_height);
		
		imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		//aplicando a cor do texto de marca d'agua//
		 switch($_POST['cor']) 
		 {
			case 'preto':
				$color = imagecolorallocate($image, 0, 0, 0);
				break;
			case 'vermelho':
				$color = imagecolorallocate($image, 255, 0, 0);
				break;
			case 'azul':
				$color = imagecolorallocate($image, 0, 0, 255);
				break;
			case 'amarelo':
				$color = imagecolorallocate($image, 255, 255, 0);
				break;
			case 'verde':
				$color = imagecolorallocate($image, 0, 255, 0);
				break;
			case 'branco':
			default:
				$color = imagecolorallocate($image, 255, 255, 255);
		}
		
		// adicionando o texto a imagem
		imagestring($image_resized, 30, imagesx($image_resized) - 347, imagesy($image_resized)-40, $_POST['marca'], $color);

	
	
	
		// mostrando a imagem //
		//header('Content-type: image/jpeg');
		//imagejpeg($image_resized);
		header('Content-type: image/png');
		imagepng ($image_resized);
		exit();
	
	}


?>
<html>
    <head>
        <title>Redimencionar imagem</title>

    <style type="text/css">
        th { text-align: right; }
    </style>

    </head>

    <body>
        <form method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <th>Imagem:</th>
                <td><input type="file" name="imagem"></td>
            </tr>
<tr>
                <th>Redimencionar para: </th>
                <td><input type="text" name="percentagem" size="1" />% (Porcentagem)</td>
            </tr>
            <tr>
                <th>Texto:</th>
            <td><input type="text" name="marca" size="30" value="o texto aki" /></td>
                
            
            </tr>

            <tr>
                <th>Cor do texto:</th>
                <td>
                    <select name="cor">
                        <option value="preto">Preto</option>
                        <option value="branco">Branco</option>
                        <option value="azul">Azul</option>
                        <option value="vermelho">Vermelho</option>
                        <option value="amarelo">Amarelo</option>
                        <option value="verde">Verde</option>                        
                    </select>                
                </td>
            </tr>
         

            <tr><td colspan="2" style="text-align:center;"><input type="submit" value="Redimencionar imagem" /></td></tr>
        </form>
    </body>
</html>


<?php
function open_image ($file) {
    # JPEG:
    $im = @imagecreatefromjpeg($file);
    if ($im !== false) { return $im; }

    # GIF:
    $im = @imagecreatefromgif($file);
    if ($im !== false) { return $im; }

    # PNG:
    $im = @imagecreatefrompng($file);
    if ($im !== false) { return $im; }

    # GD File:
    $im = @imagecreatefromgd($file);
    if ($im !== false) { return $im; }

    # GD2 File:
    $im = @imagecreatefromgd2($file);
    if ($im !== false) { return $im; }

    # WBMP:
    $im = @imagecreatefromwbmp($file);
    if ($im !== false) { return $im; }

    # XBM:
    $im = @imagecreatefromxbm($file);
    if ($im !== false) { return $im; }

    # XPM:
    $im = @imagecreatefromxpm($file);
    if ($im !== false) { return $im; }

    # Refazer e ler a string:
    $im = @imagecreatefromstring(file_get_contents($file));
    if ($im !== false) { return $im; }

    return false;
}
?> 