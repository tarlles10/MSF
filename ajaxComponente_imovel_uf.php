<?php header("Content-Type: text/html; charset=ISO-8859-1",true);
	$pagina 			= "";
	$str_acessoMinimo 	= "";

	include("config/config_Sistema.php");
	include("class/classImovel.php");
	
	$objImovel 	= new imovel($objConexao);
	if (isset($_POST["str_uf"]) || !empty($_POST["str_uf"]))
	{
		if ($_POST["str_uf"] != '')
		{
			$query = $objImovel->comboMunicipio($objConexao, $_POST["str_uf"]);
			$cont = 0;
			while($array = $objConexao->retornaArray($query))
			{
				$cont++;
				if($cont==1)
				{
					$combo  = '<select name="slc_municipios" id="slc_municipios" class="adm_formResCombo_01" style="width:125" title=\'Município\' ';
					$combo .= 'onchange="enviaValorMunicipio(this, \'ajaxComponente_imovel_municipio.php\', \''.$objConfiguracao->getDirTheme().'\');"><option value=\'\'>:: selecione ::</option>';
				}
				$combo .= '<option value="'.$array['id_municipio'].'" ';
				$combo .= ' title="'.$objImovel->codifiStringBancoInterface($objConexao, ucwords($array['str_municipios'])).'" >';
				$combo .= $objImovel->codifiStringBancoInterface($objConexao, ucwords($array['str_municipios'])).'</option>';
			}
		}else
		{
			$combo  = '<select name="slc_municipios" id="*" class="adm_formResCombo_01" style="width:125" title=\'Município\' ';
			$combo .= 'onchange="enviaValorMunicipio(this, \'ajaxComponente_imovel_municipio.php\', \''.$objConfiguracao->getDirTheme().'\');"><option value=\'\' title="selecione UF">:: selecione UF ::</option>';
		}

		$combo .= '</select>';
		echo $combo;
	}
?>
<script>
	enviaValorMunicipio(document.frm.slc_municipios, 'ajaxComponente_imovel_municipio.php');
</script>