<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina 			= "AcessDenied";
	$str_acessoMinimo 	= "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classBanner.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	$objBanner 	= new banner($objConexao);
	$objBanner->atribuirObrigatoriedadeDataFormulario($objConexao);

	if (isset($_POST["id_banner"]) || !empty($_POST["id_banner"]))
	{
		$id_banner = $_POST["id_banner"];
		if ($id_banner != "")
		{
			$objBanner->atribuirQuery($objConexao, $objConfiguracao->anti_injection($id_banner));
			$btn_botaoNAE	= 'button';
			$btn_botaoC		= 'hidden';
		}else
		{
			$btn_botaoNAE	= 'hidden';
			$btn_botaoC		= 'button';	
			$objBanner->inicializaVariaveis();
		}
	}else
	{
		$id_banner 	= '';
		$btn_botaoNAE	= 'hidden';
		$btn_botaoC		= 'button';	
		$objBanner->inicializaVariaveis();
	}

	if (isset($_POST["str_acao"]) || !empty($_POST["str_acao"]))
	{
		switch ($_POST["str_acao"])
		{
			case 'Cadastrar':
				$objBanner->cadastrarBanner($objConexao);
				break;
			case 'Alterar':
				$objBanner->alterarBanner($objConexao);
				break;
			case 'Excluir':
				$objBanner->excluirBanner($objConexao);
				break;
		}
	}

	//============================================================================//
	//      Criptografa os Links das paginas Ajax que passa por referencia        //
	//============================================================================//
	$cont = $objConfiguracao->sequenceCrypt('', true, true);
	
	$paginaAtual = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_banners.php', $cont, true);
	
?>
<script>
	function atribuirValoresFormulario($str_acao, $diretorioDestino)
	{
		$continuaAcao = true;
		if ($str_acao == 'Excluir')
		{
			if(!(confirm("Atenção: \nEsta ação excluirá todas as informações deste banner.\nClique em OK se deseja continuar.")))
			{
				$continuaAcao = false;
			}
		}
		if (validaCamposDefault() && $continuaAcao)
		{
			var $codSeq = <?php echo $cont;?>;
			var $arrayNome = new Array ('str_acao',
										'codSecFormulario',
										'id_banner',
										'slc_localBanner',
										'chk_flash',
										'str_nomeBanner',
										'str_diretorioBanner',
										'str_dtInicialBanner',
										'str_dtFinalBanner',
										'str_tituloBanner',
										'str_chamadaBanner',
										'str_conteudoBanner',
										'str_url',
										'slc_localJanela',
										'chk_molde',
										'slc_id_moldes',
										'str_diretorioBannerAux'
										);
			f = document;
			d = document.frm;
			
			if (navigator.appName == 'Microsoft Internet Explorer')
			{
				//atualiza valor do editor para o objeto textarea
				updateTextArea('str_conteudoBanner');
			}
			
			var $arrayValor = new Array 
			(
				retornaUrlAjax('', new Array ('"','','"'), 	new Array ('' ,$str_acao,'')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,$codSeq, '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('id_banner').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_localBanner').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('chk_flash').checked.toString().toUpperCase(), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_nomeBanner.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt($diretorioDestino, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_dtInicialBanner.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_dtFinalBanner.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_tituloBanner.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_chamadaBanner.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_conteudoBanner.value, 2, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_url.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_localJanela').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('chk_molde').checked.toString().toUpperCase(), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_id_moldes').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_diretorioBannerAux.value, $codSeq, true), ''))
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
    <td class="adm_med_grupoForm_top_02" align="center"><span class="adm_fonteResTop_01">Banners</span></td>
    <td class="adm_med_grupoForm_top_03"><input name="id_banner" id="id_banner" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $id_banner;?>"></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05"></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05" align="center">
		<img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/bannersG.png" width="32" height="32">
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
                <td width="19%" align="right">Local do Banner:&nbsp;</td>
                <td width="25%" align="left">
               		<select name="slc_localBanner" id="slc_localBanner" class="adm_formResCombo_01" style="width:125" onchange="enviaValorBanner(this, 'chk_flash', 'chk_molde'); controleFlash(this, 'chk_flash'); controleObrigatoriedade(this, '<?php echo $objBanner->dt_medioLargo;?>','<?php echo $objBanner->dt_medioCurto;?>','<?php echo $objBanner->dt_bannerBaixo;?>')" title="Local do Banner">

						<option value="Banner Topo" <?php echo $objBanner->str_localBanner=='Banner Topo'?'selected':'';?>  title="Banner Topo" >Banner Topo</option>
						<option value="Banner Medio Largo" <?php echo $objBanner->str_localBanner=='Banner Medio Largo'?'selected':'';?>  title="Banner Medio Largo" >Banner Medio Largo</option>
						<option value="Banner Medio Curto" <?php echo $objBanner->str_localBanner=='Banner Medio Curto'?'selected':'';?>  title="Banner Medio Curto" >Banner Medio Curto</option>
						<option value="Banner Baixo" <?php echo $objBanner->str_localBanner=='Banner Baixo'?'selected':'';?>  title="Banner Baixo" >Banner Baixo</option>                
               	  </select>
                </td>
                <td colspan="2" align="right">Animação flash:&nbsp;</td>
                <td width="36%" colspan="3" align="left"><input name="chk_flash" id="chk_flash" type="checkbox" <?php echo $objBanner->bln_flash=='t'?'checked':'';?> onclick="guardaValorIniciado(this); controleFlash(this, 'slc_localBanner');" onchange="guardaValorIniciado(this);" title="Animação flash" /><input id="chk_flashAux" type="hidden" value="<?php echo $objBanner->bln_flashAux;?>">
				</td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td width="19%" align="right">Nome do Banner:&nbsp;</td>
                <td width="25%" align="left"><input name="str_nomeBanner" id="*" type="text" class="adm_formGrupoTxt_01" style="width: 125;" maxlength="40" value="<?php echo $objBanner->str_nomeBanner;?>" onblur="validaNomeProprio(this);" title="Nome do Banner"></td>
                <td colspan="2" align="right">Imagem:&nbsp;</td>
                <td colspan="3" align="left"><input name="str_diretorioBanner" type="file" class="adm_formGrupoTxt_01" lang="pt" onchange="guardaValorIniciado(this);"  /><input name="str_diretorioBannerAux" id="*" type="hidden" value="<?php echo $objBanner->str_diretorioBannerAux;?>" title="Arquivo"></td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Data Inicial:&nbsp;</td>
                <td align="left">
                <!-- inicio tabela campo Data Incial-->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="30"><input name="str_dtInicialBanner" id="*" type="text" class="adm_formGrupoTxt_01" style="width:70;" maxlength="10" value="<?php echo $objBanner->dt_inicialBanner;?>" OnKeyPress="formataMascara('##/##/####', this); return retornaNumeros(event,this);" onblur="verificaData(this);" title="Data Inicial"></td>
                        <td valign="bottom" align="left">&nbsp;<img src="icons/calendario.png" alt="Informe a Data" width="20" height="18" style="cursor:pointer;" onClick="popdate('document.frm.str_dtInicialBanner', 'div_dtInicialBanner', '145', document.frm.str_dtInicialBanner.value, 'adm');"><span id="div_dtInicialBanner" style="position:absolute"></span></td>
                      </tr>
                    </table><span id="div_dtFinalBanner" style="position:absolute"></span>
                <!-- fim tabela campo Data Inicial-->                </td>
                <td colspan="2" align="right">Data Final:&nbsp;</td>
                <td colspan="3" align="left">
<!-- inicio tabela campo Data Final -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="30"><input name="str_dtFinalBanner" type="text" id="<?php echo $objBanner->asteriscoCampoDataFinal;?>" class="adm_formGrupoTxt_01" style="width:70;" maxlength="10" value="<?php echo $objBanner->dt_finalBanner;?>" OnKeyPress="formataMascara('##/##/####', this); return retornaNumeros(event,this);" onblur="verificaData(this);" title="Data Final"></td>
                        <td valign="bottom" align="left">&nbsp;<img src="icons/calendario.png" alt="Informe a Data" width="20" height="18" style="cursor:pointer;" onClick="popdate('document.frm.str_dtFinalBanner', 'div_dtFinalBanner', '145', document.frm.str_dtFinalBanner.value, 'adm');"></td>
                      </tr>
                    </table>
                <!-- fim tabela campo Data Final -->                </td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td width="19%" align="right">T&iacute;tulo Banner:&nbsp;</td>
                <td width="25%" align="left"><input name="str_tituloBanner" id="*" type="text" class="adm_formGrupoTxt_01" maxlength="22" value="<?php echo $objBanner->str_tituloBanner;?>" onblur="validaNomeProprio(this);" <?php echo $objBanner->str_CamposDisable;?> title="Título Banner" ></td>
                <td colspan="2" align="right">Chamada Banner:&nbsp;</td>
                <td colspan="3" align="left"><input name="str_chamadaBanner" id="*" type="text" class="adm_formGrupoTxt_01" maxlength="110" value="<?php echo $objBanner->str_chamadaBanner;?>" onblur="validaNomeProprio(this);" <?php echo $objBanner->str_CamposDisable;?> title="Chamada Banner" ></td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td width="19%" align="right">Url:&nbsp;</td>
                <td width="25%" align="left"><input name="str_url" id="str_url" type="text" class="adm_formGrupoTxt_01" maxlength="255" value="<?php echo $objBanner->str_url;?>" onblur="validaNomeProprio(this);" title="Url" <?php echo $objBanner->str_CamposDisable;?> ></td>
                <td colspan="2" align="right">Como abrir:&nbsp;</td>
                <td colspan="3" align="left">
				<select name="slc_localJanela"  id="slc_localJanela" class="adm_formResCombo_01" <?php echo $objBanner->str_CamposDisable;?> title="Como abrir" >
                    <option value="Mesma Janela" <?php echo $objBanner->str_localJanela=='Mesma Janela'?'selected':'';?>  title="Na Mesma Janela" >Mesma Janela</option>
                    <option value="Outra Janela" <?php echo $objBanner->str_localJanela=='Outra Janela'?'selected':'';?>  title="Em Outra Janela" >Outra Janela</option>
				</select>
				</td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td width="19%" align="right">Molde do Banner:&nbsp;</td>
                <td width="25%" align="left"><input name="chk_molde" id="chk_molde" type="checkbox" <?php echo $objBanner->bln_moldeBanner=='t'?'checked':'';?> onclick="guardaValorIniciado(this); disableCampoOponente(this, 'slc_id_moldes');"  onchange="guardaValorIniciado(this); disableCampoOponente(this, 'slc_id_moldes');" <?php echo str_replace('width: 125px;','',$objBanner->str_CamposDisable);?> title="Molde do Banner" /><input id="chk_moldeAux" type="hidden" value="<?php echo $objBanner->bln_moldeBannerAux;?>"></td>
                <td colspan="2" align="right">Op&ccedil;&atilde;o Molde:&nbsp;</td>
                <td colspan="3" align="left">
				<div id="Moldes">
				<select name="slc_id_moldes" id="slc_id_moldes" class="adm_formResCombo_01" <?php echo $objBanner->str_CamposDisableMolde;?> title="Opção Molde" >
                  <?php $query = $objBanner->comboMoldes($objConexao, $objBanner->str_localBanner);
				while($array = $objConexao->retornaArray($query))
				{
?>
                  <option value="<?php echo $array['id_moldes'];?>" <?php echo $objBanner->id_moldes == $array['id_moldes']?'selected':'';?> title="<?php echo $objBanner->codifiStringBancoInterface($objConexao, $array['str_nomemolde']);?>"><?php echo $objBanner->codifiStringBancoInterface($objConexao, $array['str_nomemolde']);?></option>
                  <?php }
?>
                </select></td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td colspan="7" align="center" valign="top"><textarea name="str_conteudoBanner" id="str_conteudoBanner" cols="60" rows="6" class="campoTexto" <?php echo str_replace('width: 125px;','',$objBanner->str_CamposDisable);?> ><?php echo $objBanner->str_conteudoBanner;?></textarea></td>
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

                    <input name="btSubmit" type="<?php echo $btn_botaoC;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Cadastrar" onclick="UploadImagens('BANNER', 'Cadastrar');">
                    	&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Alterar" onclick="UploadImagens('BANNER', 'Alterar');">
                    	&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Excluir" onclick="UploadImagens('BANNER', 'Excluir');">
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
<script>
	if (navigator.appName == 'Microsoft Internet Explorer')
	{
		generate_wysiwyg('str_conteudoBanner');
	}
	controleFlash(document.frm.chk_flash, 'slc_localBanner');
</script>
<!--
		//============================================================================//
		//                        Final Tabela Conteudo Pagina                        //
		//============================================================================//
-->