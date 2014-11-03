<?php header("Content-Type: text/html; charset=ISO-8859-1",true);
	$pagina 			= "AcessDenied";
	$str_acessoMinimo 	= "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classImovel.php");
	
	$objImovel 	= new imovel($objConexao);
	
	if (isset($_POST["str_tipoImovel"]) || !empty($_POST["str_tipoImovel"]))
	{
		if ($_POST["str_tipoImovel"] != '')
		{
			$combo = '<select name="slc_subTipoImovel" id="slc_subTipoImovel" class="adm_formResCombo_01" style="width:139">';
			$query = $objImovel->comboSubTipoImovel($objConexao, $_POST["str_tipoImovel"]);
			while($array = $objConexao->retornaArray($query))
			{
				$combo .= '<option value="'.$objImovel->codifiStringBancoInterface($objConexao, $array['str_subtipoimovel']).'" ';
				$combo .= ' title="'.$objImovel->codifiStringBancoInterface($objConexao, $array['str_subtipoimovel']).'" >';
				$combo .= $objImovel->codifiStringBancoInterface($objConexao, $array['str_subtipoimovel']).'</option>';
			}
			$combo .= '</select>';
		}else
		{
			$combo = '<select name="slc_subTipoImovel" id="slc_subTipoImovel" class="adm_formResCombo_01" style="width:139">';
			$combo .= '<option title="selecione Tipo de Imóvel" value="">:: selecione Tipo de Imóvel ::</option>';
			$combo .= '</select>';
		}
		echo $combo;
	}
?>