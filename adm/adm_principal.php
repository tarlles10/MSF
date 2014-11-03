<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina = "AcessDenied";
	$str_acessoMinimo = "Usuario";

	include("../config/config_Sistema.php");

	//============================================================================//
	//      Condições utilizadas para informar o conteudo a carregar              //
	//============================================================================//		
	$bannerTecnologia='';
	if (!isset($_GET["cod"]))
	{
		$_GET["cod"] = 'principal';
		$bannerTecnologia='style="background:url('.$objConfiguracao->getDirTheme().'/logosTecnologia.jpg); background-repeat:no-repeat;"  height="176"';
	}
	//============================================================================//
	
	if (!isset($_GET["resultado"]))
	{
		$_GET["resultado"] = 'false';
	}	
	//================================================================================//
	// Criptografa os Links das paginas Ajax que passa por referencia na barra MACOSX //
	//================================================================================//
	$cont = $objConfiguracao->sequenceCrypt('', true, true);
	
	$planoContrato 		= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_planoContratos.php', 	10, true);
	$contrato			= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_contrato.php', 		10, true);
	$usuario 			= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_usuario.php', 		10, true);
	$configuracoes 		= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_configuracoes.php', 	10, true);
	$moldesBanner 		= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_moldesBanner.php', 	10, true);
	$banners 			= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_banners.php', 		10, true);
	$municipios 		= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_municipios.php', 		10, true);
	$construtoras 		= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_construtoras.php', 	10, true);
	$imoveis 			= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_imoveis.php', 		10, true);
	$rssFeed			= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_rssFeed.php', 		10, true);
	$newsLetters		= $objConfiguracao->sequenceCrypt('adm_ajaxComponente_newsLetters.php', 	10, true);

	//============================================================================//

?>
<html>
<head>
<!-- Ícone para desktop do iphone -->
<link rel="apple-touch-icon" href="../apple-touch-icon.png"/>
<title>Sistema Administrativo <?php echo $objConfiguracao->showTitulo()?> :: <?php echo $objConfiguracao->showVersao();?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php echo strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') === false?'<link href="'.$objConfiguracao->getDiretorioIcons().'favicon.gif" type="image/gif" rel="icon" />':'<link rel="shortcut icon" href="'.$objConfiguracao->getDiretorioIcons().'icon.ico" />';
	include("../componentes/componenteEstiloComuns.php");
	include("componentes/componenteEstiloAdm.php");
?>
<style type="text/css">body{margin-left:0px;margin-top:0px;margin-right:0px;margin-bottom:0px;font-size:10px;}</style>

<link rel="stylesheet" type="text/css" href="../js/css/editor.css">
<link rel="stylesheet" type="text/css" href="../js/css/black-tie/jquery-ui-1.7.1.custom.css">
<!-- -->
<script language="javascript" type="text/javascript" src="../js/jquery-ui/jquery-1.3.2.min.js"		></script>
<script language="javascript" type="text/javascript" src="../js/jquery-ui/jquery-ui-1.7.1.js"		></script>
<script language="javascript" type="text/javascript" src="../js/jquery.include.js"					></script>
<script language="javascript" type="text/javascript" src   ="js/comuns/ajax.js"						></script>
<script language="javascript" type="text/javascript" src="../js/comuns/utils.js"					></script>
<!-- -->
<script>
	$.ImportBasePath = '../js/comuns/';
	$.include(
	[
			'alertMenssage.js',
//==================================================================//
//					Segurança [js/comuns/]							//
//==================================================================//
			'criptografia.js',
			'sequenceCrypt.js',
			'retornaUrlAjax.js',
//==================================================================//
//					Validações [js/comuns/]							//
//==================================================================//
			'validaCamposDefault.js',
			'validaEmail.js',
			'validaNewsLetter.js',
			'validaFaleConosco.js',
			'verificaData.js',
//==================================================================//
//					Biblioteca Formulario [js/comuns/]				//
//==================================================================//
			'calendario.js',
			'realizaSubmit.js',
			'executaFuncaoEnter.js',
			'retornaNumeros.js',
			'retornoValorRadioButon.js',
			'formataMascara.js',
			'formataValorDinheiro.js',
			'enviaValorCarregarOutraCombo.js',

//==================================================================//
//					Autenticação Usuário [js/comuns/]				//
//==================================================================//
			'loginUsuario.js'
	]);

	$.ImportBasePath =     'js/comuns/';
	$.include(
	[
			'carregarConteudoMenu.js',
//==================================================================//
//					Biblioteca Formulario [adm/js/comuns/]			//
//==================================================================//
			'gerenciaValorKeydown.js',
			'atribuirItem.js',
			'funcoesComboMunicipio.js',
			'menuConcatenacaoStringsParametro.js',
//==================================================================//
//					PlanoContratos Calculo [adm/js/comuns/]			//
//==================================================================//
			'guardaValorIniciado.js',
			'disableCampoOponente.js',
//==================================================================//
//					Localiza Mapas[adm/js/comuns/]					//
//==================================================================//
			'mostraPaginaLocalizaSatelite.js',
//==================================================================//
//					Apresenta Help[adm/js/comuns/]					//
//==================================================================//			
			'apresentaHelpGoogleTalk.js'
	]);
	
	$.ImportBasePath =     'js/contratos/';
	$.include(
	[		  
//==================================================================//
//					Validações [adm/js/contratos/]					//
//==================================================================//
			'validacaoContrato.js',
			'gerenciaCpfCnpj.js',
			'validarCPF.js',
			'validarCnpj.js',
			'controlePessoaFisica.js'
	]);

	$.ImportBasePath =     'js/planoContratos/';
	$.include(
	
//==================================================================//
//					Validações [adm/js/planoContratos/]				//
//==================================================================//
			'calculaValorSistema.js'
	);

	$.ImportBasePath =     'js/usuario/';
	$.include('controleContratoUsuario.js');

	$.ImportBasePath =     'js/banners/';
	$.include(
	[		  
	
//==================================================================//
//					Validações [adm/js/banners/]					//
//==================================================================//
			'controleFlash.js',
			'enviaValorBanner.js',
			'controleObrigatoriedade.js'
	]);

	$.ImportBasePath =     'js/imovel/';
	$.include(
	[
	
//==================================================================//
//					Validações [adm/js/imovel/]						//
//==================================================================//
			'controlePeriodoNegocio.js',
			'controleSituacaoImovel.js'
	]);

	$.ImportBasePath = '../js/editor/';
	$.include('editor.js');
	
//##################################################################//
//Formulario biblioteca greybox v5.53								//
//##################################################################//
	var GB_ROOT_DIR = "../js/bibliotecaGreyBox/";
</script>
<script language="javascript" type="text/javascript" src="../js/bibliotecaGreyBox/AJS.js"			></script>
<script language="javascript" type="text/javascript" src="../js/bibliotecaGreyBox/AJS_fx.js"		></script>
<script language="javascript" type="text/javascript" src="../js/bibliotecaGreyBox/gb_scripts.js"	></script>
<!--
//##################################################################//
//Formulario biblioteca euDock										//
//##################################################################//
-->
<script language="javascript" type="text/javascript" src="../js/bibliotecaEuDock/euDock.2.0.js"		></script>
<script language="javascript" type="text/javascript" src="../js/bibliotecaEuDock/euDock.Image.js"	></script>
<script language="javascript" type="text/javascript" src="../js/bibliotecaEuDock/euDock.Label.js"	></script>
<script language="javascript" type="text/javascript" >
	function UploadImagens($tipoUpload, $str_acao)
	{
		d = document.frm;
		d.str_acaoBotao.value = $str_acao;
		d.target = "iframeUpload";
		if ($tipoUpload == 'MOLDES')
		{
			d.action 		= "../moldesGeral/adm_componenteUpload.php";
		}else if ($tipoUpload == 'BANNER')
		{
			d.action 		= "../banners/adm_componenteUpload.php";
		}else if ($tipoUpload == 'IMOVEL')
		{
			d.action 		= "../imovel/adm_componenteUpload.php";
		}else if ($tipoUpload == 'ARQUIVO')
		{
			d.action 		= "../arquivosImovel/adm_componenteUpload.php";
		}		

		d.submit();
	}

	function retornoUpload($diretorioDestino)
	{
		atribuirValoresFormulario(document.getElementById('str_acaoBotao').value, $diretorioDestino);
	}

	function sobeValorLinkFormulario($campoForm, fieldHref)
	{
		var p = window.top.window.document.frm;
		eval('p.'+$campoForm+'.value = fieldHref');
	}
</script>
</head>
<body bgcolor="#FFFFFF">
<form name="frm" method="post" action="" enctype="multipart/form-data">
<div id="menssagem"  style="display:none;"></div>
<div id="help"><div id="conteudoHelp" style="z-index:100; display: none; width: 538px; height: 660px;"></div></div>
<iframe id='helpIframe' style="z-index:50; display: none; position:absolute; margin-top:-5px; margin-left:-35px; top:5%; left:35%; width: 538px; height: 660px; filter: Alpha(Opacity=0, FinishOpacity=0, Style=0, StartX=0, FinishX=0, StartY=0, FinishY=0);" scrolling="no" frameborder="0"></iframe>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
<!--
===============================================================================================================================
Inicio tabela
===============================================================================================================================
-->

<table width="766" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="5"></td>
		<td colspan="5" height="5"></td>
		<td height="5"></td>
	</tr>
	<tr>
		<td colspan="7" height="5"><?php include ("componentes/componenteTopo.php");?></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td colspan="5" height="7"></td>
		<td height="7"></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td colspan="5" width="755" height="121" style="background:url(<?php echo $objConfiguracao->getDirTheme();?>/administrativo_10.jpg); background-repeat:no-repeat; cursor: pointer;" onClick="realizaSubmit('','');" title="Pagina Principal."></td>
		<td height="121"></td>
	</tr>
	<tr>
	  <td width="5"></td>
		<td colspan="5" height="5"></td>
		<td height="5"></td>
	</tr>
	<tr>
	  <td height="37"></td>
		<td colspan="3" background="<?php echo $objConfiguracao->getDirTheme();?>/administrativo_12.jpg" style="background-repeat: no-repeat;"></td>
		<td rowspan="4"></td>
		<td rowspan="4" valign="top"><div id="metasoftware" style="height:466px;"></div></td>
		<td rowspan="4"></td>
	</tr>
	<tr>
	  	<td height="429"></td>
		<td colspan="3" style="background:url(<?php echo $objConfiguracao->getDirTheme();?>/administrativo_24.jpg); background-repeat: no-repeat;" align="right" valign="top">
		<div id="menuEsquerdo"></div>
		</td>
	</tr>
	
	<tr>
	  	<td height="5"></td>
		<td colspan="5" height="5"></td>
	</tr>
	<tr>
		<td colspan="7" height="100" align="left" valign="top"><div id="ResultadoAdministrativo"></div></td>
	</tr>
	<tr>
		<td colspan="7"><?php include ("componentes/componenteBotton2.php");?></td>
	</tr>
	<tr>
		<td width="5"></td>
		<td width="3"></td>
		<td width="5"></td>
		<td width="165"></td>
		<td width="5"></td>
		<td width="577"></td>
		<td width="5" height="5"></td>
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
<input id="codSec" type="hidden" value="">
<input id="str_nomePagina" type="hidden" value="">
<!-- 
=========================
=CONTROLE UPLOAD IMAGENS=
-->
<input id="str_acaoBotao" type="hidden" value="">
<!-- 
=========================
=CONTROLE Configuracao PORTAL=
-->
<input id="id_configuracaoFixo" type="hidden" value="">
<!-- 
=========================
=CONTROLE PROPRIETARIO IMOVEL=
-->
<input id="id_proprietarioFixo" type="hidden" value="">
<!-- 
=========================
=CONTROLE IMOVEL=
-->
<input id="id_imovelFixo" type="hidden" value="">
<!-- 
=========================
=CONTROLE RSS FEED=
-->
<input id="id_rssFixo" type="hidden" value="">
</form>
</body>
</html>
<script language="javascript" type="text/javascript" >
	$resultado	=  <?php echo $_GET["resultado"];?>;
	$pagina 	= '<?php echo $_GET["cod"];?>';

	if ($pagina == 'principal')
	{
		$linkPagina = 'adm_ajaxComponente_Principal.php';
		carregarPaginacao('metasoftware',  $linkPagina, 'Carregando o Sistema Administrativo METASOFTWARE ...');
		carregarPaginacao('ResultadoAdministrativo',  'adm_ajaxComponente_publicidadeInterna.php', '', false);
	}
	carregarPaginacao('menuEsquerdo', 'adm_ajaxComponente_Menu.php', '<span style="color: #FFFFFF;">Carregando Menu...</span>', false);
	
	window.status = "";
</script>
<script language="javascript" type="text/javascript" >
	euEnv.imageBasePath = "../js/bibliotecaEuDock/";
	
	var barMacOs = new euDock();   
	barMacOs.setAnimation(euMOUSE,0.4);
	barMacOs.animFading = euRELATIVE;   
	barMacOs.setObjectAlign('metasoftware',euRIGHT,1,euRIGHT);   
	barMacOs.setIconsOffset(2);
	
	barMacOs.setBar
	(
	   {
			top:{euImage:{image:euEnv.imageBasePath+"barImages/BarTop.png"}},
			vertical:{euImage:{image:euEnv.imageBasePath+"barImages/BarMed.png"}},
			bottom:{euImage:{image:euEnv.imageBasePath+"barImages/BarBotton.png"}}
		}
	);
	
	barMacOs.setAllZoomFunc(euLinear30);

	//Localizar
	barMacOs.addIcon(new Array({euImage:{image:euEnv.imageBasePath+"iconsEuDock/newsletters.png"}},
							   {euLabel:{
										 object  : {euImage:{image:euEnv.imageBasePath+"iconsEuDock/newsletters.png"}},
										 txt     : "NewsLetters",
										 style   : "font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #666666; text-align: center; vertical-align: middle; border: 1px solid #ACACAC; background-color: #FFFFFF;",
										 anchor  : euUP,
										 offsetX : 35,
										 offsetY : -10}}),   
							   {fadingStep : 0.1, 
							    fadingType : euFIXED, 
								link:"<?php echo $newsLetters;?>"}
							 );
							 
	//Imóvel
	barMacOs.addIcon(new Array({euImage:{image:euEnv.imageBasePath+"iconsEuDock/imovel.png"}},
							   {euLabel:{
										 object  : {euImage:{image:euEnv.imageBasePath+"iconsEuDock/imovel.png"}},
										 txt     : "Imóveis",
										 style   : "font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #666666; text-align: center; vertical-align: middle; border: 1px solid #ACACAC; background-color: #FFFFFF;",
										 anchor  : euUP,
										 offsetX : 35,
										 offsetY : -10}}),   
							   {fadingStep : 0.1, 
							    fadingType : euFIXED, 
								link:"<?php echo $imoveis;?>"}
							 );


	//Google Maps
	barMacOs.addIcon(new Array({euImage:{image:euEnv.imageBasePath+"iconsEuDock/googleMaps.png"}},
							   {euLabel:{
										 object  : {euImage:{image:euEnv.imageBasePath+"iconsEuDock/googleMaps.png"}},
										 txt     : "Mapas",
										 style   : "font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #666666; text-align: center; vertical-align: middle; border: 1px solid #ACACAC; background-color: #FFFFFF;",
										 anchor  : euUP,
										 offsetX : 35,
										 offsetY : -10}}),   
							   {fadingStep : 0.1, 
							    fadingType : euFIXED, 
								link:"googleMaps"}
							 );

	//Tutorial
	barMacOs.addIcon(new Array({euImage:{image:euEnv.imageBasePath+"iconsEuDock/tutorial.png"}},
							   {euLabel:{
										 object  : {euImage:{image:euEnv.imageBasePath+"iconsEuDock/tutorial.png"}},
										 txt     : "Tutorial",
										 style   : "font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #666666; text-align: center; vertical-align: middle; border: 1px solid #ACACAC; background-color: #FFFFFF;",
										 anchor  : euUP,
										 offsetX : 35,
										 offsetY : -10}}),   
							   {fadingStep : 0.1, 
							    fadingType : euFIXED, 
								link:""}
							 );
					 
</script>
