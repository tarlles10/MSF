<?php header("Content-Type: text/html; charset=ISO-8859-1",true);
	$pagina 			= "";
	$str_acessoMinimo 	= "";

	include("config/config_Sistema.php");
	include("class/classImovel.php");
	
	$objImovel 	= new imovel($objConexao);
	if (isset($_POST["str_construtora"]) || !empty($_POST["str_construtora"]))
	{
		if ($_POST["str_construtora"] != '')
		{
			$combo = '<select name="slc_empreendimento" id="slc_empreendimento" class="adm_formResCombo_01" style="width:125">';
			$query = $objImovel->comboEmpreendimento($objConexao, $_POST["str_construtora"]);
			while($array = $objConexao->retornaArray($query))
			{
				$combo .= '<option value="'.$objImovel->codifiStringBancoInterface($objConexao, $array['str_empreendimento']).'" ';
				$combo .= ' title="'.$objImovel->codifiStringBancoInterface($objConexao, $array['str_empreendimento']).'" >';
				$combo .= $objImovel->codifiStringBancoInterface($objConexao, $array['str_empreendimento']).'</option>';
			}
			$combo .= '</select>';
		}else
		{
			$combo = '<select name="slc_empreendimento" id="slc_empreendimento" class="adm_formResCombo_01" style="width:125">';
			$combo .= '<option title="selecione a Construtora"  value="">:: selecione a Construtora ::</option>';
			$combo .= '</select>';
		}
		echo $combo;
	}
?>