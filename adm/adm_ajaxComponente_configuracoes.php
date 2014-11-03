<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina 			= "AcessDenied";
	$str_acessoMinimo 	= "Usuario";

	include("../config/config_Sistema.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	if (isset($_POST['id_configuracao']) || !empty($_POST['id_configuracao']))
	{
		$id_configuracao = $_POST["id_configuracao"];
		if ($id_configuracao != "")
		{
			$objConfiguracao->atribuirQuery($objConexao, $objConfiguracao->anti_injection($id_configuracao));
			$btn_botaoNAE	= 'button';
			$btn_botaoC		= 'hidden';
		}else
		{
			$btn_botaoNAE	= 'hidden';
			$btn_botaoC		= 'button';	
			$objConfiguracao->inicializaVariaveis();
		}
	}else
	{
		$id_configuracao 	= '';
		$btn_botaoNAE	= 'hidden';
		$btn_botaoC		= 'button';	
		$objConfiguracao->inicializaVariaveis();
	}

	if (isset($_POST["str_acao"]) || !empty($_POST["str_acao"]))
	{
		switch ($_POST["str_acao"])
		{
			case 'Cadastrar':
				$objConfiguracao->cadastrarConfiguracao($objConexao);
				break;
			case 'Alterar':
				$objConfiguracao->alterarConfiguracao($objConexao);
				break;
			case 'Excluir':
				$objConfiguracao->excluirConfiguracao($objConexao);
				break;
		}
	}

	//============================================================================//
	//      Criptografa os Links das paginas Ajax que passa por referencia        //
	//============================================================================//
	$cont = $objConfiguracao->sequenceCrypt('', true, true);
	
	$paginaAtual = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_configuracoes.php', $cont, true);	
	$paginaProx  = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_configuracoesEmpresa.php', 2, true);
?>
<script>
	function atribuirValoresFormulario($str_acao)
	{
		$continuaAcao = true;
		if ($str_acao == 'Excluir')
		{
			if(!(confirm("Atenção: \nEsta ação excluirá esta configuração do portal.\nClique em OK se deseja continuar.")))
			{
				$continuaAcao = false;
			}
		}
		if (validaCamposDefault() && $continuaAcao)
		{
			var $codSeq = <?php echo $cont;?>;
			
			var $arrayNome = new Array ('str_acao',
										'codSecFormulario',
										'id_configuracao',
										'slc_theme',
										'slc_banner',
										'str_nomeSite',
										'str_quantidadeVisita',
										'str_quantidadeBusca',
										'slc_tipoInforme',
										'slc_quantidadeInformes',
										'slc_bannerMedioLargo',
										'slc_bannerMedioCurto',
										'slc_bannerBaixo',
										'slc_ufPadrao',
										'str_emailChatInterno'
										);
			f = document;
			d = document.frm;

			var $arrayValor = new Array 
			(
				retornaUrlAjax('', new Array ('"','','"'), 	new Array ('' ,$str_acao,'')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,$codSeq, '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('id_configuracao').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_theme').value, $codSeq, true), '')),				
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('id_banner').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_nomeSite.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_quantidadeVisita.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_quantidadeBusca.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_tipoInforme').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_quantidadeInformes').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_bannerMedioLargo').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_bannerMedioCurto').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_bannerBaixo').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_ufPadrao').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_emailChatInterno.value, $codSeq, true), ''))
			);
			atribuirItem($arrayNome, $arrayValor, $str_acao);
	
			//Concatena a string do totaldeRegistros  int_quantidadeinformes
			$arrayNome 	= new Array ('"','', '"');
			$arrayValor = new Array ('',f.getElementById('slc_totalRegistrosTela').value,'');
			var $slc_totalRegistrosTela = retornaUrlAjax('', $arrayNome, $arrayValor);
	
			//Concatena a string da Ordenacao
			$arrayNome 	= new Array ('"','', '"');
			$arrayValor = new Array ('',f.getElementById('slc_ordenacao').value,'');
			var $valorOrdenacao = retornaUrlAjax('', $arrayNome, $arrayValor);
	
			//Concatena a string Cont
			$arrayNome 	= new Array ('"','', '"');
			$arrayValor = new Array ('',f.getElementById('codSec').value,'');
			var $cont = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			carregarConteudoMenu(1, $slc_totalRegistrosTela, $valorOrdenacao, sequenceCrypt(f.getElementById('str_nomePagina').value, f.getElementById('codSec').value, false), $cont);
		}		
	}

</script>
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
    <td class="adm_med_grupoForm_top_02" align="center"><span class="adm_fonteResTop_01">Configura&ccedil;&otilde;es</span></td>
    <td class="adm_med_grupoForm_top_03"><input name="id_configuracao" id="id_configuracao" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $id_configuracao;?>" ></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="right"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/passoForm1.png" width="87" height="30"></td>
        <td width="21"></td>
      </tr>
    </table></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05" align="center">
		<img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/configuracaoG.png" width="32" height="32">
	</td>
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
            <td width="570" height="345"  align="left" valign="top">
			<!-- Incio Campos Formulario -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
              <tr>
                <td colspan="7" height="5"></td>
              </tr>
              <tr>
                <td width="24%" align="right">Nome do Site:&nbsp;</td>
                <td width="24%" align="left"><input name="str_nomeSite" type="text" class="adm_formGrupoTxt_01" style="width:125;" id="*" maxlength="40" value="<?php echo $objConfiguracao->codifiStringBancoInterface($objConexao, $objConfiguracao->str_nomeSite);?>" title="Nome do Site"></td>
                <td colspan="2" align="right">Tipo de Informe:&nbsp;</td>
                <td width="30%" colspan="3" align="left">
					<select name="slc_tipoInforme" id="slc_tipoInforme" class="adm_formResCombo_01" style="width:125" title="Tipo de Informe" >
						<option value="Fixo" <?php echo $objConfiguracao->str_tipoInforme=='Fixo'?'selected':'';?>  title="Fixo" >Fixo</option>
<?php if ($objConfiguracao->getBln_TipoInforme() == 't')
					{
?>
						<option value="Randomico" <?php echo $objConfiguracao->str_tipoInforme=='Randomico'?'selected':'';?>  title="Randomico" >Randomico</option>
<?php }
?>

					</select>
				</td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Nº. + Visitados:&nbsp;</td>
                <td align="left"><input name="str_quantidadeVisita" id="*"  type="text"class="adm_formGrupoTxt_01" style="width: 55;" value="<?php echo $objConfiguracao->int_quantidadeVisita;?>" maxlength="10" <?php echo $objConfiguracao->getQuantidadeVisitas() == 't'?'':'readonly="true" disabled="disabled"';?> OnKeyPress="return retornaNumeros(event,this);" title="Nº. + Visitados"></td>
                <td colspan="2" align="right">Cor do Site:&nbsp;</td>
                <td colspan="3" align="left">
					<select name="slc_theme" id="slc_theme" class="adm_formResCombo_01" style="width:125" title="Cor do Site" >
<?php $query = $objConfiguracao->comboThema($objConexao);
				while($array = $objConexao->retornaArray($query))
				{
?>
			  		<option value="<?php echo $array['id_theme'];?>" <?php echo $objConfiguracao->id_theme == $array['id_theme']?'selected':'';?> ><?php echo $array['str_theme'];?></option>
<?php }
?>
                	</select>
				</td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Nº. + Procurados:&nbsp;</td>
                <td align="left"><input name="str_quantidadeBusca" type="text" class="adm_formGrupoTxt_01" style="width: 55;" id="*" maxlength="10" value="<?php echo $objConfiguracao->int_quantidadeBusca;?>" <?php echo $objConfiguracao->getQuantidadeBuscas() == 't'?'':'readonly="true" disabled="disabled"';?> OnKeyPress="return retornaNumeros(event,this);" title="Nº. + Procurados"></td>
                <td colspan="2" align="right">Nº. de Informes:&nbsp;</td>
                <td colspan="3" align="left">
                	<select name="slc_quantidadeInformes" id="slc_quantidadeInformes" class="adm_formResCombo_01" style="width:55" title="Nº. de Informes" >
<?php for($cont = 1; $cont <= $objConfiguracao->getQuantidadeInformes(); $cont++)
					{
?>                	 	 
					  <option value="<?php echo $cont;?>" <?php echo $objConfiguracao->int_quantidadeInformesInterno==$cont?'selected':'';?> ><?php echo $cont;?></option>
<?php }
?>
                    </select>
				</td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">UF Padr&atilde;o Inicial:&nbsp;</td>
                <td align="left">
                    <select name="slc_ufPadrao" id="slc_ufPadrao" class="adm_formResCombo_01" style="width:55" title="UF Padrão Inicial" >
					<option value="">:: UF ::</option>
<?php $query = $objConfiguracao->comboUF($objConexao);
						while($array = $objConexao->retornaArray($query))
						{
?>
				  			<option value="<?php echo $array['str_uf'];?>" <?php echo $objConfiguracao->str_ufPadrao == $array['str_uf']?'selected':'';?> ><?php echo $array['str_uf'];?></option>
<?php }
?>
					</select></td>
                <td colspan="2" align="right">Banner Principal:&nbsp;</td>
                <td colspan="3" align="left">
                	<select name="slc_banner" id="id_banner" class="adm_formResCombo_01" style="width:125" title="Banner Principal" >
<?php $query = $objConfiguracao->comboBanner($objConexao);
				while($array = $objConexao->retornaArray($query))
				{
?>
			  		<option value="<?php echo $array['id_banner'];?>" <?php echo $objConfiguracao->id_banner == $array['id_banner']?'selected':'';?> ><?php echo $array['str_nomebanner'];?></option>
<?php }
?>
                    </select>
                </td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Banner M&eacute;dio Largo:&nbsp;</td>
                <td align="left">
                    <select name="slc_bannerMedioLargo" id="slc_bannerMedioLargo" class="adm_formResCombo_01" style="width:125" title="Banner Médio Largo">
						<option value="Fixo" <?php echo $objConfiguracao->str_bannerMedioLargo=='Fixo'?'selected':'';?> title="Fixo" >Fixo</option>
<?php if ($objConfiguracao->getTipoBanner() == 't')
						{
?>						
						<option value="Randomico" <?php echo $objConfiguracao->str_bannerMedioLargo=='Randomico'?'selected':'';?> title="Randomico">Randomico</option>
						<option value="Randomico Periodo" <?php echo $objConfiguracao->str_bannerMedioLargo=='Randomico Periodo'?'selected':'';?> title="Randomico Periodo">Randomico Periodo</option>
<?php }
?>						
                    </select>
                </td>
                <td colspan="2" align="right">Email Chat:&nbsp;</td>
                <td colspan="3" align="left">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td width="76%" align="left"><input name="str_emailChatInterno" id="*" type="text" class="adm_formGrupoTxt_01" style="width:125;" value="<?php echo $objConfiguracao->str_emailChatInterno;?>" title="Email Chat"></td>
						<td width="24%" align="left"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/help.png" style="cursor:pointer;" width="16" height="16" onclick="apresentaHelpGoogleTalk(true);" alt="Ajuda para cadastrar o Google Talk."></td>
					  </tr>
					</table>
				</td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Banner M&eacute;dio Curto:&nbsp;</td>
                <td align="left">
                	<select name="slc_bannerMedioCurto" id="slc_bannerMedioCurto" class="adm_formResCombo_01" style="width:125" title="Banner Médio Curto">
						<option value="Fixo" <?php echo $objConfiguracao->str_bannerMedioCurto=='Fixo'?'selected':'';?> title="Fixo" >Fixo</option>
<?php if ($objConfiguracao->getTipoBanner() == 't')
						{
?>							
						<option value="Randomico" <?php echo $objConfiguracao->str_bannerMedioCurto=='Randomico'?'selected':'';?> title="Randomico" >Randomico</option>
						<option value="Randomico Periodo" <?php echo $objConfiguracao->str_bannerMedioCurto=='Randomico Periodo'?'selected':'';?> title="Randomico Periodo" >Randomico Periodo</option>
<?php }
?>
                    </select>                </td>
                <td colspan="2" align="right"></td>
                <td colspan="3" align="left"></td>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Banner da Base:&nbsp;</td>
                <td align="left">
                    <select name="slc_bannerBaixo" id="slc_bannerBaixo" class="adm_formResCombo_01" style="width:125" title="Banner da Base" >
						<option value="Fixo" <?php echo $objConfiguracao->str_bannerBaixo=='Fixo'?'selected':'';?> title="Fixo" >Fixo</option>
<?php if ($objConfiguracao->getTipoBanner() == 't')
						{
?>	
						<option value="Randomico" <?php echo $objConfiguracao->str_bannerBaixo=='Randomico'?'selected':'';?> title="Randomico" >Randomico</option>
						<option value="Randomico Periodo" <?php echo $objConfiguracao->str_bannerBaixo=='Randomico Periodo'?'selected':'';?> title="Randomico Periodo" >Randomico Periodo</option>
<?php }
?>
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
                        <td colspan="3" class="adm_fonteFormInf_01" height="22">Este formul&aacute;rio permite manter varias configura&ccedil;&otilde;es do site.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="12"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td width="82" align="right" class="adm_fonteFormInf_02" style="vertical-align:text-top;">Email Chat -&nbsp;</td>
                        <td width="421" >A configura&ccedil;&atilde;o deste campo permite aos  visitantes deste portal se comunicar em tempo real com os administradores deste portal por mensagens instant&acirc;neas via Google Talk, saiba mais sobre o <br/><span class="adm_fonteTextoGrupo_01"><a href="#" onclick="GB_showCenter('Google Talk', 'http://www.google.com/talk/intl/pt-BR/about.html');">Google Talk</a></span>.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td width="82" align="right" class="adm_fonteFormInf_02" style="vertical-align:text-top;"> Google talk-&nbsp;</td>
                        <td width="421">Para acessar  fa&ccedil;a o download do programa de mensagens<br/> instant&acirc;neas <span class="adm_fonteTextoGrupo_01"><a href="..\arquivosImovel\googletalk-setup-pt-BR.exe#" target="_blank">Gtalk</a></span> ou se preferir acessar o seu <span class="adm_fonteTextoGrupo_01"><a href="http://talkgadget.google.com/talkgadget/popout?hl=pt-BR#" target="_blank">GTalk</a></span> viaweb.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
                      </tr>					  
                    </table>
                </td>
              </tr>
            </table>
            <!-- Fim Campos Formulario -->
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
    <td colspan="6" class="adm_COMUM_med_grupoForm_top_07" align="center" valign="middle">
<!--
		//============================================================================//
		//                           Botões do Formulário                             //
		//============================================================================//
-->	
        	<table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center">
                	<input name="btSubmit" type="<?php echo $btn_botaoC;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Cadastrar" onclick="atribuirValoresFormulario('Cadastrar');">
                    	&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Alterar" onclick="atribuirValoresFormulario('Alterar');">
                    	&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Excluir" onclick="atribuirValoresFormulario('Excluir');">
                    	&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" class="adm_formBotao_02" value="Próximo" onclick="carregaProximoAnterior('<?php echo $paginaProx;?>', '2', true, 'id_configuracaoFixo', document.frm.id_configuracao.value);">                       
                </td>
              </tr>
            </table>
<!--
		//============================================================================//
		//                         Final Botões do Formulário                         //
		//============================================================================//
-->	
	</td>
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