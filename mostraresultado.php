<?php 
	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");
	include("class/classImovel.php");
	
	$objImovel 	= new imovel($objConexao);	
	$objImovel->inicializaVariaveisSimples();

	if (!isset($_GET["resultado"]))
	{
		$_GET["resultado"] = 'false';
	}
	header("Content-Type: text/html; charset=ISO-8859-1",true);

	//============================================================================//
	//      Criptografa os Links das paginas Ajax que passa por referencia        //
	//============================================================================//
	$cont = $objConfiguracao->sequenceCrypt('', true, true);
	
	$paginaAtual = $objConfiguracao->sequenceCrypt('ajaxComponenteResultados.php', $cont, true);

	
?>
<script>
	function atribuirValoresFormulario($str_acao)
	{

		var $codSeq = <?php echo $cont;?>;

		var $arrayNome = new Array ('int_paginacao',
									'slc_totalRegistrosTela',
									'slc_ordenacao',
									'str_acao',
									'codSecFormulario',
									'chk_venda',
									'chk_aluguel',
									'slc_tipoImovel',
									'slc_situacaoImovel',
									'slc_bairro',
									'str_descricaoImovel',
									'slc_quarto',
									'str_valorInicial',
									'str_valorFinal',
									'slc_tipoValor'
									);
		f = document;
		d = document.frm;
		var $arrayValor = new Array 
		(
			retornaUrlAjax('', new Array ('"','','"'), 	new Array ('' ,1,'')),
			retornaUrlAjax('', new Array ('"','','"'), 	new Array ('' ,f.getElementById('slc_totalRegistrosTela').value,'')),
			retornaUrlAjax('', new Array ('"','','"'), 	new Array ('' ,f.getElementById('slc_ordenacao').value,'')),
			retornaUrlAjax('', new Array ('"','','"'), 	new Array ('' ,$str_acao,'')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,$codSeq, '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('chk_venda').checked.toString().toUpperCase(), $codSeq, true), '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('chk_aluguel').checked.toString().toUpperCase(), $codSeq, true), '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_tipoImovel').value, $codSeq, true), '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_situacaoImovel').value, $codSeq, true), '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,f.getElementById('slc_bairro').value, '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_descricaoImovel.value, $codSeq, true), '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,f.getElementById('slc_quarto').value, '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_valorInicial.value, $codSeq, true), '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_valorFinal.value, $codSeq, true), '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_tipoValor').value, $codSeq, true), ''))
		);
		atribuirItemExterno($arrayNome, $arrayValor, $str_acao);
	}

	function go(pagina)
	{
		if (pagina == 'simples')
		{
			window.location='index.php?cod=simples';
		}
		else if(pagina == 'avancada')
		{
			window.location='index.php?cod=avancada';
		}
		else if(pagina == 'buscarsimples')
		{
			if($disableBuscaSimples == false)
			{
				atribuirValoresFormulario('BuscaSimples');
				window.location ='#grupoBase';
			}else
			{
				alertMenssage ('Aviso:','Aguarde o carregamento...');
			}
		}
		else if(pagina == 'buscaravancada')
		{
			window.location='index.php?cod=buscaravancada';
		}
		else
		{
			window.location = 'index.php';
		}
	}
	window.status = "";
</script>
<body bgcolor="#ffffff">
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
		<td colspan="27" valign="top" align="center"><?php include ("componentes/componenteTopo.php");?></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td colspan="24" height="5"></td>
		<td colspan="2" width="5" height="5"></td>
	</tr>
	<tr>
	  <td width="5" rowspan="17" height="466"></td>
		<td colspan="5" rowspan="17" align="left" valign="top">
<!--
===================================================
	Inicio tabela Menu
===================================================
-->        
            <table width="174" border="0" cellspacing="0" cellpadding="0">
            <tr>
            	<td class="menuEsq_top"></td>
            	<td rowspan="2"  class="menuEsq_botao" onClick="go('avancada')" title="Busca Avançada"></td>
            </tr>
            <tr>
            	<td class="menuEsq_fundo" valign="top" align="right">
                    <!-- Inicio do Menu -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteMenuEsq_01">
                      <tr>
                        <td colspan="5" height="5"></td>
                      </tr>
                      <tr>
                        <td width="11"></td>
                        <td width="20"><input name="chk_venda" id="chk_venda" type="checkbox" onClick="guardaValorIniciado(this);"  onchange="guardaValorIniciado(this);" title="Venda"/><input id="chk_vendaAux" type="hidden" value="<?php echo $objImovel->bln_vendaAux;?>">
						</td>
                        <td width="44">Venda</td>
                        <td width="20"><input name="chk_aluguel" id="chk_aluguel" type="checkbox" onClick="guardaValorIniciado(this);"  onchange="guardaValorIniciado(this);" title="Aluguel"/><input id="chk_aluguelAux" type="hidden" value="<?php echo $objImovel->bln_aluguelAux;?>">
						</td>
                        <td width="69">Aluguel</td>
                      </tr>
                      <tr>
                        <td colspan="5" height="5"></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td colspan="4">Tipo de Im&oacute;vel</td>
                      </tr>
                      <tr>
                        <td colspan="5" height="5"></td>
                      </tr>
                      <tr>
                        <td width="11"></td>
                        <td colspan="4">
						<select name="slc_tipoImovel" id="slc_tipoImovel" class="adm_formResCombo_01" style="width:127" title="Tipo de Imóvel">
							<option value="">:: selecione ::</option>
<?php $query = $objImovel->comboTipoImovel($objConexao);
								while($array = $objConexao->retornaArray($query))
								{
?>
									<option value="<?php echo $array['str_tipoimovel'];?>" title="<?php echo $array['str_tipoimovel'];?>"><?php echo $array['str_tipoimovel'];?></option>
<?php }
?>					
						</select>
						
						</td>
                      </tr>
                      <tr>
                        <td colspan="5" height="5"></td>
                      </tr>
                      <tr>
                        <td width="11"></td>
                        <td colspan="4">Situa&ccedil;&atilde;o do Im&oacute;vel</td>
                      </tr>
                      <tr>
                        <td colspan="5" height="5"></td>
                      </tr>
                      <tr>
                        <td width="11"></td>
                        <td colspan="4">
						<select name="slc_situacaoImovel" id="slc_situacaoImovel" class="adm_formResCombo_01" style="width:127" title="Situação do Imóvel" >
							<option value="">:: selecione ::</option>
							<option value="Lançamento" title="Lançamento" >Lançamento</option>
							<option value="Na Planta" title="Na Planta" >Na Planta</option>
							<option value="Outros" title="Outros" >Outros</option>
							<option value="Usado" title="Usado" >Usado</option>
                		</select>
						</td>
                      </tr>
                      <tr>
                        <td colspan="5" height="5"></td>
                      </tr>
                      <tr>
                        <td width="11"></td>
                        <td colspan="4">Bairro</td>
                      </tr>
                      <tr>
                        <td colspan="5" height="5"></td>
                      </tr>
                      <tr>
                        <td width="11"></td>
                        <td colspan="4">
						<select name="slc_bairro" id="slc_bairro" class="adm_formResCombo_01" style="width:125" title="Bairro">
                        <option value="">:: selecione ::</option>
<?php $query = $objImovel->comboBairroUf($objConexao, $objConfiguracao->getUfPadrao());
					while($array = $objConexao->retornaArray($query))
					{
?>
						<option value="<?php echo $array['id_bairro'];?>" <?php echo $objImovel->id_bairro == $array['id_bairro']?'selected':'';?> title="<?php echo $objImovel->codifiStringBancoInterface($objConexao, ucwords($array['str_bairro']));?>" ><?php echo $objImovel->codifiStringBancoInterface($objConexao, ucwords($array['str_bairro']));?></option>
<?php }
?>
						</select>
						</td>
                      </tr>
                      <tr>
                        <td colspan="5" height="5"></td>
                      </tr>
                      <tr>
                        <td width="11"></td>
                        <td colspan="4">Palavra - Chave</td>
                      </tr>
                      <tr>
                        <td colspan="5" height="5"></td>
                      </tr>
                      <tr>
                        <td width="11"></td>
                        <td colspan="4"><input name="str_descricaoImovel" id="str_descricaoImovel" type="text" class="adm_formGrupoTxt_01" style="width:127;" maxlength="128"></td>
                      </tr>
                      <tr>
                        <td colspan="5" height="5"></td>
                      </tr>
                      <tr>
                        <td width="11"></td>
                        <td colspan="4">N&ordm;. de quartos</td>
                      </tr>
                      <tr>
                        <td colspan="5" height="5"></td>
                      </tr>
                      <tr>
                        <td width="11"></td>
                        <td colspan="4">
							<select name="slc_quarto" id="slc_quarto" class="adm_formResCombo_01" style="width:55" title="Nº. de quartos">
								<option value="">N.º</option>
								<option value="0" title="0" >0</option>
								<option value="1" title="1" >1</option>
								<option value="2" title="2" >2</option>
								<option value="3" title="3" >3</option>
								<option value="4" title="4" >4</option>
								<option value="5" title="5" >5</option>
								<option value="6" title="6" >6</option>
								<option value="7" title="7" >7</option>
								<option value="8" title="8" >8</option>
								<option value="9" title="9" >9</option>
							</select>						
						</td>
                      </tr>
                      <tr>
                        <td colspan="5" height="56"></td>
                      </tr>
                      <tr>
                        <td colspan="5" class="menuEsq_fundoTitulo">&nbsp;&nbsp;&nbsp;&nbsp;Pesquisa por pre&ccedil;o:</td>
                      </tr>
                      <tr>
                        <td colspan="5" height="8"></td>
                      </tr>
                      <tr>
                      <!-- inicio tabela BuscaPreo -->
                        <td colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteMenuEsq_01">
                          <tr>
                            <td width="15"></td>
                            <td width="24">De</td>
                            <td><input name="str_valorInicial" id="str_valorInicial" type="text" class="adm_formGrupoTxt_01" style="width:69;" maxlength="22" onKeyDown="return formataValorDinheiro(this,22,event);" OnKeyPress="return retornaNumeros(event,this);"  value="<?php echo $objImovel->str_valorInicial;?>" title="Valor Inicial" ></td>
                          </tr>
                          <tr>
                            <td colspan="3" height="5"></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td>Até</td>
                            <td><input name="str_valorFinal" id="str_valorFinal" type="text" class="adm_formGrupoTxt_01" style="width:69;" maxlength="22" onKeyDown="return formataValorDinheiro(this,22,event);" OnKeyPress="return retornaNumeros(event,this);"  value="<?php echo $objImovel->str_valorFinal;?>" title="Valor Final" ></td>
                          </tr>
                          <tr>
                            <td colspan="3" height="5"></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td colspan="2">
							<select name="slc_tipoValor" id="slc_tipoValor" class="adm_formResCombo_01" style="width:94" >
<?php if ($objConfiguracao->getBln_valorCondominio() == 't')
								{
?>								
									<option value="Condomínio" <?php echo $objImovel->str_tipoValor=='Condomínio'?'selected':'';?> title="Condomínio" >Condomínio</option>
<?php }
?>
<?php if ($objConfiguracao->getBln_valorIptu() == 't')
								{
?>								
									<option value="IPTU" <?php echo $objImovel->str_tipoValor=='IPTU'?'selected':'';?> title="IPTU" >IPTU</option>
<?php }
?>								
								<option value="Imóvel" <?php echo $objImovel->str_tipoValor=='Imóvel'?'selected':'';?> title="Imóvel" >Imóvel</option>
                            </select>
							</td>
                            </tr>
                        </table></td>
                      <!-- Fim tabela BuscaPreo -->
                      </tr>
                      <tr>
                        <td colspan="5" height="22"></td>
                      </tr>
                      <tr>
                        <td colspan="5" align="right">
						  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteMenuEsq_01">
                          <tr>
                          	<td width="15"></td>
                            <td width="84" align="right"><input name="btSubmit" type="button" class="formBotao_04" value="" onClick="document.all.frm.reset();" title="Limpar Consulta"></td>
                            <td width="65" align="right"><input name="btSubmit" type="button" class="formBotao_02" value="" onClick="go('buscarsimples')" title="Buscar"></td>
                          </tr>
                          </table> 
                        </td>
                      </tr>
                    </table>
                    <!-- Fim do Menu -->
				</td>
            </tr>
            </table>
<!--
===================================================
	Final tabela Menu
===================================================
-->		
		</td>
		<td width="5"></td>
		<td colspan="3" class="adm_med_Bar_E"></td>
		<td colspan="13" class="med_Bar_M" style="width:561px;"><?php echo $objConfiguracao->montaItensMenuBarra($objConexao, 55)?></td>
		<td colspan="2" class="adm_med_Bar_D"></td>
		<td colspan="2" width="5"></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td colspan="18" height="10"></td>
		<td colspan="2" width="5" height="10"></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td rowspan="2" width="3"></td>
		<!-- Inicio Tabela Banner Medio Largo -->
		<td colspan="16" rowspan="2">
<?php $objConfiguracao->atribuirBanner($objConexao, 'Banner Medio Largo');
			echo $objConfiguracao->getDiretorioBanner();	
?>		
		</td>
		<td rowspan="2" width="4"></td>
		<td colspan="2" width="5" height="5"></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td colspan="2" width="5" height="59"></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td colspan="18" height="10"></td>
		<td colspan="2" width="5" height="10"></td>
	</tr>
	<tr>
		<td width="5"></td>
		<td colspan="18" rowspan="12">
			<div id="galeriaFotos"></div>
		</td>
		<td colspan="2" width="5" height="23"></td>
	</tr>
	<tr>
	  	<td width="5"></td>
		<td colspan="2" width="5" height="126"></td>
	</tr>
	<tr>
	  	<td width="5"></td>
		<td colspan="2" width="5" height="35"></td>
	</tr>
	<tr>
	  	<td width="5"></td>
		<td colspan="2" width="5" height="5"></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td colspan="2" width="5" height="3"></td>
	</tr>
	<tr>
	  	<td width="5"></td>
		<td colspan="2" width="5" height="6"></td>
	</tr>
	<tr>
	  	<td width="5"></td>
		<td colspan="2" width="5" height="23"></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td colspan="2" width="5" height="13"></td>
	</tr>
	<tr>
	  	<td width="5"></td>
		<td colspan="2" width="5" height="86"></td>
	</tr>
	<tr>
	  	<td width="5"></td>
		<td colspan="2" width="5" height="23"></td>
	</tr>
	<tr>
	  	<td width="5"></td>
		<td colspan="2" width="5" height="12"></td>
	</tr>
	<tr>
	  	<td width="5"></td>
		<td colspan="2" width="5" height="3"></td>
	</tr>
	<tr>
		<td colspan="26" align="center" valign="top">
<!--
===============================================================================================================================
Inicio Tabela DESCRIO GALERIA DE FOTOS
===============================================================================================================================
-->
<?php if (isset($_GET["id_imovel"]))
	{
		$objConfiguracao->atribuirImovelInicial($objConexao, $_GET["id_imovel"]);
	}else
	{
		$objConfiguracao->atribuirImovelInicial($objConexao);
	}
?>
<a name="alinharTopoPagina"></a>
<table width="755" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td colspan="14" style="height: 6px;"></td>
	</tr>
	<tr>
		<td colspan="2" class="top_grupoDes_top_E"></td>
		<td colspan="4" class="top_grupoDes_top_02"><span class="adm_fonteResTop_01">&nbsp;&nbsp;Informa&ccedil;&otilde;es Gerais do Im&oacute;vel </span></td>
		<td class="top_grupoDes_top_03"></td>
		<td colspan="3" class="top_grupoDes_top_04" align="right">
		<!-- inicio tabela indique mapa -->
			<table width="100%" border="0" cellspacing="0" cellpadding="0" >
			  <tr>
			  	<td width="16"></td>
				<td width="26" height="22" valign="top" class="top_grupoRes_top_btn_IndiqueImovel"></td>
				<td>&nbsp;<span class="adm_fonteTextoGrupo_01"><a href="#alinharTopoPagina" onClick="indicarEsteImovel();" style="font-size: 15px;" title="Indique este imóvel a um amigo">Indique este im&oacute;vel</a></span>&nbsp;</td>
				<?php echo $objConfiguracao->getPosicaoSatelite();?>
			  </tr>
			</table>
		<!-- fim tabela indique mapa -->		
		</td>
		<td colspan="2" class="top_grupoDes_top_D"></td>
		<td height="23" colspan="2"></td>
	</tr>
	<tr class="grupoEI_fundo_01">
		<td class="top_grupoDes_Med_E_01"></td>
		<td colspan="2" class="grupoEI_fundo_01" style="height:	152px;">
<?php //Mostrar icone Contato Proprietario
		if ($objConfiguracao->getTelResidencialProprietario()!=''||$objConfiguracao->getTelComercialProprietario()!=''||$objConfiguracao->getTelCelularProprietario()!='')
		{
			$imgContatoProprietario = '<img src="adm/icons/proprietarioP.png" width="16" height="16">';
		}
		//Mostrar Cor Destacada das celulas dos dados
		if ($objConfiguracao->getTelResidencialProprietario()!='')
		{
			$printTOP = 'class="grupoQUADROLATERAL_fundo_02_Contato"';
		}

		if ($objConfiguracao->getTelComercialProprietario()!=''||($objConfiguracao->getTelResidencialProprietario()!=''&&$objConfiguracao->getTelCelularProprietario()!=''))
		{
			$printMIDDLE = 'class="grupoQUADROLATERAL_fundo_02_Contato"';
		}

		if ($objConfiguracao->getTelCelularProprietario()!='')
		{
			$printBOTTON = 'class="grupoQUADROLATERAL_fundo_02_Contato"';
		}
		//Mostrar cor Destacada nas celulas entre as celulas dos dados
		if (($objConfiguracao->getTelResidencialProprietario()!=''&&$objConfiguracao->getTelComercialProprietario()!='')||($objConfiguracao->getTelResidencialProprietario()!=''&&$objConfiguracao->getTelCelularProprietario()!=''))
		{
			$printM_top = 'class="grupoQUADROLATERAL_fundo_02_Contato"';
		}

		if (($objConfiguracao->getTelComercialProprietario()!=''&&$objConfiguracao->getTelCelularProprietario()!='')||($objConfiguracao->getTelResidencialProprietario()!=''&&$objConfiguracao->getTelCelularProprietario()!=''))
		{
			$printM_botton = 'class="grupoQUADROLATERAL_fundo_02_Contato"';
		}
?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="bottom" style="height: 20px;"><img src="adm/icons/imovelP.png" width="16" height="16"></td>
              </tr>
              <tr>
                <td style="height: 92px;"></td>
              </tr>
              <tr>
                <td align="center" valign="bottom" style="height: 20px;"><?php echo $imgContatoProprietario;?></td>
              </tr>
              <tr>
                <td style="height: 30px;"></td>
              </tr>
            </table></td>
		<td class="grupoEI_fundo_01" valign="top">
<?php //============================================================================//
				//                Tratamento de variáveis de apresentação do imovel           //
				//============================================================================//
				
				if ($objConfiguracao->getDt_entrega() == "")
				{
					$dataEntrega = "Data da Entrega&nbsp;&nbsp;".$objConfiguracao->retornaDataAtual('Numerico', 'Interface');
				}else
				{
					$dataEntrega = "Data da Entrega&nbsp;&nbsp;".$objConfiguracao->retornaDataNumerica($objConfiguracao->getDt_entrega(), 'DATA_COMPLETA');
				}
?>
        	<!-- Inicio Tabela Descrio 01-->
        	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
              <tr>
                <td width="1"></td>
                <td height="23" class="adm_fonteResTop_04">R$ <?php echo $objConfiguracao->getValorImovel();?></td>
              </tr>
              <tr>
                <td height="5" colspan="2"><span id="divEmailProprietario" style="position:absolute"></span></td>
              </tr>
              <tr>
                <td></td>
                <td><?php echo $objConfiguracao->getTipoImovel();?></td>
              </tr>
              <tr>
                <td height="6" colspan="2"></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2"><?php echo $objConfiguracao->getSubTipoImovel();?></td>
              </tr>
              <tr>
                <td height="6" colspan="2"></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2"><?php echo $objConfiguracao->getMunicipio()." ".$objConfiguracao->getBairro();?></td>
              </tr>
              <tr>
                <td height="6" colspan="2"></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2"><?php echo $objConfiguracao->getSituacaoImovel();?></td>
              </tr>
              <tr>
                <td height="6" colspan="2"></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2" <?php echo $printTOP;?> ><?php echo ($objConfiguracao->getTelResidencialProprietario()!=''?'Tel. Residencial '.$objConfiguracao->getTelResidencialProprietario():'');?></td>
              </tr>
              <tr>
                <td height="6" colspan="2" <?php echo $printM_top;?> ></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2" <?php echo $printMIDDLE;?> ><?php echo ($objConfiguracao->getTelComercialProprietario()!=''?'Tel. Comercial '.$objConfiguracao->getTelComercialProprietario():'');?></td>
              </tr>
              <tr>
                <td height="6" colspan="2" <?php echo $printM_botton;?> ></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2" <?php echo $printBOTTON;?> ><?php echo ($objConfiguracao->getTelCelularProprietario()!=''?'Tel. Celular '.$objConfiguracao->getTelCelularProprietario():'');?></td>
              </tr>
            </table>
        	<!-- Fim Tabela Descrio 01-->        </td>
		<td width="1" class="top_grupoDes_Bar"></td>
		<td colspan="3" class="grupoEI_fundo_01" valign="top">
        	<!-- Inicio Tabela Descrio 02-->
        	<table border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
              <tr>
                <td width="29" align="center"></td>
                <td width="194" height="23" class="adm_fonteResTop_04"><span class="adm_fonteTextoGrupo_01"><?php echo $objConfiguracao->getEmailProprietario()!=''?'<a href="#alinharTopoPagina" onClick="emailProprietario();" style="font-size: 18px;color: #525252;vertical-align: bottom;">Mensagem</a>':'';?></span>&nbsp;&nbsp;<?php echo $objConfiguracao->getEmailProprietario()!=''?'<img src="adm/icons/newslettersP.png" width="16" height="16">':'';?></td>
              </tr>
              <tr>
                <td height="5" colspan="2"></td>
              </tr>
              <tr>
              	<td></td>
                <td colspan="2"><?php echo $dataEntrega;?></td>
              </tr>
              <tr>
                <td height="6" colspan="2"></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2">Nº. de quartos&nbsp;&nbsp;<?php echo $objConfiguracao->getQuarto();?></td>
              </tr>
              <tr>
                <td height="6" colspan="2"></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2">Nº. de banheiros&nbsp;&nbsp;<?php echo $objConfiguracao->getBanheiro();?></td>
              </tr>
              <tr>
                <td height="6" colspan="2"></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2">N&deg;. de salas&nbsp;&nbsp;<?php echo $objConfiguracao->getSala();?></td>
              </tr>
              <tr>
                <td height="6" colspan="2"></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2">N&deg;. de suites&nbsp;&nbsp;<?php echo $objConfiguracao->getSuite();?></td>
              </tr>
              <tr>
                <td height="6" colspan="2"></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2">N&deg;. de garagens&nbsp;&nbsp;<?php echo $objConfiguracao->getGaragem();?></td>
              </tr>
              <tr>
                <td height="6" colspan="2"></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2"><?php echo ($objConfiguracao->getConstrutora()!=''?'Construtora '.$objConfiguracao->getConstrutora():'');?></td>
              </tr>
            </table>
        	<!-- Fim Tabela Descrio 02-->        </td>
		<td width="1" class="top_grupoDes_Bar"></td>
		<td colspan="2" class="grupoEI_fundo_01" valign="top">
        	<!-- Inicio Tabela Descrio 03-->
        	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
              <tr>
                <td width="12"></td>
                <td height="23"><span id="divIndiqueAmigo" style="position:absolute"></span></td>
              </tr>
              <tr>
                <td height="5" colspan="2"></td>
              </tr>
              <tr>
              	<td></td>
                <td colspan="2"><?php echo $objConfiguracao->getRetornoAreaUnidade(10, 18);?></td>
              </tr>
              <tr>
                <td height="6" colspan="2"></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2">Valor IPTU&nbsp;&nbsp;R$ <?php echo $objConfiguracao->getValorIptu();?></td>
              </tr>
              <tr>
                <td height="6" colspan="2"></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2">Valor Condomínio&nbsp;&nbsp;R$ <?php echo $objConfiguracao->getValorCondominio();?></td>
              </tr>
              <tr>
                <td height="6" colspan="2"></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2">Taxas Extras&nbsp;&nbsp;R$ <?php echo $objConfiguracao->getValorTaxasExtras();?></td>
              </tr>
              <tr>
                <td height="6" colspan="2"></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2"><?php echo $objConfiguracao->getTipoNegocio();?></td>
              </tr>
              <tr>
                <td height="6" colspan="2"></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2">
<?php if($objConfiguracao->getSubTipoNegocio() != "")
				{
					echo "Por período ".$objConfiguracao->getSubTipoNegocio();
				}
				
?>
				</td>
              </tr>
              <tr>
                <td height="6" colspan="2"></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2"><?php echo ($objConfiguracao->getEmpreendimento()!=''?'Empreendimento '.$objConfiguracao->getEmpreendimento():'');?></td>
              </tr>
            </table>
        	<!-- Fim Tabela Descrio 03-->
        </td>
		<td width="4" class="top_grupoDes_Med_D_01"></td>
		<td colspan="2" height="162"></td>
	</tr>
	<tr class="grupoES_fundo_02">
		<td class="top_grupoDes_Med_E_02"></td>
		<td colspan="2" rowspan="2" class="med_grupoArq_ico_inf"></td>
		<td colspan="8" rowspan="2" height="47" class="grupoES_fundo_02">
<!--
		//==================================================================================//
		//                            Retorna Lista de Arquivos do Imovel                   //
		//==================================================================================//
-->		
<?php if (!empty($_GET["id_imovel"]) || isset($_GET["id_imovel"]))
		{
			$linhas = $objConfiguracao->atribuirArrayArquivoInicial($objConexao, $_GET["id_imovel"], TRUE);
			if ($objConfiguracao->atribuirArrayArquivoInicial($objConexao, $_GET["id_imovel"]))
			{
				for ($i = $linhas; $i >= 1; $i--) 
				{
?>
					&nbsp;
					&nbsp;
					<img src="<?php echo $objConfiguracao->getDiretorioIcons().$objConfiguracao->getArray_str_iconeArquivosImovel($i);?>" width="16" height="16">
					<span class="adm_fonteTextoGrupo_01">
						<a href="<?php echo $objConfiguracao->getDirArqImovel().$objConfiguracao->getArray_str_diretorioArquivosImovel($i);?>#"  title="<?php echo $objConfiguracao->getArray_str_arquivosImovel($i);?>">
						<?php echo $objConfiguracao->ocupacaoString($objConfiguracao->getArray_str_arquivosImovel($i), 25);?>
						</a>
					</span>
<?php }
			}
		}

?>
<!--
		//==================================================================================//
		//                      Final Retorno Lista de Arquivos do Imovel                   //
		//==================================================================================//
-->	
		</td>
		<td class="top_grupoDes_Med_D_02"></td>
		<td colspan="2" height="30"></td>
	</tr>
	<tr>
		<td class="top_grupoDes_Med_E_02"></td>
		<td class="top_grupoDes_Med_D_02"></td>
		<td colspan="2" height="12"></td>
	</tr>
	<tr>
		<td class="top_grupoDes_Med_E_02"></td>
		<td colspan="10" class="grupoEI_fundo_03"></td>
		<td class="top_grupoDes_Med_D_02"></td>
		<td colspan="2" height="1"></td>
	</tr>
	<tr class="grupoES_fundo_02">
		<td class="top_grupoDes_Med_E_02"></td>
		<td colspan="2" rowspan="2" class="med_grupoDes_ico_inf"></td>
		<td colspan="8" rowspan="2" height="47" class="grupoES_fundo_02"><span class="adm_fonteFormGrupo_01"><?php echo $objConfiguracao->quebraTexto($objConfiguracao->getDescricaoImovel(), 116, 5);?></span></td>
		<td class="top_grupoDes_Med_D_02"></td>
		<td colspan="2" height="47"></td>
	</tr>
	<tr>
		<td class="grupoDI_esq03"></td>
		<td class="grupoDI_dir03"></td>
		<td colspan="2" height="12"></td>
	</tr>
	<tr>
	  	<td colspan="2" class="top_grupoDes_Botton_E"></td>
		<td colspan="8" class="top_grupoDes_Botton_M"></td>
		<td colspan="2" class="top_grupoDes_Botton_D"></td>
		<td colspan="2" height="3"></td>
	</tr>
	<tr>
		<td width="4"></td>
		<td width="3"></td>
		<td width="30"></td>
		<td width="223"></td>
		<td width="1"></td>
		<td width="183"></td>
		<td width="20"></td>
		<td width="12"></td>
		<td width="1"></td>
		<td width="269"></td>
		<td width="4"></td>
		<td width="4"></td>
		<td colspan="2"></td>
	  </tr>
</table>
<!--
===============================================================================================================================
Fim Tabela DESCRIO GALERIA DE FOTOS
===============================================================================================================================
-->        </td>
	</tr>
	<tr>
		<td colspan="26"><div id="grupoBase"></div></td>
	</tr>
	<tr>
		<td colspan="26"></td>
	</tr>
	<tr>
		<td width="5"></td>
	    <td width="4"></td>
	    <td width="4"></td>
	    <td width="156"></td>
	    <td width="5"></td>
	    <td width="4"></td>
	    <td width="5"></td>
	    <td width="3"></td>
	    <td width="1"></td>
	    <td width="4"></td>
	    <td width="173"></td>
	    <td width="7"></td>
	    <td width="1"></td>
	    <td width="20"></td>
	    <td width="76"></td>
	    <td width="4"></td>
	    <td width="6"></td>
	    <td width="4"></td>
	    <td width="84"></td>
	    <td width="46"></td>
	    <td width="65"></td>
	    <td width="72"></td>
	    <td width="3"></td>
	    <td width="4"></td>
	    <td width="4"></td>
	    <td width="5"></td>
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
</br>
<div class="adm_fonteBoton_01" align="center" >
Processado em: <?php echo $objConfiguracao->tempoProcessamento('FINAL');?> segundos, <?php echo $objConexao->getContadorQuery();?> Consultas
</div>
<!-- Para Paginacao da Galeria de Fotos-->
<input name="int_paginacaoGaleria" type="hidden" value="">
<!-- 
=========================
= CONTROLE DE PAGINAÇÃO	=
-->
<input id="int_paginacao" type="hidden" value="">
<input id="slc_ordenacao" type="hidden" value="">
<input id="slc_totalRegistrosTela" type="hidden" value="">
<!-- 
=========================
= CONTROLE DE SEGURANÇA	=
-->
<input id="codSec" type="hidden" value="<?php echo $cont;?>">
<input id="str_nomePagina" type="hidden" value="<?php echo $paginaAtual;?>">
<!-- 
=========================
=CONTROLE UPLOAD IMAGENS=
-->
<input id="str_acaoBotao" type="hidden" value="">
</form>
</body>
<script>
	var $arrayNome 	= new Array ('id_imovel','id_imagem','int_paginacaoGaleria');
	var $arrayValor = new Array (<?php echo $_GET["id_imovel"];?>,<?php echo $_GET["id_imagem"];?>);
	
	$disableBuscaSimples = true;//NÃO DEIXA EXECUTAR A BUSCA ENQUANTO NÃO CARREGAR O AJAX DE NOTICIAS.
	
	carregarPaginacao('galeriaFotos', retornaUrlAjax('ajaxComponenteGaleriaFotos.php', $arrayNome, $arrayValor), '', false);

	$grupoBase = <?php echo $_GET["resultado"];?>;
	if ($grupoBase == true)
	{
		$arrayNome 	= new Array ('int_paginacao','slc_totalRegistrosTela','slc_ordenacao');
		$arrayValor = new Array ();
		carregarPaginacao('grupoBase', retornaUrlAjax('ajaxComponenteResultados.php', $arrayNome, $arrayValor), 'Carregando Resultado da Busca...', 'Resultado');
	}else
	{
		carregar('grupoBase', 'ajaxcomponenteGrupoBase.php', '', false);
	}
	
	function indicarEsteImovel()
	{
		var $arrayNome 	= new Array ('id_imovelInd','id_imagemInd','int_paginacaoGaleria');
		var $arrayValor = new Array (<?php echo $_GET["id_imovel"];?>,<?php echo $_GET["id_imagem"];?>);
		carregarPaginacao('divIndiqueAmigo', retornaUrlAjax('ajaxComponente_IndiqueAmigo.php', $arrayNome, $arrayValor), '<div style="background-color:#FFFFFF; border: 1px solid #7f9db9;">Carregando...</div>', false);
	}

	function emailProprietario()
	{
		var $arrayNome 	= new Array ('','', '');
		var $arrayValor = new Array ("'", '<?php echo $objConfiguracao->getEmailProprietario();?>', "'");
		$str_emailProprietario = retornaUrlAjax('', $arrayNome, $arrayValor);

		$arrayNome 	= new Array ('id_imovelPro','id_imagemPro', 'str_emailProprietario', 'int_paginacaoGaleria');
		$arrayValor = new Array (<?php echo $_GET["id_imovel"];?>,<?php echo $_GET["id_imagem"];?>, $str_emailProprietario);
		carregarPaginacao('divEmailProprietario', retornaUrlAjax('ajaxComponente_EmailProprietario.php', $arrayNome, $arrayValor), '<div style="background-color:#FFFFFF; border: 1px solid #7f9db9;">Carregando...</div>', false);
	}	
</script>