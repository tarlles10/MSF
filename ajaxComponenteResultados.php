<?php ini_set('max_execution_time', "60");	
	header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");
	include("componentes/paginacao/componentePaginacao.php");
	include("class/classImovel.php");

	$objConfiguracao->InicializarConfiguracao($objConexao);
	$objImovel 			= new imovel($objConexao);
	$objCPaginacao 		= new CPaginacao();

	$int_registroPagina = $_POST["slc_totalRegistrosTela"]==''?5:$_POST["slc_totalRegistrosTela"];
	$int_pagina 		= $_POST["int_paginacao"]==''?1:$_POST["int_paginacao"];
	$auxSql 			= ' LIMIT '.$int_registroPagina.' OFFSET '.intval(($int_pagina-1) * $int_registroPagina);

	if (isset($_POST["slc_ordenacao"]) || !empty($_POST["slc_ordenacao"]))
	{
		$str_ordenacao = $objConfiguracao->retornoOrdenacaoResultados($objConfiguracao->anti_injection($_POST["slc_ordenacao"]));
	}

	if (isset($_POST["str_acao"]) || !empty($_POST["str_acao"]))
	{
		if ($_POST["str_acao"] == 'BuscaSimples')
		{
			$sql = $objImovel->consultaBuscaFacil($objConexao, $objSessao, $str_ordenacao);
		}else if ($_POST["str_acao"] == 'BuscaAvancada')
		{
			$sql = $objImovel->consultaBuscaAvancada($objConexao, $objSessao, $str_ordenacao);
		}
	}else if ($_SESSION["SQL_CONSULTA"]!='')
	{
		$sql = $_SESSION["SQL_CONSULTA"].$str_ordenacao;
	}

	$sql = str_replace(array("''","**"),"null",$sql);
	$sql = str_replace("*","",$sql);

	$queryPesquisa['query'] = $objConexao->executaSQL($sql.$auxSql);
	$queryPesquisa['numRegistro'] = $objConexao->retornoSelect('SELECT count(*) as totalregistro '.substr(str_replace($str_ordenacao,'',$sql), 876));

	if($queryPesquisa['numRegistro'] > 0)
	{
		$str_caminhoComponente 	= "componentes/paginacao/componentePaginacaoResultado.php";
		$objCPaginacao->mostraRegistroPaginadoComponenteTR($objConexao,$objConfiguracao,$queryPesquisa,$str_caminhoComponente);
	} 
	else 
	{
		$html = '<table width="766" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width=="7"></td>
						<td colspan="11" height="5"></td>
						<td height="5"></td>
					</tr>
					<tr>
						<td></td>
						<td colspan="2" class="top_grupoRes_top_01"></td>
						<td colspan="2" class="top_grupoRes_top_02"><span class="adm_fonteResTop_01">Resultado da Busca</span></td>
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
						<td colspan="6" class="top_grupoRes_top_09"></td>
						<td height="11"></td>
					</tr>
					<tr>
						<td></td>
						<td class="med_grupoRes_E"></td>
						<td colspan="2"></td>
						<td colspan="7" width="627" height="100" class="adm_fonteFormGrupo_01" align="right">Nenhum Imóvel encontrado.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		</td>
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
					</tr>';
	}
	echo $html.'</table>';
	include ("componentes/componenteBotton2.php");
?>