<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina 			= "AcessDenied";
	$str_acessoMinimo 	= "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classContratos.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	$objContratos 	= new contratos($objConexao);

	if (isset($_POST["btSubmit"]) || !empty($_POST["btSubmit"]))
	{
		if ($_POST["btSubmit"]=='Novo')
		{
			unset($_POST["id_contrato"]);
		}
	}
	if (isset($_POST["id_contrato"]) || !empty($_POST["id_contrato"]))
	{
		$id_contrato = $_POST["id_contrato"];
		if ($id_contrato != "")
		{
			$objContratos->atribuirQuery($objConexao, $objConfiguracao->anti_injection($id_contrato));
			$btn_botaoNAE	= 'button';
			$btn_botaoC		= 'hidden';
		}else
		{
			$btn_botaoNAE	= 'hidden';
			$btn_botaoC		= 'button';	
			$objContratos->inicializaVariaveis();
		}
	}else
	{
		$id_contrato 	= '';
		$btn_botaoNAE	= 'hidden';
		$btn_botaoC		= 'button';	
		$objContratos->inicializaVariaveis();
	}

	if (isset($_POST["str_acao"]) || !empty($_POST["str_acao"]))
	{
		switch ($_POST["str_acao"])
		{
			case 'Cadastrar':
				$objContratos->cadastrarContratos($objConexao);
				break;
			case 'Alterar':
				$objContratos->alterarContratos($objConexao,$objConfiguracao);
				break;
			case 'Excluir':
				$objContratos->excluirContratos($objConexao);
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
		$continuaAcaoCadastrar = true;
		
		if ($str_acao == 'Excluir')
		{
			if(!(confirm("Atenção: \nEsta ação excluirá todas as informações deste contrato.\nClique em OK se deseja continuar.")))
			{
				$continuaAcao = false;
			}
		}

		if (validaCamposDefault() && $continuaAcao)
		{
			//condição para mostrar o contrato e confirmar a aceitação do usuário ao contrato de prestação de serviço.
			if ($str_acao == 'Cadastrar' || $str_acao == 'Alterar')
			{
				//Perguntar de Aceitação
				if(!(confirm("Atenção: \nVOCÊ ACEITA TODOS OS TERMOS E CONDIÇÕES DO CONTRATO DE PRESTAÇÃO DE SERVIÇO.\nClique em OK para aceitar.")))
				{
					$continuaAcaoCadastrar = false;
				}
			}
			
			if ($continuaAcaoCadastrar)
			{
				var $codSeq = <?php echo $cont;?>;
				
				var $arrayNome = new Array ('str_acao',
											'codSecFormulario',
											'id_contrato',
											'str_numeroContrato',
											'str_nomeResponsavelContrato',
											'str_nomeVendedorSistema',
											'chk_pessoaFisica',
											'str_cnpj',
											'str_cpf',
											'str_complemento',
											'slc_uf',
											'slc_municipios',
											'slc_bairro',
											'slc_descricaoLogradouro',
											'str_telefone',
											'slc_id_plano',
											'str_dtInicioVigencia',
											'str_dtFinalVigencia',
											'str_diaVencimento',
											'chk_contratoAtivo'
											);
				f = document;
				d = document.frm;
				var $arrayValor = new Array 
				(
					retornaUrlAjax('', new Array ('"','','"'), 	new Array ('' ,$str_acao,'')),
					retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,$codSeq, '')),
					retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('id_contrato').value, $codSeq, true), '')),
					retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_numeroContrato.value, $codSeq, true), '')),
					retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_nomeResponsavelContrato.value, $codSeq, true), '')),
					retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_nomeVendedorSistema.value, $codSeq, true), '')),
					retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('chk_pessoaFisica').checked.toString().toUpperCase(), $codSeq, true), '')),
					retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_cnpj.value, $codSeq, true), '')),
					retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_cpf.value, $codSeq, true), '')),
					retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_complemento.value, $codSeq, true), '')),
					retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_uf.value, $codSeq, true), '')),				
					retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_municipios.value, $codSeq, true), '')),
					retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_bairro.value, $codSeq, true), '')),
					retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.slc_descricaoLogradouro.value, $codSeq, true), '')),
					
					retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_telefone.value, $codSeq, true), '')),
					retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_id_plano').value, $codSeq, true), '')),
					retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_dtInicioVigencia.value, $codSeq, true), '')),
					retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_dtFinalVigencia.value, $codSeq, true), '')),
					retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_diaVencimento.value, $codSeq, true), '')),
					retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('chk_contratoAtivo').checked.toString().toUpperCase(), $codSeq, true), ''))
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
    <td class="adm_med_grupoForm_top_02" align="center"><span class="adm_fonteResTop_01">Contratos</span></td>
    <td class="adm_med_grupoForm_top_03"><input name="id_contrato" id="id_contrato" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $id_contrato;?>" ></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05"></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05" align="center">
		<img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/contratoG.png" width="32" height="32" style="cursor:pointer;" onclick="GB_showFullScreen('CONTRATO DE PRESTAÇÃO DE SERVIÇO', '../../adm/adm_impressao_contrato.php?id_contrato=<?php echo $id_contrato;?>');" title="Visualizar o Contrato de Prestação de Serviços">
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
                <td width="24%" align="right">Plano Contratado:&nbsp;</td>
                <td width="25%" align="left">
                    <select name="slc_id_plano" id="slc_id_plano" class="adm_formResCombo_01" style="width:125" title="Plano Contratado" >
<?php $query = $objContratos->comboPlanoContratos($objConexao);
				while($array = $objConexao->retornaArray($query))
				{
?>
				  	<option value="<?php echo $array['id_plano'];?>" <?php echo $objContratos->id_plano == $array['id_plano']?'selected':'';?> title="<?php echo $objContratos->codifiStringBancoInterface($objConexao, $array['str_nomeplano']);?>"><?php echo $objContratos->codifiStringBancoInterface($objConexao, $array['str_nomeplano']);?></option>
<?php }
?>
                    </select>                </td>
                <td colspan="2" align="right">Nº. Contrato:&nbsp;</td>
                <td width="29%" colspan="3" align="left"><input name="str_numeroContrato" type="text" class="adm_formGrupoTxt_01" style="width: 125px; filter: Alpha(Opacity=60);" disabled="disabled" maxlength="10"  value="<?php echo $objContratos->str_numeroContrato;?>" OnKeyPress="return retornaNumeros(event,this);" title="Nº. Contrato"></td>
              </tr>
              <tr>
                <td colspan="7" height="5"></td>
              </tr>
              <tr>
                <td align="right">In&iacute;cio Vig&ecirc;ncia:&nbsp;</td>
                <td align="left">
                    <!-- inicio tabela campo Data Inicio Vigencia -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="30"><input name="str_dtInicioVigencia" id="*" type="text" class="adm_formGrupoTxt_01" style="width:70;" maxlength="10" value="<?php echo $objContratos->dt_inicioVigencia;?>" OnKeyPress="formataMascara('##/##/####', this); return retornaNumeros(event,this);" onblur="verificaData(this);" title="Início Vigência"></td>
                        <td valign="bottom" align="left">&nbsp;<img src="icons/calendario.png" alt="Informe a Data" width="20" height="18" style="cursor:pointer;" onClick="popdate('document.frm.str_dtInicioVigencia', 'divDtInicioVigencia', '145', document.frm.str_dtInicioVigencia.value, 'adm');"><span id="divDtInicioVigencia" style="position:absolute"></span><span id="divDtFinalVigencia" style="position:absolute"></span></td>
                      </tr>
                    </table>
                    <!-- fim tabela campo Data Inicio Vigencia -->                </td>
                <td colspan="2" align="right">Final Vig&ecirc;ncia:&nbsp;</td>
                <td colspan="3" align="left">
                    <!-- inicio tabela campo Data Final Vigencia -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="30"><input name="str_dtFinalVigencia" id="*" type="text" class="adm_formGrupoTxt_01" style="width:70;" maxlength="10" value="<?php echo $objContratos->dt_finalVigencia;?>" OnKeyPress="formataMascara('##/##/####', this); return retornaNumeros(event,this);" onblur="verificaData(this);" title="Final Vigência"></td>
                        <td valign="bottom" align="left">&nbsp;<img src="icons/calendario.png" alt="Informe a Data" width="20" height="18" style="cursor:pointer;" onClick="popdate('document.frm.str_dtFinalVigencia', 'divDtFinalVigencia', '145', document.frm.str_dtFinalVigencia.value, 'adm');"></td>
                      </tr>
                    </table>
                    <!-- fim tabela campo Data Final Vigencia -->                </td>
              </tr>              
              <tr>
                <td colspan="7" height="5"></td>
              </tr>
              <tr>
                <td align="right">Nome Respons&aacute;vel:&nbsp;</td>
					<td align="left"><input name="str_nomeResponsavelContrato" id="*" type="text" class="adm_formGrupoTxt_01" style="width: 125;" maxlength="70" value="<?php echo $objContratos->str_nomeResponsavelContrato;?>" onblur="validaNomeProprio(this);" title="Nome Responsável"></td>
                <td colspan="2" align="right">Pessoa F&iacute;sica:&nbsp;</td>
                <td colspan="3" align="left"><input name="chk_pessoaFisica" id="chk_pessoaFisica" type="checkbox" <?php echo $objContratos->bln_pessoaFisica=='t'?'checked':'';?> onclick="guardaValorIniciado(this); controlePessoFisica(this);"  onchange="guardaValorIniciado(this);" title="Pessoa Física"/><input id="chk_pessoaFisicaAux" type="hidden" value="<?php echo $objContratos->bln_pessoaFisicaAux;?>"></td>
              </tr>
              <tr>
                <td colspan="7" height="5"></td>
              </tr>
              <tr>
                <td align="right">CNPJ:&nbsp;</td>
                <td align="left"><input name="str_cnpj" id="*" type="text" class="adm_formGrupoTxt_01" maxlength="18" value="<?php echo $objContratos->str_cnpj;?>" OnKeyPress="return retornaNumeros(event,this);" OnKeyDown="return gerenciaCnpj(event, this);" onBlur="validaCampoCnpj(this);" <?php echo $objContratos->str_cnpjDisable;?> title="CNPJ"></td>
                <td colspan="2" align="right">CPF:&nbsp;</td>
                <td colspan="3" align="left"><input name="str_cpf" id="*" type="text" class="adm_formGrupoTxt_01" maxlength="14" value="<?php echo $objContratos->str_cpf;?>" OnKeyPress="return retornaNumeros(event,this);" OnKeyDown="return gerenciaCpf(event, this);" onBlur="validaCampoCpf(this);" <?php echo $objContratos->str_cpfDisable;?> title="CPF" ></td>
              </tr>
              <tr>
                <td colspan="7" height="5"></td>
              </tr>
              <tr>
                <td align="right">UF:&nbsp;</td>
                <td align="left">
                	<select name="slc_uf" id="*" class="adm_formResCombo_01" style="width:55" onchange="enviaValorUf(this, 'adm_ajaxComponente_contrato_uf.php');" title="UF" >
					<option value="">:: UF ::</option>
<?php $query = $objContratos->comboUF($objConexao);
						while($array = $objConexao->retornaArray($query))
						{
?>
				  			<option value="<?php echo $array['str_uf'];?>" <?php echo $objContratos->str_uf == $array['str_uf']?'selected':'';?> ><?php echo $array['str_uf'];?></option>
<?php }
?>
					</select>
				</td>
                <td colspan="2" align="right">Telefone:&nbsp;</td>
                <td colspan="3" align="left">
                    <input name="str_telefone" id="*" type="text" class="adm_formGrupoTxt_01" style="width: 95px;" maxlength="12" value="<?php echo $objContratos->str_telefone;?>" OnKeyPress="formataMascara('## ####-####', this); return retornaNumeros(event,this);" onBlur="validaCampoTelefone(this);" title="Telefone">
                </td>
              </tr>
              <tr>
                <td colspan="7" height="5"></td>
              </tr>
              <tr>
                <td align="right">Munic&iacute;pio:&nbsp;</td>
                <td align="left">
					<div id="Municipio">
						<select name="slc_municipios" id="*" class="adm_formResCombo_01" style="width:125" onchange="enviaValorMunicipio(this, 'adm_ajaxComponente_contrato_municipio.php');" title="Município">
<?php if ($objContratos->str_uf!='')
				{
					$query = $objContratos->comboMunicipio($objConexao, $objContratos->str_uf);
					while($array = $objConexao->retornaArray($query))
					{
						$cont++;
						if($cont == 1)
						{
							echo '<option value="">:: selecione ::</option>';
						}
?>
						<option value="<?php echo $array['id_municipio'];?>" <?php echo ($objContratos->id_municipio == $array['id_municipio']||$objContratos->str_municipios==$array['str_municipios'])?'selected':'';?> title="<?php echo $objContratos->codifiStringBancoInterface($objConexao, ucwords($array['str_municipios']));?>" ><?php echo $objContratos->codifiStringBancoInterface($objConexao, ucwords($array['str_municipios']));?></option>
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
                <td colspan="2" align="right">Dia do Vencimento:&nbsp;</td>
                <td colspan="3" align="left"><input name="str_diaVencimento" id="*" type="text" class="adm_formGrupoTxt_01" style="width: 25px;" maxlength="2" value="<?php echo $objContratos->str_diaVencimento;?>" onblur="validaCampoDiaVencimento(this);" OnKeyPress="return retornaNumeros(event,this);" title="Dia do Vencimento"/></td>
              </tr>
              <tr>
                <td colspan="7" height="5"></td>
              </tr>
              <tr>
                <td align="right">Bairro:&nbsp;</td>
                <td align="left">
					<div id="Bairro">
						<select name="slc_bairro" id="*" class="adm_formResCombo_01" style="width:125" title="Bairro">
<?php if ($objContratos->id_municipio != '')
				{
					$query = $objContratos->comboBairro($objConexao, $objContratos->id_municipio);
					while($array = $objConexao->retornaArray($query))
					{
						$cont++;
						if($cont == 1)
						{
							echo '<option value="">:: selecione ::</option>';
						}
?>
						<option value="<?php echo $array['id_bairro'];?>" <?php echo $objContratos->id_bairro == $array['id_bairro']?'selected':'';?> title="<?php echo $objContratos->codifiStringBancoInterface($objConexao, ucwords($array['str_bairro']));?>" ><?php echo $objContratos->codifiStringBancoInterface($objConexao, ucwords($array['str_bairro']));?></option>
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
                <td colspan="2" align="right">Nome Vendedor:&nbsp;</td>
                <td colspan="3" align="left"><input name="str_nomeVendedorSistema" id="*" type="text" class="adm_formGrupoTxt_01" style="width: 125px;" maxlength="20" value="<?php echo $objContratos->str_nomeVendedorSistema;?>" onblur="validaNomeProprio(this);" title="Nome Vendedor"></td>
              </tr>
              <tr>
                <td colspan="7" height="5"></td>
              </tr>
              <tr>
                <td align="right">Logradouro:&nbsp;</td>
                <td align="left">
					<div id="Logradouro">
						<select name="slc_descricaoLogradouro" id="*" class="adm_formResCombo_01" style="width:125" title="Logradouro">
<?php if ($objContratos->id_bairro != '')
				{
					$query = $objContratos->comboLogradouro($objConexao, $objContratos->id_bairro);
					while($array = $objConexao->retornaArray($query))
					{
						$cont++;
						if($cont == 1)
						{
							echo '<option value="">:: selecione ::</option>';
						}
?>
						<option value="<?php echo $array['id_numerocep'];?>" <?php echo $objContratos->id_numeroCep == $array['id_numerocep']?'selected':'';?> title="<?php echo $objContratos->codifiStringBancoInterface($objConexao, ucwords($array['str_descricaologradouro']));?>" ><?php echo $objContratos->codifiStringBancoInterface($objConexao, ucwords($array['str_descricaologradouro']));?></option>
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
                <td colspan="3" align="left"><input name="str_complemento" id="*" type="text" class="adm_formGrupoTxt_01" style="width: 125px;" maxlength="45" value="<?php echo $objContratos->str_complemento;?>" onblur="validaNomeProprio(this);" title="Complemento"></td>
              </tr>              
              <tr>
                <td colspan="7" height="5"></td>
              </tr>
              <tr>
                <td align="right">Contrato Ativo:&nbsp;</td>
                <td align="left"><input name="chk_contratoAtivo" id="chk_contratoAtivo" type="checkbox" <?php echo $objContratos->bln_contratoAtivo=='t'?'checked':'';?> onclick="guardaValorIniciado(this);"  onchange="guardaValorIniciado(this);" title="Contrato Ativo" /><input id="chk_contratoAtivoAux" type="hidden" value="<?php echo $objContratos->bln_contratoAtivoAux;?>">
				</td>
                <td colspan="2" align="right"></td>
                <td colspan="3" align="left"></td>
              </tr>
              <tr>
                <td colspan="7" height="5"></td>
              </tr>
              <tr>
                <td colspan="7" background="<?php echo $objConfiguracao->getDirTheme();?>/adm_med_fundo_Inf.gif" style="height: 128px;" align="center" valign="top">
                    <table width="570" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="56"></td>
                        <td colspan="3" class="adm_fonteFormInf_01" height="22">Este formul&aacute;rio permite cadastrar e vincular um contrato ao plano de contrato.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="12"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td width="75" align="right" class="adm_fonteFormInf_02">Novo -&nbsp;</td>
                        <td width="429">Limpa os campos acima para um novo cadastro.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td align="right" class="adm_fonteFormInf_02">Cadastrar -&nbsp;</td>
                        <td>Grava os dados informados nos campos acima.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td align="right" class="adm_fonteFormInf_02">Alterar -&nbsp;</td>
                        <td>Modifica a informa&ccedil;&atilde;o selecionada na lista abaixo.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td align="right" class="adm_fonteFormInf_02">Excluir -&nbsp;</td>
                        <td>Apaga a informa&ccedil;&atilde;o selecionada na lista abaixo.</td>
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