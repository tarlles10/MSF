<?php function cPaginacaoResultado($objConexao, $objConfiguracao, $query, $cont)
	{
		$objConfiguracao->atribuirImovelInicial($objConexao, $objConexao->retornaResultado($query,$cont-1,"id_imovel"));
		$objConfiguracao->atribuirGaleira($objConexao, $objConexao->retornaResultado($query,$cont-1,"id_imovel"), TRUE);
		if ($objConfiguracao->getDt_entrega() == "")
		{
			$dataEntrega = "Entrega&nbsp;&nbsp;".$objConfiguracao->retornaDataAtual('Numerico', 'Interface');
		}else
		{
			$dataEntrega = "Entrega&nbsp;&nbsp;".$objConfiguracao->retornaDataNumerica($objConfiguracao->getDt_entrega(), 'DATA_COMPLETA');
		}
		$objConfiguracao->contadorInicial++;
		
		$link = "index.php?cod=mostrar&resultado=true&id_imovel=".$objConexao->retornaResultado($query,$cont-1,"id_imovel")."&id_imagem=".$objConfiguracao->getId_ImagensImovel()."&cad=b";
?>
	<tr>
		<td>&nbsp;&nbsp;<input name="int_paginacao" type="hidden" value=""></td>
        <td class="med_grupoRes_E"></td>
		<td colspan="2" background="<?php echo $objConfiguracao->getDirImovel().$objConfiguracao->getDirMiniImovel().$objConfiguracao->getDiretorioImagensImovel('Miniatura');?>"><img src="<?php echo $objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeResultado();?>" width="122" height="106" style="cursor: pointer;" onClick="realizaSubmit('<?php echo $link;?>','');" /></td>
		<td colspan="7" background="<?php echo $objConfiguracao->getDirTheme();?>/med_grupoRes_fundo.gif" width="627" height="106" valign="top">
        <!-- Inicio Tabela Dados dos Resultados da Busca -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" >
              <tr>
                <td height="28" width="28" valign="middle" align="center"><img src="adm/icons/imovelP.png" width="16" height="16"></td>
                <td colspan="6" class="adm_fonteResTop_04">R$ <?php echo $objConfiguracao->getValorImovel();?></td>
              </tr>
              <tr>
                <td colspan="7" height="13"></td>
              </tr>
              <tr class="adm_fonteFormGrupo_01">
                <td colspan="2"></td>
                <td width="496"><span class="adm_fonteTextoGrupo_01"><a href="#" onClick="realizaSubmit('<?php echo $link;?>','');" ><?php echo $objConfiguracao->getTipoNegocio();?></a></span></td>
                <td width="52"></td>
                <td width="233"><span class="adm_fonteTextoGrupo_01"><a href="#" onClick="realizaSubmit('<?php echo $link;?>','');" ><?php echo $objConfiguracao->getRetornoAreaUnidade(10, 13);?></a></span></td>
                <td width="252"></td>
                <td width="128"><span class="adm_fonteTextoGrupo_01"><a href="#" onClick="realizaSubmit('<?php echo $link;?>','');"><?php echo $objConfiguracao->getSituacaoImovel();?></a></span></td>
              </tr>
              <tr>
                <td colspan="7" height="8"></td>
              </tr>
              <tr class="adm_fonteFormGrupo_01">
                <td colspan="2"></td>
                <td><span class="adm_fonteTextoGrupo_01"><a href="#" onClick="realizaSubmit('<?php echo $link;?>','');"><?php echo $objConfiguracao->getTipoImovel();?></a></span></td>
                <td></td>
                <td><span class="adm_fonteTextoGrupo_01"><a href="#" onClick="realizaSubmit('<?php echo $link;?>','');">Nº. de quartos&nbsp;&nbsp;<?php echo $objConfiguracao->getQuarto();?></a></span></td>
                <td></td>
                <td><span class="adm_fonteTextoGrupo_01"><a href="#" onClick="realizaSubmit('<?php echo $link;?>','');">Nº. de banheiros&nbsp;&nbsp;<?php echo $objConfiguracao->getBanheiro();?></a></span></td>
              </tr>
              <tr>
                <td colspan="7" height="8"></td>
              </tr>
              <tr class="adm_fonteFormGrupo_01">
                <td colspan="2"></td>
                <td><span class="adm_fonteTextoGrupo_01"><a href="#" onClick="realizaSubmit('<?php echo $link;?>','');"><?php echo $objConfiguracao->getBairro();?></a></span></td>
                <td></td>
                <td><span class="adm_fonteTextoGrupo_01"><a href="#" onClick="realizaSubmit('<?php echo $link;?>','');">IPTU&nbsp;&nbsp;<?php echo $objConfiguracao->getValorIptu();?></a></span></td>
                <td></td>
                <td><span class="adm_fonteTextoGrupo_01"><a href="#" onClick="realizaSubmit('<?php echo $link;?>','');"><?php echo $dataEntrega;?></a></span></td>
              </tr>
              <tr>
                <td colspan="7" height="8"></td>
              </tr>
            </table>
        <!-- Fim Tabela Dados dos Resultados da Busca -->
        </td>
		<td class="med_grupoRes_D"></td>
		<td></td>
	</tr>
<?php }
?>