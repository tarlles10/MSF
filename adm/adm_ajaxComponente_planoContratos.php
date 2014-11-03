<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina 			= "AcessDenied";
	$str_acessoMinimo 	= "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classPlanoContratos.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	$objPlanoContratos 	= new planoContratos($objConexao);

	if (isset($_POST["btSubmit"]) || !empty($_POST["btSubmit"]))
	{
		if ($_POST["btSubmit"]=='Novo')
		{
			unset($_POST["id_plano"]);
		}
	}
	if (isset($_POST["id_plano"]) || !empty($_POST["id_plano"]))
	{
		$id_plano = $_POST["id_plano"];
		if ($id_plano != "")
		{
			$objPlanoContratos->atribuirQuery($objConexao, $objConfiguracao->anti_injection($id_plano));
			$btn_botaoNAE	= 'button';
			$btn_botaoC		= 'hidden';
		}else
		{
			$btn_botaoNAE	= 'hidden';
			$btn_botaoC		= 'button';	
			$objPlanoContratos->inicializaVariaveis();
		}
	}else
	{
		$id_plano 		= '';
		$btn_botaoNAE	= 'hidden';
		$btn_botaoC		= 'button';	
		$objPlanoContratos->inicializaVariaveis();
	}

	if (isset($_POST["str_acao"]) || !empty($_POST["str_acao"]))
	{
		switch ($_POST["str_acao"])
		{
			case 'Cadastrar':
				$objPlanoContratos->cadastrarPlanoContratos($objConexao);
				break;
			case 'Alterar':
				$objPlanoContratos->alterarPlanoContratos($objConexao);
				break;
			case 'Excluir':
				$objPlanoContratos->excluirPlanoContratos($objConexao);
				break;
		}
	}

	//============================================================================//
	//      Criptografa os Links das paginas Ajax que passa por referencia        //
	//============================================================================//
	$cont = $objConfiguracao->sequenceCrypt('', true, true);
	
	$paginaAtual = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_planoContratos.php', $cont, true);
	
	
?>
<script>
	function atribuirValoresFormulario($str_acao)
	{
		$continuaAcao = true;
		if ($str_acao == 'Excluir')
		{
			if(!(confirm("Atenção: \nEsta ação excluirá a configuração deste plano.\nClique em OK se deseja continuar.")))
			{
				$continuaAcao = false;
			}
		}
		if (validaCamposDefault() && $continuaAcao)
		{
			var $codSeq = <?php echo $cont;?>;
			
			var $arrayNome = new Array ('str_acao',
										'codSecFormulario',
										'id_plano',
										'str_nomePlano',
										'rdb_tipoInforme',
										'slc_quantidadeInformes',
										'rdb_tipoBanner',
										'slc_quantidadeThemas',
										'rdb_quantidadeVisitas',
										'rdb_quantidadeBuscas',
										'rdb_construtoras',
										'rdb_empreendimentos',
										'rdb_subTipoImovel',
										'rdb_valorIptu',
										'rdb_valorCondominio',
										'rdb_sala',
										'rdb_banheiro',
										'rdb_suite',
										'rdb_garagem',
										'rdb_uf',
										'rdb_municipio',
										'rdb_dtEntrega',
										'chk_pacoteDiluido',
										'str_valorPacoteSistema',
										'str_valorMensalSistema'
										);
			f = document;
			d = document.frm;
			var $arrayValor = new Array 
			(
				retornaUrlAjax('', new Array ('"','','"'), 	new Array ('' ,$str_acao,'')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,$codSeq, '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('id_plano').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_nomePlano.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(retornoValorRadioButon('rdb_tipoInforme'), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_quantidadeInformes').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(retornoValorRadioButon('rdb_tipoBanner'), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_quantidadeThemas').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(retornoValorRadioButon('rdb_quantidadeVisitas'), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(retornoValorRadioButon('rdb_quantidadeBuscas'), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(retornoValorRadioButon('rdb_construtoras'), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(retornoValorRadioButon('rdb_empreendimentos'), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(retornoValorRadioButon('rdb_subTipoImovel'), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(retornoValorRadioButon('rdb_valorIptu'), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(retornoValorRadioButon('rdb_valorCondominio'), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(retornoValorRadioButon('rdb_sala'), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(retornoValorRadioButon('rdb_banheiro'), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(retornoValorRadioButon('rdb_suite'), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(retornoValorRadioButon('rdb_garagem'), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(retornoValorRadioButon('rdb_uf'), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(retornoValorRadioButon('rdb_municipio'), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(retornoValorRadioButon('rdb_dtEntrega'), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('chk_pacoteDiluido').checked.toString().toUpperCase(), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_valorPacoteSistema.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_valorMensalSistema.value, $codSeq, true), ''))
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
    <td class="adm_med_grupoForm_top_02" align="center"><span class="adm_fonteResTop_01">Plano de Contrato</span></td>
    <td class="adm_med_grupoForm_top_03"><input name="id_plano" id="id_plano" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $id_plano;?>" ></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05"></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05" align="center">
		<img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/planoContratoG.png" width="32" height="32">
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
                <td colspan="5" height="5"></td>
              </tr>
              <tr>
                <td width="25%" align="right">Nome do Plano:&nbsp;</td>
                <td width="25%" align="left"><input name="str_nomePlano" id="*" type="text" class="adm_formGrupoTxt_01" style="width:125;" maxlength="20" value="<?php echo $objPlanoContratos->str_nomePlano;?>" title="Nome do Plano">                </td>
                <td colspan="2" align="right">Imóveis mais Visitados:&nbsp;</td>
                <td align="left">
                	<!-- inicio tabela radiobuton Imoveis + Visitados -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td><input name="rdb_quantidadeVisitas" id="rdb_quantidadeVisitas" type="radio" value="FALSE" <?php echo $objPlanoContratos->bln_quantidadeVisitas=='f'?'checked':'';?> onclick="calculaValorSistema(this);" title="Imóveis mais Visitados" >N&atilde;o</td>
                        <td><input name="rdb_quantidadeVisitas" id="rdb_quantidadeVisitas" type="radio" value="TRUE"  <?php echo $objPlanoContratos->bln_quantidadeVisitas=='t'?'checked':'';?> onclick="calculaValorSistema(this);" >Sim</td>
                      </tr>
                    </table>
                    <!-- fim tabela radiobuton Imoveis + Visitados -->                </td>
              </tr>
              <tr>
                <td colspan="5" height="12"></td>
              </tr>
              <tr>
                <td align="right">Nº. de Informes:&nbsp;</td>
                <td align="left">
                	<select name="slc_quantidadeInformes" id="slc_quantidadeInformes"  class="adm_formResCombo_01" style="width:55" onchange="calculaValorSistema(this); guardaValorIniciado(this);" onfocus="guardaValorIniciado(this);" title="Nº. de Informes" >
                	  <option value="1" <?php echo $objPlanoContratos->int_quantidadeInformes=='1'?'selected':'';?> >1</option>
                	  <option value="2" <?php echo $objPlanoContratos->int_quantidadeInformes=='2'?'selected':'';?> >2</option>
                	  <option value="3" <?php echo $objPlanoContratos->int_quantidadeInformes=='3'?'selected':'';?> >3</option>
                	  <option value="4" <?php echo $objPlanoContratos->int_quantidadeInformes=='4'?'selected':'';?> >4</option>
                	  <option value="5" <?php echo $objPlanoContratos->int_quantidadeInformes=='5'?'selected':'';?> >5</option>
                	  <option value="6" <?php echo $objPlanoContratos->int_quantidadeInformes=='6'?'selected':'';?> >6</option>
                	  <option value="7" <?php echo $objPlanoContratos->int_quantidadeInformes=='7'?'selected':'';?> >7</option>
               	  	</select><input name="slc_quantidadeInformesAux" type="hidden" value="">
				</td>
                <td colspan="2" align="right">Imóveis mais Procurados:&nbsp;</td>
                <td align="left">
                	<!-- inicio tabela radiobuton Imoveis + Procurados -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td><input name="rdb_quantidadeBuscas" id="rdb_quantidadeBuscas" type="radio" value="FALSE" <?php echo $objPlanoContratos->bln_quantidadeBuscas=='f'?'checked':'';?> onclick="calculaValorSistema(this);" title="Imóveis mais Procurados">N&atilde;o</td>
                        <td><input name="rdb_quantidadeBuscas" id="rdb_quantidadeBuscas" type="radio" value="TRUE"  <?php echo $objPlanoContratos->bln_quantidadeBuscas=='t'?'checked':'';?> onclick="calculaValorSistema(this);" title="Imóveis mais Procurados">Sim</td>
                      </tr>
                    </table>
                    <!-- fim tabela radiobuton Imoveis + Procurados -->				</td>
              </tr>
              <tr>
                <td colspan="5" height="12"></td>
              </tr>
              <tr>
                <td align="right">Nº. de Themas:&nbsp;</td>
                <td align="left">
               	  <select name="slc_quantidadeThemas" id="slc_quantidadeThemas" class="adm_formResCombo_01" style="width:55" onchange="calculaValorSistema(this); guardaValorIniciado(this);" onfocus="guardaValorIniciado(this);" title="Nº. de Themas">
                	  <option value="1" <?php echo $objPlanoContratos->int_quantidadeThemas=='1'?'selected':'';?> >1</option>
                	  <option value="2" <?php echo $objPlanoContratos->int_quantidadeThemas=='2'?'selected':'';?> >2</option>
                	  <option value="3" <?php echo $objPlanoContratos->int_quantidadeThemas=='3'?'selected':'';?> >3</option>
                	  <option value="4" <?php echo $objPlanoContratos->int_quantidadeThemas=='4'?'selected':'';?> >4</option>
                	  <option value="5" <?php echo $objPlanoContratos->int_quantidadeThemas=='5'?'selected':'';?> >5</option>
                	  <option value="6" <?php echo $objPlanoContratos->int_quantidadeThemas=='6'?'selected':'';?> >6</option>
               	  </select><input name="slc_quantidadeThemasAux" type="hidden" value="">                </td>
                <td colspan="2" align="right">Filtro Nº. salas:&nbsp;</td>
                <td align="left">
                	<!-- inicio tabela radiobuton Filtro salas -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td><input name="rdb_sala" id="rdb_sala" type="radio" value="FALSE" <?php echo $objPlanoContratos->bln_sala=='f'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro Nº. salas" >N&atilde;o</td>
                        <td><input name="rdb_sala" id="rdb_sala" type="radio" value="TRUE"  <?php echo $objPlanoContratos->bln_sala=='t'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro Nº. salas" >Sim</td>
                      </tr>
                    </table>
                    <!-- fim tabela radiobuton Filtro salas -->                </td>
              </tr>
              <tr>
                <td colspan="5" height="12"></td>
              </tr>
              <tr>
                <td align="right">Tipo de Informe:&nbsp;</td>
                <td align="left">
                	<!-- inicio tabela radiobuton tipo de informe -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td><input name="rdb_tipoInforme" id="rdb_tipoInforme"  type="radio" value="FALSE" <?php echo $objPlanoContratos->bln_tipoInforme=='f'?'checked':'';?> onclick="calculaValorSistema(this);">
                        Fixo</td>
                        <td><input name="rdb_tipoInforme" id="rdb_tipoInforme" type="radio" value="TRUE"  <?php echo $objPlanoContratos->bln_tipoInforme=='t'?'checked':'';?> onclick="calculaValorSistema(this);">
                        Rand&ocirc;mico</td>
                      </tr>
                    </table>
                    <!-- fim tabela radiobuton tipo de informe -->                </td>
                <td colspan="2" align="right">Filtro Nº. banheiros:&nbsp;</td>
                <td align="left">
                	<!-- inicio tabela radiobuton Filtro banheiros -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td><input name="rdb_banheiro" id="rdb_banheiro" type="radio" value="FALSE" <?php echo $objPlanoContratos->bln_banheiro=='f'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro Nº. banheiros" >N&atilde;o</td>
                        <td><input name="rdb_banheiro" id="rdb_banheiro" type="radio" value="TRUE"  <?php echo $objPlanoContratos->bln_banheiro=='t'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro Nº. banheiros" >Sim</td>
                      </tr>
                    </table>
                    <!-- fim tabela radiobuton Filtro banheiros -->                </td>
              </tr>
              <tr>
                <td colspan="5" height="12"></td>
              </tr>
              <tr>
                <td align="right"> Banner Aleat&oacute;rio:&nbsp;</td>
                <td align="left">
                	<!-- inicio tabela radiobuton tipo de banner -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td><input name="rdb_tipoBanner" id="rdb_tipoBanner" type="radio" value="FALSE" <?php echo $objPlanoContratos->bln_tipoBanner=='f'?'checked':'';?> onclick="calculaValorSistema(this);" title="Banner Aleatório">N&atilde;o</td>
                        <td><input name="rdb_tipoBanner" id="rdb_tipoBanner"  type="radio" value="TRUE"  <?php echo $objPlanoContratos->bln_tipoBanner=='t'?'checked':'';?> onclick="calculaValorSistema(this);" title="Banner Aleatório">Sim</td>
                      </tr>
                    </table>
                    <!-- fim tabela radiobuton tipo de banner -->                </td>
                <td colspan="2" align="right">Filtro Nº. garagens:&nbsp;</td>
                <td align="left">
                	<!-- inicio tabela radiobuton Filtro garagens -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td><input name="rdb_garagem" id="rdb_garagem"  type="radio" value="FALSE" <?php echo $objPlanoContratos->bln_garagem=='f'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro Nº. garagens">N&atilde;o</td>
                        <td><input name="rdb_garagem" id="rdb_garagem" type="radio" value="TRUE"  <?php echo $objPlanoContratos->bln_garagem=='t'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro Nº. garagens" >Sim</td>
                      </tr>
                    </table>
                    <!-- fim tabela radiobuton Filtro garagens -->                </td>
              </tr>
              <tr>
                <td colspan="5" height="12"></td>
              </tr>
              <tr>
                <td align="right">Filtro Construtora:&nbsp;</td>
                <td align="left">
                	<!-- inicio tabela radiobuton Filtro Construtora -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td><input name="rdb_construtoras" id="rdb_construtoras" type="radio" value="FALSE" <?php echo $objPlanoContratos->bln_construtoras=='f'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro Construtora" >N&atilde;o</td>
                        <td><input name="rdb_construtoras" id="rdb_construtoras" type="radio" value="TRUE"  <?php echo $objPlanoContratos->bln_construtoras=='t'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro Construtora" >Sim</td>
                      </tr>
                    </table>
                    <!-- fim tabela radiobuton Filtro Construtora -->                </td>
                <td colspan="2" align="right">Filtro Nº. suites:&nbsp;</td>
                <td align="left">
                	<!-- inicio tabela radiobuton Filtro suites -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td><input name="rdb_suite" id="rdb_suite" type="radio" value="FALSE" <?php echo $objPlanoContratos->bln_suite=='f'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro Nº. suites" >N&atilde;o</td>
                        <td><input name="rdb_suite" id="rdb_suite" type="radio" value="TRUE"  <?php echo $objPlanoContratos->bln_suite=='t'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro Nº. suites" >Sim</td>
                      </tr>
                    </table>
                    <!-- fim tabela radiobuton Filtro suites -->                </td>
              </tr>
              <tr>
                <td colspan="5" height="12"></td>
              </tr>
              <tr>
                <td align="right">Filtro Empreendimento:&nbsp;</td>
                <td align="left">
                	<!-- inicio tabela radiobuton Filtro Empreendimento -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td><input name="rdb_empreendimentos" id="rdb_empreendimentos" type="radio" value="FALSE" <?php echo $objPlanoContratos->bln_empreendimentos=='f'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro Empreendimento" >N&atilde;o</td>
                        <td><input name="rdb_empreendimentos" id="rdb_empreendimentos" type="radio" value="TRUE"  <?php echo $objPlanoContratos->bln_empreendimentos=='t'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro Empreendimento" >Sim</td>
                      </tr>
                    </table>
                    <!-- fim tabela radiobuton Filtro Empreendimento -->                </td>
                <td colspan="2" align="right">Filtro Munic&iacute;pio:&nbsp;</td>
                <td align="left">
                	<!-- inicio tabela radiobuton Filtro Municipio -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td><input name="rdb_municipio" id="rdb_municipio"  type="radio" value="FALSE" <?php echo $objPlanoContratos->bln_municipio=='f'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro Município" >N&atilde;o</td>
                        <td><input name="rdb_municipio" id="rdb_municipio" type="radio" value="TRUE"  <?php echo $objPlanoContratos->bln_municipio=='t'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro Município" >Sim</td>
                      </tr>
                    </table>
                    <!-- fim tabela radiobuton Filtro Municipio -->                </td>
              </tr>
              <tr>
                <td colspan="5" height="12"></td>
              </tr>
              <tr>
                <td align="right">Filtro Categoria Im&oacute;vel:&nbsp;</td>
                <td align="left">
                	<!-- inicio tabela radiobuton Filtro Empreendimento -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td><input name="rdb_subTipoImovel" id="rdb_subTipoImovel" type="radio" value="FALSE" <?php echo $objPlanoContratos->bln_subTipoImovel=='f'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro Categoria Imóvel" >N&atilde;o</td>
                        <td><input name="rdb_subTipoImovel" id="rdb_subTipoImovel" type="radio" value="TRUE"  <?php echo $objPlanoContratos->bln_subTipoImovel=='t'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro Categoria Imóvel" >Sim</td>
                      </tr>
                    </table>
                    <!-- fim tabela radiobuton Filtro Empreendimento -->                </td>
                <td colspan="2" align="right">Filtro UF:&nbsp;</td>
                <td align="left">
                	<!-- inicio tabela radiobuton Filtro UF -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td><input name="rdb_uf" id="rdb_uf" type="radio" value="FALSE" <?php echo $objPlanoContratos->bln_uf=='f'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro UF" >N&atilde;o</td>
                        <td><input name="rdb_uf" id="rdb_uf" type="radio" value="TRUE"  <?php echo $objPlanoContratos->bln_uf=='t'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro UF" >Sim</td>
                      </tr>
                    </table>
                    <!-- fim tabela radiobuton Filtro UF -->                </td>
              </tr>
              <tr>
                <td colspan="5" height="12"></td>
              </tr>
              <tr>
                <td align="right">Filtro Condom&iacute;nio:&nbsp;</td>
                <td align="left">
                	<!-- inicio tabela radiobuton Filtro Condomnio -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td><input name="rdb_valorCondominio" id="rdb_valorCondominio"  type="radio" value="FALSE" <?php echo $objPlanoContratos->bln_valorCondominio=='f'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro Condomínio" >N&atilde;o</td>
                        <td><input name="rdb_valorCondominio" id="rdb_valorCondominio" type="radio" value="TRUE"  <?php echo $objPlanoContratos->bln_valorCondominio=='t'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro Condomínio" >Sim</td>
                      </tr>
                    </table>
                    <!-- fim tabela radiobuton Filtro Condomnio -->                </td>
                <td colspan="2" align="right">Dilu&iacute;r Plano nas Mensalidades:&nbsp;</td>
                <td align="left"><input name="chk_pacoteDiluido" id="chk_pacoteDiluido" type="checkbox" <?php echo $objPlanoContratos->bln_pacoteDiluido=='t'?'checked':'';?> onclick="calculaValorSistema(this); guardaValorIniciado(this);"  onchange="guardaValorIniciado(this);" title="Diluír Plano nas Mensalidades" /><input id="chk_pacoteDiluidoAux" type="hidden" value="<?php echo $objPlanoContratos->bln_pacoteDiluidoAux;?>">
                </td>
              </tr>
              <tr>
                <td colspan="5" height="12"></td>
              </tr>
              <tr>
                <td align="right">Filtro IPTU:&nbsp;</td>
                <td align="left">
                	<!-- inicio tabela radiobuton Filtro IPTU -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td><input name="rdb_valorIptu" id="rdb_valorIptu" type="radio" value="FALSE" <?php echo $objPlanoContratos->bln_valorIptu=='f'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro IPTU" >N&atilde;o</td>
                        <td><input name="rdb_valorIptu" id="rdb_valorIptu"  type="radio" value="TRUE"  <?php echo $objPlanoContratos->bln_valorIptu=='t'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro IPTU" >Sim</td>
                      </tr>
                    </table>
                    <!-- fim tabela radiobuton Filtro IPTU -->                </td>
                <td colspan="2" align="right">Valor do Plano:&nbsp;</td>
                <td align="left"><input name="str_valorPacoteSistemaAux" id="*" type="text" disabled="disabled" class="adm_formGrupoTxt_01" style="width:75;" value="<?php echo $objPlanoContratos->str_valorPacoteSistemaAux;?>" readonly="true" title="Valor do Plano" ><input name="str_valorPacoteSistema" id="str_valorPacoteSistema" type="hidden" disabled="disabled" value="<?php echo $objPlanoContratos->str_valorPacoteSistema;?>" maxlength="8" readonly="true" ></td>
              </tr>
              <tr>
                <td colspan="5" height="12"></td>
              </tr>
              <tr>
                <td align="right">Filtro data Entrega:&nbsp;</td>
                <td align="left"><!-- inicio tabela radiobuton Filtro IPTU -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td><input name="rdb_dtEntrega" id="rdb_dtEntrega" type="radio" value="FALSE" <?php echo $objPlanoContratos->bln_dtEntrega=='f'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro data Entrega" >N&atilde;o</td>
                        <td><input name="rdb_dtEntrega" id="rdb_dtEntrega" type="radio" value="TRUE"  <?php echo $objPlanoContratos->bln_dtEntrega=='t'?'checked':'';?> onclick="calculaValorSistema(this);" title="Filtro data Entrega" >Sim</td>
                      </tr>
                    </table>
                  <!-- fim tabela radiobuton Filtro IPTU -->
                </td>
                <td colspan="2" align="right">Valor da Mensalidade:&nbsp;</td>
                <td align="left"><input name="str_valorMensalSistemaAux" id="*" type="text" disabled="disabled" class="adm_formGrupoTxt_01" style="width:75;" value="<?php echo $objPlanoContratos->str_valorMensalSistemaAux;?>" maxlength="8" readonly="true" title="Valor da Mensalidade" ><input name="str_valorMensalSistema" id="str_valorMensalSistema" type="hidden" disabled="disabled" value="<?php echo $objPlanoContratos->str_valorMensalSistema;?>" maxlength="8" readonly="true" ></td>
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

                    <input name="btSubmit" type="<?php echo $btn_botaoC;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Cadastrar" onclick="atribuirValoresFormulario('Cadastrar');" >
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