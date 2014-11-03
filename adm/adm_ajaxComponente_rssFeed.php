<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina 			= "AcessDenied";
	$str_acessoMinimo 	= "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classRssFeed.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	$objRssFeed 	= new rssfeed($objConexao);

	if (isset($_POST["id_rss"]) || !empty($_POST["id_rss"]))
	{
		$id_rss = $_POST["id_rss"];
		if ($id_rss != "")
		{
			$objRssFeed->atribuirQuery($objConexao, $objConfiguracao->anti_injection($id_rss));
			$btn_botaoP		= 'button';
			$btn_botaoNAE	= 'button';
			$btn_botaoC		= 'hidden';
		}else
		{
			$btn_botaoP		= 'button';
			$btn_botaoNAE	= 'hidden';
			$btn_botaoC		= 'button';	
			$objRssFeed->inicializaVariaveis();
		}
	}else
	{
		$id_rss = '';
		$btn_botaoP		 = 'button';
		$btn_botaoNAE	 = 'hidden';
		$btn_botaoC		 = 'button';	
		$objRssFeed->inicializaVariaveis();
	}

	if (isset($_POST["str_acao"]) || !empty($_POST["str_acao"]))
	{
		switch ($_POST["str_acao"])
		{
			case 'Cadastrar':
				$objRssFeed->cadastrarRssFeed($objConexao);
				break;
			case 'Alterar':
				$objRssFeed->alterarRssFeed($objConexao);
				break;
			case 'Excluir':
				$objRssFeed->excluirRssFeed($objConexao);
				break;
		}
	}

	//============================================================================//
	//      Criptografa os Links das paginas Ajax que passa por referencia        //
	//============================================================================//
	$cont = $objConfiguracao->sequenceCrypt('', true, true);
	
	$paginaAtual = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_rssFeed.php', $cont, true);	
	$paginaProx  = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_rssFeedItem.php', 2, true);
	

?>
<script>
	function atribuirValoresFormulario($str_acao)
	{
		$continuaAcao = true;
		if ($str_acao == 'Excluir')
		{
			if(!(confirm("Atenção: \nEsta ação excluirá todas as notícias cadastradas para este Rss.\nClique em OK se deseja continuar.")))
			{
				$continuaAcao = false;
			}
		}
		if (validaCamposDefault() && $continuaAcao)
		{
			var $codSeq = <?php echo $cont;?>;
			
			var $arrayNome = new Array ('str_acao',
										'codSecFormulario',
										'id_rss',
										'chk_externo',
										'str_linkExterno',
										'str_titulo',
										'str_descricao',
										'str_copyright'
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
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.id_rss.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('chk_externo').checked.toString().toUpperCase(), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_linkExterno.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_titulo.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_descricao.value, 2, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_copyright.value, $codSeq, true), ''))
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
    <td class="adm_med_grupoForm_top_02" align="center"><span class="adm_fonteResTop_01">RSS Feed</span></td>
    <td class="adm_med_grupoForm_top_03"><input name="id_rss" id="id_rss" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $id_rss;?>" ></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="right"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/passoForm1.png" width="87" height="30"></td>
        <td width="21"></td>
      </tr>
    </table></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05" align="center">
		<img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/rssG.png" width="32" height="32">
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
                <td align="right">Rss Externo </td>
                <td align="left">
                	<input name="chk_externo" id="chk_externo" type="checkbox" <?php echo $objRssFeed->bln_externo=='t'?'checked':'';?> onclick="guardaValorIniciado(this);  controleRssExterno(this);"  onchange="guardaValorIniciado(this); controleRssExterno(this);" title="Rss Externo" /><input id="chk_externoAux" type="hidden" value="<?php echo $objRssFeed->bln_externoAux;?>">
                <td colspan="2" align="right">Link Externo:&nbsp;</td>
                <td colspan="3" align="left">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td width="76%" align="left"><input name="str_linkExterno" id="*" type="text" class="adm_formGrupoTxt_01" style="width: 125px;" maxlength="70" value="<?php echo $objRssFeed->str_linkExterno;?>" onblur="validaNomeProprio(this);" title="Link Externo"  <?php echo $objRssFeed->str_linkDisable;?> ></td>
						<td width="24%" align="left">
							<img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/help.png"style="cursor:pointer;" width="16" height="16" onclick="GB_showCenter('Escolha um feed abaixo para cadastrar no formulário', '../../adm/adm_AjaxComponenteListaFeedRss.php');" alt="Ajuda e sugestões de Links para Feeds Externos." >
							<?php // link add feed rss externo
							//="http://".$_SERVER["SERVER_NAME"].str_replace($objConfiguracao->retornaNomePaginaAtual(), "",$_SERVER["SCRIPT_NAME"]).'adm_AjaxComponenteListaFeedRss.php';
							?>
						</td>
					  </tr>
					</table>
                </td>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td width="25%" align="right">Título:&nbsp;</td>
                <td width="25%" align="left"><input name="str_titulo" id="*" type="text" class="adm_formGrupoTxt_01" maxlength="90" value="<?php echo $objRssFeed->str_titulo;?>" onblur="validaNomeProprio(this);" title="Titulo" <?php echo $objRssFeed->str_dadosDisable;?> ></td>
                <td colspan="2" align="right">Copyright:&nbsp;</td>
                <td colspan="3" align="left"><input name="str_copyright" id="*" type="text" class="adm_formGrupoTxt_01" maxlength="50" value="<?php echo $objRssFeed->str_copyright;?>" onblur="validaNomeProprio(this);" title="Direitos Reservados" <?php echo $objRssFeed->str_dadosDisable;?> /></td>
              </tr>
              <tr>
                <td colspan="7" height="6"></td>
              </tr>
              <tr>
                <td colspan="7" align="center" valign="top" style="width: 100%;"><textarea name="str_descricao" id="str_descricao" cols="60" rows="6" class="campoTexto"  <?php echo str_replace('width: 125px;','',$objRssFeed->str_dadosDisable);?> ><?php echo $objRssFeed->str_descricao;?></textarea></td>
              </tr>
              <tr>
                <td colspan="7" height="6"></td>
              </tr>
              <tr>
                <td colspan="7" background="<?php echo $objConfiguracao->getDirTheme();?>/adm_med_fundo_Inf.gif" style="height: 128px;" align="center" valign="top">
                    <table border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="56"></td>
                        <td colspan="3" class="adm_fonteFormInf_01" height="22">Este formul&aacute;rio permite criar t&oacute;picos de noticias internas ou externas. </td>
                      </tr>
                      <tr>
                        <td colspan="4" height="6"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td width="97" align="right" class="adm_fonteFormInf_02" style="vertical-align:text-top;">Link Externo -&nbsp;</td>
                        <td width="407">Este campo permite adicionar o link's de Feeds de sites externos.<br/>Assim o seu portal estar&aacute; sempre com not&iacute;cias atualizadas<br/>sem que seja haja a necessidade de cadastra suas pr&oacute;prias<br/>not&iacute;cias.</td>
                      </tr>	
                      <tr>
                        <td colspan="4" height="6"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td width="97" align="right" class="adm_fonteFormInf_02" style="vertical-align:text-top;">Pr&oacute;ximo -&nbsp;</td>
                        <td width="407">Segue para o pr&oacute;ximo passo do cadastro das suas pr&oacute;prias<br/>not&iacute;cias.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
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
                    	&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoP;?>" id="btn_botaoP" class="adm_formBotao_02" value="Próximo" onclick="carregaProximoAnterior('<?php echo $paginaProx;?>', '2', true, 'id_rssFixo', document.frm.id_rss.value);" <?php echo $objRssFeed->btn_botaoP;?> >
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
	controleRssExterno(document.frm.chk_externo);
</script>