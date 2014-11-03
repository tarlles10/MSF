<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina 			= "AcessDenied";
	$str_acessoMinimo 	= "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classMoldes.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	$objMoldes 	= new moldes($objConexao);

	if (isset($_POST["id_moldes"]) || !empty($_POST["id_moldes"]))
	{
		$id_moldes = $_POST["id_moldes"];
		if ($id_moldes != "")
		{
			$objMoldes->atribuirQuery($objConexao, $objConfiguracao->anti_injection($id_moldes));
			$btn_botaoNAE	= 'button';
			$btn_botaoC		= 'hidden';
		}else
		{
			$btn_botaoNAE	= 'hidden';
			$btn_botaoC		= 'button';	
			$objMoldes->inicializaVariaveis();
		}
	}else
	{
		$id_moldes 	= '';
		$btn_botaoNAE	= 'hidden';
		$btn_botaoC		= 'button';	
		$objMoldes->inicializaVariaveis();
	}

	if (isset($_POST["str_acao"]) || !empty($_POST["str_acao"]))
	{
		switch ($_POST["str_acao"])
		{
			case 'Cadastrar':
				$objMoldes->cadastrarMoldes($objConexao);
				break;
			case 'Alterar':
				$objMoldes->alterarMoldes($objConexao);
				break;
			case 'Excluir':
				$objMoldes->excluirMoldes($objConexao);
				break;
		}
	}

	//============================================================================//
	//      Criptografa os Links das paginas Ajax que passa por referencia        //
	//============================================================================//
	$cont = $objConfiguracao->sequenceCrypt('', true, true);
	
	$paginaAtual = $objConfiguracao->sequenceCrypt('adm_ajaxComponente_moldesBanner.php', $cont, true);
	
?>
<script>
	function atribuirValoresFormulario($str_acao, $diretorioDestino)
	{
		$continuaAcao = true;
		if ($str_acao == 'Excluir')
		{
			if(!(confirm("Aten��o: \nEsta a��o excluir� todas as informa��es deste molde.\nClique em OK se deseja continuar.")))
			{
				$continuaAcao = false;
			}
		}
		if (validaCamposDefault() && $continuaAcao)
		{
			var $codSeq = <?php echo $cont;?>;
			var $arrayNome = new Array ('str_acao',
										'codSecFormulario',
										'id_moldes',
										'str_nomeMolde',
										'str_diretorioMolde',
										'slc_tipoMolde',
										'chk_modificar',
										'int_posicaox',
										'int_posicaoy',
										'int_posicaogx',
										'int_posicaogy',
										'str_diretorioMoldeAux'
										);
			f = document;
			d = document.frm;
			
			var $arrayValor = new Array 
			(
				retornaUrlAjax('', new Array ('"','','"'), 	new Array ('' ,$str_acao,'')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,$codSeq, '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('id_moldes').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_nomeMolde.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt($diretorioDestino, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('slc_tipoMolde').value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(f.getElementById('chk_modificar').checked.toString().toUpperCase(), $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.int_posicaox.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.int_posicaoy.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.int_posicaogx.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.int_posicaogy.value, $codSeq, true), '')),
				retornaUrlAjax('', new Array ('"','','"'),  new Array ('' ,sequenceCrypt(d.str_diretorioMoldeAux.value, $codSeq, true), ''))
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
    <td class="adm_med_grupoForm_top_02" align="center"><span class="adm_fonteResTop_01">Moldes Banners</span></td>
    <td class="adm_med_grupoForm_top_03"><input name="id_moldes" id="id_moldes" type="hidden" disabled="disabled" maxlength="8" readonly="true" value="<?php echo $id_moldes;?>"></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05"></td>
    <td rowspan="2" class="adm_COMUM_med_grupoForm_top_05" align="center">
		<img src="<?php echo $objConfiguracao->getDiretorioIcons();?>/moldeBannerG.png" width="32" height="32">
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
                <td width="24%" align="right">Tipo de Molde:&nbsp;</td>
                <td width="24%" align="left">
                	<select name="slc_tipoMolde" id="slc_tipoMolde" class="adm_formResCombo_01" style="width:125" title="Tipo de Molde">
						<option value="Banner Topo" <?php echo $objMoldes->str_tipoMolde=='Banner Topo'?'selected':'';?>  title="Banner Topo" >Banner Topo</option>
                        <option value="Banner Medio Largo" <?php echo $objMoldes->str_tipoMolde=='Banner Medio Largo'?'selected':'';?>  title="Banner Medio Largo" >Banner Medio Largo</option>
                        <option value="Banner Medio Curto" <?php echo $objMoldes->str_tipoMolde=='Banner Medio Curto'?'selected':'';?>  title="Banner Medio Curto" >Banner Medio Curto</option>
						<option value="Banner Baixo" <?php echo $objMoldes->str_tipoMolde=='Banner Baixo'?'selected':'';?>  title="Banner Baixo" >Banner Baixo</option>
               	  	</select>
                </td>
                <td colspan="2" align="right">Imagem:&nbsp;</td>
                <td width="38%" colspan="3" align="left"><input name="str_diretorioMolde" type="file" class="adm_formGrupoTxt_01" lang="pt" onchange="guardaValorIniciado(this);" /><input name="str_diretorioMoldeAux" id="*" type="hidden" value="<?php echo $objMoldes->str_diretorioMoldeAux;?>" title="Arquivo"></td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Posi&ccedil;&atilde;o X:&nbsp;</td>
                <td align="left"><input name="int_posicaox" id="*" type="text" class="adm_formGrupoTxt_01" style="width:25;" maxlength="3" value="<?php echo $objMoldes->int_posicaox;?>"  OnKeyPress="return retornaNumeros(event,this);" title="Posi��o X" ></td>
                <td colspan="2" align="right">Posi&ccedil;&atilde;o Y:&nbsp;</td>
                <td colspan="3" align="left"><input name="int_posicaoy" id="*" type="text" class="adm_formGrupoTxt_01" style="width:25;" maxlength="3" value="<?php echo $objMoldes->int_posicaoy;?>"  OnKeyPress="return retornaNumeros(event,this);" title="Posi��o Y" ></td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Posi&ccedil;&atilde;o GX:&nbsp;</td>
                <td align="left"><input name="int_posicaogx" id="*" type="text" class="adm_formGrupoTxt_01" style="width:25;" maxlength="3" value="<?php echo $objMoldes->int_posicaogx;?>"  OnKeyPress="return retornaNumeros(event,this);" title="Posi��o GX" ></td>
                <td colspan="2" align="right">Posi&ccedil;&atilde;o GY:&nbsp;</td>
                <td colspan="3" align="left"><input name="int_posicaogy" id="*" type="text" class="adm_formGrupoTxt_01" style="width:25;" maxlength="3" value="<?php echo $objMoldes->int_posicaogy;?>" OnKeyPress="return retornaNumeros(event,this);" title="Posi��o GY" ></td>
              </tr>
              <tr>
                <td colspan="7" height="12"></td>
              </tr>
              <tr>
                <td align="right">Nome do Molde:&nbsp;</td>
                <td align="left"><input name="str_nomeMolde" id="*" type="text" class="adm_formGrupoTxt_01" style="width:125;" maxlength="15" value="<?php echo $objMoldes->str_nomeMolde;?>" onblur="validaNomeProprio(this);" title="Nome do Molde" ></td>
                <td colspan="2" align="right">Modificavel:&nbsp;</td>
                <td colspan="3" align="left"><input name="chk_modificar" id="chk_modificar" type="checkbox" <?php echo $objMoldes->bln_modificar=='t'?'checked':'';?> onclick="guardaValorIniciado(this);"  onchange="guardaValorIniciado(this);" title="Modificavel" /><input id="chk_modificarAux" type="hidden" value="<?php echo $objMoldes->bln_modificarAux;?>"></td>
              </tr>
              <tr>
                <td colspan="7" height="100"></td>
              </tr>
              <tr>
                <td colspan="7" background="<?php echo $objConfiguracao->getDirTheme();?>/adm_med_fundo_Inf.gif" style="height: 128px;" align="center" valign="top">
                    <table width="570" border="0" cellspacing="0" cellpadding="0" class="adm_fonteFormGrupo_01">
                      <tr>
                        <td width="56"></td>
                        <td colspan="3" class="adm_fonteFormInf_01" height="22">Este formul&aacute;rio permite manter variedades de moldes de banners para o layout</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="12"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td width="92" align="right" class="adm_fonteFormInf_02" style="vertical-align:text-top;">Posi&ccedil;&atilde;o X -&nbsp;</td>
                        <td width="412">Posi&ccedil;&atilde;o horizontal do texto menor do molde cadastrado.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td align="right" class="adm_fonteFormInf_02" style="vertical-align:text-top;">Posi&ccedil;&atilde;o Y -&nbsp;</td>
                        <td>Posi&ccedil;&atilde;o vertical do texto menor do molde cadastrado.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td align="right" class="adm_fonteFormInf_02" style="vertical-align:text-top;">Posi&ccedil;&atilde;o GX -&nbsp;</td>
                        <td>Posi&ccedil;&atilde;o horizontal do texto maior do molde cadastrado.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td align="right" class="adm_fonteFormInf_02" style="vertical-align:text-top;">Posi&ccedil;&atilde;o GY -&nbsp;</td>
                        <td>Posi&ccedil;&atilde;o vertical do texto maior do molde cadastrado.</td>
                      </tr>
                      <tr>
                        <td colspan="4" height="7"></td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td align="right" class="adm_fonteFormInf_02" style="vertical-align:text-top;">Modificavel -&nbsp;</td>
                        <td>Op&ccedil;&atilde;o que habilita a altera&ccedil;&atilde;o do molde do tipo pelo usu&aacute;rio.</td>
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
		//                           Bot�es do Formul�rio                             //
		//============================================================================//
-->	
        	<table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center">
                	<input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" class="adm_formBotao_01" value="Novo" onclick="atribuirItem();">

                    <input name="btSubmit" type="<?php echo $btn_botaoC;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Cadastrar" onclick="UploadImagens('MOLDES', 'Cadastrar');">
                    	&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Alterar" onclick="UploadImagens('MOLDES', 'Alterar');">
                    	&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="btSubmit" type="<?php echo $btn_botaoNAE;?>" <?php echo $objConfiguracao->getBln_modifica();?> class="adm_formBotao_01" value="Excluir" onclick="UploadImagens('MOLDES', 'Excluir');">
                </td>
              </tr>
            </table>
<!--
		//============================================================================//
		//                         Final Bot�es do Formul�rio                         //
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
<iframe name="iframeUpload" id="iframeUpload" src="#" style="width:0; height:0; display:none;"></iframe>
<!--
		//============================================================================//
		//                        Final Tabela Conteudo Pagina                        //
		//============================================================================//
-->