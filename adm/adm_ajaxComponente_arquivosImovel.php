<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina 			= "AcessDenied";
	$str_acessoMinimo 	= "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classArquivoImovel.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	
	$objArquivo 	= new arquivoimovel($objConexao);
	if (isset($_POST["id_arquivosimovel"]) || !empty($_POST["id_arquivosimovel"]))
	{
		$id_arquivosImovel = $_POST["id_arquivosimovel"];
		if ($id_arquivosImovel != "")
		{
			$objArquivo->atribuirQuery($objConexao, $objConfiguracao->anti_injection($id_arquivosImovel));
			$btn_botaoP		= 'button';
			$btn_botaoNAE	= 'button';
			$btn_botaoC		= 'hidden';
		}else
		{
			$btn_botaoP		= 'button';
			$btn_botaoNAE	= 'hidden';
			$btn_botaoC		= 'button';	
			$objArquivo->inicializaVariaveis();
		}
	}else
	{
		$id_arquivosImovel 	= '';
		$btn_botaoP		= 'button';
		$btn_botaoNAE	= 'hidden';
		$btn_botaoC		= 'button';	
		$objArquivo->inicializaVariaveis();
	}

	if (isset($_POST["str_acao"]) || !empty($_POST["str_acao"]))
	{
		switch ($_POST["str_acao"])
		{
			case 'Cadastrar':
				$objArquivo->cadastrarArquivosImovel($objConexao);
				break;
			case 'Alterar':
				$objArquivo->alterarArquivosImovel($objConexao);
				break;
			case 'Excluir':
				$objArquivo->excluirArquivosImovel($objConexao);
				break;
		}
	}

	//============================================================================//
	//      Criptografa os Links das paginas Ajax que passa por referencia        //
	//============================================================================//
	$cont = $objConfiguracao->sequenceCrypt('', true, true);
	
	$paginaAnte  = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_imagensImovel.php', 2, true);
	$paginaAtual = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_arquivosImovel.php', $cont, true);	
	$paginaProx  = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_sateliteImovel.php', 2, true);

?>
<script>
	function atribuirValoresFormulario($str_acao, $diretorioDestino)
	{
		$continuaAcao = true;
		if ($str_acao == 'Excluir')
		{
			if(!(confirm("Atenção: \nEsta ação excluirá o arquivo selecionado do imóvel.\nClique em OK se deseja continuar.")))
			{
				$continuaAcao = false;
			}
		}
		if (validaCamposDefault() && $continuaAcao)
		{
			var $codSeq = <?php echo $cont;?>;
			
			var $arrayNome = new Array ('str_acao',
										'codSecFormulario',
										'id_arquivosimovel',
										'id_imovel',
										'str_arquivosImovel',
										'str_diretorioArquivosImovel',
										'str_diretorioArquivosImovelAux'
										);
			f = document;
			d = document.frm;

			var $arrayValor = new Array 
			(
				retornaUrlAjax('', new Array ('"','','"'), 	new Array ('' ,$str_acao,'')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,$codSeq, '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.id_arquivosimovel.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.id_imovel.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_arquivosImovel.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt($diretorioDestino, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_diretorioArquivosImovelAux.value, $codSeq, true), ''))
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
			
			carregarConteudoMenu(1, $slc_totalRegistrosTela, $valorOrdenacao, sequenceCrypt(f.getElementById('str_nomePagina').value, f.getElementById('codSec').value, false), $cont, f.getElementById('id_imovelFixo').value);
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
    <td class="adm_med_grupoForm_top_02" align="center"><span class="adm_fonteResTop_01">Arquivos   do Im&oacute;vel</span></td>
    <td class="adm_med_grupoForm_top_03"><input name="id_arquivosimovel" id="id_arquivosimovel" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $id_arquivosImovel;?>" ><input name="id_imovel" id="id_imovel" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $objArquivo->id_imovel;?>" ></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="right"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/passoForm4.png" width="87" height="30"></td>
        <td width="21"></td>
      </tr>
    </table></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05" align="center">
		<img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/arquivosG.png" width="32" height="32">
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
                <td align="right">Nome do Arquivo:&nbsp;</td>
                <td align="left">
                	<input name="str_arquivosImovel" id="*" type="text" class="adm_formGrupoTxt_01" style="width:125;" maxlength="24" value="<?php echo $objArquivo->str_arquivosImovel;?>" onblur="validaNomeProprio(this);" title="Nome do Arquivo" >
                <td colspan="2" align="right">Arquivo:&nbsp;</td>
                <td colspan="3" align="left">
                	<input name="str_diretorioArquivosImovel" type="file" class="adm_formGrupoTxt_01" lang="pt" onchange="guardaValorIniciado(this);" /><input name="str_diretorioArquivosImovelAux" id="*" type="hidden" value="<?php echo $objArquivo->str_diretorioArquivosImovelAux;?>" title="Arquivo">
                </td>
			  </tr>
              <tr>
                <td colspan="7" height="22"></td>
              </tr>
              <tr>
                <td colspan="7" background="<?php echo $objConfiguracao->getDirTheme();?>/adm_med_fundo_Inf.gif" style="height: 128px;" align="center" valign="top">
                    <table border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="56"></td>
                        <td colspan="3" class="adm_fonteFormInf_01" height="22">Este formul&aacute;rio permite salvar os arquivos anexos dos im&oacute;vel.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="6"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
						<td width="75" align="right" class="adm_fonteFormInf_02" style="vertical-align:text-top;">Anterior -&nbsp;</td>
                        <td width="429">Para retroceder um passo no cadastro das imagens dos im&oacute;veis.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td width="75" align="right" class="adm_fonteFormInf_02" style="vertical-align:text-top;">Pr&oacute;ximo -&nbsp;</td>
                        <td width="429">Para ir ao pr&oacute;ximo passo clique no bot&atilde;o &quot;pr&oacute;ximo&quot;.</td>
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
                    <input name="btSubmit" type="<?php echo $btn_botaoP;?>" class="adm_formBotao_02" value="Anterior" onclick="carregaProximoAnterior('<?php echo $paginaAnte;?>', '2', true, 'id_imovelFixo', document.frm.id_imovel.value);">
                    	&nbsp;&nbsp;
                	<input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" class="adm_formBotao_01" value="Novo" onclick="atribuirItem();">
                    	&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoC;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Cadastrar" onclick="UploadImagens('ARQUIVO', 'Cadastrar');">
                    	&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Alterar" onclick="UploadImagens('ARQUIVO', 'Alterar');">
                    	&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Excluir" onclick="UploadImagens('ARQUIVO', 'Excluir');">
                    	&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoP;?>" class="adm_formBotao_02" value="Próximo" onclick="carregaProximoAnterior('<?php echo $paginaProx;?>', '2', true, 'id_imovelFixo', document.frm.id_imovel.value);">
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
<iframe name="iframeUpload" id="iframeUpload" src="#" style="width:0; height:0; display:'none';"></iframe>
<!--
		//============================================================================//
		//                        Final Tabela Conteudo Pagina                        //
		//============================================================================//
-->
<script>
	if (document.frm.id_imovel.value == '' && document.getElementById('id_imovelFixo').value != '')
	{
		document.frm.id_imovel.value = document.getElementById('id_imovelFixo').value;
	}
</script>