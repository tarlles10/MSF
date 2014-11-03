<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");
	include("class/classRssFeed.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	$objRssFeed 		= new rssFeed($objConexao);
?>
<!--
===============================================================================================================================
Inicio tabela GRUPOS DE CONTEUDO
===============================================================================================================================
-->

<table width="579" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" class="grupoES_TOP"><span class="adm_fonteResTop_01">&nbsp;&nbsp;Mais Visitados</span></td>
    <td></td>
    <td rowspan="11" valign="top" align="left">
		<?php include ("componentes/componenteGrupoConteudo02.php");?>    
    </td>
    <td colspan="2" height="23"></td>
  </tr>
  <tr>
    <td class="grupoES_esq01"></td>
    <td valign="top" align="left" class="grupoES_fundo_01">
    <!-- inicio tabela Mais Visitados -->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
          <tr>
<?php //                #######################################################
	//                Atribui os valores do banco nas Variáveis dos Imoveis  
	//                #######################################################
	$objConfiguracao->atribuirGaleiraInicial($objConexao, 'QuantidadeVisita');
	$objConfiguracao->atribuirImovelInicial($objConexao);
	if ($objConfiguracao->getId_Imovel()!= "")
	{
		$linkMaisVisitados = "index.php?cod=mostrar&id_imovel=".$objConfiguracao->getId_Imovel()."&id_imagem=".$objConfiguracao->getId_ImagensImovel()."&cad=v";
	}else
	{
		$linkMaisVisitados = "index.php";
	}
?>
            <td width="122" height="106" rowspan="7" align="left" valign="top" background="<?php echo $objConfiguracao->getDirImovel().$objConfiguracao->getDirMiniImovel().$objConfiguracao->getDiretorioImagensImovel('Miniatura');?>"><img src="<?php echo $objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeGrupoEs();?>" width="122" height="106" style="cursor: pointer;" onClick="realizaSubmit('<?php echo $linkMaisVisitados;?>','');"></td>
            <td height="4"></td>
          </tr>
          <tr>
            <td align="left">&nbsp;<?php echo $objConfiguracao->getTipoNegocio()."&nbsp;".$objConfiguracao->getTipoImovel();?></td>
          </tr>
          <tr>
            <td align="left">&nbsp;Situação:&nbsp;&nbsp;<?php echo $objConfiguracao->getSituacaoImovel();?></td>
          </tr>
          <tr>
            <td align="left">&nbsp;Bairro:&nbsp;&nbsp;<?php echo $objConfiguracao->ocupacaoString($objConfiguracao->getBairro(), 15);?>            </td>
          </tr>
          <tr>
            <td align="left">&nbsp;<?php echo $objConfiguracao->getRetornoAreaUnidade(10, 13);?></td>
        </tr>
          <tr>
            <td align="left">&nbsp;Nº. de quartos:&nbsp;&nbsp;<?php echo $objConfiguracao->getQuarto();?></td>
          </tr>
          <tr>
            <td align="left">&nbsp;R$&nbsp;<?php echo $objConfiguracao->ocupacaoString( $objConfiguracao->getValorImovel(), 18, TRUE);?></td>
        </tr>
   	</table></td>
    <!-- Final tabela Mais Visitados -->
    <td class="grupoES_dir01"></td>
    <td></td>
    <td colspan="2" height="116"></td>
  </tr>
  <tr>
    <td class="grupoES_esq02"></td>
    <td valign="top" class="grupoES_fundo_02" style="height:35px;">
    	<div class="adm_fonteTextoGrupo_01">
			<?php echo $objConfiguracao->quebraTexto($objConfiguracao->getDescricaoImovel(), 44, 3);?>
		</div>
    </td>
    <td class="grupoES_dir02"></td>
    <td></td>
    <td colspan="2" height="25"></td>
  </tr>
  <tr>
    <td class="grupoES_esq03"></td>
    <td class="grupoES_fundo_02" style="height:5px;"></td>
    <td class="grupoES_dir03"></td>
    <td></td>
    <td colspan="2" height="5"></td>
  </tr>
  <tr>
    <td colspan="3" class="grupoES_botton"></td>
    <td></td>
    <td colspan="2" height="4"></td>
  </tr>
  <tr>
    <td colspan="3"></td>
    <td></td>
    <td colspan="2" height="6"></td>
  </tr>
  <tr>
    <td colspan="3" class="grupoEI_TOP"><span class="adm_fonteResTop_01">&nbsp;&nbsp;Destaque</span></td>
    <td></td>
    <td colspan="2" height="23"></td>
  </tr>
  <tr>
    <td class="grupoEI_esq01"></td>
    <td class="grupoEI_fundo_01" style="height:13px;"></td>
    <td class="grupoEI_dir01"></td>
    <td></td>
    <td colspan="2" height="13"></td>
  </tr>
  <tr>
    <td class="grupoEI_esq02"></td>
    <!-- inicio tabela grupo EI -->
    <td>
    <div id="noticiasFeedRss"></div>
    </td>
    <!-- fim tabela grupo EI -->
    <td class="grupoEI_dir02"></td>
    <td></td>
    <td colspan="2" height="109"></td>
  </tr>
  
  <tr>
    <td class="grupoEI_esq03"></td>
    <td class="grupoEI_fundo_01" style="height:12px;"></td>
    <td class="grupoEI_dir03"></td>
    <td></td>
    <td colspan="2" height="12"></td>
  </tr>
  <tr>
    <td colspan="3" class="grupoEI_botton"></td>
    <td></td>
    <td colspan="2" height="3"></td>
  </tr>
  <tr>
    <td width="4"></td>
    <td width="281"></td>
    <td width="4"></td>
    <td width="4"></td>
    <td width="284"></td>
    <td colspan="2"></td>
  </tr>
</table>
<!--
===============================================================================================================================
Final tabela GRUPOS DE CONTEUDO
===============================================================================================================================
-->
<script>
	carregar('noticiasFeedRss', 'ajaxComponente_FeedRss.php', 'Carregando Notícias...', true, 7);
</script>