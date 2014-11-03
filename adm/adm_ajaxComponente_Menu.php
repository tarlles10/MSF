<?php header("Content-Type: text/html; charset=ISO-8859-1",true);
	$pagina = "";
	$str_acessoMinimo = "";

	include("../config/config_Sistema.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	$objConfiguracao->atribuiNivelAcessoIcones($objUsuario->getNivelAcesso());
	//============================================================================//
	//      Criptografa os Links das paginas Ajax que passa por referencia        //
	//============================================================================//
	$cont = $objConfiguracao->sequenceCrypt('', true, true);
	
	$planoContrato 		= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_planoContratos.php', 	$cont, true);
	$contrato			= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_contrato.php', 		$cont, true);
	$usuario 			= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_usuario.php', 		$cont, true);
	$configuracoes 		= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_configuracoes.php', 	$cont, true);
	$moldesBanner 		= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_moldesBanner.php', 	$cont, true);
	$banners 			= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_banners.php', 		$cont, true);
	$municipios 		= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_municipios.php', 		$cont, true);
	$construtoras 		= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_construtoras.php', 	$cont, true);
	$imoveis 			= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_imoveis.php', 		$cont, true);
	$proprietario		= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_proprietario.php',	$cont, true);
	$rssFeed			= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_rssFeed.php', 		$cont, true);
	$newsLetters		= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_newsLetters.php', 	$cont, true);	
	

	//============================================================================//
?>
    <!-- Inicio do Menu -->
    <table width="90%" border="0" cellspacing="0" cellpadding="0">
      <tr <?php echo $objConfiguracao->ico_planoContrato=='PB'?'style="display:none;"':'';?>>
        <td colspan="2" height="14"></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_planoContrato=='PB'?'style="display:none;"':'';?>>
        <td><img src="<?php echo $objConfiguracao->getDiretorioIcons()."/planoContrato".$objConfiguracao->ico_planoContrato.".png";?>" width="24" height="24"></td>
        <td class="adm_fonteMenuEsq_01"><a href="#" onclick="menuConcatenacaoStringsParametro('<?php echo $planoContrato;?>', '<?php echo $cont;?>');">Plano de Contrato</a></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_contrato=='PB'?'style="display:none;"':'';?>>
        <td colspan="2" height="14"></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_contrato=='PB'?'style="display:none;"':'';?>>
        <td><img src="<?php echo $objConfiguracao->getDiretorioIcons()."/contrato".$objConfiguracao->ico_contrato.".png";?>" width="24" height="24"></td>
        <td class="adm_fonteMenuEsq_01"><a href="#" onclick="menuConcatenacaoStringsParametro('<?php echo $contrato;?>', '<?php echo $cont;?>');">Contrato</a></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_usuario=='PB'?'style="display:none;"':'';?>>
        <td colspan="2" height="14"></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_usuario=='PB'?'style="display:none;"':'';?>>
        <td><img src="<?php echo $objConfiguracao->getDiretorioIcons()."/usuario".$objConfiguracao->ico_usuario.".png";?>" width="24" height="24"></td>
        <td class="adm_fonteMenuEsq_01"><a href="#" onclick="menuConcatenacaoStringsParametro('<?php echo $usuario;?>', '<?php echo $cont;?>');">Usuário</a></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_configuracoes=='PB'?'style="display:none;"':'';?>>
        <td colspan="2" height="14"></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_configuracoes=='PB'?'style="display:none;"':'';?>>
        <td><img src="<?php echo $objConfiguracao->getDiretorioIcons()."/configuracao".$objConfiguracao->ico_configuracoes.".png";?>" width="24" height="24"></td>
        <td class="adm_fonteMenuEsq_01"><a href="#" onclick="menuConcatenacaoStringsParametro('<?php echo $configuracoes;?>', '<?php echo $cont;?>');">Configuraç&otilde;es</a></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_moldesBanner=='PB'?'style="display:none;"':'';?>>
        <td colspan="2" height="14"></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_moldesBanner=='PB'?'style="display:none;"':'';?>>
        <td><img src="<?php echo $objConfiguracao->getDiretorioIcons()."/moldeBanner".$objConfiguracao->ico_moldesBanner.".png";?>" width="24" height="24"></td>
        <td class="adm_fonteMenuEsq_01"><a href="#" onclick="menuConcatenacaoStringsParametro('<?php echo $moldesBanner;?>', '<?php echo $cont;?>');">Moldes Banner</a></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_banners=='PB'?'style="display:none;"':'';?>>
        <td colspan="2" height="14"></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_banners=='PB'?'style="display:none;"':'';?>>
        <td><img src="<?php echo $objConfiguracao->getDiretorioIcons()."/banners".$objConfiguracao->ico_banners.".png";?>" width="24" height="24"></td>
        <td class="adm_fonteMenuEsq_01"><a href="#" onclick="menuConcatenacaoStringsParametro('<?php echo $banners;?>', '<?php echo $cont;?>');">Banners</a></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_municipios=='PB'?'style="display:none;"':'';?>>
        <td colspan="2" height="14"></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_municipios=='PB'?'style="display:none;"':'';?>>
        <td><img src="<?php echo $objConfiguracao->getDiretorioIcons()."/municipios".$objConfiguracao->ico_municipios.".png";?>" width="24" height="24"></td>
        <td class="adm_fonteMenuEsq_01"><a href="#" onclick="menuConcatenacaoStringsParametro('<?php echo $municipios;?>', '<?php echo $cont;?>');">Municípios</a></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_construtoras=='PB'?'style="display:none;"':'';?>>
        <td colspan="2" height="14"></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_construtoras=='PB'?'style="display:none;"':'';?>>
        <td><img src="<?php echo $objConfiguracao->getDiretorioIcons()."/construtoras".$objConfiguracao->ico_construtoras.".png";?>" width="24" height="24"></td>
        <td class="adm_fonteMenuEsq_01"><a href="#" onclick="menuConcatenacaoStringsParametro('<?php echo $construtoras;?>', '<?php echo $cont;?>');">Construtoras</a></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_imoveis=='PB'?'style="display:none;"':'';?>>
        <td colspan="2" height="14"></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_imoveis=='PB'?'style="display:none;"':'';?>>
        <td><img src="<?php echo $objConfiguracao->getDiretorioIcons()."/imovel".$objConfiguracao->ico_imoveis.".png";?>" width="24" height="24"></td>
        <td class="adm_fonteMenuEsq_01"><a href="#" onclick="menuConcatenacaoStringsParametro('<?php echo $proprietario;?>', '<?php echo $cont;?>');">Imóveis</a></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_rssFeed=='PB'?'style="display:none;"':'';?>>
        <td colspan="2" height="14"></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_rssFeed=='PB'?'style="display:none;"':'';?>>
        <td><img src="<?php echo $objConfiguracao->getDiretorioIcons()."/rss".$objConfiguracao->ico_rssFeed.".png";?>" width="24" height="24"></td>
        <td class="adm_fonteMenuEsq_01"><a href="#" onclick="menuConcatenacaoStringsParametro('<?php echo $rssFeed;?>', '<?php echo $cont;?>');">RSS Feed</a></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_newsLetters=='PB'?'style="display:none;"':'';?>>
        <td colspan="2" height="14"></td>
      </tr>
      <tr <?php echo $objConfiguracao->ico_newsLetters=='PB'?'style="display:none;"':'';?>>
        <td><img src="<?php echo $objConfiguracao->getDiretorioIcons()."/newsletters".$objConfiguracao->ico_newsLetters.".png";?>" width="24" height="24"></td>
        <td class="adm_fonteMenuEsq_01"><a href="#" onclick="menuConcatenacaoStringsParametro('<?php echo $newsLetters;?>', '<?php echo $cont;?>');">NewsLetters</a></td>
      </tr>
    </table>
    <!-- Fim do Menu -->