<?php header("Content-Type: text/html; charset=ISO-8859-1",true);
	$pagina 			= "AcessDenied";
	$str_acessoMinimo 	= "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classContratos.php");
	
	$objContratos 	= new contratos($objConexao);

	if (isset($_POST["id_bairro"]) || !empty($_POST["id_bairro"]))
	{
		if ($_POST["id_bairro"] != '')
		{
			$query = $objContratos->comboLogradouro($objConexao, $_POST["id_bairro"]);
			$cont = 0;
			while($array = $objConexao->retornaArray($query))
			{
				$cont++;
				if($cont==1)
				{
					$combo  = '<select name="slc_descricaoLogradouro" id="*" class="adm_formResCombo_01" style="width:125" title=\'Logradouro\' >';
					$combo .= '<option value=\'\'>:: selecione ::</option>';
				}
				$combo .= '<option value="'.$array['id_numerocep'].'" ';
				$combo .= ' title="'.$objContratos->codifiStringBancoInterface($objConexao, ucwords($array['str_descricaologradouro'])).'" >';
				$combo .= $objContratos->codifiStringBancoInterface($objConexao, ucwords($array['str_descricaologradouro'])).'</option>';
			}
		}else
		{
			$combo  = '<select name="slc_descricaoLogradouro" id="*" class="adm_formResCombo_01" style="width:125" title=\'Logradouro\' >';
			$combo .= '<option value=\'\'>:: selecione Bairro::</option>';
		}

		$combo .= '</select>';
		echo $combo;
	}
?>
