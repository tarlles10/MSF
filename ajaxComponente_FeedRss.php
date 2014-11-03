<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");
	include("class/classRssFeed.php");
	$objRssFeed 		= new rssFeed($objConexao);	
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="grupoEI_fundo_02" style="height:62px;"><span class="adm_fonteTextoGrupo_01"><?php echo $objRssFeed->escrevendoRssFeed($_GET["cod"]);?></span></td>
  </tr>
</table>
<script>
	$disableBuscaSimples = false;//DÁ PERMISSÃO PARA A BUSCA SER EXECUTADA NOVAMENTE JÁ QUE NÃO EXISTE MAIS CARREGAMENTOS AJAX OCUPADOS NO MOMENTO.
</script>