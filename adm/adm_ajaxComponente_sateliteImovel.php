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
			$objImovel->atribuirQuerySatelite($objConexao, $objConfiguracao->anti_injection($id_imovel));
			$btn_botaoP		= 'button';
			$btn_botaoNAE	= 'button';
			$btn_botaoC		= 'hidden';
		}else
		{
			$btn_botaoP		= 'button';
			$btn_botaoNAE	= 'hidden';
			$btn_botaoC		= 'button';	
			$objImovel->inicializaVariaveisSatelite();
		}
	}else
	{
		$id_imovel 	= '';
		$btn_botaoP		= 'button';
		$btn_botaoNAE	= 'hidden';
		$btn_botaoC		= 'button';	
		$objImovel->inicializaVariaveisSatelite();
	}

	if (isset($_POST["str_acao"]) || !empty($_POST["str_acao"]))
	{
		switch ($_POST["str_acao"])
		{
			case 'Cadastrar':
				$objImovel->alterarSateliteImovel($objConexao, 'Cadastrar');
				break;
			case 'Alterar':
				$objImovel->alterarSateliteImovel($objConexao, 'Alterar');
				break;
			case 'Excluir':
				$objImovel->alterarSateliteImovel($objConexao, 'Excluir');
				break;
		}
	}

	//============================================================================//
	//      Criptografa os Links das paginas Ajax que passa por referencia        //
	//============================================================================//
	$cont = $objConfiguracao->sequenceCrypt('', true, true);
	
	$paginaAnte  = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_arquivosImovel.php', 2, true);
	$paginaAtual = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_sateliteImovel.php', $cont, true);	

?>
<script>
	function atribuirValoresFormulario($str_acao)
	{
		$continuaAcao = true;
		if ($str_acao == 'Excluir')
		{
			if(!(confirm("Atenção: \nEsta ação excluirá a posição geografica do imóvel selecionado.\nClique em OK se deseja continuar.")))
			{
				$continuaAcao = false;
			}
		}
		if (validaCamposDefault())
		{
			var $codSeq = <?php echo $cont;?>;
			
			var $arrayNome = new Array ('str_acao',
										'codSecFormulario',
										'id_imovel',
										'str_posicaoSatelite'
										);
			f = document;
			d = document.frm;
			
			var $arrayValor = new Array 
			(
				retornaUrlAjax('', new Array ('"','','"'), 	new Array ('' ,$str_acao,'')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,$codSeq, '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.id_imovel.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_posicaoSatelite.value, $codSeq, true), ''))
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
			
			carregarConteudoMenu(1, $slc_totalRegistrosTela, $valorOrdenacao, sequenceCrypt(f.getElementById('str_nomePagina').value, f.getElementById('codSec').value, false), $cont, f.getElementById('id_imovelFixo').value);
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
    <td class="adm_med_grupoForm_top_02" align="center"><span class="adm_fonteResTop_01">Posi&ccedil;&atilde;o Geogr&aacute;fica    do Im&oacute;vel</span></td>
    <td class="adm_med_grupoForm_top_03"><input name="id_imovel" id="id_imovel" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $objImovel->id_imovel;?>" ></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="right"><img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/passoForm5.png" width="87" height="30"></td>
        <td width="21"></td>
      </tr>
    </table></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05" align="center">
		<img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/sateliteG.png" width="32" height="32">
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
                <td colspan="2" height="12"></td>
              </tr>
			  <tr>
				<td width="11%"></td>
			    <td width="89%" align="left">Cole o HTML para incorporar o mapa ao imóvel:&nbsp;</td>
			  </tr>
			  <tr>
				<td width="11%"></td>
			    <td width="89%" align="left">
				<!-- inicio tabela campo html mapa -->
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="63%"><textarea name="str_posicaoSatelite" id="*" cols="50" rows="8" class="campoTexto" title="do Código Html" ><?php echo $objImovel->str_posicaoSatelite;?></textarea></td>
					<td width="37%">&nbsp;<img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/help.png" style="cursor:pointer;" width="16" height="16" onclick="mostraPaginaLocalizaSatelite('<?php echo $objConfiguracao->getUfPadrao();?>');" alt="Clique aqui para localizar a posição do imóvel no mapa."></td>
				  </tr>
				</table>
				<!-- final tabela campo html mapa -->
				</td>
			  </tr>
              <tr>
                <td colspan="2" height="6"></td>
              </tr>
              <tr>
                <td colspan="2" background="<?php echo $objConfiguracao->getDirTheme();?>/adm_med_fundo_Inf.gif" style="height: 128px;" align="center" valign="top">
                    <table border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="56"></td>
                        <td colspan="3" class="adm_fonteFormInf_01" height="22">Este formul&aacute;rio permite obter a exata posi&ccedil;&atilde;o geogr&aacute;fica do im&oacute;vel no planeta.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="6"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
						<td width="14" align="right">&nbsp;</td>
                        <td width="490">Clique no botão de ajuda <img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/help.png" style="cursor:pointer;" width="16" height="16" onclick="mostraPaginaLocalizaSatelite('<?php echo $objConfiguracao->getUfPadrao();?>');" alt="Clique aqui para localizar a posição do imóvel no mapa."> e siga os passos para obter a posição<br />exata do imóvel no globo terrestre.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
						<td width="14" align="right">&nbsp;</td>
                        <td width="490">Após posicionar o imovél no mapa, copie o código html e cole no<br />campo acima.</td>
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
                    <input name="btSubmit" type="<?php echo $btn_botaoP;?>" class="adm_formBotao_02" value="Anterior" onclick="carregaProximoAnterior('<?php echo $paginaAnte;?>', '2', true, 'id_imovelFixo', document.frm.id_imovel.value);">
                    	&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoC;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Cadastrar" onclick="atribuirValoresFormulario('Cadastrar');">
                    	&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Alterar" onclick="atribuirValoresFormulario('Alterar');">
                    	&nbsp;&nbsp;
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
<script>
	if (document.frm.id_imovel.value == '' && document.getElementById('id_imovelFixo').value != '')
	{
		document.frm.id_imovel.value = document.getElementById('id_imovelFixo').value;
		atribuirItem('id_imovel', document.frm.id_imovel.value);
	}
</script>