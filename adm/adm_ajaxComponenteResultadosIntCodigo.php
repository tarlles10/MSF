<?php header("Content-Type: text/html; charset=ISO-8859-1",true);
	
	$pagina = "";
	$str_acessoMinimo = "";

	include("../config/config_Sistema.php");
	include("componentes/paginacao/componentePaginacao.php");	
	$objConfiguracao->InicializarConfiguracao($objConexao);
	$objCPaginacao 		= new CPaginacao();
	
	if (isset($_POST["slc_ordenacao"]) || !empty($_POST["slc_ordenacao"]))
	{
		$str_ordenacao = $objConfiguracao->retornoOrdenacaoResultadosAdministrativo($objConfiguracao->anti_injection($_POST["slc_ordenacao"]));
	}

	$objConfiguracao->atribuirQueryComponenteResultados($objConfiguracao->anti_injection($_POST["nomePagina"]), $str_ordenacao, $_POST["int_cod"]);
	$sql = $objConfiguracao->montaQuerys($objConfiguracao->arrayCampos, $objConfiguracao->str_queryTabelas);
	
	$queryPesquisa = $objConexao->executaSQL($sql);

	if($objConexao->contaLinhas($queryPesquisa) > 0)
	{
		$str_caminhoComponente 	= "componentes/paginacao/componentePaginacaoResultado.php";
		$objCPaginacao->mostraRegistroPaginadoComponenteTR($objConexao,$objConfiguracao,$queryPesquisa, $str_caminhoComponente, $_POST["int_cod"]);
	} 
	else 
	{
?>
<table width="766" border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td width=="7"></td>
		<td colspan="11" height="5"></td>
		<td height="5"></td>
	</tr>
	<tr>
    	<td></td>
		<td colspan="2" class="top_grupoRes_top_01"></td>
		<td colspan="2" class="top_grupoRes_top_02"><span class="adm_fonteResTop_01">Resultados</span></td>
		<td class="top_grupoRes_top_03"></td>
		<td class="top_grupoRes_top_04" style="width:196px;"></td>
		<td width="22" class="top_grupoRes_top_05"></td>
		<td colspan="2" rowspan="2" class="top_grupoRes_top_06" style="width: 281px;"></td>
		<td colspan="2" rowspan="2" class="top_grupoRes_top_07"></td>
		<td height="24"></td>
	</tr>
	<tr>
		<td></td>
        <td class="top_grupoRes_top_08"></td>
		<td colspan="6" class="adm_top_grupoRes_top_09"></td>
		<td height="11"></td>
	</tr>
	<tr>
		<td></td>
        <td class="med_grupoRes_E"></td>
		<td colspan="2"></td>
		<td colspan="7" width="627" height="100" class="adm_fonteFormGrupo_01" align="right">Nenhum Registro Encontrado.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td class="med_grupoRes_D"></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
        <td colspan="2" class="boton_grupoRes_E"></td>
		<td colspan="7" class="boton_grupoRes_M" style="width: 739px;"></td>
		<td colspan="2" class="boton_grupoRes_D"></td>
		<td height="15"></td>
	</tr>
	<tr>
		<td></td>
        <td width="3"></td>
		<td width="5"></td>
		<td width="117"></td>
		<td width="92"></td>
		<td width="31"></td>
		<td width="195"></td>
		<td colspan="2" width="23"></td>
		<td width="281"></td>
		<td width="5"></td>
		<td width="3"></td>
		<td width="5"></td>
	</tr>
<?php } 
?>
</table>
<!--
===============================================================================================================================
Final Tabela Resultados
===============================================================================================================================
-->