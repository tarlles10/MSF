<?php 
	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");
	include("class/classRssFeed.php");
	
	$objRssFeed 		= new rssFeed($objConexao);

    header("Content-Type: application/rss+xml; charset=utf-8");
    echo $objRssFeed->lendoRssFeed($objConexao);
?>