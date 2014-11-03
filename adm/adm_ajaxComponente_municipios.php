<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina 			= "AcessDenied";
	$str_acessoMinimo 	= "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classMunicipios.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	$objMunicipios 	= new municipios($objConexao);

	if (isset($_POST["id_municipio"]) || !empty($_POST["id_municipio"]))
	{
		$id_municipio = $_POST["id_municipio"];
		if ($id_municipio != "")
		{
			$objMunicipios->atribuirQuery($objConexao, $objConfiguracao->anti_injection($id_municipio));
			$btn_botaoNAE	= 'button';
			$btn_botaoC		= 'hidden';
		}else
		{
			$btn_botaoNAE	= 'hidden';
			$btn_botaoC		= 'button';	
			$objMunicipios->inicializaVariaveis();
		}
	}else
	{
		$id_municipio 	= '';
		$btn_botaoNAE	= 'hidden';
		$btn_botaoC		= 'button';	
		$objMunicipios->inicializaVariaveis();
	}

	if (isset($_POST["str_acao"]) || !empty($_POST["str_acao"]))
	{
		switch ($_POST["str_acao"])
		{
			case 'Cadastrar':
				$objMunicipios->cadastrarMunicipios($objConexao);
				break;
			case 'Alterar':
				$objMunicipios->alterarMunicipios($objConexao);
				break;
			case 'Excluir':
				$objMunicipios->excluirMunicipios($objConexao);
				break;
		}
	}
	//============================================================================//
	//                Atribuir Estado e CodIbge pelo Município                    //
	//============================================================================//	
	if (isset($_POST["id_logradouro"]) || !empty($_POST["id_logradouro"]))
	{	
		if ($_POST['id_logradouro'] != '')
		{
			$objMunicipios->comboMunicipioAtribuirCep($objConexao , $_POST['id_logradouro']);
		}
	}

	//============================================================================//
	//      Criptografa os Links das paginas Ajax que passa por referencia        //
	//============================================================================//
	$cont = $objConfiguracao->sequenceCrypt('', true, true);
	
	$paginaAtual = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_municipios.php', $cont, true);	
?>
<script>
	function atribuirValoresFormulario($str_acao)
	{
		
		if (validaCamposDefault())
		{
			var $codSeq = <?php echo $cont;?>;
			
			var $arrayNome = new Array ('str_acao',
										'codSecFormulario',
										'id_municipio',
										'str_municipios',
										'str_uf',
										'str_descricaoLogradouro',
										'str_bairro'
										);
			f = document;
			d = document.frm;

			var $arrayValor = new Array 
			(
				retornaUrlAjax('', new Array ('"','','"'), 	new Array ('' ,$str_acao,'')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,$codSeq, '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('id_municipio').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_municipios').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_uf').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_descricaoLogradouro.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_bairro.value, $codSeq, true), ''))
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
			<td width="50%" align="left"><span class="adm_fonteResTop_01" >Seja Bem Vindo </span></td>
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
    <td class="adm_med_grupoForm_top_02" align="center"><span class="adm_fonteResTop_01">Munic&iacute;pios</span></td>
    <td class="adm_med_grupoForm_top_03"><input name="id_municipio" id="id_municipio" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $id_municipio;?>" ></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05"></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05" align="center">
		<img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/municipiosG.png" width="32" height="32">
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
                <td width="23%" align="right">UF:&nbsp;</td>
                <td width="24%" align="left">
					<select name="slc_uf" id="*" class="adm_formResCombo_01" style="width:55" onchange="enviaValorUf(this, 'adm_ajaxComponente_municipios_uf.php');" title="UF" >
					<option value="">:: UF ::</option>
<?php $query = $objMunicipios->comboUF($objConexao);
						while($array = $objConexao->retornaArray($query))
						{
?>
				  			<option value="<?php echo $array['str_uf'];?>" <?php echo $objMunicipios->str_uf == $array['str_uf']?'selected':'';?> title="<?php echo $array['str_uf'];?>" ><?php echo $array['str_uf'];?></option>
<?php }
?>
					</select>
                </td>
                <td colspan="2" align="right">N&uacute;mero Cep:&nbsp;</td>
                <td width="31%" colspan="3" align="left"><input name="id_numeroCep" id="*" type="text"  class="adm_formGrupoTxt_01" style="width:125; background:#CCCCCC;" maxlength="8" readonly="true" value="<?php echo $objMunicipios->id_numeroCep;?>" title="Número Cep"></td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Munic&iacute;pio:&nbsp;</td>
                <td align="left">
					<div id="Municipio">
						<select name="slc_municipios" id="*" class="adm_formResCombo_01" style="width:125" onchange="enviaValorMunicipio(this, 'adm_ajaxComponente_municipios_municipio.php');" title="Município">
<?php if ($objMunicipios->str_uf!='')
				{
					$query = $objMunicipios->comboMunicipio($objConexao, $objMunicipios->str_uf);
					while($array = $objConexao->retornaArray($query))
					{
						$cont++;
						if($cont == 1)
						{
							echo '<option value="">:: selecione ::</option>';
						}
?>
						<option value="<?php echo $array['id_municipio'];?>" <?php echo ($objMunicipios->id_municipio == $array['id_municipio']||$objMunicipios->str_municipios==$array['str_municipios'])?'selected':'';?> title="<?php echo $objMunicipios->codifiStringBancoInterface($objConexao, ucwords($array['str_municipios']));?>" ><?php echo $objMunicipios->codifiStringBancoInterface($objConexao, ucwords($array['str_municipios']));?></option>
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
                <td colspan="2" align="right">Tipo de Logradouro:&nbsp;</td>
                <td colspan="3" align="left"><input name="str_descricaoTipo" id="*" type="text" class="adm_formGrupoTxt_01" style="width:125; background:#CCCCCC;" maxlength="56" readonly="true" value="<?php echo $objMunicipios->str_descricaoTipo;?>" title="Tipo de Logradouro"/></td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Bairro:&nbsp;</td>
                <td align="left">
					<div id="Bairro">
						<select name="slc_bairro" id="*" class="adm_formResCombo_01" style="width:125" title="Bairro">
<?php if ($objMunicipios->id_municipio != '')
				{
					$query = $objMunicipios->comboBairro($objConexao, $objMunicipios->id_municipio);
					while($array = $objConexao->retornaArray($query))
					{
						$cont++;
						if($cont == 1)
						{
							echo '<option value="">:: selecione ::</option>';
						}
?>
						<option value="<?php echo $array['id_bairro'];?>" <?php echo $objMunicipios->id_bairro == $array['id_bairro']?'selected':'';?> title="<?php echo $objMunicipios->codifiStringBancoInterface($objConexao, ucwords($array['str_bairro']));?>" ><?php echo $objMunicipios->codifiStringBancoInterface($objConexao, ucwords($array['str_bairro']));?></option>
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
                <td colspan="2" align="right"></td>
                <td colspan="3" align="left"></td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Logradouro:&nbsp;</td>
                <td align="left">
					<div id="Logradouro">
						<select name="slc_descricaoLogradouro" id="*" class="adm_formResCombo_01" style="width:125" onchange="enviaValorLogradouro(this);" title="Logradouro">
<?php if ($objMunicipios->id_bairro != '')
				{
					$query = $objMunicipios->comboLogradouro($objConexao, $objMunicipios->id_bairro);
					while($array = $objConexao->retornaArray($query))
					{
						$cont++;
						if($cont == 1)
						{
							echo '<option value="">:: selecione ::</option>';
						}
?>
						<option value="<?php echo $array['id_numerocep'];?>" <?php echo $objMunicipios->id_numeroCep == $array['id_numerocep']?'selected':'';?> title="<?php echo $objMunicipios->codifiStringBancoInterface($objConexao, ucwords($array['str_descricaologradouro']));?>" ><?php echo $objMunicipios->codifiStringBancoInterface($objConexao, ucwords($array['str_descricaologradouro']));?></option>
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
                <td colspan="2" align="right"></td>
                <td colspan="3" align="left"></td>
              </tr>              
              <tr>
                <td colspan="7" height="100"></td>
              </tr>
              <tr>
                <td colspan="7" background="<?php echo $objConfiguracao->getDirTheme();?>/adm_med_fundo_Inf.gif" style="height: 128px;" align="center" valign="top">
                    <table width="570" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="56"></td>
                        <td colspan="3" class="adm_fonteFormInf_01" height="22">Este formul&aacute;rio permite cadastrar bairros por todas as UF&rsquo;s e Munic&iacute;pios do Brasil.</td>
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
<?php /*                
                	<input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" class="adm_formBotao_01" value="Novo" onclick="atribuirItem();">

                    <input name="btSubmit" type="<?php echo $btn_botaoC;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Cadastrar" onclick="atribuirValoresFormulario('Cadastrar');">
                    	&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Alterar" onclick="atribuirValoresFormulario('Alterar');">
                    	&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Excluir" onclick="atribuirValoresFormulario('Excluir');">
*/
?>					
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