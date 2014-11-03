<?php header("Content-Type: text/html; charset=ISO-8859-1",true);
	$pagina 			= "AcessDenied";
	$str_acessoMinimo 	= "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classImovel.php");
	
	$objImovel 	= new imovel($objConexao);
	
	if (isset($_POST["id_proprietario"]) || !empty($_POST["id_proprietario"]))
	{
		if ($_POST["id_proprietario"] != '')
		{
			$combo = '<select name="slc_proprietario" id="slc_proprietario" class="adm_formResCombo_01" style="width:125" title="Proprietário">';
			$query = $objImovel->comboProprietario($objConexao, $_POST["id_proprietario"]);
			while($array = $objConexao->retornaArray($query))
			{
				$combo .= '<option value="'.$objImovel->codifiStringBancoInterface($objConexao, $array['id_proprietario']).'" ';
				$combo .= ' title="'.$objImovel->codifiStringBancoInterface($objConexao, $array['str_nomeproprietario']).'" >';
				$combo .= $objImovel->codifiStringBancoInterface($objConexao, $array['str_nomeproprietario']).'</option>';
			}
			$combo .= '</select>';
			
		}else
		{
			$combo  = '<select name="slc_proprietario" id="slc_proprietario" class="adm_formResCombo_01" style="width:125" title="Proprietário">';
			$combo .= '<option value="">:: selecione ::</option>';
			$combo .= '</select>';		
		}
		echo $combo;
	}
?>
