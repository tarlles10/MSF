<?php 
	//============================================================================//
	//            Este script deve ser executado diáriamente                      //
	//            de 00:00 AM até as 06:00 AM horario de Brasília                 //
	//============================================================================//
	header("Content-Type: text/html; charset=ISO-8859-1",true);	

	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");

	//============================================================================//
	//            Este script gerao SiteMap do portal dos dados atulizados        //
	//============================================================================//
	$objConfiguracao->geradorSiteMap($objConexao) 
	
?>