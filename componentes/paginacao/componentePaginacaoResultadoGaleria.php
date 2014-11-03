<script>
	var $arrayNome 	= new Array ('','','');
	var $arrayValor = new Array ('var $arrayFotosGaleria = [', document.getElementById('arrayFotosGaleria').value, ']');
	eval(retornaUrlAjax('', $arrayNome, $arrayValor));
	function apresentaImagemPrincipal($imagem)
	{
		//document.getElementById("imagemPrincipal").style.backgroundPosition = '210px 150px';
		//document.getElementById("imagemPrincipal").style.backgroundImage 	= "url('adm/icons/CarregamentoAjax.gif')";
		if ($imagem == '/semFoto.jpg')
		{
			//document.getElementById("imagemPrincipal").style.backgroundPosition = '0px 0px';
			document.getElementById("imagemPrincipal").style.backgroundImage = "url('imovel/MsemFoto.jpg')";
		}else
		{
			var $arrayNome 	= new Array ("url('","imovel/M","')");
			var $arrayValor = new Array ('',$imagem,'');
			
			//document.getElementById("imagemPrincipal").style.backgroundPosition = '0px 0px';
			document.getElementById("imagemPrincipal").style.backgroundImage = retornaUrlAjax('', $arrayNome, $arrayValor); 
		}
	}
</script>
<?php function cPaginacaoResultadoGaleria($objConexao, $objConfiguracao,$objPaginacao,$query)
	{
		$objConfiguracao->atribuirImovelInicial($objConexao, $objConexao->retornaResultado($query,$objPaginacao->contador-1,"id_imovel"));
		if ($objConfiguracao->getDt_entrega() == "")
		{
			$dataEntrega = "Data da Entrega&nbsp;&nbsp;".$objConfiguracao->retornaDataAtual('Numerico', 'Interface');
		}else
		{
			$dataEntrega = "Data da Entrega&nbsp;&nbsp;".$objConfiguracao->retornaDataNumerica($objConfiguracao->getDt_entrega(), 'DATA_COMPLETA');
		}
		$objConfiguracao->contadorInicial++;

		/*
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"id_proprietario");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_tipoimovel");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_subtipoimovel");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_situacaoimovel");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_mobiliado");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"int_quarto");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"int_sala");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"int_banheiro");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"int_suite");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"int_garagem");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_areaprivativa");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_areaterreno");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_areatotal");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_unidadeprivativa");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_unidadeterreno");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_unidadetotal");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_bairro");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"id_bairro");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_tiponegocio");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_subtiponegocio");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_valorimovel");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_valoriptu");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_valorcondominio");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_valortaxasextras");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"bln_vervalorimovel");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"bln_vervaloroutros");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_descricaoimovel");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"dt_entrega");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_construtora");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_empreendimento");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"bln_promocao");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"bln_ativo");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"id_imagensimovel");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_imagensimovel");
		$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_diretorioimagensimovel");
	*/

	$arrayFotosGaleria = '';
	$cont = 0;
	while ($array = $objConexao->retornaArray($query))
	{
		$cont++;
		
		$arrayFotosGaleria .= "{'caption': 'Galeria de Fotos ".$objConfiguracao->codifiStringBancoInterface($objConexao, $objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_tipoimovel").' '.$objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_bairro"))."', 'url': '".str_replace($objConfiguracao->retornaNomePaginaAtual(), "", $_SERVER['SCRIPT_NAME']).$objConfiguracao->getDirImovel().'M'. $objConfiguracao->retornoImagemGaleria($array['str_diretorioimagensimovel'])."'}";
			
		if ($objConexao->contaLinhas($query) != $cont)
		{
			$arrayFotosGaleria .= ",";			
		}
	}
	if (isset($_POST["id_imagem"]))
	{
		$imagemPrincipal="";
		for ($i=-1; $i<=2; $i++)
		{
			if ($_POST["id_imagem"] == $objConexao->retornaResultado($query,($objPaginacao->contador+($i)),"id_imagensimovel"))
			{
				$imagemPrincipal = $objConexao->retornaResultado($query,($objPaginacao->contador+($i)),"str_diretorioimagensimovel");
			}
		}
		if ($imagemPrincipal == "")
		{
			$imagemPrincipal = $objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_diretorioimagensimovel");
		}
	}
?>
<table width="577" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td rowspan="7" style="background-image:url(<?php echo $objConfiguracao->getDirImovel().'M'. $objConfiguracao->retornoImagemGaleria($imagemPrincipal);?>); background-repeat:no-repeat;" id="imagemPrincipal" align="right" valign="top">
		<!-- ### IMAGEM DE FUNDO GALERIA GRANDE ###-->
        <!-- inicio Tabela Mostra Foto Grande -->
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="8" class="top_grupoRes_top_01"></td>
                    <td width="261" class="top_grupoRes_top_02" style="width:261px;"><span class="adm_fonteResTop_01">Galeria de Imagens</span></td>
                    <td width="31" class="top_grupoRes_top_03"></td>
                    <td width="63" class="top_grupoRes_top_04"><?php echo $objPaginacao->mostraPaginacao($objConfiguracao);?></td>
                    <td width="95"><img src="<?php echo $objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeMostraGaleria_01();?>" width="95" height="24"></td>
                    <td></td>
                </tr>
                <tr>
                  <td colspan="5"><img src="<?php echo $objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeMostraGaleria_03();?>" width="458" height="342" style="cursor:pointer;" onclick="return GB_showImageSet($arrayFotosGaleria, 1);" title="Clique para Visualizar as Fotos em Slide"></td>
                  <td></td>
                  </tr>
                <tr>
                  <td width="8"></td>
                  <td width="261"></td>
                  <td width="31"></td>
                  <td width="63"></td>
                  <td width="95"></td>
                  <td></td>
              </tr>
            </table>
        <!-- Fim Tabela Mostra Foto Grande -->
        </td>
		<td rowspan="7" width="8"></td>
		<td class="banner_molde_galeriaRes_02" background="<?php echo $objConfiguracao->getDirImovel().$objConfiguracao->getDirMiniImovel(). $objConfiguracao->retornoImagemGaleria($objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_diretorioimagensimovel"));?>"><img src="<?php echo $objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeMostraGaleria_02();?>" width="111" height="89" style="cursor: pointer;" onclick="apresentaImagemPrincipal('<?php echo  $objConfiguracao->retornoImagemGaleria($objConexao->retornaResultado($query,$objPaginacao->contador-1,"str_diretorioimagensimovel"));?>');"></td>
		<td colspan="2" height="89"></td>
	</tr>
	<tr>
	  	<td height="3" colspan="2"></td>
		<td colspan="2" height="3"></td>
	</tr>
	<tr>
	  	<td class="banner_molde_galeriaRes_02" background="<?php echo $objConfiguracao->getDirImovel().$objConfiguracao->getDirMiniImovel(). $objConfiguracao->retornoImagemGaleria($objConexao->retornaResultado($query,$objPaginacao->contador,"str_diretorioimagensimovel"));?>"><img src="<?php echo $objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeMostraGaleria_02();?>" width="111" height="89" style="cursor: pointer;" onclick="apresentaImagemPrincipal('<?php echo  $objConfiguracao->retornoImagemGaleria($objConexao->retornaResultado($query,$objPaginacao->contador,"str_diretorioimagensimovel"));?>');"></td>
		<td colspan="2" height="89"></td>
	</tr>
	<tr>
	  	<td height="4"></td>
		<td height="4"></td>
		<td colspan="2" height="4"></td>
	</tr>
	<tr>
	  <td class="banner_molde_galeriaRes_02" background="<?php echo $objConfiguracao->getDirImovel().$objConfiguracao->getDirMiniImovel(). $objConfiguracao->retornoImagemGaleria($objConexao->retornaResultado($query,$objPaginacao->contador+1,"str_diretorioimagensimovel"));?>"><img src="<?php echo $objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeMostraGaleria_02();?>" width="111" height="89" style="cursor: pointer;" onclick="apresentaImagemPrincipal('<?php echo  $objConfiguracao->retornoImagemGaleria($objConexao->retornaResultado($query,$objPaginacao->contador+1,"str_diretorioimagensimovel"));?>');"></td>
		<td colspan="2" height="89"></td>
	</tr>
	<tr>
	  	<td height="4"></td>
		<td height="4"></td>
		<td colspan="2" height="4"></td>
	</tr>
	<tr>
	  <td background="<?php echo $objConfiguracao->getDirImovel().$objConfiguracao->getDirMiniImovel(). $objConfiguracao->retornoImagemGaleria($objConexao->retornaResultado($query,$objPaginacao->contador+2,"str_diretorioimagensimovel"));?>" class="banner_molde_galeriaRes_02" ><img src="<?php echo $objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeMostraGaleria_02();?>" width="111" height="89" style="cursor: pointer;" onclick="apresentaImagemPrincipal('<?php echo  $objConfiguracao->retornoImagemGaleria($objConexao->retornaResultado($query,$objPaginacao->contador+2,"str_diretorioimagensimovel"));?>');"></td>
		<td colspan="2" height="89"></td>
	</tr>
	<tr>
	  <td width="458"></td>
	  <td width="8"></td>
	  <td width="111"></td>
	  <td colspan="2"></td>
	</tr>
</table>
<input id="arrayFotosGaleria" type="hidden" value="<?php echo $arrayFotosGaleria;?>">
<?php }
?>