<?php header("Content-Type: text/html; charset=ISO-8859-1",true);
	$pagina 			= "AcessDenied";
	$str_acessoMinimo 	= "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classProprietario.php");
	
	$objProprietario 	= new proprietario($objConexao);
	if (isset($_POST["str_uf"]) || !empty($_POST["str_uf"]))
	{
		if ($_POST["str_uf"] != '')
		{
			$query = $objProprietario->comboMunicipio($objConexao, $_POST["str_uf"]);
			$cont = 0;
			while($array = $objConexao->retornaArray($query))
			{
				$cont++;
				if($cont==1)
				{
					$combo  = '<select name="slc_municipios" id="*" class="adm_formResCombo_01" style="width:125" title=\'Município\' ';
					$combo .= 'onchange="enviaValorMunicipio(this, \'adm_ajaxComponente_proprietario_municipio.php\');"><option value=\'\'>:: selecione ::</option>';
				}
				$combo .= '<option value="'.$array['id_municipio'].'" ';
				$combo .= ' title="'.$objProprietario->codifiStringBancoInterface($objConexao, ucwords($array['str_municipios'])).'" >';
				$combo .= $objProprietario->codifiStringBancoInterface($objConexao, ucwords($array['str_municipios'])).'</option>';
			}
		}else
		{
			$combo  = '<select name="slc_municipios" id="*" class="adm_formResCombo_01" style="width:125" title=\'Município\' ';
			$combo .= 'onchange="enviaValorMunicipio(this, \'adm_ajaxComponente_proprietario_municipio.php\');"><option value=\'\' title="selecione UF">:: selecione UF ::</option>';
		}

		$combo .= '</select>';
		echo $combo;
	}
?>
<script>
	enviaValorMunicipio(document.frm.slc_municipios, 'adm_ajaxComponente_proprietario_municipio.php');
</script>