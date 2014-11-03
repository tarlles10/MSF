<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");
	include("class/classNewsletter.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	
	$objNewsletter 		= new Newsletter($objConfiguracao, $objConexao);
?>
<table border="0" cellspacing="0" cellpadding="0" style="background-color:#EFEFEF; background-image:url('<?php echo $objConfiguracao->getDiretorioIcons();?>/indiqueAmigo.jpg'); border: 1px solid #7f9db9; width: 209px; height:121px;"> 
	<tr>
	    <td align="right"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/calendario/icon_fechar.png" style="cursor:pointer;" width="14" height="14" onclick="javascript:fechar('divIndiqueAmigo');" title="Fechar"></td>
	</tr>
  <tr>
    <td>
<?php if (!isset($_POST["cod"]))
	{
		$_POST["cod"] = 'false';
	}
	
	if ($_POST["cod"] == 'true')
	{
		if ($objNewsletter->enviarIndicacaoAmigo($objConexao, $objConfiguracao))
		{ 
?>
	<table width="194" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" rowspan="3"></td>
        <td colspan="2" align="left" valign="top" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left; vertical-align: top;">
		<span style="font-size: 12px; text-align:left; font-weight:bold; vertical-align: top;">
			Obrigado por utilizar o nosso portal!</span>&nbsp;Em minutos seu amigo receber&aacute; um Email sobre este im&oacute;vel.		</td>
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
<table width="194" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" rowspan="6"></td>
        <td colspan="2" align="left" valign="top" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left; vertical-align: top;"><span style="font-size: 12px; text-align:left; font-weight:bold; vertical-align: top;">Tente Novamente</span> para  indicar este im&oacute;vel ao seu amigo.</td>
        <td width="3" rowspan="6"></td>
      </tr>
      <tr>
        <td height="11" colspan="2"><input name="id_imovelInd" id="id_imovelInd" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $_POST["id_imovelInd"];?>"><input name="id_imagemInd" id="id_imagemInd" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $_POST["id_imagemInd"];?>"></td>
      </tr>
      <tr>
        <td height="10" colspan="2" valign="baseline" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left;">Seu nome:</td>
      </tr>	  
      <tr>
        <td colspan="2"><input name="str_nomeInd" type="text" class="adm_formGrupoTxt_01" id="##" style="width:127;" maxlength="20" onblur="validaNomeProprio(this);" title="Nome"></td>
      </tr>
      <tr>
        <td height="10" colspan="2" valign="baseline" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left;">E-mail do seu Amigo:</td>
      </tr>
      <tr>
        <td width="127"><input name="str_emailInd" type="text" class="adm_formGrupoTxt_01" id="##" style="width:127;" maxlength="70" onblur="validaCampoEmail(this);" title="Email"></td>
        <td width="52" valign="baseline">&nbsp;&nbsp;<img src="<?php echo $objConfiguracao->getDiretorioIcons()."/btn_indicaAmigo.png";?>" style="cursor: pointer;" width="18" height="19" alt="Clique aqui para indicar este imóvel" onclick="validaIndiqueAmigo();" /></td>
      </tr>
</table>
<?php }
	}else
	{
?>
<input name="bln_ativo" type="hidden" value="FALSE">
<table width="194" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" rowspan="6"></td>
        <td colspan="2" align="left" valign="top" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left; vertical-align: top;"><span style="font-size: 12px; text-align:left; font-weight:bold; vertical-align: top;">Informe seu nome </span> e o email do seu amigo.</td>
        <td width="3" rowspan="6"></td>
      </tr>
      <tr>
        <td height="11" colspan="2"><input name="id_imovelInd" id="id_imovelInd" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $_POST["id_imovelInd"];?>"><input name="id_imagemInd" id="id_imagemInd" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $_POST["id_imagemInd"];?>"></td>
      </tr>
      <tr>
        <td height="10" colspan="2" valign="baseline" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left;">Seu nome:</td>
      </tr>	  
      <tr>
        <td colspan="2"><input name="str_nomeInd" type="text" class="adm_formGrupoTxt_01" id="##" style="width:127;" maxlength="20" onblur="validaNomeProprio(this);" title="Nome"></td>
      </tr>
      <tr>
        <td height="10" colspan="2" valign="baseline" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left;">E-mail do seu Amigo:</td>
      </tr>
      <tr>
        <td width="127"><input name="str_emailInd" type="text" class="adm_formGrupoTxt_01" id="##" style="width:127;" maxlength="70" onblur="validaCampoEmail(this);" title="Email"></td>
        <td width="52" valign="baseline">&nbsp;&nbsp;<img src="<?php echo $objConfiguracao->getDiretorioIcons()."/btn_indicaAmigo.png";?>" style="cursor: pointer;" width="18" height="19" alt="Clique aqui para indicar este imóvel" onclick="validaIndiqueAmigo();" /></td>
      </tr>
</table>
<?php }
?>
</td>
  </tr>
</table>