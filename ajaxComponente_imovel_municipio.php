<?php header("Content-Type: text/html; charset=ISO-8859-1",true);
	$pagina 			= "";
	$str_acessoMinimo 	= "";

	include("config/config_Sistema.php");
	include("class/classImovel.php");
	
	$objImovel 	= new imovel($objConexao);
	if (isset($_POST["id_municipio"]) || !empty($_POST["id_municipio"]))
	{
		if ($_POST["id_municipio"] != '')
		{
			$combo = '<select name="slc_bairro" id="slc_bairro" class="adm_formResCombo_01" style="width:125" title="Bairro" ><option value="">:: selecione ::</option>';
			$query = $objImovel->comboBairro($objConexao, $_POST["id_municipio"]);
			while($array = $objConexao->retornaArray($query))
			{
				$combo .= '<option value="'.$array['id_bairro'].'" ';
				$combo .= ' title="'.$objImovel->codifiStringBancoInterface($objConexao, ucwords($array['str_bairro'])).'" >';
				$combo .= $objImovel->codifiStringBancoInterface($objConexao, ucwords($array['str_bairro'])).'</option>';
			}
			$combo .= '</select>';
		}else
		{
			$combo = '<select name="slc_bairro" id="slc_bairro" class="adm_formResCombo_01" style="width:125" title="Bairro" >';
			$combo .= '<option value="" title="selecione o Município">:: selecione Município ::</option>';
			$combo .= '</select>';
		}
		
		echo $combo;
	}
?>