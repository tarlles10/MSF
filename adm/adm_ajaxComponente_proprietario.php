<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina 			= "AcessDenied";
	$str_acessoMinimo 	= "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classProprietario.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	$objProprietario 	= new proprietario($objConexao);

	if (isset($_POST["id_proprietario"]) || !empty($_POST["id_proprietario"]))
	{
		$id_proprietario = $_POST["id_proprietario"];
		if ($id_proprietario != "")
		{
			$objProprietario->atribuirQuery($objConexao, $objConfiguracao->anti_injection($id_proprietario));
			$btn_botaoP		= 'button';
			$btn_botaoNAE	= 'button';
			$btn_botaoC		= 'hidden';
		}else
		{
			$btn_botaoP		= 'button';
			$btn_botaoNAE	= 'hidden';
			$btn_botaoC		= 'button';	
			$objProprietario->inicializaVariaveis();
		}
	}else
	{
		$id_proprietario = '';
		$btn_botaoP		 = 'button';
		$btn_botaoNAE	 = 'hidden';
		$btn_botaoC		 = 'button';	
		$objProprietario->inicializaVariaveis();
	}

	if (isset($_POST["str_acao"]) || !empty($_POST["str_acao"]))
	{
		switch ($_POST["str_acao"])
		{
			case 'Cadastrar':
				$objProprietario->cadastrarProprietario($objConexao);
				break;
			case 'Alterar':
				$objProprietario->alterarProprietario($objConexao);
				break;
			case 'Excluir':
				$objProprietario->excluirProprietario($objConexao);
				break;
		}
	}

	//============================================================================//
	//      Criptografa os Links das paginas Ajax que passa por referencia        //
	//============================================================================//
	$cont = $objConfiguracao->sequenceCrypt('', true, true);
	
	$paginaAtual = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_proprietario.php', $cont, true);	
	$paginaProx  = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_imoveis.php', 	  2, 	 true);
	

?>
<script>
	function atribuirValoresFormulario($str_acao)
	{
		$continuaAcao = true;
		if ($str_acao == 'Excluir')
		{
			if(!(confirm("Atenção: \nEsta ação excluirá os dados deste proprietário e o vinculo dos imoveis cadastrados para ele.\nClique em OK se deseja continuar.")))
			{
				$continuaAcao = false;
			}
		}
		if (validaCamposDefault() && $continuaAcao)
		{
			var $codSeq = <?php echo $cont;?>;
			
			var $arrayNome = new Array ('str_acao',
										'codSecFormulario',
										'id_proprietario',
										'str_nomeProprietario',
										'str_profissaoProprietario',
										'str_cpfProprietario',
										'str_nacionalidadeProprietario',
										'str_naturalidadeProprietario',
										'str_complemento',
										'slc_uf',
										'slc_municipios',
										'slc_bairro',
										'slc_descricaoLogradouro',
										'str_telResidencialProprietario',
										'str_telComercialProprietario',
										'str_telCelularProprietario',
										'str_emailProprietario',
										'chk_verTelResidencialProprietario',
										'chk_verTelComercialProprietario',
										'chk_verTelCelularProprietario',
										'chk_verEmailProprietario'
										);
			f = document;
			d = document.frm;

			var $arrayValor = new Array 
			(
				retornaUrlAjax('', new Array ('"','','"'), 	new Array ('' ,$str_acao,'')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,$codSeq, '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.id_proprietario.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_nomeProprietario.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_profissaoProprietario.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_cpfProprietario.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_nacionalidadeProprietario.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_naturalidadeProprietario.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_complemento.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_uf.value, $codSeq, true), '')),				
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_municipios.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_bairro.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_descricaoLogradouro.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_telResidencialProprietario.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_telComercialProprietario.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_telCelularProprietario.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_emailProprietario.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('chk_verTelResidencialProprietario').checked.toString().toUpperCase(), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('chk_verTelComercialProprietario').checked.toString().toUpperCase(), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('chk_verTelCelularProprietario').checked.toString().toUpperCase(), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('chk_verEmailProprietario').checked.toString().toUpperCase(), $codSeq, true), ''))				
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
    <td class="adm_med_grupoForm_top_02" align="center"><span class="adm_fonteResTop_01">Propriet&aacute;rio do Im&oacute;vel</span></td>
    <td class="adm_med_grupoForm_top_03"><input name="id_proprietario" id="id_proprietario" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $id_proprietario;?>" ></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="right"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/passoForm1.png" width="87" height="30"></td>
        <td width="21"></td>
      </tr>
    </table></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05" align="center">
		<img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/proprietarioG.png" width="32" height="32">
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
                <td align="right">Nome Propriet&aacute;rio:&nbsp;</td>
                <td align="left">
                	<input name="str_nomeProprietario" id="*" type="text" class="adm_formGrupoTxt_01" style="width: 125px;" maxlength="70" value="<?php echo $objProprietario->str_nomeProprietario;?>" onblur="validaNomeProprio(this);" title="Nome Proprietário">
                <td colspan="2" align="right">Naturalidade:&nbsp;</td>
                <td colspan="3" align="left">
					<input name="str_naturalidadeProprietario" id="*" type="text" class="adm_formGrupoTxt_01" style="width: 125px;" maxlength="70" value="<?php echo $objProprietario->str_nacionalidadeProprietario;?>" onblur="validaNomeProprio(this);" title="Naturalidade">
                </td>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td width="25%" align="right">Cpf:&nbsp;</td>
                <td width="25%" align="left"><input name="str_cpfProprietario" id="*" type="text" class="adm_formGrupoTxt_01"  style="width: 125px;" maxlength="14" value="<?php echo $objProprietario->str_cpfProprietario;?>" OnKeyPress="return retornaNumeros(event,this);" OnKeyDown="return gerenciaCpf(event, this);" onBlur="validaCampoCpf(this);" title="CPF" >
				</td>
                <td colspan="2" align="right">Nacionalidade:&nbsp;</td>
                <td colspan="3" align="left">
					<input name="str_nacionalidadeProprietario" id="*" type="text" class="adm_formGrupoTxt_01" style="width: 125px;" maxlength="70" value="<?php echo $objProprietario->str_nacionalidadeProprietario;?>" onblur="validaNomeProprio(this);" title="Nacionalidade"></td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Profiss&atilde;o:&nbsp;</td>
                <td align="left">
               	  <input name="str_profissaoProprietario" id="*" type="text" class="adm_formGrupoTxt_01" style="width: 125px;" maxlength="70" value="<?php echo $objProprietario->str_profissaoProprietario;?>" onblur="validaNomeProprio(this);" title="Profissão">
                </td>
                <td colspan="2" align="right">E-mail:&nbsp;</td>
                <td colspan="3" align="left">
				<!-- inicio tabela campo Deixar Visivel -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="30"><input name="str_emailProprietario" id="*" type="text" class="adm_formGrupoTxt_01" maxlength="40" value="<?php echo $objProprietario->str_emailProprietario;?>" onblur="validaCampoEmail(this);" title="E-mail" <?php echo $objProprietario->str_DisableEmailProprietario;?> ></td>
                        <td valign="bottom" align="left"><input name="chk_verEmailProprietario" id="chk_verEmailProprietario" type="checkbox" <?php echo $objProprietario->bln_verEmailProprietario=='t'?'checked':'';?> onclick="guardaValorIniciado(this); disableCampoOponente(this, 'str_emailProprietario');"  onchange="guardaValorIniciado(this);" title="Permitir que o proprietário receba emails dos visitantes" /><input id="chk_verEmailProprietarioAux" type="hidden" value="<?php echo $objProprietario->bln_verEmailProprietarioAux;?>">Vis&iacute;vel</td>
                      </tr>
                    </table>
                <!-- fim tabela campo Deixar Visivel -->
				</td>
              </tr>              
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">UF:&nbsp;</td>
                <td align="left">
                	<select name="slc_uf" id="*" class="adm_formResCombo_01" style="width:55" onchange="enviaValorUf(this, 'adm_ajaxComponente_proprietario_uf.php');" title="UF" >
					<option value="">:: UF ::</option>
<?php $query = $objProprietario->comboUF($objConexao);
						while($array = $objConexao->retornaArray($query))
						{
?>
				  			<option value="<?php echo $array['str_uf'];?>" <?php echo $objProprietario->str_uf == $array['str_uf']?'selected':'';?> ><?php echo $array['str_uf'];?></option>
<?php }
?>
					</select>
				</td>
                <td colspan="2" align="right">Tel. Residencial:&nbsp;</td>
                <td colspan="3" align="left">
					<!-- inicio tabela campo Deixar Visivel -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="30"><input name="str_telResidencialProprietario" id="*" type="text" class="adm_formGrupoTxt_01" maxlength="12" value="<?php echo $objProprietario->str_telResidencialProprietario;?>" OnKeyPress="formataMascara('## ####-####', this); return retornaNumeros(event,this);" onBlur="validaCampoTelefone(this);" <?php echo $objProprietario->str_DisableTelResidencialProprietario;?> title="Tel. Residencial"></td>
                        <td valign="bottom" align="left"><input name="chk_verTelResidencialProprietario" id="chk_verTelResidencialProprietario" type="checkbox" <?php echo $objProprietario->bln_verTelResidencialProprietario=='t'?'checked':'';?> onclick="guardaValorIniciado(this); disableCampoOponente(this, 'str_telResidencialProprietario');"  onchange="guardaValorIniciado(this);" title="Permitir que o telefone residencial fique visível aos visitantes" /><input id="chk_verTelResidencialProprietarioAux" type="hidden" value="<?php echo $objProprietario->bln_verTelResidencialProprietarioAux;?>">Vis&iacute;vel</td>
                      </tr>
                    </table>
                <!-- fim tabela campo Deixar Visivel -->
                </td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Munic&iacute;pio:&nbsp;</td>
                <td align="left">
					<div id="Municipio">
						<select name="slc_municipios" id="*" class="adm_formResCombo_01" style="width:125" onchange="enviaValorMunicipio(this, 'adm_ajaxComponente_proprietario_municipio.php');" title="Município">
<?php if ($objProprietario->str_uf!='')
				{
					$query = $objProprietario->comboMunicipio($objConexao, $objProprietario->str_uf);
					while($array = $objConexao->retornaArray($query))
					{
						$cont++;
						if($cont == 1)
						{
							echo '<option value="">:: selecione ::</option>';
						}
?>
						<option value="<?php echo $array['id_municipio'];?>" <?php echo ($objProprietario->id_municipio == $array['id_municipio']||$objProprietario->str_municipios==$array['str_municipios'])?'selected':'';?> title="<?php echo $objProprietario->codifiStringBancoInterface($objConexao, ucwords($array['str_municipios']));?>" ><?php echo $objProprietario->codifiStringBancoInterface($objConexao, ucwords($array['str_municipios']));?></option>
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
                <td colspan="2" align="right">Tel. Comercial:&nbsp;</td>
                <td colspan="3" align="left">
				<!-- inicio tabela campo Deixar Visivel -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="30"><input name="str_telComercialProprietario" id="*" type="text" class="adm_formGrupoTxt_01" maxlength="12" value="<?php echo $objProprietario->str_telComercialProprietario;?>" OnKeyPress="formataMascara('## ####-####', this); return retornaNumeros(event,this);" onBlur="validaCampoTelefone(this);" <?php echo $objProprietario->str_DisableTelComercialProprietario;?> title="Tel. Comercial"></td>
                        <td valign="bottom" align="left"><input name="chk_verTelComercialProprietario" id="chk_verTelComercialProprietario" type="checkbox" <?php echo $objProprietario->bln_verTelComercialProprietario=='t'?'checked':'';?> onclick="guardaValorIniciado(this); disableCampoOponente(this, 'str_telComercialProprietario');"  onchange="guardaValorIniciado(this);" title="Permitir que o telefone comercial fique visível aos visitantes" /><input id="chk_verTelComercialProprietarioAux" type="hidden" value="<?php echo $objProprietario->bln_verTelComercialProprietarioAux;?>">Vis&iacute;vel</td>
                      </tr>
                    </table>
                <!-- fim tabela campo Deixar Visivel -->
				</td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Bairro:&nbsp;</td>
                <td align="left">
					<div id="Bairro">
						<select name="slc_bairro" id="*" class="adm_formResCombo_01" style="width:125" title="Bairro">
<?php if ($objProprietario->id_municipio != '')
				{
					$query = $objProprietario->comboBairro($objConexao, $objProprietario->id_municipio);
					while($array = $objConexao->retornaArray($query))
					{
						$cont++;
						if($cont == 1)
						{
							echo '<option value="">:: selecione ::</option>';
						}
?>
						<option value="<?php echo $array['id_bairro'];?>" <?php echo $objProprietario->id_bairro == $array['id_bairro']?'selected':'';?> title="<?php echo $objProprietario->codifiStringBancoInterface($objConexao, ucwords($array['str_bairro']));?>" ><?php echo $objProprietario->codifiStringBancoInterface($objConexao, ucwords($array['str_bairro']));?></option>
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
                <td colspan="2" align="right">Tel. Celular:&nbsp;</td>
                <td colspan="3" align="left">
					<!-- inicio tabela campo Deixar Visivel -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="30"><input name="str_telCelularProprietario" id="*" type="text" class="adm_formGrupoTxt_01" maxlength="12" value="<?php echo $objProprietario->str_telCelularProprietario;?>" OnKeyPress="formataMascara('## ####-####', this); return retornaNumeros(event,this);" onBlur="validaCampoTelefone(this);" <?php echo $objProprietario->str_DisableTelCelularProprietario;?> title="Tel. Celular"></td>
                        <td valign="bottom" align="left"><input name="chk_verTelCelularProprietario" id="chk_verTelCelularProprietario" type="checkbox" <?php echo $objProprietario->bln_verTelCelularProprietario=='t'?'checked':'';?> onclick="guardaValorIniciado(this); disableCampoOponente(this, 'str_telCelularProprietario');"  onchange="guardaValorIniciado(this);" title="Permitir que o número Celular fique visível aos visitantes" /><input id="chk_verTelCelularProprietarioAux" type="hidden" value="<?php echo $objProprietario->bln_verTelCelularProprietarioAux;?>">Vis&iacute;vel</td>
                      </tr>
                    </table>
                <!-- fim tabela campo Deixar Visivel -->
				</td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Logradouro:&nbsp;</td>
                <td align="left">
					<div id="Logradouro">
						<select name="slc_descricaoLogradouro" id="*" class="adm_formResCombo_01" style="width:125" title="Logradouro">
<?php if ($objProprietario->id_bairro != '')
				{
					$query = $objProprietario->comboLogradouro($objConexao, $objProprietario->id_bairro);
					while($array = $objConexao->retornaArray($query))
					{
						$cont++;
						if($cont == 1)
						{
							echo '<option value="">:: selecione ::</option>';
						}
?>
						<option value="<?php echo $array['id_numerocep'];?>" <?php echo $objProprietario->id_numeroCep == $array['id_numerocep']?'selected':'';?> title="<?php echo $objProprietario->codifiStringBancoInterface($objConexao, ucwords($array['str_descricaologradouro']));?>" ><?php echo $objProprietario->codifiStringBancoInterface($objConexao, ucwords($array['str_descricaologradouro']));?></option>
<?php }
				}else
				{
?>
					<option value="" title=":: selecione Bairro::">:: selecione Bairro::</option>
<?php }
?>
						</select>
					</div>                  
                </td>
                <td colspan="2" align="right">Complemento:&nbsp;</td>
                <td colspan="3" align="left"><input name="str_complemento" id="*" type="text" class="adm_formGrupoTxt_01" style="width: 125px;" maxlength="45" value="<?php echo $objProprietario->str_complemento;?>" onblur="validaNomeProprio(this);" title="Complemento"></td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td colspan="7" background="<?php echo $objConfiguracao->getDirTheme();?>/adm_med_fundo_Inf.gif" style="height: 128px;" align="center" valign="top">
                    <table border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="56"></td>
                        <td colspan="3" class="adm_fonteFormInf_01" height="22">Este formul&aacute;rio permite salvar os dados do propriet&aacute;rio do im&oacute;vel. </td>
                      </tr>
                      <tr>
                        <td colspan="4" height="6"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td width="75" align="right" class="adm_fonteFormInf_02" style="vertical-align:text-top;">Pr&oacute;ximo -&nbsp;</td>
                        <td width="429">Caso n&atilde;o exista ou n&atilde;o queira vincular um propriet&aacute;rio ao respectivo<br/>imov&eacute;l v&aacute; direto  para o pr&oacute;ximo passo do cadastro de imóveis.<br/>Para vizualizar apenas os im&oacute;veis de determinado proprietario,<br/>basta selecionalo na lista abaixo e clicar no bot&atilde;o pr&oacute;ximo.						</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td width="75" align="right" class="adm_fonteFormInf_02" style="vertical-align:text-top;">Anterior -&nbsp;</td>
                        <td width="429">Esta op&ccedil;&atilde;o fica acess&iacute;vel para retroceder um passo no<br/>cadastro dos im&oacute;veis.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
                      </tr>
                    </table>                </td>
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
                    <input name="btSubmit" type="<?php echo $btn_botaoP;?>" class="adm_formBotao_02" value="Próximo" onclick="carregaProximoAnterior('<?php echo $paginaProx;?>', '2', true, 'id_proprietarioFixo', document.frm.id_proprietario.value);">
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