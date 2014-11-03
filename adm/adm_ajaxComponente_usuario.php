<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina 			= "AcessDenied";
	$str_acessoMinimo 	= "Usuario";

	include("../config/config_Sistema.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	if (isset($_POST["id_usuario"]) || !empty($_POST["id_usuario"]))
	{
		$id_usuario = $_POST["id_usuario"];
		if ($id_usuario != "")
		{
			$objUsuario->atribuirQuery($objConexao, $objConfiguracao->anti_injection($id_usuario));
			$btn_botaoNAE	= 'button';
			$btn_botaoC		= 'hidden';
		}else
		{
			$btn_botaoNAE	= 'hidden';
			$btn_botaoC		= 'button';	
			$objUsuario->inicializaVariaveis();
		}
	}else
	{
		$id_usuario 	= '';
		$btn_botaoNAE	= 'hidden';
		$btn_botaoC		= 'button';	
		$objUsuario->inicializaVariaveis();
	}

	if (isset($_POST["str_acao"]) || !empty($_POST["str_acao"]))
	{
		switch ($_POST["str_acao"])
		{
			case 'Cadastrar':
				$objUsuario->cadastrarUsuario($objConexao);
				break;
			case 'Alterar':
				$objUsuario->alterarUsuario($objConexao,$objConfiguracao);
				break;
			case 'Excluir':
				$objUsuario->excluirUsuario($objConexao);
				break;
		}
	}

	//============================================================================//
	//      Criptografa os Links das paginas Ajax que passa por referencia        //
	//============================================================================//
	$cont = $objConfiguracao->sequenceCrypt('', true, true);
	
	$paginaAtual = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_usuario.php', $cont, true);	
?>
<script>
	function atribuirValoresFormulario($str_acao)
	{
		
	
		$continuaAcao = true;
		if ($str_acao == 'Excluir')
		{
			if(!(confirm("Atenção: \nEsta ação excluirá o usuário permanentemente.\nClique em OK se deseja continuar.")))
			{
				$continuaAcao = false;
			}
		}
		if (validaCamposDefault() && $continuaAcao)
		{
			var $codSeq = <?php echo $cont;?>;
			
			var $arrayNome = new Array ('str_acao',
										'codSecFormulario',
										'id_usuario',
										'str_nome',
										'str_senha',
										'str_email',
										'str_telefone',
										'slc_nivelAcesso',
										'str_nomeimobiliaria',
										'slc_id_contrato'
										);
			f = document;
			d = document.frm;

			var $arrayValor = new Array 
			(
				retornaUrlAjax('', new Array ('"','','"'), 	new Array ('' ,$str_acao,'')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,$codSeq, '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('id_usuario').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_nome.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_senha.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_email.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_telefone.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_nivelAcesso').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_nomeImobiliaria.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_id_contrato').value, $codSeq, true), ''))
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
    <td class="adm_med_grupoForm_top_02" align="center"><span class="adm_fonteResTop_01">Usu&aacute;rios</span></td>
    <td class="adm_med_grupoForm_top_03"><input name="id_usuario" id="id_usuario" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $id_usuario;?>" ></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05"></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05" align="center">
		<img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/usuarioG.png" width="32" height="32">
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
                <td width="24%" align="right">Contrato:&nbsp;</td>
                <td width="24%" align="left">
                    <select name="slc_id_contrato" id="slc_id_contrato" class="adm_formResCombo_01" title="Contrato" <?php echo $objUsuario->str_DisableContrato;?> >
<?php $query = $objUsuario->comboContrato($objConexao);
				while($array = $objConexao->retornaArray($query))
				{
?>
				  	<option value="<?php echo $array['id_contrato'];?>" <?php echo $objUsuario->id_contrato == $array['id_contrato']?'selected':'';?> ><?php echo $array['str_numerocontrato'];?></option>
<?php }
?>
                    </select>
                </td>
                <td colspan="2" align="right"></td>
                <td width="32%" colspan="3" align="left"></td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Nome:&nbsp;</td>
                <td align="left"><input name="str_nome" id="*" type="text" class="adm_formGrupoTxt_01" style="width: 125px;" maxlength="70" value="<?php echo $objUsuario->str_nome;?>" onblur="validaNomeProprio(this);" title="Nome"></td>
                <td colspan="2" align="right">Senha:&nbsp;</td>
                <td colspan="3" align="left"><input name="str_senha" id="*" type="password" class="adm_formGrupoTxt_01" style="width: 125;" maxlength="20" value="<?php echo $objUsuario->str_senha;?>" onblur="validaNomeProprio(this);" title="Senha"></td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Email:&nbsp;</td>
                <td align="left"><input name="str_email" id="*" type="text" class="adm_formGrupoTxt_01" style="width: 125;" maxlength="40" value="<?php echo $objUsuario->str_email;?>" onblur="validaCampoEmail(this);" title="Email"></td>
                <td colspan="2" align="right">Imobili&aacute;ria:&nbsp;</td>
                <td colspan="3" align="left"><input name="str_nomeImobiliaria" type="text" class="adm_formGrupoTxt_01" style="width: 125px;" maxlength="40"  value="<?php echo $objUsuario->str_nomeImobiliaria;?>" title="Imobiliária"></td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">N&iacute;vel Acesso:&nbsp;</td>
                <td align="left">
                	<select name="slc_nivelAcesso" id="slc_nivelAcesso" class="adm_formResCombo_01" <?php echo $objConfiguracao->getNivelAcesso() == 'Gestor'?'style="width: 125px;"':'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"';?> onchange="controleContratoUsuario(this);" title="Nível Acesso" >
						<option value="Usuario" <?php echo $objUsuario->str_nivelAcesso=='Usuario'?'selected':'';?>  title="Usuario" >Usuario</option>
						<option value="Vendas" <?php echo $objUsuario->str_nivelAcesso=='Vendas'?'selected':'';?>  title="Vendas" >Vendas</option>
						<option value="Gestor" <?php echo $objUsuario->str_nivelAcesso=='Gestor'?'selected':'';?>  title="Gestor" >Gestor</option>
                    </select>
                </td>
                <td colspan="2" align="right">Telefone:&nbsp;</td>
                <td colspan="3" align="left"><input name="str_telefone" id="*" type="text" class="adm_formGrupoTxt_01" style="width: 95px;" maxlength="12" value="<?php echo $objUsuario->str_telefone;?>" OnKeyPress="formataMascara('## ####-####', this); return retornaNumeros(event,this);" onBlur="validaCampoTelefone(this);" title="Telefone"></td>
              </tr>
              <tr>
                <td colspan="7" height="90"></td>
              </tr>
              <tr>
                <td colspan="7" background="<?php echo $objConfiguracao->getDirTheme();?>/adm_med_fundo_Inf.gif" style="height: 128px;" align="center" valign="top">
                    <table width="570" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="56"></td>
                        <td colspan="3" class="adm_fonteFormInf_01" height="22">Este formulário permite cadastrar e vincular os usu&aacute;rios aos contratos.</td>
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