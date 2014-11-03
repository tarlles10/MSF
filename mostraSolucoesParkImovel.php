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
			atribuirValoresFormulario('BuscaSimples');
			window.location ='#grupoBase';
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
		<td colspan="23" valign="top" align="center"><?php include ("componentes/componenteTopo.php");?></td>
	</tr>
	<tr>
		<td width="5"></td>
		<td colspan="20" height="5"></td>
		<td colspan="2" width="5" height="5"></td>
	</tr>
	<tr>
		<td height="22"></td>
		<td rowspan="3" valign="top" align="left">
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
<!--
===================================================
	Inicio tabela QuadroLateral
===================================================
--> 
		<table width="175" border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td width="1" height="23"></td>
			<td width="173"></td>
			<td width="1"></td>
		  </tr>
		  <tr>
			<td></td>
			<td align="center" valign="top"></td>
			<td></td>
		  </tr>
		  <tr>
		   <td height="284"></td>
		   <!-- Inicio Tabela Quadro Lateral Esquerdo -->
			<td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td height="7"></td>
				<td colspan="3" class="grupoQUADROLATERAL_TOP"></td>
			  </tr>
			  <tr>
				<td height="269"></td>
				<td class="grupoQUADROLATERAL_esq"></td>
				<!-- Inicio Tabela Conteudo Quadro Lateral Esquerdo -->
				<td class="grupoQUADROLATERAL_fundo_01" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="grupoQUADROLATERAL_fundo_02" align="center" valign="top"><span class="adm_fonteResTop_04">Nossos Produtos<span></td>
          </tr>
<?php if ($objConfiguracao->atribuirArrayArquivoInicial($objConexao))
			{
				for ($i = 8; $i >= 1; $i--) 
				{
?>
              <tr>
                <td class="<?php echo $objConfiguracao->getArray_grupoQUADROLATERAL_fundo($i);?>" align="left"><img src="<?php echo $objConfiguracao->getDiretorioIcons().$objConfiguracao->getArray_str_iconeArquivosImovel($i);?>" width="16" height="16"><span class="adm_fonteTextoGrupo_01">&nbsp;<a href="<?php echo $objConfiguracao->getDirArqImovel().$objConfiguracao->getArray_str_diretorioArquivosImovel($i);?>#"  title="<?php echo $objConfiguracao->getArray_str_arquivosImovel($i);?>"><?php echo $objConfiguracao->ocupacaoString($objConfiguracao->getArray_str_arquivosImovel($i), 25);?></a></span></td>
              </tr>
<?php }
			}else
			{
?>
				  <tr>
					<td class="grupoQUADROLATERAL_fundo_03">&nbsp;</td>
				  </tr>
				  <tr>
					<td class="grupoQUADROLATERAL_fundo_02"></td>
				  </tr>
				  <tr>
					<td class="grupoQUADROLATERAL_fundo_03"></td>
				  </tr>
				  <tr>
					<td class="grupoQUADROLATERAL_fundo_02"></td>
				  </tr>
				  <tr>
					<td class="grupoQUADROLATERAL_fundo_03"></td>
				  </tr>
				  <tr>
					<td class="grupoQUADROLATERAL_fundo_02"></td>
				  </tr>
				  <tr>
					<td class="grupoQUADROLATERAL_fundo_03"></td>
				  </tr>
				  <tr>
					<td class="grupoQUADROLATERAL_fundo_02"></td>
				  </tr>
				  <tr>
					<td class="grupoQUADROLATERAL_fundo_03"></td>
				  </tr>
<?php }
?> 
				</table></td>
				<!-- Fim Tabela Conteudo Quadro Lateral Esquerdo -->
				<td class="grupoQUADROLATERAL_dir"></td>
			  </tr>
			  <tr>
				<td height="6"></td>
				<td colspan="3" class="grupoQUADROLATERAL_botton"></td>
			  </tr>
			  <tr>
				<td></td>
				<td width="4"></td>
				<td width="165"></td>
				<td width="4"></td>
			  </tr>
			</table>
            </td>
			<td></td>
			<!-- Fim Tabela Conteudo Quadro Lateral Esquerdo -->
		  </tr>
		</table>
<!--
===================================================
	Final tabela Quadro Lateral
===================================================
-->
        
        </td>
		<td></td>
		<td colspan="3" class="adm_med_Bar_E"></td>
		<td colspan="13" class="med_Bar_M" style="width:561px;"><?php echo $objConfiguracao->montaItensMenuBarra($objConexao, 55)?></td>
		<td colspan="2" class="adm_med_Bar_D"></td>
		<td colspan="2" width="5" height="22"></td>
	</tr>
	<tr>
		<td height="5"></td>
		<td></td>
		<td colspan="18" height="5"></td>
		<td colspan="2" width="5"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td colspan="20" height="746" align="left" valign="top"><div id="mostrarPortal"></div></td>
	</tr>
	
	<tr>
		<td colspan="23"><div id="grupoBase"><?php include ("componentes/componenteBotton2.php");?></div></td>
	</tr>
	<tr>
		<td width="5"></td>
	    <td width="176"></td>
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
	carregar('mostrarPortal', 'ajaxComponente_Solucoes.php', 'Carregando Formulário', true);
</script>
