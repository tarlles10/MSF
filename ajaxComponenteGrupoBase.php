<?php header("Content-Type: text/html; charset=ISO-8859-1",true);
	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
?>
<!--
===============================================================================================================================
Inicio Tabela Grupo Forum 587
===============================================================================================================================
-->
<table width="766" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="5"></td>
    <td width="173"></td>
    <td width="5"></td>
    <td width="188"></td>
    <td width="1"></td>
    <td width="194"></td>
    <td width="46"></td>
    <td width="137"></td>
    <td width="16"></td>
    <td width="1"></td>
  </tr>
  <tr>
	<td></td>
    <td></td>
    <td rowspan="7"></td>
    <td colspan="6"></td>
    <td height="5"></td>
  </tr>
  <tr>
    <td></td>
    <td align="center" valign="top"></td>
  	<!-- Inicio Tabela BannerBaixo -->
    <td colspan="6" rowspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="577" >
<?php $objConfiguracao->atribuirBanner($objConexao, 'Banner Baixo');
			echo $objConfiguracao->getDiretorioBanner();	
?>			
		</td>
        <td width="5"></td>
      </tr>
    </table></td>
    <!-- Final Tabela BannerBaixo -->
    <td colspan="2"></td>
  </tr>
  <tr>
   <td></td>
    <td rowspan="5" align="center" valign="top">
<!--
===================================================
	Inicio tabela Quadro Lateral
===================================================
-->    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
      	<td height="7"></td>
        <td colspan="3" class="grupoQUADROLATERAL_TOP"></td>
      </tr>
      <tr>
        <td height="269"></td>
        <td class="grupoQUADROLATERAL_esq"></td>
        <!-- Inicio Tabela Conteudo Quadro Lateral Esquerdo -->
		<td class="grupoQUADROLATERAL_fundo_01" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="grupoQUADROLATERAL_fundo_02" align="center" valign="top"><span class="adm_fonteResTop_04"> Nossos Produtos </span></td>
          </tr>
<?php if ($objConfiguracao->atribuirArrayArquivoInicial($objConexao))
			{
				for ($i = 8; $i >= 1; $i--)
				{
?>
              <tr>
                <td class="<?php echo $objConfiguracao->getArray_grupoQUADROLATERAL_fundo($i);?>" align="left"><img src="<?php echo $objConfiguracao->getDiretorioIcons().$objConfiguracao->getArray_str_iconeArquivosImovel($i);?>" width="16" height="16"><span class="adm_fonteTextoGrupo_01">&nbsp;<a href="<?php echo $objConfiguracao->getDirArqImovel().$objConfiguracao->getArray_str_diretorioArquivosImovel($i);?>#" title="<?php echo $objConfiguracao->getArray_str_arquivosImovel($i);?>"><?php echo $objConfiguracao->ocupacaoString($objConfiguracao->getArray_str_arquivosImovel($i), 25);?></a></span></td>
              </tr>
<?php }
			}else
			{
?>
				  <tr>
					<td class="grupoQUADROLATERAL_fundo_03">&nbsp;</td>
				  </tr>
				  <tr>
					<td class="grupoQUADROLATERAL_fundo_02"></td>
				  </tr>
				  <tr>
					<td class="grupoQUADROLATERAL_fundo_03"></td>
				  </tr>
				  <tr>
					<td class="grupoQUADROLATERAL_fundo_02"></td>
				  </tr>
				  <tr>
					<td class="grupoQUADROLATERAL_fundo_03"></td>
				  </tr>
				  <tr>
					<td class="grupoQUADROLATERAL_fundo_02"></td>
				  </tr>
				  <tr>
					<td class="grupoQUADROLATERAL_fundo_03"></td>
				  </tr>
				  <tr>
					<td class="grupoQUADROLATERAL_fundo_02"></td>
				  </tr>
				  <tr>
					<td class="grupoQUADROLATERAL_fundo_03"></td>
				  </tr>
<?php }
?>          
        </table></td>
        <!-- Fim Tabela Conteudo Quadro Lateral Esquerdo -->
        <td class="grupoQUADROLATERAL_dir"></td>
      </tr>
      <tr>
        <td height="6"></td>
        <td colspan="3" class="grupoQUADROLATERAL_botton"></td>
      </tr>
      <tr>
        <td></td>
        <td width="4"></td>
        <td width="165"></td>
        <td width="4"></td>
      </tr>
    </table>
<!--
===================================================
	Final tabela Quadro Lateral
===================================================
-->    
    </td>
  	<td height="115"></td>
  </tr>
  <tr>
  	<td></td>
    <td rowspan="2" class="grupoFORUM_TOP"><span class="adm_fonteResTop_01">&nbsp;&nbsp;F&oacute;rum</span></td>
    <td colspan="2" rowspan="2" class="grupoNEWSLETTER_TOP"><span class="adm_fonteResTop_01">&nbsp;&nbsp;Newsletter</span></td>
    <td colspan="3" class="grupoGALERIA_Top"></td>
    <td height="17"></td>
  </tr>
  <tr>
  	<td></td>
    <td rowspan="3" class="grupoGALERIA_esq"></td>
<?php //###################################################################
			//#       Atribui os valores do banco nas Variáveis dos Imoveis     #
			//###################################################################
			$objConfiguracao->atribuirGaleiraInicial($objConexao, 'GaleriaImagem');
			if ($objConfiguracao->getId_Imovel()!= "")
			{
				$linkGaleriaImagem = "index.php?cod=mostrar&id_imovel=".$objConfiguracao->getId_Imovel()."&id_imagem=".$objConfiguracao->getId_ImagensImovel()."&cad=v";
			}else
			{
				$linkGaleriaImagem = "index.php";
			}
?>
    <td rowspan="2" background="<?php echo $objConfiguracao->getDirImovel().$objConfiguracao->getDirMiniImovel().$objConfiguracao->getDiretorioImagensImovel('Miniatura');?>"><img src="<?php echo $objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeGaleria();?>" width="137" height="128" style="cursor: pointer;" onClick="realizaSubmit('<?php echo $linkGaleriaImagem;?>','');"/></td>
    <td rowspan="2" class="grupoGALERIA_dir"></td>
    <td height="18"></td>
  </tr>
  <tr>
  	<td></td>
    <td rowspan="2" class="grupoFORUM_fundo_01" valign="top">
        <table width="187" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td rowspan="2" width="3"></td>
            <td colspan="2" class="adm_fonteTextoGrupo_03" align="left" valign="top" style="font-size: 11px; text-align:left; vertical-align: top;"><span style="font-size: 12px; text-align:left; font-weight:bold; vertical-align: top;">Participe</span> do nosso f&oacute;rum, crie grupos de discussões e muito mais.</td>
          </tr>
          <tr>
            <td width="104"></td>
            <td width="80" class="adm_fonteTextoGrupo_03" valign="top" style="font-size: 11px; text-align: left; vertical-align: top;">Clique <a href="<?php echo $objConfiguracao->getLinkForum();?>" target="_blank" class="adm_fonteTextoGrupo_02">aqui</a> para acessar o f&oacute;rum.</td>
          </tr>
        </table>
	</td>
    <td rowspan="2" class="grupoBoton_barra"></td>
    <td rowspan="2" class="grupoNEWSLETTER_fundo_01" align="left" valign="top"><div id="formularioNewsLetter"></div></td>
    <td height="110"></td>
  </tr>
  <tr>
  	<td></td>
    <td colspan="2" class="grupoGALERIA_botton"></td>
    <td height="24"></td>
  </tr>
</table>
<?php include ("componentes/componenteBotton.php");
?> 
<!--
===============================================================================================================================
Final Tabela Grupo Forum
===============================================================================================================================
-->
<script>
	carregarPaginacao('formularioNewsLetter', 'ajaxComponente_NewsLetters.php', 'Carregando...', false); 
</script>