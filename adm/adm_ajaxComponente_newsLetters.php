<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina 			= "AcessDenied";
	$str_acessoMinimo 	= "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classNewsletter.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	$objNewsletter 	= new newsLetter($objConexao);

	if (isset($_POST["id_newslettersboletim"]) || !empty($_POST["id_newslettersboletim"]))
	{
		$id_newslettersboletim = $_POST["id_newslettersboletim"];
		if ($id_newslettersboletim != "")
		{
			$objNewsletter->atribuirQuery($objConexao, $objConfiguracao->anti_injection($id_newslettersboletim));
			$btn_botaoNAE	= 'button';
			$btn_botaoC		= 'hidden';
		}else
		{
			$btn_botaoNAE	= 'hidden';
			$btn_botaoC		= 'button';	
			$objNewsletter->inicializaVariaveis();
		}
	}else
	{
		$id_newslettersboletim = '';
		$btn_botaoNAE	 = 'hidden';
		$btn_botaoC		 = 'button';	
		$objNewsletter->inicializaVariaveis();
	}

	if (isset($_POST["str_acao"]) || !empty($_POST["str_acao"]))
	{
		switch ($_POST["str_acao"])
		{
			case 'Cadastrar':
				$objNewsletter->cadastrarNewsLetter($objConexao);
				break;
			case 'Alterar':
				$objNewsletter->alterarNewsLetter($objConexao);
				break;
			case 'Excluir':
				$objNewsletter->excluirNewsLetter($objConexao);
				break;
		}
	}

	//============================================================================//
	//      Criptografa os Links das paginas Ajax que passa por referencia        //
	//============================================================================//
	$cont = $objConfiguracao->sequenceCrypt('', true, true);
	
	$paginaAtual = $objConfiguracao->sequenceCrypt('agendamento_envioNewsLetters.php', $cont, true);
?>
<script>
	function atribuirValoresFormulario($str_acao)
	{
		$continuaAcao = true;
		if ($str_acao == 'Excluir')
		{
			if(!(confirm("Atenção: \nEsta ação excluirá os dados deste Boletim Informativo.\nClique em OK se deseja continuar.")))
			{
				$continuaAcao = false;
			}
		}
		if (validaCamposDefault() && $continuaAcao)
		{
			var $codSeq = <?php echo $cont;?>;
			
			var $arrayNome = new Array ('str_acao',
										'codSecFormulario',
										'id_newslettersboletim',
										'str_assunto',
										'str_titulo',
										'str_descricao',
										'str_dtPublicacao',
										'str_emailResposta',
										'chk_enviarNewsletters'
										);
			f = document;
			d = document.frm;
			if (navigator.appName == 'Microsoft Internet Explorer')
			{
				//atualiza valor do editor para o objeto textarea
				updateTextArea('str_descricao');
			}
			var $arrayValor = new Array 
			(
				retornaUrlAjax('', new Array ('"','','"'), 	new Array ('' ,$str_acao,'')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,$codSeq, '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.id_newslettersboletim.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_assunto.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_titulo.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_descricao.value, 2, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_dtPublicacao.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_emailResposta.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('chk_enviarNewsletters').checked.toString().toUpperCase(), $codSeq, true), ''))
			);
			atribuirItem($arrayNome, $arrayValor, $str_acao);
	
			//Concatena a string do totaldeRegistros
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
    <td class="adm_med_grupoForm_top_02" align="center"><span class="adm_fonteResTop_01">NewsLetters</span></td>
    <td class="adm_med_grupoForm_top_03"><input name="id_newslettersboletim" id="id_newslettersboletim" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $id_newslettersboletim;?>" ></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="right"></td>
        <td width="21"></td>
      </tr>
    </table></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05" align="center">
		<img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/newslettersG.png" width="32" height="32">
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
                <td colspan="7" height="6"></td>
              </tr>
              <tr>
                <td align="right">Assunto&nbsp;</td>
                <td align="left">
                	<input name="str_assunto" id="*" type="text" class="adm_formGrupoTxt_01" style="width: 125px;" maxlength="40" value="<?php echo $objNewsletter->str_assunto;?>" onblur="validaNomeProprio(this);" title="Assunto">
                <td colspan="2" align="right">T&iacute;tulo:&nbsp;</td>
                <td colspan="3" align="left">
                	<input name="str_titulo" id="*" type="text" class="adm_formGrupoTxt_01" style="width: 125px;" maxlength="40" value="<?php echo $objNewsletter->str_titulo;?>" onblur="validaNomeProprio(this);" title="Título">
                </td>
              <tr>
                <td colspan="7" height="6"></td>
              </tr>
              <tr>
                <td width="25%" align="right">Data Publica&ccedil;&atilde;o:&nbsp;</td>
                <td width="25%" align="left">
				<!-- inicio tabela campo Data -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="30"><input name="str_dtPublicacao" id="*" type="text" class="adm_formGrupoTxt_01" style="width: 70px;" maxlength="10" value="<?php echo $objNewsletter->dt_publicacao;?>" OnKeyPress="formataMascara('##/##/####', this); return retornaNumeros(event,this);" onblur="verificaData(this);" title="Data Publicação"></td>
                        <td valign="bottom" align="left">&nbsp;<img src="icons/calendario.png" alt="Informe a Data" width="20" height="18" style="cursor:pointer;" onClick="popdate('document.frm.str_dtPublicacao', 'divDtPublicacao', '145', document.frm.str_dtPublicacao.value, 'adm');"><span id="divDtPublicacao" style="position:absolute"></span></td>
                      </tr>
                    </table>
                <!-- fim tabela campo Data -->
				</td>
                <td colspan="2" align="right">Email de Resposta:&nbsp;</td>
                <td colspan="3" align="left">
					<input name="str_emailResposta" id="*" type="text" class="adm_formGrupoTxt_01" style="width: 125;" maxlength="40" value="<?php echo $objNewsletter->str_emailResposta;?>" onblur="validaCampoEmail(this);" title="Email de Resposta">
				</td>
              </tr>
              <tr>
                <td colspan="7" height="6"></td>
              </tr>
              <tr>
                <td colspan="7" align="center" valign="top" style="width: 100%;"><textarea name="str_descricao" id="str_descricao" cols="60" rows="4" class="campoTexto"  ><?php echo $objNewsletter->str_descricao;?></textarea></td>
              </tr>
              <tr>
                <td colspan="7" height="6"></td>
              </tr>
              <tr>
                <td align="right">Enviar NewsLetters:&nbsp;</td>
                <td align="left">
					<input name="chk_enviarNewsletters" id="chk_enviarNewsletters" type="checkbox" <?php echo $objNewsletter->bln_enviarNewsletters=='t'?'checked':'';?> onclick="guardaValorIniciado(this);"  onchange="guardaValorIniciado(this);" title="Enviar NewsLetters"/><input id="chk_enviarNewslettersAux" type="hidden" value="<?php echo $objNewsletter->bln_enviarNewslettersAux;?>">
                </td>
                <td colspan="2" align="right"></td>
                <td colspan="3" align="left"></td>
              </tr>
              <tr>
                <td colspan="7" height="6"></td>
              </tr>
              <tr>
                <td colspan="7" background="<?php echo $objConfiguracao->getDirTheme();?>/adm_med_fundo_Inf.gif" style="height: 128px;" align="center" valign="top">
                    <table border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="55"></td>
                        <td colspan="3" class="adm_fonteFormInf_01" height="22">Este formul&aacute;rio permite criar os boletins informativos do portal. </td>
                      </tr>
                      <tr>
                        <td colspan="4" height="6"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td width="148" align="right" class="adm_fonteFormInf_02" style="vertical-align:text-top;">Enviar NewsLetters -&nbsp;</td>
                        <td width="362">Marque esta op&ccedil;&atilde;o para disparar o envio  deste<br/>boletim na pr&oacute;xima atividade de envio da sua<br/>mailist, que ocorre entre 00:00 as 06:00 da<br/>madrugada.
						</td>
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
                	<input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" class="adm_formBotao_01" value="Novo" onclick="atribuirItem();">

                    <input name="btSubmit" type="<?php echo $btn_botaoC;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Cadastrar" onclick="atribuirValoresFormulario('Cadastrar');">
                    	&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Alterar" onclick="atribuirValoresFormulario('Alterar');">
                    	&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Excluir" onclick="atribuirValoresFormulario('Excluir');">
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
<script>
	if (navigator.appName == 'Microsoft Internet Explorer')
	{
		generate_wysiwyg('str_descricao');
	}
</script>