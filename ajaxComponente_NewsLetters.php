<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");
	include("class/classNewsletter.php");
	
	$objNewsletter 		= new Newsletter($objConfiguracao, $objConexao);

	if (!isset($_POST["cod"]))
	{
		$_POST["cod"] = 'false';
	}
	
	if ($_POST["cod"] == 'true')
	{
		if ($objNewsletter->cadastrarUsuarioNewsLetter($objConexao, $objConfiguracao))
		{ 
?>
	<table width="194" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" rowspan="3"></td>
        <td colspan="2" align="left" valign="top" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left; vertical-align: top;">
		<span style="font-size: 12px; text-align:left; font-weight:bold; vertical-align: top;">
			Obrigado por se cadastrar!
		</span>&nbsp;Em minutos receberá um Email para confirmação do seu cadastro.
		</td>
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
        <td colspan="2" align="left" valign="top" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left; vertical-align: top;"><span style="font-size: 12px; text-align:left; font-weight:bold; vertical-align: top;">Tente Novamente</span> para receber o nosso Boletim Informativo.</td>
        <td width="3" rowspan="6"></td>
      </tr>
      <tr>
        <td height="11" colspan="2"></td>
      </tr>
      <tr>
        <td height="10" colspan="2" valign="baseline" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left;">Nome:</td>
      </tr>	  
      <tr>
        <td colspan="2"><input name="str_nome" type="text" class="adm_formGrupoTxt_01" id="*" style="width:127;" maxlength="20" onblur="validaNomeProprio(this);" title="Nome"></td>
      </tr>
      <tr>
        <td height="10" colspan="2" valign="baseline" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left;">E-mail:</td>
      </tr>
      <tr>
        <td width="127"><input name="str_email" type="text" class="adm_formGrupoTxt_01" id="*" style="width:127;" maxlength="70" onblur="validaCampoEmail(this);" title="Email"></td>
        <td width="52" valign="baseline">&nbsp;&nbsp;<img src="adm/icons/btn_newsletter.png" style="cursor: pointer;" width="18" height="19" alt="Clique aqui para se Cadastrar" onclick="validaNewsLetter();" /></td>
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
        <td colspan="2" align="left" valign="top" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left; vertical-align: top;"><span style="font-size: 12px; text-align:left; font-weight:bold; vertical-align: top;">Cadastre-se</span> abaixo para receber o nosso Boletim Informativo.</td>
        <td width="3" rowspan="6"></td>
      </tr>
      <tr>
        <td height="11" colspan="2"></td>
      </tr>
      <tr>
        <td height="10" colspan="2" valign="baseline" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left;">Nome:</td>
      </tr>	  
      <tr>
        <td colspan="2"><input name="str_nome" type="text" class="adm_formGrupoTxt_01" id="*" style="width:127;" maxlength="20" onblur="validaNomeProprio(this);" title="Nome"></td>
      </tr>
      <tr>
        <td height="10" colspan="2" valign="baseline" class="adm_fonteTextoGrupo_03" style="font-size: 11px; text-align:left;">E-mail:</td>
      </tr>
      <tr>
        <td width="127"><input name="str_email" type="text" class="adm_formGrupoTxt_01" id="*" style="width:127;" maxlength="70" onblur="validaCampoEmail(this);" title="Email"></td>
        <td width="52" valign="baseline">&nbsp;&nbsp;<img src="adm/icons/btn_newsletter.png" style="cursor: pointer;" width="18" height="19" alt="Clique aqui para se Cadastrar" onclick="validaNewsLetter();" /></td>
      </tr>
</table>
<?php }
?>