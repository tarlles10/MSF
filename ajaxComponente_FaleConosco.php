<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");
	include("class/classFaleConosco.php");
	$objFaleConosco		= new faleConosco($objConexao);

	if ((isset($_POST["enviar"]) || !empty($_POST["enviar"])) && $_POST["enviar"]==TRUE)
	{
		$objFaleConosco->enviarFaleConosco($objConexao, $objConfiguracao, FALSE);
	}

?>
<table width="579" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="top_grupoMostraConteudo_mascoteEmail">
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
		<td class="top_grupoRes_top_02" style="width: 286px;"><span class="adm_fonteResTop_01">Fale&nbsp;<span style="color: #ff7707;">Conosco</span></span></td>
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
                <td height="70" colspan="2" align="left" valign="top">
					<div class="adm_fonteResTop_04" style="font-size:11px">Esta é a área central para comunicação entre usuários e a equipe do <?php echo $objConfiguracao->showTitulo();?>. Incentivamos as mensagens de nossos visitantes com sugestões de pautas, críticas, elogios ou reclamações.</div>				</td>
                <td width="119"></td>
              </tr>
              <tr>
              	<td></td>
                <td colspan="3" height="15"><span class="adm_fonteFormGrupo_01" style="color: #999999; ">Clique em <a href='<?php echo $objConfiguracao->getEmailChat();?>' target=_blank class="adm_fonteResTop_01" style="color: #000000;" title="Clique Aqui para mensagens instantâneas">Atendimento <span style="color: #ff7707;">OnLine</span></a> para mensagens instantâneas, se preferir utilize os campos abaixo para enviar suas mensagens a nossa equipe ou ligue </span><span class="adm_fonteResTop_01" style="font-size:13px; font-weight:bold; color: #ff7707;"><?php echo $objConfiguracao->getTelefone();?></span>.</td>
              </tr>			  
              <tr>
              	<td></td>
                <td colspan="3" height="25"></td>
              </tr>
              <tr>
              	<td></td>
                <td width="154" align="left" class="adm_fonteTextoGrupo_01">Nome:</td>
                <td width="279" align="left" class="adm_fonteTextoGrupo_01">&nbsp;<input name="str_nome" type="text" class="adm_formGrupoTxt_01" id="*" maxlength="20" title="Nome"/></td>
                <td align="left" class="adm_fonteTextoGrupo_01"></td>
              </tr>
              <tr>
              	<td></td>
                <td colspan="3" height="5"></td>
              </tr>
              <tr>
              	<td></td>
                <td align="left" class="adm_fonteTextoGrupo_01">E-mail:</td>
                <td align="left" class="adm_fonteTextoGrupo_01">&nbsp;<input name="str_email" type="text" class="adm_formGrupoTxt_01" id="*" maxlength="40" onblur="validaCampoEmail(this);" title="Email"/></td>
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
                <td align="left" valign="top" class="adm_fonteTextoGrupo_01">&nbsp;&nbsp;<input name="btSubmit" type="button" class="formBotao_03" value="Enviar" alt="Clique para Enviar sua Mensagem" onclick="validaFaleConosco(false);" ></td>
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
