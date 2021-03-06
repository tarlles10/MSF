<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina 			= "AcessDenied";
	$str_acessoMinimo 	= "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classEmpresa.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	$objEmpresa 	= new empresa($objConexao);
	
	if (isset($_POST["id_empresa"]) || !empty($_POST["id_empresa"]))
	{
		$id_empresa = $_POST["id_empresa"];
		if ($id_empresa != "")
		{
			$objEmpresa->atribuirQuery($objConexao, $objConfiguracao->anti_injection($id_empresa));
			$btn_botaoP		= 'button';
			$btn_botaoNAE	= 'button';
			$btn_botaoC		= 'hidden';
		}else
		{
			$btn_botaoP		= 'button';
			$btn_botaoNAE	= 'hidden';
			$btn_botaoC		= 'button';	
			$objEmpresa->inicializaVariaveis();
		}
	}else
	{
		$id_empresa 	= '';
		$btn_botaoP		= 'button';
		$btn_botaoNAE	= 'hidden';
		$btn_botaoC		= 'button';	
		$objEmpresa->inicializaVariaveis();
	}

	if (isset($_POST["str_acao"]) || !empty($_POST["str_acao"]))
	{
		switch ($_POST["str_acao"])
		{
			case 'Cadastrar':
				$objEmpresa->cadastrarEmpresa($objConexao);
				break;
			case 'Alterar':
				$objEmpresa->alterarEmpresa($objConexao);
				break;
			case 'Excluir':
				$objEmpresa->excluirEmpresa($objConexao);
				break;
		}
	}

	//============================================================================//
	//      Criptografa os Links das paginas Ajax que passa por referencia        //
	//============================================================================//
	$cont = $objConfiguracao->sequenceCrypt('', true, true);
	
	$paginaAnte  = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_configuracoes.php', 2, true);
	$paginaAtual = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_configuracoesEmpresa.php', $cont, true);	


	//============================================================================//
	//      			Tratamento Especifico do Formul�rio        				  //
	//============================================================================//
	$int_campoTituloMenu = (54 - intval($objConfiguracao->retornoIntStringMaxleghtTituloItem($objConexao)) + strlen($objEmpresa->str_tituloItem));

?>
<script>
	function atribuirValoresFormulario($str_acao)
	{
		$continuaAcao = true;
		if ($str_acao == 'Excluir')
		{
			if(!(confirm("Aten��o: \nEsta a��o excluir� este dado Institucional.\nClique em OK se deseja continuar.")))
			{
				$continuaAcao = false;
			}
		}
		if (validaCamposDefault() && $continuaAcao)
		{
			var $codSeq = <?php echo $cont;?>;
			
			var $arrayNome = new Array ('str_acao',
										'codSecFormulario',
										'id_empresa',
										'id_configuracao',
										'str_tituloItem',
										'str_descricaoItem',
										'str_dtPublicacao'
										);
			f = document;
			d = document.frm;
			if (navigator.appName == 'Microsoft Internet Explorer')
			{
				//atualiza valor do editor para o objeto textarea
				updateTextArea('str_descricaoItem');
			}
			var $arrayValor = new Array 
			(
				retornaUrlAjax('', new Array ('"','','"'), 	new Array ('' ,$str_acao,'')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,$codSeq, '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.id_empresa.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.id_configuracao.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_tituloItem.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_descricaoItem.value, 2, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_dtPublicacao.value, $codSeq, true), ''))
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
			
			carregarConteudoMenu(1, $slc_totalRegistrosTela, $valorOrdenacao, sequenceCrypt(f.getElementById('str_nomePagina').value, f.getElementById('codSec').value, false), $cont, f.getElementById('id_configuracaoFixo').value);

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
    <td class="adm_med_grupoForm_top_02" align="center"><span class="adm_fonteResTop_01">Dados Institucional</span></td>
    <td class="adm_med_grupoForm_top_03"><input name="id_empresa" id="id_empresa" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $id_empresa;?>" ><input name="id_configuracao" id="id_configuracao" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $objEmpresa->id_configuracao;?>" ></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="right"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/passoForm2.png" width="87" height="30"></td>
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
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">T&iacute;tulo do Menu:&nbsp;</td>
                <td align="left">
                	<input name="str_tituloItem" id="*" type="text" class="adm_formGrupoTxt_01" maxlength="<?php echo $int_campoTituloMenu;?>" value="<?php echo $objEmpresa->str_tituloItem;?>" onblur="validaNomeProprio(this);" title="Titulo" ><span id="divDtPublicacao" style="position:absolute"></span>
                <td colspan="2" align="right">Data Publica&ccedil;&atilde;o:&nbsp;</td>
                <td colspan="3" align="left">
                <!-- inicio tabela campo Data -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="30"><input name="str_dtPublicacao" id="str_dtPublicacao" type="text" class="adm_formGrupoTxt_01" style="width: 70px;" maxlength="10" value="<?php echo $objEmpresa->dt_publicacao;?>" OnKeyPress="formataMascara('##/##/####', this); return retornaNumeros(event,this);" onblur="verificaData(this);" title="Data Publica��o"></td>
                        <td valign="bottom" align="left">&nbsp;<img src="icons/calendario.png" alt="Informe a Data" width="20" height="18" style="cursor:pointer;" onClick="popdate('document.frm.str_dtPublicacao', 'divDtPublicacao', '145', document.frm.str_dtPublicacao.value, 'adm');"></td>
                      </tr>
                    </table>
                <!-- fim tabela campo Data -->
				</td>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td colspan="7" align="center" valign="top" style="width: 100%;"><textarea name="str_descricaoItem" id="str_descricaoItem" cols="60" rows="6" class="campoTexto" ><?php echo $objEmpresa->str_descricaoItem;?></textarea></td>
              </tr>
              <tr>
                <td colspan="7" height="6"></td>
              </tr>
<tr>
                <td colspan="7" background="<?php echo $objConfiguracao->getDirTheme();?>/adm_med_fundo_Inf.gif" style="height: 128px;" align="center" valign="top">
                    <table border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="56"></td>
                        <td colspan="3" class="adm_fonteFormInf_01" height="22">Este formul&aacute;rio cria os dados institucionais da empresa ex. &quot;Quem Somos&quot;.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="6"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td width="97" align="right" class="adm_fonteFormInf_02" style="vertical-align:text-top;">Anterior -&nbsp;</td>
                        <td width="407">Retorna ao formul&aacute;rio do passo anterior. </td>
                      </tr>
                      <tr>
                        <td colspan="4" height="6"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td width="97" align="right" class="adm_fonteFormInf_02" style="vertical-align:text-top;">Novo -&nbsp;</td>
                        <td width="407">Permite que o formul&aacute;rio cadastre uma novo dado institucional.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="6"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td width="97" align="right" class="adm_fonteFormInf_02" style="vertical-align:text-top;">Cadastrar -&nbsp;</td>
                        <td width="407">Salva o dado institucional informado no formul&aacute;rio acima.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="6"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td width="97" align="right" class="adm_fonteFormInf_02" style="vertical-align:text-top;">Alterar -&nbsp;</td>
                        <td width="407">Altera os dado institucionais selecionado na lista abaixo.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="6"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td width="97" align="right" class="adm_fonteFormInf_02" style="vertical-align:text-top;">Excluir -&nbsp;</td>
                        <td width="407">Apaga o dado selecionado na lista abaixo permanentemente.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
                      </tr>
                    </table> 
               </td>
              </tr>
              <tr>
                <td colspan="7" height="6"></td>
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
		//                           Bot�es do Formul�rio                             //
		//============================================================================//
-->	
        	<table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center">
                    <input name="btSubmit" type="<?php echo $btn_botaoP;?>" class="adm_formBotao_02" value="Anterior" onclick="carregaProximoAnterior('<?php echo $paginaAnte;?>', '2', false, 'id_configuracaoFixo');">
                    	&nbsp;&nbsp;
                	<input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" class="adm_formBotao_01" value="Novo" onclick="atribuirItem();">
                    	&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoC;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Cadastrar" onclick="atribuirValoresFormulario('Cadastrar');">
                    	&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Alterar" onclick="atribuirValoresFormulario('Alterar');">
                    	&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Excluir" onclick="atribuirValoresFormulario('Excluir');">
                </td>
              </tr>
            </table>
<!--
		//============================================================================//
		//                         Final Bot�es do Formul�rio                         //
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
		generate_wysiwyg('str_descricaoItem');
	}
	if (document.frm.id_configuracao.value == '' && document.getElementById('id_configuracaoFixo').value != '')
	{
		document.frm.id_configuracao.value = document.getElementById('id_configuracaoFixo').value;
	}
</script>