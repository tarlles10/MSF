<?php header("Content-Type: text/html; charset=ISO-8859-1",true);
	
	$pagina = "AcessDenied";
	$str_acessoMinimo = "Usuario";

	include("../config/config_Sistema.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
?>
<!--
		//============================================================================//
		//                        Inicio Tabela Conteudo Pagina                       //
		//============================================================================//
-->
<table width="577" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" class="adm_med_Bar_E"></td>
    <td colspan="4" class="adm_med_Bar_M" align="right">
		<table width="95%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="50%" align="left"><span class="adm_fonteResTop_01">Seja Bem Vindo </span></td>
			<td width="50%" align="right"><span class="adm_fonteMenuEsq_01" style="vertical-align:middle;"><?php echo $objConfiguracao->retornaDataAtual("DataInterface");?></span></td>
		  </tr>
		</table>
	</td>
    <td colspan="2" class="adm_med_Bar_D"></td>
	<td height="22"></td>
  </tr>
  <tr>
    <td colspan="8" ></td>
	<td height="5"></td>
  </tr>
  <tr>
    <td colspan="2" class="adm_med_grupoForm_top_01"></td>
    <td class="adm_med_grupoForm_top_02" align="center"><span class="adm_fonteResTop_01">Área de Acesso Restrito</span></td>
    <td class="adm_med_grupoForm_top_03"></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05"></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05" align="center"></td>
    <td colspan="2" rowspan="2" class="adm_med_grupoForm_top_04"></td>
	<td height="18"></td>
  </tr>
  <tr>
    <td class="adm_COMUM_med_grupoForm_top_06"></td>
    <td colspan="3" class="adm_COMUM_med_grupoForm_top_07"></td>
	<td height="17"></td>
  </tr>
  <tr>
    <td class="adm_med_grupoForm_med_E_01"></td>
    <td colspan="6" class="adm_med_grupoForm_med_M">
	<!-- Incio Campos Formulario -->
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
          <tr>
            <td width="570" height="523" style="background: url(<?php echo $objConfiguracao->getDirTheme();?>/adm_med_fundo_Inf2.gif); background-repeat:no-repeat;" align="left" valign="top">
				<!-- Incio Conteudo Interno -->
				<table width="535" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01" style="text-align:justify;">
					<tr>
					  <td width="56"></td>
					  <td colspan="3" class="adm_fonteFormInf_01" height="22">Voc&ecirc; est&aacute; na &Aacute;rea Administrativa do seu Portal.</td>
					</tr>
					<tr>
					  <td colspan="4" height="7"></td>
					</tr>
					<tr>
					  <td colspan="2"></td>
					  <td colspan="2">Esta &aacute;rea e respons&aacute;vel por toda configura&ccedil;&atilde;o e informa&ccedil;&atilde;o 
						apresentada no seu Portal. Portanto tenha certeza de  qualquer altera&ccedil;&atilde;o que  
						realize, pois as modifica&ccedil;&otilde;es  s&atilde;o apresentadas em tempo real.<br />
						<br />
					  <div style="font-weight:bold;">Segue abaixo um breve tutorial para melhor utiliza&ccedil;&atilde;o desta ferramenta.</div></td>
					</tr>
					<tr>
					  <td colspan="4" height="12"></td>
					</tr>
					<tr>
					  <td colspan="2"></td>
					  <td width="57" align="center" class="adm_fonteFormInf_02"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/imovelCL.png" width="24" height="24" /><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/imovelPB.png" width="24" height="24" /></td>
					  <td>Utilize os &iacute;cones do menu esquerdo para navegar pelo sistema Administrativo. Os &iacute;cones coloridos indicam as sess&otilde;es a qual seu perfil possui acesso.</td>
					</tr>
					<tr>
					  <td colspan="4" height="7"></td>
					</tr>
					<tr>
					  <td colspan="2"></td>
					  <td align="center" class="adm_fonteFormInf_02"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/planoContratoCL.png" width="24" height="24" />&nbsp;</td>
					  <td>Esta sess&atilde;o permite  personalizar o melhor plano de contrato de acordo com as suas necessidades. Acesso restrito a vendedores e Gestores da ferramenta.</td>
					</tr>
					<tr>
					  <td colspan="4" height="7"></td>
					</tr>
					<tr>
					  <td colspan="2"></td>
					  <td align="center" class="adm_fonteFormInf_02"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/contratoCL.png" width="24" height="24" />&nbsp;</td>
					  <td>Aqui determina quem ser&aacute; o respons&aacute;vel contratual do sistema com a ParkImovel.</td>
					</tr>
					<tr>



					  <td colspan="4" height="7"></td>
					</tr>
					<tr>
					  <td colspan="2"></td>
					  <td align="center" class="adm_fonteFormInf_02"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/usuarioCL.png" width="24" height="24" />&nbsp;</td>
					  <td>Aqui se define e cria os usu&aacute;rios habilitados a utiliza&ccedil;&atilde;o do sistema administrativo.</td>
					</tr>
					<tr>
					  <td colspan="4" height="7"></td>
					</tr>
					<tr>
					  <td colspan="2"></td>
					  <td align="center" class="adm_fonteFormInf_02"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/configuracaoCL.png" width="24" height="24" />&nbsp;</td>
					  <td>Neste formul&aacute;rio se define atributos como NOME, COR, quantidade dos TOP mais visitados e procurados, Distrito Padr&atilde;o da Busca do portal, etc...</td>
					</tr>
					<tr>
					  <td colspan="4" height="7"></td>
					</tr>
					<tr>
					  <td colspan="2"></td>
					  <td align="center" class="adm_fonteFormInf_02"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/moldeBannerCL.png" width="24" height="24" />&nbsp;</td>
					  <td>Nesta sess&atilde;o e onde se mantem todos os layouts pr&eacute; definidos de moldes para cria&ccedil;&atilde;o dos banners pela ferramenta, sem interven&ccedil;&atilde;o de um editor de imagem externo. Acesso restrito a Gestores do METASOFTWARE.</td>
					</tr>
					<tr>
					  <td colspan="4" height="7"></td>
					</tr>
					<tr>
					  <td colspan="2"></td>
					  <td align="center" class="adm_fonteFormInf_02"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/bannersCL.png" width="24" height="24" />&nbsp;</td>
					  <td>Aqui e aonde se informa todos os banners para an&uacute;ncios publicit&aacute;rios  de imoveis, eventos e campanhas do seu portal.</td>
					</tr>
					<tr>
					  <td colspan="4" height="7"></td>
					</tr>
					<tr>
					  <td colspan="2"></td>
					  <td align="center" class="adm_fonteFormInf_02"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/municipiosCL.png" width="24" height="24" />&nbsp;</td>
					  <td>Nesta sess&atilde;o se informa todos os munic&iacute;pios e bairros que o seu portal possui imoveis.</td>
					</tr>
					<tr>
					  <td colspan="4" height="7"></td>
					</tr>
					<tr>
					  <td colspan="2"></td>
					  <td align="center" class="adm_fonteFormInf_02"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/construtorasCl.png" width="24" height="24" />&nbsp;</td>
					  <td>Aqui se informa todas as construtoras e seus respectivos empreendimentos. </td>
					</tr>
					<tr>
					  <td colspan="4" height="7"></td>
					</tr>
					<tr>
					  <td colspan="2"></td>
					  <td align="center" class="adm_fonteFormInf_02"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/imovelCL.png" width="24" height="24" />&nbsp;</td>
					  <td>Aqui se encontra todas as fotos, arquivos de informativos e os detalhes dos imoveis cadastrados no sistema.</td>
					</tr>
					<tr>
					  <td colspan="4" height="7"></td>
					</tr>
					<tr>
					  <td colspan="2"></td>
					  <td align="center" class="adm_fonteFormInf_02"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/rssCL.png" width="24" height="24" />&nbsp;</td>
					  <td>Neste formul&aacute;rio se criar suas pr&oacute;prias not&iacute;cias ou pode automatizar apontando para noticias de terceiros para publica&ccedil;&atilde;o no seu portal. </td>
					</tr>
					<tr>
					  <td colspan="4" height="12"></td>
					</tr>
				</table>
				<!-- Final Conteudo Interno -->
			</td>
          </tr>
        </table>
      <!-- Fim Campos Formulario -->
    </td>
    <td class="adm_med_grupoForm_med_D_01"></td>
	<td></td>
  </tr>
  <tr>
    <td class="adm_med_grupoForm_med_E_02"></td>
    <td colspan="6" class="adm_COMUM_med_grupoForm_top_07" align="center" valign="middle"></td>
    <td class="adm_med_grupoForm_med_D_02"></td>
  </tr>
  <tr>
    <td colspan="2" class="adm_boton_grupoForm_E"></td>
    <td colspan="4" class="adm_boton_grupoForm_M"></td>
    <td colspan="2" class="adm_boton_grupoForm_D"></td>
  </tr>
  <tr>
    <td width="3"></td>
    <td width="5"></td>
    <td width="268"></td>
    <td width="22"></td>
    <td width="221"></td>
    <td width="50"></td>
    <td width="5"></td>
    <td width="3"></td>
	<td></td>
  </tr>
</table>
<!--
		//============================================================================//
		//                        Final Tabela Conteudo Pagina                        //
		//============================================================================//
-->