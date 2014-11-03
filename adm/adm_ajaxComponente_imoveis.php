<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina 			= "AcessDenied";
	$str_acessoMinimo 	= "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classImovel.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	$objImovel 	= new imovel($objConexao);

	if (isset($_POST["id_imovel"]) || !empty($_POST["id_imovel"]))
	{
		$id_imovel = $_POST["id_imovel"];
		if ($id_imovel != "")
		{
			$objImovel->atribuirQuery($objConexao, $objConfiguracao->anti_injection($id_imovel));
			$btn_botaoP		= 'button';
			$btn_botaoNAE	= 'button';
			$btn_botaoC		= 'hidden';
		}else
		{
			$btn_botaoP		= 'button';
			$btn_botaoNAE	= 'hidden';
			$btn_botaoC		= 'button';	
			$objImovel->inicializaVariaveis();
		}
	}else
	{
		$id_imovel 	= '';
		$btn_botaoP		= 'button';
		$btn_botaoNAE	= 'hidden';
		$btn_botaoC		= 'button';	
		$objImovel->inicializaVariaveis();
	}

	if (isset($_POST["str_acao"]) || !empty($_POST["str_acao"]))
	{
		switch ($_POST["str_acao"])
		{
			case 'Cadastrar':
				$objImovel->cadastrarImovel($objConexao);
				break;
			case 'Alterar':
				$objImovel->alterarImovel($objConexao);
				break;
			case 'Excluir':
				$objImovel->excluirImovel($objConexao);
				break;
		}
	}

	//============================================================================//
	//      Criptografa os Links das paginas Ajax que passa por referencia        //
	//============================================================================//
	$cont = $objConfiguracao->sequenceCrypt('', true, true);
	
	$paginaAnte  = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_proprietario.php', 2, true);
	$paginaAtual = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_imovel.php', $cont, true);	
	$paginaProx  = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_imagensImovel.php', 2, true);

?>
<script>
	function atribuirValoresFormulario($str_acao)
	{
		$continuaAcao = true;
		if ($str_acao == 'Excluir')
		{
			if(!(confirm("Atenção: \nEsta ação excluirá todas as fotos e arquivos cadastrados para este imóvel.\nClique em OK se deseja continuar.")))
			{
				$continuaAcao = false;
			}
		}
		if (validaCamposDefault() && $continuaAcao)
		{
			var $codSeq = <?php echo $cont;?>;
			
			var $arrayNome = new Array ('str_acao',
										'codSecFormulario',
										'id_imovel',
										'slc_proprietario',
										'slc_tipoImovel',
										'slc_subTipoImovel',
										'slc_situacaoImovel',
										'slc_mobiliado',
										'slc_quarto',
										'slc_sala',
										'slc_banheiro',
										'slc_suite',
										'slc_garagem',
										'str_areaPrivativa',
										'str_areaTerreno',
										'str_areaTotal',
										'slc_unidadePrivativa',
										'slc_unidadeTerreno',
										'slc_unidadeTotal',
										'slc_uf',
										'slc_municipios',
										'slc_bairro',
										'slc_tipoNegocio',
										'slc_subTipoNegocio',
										'str_valorImovel',
										'str_valorIptu',
										'str_valorCondominio',
										'str_valorTaxasExtras',
										'chk_verValorImovel',
										'chk_verValorOutros',
										'str_descricaoImovel',
										'str_dtEntrega',
										'slc_construtora',
										'slc_empreendimento',
										'chk_promocao',
										'chk_ativo'
										);
			f = document;
			d = document.frm;

			var $arrayValor = new Array 
			(
				retornaUrlAjax('', new Array ('"','','"'), 	new Array ('' ,$str_acao,'')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,$codSeq, '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.id_imovel.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,d.slc_proprietario.value, '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_tipoImovel.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_subTipoImovel.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_situacaoImovel.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_mobiliado.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_quarto.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_sala.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_banheiro.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_suite.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_garagem.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_areaPrivativa.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_areaTerreno.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_areaTotal.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_unidadePrivativa.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_unidadeTerreno.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_unidadeTotal.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_uf.value, $codSeq, true), '')),				
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_municipios.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_bairro.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_tipoNegocio.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_subTipoNegocio.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_valorImovel.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_valorIptu.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_valorCondominio.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_valorTaxasExtras.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('chk_verValorImovel').checked.toString().toUpperCase(), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('chk_verValorOutros').checked.toString().toUpperCase(), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_descricaoImovel.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_dtEntrega.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_construtora.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_empreendimento.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('chk_promocao').checked.toString().toUpperCase(), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('chk_ativo').checked.toString().toUpperCase(), $codSeq, true), ''))
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
			
			carregarConteudoMenu(1, $slc_totalRegistrosTela, $valorOrdenacao, sequenceCrypt(f.getElementById('str_nomePagina').value, f.getElementById('codSec').value, false), $cont, f.getElementById('id_proprietarioFixo').value);
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
    <td class="adm_med_grupoForm_top_02" align="center"><span class="adm_fonteResTop_01">Informa&ccedil;&atilde;o do Im&oacute;vel</span></td>
    <td class="adm_med_grupoForm_top_03"><input name="id_imovel" id="id_imovel" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $id_imovel;?>" ></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="right"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/passoForm2.png" width="87" height="30"></td>
        <td width="21"></td>
      </tr>
    </table></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05" align="center">
		<img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/imovelG.png" width="32" height="32">
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
                <td class="adm_formColor_01" align="right">Tipo de Neg&oacute;cio:&nbsp;</td>
                <td align="left">
                	<select name="slc_tipoNegocio" id="*" class="adm_formResCombo_01" style="width:139" onchange="controlePeriodoNegocio(this);" title="Tipo de Negócio" >
						<option value="Venda" <?php echo $objImovel->str_tipoNegocio=='Venda'?'selected':'';?> title="Venda" >Venda</option>
						<option value="Aluguel" <?php echo $objImovel->str_tipoNegocio=='Aluguel'?'selected':'';?> title="Aluguel" >Aluguel</option>
						<option value="Temporada" <?php echo $objImovel->str_tipoNegocio=='Temporada'?'selected':'';?> title="Temporada" >Temporada</option>
                    </select>
                <td colspan="2" class="adm_formColor_01" align="right">Situa&ccedil;&atilde;o do Im&oacute;vel:&nbsp;</td>
                <td colspan="3" align="left">
                	<select name="slc_situacaoImovel" id="*" class="adm_formResCombo_01" style="width:125" onchange="controleSituacaoImovel(this);" title="Situação do Imóvel" >
						<option value="Lançamento" <?php echo $objImovel->str_situacaoImovel=='Lançamento'?'selected':'';?> title="Lançamento" >Lançamento</option>
						<option value="Na Planta" <?php echo $objImovel->str_situacaoImovel=='Na Planta'?'selected':'';?> title="Na Planta" >Na Planta</option>
						<option value="Outros" <?php echo $objImovel->str_situacaoImovel=='Outros'?'selected':'';?> title="Outros" >Outros</option>
						<option value="Usado" <?php echo $objImovel->str_situacaoImovel=='Usado'?'selected':'';?> title="Usado" >Usado</option>
                	</select>
                </td>
              <tr>
                <td colspan="7" height="5"></td>
              </tr>
              <tr>
                <td width="25%" class="adm_formColor_01" align="right">Per&iacute;odo Neg&oacute;cio:&nbsp;</td>
                <td width="25%" align="left">
	                <select name="slc_subTipoNegocio" id="slc_subTipoNegocio" class="adm_formResCombo_01" <?php echo $objImovel->str_DisablePeriodoNegocio;?> title="Período Negócio">
						<option value="Diaria" <?php echo $objImovel->str_subTipoNegocio=='Diaria'?'selected':'';?> title="Diaria" >Diaria</option>
						<option value="Semanal" <?php echo $objImovel->str_subTipoNegocio=='Semanal'?'selected':'';?> title="Semanal" >Semanal</option>
						<option value="Quinzenal" <?php echo $objImovel->str_subTipoNegocio=='Quinzenal'?'selected':'';?> title="Quinzenal" >Quinzenal</option>
						<option value="Mensal" <?php echo $objImovel->str_subTipoNegocio=='Mensal'?'selected':'';?> title="Mensal" >Mensal</option>
                    </select>
					<span id="divDtEntrega" style="position:absolute"></span>
                </td>
                <td colspan="2" class="adm_formColor_01" align="right">Data Entrega:&nbsp;</td>
                <td colspan="3" align="left">
                <!-- inicio tabela campo Data -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="30"><input name="str_dtEntrega" id="str_dtEntrega" type="text" class="adm_formGrupoTxt_01" maxlength="10" value="<?php echo $objImovel->dt_entrega;?>" OnKeyPress="formataMascara('##/##/####', this); return retornaNumeros(event,this);" onblur="verificaData(this);" <?php echo $objImovel->str_DisableDt_Entrega;?>  title="Data Entrega"></td>
                        <td valign="bottom" align="left">&nbsp;<img src="icons/calendario.png" alt="Informe a Data" width="20" height="18" style="cursor:pointer;" onClick="popdate('document.frm.str_dtEntrega', 'divDtEntrega', '145', document.frm.str_dtEntrega.value, 'adm');" ></td>
                      </tr>
                    </table>
                <!-- fim tabela campo Data -->
                </td>
              </tr>
              <tr>
                <td colspan="7" height="6"></td>
              </tr>
              <tr>
                <td class="adm_formColor_01" align="right">Tipo de Im&oacute;vel:&nbsp;</td>
                <td align="left">
                	<select name="slc_tipoImovel" id="*" class="adm_formResCombo_01" style="width:139" onchange="enviaValorCarregarOutraCombo(this, 'adm_ajaxComponente_imovel_subTipoImovel.php', 'SubTipoImovel');" title="Tipo de Imóvel">
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
                <td colspan="2" class="adm_formColor_04" align="right">UF:&nbsp;</td>
                <td colspan="3" align="left">
                	<select name="slc_uf" id="*" class="adm_formResCombo_01" style="width:55" onchange="enviaValorUf(this, 'adm_ajaxComponente_imovel_uf.php');" title="UF" >
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
                <td colspan="7" height="6"></td>
              </tr>
              <tr>
                <td class="adm_formColor_01" align="right">Categoria Im&oacute;vel:&nbsp;</td>
                <td align="left">
				<div id="SubTipoImovel">
                    <select name="slc_subTipoImovel" id="slc_subTipoImovel" class="adm_formResCombo_01" style="width:139" title="Categoria Imóvel">
<?php if ($objImovel->str_tipoImovel != '')
				{
						$query = $objImovel->comboSubTipoImovel($objConexao, $objImovel->str_tipoImovel);
						while($array = $objConexao->retornaArray($query))
						{
							$cont++;
							if($cont == 1)
							{
								echo '<option title="selecione Tipo de Imóvel" value="">:: selecione Tipo de Imóvel ::</option>';
							}
?>
				  			<option value="<?php echo $objImovel->codifiStringBancoInterface($objConexao, $array['str_subtipoimovel']);?>"<?php echo $objImovel->str_tipoImovel == $array['str_subtipoimovel']?'selected':'';?> title="<?php echo $objImovel->codifiStringBancoInterface($objConexao, $array['str_subtipoimovel']);?>"><?php echo $objImovel->codifiStringBancoInterface($objConexao, $array['str_subtipoimovel']);?></option>
<?php }
					}else
				{
?>
					<option title="selecione Tipo de Imóvel" value="">:: selecione Tipo de Imóvel ::</option>
<?php }
?>					
                    </select>
				</div>
                </td>
                <td colspan="2" class="adm_formColor_04" align="right">Munic&iacute;pio:&nbsp;</td>
                <td colspan="3" align="left">
					<div id="Municipio">
						<select name="slc_municipios" id="*" class="adm_formResCombo_01" style="width:125" onchange="enviaValorMunicipio(this, 'adm_ajaxComponente_imovel_municipio.php');" title="Município">
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
                <td colspan="7" height="6"></td>
              </tr>
              <tr>
                <td class="adm_formColor_02" align="right">N&ordm;. de quartos:&nbsp;</td>
                <td align="left">
               	  <select name="slc_quarto" id="slc_quarto" class="adm_formResCombo_01" style="width:55" title="Nº. de quartos">
					  <option value="0" <?php echo $objImovel->int_quarto=='0'?'selected':'';?> title="0" >0</option>
					  <option value="1" <?php echo $objImovel->int_quarto=='1'?'selected':'';?> title="1" >1</option>
					  <option value="2" <?php echo $objImovel->int_quarto=='2'?'selected':'';?> title="2" >2</option>
					  <option value="3" <?php echo $objImovel->int_quarto=='3'?'selected':'';?> title="3" >3</option>
					  <option value="4" <?php echo $objImovel->int_quarto=='4'?'selected':'';?> title="4" >4</option>
					  <option value="5" <?php echo $objImovel->int_quarto=='5'?'selected':'';?> title="5" >5</option>
					  <option value="6" <?php echo $objImovel->int_quarto=='6'?'selected':'';?> title="6" >6</option>
					  <option value="7" <?php echo $objImovel->int_quarto=='7'?'selected':'';?> title="7" >7</option>
					  <option value="8" <?php echo $objImovel->int_quarto=='8'?'selected':'';?> title="8" >8</option>
					  <option value="9" <?php echo $objImovel->int_quarto=='9'?'selected':'';?> title="9" >9</option>
               	  </select>
                </td>
                <td colspan="2" class="adm_formColor_04" align="right">Bairro:&nbsp;</td>
                <td colspan="3" align="left">
					<div id="Bairro">
						<select name="slc_bairro" id="*" class="adm_formResCombo_01" style="width:125" title="Bairro">
<?php if ($objImovel->id_municipio != '')
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
?>
						</select>
					</div>
				</td>
              </tr>
              <tr>
                <td colspan="7" height="6"></td>
              </tr>
              <tr>
                <td class="adm_formColor_02" align="right">N&ordm;. de salas:&nbsp;</td>
                <td align="left">
               	  <select name="slc_sala" id="slc_sala" class="adm_formResCombo_01" style="width:55" title="Nº. de salas" >
					  <option value="0" <?php echo $objImovel->int_sala=='0'?'selected':'';?> title="0" >0</option>
					  <option value="1" <?php echo $objImovel->int_sala=='1'?'selected':'';?> title="1" >1</option>
					  <option value="2" <?php echo $objImovel->int_sala=='2'?'selected':'';?> title="2" >2</option>
					  <option value="3" <?php echo $objImovel->int_sala=='3'?'selected':'';?> title="3" >3</option>
					  <option value="4" <?php echo $objImovel->int_sala=='4'?'selected':'';?> title="4" >4</option>
					  <option value="5" <?php echo $objImovel->int_sala=='5'?'selected':'';?> title="5" >5</option>
					  <option value="6" <?php echo $objImovel->int_sala=='6'?'selected':'';?> title="6" >6</option>
					  <option value="7" <?php echo $objImovel->int_sala=='7'?'selected':'';?> title="7" >7</option>
					  <option value="8" <?php echo $objImovel->int_sala=='8'?'selected':'';?> title="8" >8</option>
					  <option value="9" <?php echo $objImovel->int_sala=='9'?'selected':'';?> title="9" >9</option>
               	  </select>
                </td>
                <td colspan="2" class="adm_formColor_05" align="right">Propriet&aacute;rio:&nbsp;</td>
                <td colspan="3" align="left">
				<div id="proprietario">
					<select name="slc_proprietario" class="adm_formResCombo_01" style="width:125" title="Proprietário" >
					<option value="">:: selecione ::</option>
<?php $query = $objImovel->comboProprietario($objConexao);
						while($array = $objConexao->retornaArray($query))
						{
?>
				  			<option value="<?php echo $array['id_proprietario'];?>" <?php echo $objImovel->id_proprietario == $array['id_proprietario']?'selected':'';?> title="<?php echo $objImovel->codifiStringBancoInterface($objConexao, $array['str_nomeproprietario']);?>" ><?php echo $objImovel->codifiStringBancoInterface($objConexao, $array['str_nomeproprietario']);?></option>
<?php }
?>					
                	</select>
				</div>
				</td>
              </tr>
              <tr>
                <td colspan="7" height="6"></td>
              </tr>
              <tr>
                <td class="adm_formColor_02" align="right">N&ordm;. de banheiros:&nbsp;</td>
                <td align="left">
               	  <select name="slc_banheiro" id="slc_banheiro" class="adm_formResCombo_01" style="width:55" title="Nº. de banheiros" >
				  	<option value="0" <?php echo $objImovel->int_banheiro=='0'?'selected':'';?> title="0" >0</option>
					<option value="1" <?php echo $objImovel->int_banheiro=='1'?'selected':'';?> title="1" >1</option>
					<option value="2" <?php echo $objImovel->int_banheiro=='2'?'selected':'';?> title="2" >2</option>
					<option value="3" <?php echo $objImovel->int_banheiro=='3'?'selected':'';?> title="3" >3</option>
					<option value="4" <?php echo $objImovel->int_banheiro=='4'?'selected':'';?> title="4" >4</option>
					<option value="5" <?php echo $objImovel->int_banheiro=='5'?'selected':'';?> title="5" >5</option>
					<option value="6" <?php echo $objImovel->int_banheiro=='6'?'selected':'';?> title="6" >6</option>
					<option value="7" <?php echo $objImovel->int_banheiro=='7'?'selected':'';?> title="7" >7</option>
					<option value="8" <?php echo $objImovel->int_banheiro=='8'?'selected':'';?> title="8" >8</option>
					<option value="9" <?php echo $objImovel->int_banheiro=='9'?'selected':'';?> title="9" >9</option>
               	  </select>                </td>
                <td colspan="2" class="adm_formColor_03" align="right"> IPTU R$:&nbsp;</td>
                <td colspan="3" align="left">
                	<!-- inicio tabela campo Deixar Visivel -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="30"><input name="str_valorIptu" id="*" type="text" class="adm_formGrupoTxt_01" maxlength="22" onKeyDown="return formataValorDinheiro(this,22,event);" OnKeyPress="return retornaNumeros(event,this);" value="<?php echo $objImovel->str_valorIptu;?>" <?php echo $objImovel->str_DisableVerValorOutros;?> title="IPTU"></td>
                        <td valign="bottom" align="left"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/setaFormUp.gif" width="13" height="16"></td>
                      </tr>
                    </table>
                <!-- fim tabela campo Deixar Visivel -->
				</td>
              </tr>
              <tr>
                <td colspan="7" height="6"></td>
              </tr>
              <tr>
                <td class="adm_formColor_02" align="right">N&ordm;. de su&iacute;tes:&nbsp;</td>
                <td align="left">
               	  <select name="slc_suite" id="slc_suite" class="adm_formResCombo_01" style="width:55" title="Nº. de suítes" >
				  	<option value="0" <?php echo $objImovel->int_suite=='0'?'selected':'';?> title="0" >0</option>
					<option value="1" <?php echo $objImovel->int_suite=='1'?'selected':'';?> title="1" >1</option>
					<option value="2" <?php echo $objImovel->int_suite=='2'?'selected':'';?> title="2" >2</option>
					<option value="3" <?php echo $objImovel->int_suite=='3'?'selected':'';?> title="3" >3</option>
					<option value="4" <?php echo $objImovel->int_suite=='4'?'selected':'';?> title="4" >4</option>
					<option value="5" <?php echo $objImovel->int_suite=='5'?'selected':'';?> title="5" >5</option>
					<option value="6" <?php echo $objImovel->int_suite=='6'?'selected':'';?> title="6" >6</option>
					<option value="7" <?php echo $objImovel->int_suite=='7'?'selected':'';?> title="7" >7</option>
					<option value="8" <?php echo $objImovel->int_suite=='8'?'selected':'';?> title="8" >8</option>
					<option value="9" <?php echo $objImovel->int_suite=='9'?'selected':'';?> title="9" >9</option>
               	  </select>
                </td>
                <td colspan="2" class="adm_formColor_03" align="right"> Condom&iacute;nio R$:&nbsp;</td>
                <td colspan="3" align="left">
                	<!-- inicio tabela campo Deixar Visivel -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="30"><input name="str_valorCondominio" id="str_valorCondominio" type="text" class="adm_formGrupoTxt_01" maxlength="22" onkeydown="return formataValorDinheiro(this,22,event);" onkeypress="return retornaNumeros(event,this);" value="<?php echo $objImovel->str_valorCondominio;?>" <?php echo $objImovel->str_DisableVerValorOutros;?> title="Condomínio" /></td>
                      <td valign="bottom" align="left"><input name="chk_verValorOutros" id="chk_verValorOutros" type="checkbox" <?php echo $objImovel->bln_verValorOutros=='t'?'checked':'';?> onclick="guardaValorIniciado(this);  disableArrayCampoOponente(this, new Array ('str_valorIptu','str_valorCondominio','str_valorTaxasExtras'));"  onchange="guardaValorIniciado(this); disableArrayCampoOponente(this, new Array ('str_valorIptu','str_valorCondominio','str_valorTaxasExtras'));" title="Deixa o valor visível aos visitantes"/><input id="chk_verValorOutrosAux" type="hidden" value="<?php echo $objImovel->bln_verValorOutrosAux;?>">Vis&iacute;vel</td>
                      </tr>
                    </table>
                <!-- fim tabela campo Deixar Visivel -->
				</td>
              </tr>
              <tr>
                <td colspan="7" height="6"></td>
              </tr>
              <tr>
                <td class="adm_formColor_02" align="right">N&ordm;. de garagens:&nbsp;</td>
                <td align="left">
               	  <select name="slc_garagem" id="slc_garagem" class="adm_formResCombo_01" style="width:55" title="Nº. de garagens">
				  	<option value="0" <?php echo $objImovel->int_garagem=='0'?'selected':'';?> title="0" >0</option>
					<option value="1" <?php echo $objImovel->int_garagem=='1'?'selected':'';?> title="1" >1</option>
					<option value="2" <?php echo $objImovel->int_garagem=='2'?'selected':'';?> title="2" >2</option>
					<option value="3" <?php echo $objImovel->int_garagem=='3'?'selected':'';?> title="3" >3</option>
					<option value="4" <?php echo $objImovel->int_garagem=='4'?'selected':'';?> title="4" >4</option>
					<option value="5" <?php echo $objImovel->int_garagem=='5'?'selected':'';?> title="5" >5</option>
					<option value="6" <?php echo $objImovel->int_garagem=='6'?'selected':'';?> title="6" >6</option>
					<option value="7" <?php echo $objImovel->int_garagem=='7'?'selected':'';?> title="7" >7</option>
					<option value="8" <?php echo $objImovel->int_garagem=='8'?'selected':'';?> title="8" >8</option>
					<option value="9" <?php echo $objImovel->int_garagem=='9'?'selected':'';?> title="9" >9</option>
               	  </select>
                </td>
                <td colspan="2" class="adm_formColor_03" align="right">Taxas Extras R$:&nbsp;</td>
                <td colspan="3" align="left">
                	<!-- inicio tabela campo Deixar Visivel -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="30"><input name="str_valorTaxasExtras" id="str_valorTaxasExtras" type="text" class="adm_formGrupoTxt_01" maxlength="22" onKeyDown="return formataValorDinheiro(this,22,event);" OnKeyPress="return retornaNumeros(event,this);" value="<?php echo $objImovel->str_valorTaxasExtras;?>" <?php echo $objImovel->str_DisableVerValorOutros;?> title="Taxas Extras" ></td>
                        <td valign="bottom" align="left"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/setaFormDown.gif" width="13" height="16"></td>
                      </tr>
                    </table>
                <!-- fim tabela campo Deixar Visivel -->
				</td>
              </tr>
              <tr>
                <td colspan="7" height="6"></td>
              </tr>
              <tr>
                <td class="adm_formColor_02" align="right">Interior Im&oacute;vel:&nbsp;</td>
                <td align="left">
	                <select name="slc_mobiliado" id="slc_mobiliado" class="adm_formResCombo_01" style="width:139;" title="Interior Imóvel">
						<option value="Não Mobiliado" <?php echo $objImovel->str_mobiliado=='Não Mobiliado'?'selected':'';?>  title="Não Mobiliado" >Não Mobiliado</option>
						<option value="Semi Mobiliado" <?php echo $objImovel->str_mobiliado=='Semi Mobiliado'?'selected':'';?>  title="Semi Mobiliado" >Semi Mobiliado</option>
						<option value="Mobiliado" <?php echo $objImovel->str_mobiliado=='Mobiliado'?'selected':'';?>  title="Mobiliado" >Mobiliado</option>
                    </select>
				</td>
                <td colspan="2" class="adm_formColor_03" align="right">Valor R$:&nbsp;</td>
                <td colspan="3" align="left">
                	
                	<!-- inicio tabela campo Deixar Visivel -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="30"><input name="str_valorImovel" id="*" type="text" class="adm_formGrupoTxt_01" maxlength="22" onKeyDown="return formataValorDinheiro(this,22,event);" OnKeyPress="return retornaNumeros(event,this);"  value="<?php echo $objImovel->str_valorImovel;?>" <?php echo $objImovel->str_DisableVerValorImovel;?> title="Valor" ></td>
                        <td valign="bottom" align="left"><input name="chk_verValorImovel" id="chk_verValorImovel" type="checkbox" <?php echo $objImovel->bln_verValorImovel=='t'?'checked':'';?> onclick="guardaValorIniciado(this); disableCampoOponente(this, 'str_valorImovel');"  onchange="guardaValorIniciado(this);" title="Deixa o valor visível aos visitantes" /><input id="chk_verValorImovelAux" type="hidden" value="<?php echo $objImovel->bln_verValorImovelAux;?>">Vis&iacute;vel</td>
                      </tr>
                    </table>
                <!-- fim tabela campo Deixar Visivel -->
				
                </td>
              </tr>
              <tr>
                <td colspan="7" height="6"></td>
              </tr>
              <tr>
                <td align="right">&Aacute;rea Terreno:&nbsp;</td>
                <td align="left"><input name="str_areaTerreno" type="text" class="adm_formGrupoTxt_01" style="width:65;" maxlength="30" OnKeyPress="return retornaNumeros(event,this);" value="<?php echo $objImovel->str_areaTerreno;?>" title="Área Terreno">
	                <select name="slc_unidadeTerreno" id="slc_unidadeTerreno" class="adm_formResCombo_01" style="width:69" >
						<option value="Metro(s) Quadrados" <?php echo $objImovel->str_unidadeTerreno=='Metro(s) Quadrados'?'selected':'';?>  title="Metro(s) Quadrados" >Metro(s) Quadrados</option>
						<option value="Quilometro(s) Quadrados" <?php echo $objImovel->str_unidadeTerreno=='Quilometro(s) Quadrados'?'selected':'';?>  title="Quilometro(s) Quadrados" >Quilometro(s) Quadrados</option>
						<option value="Hectar(es)" <?php echo $objImovel->str_unidadeTerreno=='Hectar(es)'?'selected':'';?>  title="Hectar(es)" >Hectar(es)</option>
						<option value="Acre(s)" <?php echo $objImovel->str_unidadeTerreno=='Acre(s)'?'selected':'';?>  title="Acre(s)" >Acre(s)</option>
						<option value="Alqueires Paulistas" <?php echo $objImovel->str_unidadeTerreno=='Alqueires Paulistas'?'selected':'';?>  title="Alqueires Paulistas" >Alqueires Paulistas</option>
						<option value="Alqueires Mineiros" <?php echo $objImovel->str_unidadeTerreno=='Alqueires Mineiros'?'selected':'';?>  title="Alqueires Mineiros" >Alqueires Mineiros</option>
						<option value="Alqueires Baianos" <?php echo $objImovel->str_unidadeTerreno=='Alqueires Baianos'?'selected':'';?>  title="Alqueires Baianos" >Alqueires Baianos</option>
						<option value="Alqueires do Norte" <?php echo $objImovel->str_unidadeTerreno=='Alqueires do Norte'?'selected':'';?>  title="Alqueires do Norte" >Alqueires do Norte</option>					
                    </select>
                </td>
                <td colspan="2" align="right">Construtora:&nbsp;</td>
                <td colspan="3" align="left">
                	<select name="slc_construtora" id="slc_construtora" class="adm_formResCombo_01" style="width:125" onchange="enviaValorCarregarOutraCombo(this, 'adm_ajaxComponente_imovel_empreendimento.php', 'Empreendimento');" title="Construtora">
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
                <td colspan="7" height="6"></td>
              </tr>
              <tr>
                <td align="right">&Aacute;rea Privativa:&nbsp;</td>
                <td align="left"><input name="str_areaPrivativa" type="text" class="adm_formGrupoTxt_01" style="width:65;" maxlength="30" OnKeyPress="return retornaNumeros(event,this);" value="<?php echo $objImovel->str_areaPrivativa;?>" title="Área Privativa">
	                <select name="slc_unidadePrivativa" id="slc_unidadePrivativa" class="adm_formResCombo_01" style="width:69" >
						<option value="Metro(s) Quadrados" <?php echo $objImovel->str_unidadePrivativa=='Metro(s) Quadrados'?'selected':'';?>  title="Metro(s) Quadrados" >Metro(s) Quadrados</option>
						<option value="Quilometro(s) Quadrados" <?php echo $objImovel->str_unidadePrivativa=='Quilometro(s) Quadrados'?'selected':'';?>  title="Quilometro(s) Quadrados" >Quilometro(s) Quadrados</option>
						<option value="Hectar(es)" <?php echo $objImovel->str_unidadePrivativa=='Hectar(es)'?'selected':'';?>  title="Hectar(es)" >Hectar(es)</option>
						<option value="Acre(s)" <?php echo $objImovel->str_unidadePrivativa=='Acre(s)'?'selected':'';?>  title="Acre(s)" >Acre(s)</option>
						<option value="Alqueires Paulistas" <?php echo $objImovel->str_unidadePrivativa=='Alqueires Paulistas'?'selected':'';?>  title="Alqueires Paulistas" >Alqueires Paulistas</option>
						<option value="Alqueires Mineiros" <?php echo $objImovel->str_unidadePrivativa=='Alqueires Mineiros'?'selected':'';?>  title="Alqueires Mineiros" >Alqueires Mineiros</option>
						<option value="Alqueires Baianos" <?php echo $objImovel->str_unidadePrivativa=='Alqueires Baianos'?'selected':'';?>  title="Alqueires Baianos" >Alqueires Baianos</option>
						<option value="Alqueires do Norte" <?php echo $objImovel->str_unidadePrivativa=='Alqueires do Norte'?'selected':'';?>  title="Alqueires do Norte" >Alqueires do Norte</option>
                    </select>
                </td>
                <td colspan="2" align="right">Empreendimento:&nbsp;</td>
                <td colspan="3" align="left">
				<div id="Empreendimento">
                	<select name="slc_empreendimento" id="slc_empreendimento" class="adm_formResCombo_01" style="width:125" title="Empreendimento" >
<?php if ($objImovel->str_construtora != '')
				{					
					$query = $objImovel->comboEmpreendimento($objConexao, $objImovel->str_construtora);
					while($array = $objConexao->retornaArray($query))
					{
						$cont++;
						if($cont == 1)
						{
							echo '<option title="selecione a Construtora" value="">:: selecione Construtora ::</option>';
						}
?>
						<option value="<?php echo $objImovel->codifiStringBancoInterface($objConexao, $array['str_empreendimento']);?>" <?php echo $objImovel->str_empreendimento == $array['str_empreendimento']?'selected':'';?> title="<?php echo $objImovel->codifiStringBancoInterface($objConexao, $array['str_empreendimento']);?>" ><?php echo $objImovel->codifiStringBancoInterface($objConexao, $array['str_empreendimento']);?></option>
<?php }
				}else
				{
?>
					<option title="selecione a Construtora" value="">:: selecione Construtora ::</option>
<?php }
?>
                    </select>
				</div>
                </td>
              </tr>

              <tr>
                <td colspan="7" height="6"></td>
              </tr>
              <tr>
                <td align="right">&Aacute;rea Total:&nbsp;</td>
                <td align="left"><input name="str_areaTotal" id="*" type="text" class="adm_formGrupoTxt_01" style="width:65;" maxlength="30" OnKeyPress="return retornaNumeros(event,this);" value="<?php echo $objImovel->str_areaTotal;?>" title="Área Total">
	                <select name="slc_unidadeTotal" id="slc_unidadeTotal" class="adm_formResCombo_01" style="width:69" >
						<option value="Metro(s) Quadrados" <?php echo $objImovel->str_unidadeTotal=='Metro(s) Quadrados'?'selected':'';?>  title="Metro(s) Quadrados" >Metro(s) Quadrados</option>
						<option value="Quilometro(s) Quadrados" <?php echo $objImovel->str_unidadeTotal=='Quilometro(s) Quadrados'?'selected':'';?>  title="Quilometro(s) Quadrados" >Quilometro(s) Quadrados</option>
						<option value="Hectar(es)" <?php echo $objImovel->str_unidadeTotal=='Hectar(es)'?'selected':'';?>  title="Hectar(es)" >Hectar(es)</option>
						<option value="Acre(s)" <?php echo $objImovel->str_unidadeTotal=='Acre(s)'?'selected':'';?>  title="Acre(s)" >Acre(s)</option>
						<option value="Alqueires Paulistas" <?php echo $objImovel->str_unidadeTotal=='Alqueires Paulistas'?'selected':'';?>  title="Alqueires Paulistas" >Alqueires Paulistas</option>
						<option value="Alqueires Mineiros" <?php echo $objImovel->str_unidadeTotal=='Alqueires Mineiros'?'selected':'';?>  title="Alqueires Mineiros" >Alqueires Mineiros</option>
						<option value="Alqueires Baianos" <?php echo $objImovel->str_unidadeTotal=='Alqueires Baianos'?'selected':'';?>  title="Alqueires Baianos" >Alqueires Baianos</option>
						<option value="Alqueires do Norte" <?php echo $objImovel->str_unidadeTotal=='Alqueires do Norte'?'selected':'';?>  title="Alqueires do Norte" >Alqueires do Norte</option>						
                    </select>
				</td>
                <td colspan="2" align="right">Promo&ccedil;&atilde;o:&nbsp;</td>
                <td align="left"><input name="chk_promocao" id="chk_promocao" type="checkbox" <?php echo $objImovel->bln_promocao=='t'?'checked':'';?> onclick="guardaValorIniciado(this);"  onchange="guardaValorIniciado(this);" title="Promoção"/><input id="chk_promocaoAux" type="hidden" value="<?php echo $objImovel->bln_promocaoAux;?>"></td>
                <td colspan="2" align="left">
                	<!-- inicio tabela campo Ativo -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="37" align="right">&nbsp;&nbsp;Ativo:&nbsp;</td>
                        <td width="94" align="left" valign="bottom"><input name="chk_ativo" id="chk_ativo" type="checkbox" <?php echo $objImovel->bln_ativo=='t'?'checked':'';?> onclick="guardaValorIniciado(this);"  onchange="guardaValorIniciado(this);" title="Ativo" /><input id="chk_ativoAux" type="hidden" value="<?php echo $objImovel->bln_ativoAux;?>"></td>
                      </tr>
                    </table>
                	<!-- fim tabela campo Ativo -->                
                </td>
              </tr>
              <tr>
                <td colspan="7" height="6"></td>
              </tr>
              <tr>
                <td align="right">Descri&ccedil;&atilde;o:&nbsp;</td>
                <td colspan="6" align="left"><input name="str_descricaoImovel" type="text" class="adm_formGrupoTxt_01" style="width:384;" maxlength="276" value="<?php echo $objImovel->str_descricaoImovel;?>" title="Descrição"></td>
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
		//                           Botões do Formulário                             //
		//============================================================================//
-->	
        	<table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center">
                    <input name="btSubmit" type="<?php echo $btn_botaoP;?>" class="adm_formBotao_02" value="Anterior" onclick="carregaProximoAnterior('<?php echo $paginaAnte;?>', '2', false, 'id_proprietarioFixo');">
                    	&nbsp;&nbsp;
                	<input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" class="adm_formBotao_01" value="Novo" onclick="atribuirItem();">
                    	&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoC;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Cadastrar" onclick="atribuirValoresFormulario('Cadastrar');">
                    	&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Alterar" onclick="atribuirValoresFormulario('Alterar');">
                    	&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Excluir" onclick="atribuirValoresFormulario('Excluir');">
                    	&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" class="adm_formBotao_02" value="Próximo" onclick="carregaProximoAnterior('<?php echo $paginaProx;?>', '2', true, 'id_imovelFixo', document.frm.id_imovel.value);">					
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
//condição para atribuir o id_fixo ao comboProprietario
	if (document.getElementById('id_proprietarioFixo').value != '')
	{
			var $arrayNome 	= new Array ('"','','"');
			var $arrayValor = new Array ('',document.getElementById('id_proprietarioFixo').value,'');
			$id_proprietario = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			$arrayNome 	= new Array ('id_proprietario');
			$arrayValor = new Array ($id_proprietario);
			carregarPaginacao('Proprietario', retornaUrlAjax('adm_ajaxComponente_imovel_proprietario.php', $arrayNome, $arrayValor), 'aguarde...', 'formulario');		
	}
</script>