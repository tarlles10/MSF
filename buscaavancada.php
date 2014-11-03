<?php 
	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");
	include("class/classImovel.php");
	
	$objImovel 	= new imovel($objConexao);	
	$objImovel->inicializaVariaveisAvancadas();

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

	//============================================================================//
	//      Controle de filtro do plano contratado pelo usuario dono do portal.   //
	//============================================================================//
	$objConfiguracao->getBln_construtoras(true);
	$objConfiguracao->getBln_empreendimentos(true);
	$objConfiguracao->getBln_subTipoImovel(true);
	$objConfiguracao->getBln_valorIptu(true);
	$objConfiguracao->getBln_valorCondominio(true);
	$objConfiguracao->getBln_sala(true);
	$objConfiguracao->getBln_banheiro(true);
	$objConfiguracao->getBln_suite(true);
	$objConfiguracao->getBln_garagem(true);
	$objConfiguracao->getBln_uf(true);
	$objConfiguracao->getBln_municipio(true);
	$objConfiguracao->getBln_dtentrega(true);
	
		
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
									'slc_tipoValor',//final parametros da busca simples
									'chk_temporada',
									'slc_subTipoImovel',
									'slc_construtora',
									'slc_empreendimento',
									'slc_sala',
									'slc_banheiro',
									'str_dtEntrega',
									'slc_uf',
									'slc_municipios',
									'slc_garagem',
									'slc_suite'
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
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_tipoValor').value, $codSeq, true), '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('chk_temporada').checked.toString().toUpperCase(), $codSeq, true), '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_subTipoImovel').value, $codSeq, true), '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_construtora').value, $codSeq, true), '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_empreendimento').value, $codSeq, true), '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,f.getElementById('slc_sala').value, '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,f.getElementById('slc_banheiro').value, '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_dtEntrega.value, $codSeq, true), '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,f.getElementById('slc_uf').value, '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,f.getElementById('slc_municipios').value, '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,f.getElementById('slc_garagem').value, '')),
			retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,f.getElementById('slc_suite').value, ''))
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
			if($disableBuscaSimples == false)
			{
				atribuirValoresFormulario('BuscaAvancada');
				window.location ='#grupoBase';
			}else
			{
				
				alertMenssage ('Aviso:','Aguarde o carregamento...');
			}
		}
		else
		{
			window.location = 'index.php';
		}
	}
	window.status = "";
</script>
<body bgcolor="#FFFFFF">
<form name="frm" method="post" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
<!--
===============================================================================================================================
Incio tabela
===============================================================================================================================
-->
<table width="766" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="28" valign="bottom" align="center"><?php include ("componentes/componenteTopo.php");?></td>
	</tr>
	<tr>
	  	<td width="5"></td>
		<td colspan="25" height="5"></td>
		<td height="5" colspan="2"></td>
	</tr>
	<tr>
		<td width="5"></td>
		<td colspan="14" rowspan="3" class="menuAvnEsq_top"></td>
		<td rowspan="15" class="menuAvnEsq_botao" onClick="go('simples');" title="Busca Fácil"></td>
		<td rowspan="15">&nbsp;</td>
		<td colspan="2" class="adm_med_Bar_E"></td>
		<td colspan="5" class="med_Bar_M" style="width:266px;"><?php echo $objConfiguracao->montaItensMenuBarra($objConexao, 30)?></td>
		<td colspan="2" class="adm_med_Bar_D"></td>
		<td height="22" colspan="2"></td>
	</tr>
	<tr>
		<td width="5"></td>
		<td colspan="9" height="10"></td>
		<td height="10" colspan="2"></td>
	</tr>
	<tr>
		<td width="5"></td>
		<td rowspan="2" width="4"></td>
		<!-- Inicio Tabela Banner Banner Medio Curto -->
		<td colspan="7" rowspan="2">
<?php $objConfiguracao->atribuirBanner($objConexao, 'Banner Medio Curto');
			echo $objConfiguracao->getDiretorioBanner();	
?>		
		</td>
		<td rowspan="2" width="4"></td>
		<td height="5" colspan="2"></td>
	</tr>
	<tr>
		<td width="6"></td>
		<td colspan="3" rowspan="12" class="menuAvnEsq_fundo_01"  valign="top" align="right">
			<!-- Inicio do Menu_01 -->
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
                	<select name="slc_tipoImovel" id="slc_tipoImovel" class="adm_formResCombo_01" style="width:127" onChange="enviaValorCarregarOutraCombo(this, 'ajaxComponente_imovel_subTipoImovel.php', 'SubTipoImovel', '<?php echo  $objConfiguracao->getDirTheme();?>');" title="Tipo de Imóvel">
					<option value="">:: selecione ::</option>
<?php $query = $objImovel->comboTipoImovel($objConexao);
						while($array = $objConexao->retornaArray($query))
						{
?>
				  			<option value="<?php echo $array['str_tipoimovel'];?>" <?php echo $objImovel->str_tipoImovel == $array['str_tipoimovel']?'selected':'';?> title="<?php echo $array['str_tipoimovel'];?>"><?php echo $array['str_tipoimovel'];?></option>
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
                        <td colspan="4">Palavra - Chave</td>
                      </tr>
                      <tr>
                        <td colspan="5" height="5"></td>
                      </tr>
                      <tr>
                        <td width="11"></td>
                        <td colspan="4">
							<input name="str_descricaoImovel" id="str_descricaoImovel" type="text" class="adm_formGrupoTxt_01" style="width:127;" maxlength="128">
						</td>
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
                        <td colspan="5" height="5"></td>
                      </tr>
                      <tr>
                        <td width="11"></td>
                        <td colspan="4">N&ordm;. de banheiros</td>
                      </tr>
                      <tr>
                        <td colspan="5" height="5"></td>
                      </tr>
                      <tr>
                        <td width="11"></td>
                        <td colspan="4">
							<select name="slc_banheiro" id="slc_banheiro" class="adm_formResCombo_01" style="width:55" <?php echo $objConfiguracao->getBln_banheiro(true, 'N.º de banheiros');?>>
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
                        <td colspan="5" align="right"></td>
                      </tr>
                    </table>
			<!-- Fim do Menu_01 -->        </td>
		<td rowspan="12" class="menuAvnEsq_barra_01"></td>
		<td colspan="4" rowspan="12" class="menuAvnEsq_fundo_02" valign="top" align="right">
			<!-- Inicio do Menu_02 -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteMenuEsq_01">
              <tr>
                <td colspan="3" height="5"></td>
              </tr>
              <tr>
                <td width="11"></td>
              	<td width="20"><input name="chk_temporada" id="chk_temporada" type="checkbox" onClick="guardaValorIniciado(this);"  onchange="guardaValorIniciado(this);" title="Temporada"/><input id="chk_temporadaAux" type="hidden" value="<?php echo $objImovel->bln_temporadaAux;?>"></td>
                <td>Temporada</td>
                </tr>
              <tr>
                <td colspan="3" height="5"></td>
              </tr>
              <tr>
              	<td></td>
              	<td colspan="2">Categoria do Im&oacute;vel</td>
              </tr>
              <tr>
                <td colspan="3" height="5"></td>
              </tr>
              <tr>
              	<td width="11"></td>
              	<td colspan="2">
				<div id="SubTipoImovel">
                    <select name="slc_subTipoImovel" class="adm_formResCombo_01" id="slc_subTipoImovel" style="width:127" <?php echo $objConfiguracao->getBln_subTipoImovel(true, 'Categoria Imóvel');?>>
<?php if ($objImovel->str_tipoImovel != '')
					{
						$query = $objImovel->comboSubTipoImovel($objConexao, $objImovel->str_tipoImovel);
						while($array = $objConexao->retornaArray($query))
						{
							$cont++;
							if($cont == 1)
							{
								echo '<option value="">:: selecione ::</option>';
							}
?>
				  			<option value="<?php echo $objImovel->codifiStringBancoInterface($objConexao, $array['str_subtipoimovel']);?>"<?php echo $objImovel->str_tipoImovel == $array['str_subtipoimovel']?'selected':'';?> title="<?php echo $objImovel->codifiStringBancoInterface($objConexao, $array['str_subtipoimovel']);?>"><?php echo $objImovel->codifiStringBancoInterface($objConexao, $array['str_subtipoimovel']);?></option>
<?php }
					}else
					{
?>
						<option title="selecione o Tipo de Imóvel" value="">:: selecione o Tipo de Imóvel ::</option>
<?php }
?>
?>					
                    </select>
				</div>				
				</td>
              </tr>
              <tr>
                <td colspan="3" height="5"></td>
              </tr>
              <tr>
              	<td width="11"></td>
              	<td colspan="2">Construtora</td>
              </tr>
              <tr>
                <td colspan="3" height="5"></td>
              </tr>
              <tr>
              	<td width="11"></td>
              	<td colspan="2">
                	<select name="slc_construtora" id="slc_construtora" class="adm_formResCombo_01" style="width:125" onChange="enviaValorCarregarOutraCombo(this, 'ajaxComponente_imovel_empreendimento.php', 'Empreendimento', '<?php echo  $objConfiguracao->getDirTheme();?>');" <?php echo $objConfiguracao->getBln_construtoras(true,'Construtora');?> >
					<option value="">:: selecione ::</option>
<?php $query = $objImovel->comboConstrutora($objConexao);
						while($array = $objConexao->retornaArray($query))
						{
?>
				  			<option value="<?php echo $objImovel->codifiStringBancoInterface($objConexao, $array['str_construtora']);?>" <?php echo $objImovel->str_construtora == $array['str_construtora']?'selected':'';?> title="<?php echo $objImovel->codifiStringBancoInterface($objConexao, $array['str_construtora']);?>" ><?php echo $objImovel->codifiStringBancoInterface($objConexao, $array['str_construtora']);?></option>
<?php }
?>                    
					</select>				
				</td>
              </tr>
              <tr>
                <td colspan="3" height="5"></td>
              </tr>
              <tr>
              	<td width="11"></td>
              	<td colspan="2">Empreendimento</td>
              </tr>
              <tr>
                <td colspan="3" height="5"></td>
              </tr>
              <tr>
              	<td width="11"></td>
              	<td colspan="2">
				<div id="Empreendimento">
                	<select name="slc_empreendimento" id="slc_empreendimento" class="adm_formResCombo_01" style="width:125" <?php echo $objConfiguracao->getBln_empreendimentos(true, 'Empreendimento');?> >
<?php if ($objImovel->str_construtora != '')
					{
						$query = $objImovel->comboEmpreendimento($objConexao, $objImovel->str_construtora);
						while($array = $objConexao->retornaArray($query))
						{
							$cont++;
							if($cont == 1)
							{
								echo '<option value="">:: selecione ::</option>';
							}
?>
							<option value="<?php echo $objImovel->codifiStringBancoInterface($objConexao, $array['str_empreendimento']);?>" <?php echo $objImovel->str_municipios == $array['str_empreendimento']?'selected':'';?> title="<?php echo $objImovel->codifiStringBancoInterface($objConexao, $array['str_empreendimento']);?>" ><?php echo $objImovel->codifiStringBancoInterface($objConexao, $array['str_empreendimento']);?></option>
<?php }
					}else
					{
?>
						<option title="selecione a Construtora" value="">:: selecione a Construtora ::</option>
<?php }
?>
                    </select>
				</div>				
				</td>
              </tr>
              <tr>
                <td colspan="3" height="5"></td>
              </tr>
              <tr>
              	<td width="11"></td>
              	<td colspan="2">N&ordm;. de salas</td>
              </tr>
              <tr>
                <td colspan="3" height="5"></td>
              </tr>
              <tr>
              	<td width="11"></td>
              	<td colspan="2">
					<select name="slc_sala" id="slc_sala" class="adm_formResCombo_01" style="width:55" <?php echo $objConfiguracao->getBln_sala(true, 'N.º de salas');?> >
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
                <td colspan="3" height="5"></td>
              </tr>
              <tr>
              	<td width="11" height="15"></td>
              	<td colspan="2">N&ordm;. de garagens</td>
              </tr>
              <tr>
                <td colspan="3" height="5"></td>
              </tr>
              <tr>
              	<td width="11"></td>
              	<td colspan="2">
					<select name="slc_garagem" id="slc_garagem" class="adm_formResCombo_01" style="width:55" <?php echo $objConfiguracao->getBln_garagem(true, 'N.º de garagens');?> >
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
                <td colspan="3" height="49"></td>
              </tr>
              <tr>
                <td colspan="3" height="5"></td>
              </tr>
              <tr>
                <td colspan="3" class="menuAvnEsq_fundoTitulo_02">&nbsp;&nbsp;&nbsp;Pesquisa por Data:</td>
              </tr>
              <tr>
                <td colspan="3" height="8"></td>
              </tr>
              <tr>
              <!-- inicio tabela por Data -->
                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteMenuEsq_01">
                  <tr>
                    <td width="11"></td>
                    <td>Entrega&nbsp;<input name="str_dtEntrega" type="text" class="adm_formGrupoTxt_01" style="width:70;" maxlength="10" value="<?php echo $objImovel->dt_entrega;?>" OnKeyPress="formataMascara('##/##/####', this); return retornaNumeros(event,this);" onBlur="verificaData(this);"  <?php echo $objConfiguracao->getBln_dtentrega(true, 'Data de Entrega');?> ></td>
                        <td width="40" valign="bottom" align="left" class="adm_fonteCalendario" <?php echo $objConfiguracao->getBln_dtentrega(true, 'Data de Entrega')=='disabled title="Filtro Indisponível"'?'style="display:none;"':'';?> >&nbsp;<img src="adm/icons/calendario.png" alt="Informe a Data" width="20" height="18" style="cursor:pointer;" onClick="popdate('document.frm.str_dtEntrega', 'divDtEntrega', '150', document.frm.str_dtEntrega.value, '');"><span id="divDtEntrega" style="position:absolute"></span></td>
                  </tr>
                </table></td>
              <!-- Fim tabela BuscaPreo -->
              </tr>
              <tr>
              	<td colspan="3" height="22"></td>
              </tr>
              <tr>
              	<td colspan="2" align="right"></td>
              </tr>
            </table>
			<!-- Fim do Menu_02 -->
        </td>
		<td rowspan="12" class="menuAvnEsq_barra_02"></td>
		<td colspan="5" rowspan="12" class="menuAvnEsq_fundo_03" valign="top" align="right">
			<!-- Inicio do Menu_03 -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteMenuEsq_01">
              <tr>
                <td colspan="2" height="30"></td>
              </tr>
              <tr>
              	<td></td>
              	<td>UF</td>
              </tr>
              <tr>
                <td colspan="2" height="5"></td>
              </tr>
              <tr>
              	<td width="5"></td>
              	<td>
                	<select name="slc_uf" id="slc_uf" class="adm_formResCombo_01" style="width:55" onChange="enviaValorUf(this, 'ajaxComponente_imovel_uf.php', '<?php echo  $objConfiguracao->getDirTheme();?>');" <?php echo $objConfiguracao->getBln_uf(true, 'UF');?> title="UF" >
					<option value="">:: UF ::</option>
<?php $query = $objImovel->comboUF($objConexao);
						while($array = $objConexao->retornaArray($query))
						{
?>
				  			<option value="<?php echo $array['str_uf'];?>" <?php echo $objImovel->str_uf == $array['str_uf']?'selected':'';?> ><?php echo $array['str_uf'];?></option>
<?php }
?>
					</select>                
				</td>
              </tr>
              <tr>
                <td colspan="2" height="5"></td>
              </tr>
              <tr>
              	<td width="5"></td>
              	<td>Munic&iacute;pio</td>
              </tr>
              <tr>
                <td colspan="2" height="5"></td>
              </tr>
              <tr>
              	<td width="5"></td>
              	<td>
                <div id="Municipio">
                    <select name="slc_municipios" id="slc_municipio" class="adm_formResCombo_01" style="width:125" onChange="enviaValorMunicipio(this, 'ajaxComponente_imovel_municipio.php', '<?php echo  $objConfiguracao->getDirTheme();?>');" <?php echo $objConfiguracao->getBln_municipio(true, 'Município');?> title="Município">
<?php if ($objImovel->str_uf!='')
            {
                $query = $objImovel->comboMunicipio($objConexao, $objImovel->str_uf);
                while($array = $objConexao->retornaArray($query))
                {
                    $cont++;
                    if($cont == 1)
                    {
                        echo '<option value="">:: selecione ::</option>';
                    }
?>
                    <option value="<?php echo $array['id_municipio'];?>" <?php echo ($objImovel->id_municipio == $array['id_municipio']||$objImovel->str_municipios==$array['str_municipios'])?'selected':'';?> title="<?php echo $objImovel->codifiStringBancoInterface($objConexao, ucwords($array['str_municipios']));?>" ><?php echo $objImovel->codifiStringBancoInterface($objConexao, ucwords($array['str_municipios']));?></option>
<?php }
            }else
            {
?>
                <option title="selecione a UF" value="">:: selecione a UF ::</option>
<?php }
?>
                    </select>
                </div>                
				</td>
              </tr>
              <tr>
                <td colspan="2" height="5"></td>
              </tr>
              <tr>
              	<td width="5"></td>
              	<td>Bairro</td>
              </tr>
              <tr>
                <td colspan="2" height="5"></td>
              </tr>
              <tr>
              	<td width="5"></td>
              	<td>
                <div id="Bairro">
                    <select name="slc_bairro" id="slc_bairro" class="adm_formResCombo_01" style="width:125" title="Bairro">
<?php if ($objConfiguracao->getBln_uf(true) == 'disabled title="Filtro Indisponível"')
				{
					echo '<option value="">:: selecione ::</option>';
					$query = $objImovel->comboBairroUf($objConexao, $objConfiguracao->getUfPadrao());
					while($array = $objConexao->retornaArray($query))
					{
?>
					<option value="<?php echo $array['id_bairro'];?>" <?php echo $objImovel->id_bairro == $array['id_bairro']?'selected':'';?> title="<?php echo $objImovel->codifiStringBancoInterface($objConexao, ucwords($array['str_bairro']));?>" ><?php echo $objImovel->codifiStringBancoInterface($objConexao, ucwords($array['str_bairro']));?></option>
<?php }
				}else
				{
					if ($objImovel->id_municipio != '')
					{
						$query = $objImovel->comboBairro($objConexao, $objImovel->id_municipio);
						while($array = $objConexao->retornaArray($query))
						{
							$cont++;
							if($cont == 1)
							{
								echo '<option value="">:: selecione ::</option>';
							}
?>
							<option value="<?php echo $array['id_bairro'];?>" <?php echo $objImovel->id_bairro == $array['id_bairro']?'selected':'';?> title="<?php echo $objImovel->codifiStringBancoInterface($objConexao, ucwords($array['str_bairro']));?>" ><?php echo $objImovel->codifiStringBancoInterface($objConexao, ucwords($array['str_bairro']));?></option>
<?php }
					}else
					{
?>
						<option value="" title=":: selecione Município::">:: selecione Município::</option>
<?php }
				}
?>
                    </select>
                </div>                
				</td>
              </tr>
              <tr>
                <td colspan="2" height="5"></td>
              </tr>
              <tr>
              	<td width="5" height="15"></td>
              	<td>N&ordm;. de su&iacute;tes</td>
              </tr>
              <tr>
                <td colspan="2" height="5"></td>
              </tr>
              <tr>
              	<td width="5"></td>
              	<td>
					<select name="slc_suite" id="slc_suite" class="adm_formResCombo_01" style="width:55" <?php echo $objConfiguracao->getBln_suite(true, 'N.º de suítes');?>>
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
              	<td colspan="2" align="right" valign="bottom" height="230">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteMenuEsq_01">
                        <tr>
                            <td width="15"></td>
                            <td align="left"><input name="btSubmit" type="button" class="formBotao_04" value="" onClick="document.all.frm.reset();" title="Limpar Consulta"></td>
                            <td align="right"><input name="btSubmit" type="button" class="formBotao_02" value="" onClick="go('buscaravancada')" title="Buscar"></td>
                        </tr>
                    </table>                
                </td>
              </tr>
            </table>
			<!-- Fim do Menu_03 -->        </td>
		<td height="59" colspan="2"></td>
	</tr>
	<tr>
		<td width="5"></td>
		<td colspan="9" height="12"></td>
		<td height="12" colspan="2"></td>
	</tr>
	<tr>
		<td width="5" height="23"></td>
        <!-- Inicio tabela GrupoConteudoAvancado -->
		<td colspan="11" rowspan="10" valign="top" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><?php include ("componentes/componenteGrupoConteudo02.php");?></td>
            <td width="2"></td>
          </tr>
        </table></td>
        <!-- Final tabela GrupoConteudoAvancado -->
	</tr>
	<tr>
		<td width="5" height="161"></td>
		</tr>
	<tr>
		<td width="5" height="5"></td>
	</tr>
	<tr>
		<td width="5" height="3"></td>
	</tr>
	<tr>
	  	<td width="5" height="6"></td>
	</tr>
	<tr>
	  	<td width="5" height="23"></td>
	</tr>
	<tr>
	  	<td width="5" height="99"></td>
	</tr>
	<tr>
	  	<td width="5" height="23"></td>
	</tr>
	<tr>
	  	<td width="5" height="12"></td>
	</tr>
	<tr>
	  	<td width="5" height="3"></td>
	</tr>
	<tr>
		<td colspan="28" height="5"></td>
	</tr>
	<tr>
		<td colspan="28"><div id="grupoBase"></div></td>
	</tr>
	<tr>
		<td colspan="28"></td>
	</tr>
	<tr>
		<td width="5"></td>
		<td width="4"></td>
		<td width="4"></td>
		<td width="150"></td>
		<td	></td>
		<td width="10"></td>
		<td width="4"></td>
		<td width="5"></td>
		<td width="141"></td>
		<td	></td>
		<td width="38"></td>
		<td width="8"></td>
		<td	></td>
		<td width="18"></td>
		<td width="72"></td>
		<td width="10"></td>
		<td width="5"></td>
		<td width="4"></td>
		<td width="4"></td>
		<td width="80"></td>
		<td width="46"></td>
		<td width="65"></td>
		<td width="72"></td>
		<td width="3"></td>
		<td width="4"></td>
		<td width="4"></td>
		<td width="5"></td>
		<td ></td>
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
	$grupoBase = <?php echo $_GET["resultado"];?>;
	if (!$grupoBase)
	{
		carregar('grupoBase', 'ajaxComponenteGrupoBase.php', '', false);	
	}
</script>
