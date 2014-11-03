<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");
	include("class/classNewsletter.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	
	$objNewsletter 		= new Newsletter($objConfiguracao, $objConexao);
?>
<table border="0" cellspacing="0" cellpadding="0" style="background-color:#EFEFEF; background-image:url('<?php echo $objConfiguracao->getDiretorioIcons();?>/menssagemProprietario.jpg'); border: 1px solid #7f9db9; width: 435px; height:121px;"> 
	<tr>
	    <td align="right"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/calendario/icon_fechar.png" style="cursor:pointer;" width="14" height="14" onclick="javascript:fechar('divEmailProprietario');" title="Fechar"></td>
	</tr>
  <tr>
    <td>
<?php if (!isset($_POST["cod"]))
	{
		$_POST["cod"] = 'false';
	}
	
	if ($_POST["cod"] == 'true')
	{
		if ($objNewsletter->enviarEmailProprietario($objConexao, $objConfiguracao))
		{ 
?>
	<table width="420" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" rowspan="3"></td>
        <td colspan="2" align="left" valign="top" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left; vertical-align: top;">
		<span style="font-size: 12px; text-align:left; font-weight:bold; vertical-align: top;">
			Obrigado por utilizar o nosso portal!</span>&nbsp;Aguarde a resposta do propriet&aacute;rio do im&oacute;vel no seu Email .		</td>
        <td width="3" rowspan="3"></td>
      </tr>
      <tr>
        <td height="11" colspan="2"></td>
      </tr>
      <tr>
        <td width="52" colspan="2"></td>
      </tr>	  
    </table>
<?php }else
		{
?>
<input name="bln_ativo" type="hidden" value="FALSE">
<table width="420" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" rowspan="6"></td>
        <td colspan="2" align="left" valign="top" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left; vertical-align: top;"><span style="font-size: 12px; text-align:left; font-weight:bold; vertical-align: top;">Tente Novamente</span> enviar menssagem para o propriet&aacute;rio do im&oacute;vel.</td>
        <td width="3" rowspan="6"></td>
      </tr>
      <tr>
        <td height="11" colspan="2"><input name="id_imovelPro" id="id_imovelPro" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $_POST["id_imovelPro"];?>"><input name="id_imagemPro" id="id_imagemPro" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $_POST["id_imagemPro"];?>"><input name="str_emailProprietario" id="str_emailProprietario" type="hidden" disabled="disabled" readonly="true" value="<?php echo $_POST["str_emailProprietario"];?>"></td>
      </tr>
      <tr>
        <td height="10" colspan="2" valign="baseline" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left;">Seu E-mail:</td>
      </tr>	  
      <tr>
        <td colspan="2"><input name="str_emailPro" type="text" class="adm_formGrupoTxt_01" id="@@" style="width:127;" maxlength="70" onblur="validaCampoEmail(this);" title="Email"></td>
      </tr>
      <tr>
        <td height="10" colspan="2" valign="baseline" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left;">Messagem:</td>
      </tr>
      <tr>
        <td width="127"><textarea name="str_menssagemPro" id="@@" style="width:368px;" cols="45" rows="2" class="campoTexto" title="Menssagem" ></textarea></td>
        <td width="52" valign="bottom">&nbsp;&nbsp;<img src="<?php echo $objConfiguracao->getDiretorioIcons()."/btn_indicaAmigo.png";?>" style="cursor: pointer;" width="18" height="19" alt="Clique aqui para enviar o email" onclick="validaEmailProprietario();" /></td>
      </tr>
</table>
<?php }
	}else
	{
?>
<input name="bln_ativo" type="hidden" value="FALSE">
<table width="420" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" rowspan="6"></td>
        <td colspan="2" align="left" valign="top" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left; vertical-align: top;"><span style="font-size: 12px; text-align:left; font-weight:bold; vertical-align: top;">Informe seu email </span> e a menssagem para ao proprietário do imóvel.</td>
        <td width="3" rowspan="6"></td>
      </tr>
      <tr>
        <td height="11" colspan="2"><input name="id_imovelPro" id="id_imovelPro" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $_POST["id_imovelPro"];?>"><input name="id_imagemPro" id="id_imagemPro" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $_POST["id_imagemPro"];?>"><input name="str_emailProprietario" id="str_emailProprietario" type="hidden" disabled="disabled" readonly="true" value="<?php echo $_POST["str_emailProprietario"];?>"></td>
      </tr>
      <tr>
        <td height="10" colspan="2" valign="baseline" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left;">Seu E-mail:</td>
      </tr>	  
      <tr>
        <td colspan="2"><input name="str_emailPro" type="text" class="adm_formGrupoTxt_01" id="@@" style="width:127;" maxlength="70" onblur="validaCampoEmail(this);" title="Email"></td>
      </tr>
      <tr>
        <td height="10" colspan="2" valign="baseline" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left;">Messagem:</td>
      </tr>
      <tr>
        <td width="127"><textarea name="str_menssagemPro" id="@@" style="width:368px;" cols="45" rows="2" class="campoTexto" title="Menssagem" ></textarea></td>
        <td width="52" valign="bottom">&nbsp;&nbsp;<img src="<?php echo $objConfiguracao->getDiretorioIcons()."/btn_indicaAmigo.png";?>" style="cursor: pointer;" width="18" height="19" alt="Clique aqui para enviar o email" onclick="validaEmailProprietario();" /></td>
      </tr>
</table>
<?php }
?>
</td>
  </tr>
</table>