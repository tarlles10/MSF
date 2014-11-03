<?php //============================================================================//
	//            Este script deve ser executado diáriamente                      //
	//            de 00:00 AM até as 06:00 AM horario de Brasília                 //
	//============================================================================//
	// postmaster.live.com
	// postmaster.yahoo.com
	
	header("Content-Type: text/html; charset=ISO-8859-1",true);	

	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");

	//============================================================================//
	//            Este script envia newsletters programada pelo usuário           //
	//============================================================================//
	include("class/classNewsletter.php");
	$objNewsletter 		= new Newsletter($objConfiguracao, $objConexao);
	
//	$objNewsletter->gerarNewsLetter($objConfiguracao, $objConexao, TRUE);	
	$objNewsletter->gerarNewsLetter($objConfiguracao, $objConexao);	
	$objNewsletter->enviarNewsLetter($objConexao, $objConfiguracao);

	
?>