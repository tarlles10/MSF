<?php 
	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");
	include("class/classBanner.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	$objBanner 	= new banner($objConexao);
	$objBanner->atribuirInformeBanner($objConexao, $_GET["cod"]);

?>
<input name="tamanhoTexto" type="hidden" value="10"/>
<table width="579" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="top_grupoMostraConteudo_mascoteBanner">
<!--
===============================================================================================================================
Inicio Tabela Resultados
===============================================================================================================================
-->
<table width="579" border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td width=="7"></td>
		<td colspan="10" height="5"></td>
		<td height="5"></td>
	</tr>
	<tr>
    	<td></td>
		<td colspan="2" class="top_grupoRes_top_01"></td>
		<td class="top_grupoRes_top_02" style="width: 286px;"><span class="adm_fonteResTop_01" style="font-size:16px;"><?php echo $objBanner->getTituloBanner();?></span></td>
		<td class="top_grupoRes_top_03"></td>
		<td class="top_grupoRes_top_04" style="vertical-align: bottom;" align="left">
        	<img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/zoom_maior.png" width="13" height="15" onclick="incrementaFonte('descricaoTexto');" alt="Aumentar tamanho da letra" style="cursor: pointer;">&nbsp;&nbsp;
            <img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/zoom_menor.png" width="13" height="15" onclick="decrementaFonte('descricaoTexto');" alt="Diminuir tamanho da letra" style="cursor: pointer;">
        </td>
	  <td width="23" class="top_grupoRes_top_05"></td>
		<td colspan="2" rowspan="2"></td>
		<td colspan="2" rowspan="2" class="top_grupoRes_top_07"></td>
		<td height="24"></td>
	</tr>
	<tr>
		<td></td>
        <td class="top_grupoRes_top_08"></td>
		<td colspan="5" class="top_grupoRes_top_09"></td>
		<td height="11"></td>
	</tr>
	<tr>
		<td></td>
        <td class="med_grupoRes_E"></td>
		<td colspan="8"></td>
		<td class="med_grupoRes_D"></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
        <td class="med_grupoRes_E"></td>
		<td colspan="8" width="595" height="688" valign="top" align="left">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="3" height="5"></td>
              </tr>
              <tr>
              	<td width="15"></td>
                <td width="457" height="70" align="left" valign="top">
                	<span class="adm_fonteFormGrupo_01" style="color: #999999;"><?php echo "Atualizado em ".$objBanner->getDt_inicialBanner();?></span>
                    <div class="adm_fonteResTop_04"><?php echo $objBanner->getChamadaBanner();?></div>
                </td>
                <td width="170"></td>
              </tr>
              <tr>
              	<td height="6"></td>
                <td></td>
              </tr>
              <tr>
              	<td></td>
                <td colspan="2" align="left" valign="top" class="adm_fonteTextoGrupo_01" id="descricaoTexto"><?php echo $objBanner->getConteudoBanner();?></td>
              </tr>
              <tr>
              	<td></td>
                <td colspan="2" align="center" valign="top" class="adm_fonteResTop_04"></td>
              </tr>
            </table>
        </td>
		<td class="med_grupoRes_D"></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
        <td colspan="2" class="boton_grupoRes_E"></td>
		<td colspan="6" class="boton_grupoRes_M"></td>
		<td colspan="2" class="boton_grupoRes_D"></td>
		<td height="15"></td>
	</tr>
	<tr>
		<td></td>
        <td width="3"></td>
		<td width="5"></td>
		<td width="266"></td>
		<td width="31"></td>
		<td width="45"></td>
		<td colspan="2" width="24"></td>
		<td width="187"></td>
		<td width="5"></td>
		<td width="3"></td>
		<td width="5"></td>
	</tr>
</table>
<!--
===============================================================================================================================
Final Tabela Resultados
===============================================================================================================================
-->
    </td>
  </tr>
</table>
