<?php 
	$pagina = "";
	$str_acessoMinimo = "";

	include("../config/config_Sistema.php");

	header("Content-Type: text/html; charset=ISO-8859-1",true);

	if (isset($_GET["str_posicaoSatelite"]) || !empty($_GET["str_posicaoSatelite"]))
	{
		echo "<html><head><title>".$objConfiguracao->showTitulo()."</title><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'><link rel='shortcut icon' href='".$objConfiguracao->getDiretorioIcons()."/icon.ico' /><style type='text/css'>body {background-color: '".$objConfiguracao->getCorTopGrupo()."'; margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px;}</style></head><body>".$objConfiguracao->sequenceCrypt($_GET["str_posicaoSatelite"], 2, false)."</body></html>";
	}
?>

