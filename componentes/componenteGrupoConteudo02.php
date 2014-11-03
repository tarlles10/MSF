<!--
===============================================================================================================================
Inicio tabela GRUPOS DE CONTEUDO
===============================================================================================================================
-->
<table width="284" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" class="grupoDS_TOP"><span class="adm_fonteResTop_01">&nbsp;&nbsp;Simulador Habita&ccedil;&atilde;o </span></td>
    <td colspan="2" height="23"></td>
  </tr>
  <tr>
    <!-- inicio tabela Mais Visitados -->
    <!-- Final tabela Mais Visitados -->
    <td class="grupoDS_esq01"></td>
    <td rowspan="2" class="grupoDS_fundo_01" valign="top" align="left">
    <!-- inicio tabela Calendario -->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
          <tr>
            <td rowspan="3" align="left" valign="top" class="grupoDS_fundo_02"></td>
            <td height="15"></td>
          </tr>
          <tr>
            <td valign="top" align="left" class="adm_fonteTextoGrupo_03">Fa&ccedil;a <a href="#" onclick="GB_showCenter('Simulador', 'http://www8.caixa.gov.br/siopiinternet/simulaOperacaoInternet.do?method=inicializarCasoUso');" class="adm_fonteTextoGrupo_02">aqui</a> uma simula&ccedil;&atilde;o de valores.</td>
          </tr>
   	</table></td>
    <!-- Final tabela Calendario 163-->    
    <td class="grupoDS_dir01"></td>
    <td colspan="2" height="168"></td>
  </tr>
  
  <tr>
    <td class="grupoDS_esq02"></td>
    <td class="grupoDS_dir02"></td>
    <td colspan="2" height="5"></td>
  </tr>
  <tr>
    <td colspan="3" class="grupoDS_botton"></td>
    <td colspan="2" height="3"></td>
  </tr>
  <tr>
    <td colspan="3"></td>
    <td colspan="2" height="7"></td>
  </tr>
  <tr>
    <td colspan="3" class="grupoDI_TOP"><span class="adm_fonteResTop_01">&nbsp;&nbsp;Promocionais</span></td>
    <td colspan="2" height="23"></td>
  </tr>
  <tr>
    <td rowspan="2" class="grupoDI_esq01"></td>
    <td rowspan="2" class="grupoDI_fundo_01" valign="top" align="left">
    <!-- inicio tabela Promocionais -->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
          <tr>
<?php //                #######################################################
	//                Atribui os valores do banco nas Variáveis dos Imoveis  
	//                #######################################################
	$objConfiguracao->atribuirGaleiraInicial($objConexao, 'Promocional');
	$objConfiguracao->atribuirImovelInicial($objConexao);
	if ($objConfiguracao->getId_Imovel()!= "")
	{
		$linkPromocionais = "index.php?cod=mostrar&id_imovel=".$objConfiguracao->getId_Imovel()."&id_imagem=".$objConfiguracao->getId_ImagensImovel()."&cad=v";
	}else
	{
		$linkPromocionais = "index.php";
	}
?>

            <td width="122" height="106" rowspan="7" align="left" valign="top" background="<?php echo $objConfiguracao->getDirImovel().$objConfiguracao->getDirMiniImovel().$objConfiguracao->getDiretorioImagensImovel('Miniatura');?>"><img src="<?php echo $objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeGrupoDi();?>" width="122" height="106" style="cursor: pointer;" onClick="realizaSubmit('<?php echo $linkPromocionais;?>','');"></td>
            <td height="4"></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="2" align="left">&nbsp;<?php echo $objConfiguracao->getTipoNegocio()."&nbsp;".$objConfiguracao->getTipoImovel();?></td>
          </tr>
          <tr>
            <td colspan="2" align="left">&nbsp;Situa&ccedil;&atilde;o:&nbsp;&nbsp;<?php echo $objConfiguracao->getSituacaoImovel();?></td>
          </tr>
          <tr>
            <td colspan="2" align="left">&nbsp;Bairro:&nbsp;&nbsp;<?php echo $objConfiguracao->ocupacaoString($objConfiguracao->getBairro(), 15);?>            </td>
          </tr>
          <tr>
            <td colspan="2" align="left">&nbsp;<?php echo $objConfiguracao->getRetornoAreaUnidade(10, 13);?></td>
          </tr>
          <tr>
            <td colspan="2" align="left">&nbsp;R$&nbsp;<?php echo $objConfiguracao->ocupacaoString( $objConfiguracao->getValorImovel(), 18, TRUE);?></td>
        </tr>
    	</table></td>
    <!-- Final tabela Promocionais -->
    <td rowspan="2" class="grupoDI_dir01"></td>
    <td colspan="2" height="13"></td>
  </tr>
  <tr>
    <!-- inicio tabela grupo EI -->
    <!-- fim tabela grupo EI -->
    <td colspan="2" height="86"></td>
  </tr>
  <tr>
    <td class="grupoDI_esq02"></td>
    <td rowspan="2" class="grupoDI_fundo_02">
    	<div class="adm_fonteTextoGrupo_01">
			<?php echo $objConfiguracao->quebraTexto($objConfiguracao->getDescricaoImovel(), 42, 2);?>
		</div>    </td>
    <td class="grupoDI_dir02"></td>
    <td colspan="2" height="23"></td>
  </tr>
  <tr>
    <td class="grupoDI_esq03"></td>
    <td class="grupoDI_dir03"></td>
    <td colspan="2" height="12"></td>
  </tr>
  <tr>
    <td colspan="3" class="grupoDI_botton"></td>
    <td colspan="2" height="3"></td>
  </tr>
  <tr>
    <td width="4"></td>
    <td width="274"></td>
    <td width="4"></td>
    <td colspan="2"></td>
  </tr>
</table>
<!--
===============================================================================================================================
Final tabela GRUPOS DE CONTEUDO
===============================================================================================================================
-->