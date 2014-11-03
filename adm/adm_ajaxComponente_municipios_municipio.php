<?php header("Content-Type: text/html; charset=ISO-8859-1",true);
	$pagina 			= "AcessDenied";
	$str_acessoMinimo 	= "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classMunicipios.php");
	
	$objMunicipios 	= new municipios($objConexao);
	
	if (isset($_POST["id_municipio"]) || !empty($_POST["id_municipio"]))
	{
		if ($_POST["id_municipio"] != '')
		{
			$combo = '<select name="slc_bairro" id="*" class="adm_formResCombo_01" style="width:125" title="Bairro" onchange="enviaValorBairro(this, \'adm_ajaxComponente_municipios_bairro.php\');"><option value="">:: selecione ::</option>';
			$query = $objMunicipios->comboBairro($objConexao, $_POST["id_municipio"]);
			while($array = $objConexao->retornaArray($query))
			{
				$combo .= '<option value="'.$array['id_bairro'].'" ';
				$combo .= ' title="'.$objMunicipios->codifiStringBancoInterface($objConexao, ucwords($array['str_bairro'])).'" >';
				$combo .= $objMunicipios->codifiStringBancoInterface($objConexao, ucwords($array['str_bairro'])).'</option>';
			}
			$combo .= '</select>';
		}else
		{
			$combo = '<select name="slc_bairro" id="*" class="adm_formResCombo_01" style="width:125" title="Bairro" onchange="enviaValorBairro(this, \'adm_ajaxComponente_municipios_bairro.php\');">';
			$combo .= '<option value="" title="selecione o Município">:: selecione Município ::</option>';
			$combo .= '</select>';
		}
		
		echo $combo;
	}
?>
<script>
	enviaValorBairro(document.frm.slc_bairro, 'adm_ajaxComponente_municipios_bairro.php');
</script>