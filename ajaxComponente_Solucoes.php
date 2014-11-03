<?php header("Content-Type: text/html; charset=ISO-8859-1",true);
	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");
	include("class/classFaleConosco.php");
	$objFaleConosco		= new faleConosco($objConexao);

	if ((isset($_POST["enviar"]) || !empty($_POST["enviar"])) && $_POST["enviar"]==TRUE)
	{
		$objFaleConosco->enviarFaleConosco($objConexao, $objConfiguracao, TRUE);
	}

?>
<table width="579" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="top_grupoMostraConteudo_mascoteLogo">
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
		<td class="top_grupoRes_top_02" style="width: 286px;"><span class="adm_fonteResTop_01">Soluções&nbsp;<span style="color: #ff7707;">ParkImovel</span></span></td>
		<td class="top_grupoRes_top_03"></td>
		<td class="top_grupoRes_top_04" style="vertical-align: bottom;" align="left"></td>
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
                <td colspan="4" height="5"></td>
              </tr>
              <tr>
              	<td width="15"></td>
                <td height="70" colspan="2" align="left" valign="top"><div class="adm_fonteResTop_04" style="font-size:11px;">Imobiliárias e Corretores de Imóveis tenham seu próprio portal na Internet com o <span style="font-weight:bold">MetaSoftware da ParkImovel</span>.</div></td>
                <td width="348"></td>
              </tr>
              <tr>
              	<td></td>
                <td colspan="3" height="15"><span class="adm_fonteResTop_04" style="font-size:12px;">Contratando a ParkImovel, você terá a sua disposição este portal  personalizado para sua imobili&aacute;ria, um Sistema Online de Gerenciamento de Imóveis com portal Imobiliário integrado, adequado para Imobiliárias e Corretores de Imóveis.
Com o ParkImovel, você coloca o melhor em tecnologia e design para sua imobiliária na Internet, podendo publicar sua carteira de imóveis com fotos e oferecer a seus clientes o melhor e completo serviço via internet. Não perca mais tempo e dinheiro!</span></td>
              </tr>
              <tr>
              	<td></td>
                <td colspan="3" height="15"></td>
              </tr>
              <tr>
              	<td></td>
                <td colspan="3" height="15"><span class="adm_fonteFormGrupo_01" style="color: #999999; ">Clique em <a href='http://www.google.com/talk/service/badge/Start?tk=z01q6amlq59cdc1k3fs3qm5besb5f9ec5734757l0r3vcq9feu80ef1a5daf96bdei7galrsbpf05gus8pmcqgo7stm3qjj5v0hih1hp50l9has1k7a323nqfp6icnlcjf5of8d32fmldtd2ug1i5e109f0kgi24sqpkethrk' target=_blank class="adm_fonteResTop_01" style="color: #000000;" title="Clique Aqui para mensagens instantâneas">Atendimento <span style="color: #ff7707;">OnLine</span></a> para mensagens instantâneas ou se preferir utilize os campos abaixo para enviar suas mensagens a equipe da ParkImovel.</span></td>
              </tr>			  
              <tr>
              	<td></td>
                <td colspan="3" height="25"></td>
              </tr>
              <tr>
              	<td></td>
                <td width="154" align="left" class="adm_fonteTextoGrupo_01">Nome:</td>
                <td width="260" align="left" class="adm_fonteTextoGrupo_01">&nbsp;<input name="str_nome" type="text" class="adm_formGrupoTxt_01" id="*" maxlength="20" /></td>
                <td align="left" class="adm_fonteTextoGrupo_01"></td>
              </tr>
              <tr>
              	<td></td>
                <td colspan="3" height="5"></td>
              </tr>
              <tr>
              	<td></td>
                <td align="left" class="adm_fonteTextoGrupo_01">E-mail:</td>
                <td align="left" class="adm_fonteTextoGrupo_01">&nbsp;<input name="str_email" type="text" class="adm_formGrupoTxt_01" id="*" onblur="validaCampoEmail(this);" title="Email"/></td>
                <td align="left" valign="top" class="adm_fonteTextoGrupo_01"></td>
              </tr>
              <tr>
              	<td></td>
                <td colspan="3" height="5"></td>
              </tr>
              <tr>
              	<td></td>
                <td colspan="3" align="left" valign="top" class="adm_fonteTextoGrupo_01"><textarea name="str_mensagem" cols="32" rows="6" class="campoTexto"></textarea></td>
              </tr>
              <tr>
              	<td></td>
                <td colspan="3" height="5"></td>
              </tr>
              <tr>
              	<td></td>
                <td align="left" valign="top" class="adm_fonteTextoGrupo_01">&nbsp;&nbsp;<input name="btSubmit" type="button" class="formBotao_03" value="Enviar" alt="Clique para Enviar sua Mensagem" onclick="validaFaleConosco(true);" ></td>
                <td></td>
                <td ></td>
              </tr>
              <tr>
              	<td></td>
                <td colspan="3" align="center" valign="top" class="adm_fonteResTop_04"></td>
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
