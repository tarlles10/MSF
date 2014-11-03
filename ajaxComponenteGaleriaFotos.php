<?php header("Content-Type: text/html; charset=ISO-8859-1",true);
	
	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");
	include("componentes/paginacao/componentePaginacaoGaleria.php");
	
	$objConfiguracao->InicializarConfiguracao($objConexao);
	
	$objCPaginacaoGaleria 	= new CPaginacaoGaleria();
	
	$queryPesquisa = $objCPaginacaoGaleria->consultaImovelPaginacaoGaleria($objConexao, $objConfiguracao->anti_injection($_POST["id_imovel"]));

	if($objConexao->contaLinhas($queryPesquisa) > 0)
	{
		$str_caminhoComponente 	= "componentes/paginacao/componentePaginacaoResultadoGaleria.php";
		$objCPaginacaoGaleria->mostraRegistroPaginadoComponenteTR($objConexao,$objConfiguracao,$queryPesquisa, $str_caminhoComponente);
	} 
	else 
	{
		echo	"<table width='577' border='0' cellpadding='0' cellspacing='0'>
					<tr>
						<td rowspan='7' style='background-image:url(".$objConfiguracao->getDirImovel()."/MsemFoto.jpg)' style='background-repeat: no-repeat;'>
							<table width='458' height='342' border='0' cellpadding='0' cellspacing='0'>
								<tr>
									<td width='8' class='top_grupoRes_top_01'></td>
									<td width='261' class='top_grupoRes_top_02' style='width:261px;'><span class='adm_fonteResTop_01'>Galeria de Imagens</span></td>
									<td width='31' class='top_grupoRes_top_03'></td>
									<td width='63' class='top_grupoRes_top_04'></td>
									<td width='95'><img src='".$objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeMostraGaleria_01()."' width='95' height='24'></td>
									<td height='24'></td>
								</tr>
								<tr>
								  <td colspan='5'><img src='".$objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeMostraGaleria_03()."' width='458' height='342'></td>
								  <td></td>
								  </tr>
								<tr>
								  <td width='8'></td>
								  <td width='261'></td>
								  <td width='31'></td>
								  <td width='63'></td>
								  <td width='95'></td>
								  <td></td>
							  </tr>
							</table>
						<!-- Fim Tabela Mostra Foto Grande -->
						</td>
						<td rowspan='7' width='8'></td>
						<td class='banner_molde_galeriaRes_02' background='".$objConfiguracao->getDirImovel().$objConfiguracao->getDirMiniImovel()."/semFoto.jpg'><img src='".$objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeMostraGaleria_02()."' width='111' height='89'></td>
						<td colspan='2' height='89'></td>
					</tr>
					<tr>
						<td height='3' colspan='2'></td>
						<td colspan='2' height='3'></td>
					</tr>
					<tr>
						<td class='banner_molde_galeriaRes_02' background='".$objConfiguracao->getDirImovel().$objConfiguracao->getDirMiniImovel()."/semFoto.jpg'><img src='".$objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeMostraGaleria_02()."' width='111' height='89'></td>
						<td colspan='2' height='89'></td>
					</tr>
					<tr>
						<td height='4'></td>
						<td height='4'></td>
						<td colspan='2' height='4'></td>
					</tr>
					<tr>
					  <td class='banner_molde_galeriaRes_02' background='".$objConfiguracao->getDirImovel().$objConfiguracao->getDirMiniImovel()."/semFoto.jpg'><img src='".$objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeMostraGaleria_02()."' width='111' height='89'></td>
						<td colspan='2' height='89'></td>
					</tr>
					<tr>
						<td height='4'></td>
						<td height='4'></td>
						<td colspan='2' height='4'></td>
					</tr>
					<tr>
					  <td background='".$objConfiguracao->getDirImovel().$objConfiguracao->getDirMiniImovel()."/semFoto.jpg' class='banner_molde_galeriaRes_02' ><img src='".$objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeMostraGaleria_02()."' width='111' height='89'></td>
						<td colspan='2' height='89'></td>
					</tr>
					<tr>
					  <td width='458'></td>
					  <td width='8'></td>
					  <td width='111'></td>
					  <td colspan='2'></td>
					</tr>
				</table>";
	} 
?>
<script>
	$disableBuscaSimples = false;//DÁ PERMISSÃO PARA A BUSCA SER EXECUTADA NOVAMENTE JÁ QUE NÃO EXISTE MAIS CARREGAMENTOS AJAX OCUPADOS NO MOMENTO.
</script>