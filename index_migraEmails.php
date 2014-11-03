<?php header("Content-Type: text/html; charset=ISO-8859-1",true);
	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");
	$objConfiguracao->retornaNomeDominioSSL8($objConfiguracao);

//	===================================================== Funчуo para migraчуo de dados dos emails.	
	include("class/classNewsletter.php");	
	$objNewsletter 	= new newsLetter($objConexao);
	$objNewsletter->incluirMailBlockList($objConexao);
	echo 'terminou';
	exit;
//	===============================================================================================

?>