<?php //============================================================================//
	//            Este script deve ser executado di�riamente                      //
	//            de 00:00 AM at� as 06:00 AM horario de Bras�lia                 //
	//============================================================================//
	// postmaster.live.com
	// postmaster.yahoo.com
	
	header("Content-Type: text/html; charset=ISO-8859-1",true);	

	$pagina = "";
	$str_acessoMinimo = "";

	include("../config/config_Sistema.php");
	
	//============================================================================//
	//            Este script envia link do boleto mensal para usu�rio            //
	//============================================================================//
	include("../class/classContratos.php");
	$objContratos 		= new contratos($objConexao);
	$objContratos->atribuiVariaveisBoletoContratos($objConexao, $objConfiguracao);
	
?>