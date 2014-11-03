<?php 
	$pagina = "";
	$str_acessoMinimo = "";

	include("../config/config_Sistema.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
?>
<html>
<head>
<title>Sistema Administrativo <?php echo $objConfiguracao->showTitulo()?> :: <?php echo $objConfiguracao->showVersao();?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php include ("../componentes/componenteEstilo.php");?>
</head>
<body bgcolor="#FFFFFF">
<form name="frm" method="post" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
<!--
===============================================================================================================================
Inicio tabela
===============================================================================================================================
-->
<table width="766" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="5"></td>
		<td colspan="19" height="5"></td>
		<td height="4"></td>
	</tr>
	<tr>
		<td colspan="21" height="5"><?php include ("componentes/componenteTopo.php");?></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td colspan="19" height="5"></td>
		<td height="7"></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td colspan="19" background="<?php echo $objConfiguracao->getDirTheme();?>/administrativo_10.jpg" width="755" height="121"></td>
		<td height="121"></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td colspan="19" height="5"></td>
		<td height="5"></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td colspan="3" rowspan="3" background="<?php echo $objConfiguracao->getDirTheme();?>/administrativo_12.jpg" style="background-repeat: no-repeat;" width="173" height="37"></td>
		<td rowspan="8" width="5"></td>
		<td colspan="2" class="adm_med_Bar_E"></td>
		<td colspan="11" class="adm_med_Bar_M"></td>
		<td colspan="2" class="adm_med_Bar_D"></td>
		<td height="22"></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td colspan="15" height="5"></td>
		<td height="10"></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td colspan="2" rowspan="2" class="adm_med_grupoForm_top_01"></td>
		<td colspan="6" rowspan="2" class="adm_med_grupoForm_top_02" align="center"><span class="adm_fonteResTop_01">RSS Feed</span></td>
		<td colspan="2" rowspan="2" class="adm_med_grupoForm_top_03"></td>
		<td colspan="2" rowspan="3" class="adm_COMUM_med_grupoForm_top_05"></td>
		<td rowspan="3" class="adm_COMUM_med_grupoForm_top_05" align="center">
        	<img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/rssG.png" width="32" height="32">        </td>
		<td colspan="2" rowspan="3" class="adm_med_grupoForm_top_04"></td>
		<td height="5"></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td colspan="3" rowspan="5" background="<?php echo $objConfiguracao->getDirTheme();?>/administrativo_24.jpg" style="background-repeat: no-repeat;" width="173" height="429" align="right" valign="top"><?php include ("componentes/componenteMenu.php");?></td>
		<td height="18"></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td class="adm_COMUM_med_grupoForm_top_06"></td>
	  <td colspan="9" class="adm_COMUM_med_grupoForm_top_07"></td>
		<td height="17"></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td class="adm_med_grupoForm_med_E_01"></td>
		<td colspan="13" class="adm_med_grupoForm_med_M">
			<!-- Incio Campos Formulario -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
              <tr>
                <td colspan="7" height="5"></td>
              </tr>
              <tr>
                <td width="24%" align="right">Nome do Site:&nbsp;</td>
                <td width="24%" align="left"><input name="str_nomeSite" type="text" class="adm_formGrupoTxt_01" style="width:125;" id="*" maxlength="40"></td>
                <td colspan="2" align="right">Tipo de Informe:&nbsp;</td>
                <td width="30%" colspan="3" align="left">
				  <select name="slc_tipoInforme" class="adm_formResCombo_01" style="width:125" >
                        <option value="Fixo">Fixo</option>
                        <option value="Randomico">Randomico</option>
                    </select>                </td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Nº. + Visitados:&nbsp;</td>
                <td align="left"><input name="str_quantidadeVisita" type="text" class="adm_formGrupoTxt_01" style="width: 55;" id="*" maxlength="10"></td>
                <td colspan="2" align="right">Cor do Site:&nbsp;</td>
                <td colspan="3" align="left">
                	<select name="slc_id_theme" class="adm_formResCombo_01" style="width:125" >
                    </select>                </td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Nº. + Procurados:&nbsp;</td>
                <td align="left"><input name="str_quantidadeBusca" type="text" class="adm_formGrupoTxt_01" style="width: 55;" id="*" maxlength="10"></td>
                <td colspan="2" align="right">Nº. de Informes:&nbsp;</td>
                <td colspan="3" align="left">
                	<select name="slc_quantidadeInformes" class="adm_formResCombo_01" style="width:55" >
                    </select>                </td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">UF Padrão Inicial:&nbsp;</td>
                <td align="left">
                    <select name="slc_ufPadrao" class="adm_formResCombo_01" style="width:55" >
                    </select>                </td>
                <td colspan="2" align="right">Banner Principal:&nbsp;</td>
                <td colspan="3" align="left">
                	<select name="slc_id_banner" class="adm_formResCombo_01" style="width:125" >
                    </select>                </td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Banner M&eacute;dio Largo:&nbsp;</td>
                <td align="left">
                    <select name="slc_bannerMedioLargo" class="adm_formResCombo_01" style="width:125" >
                        <option value="Fixo">Fixo</option>
                        <option value="Randomico">Randomico</option>
                        <option value="Randomico Periodo">Randomico Periodo</option>
                    </select>                </td>
                <td colspan="2" align="right"></td>
                <td colspan="3" align="left"></td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Banner M&eacute;dio Curto:&nbsp;</td>
                <td align="left">
                	<select name="slc_bannerMedioCurto" class="adm_formResCombo_01" style="width:125" >
                        <option value="Fixo">Fixo</option>
                        <option value="Randomico">Randomico</option>
                        <option value="Randomico Periodo">Randomico Periodo</option>
                    </select>                </td>
                <td colspan="2" align="right"></td>
                <td colspan="3" align="left"></td>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Banner da Base:&nbsp;</td>
                <td align="left">
                    <select name="slc_bannerBaixo" class="adm_formResCombo_01" style="width:125" >
                        <option value="Fixo">Fixo</option>
                        <option value="Randomico">Randomico</option>
                        <option value="Randomico Periodo">Randomico Periodo</option>
                    </select>                </td>
                <td colspan="2" align="right"></td>
                <td colspan="3" align="left"></td>
              </tr>
              <tr>
                <td colspan="7" height="5"></td>
              </tr>
              <tr>
                <td colspan="7" background="<?php echo $objConfiguracao->getDirTheme();?>/adm_med_fundo_Inf.gif" style="height: 128px;" align="center" valign="top">
                    <table width="570" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="56"></td>
                        <td colspan="3" class="adm_fonteFormInf_01" height="22">Este formulrio permite manter varias configuraes do site.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="12"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td width="75" align="right" class="adm_fonteFormInf_02">Novo -&nbsp;</td>
                        <td width="429">Limpa os campos acima para um novo cadastro.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td align="right" class="adm_fonteFormInf_02">Cadastrar -&nbsp;</td>
                        <td>Grava os dados informados nos campos acima.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td align="right" class="adm_fonteFormInf_02">Alterar -&nbsp;</td>
                        <td>Modifica a informação selecionada na lista abaixo.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td align="right" class="adm_fonteFormInf_02">Excluir -&nbsp;</td>
                        <td>Apaga a informação selecionada na lista abaixo.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td align="right" class="adm_fonteFormInf_02">Listar -&nbsp;</td>
                        <td>Apresenta todos os registros gravados no base de dados.</td>
                      </tr>
                    </table>                </td>
              </tr>
            </table>
            <!-- Fim Campos Formulario -->        </td>
		<td class="adm_med_grupoForm_med_D_01"></td>
		<td height="340"></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td class="adm_med_grupoForm_med_E_02"></td>
		<td colspan="13" class="adm_COMUM_med_grupoForm_top_07" align="center" valign="middle">
        	<table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center">
                	<input name="btSubmit" type="button" class="adm_formBotao_01" value="Novo">
                    	&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="btSubmit" type="button" class="adm_formBotao_01" value="Cadastrar">
                    	&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="btSubmit" type="button" class="adm_formBotao_01" value="Alterar">
                    	&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="btSubmit" type="button" class="adm_formBotao_01" value="Excluir">
                    	&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="btSubmit" type="button" class="adm_formBotao_01" value="Listar">                </td>
              </tr>
            </table>        </td>
		<td class="adm_med_grupoForm_med_D_02"></td>
		<td height="45"></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td colspan="2" class="adm_boton_grupoForm_E"></td>
		<td colspan="11" class="adm_boton_grupoForm_M"></td>
		<td colspan="2" class="adm_boton_grupoForm_D"></td>
		<td height="9"></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td colspan="19" height="5"></td>
		<td height="4"></td>
	</tr>
	<tr>
		<td colspan="21"><?php include ("componentes/componenteResultado.php");?></td>
	</tr>
	<tr>
		<td colspan="21"><?php include ("componentes/componenteBotton2.php");?></td>
	</tr>
	<tr>
		<td width="5"></td>
		<td width="3"></td>
		<td width="5"></td>
		<td width="165"></td>
		<td width="5"></td>
		<td width="3"></td>
		<td width="5"></td>
		<td width="31"></td>
		<td width="31"></td>
		<td width="110"></td>
		<td width="29"></td>
		<td width="57"></td>
		<td width="10"></td>
		<td width="12"></td>
		<td width="10"></td>
		<td width="196"></td>
		<td width="25"></td>
		<td width="50"></td>
		<td width="5"></td>
		<td width="3"></td>
		<td width="5" height="5"></td>
	</tr>
</table>
<!--
===============================================================================================================================
Final tabela
===============================================================================================================================
-->
    </td>
  </tr>
</table>
</form>
</body>
</html>