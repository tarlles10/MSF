<?php header("Content-Type: text/html; charset=ISO-8859-1",true);
	$pagina 			= "AcessDenied";
	$str_acessoMinimo 	= "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classBanner.php");
	
	$objBanner 	= new banner($objConexao);
	
	if (isset($_POST["slc_localBanner"]) || !empty($_POST["slc_localBanner"]))
	{
		if ($_POST["slc_localBanner"] != '')
		{
			if ($_POST["comboFlash"] == 'TRUE' || $_POST["comboMolde"] == 'FALSE')
			{
				$styleCombo = 'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"';
				$combo  	= '<select name="slc_id_moldes" id="slc_id_moldes" class="adm_formResCombo_01" '.$styleCombo.' >';
			}else
			{
				$styleCombo = 'style="width: 125px; filter: Alpha(Opacity=100);"';
			}
			
		}else
		{
			$combo  = '<select name="slc_id_moldes" id="slc_id_moldes" class="adm_formResCombo_01" '.$styleCombo.' ><option value="">:: selecione ::</option>';
		}
		$query = $objBanner->comboMoldes($objConexao, $_POST["slc_localBanner"]);

		$cont = 0;
		while($array = $objConexao->retornaArray($query))
		{
			$cont++;
			if($cont==1)
			{
				$combo  = '<select name="slc_id_moldes" id="slc_id_moldes" class="adm_formResCombo_01" '.$styleCombo.' >';
			}
			
			$selecao = $_POST["slc_localBanner"] == $array['str_tipomolde']?'selected':'';
			$combo .= '<option value="'.$array['id_moldes'].'" '.$selecao;
			$combo .= ' title="'.$objBanner->codifiStringBancoInterface($objConexao, $array['str_nomemolde']).'" >';
			$combo .= $objBanner->codifiStringBancoInterface($objConexao, $array['str_nomemolde']).'</option>';
		}
		$combo .= '</select>';
		echo $combo;
	}
?>