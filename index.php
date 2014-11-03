<?php 
	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");
	include("class/classRssFeed.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	$objRssFeed 		= new rssFeed($objConexao);


	//============================================================================//
	//      Condições utilizadas controlar a cotação dos imoveis                  //
	//============================================================================//
	if (isset($_GET["cad"]) || !empty($_GET["cad"]))
	{
		$objConfiguracao->atualizaCotacaoImovel($objConexao, $_GET["cad"], $_GET["id_imovel"]); 
	}
	
	//============================================================================//
	// Decriptografação utilizada para  validaçao do cadastro de Newsletters      //
	//============================================================================//
	if (isset($_GET["validacaoNewslette"]))
	{ 
		$condicionalComparacao = str_replace('"','',$objConfiguracao->sequenceCrypt($_GET["validacaoNewslette"], $_GET["codSec"], false));
		if ($condicionalComparacao === "validacao")
		{
			include("class/classNewsletter.php");
			$objNewsletter 	= new Newsletter($objConfiguracao, $objConexao);
			$str_email 		= str_replace("'","",$objConfiguracao->sequenceCrypt($_GET["str_email"], $_GET["codSec"], false));
			$objNewsletter->validaUsuarioNewsLetter($objConexao, $str_email);
		}
	}
	//============================================================================//
	// Decriptografação utilizada para gerar boleto usuário portal				  //
	//============================================================================//
	if (isset($_GET["validacaoBoleto"]))
	{ 
		$condicionalComparacao = str_replace('"','',$objConfiguracao->sequenceCrypt($_GET["validacaoBoleto"], $_GET["codSec"], false));
		
		if ($condicionalComparacao === "validadoGeradorBoleto")
		{
			include("class/classContratos.php");
			$objContratos 	= new contratos($objConexao);
			$id_boleto 		= str_replace("'","",$objConfiguracao->sequenceCrypt($_GET["auxfinanceiro"], $_GET["codSec"], false));
			$objContratos->atribuirQueryGeracaoBoleto($objConexao, $objConfiguracao, $id_boleto);
			
		}
	}

	//============================================================================//
	//      Condições utilizadas para informar o conteudo a carregar              //
	//============================================================================//		
	if (!isset($_GET["cod"]))
	{
		$_GET["cod"] = 'simples';
	}
	//============================================================================//


	if (!isset($_GET["id_imovel"]) || !isset($_GET["id_imagem"]))
	{
		$_GET["id_imovel"] = '';
		$_GET["id_imagem"] = '';
	}
	if (!isset($_GET["resultado"]))
	{
		$_GET["resultado"] = 'false';
	}
?>
<html>
<head>
<!-- Google Webmaster Tools -->
<meta name="verify-v1" content="6OL5RHKN1AfUbB4+J1fj8h+wu/eoUmuTk/bSgWXwRtc=" >
<!-- Ícone para desktop do iphone -->
<link rel="apple-touch-icon" href="/apple-touch-icon.png"/>
<title><?php echo $objConfiguracao->showTitulo();?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php echo strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') === false?'<link href="'.$objConfiguracao->getDiretorioIcons().'favicon.gif" type="image/gif" rel="icon" />':'<link rel="shortcut icon" href="'.$objConfiguracao->getDiretorioIcons().'icon.ico" />';
	include("componentes/componenteEstiloComuns.php");
	include("componentes/componenteEstilo.php");
?>
<style type="text/css">body{margin-left:0px;margin-top:0px;margin-right:0px;margin-bottom:0px;font-size:10px;}</style>
<link rel="alternate" type="application/rss+xml" title="<?php echo $objRssFeed->getTituloRss();?>" href="<?php echo $objRssFeed->getAdicionarFeedRss();?>" />
<link rel="stylesheet" type="text/css" href=   "js/css/editor.css">
<link rel="stylesheet" type="text/css" href=   "js/css/black-tie/jquery-ui-1.7.1.custom.css">
<!-- -->
<script language="javascript" type="text/javascript" src   ="js/jquery-ui/jquery-1.3.2.min.js"		></script> 
<script language="javascript" type="text/javascript" src   ="js/jquery-ui/jquery-ui-1.7.1.js"		></script>
<script language="javascript" type="text/javascript" src   ="js/jquery.include.js"					></script>
<script language="javascript" type="text/javascript" src   ="js/comuns/ajax.js"						></script>
<script language="javascript" type="text/javascript" src   ="js/comuns/utils.js"					></script>
<!-- -->
<script>
	$.ImportBasePath =    'js/comuns/';
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
			'funcoesComboMunicipio.js',
//==================================================================//
//					Autenticação Usuário [js/comuns/]				//
//==================================================================//
			'loginUsuario.js'
	]);

	$.ImportBasePath = 'adm/js/comuns/';
	$.include(
	[
//==================================================================//
//					Biblioteca Ajax [adm/js/comuns/]				//
//==================================================================//
			'carregarConteudoMenu.js',
//==================================================================//
//					Biblioteca Formulario [adm/js/comuns/]			//
//==================================================================//
			'gerenciaValorKeydown.js',
			'atribuirItem.js',
//==================================================================//
//					PlanoContratos Calculo [adm/js/comuns/]			//
//==================================================================//
			'guardaValorIniciado.js'
	]);

	$.ImportBasePath = 'adm/js/contratos/';
	$.include(
	
//==================================================================//
//					Validações [adm/js/contratos/]					//
//==================================================================//
			'validacaoContrato.js'
	);

	$.ImportBasePath =    'js/editor/';
	$.include('editor.js');

//##################################################################//
//Formulario biblioteca greybox v5.53								//
//##################################################################//
	var GB_ROOT_DIR =    "js/bibliotecaGreyBox/";
//##################################################################//
//Define por padrão que deve executar a busca (facil ou avançada)	//
//enquanto não existir um outro ajax sendo carregado.				//
//##################################################################//
	var $disableBuscaSimples = false;

</script>
<script language="javascript" type="text/javascript" src=   "js/bibliotecaGreyBox/AJS.js"			></script>
<script language="javascript" type="text/javascript" src=   "js/bibliotecaGreyBox/AJS_fx.js"		></script>
<script language="javascript" type="text/javascript" src=   "js/bibliotecaGreyBox/gb_scripts.js"	></script>
</head>
<body>
<?php if($objConfiguracao->getPortalSemContrato())
	{
		echo"<div align='center' align='center'><img src='ParkImovel.jpg'></div><div align='center' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&copy; ParkImovel, 2008</div><br /><br /><br /><div  class='  ' style='color: #000000;' align='center' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;A CONTA ".$objConfiguracao->showTitulo()." FOI DESATIVADA. ENTRE EM CONTATO COM O SEU CONTRATADO PARA MAIORES INFORMAÇÕES.</div>"; exit();
	}
?>
<div id="menssagem"  style="display:none;"></div>
<div id="metasoftware"></div>
<!-- 
     ############################################################################ 
     #              CODIGO DE MONITORAMENTO DO GOOGLE ANALYTICS                 #
     ############################################################################
-->
<input name="$url" id="$url" type="hidden" />
<script language="javascript" type="text/javascript" >
	document.getElementById('$url').value = document.location;
	if (document.getElementById('$url').value.substring(0,17) != 'http://localhost/')
	{
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	}
</script>
<script language="javascript" type="text/javascript" >
	if (document.getElementById('$url').value.substring(0,17) != 'http://localhost/')
	{
		// www.parkimovel.com.br
		var pageTracker = _gat._getTracker("UA-4826669-8");
		pageTracker._initData();
		pageTracker._trackPageview();
	}
</script>
<!-- 
     ############################################################################ 
     #           FIM DO CODIGO DE MONITORAMENTO DO GOOGLE ANALYTICS             #
     ############################################################################
-->
</body>
</html>
<script language="javascript" type="text/javascript" >
	$resultado	=  <?php echo $_GET["resultado"];?>;
	$pagina 	= '<?php echo $_GET["cod"];?>';
	$id_imovel 	= '<?php echo $_GET["id_imovel"];?>';
	$id_imagem 	= '<?php echo $_GET["id_imagem"];?>';

	if ($pagina == 'simples')
	{
		$linkPagina = 'buscasimples.php?resultado=false';
	}else if ($pagina == 'avancada')
	{
		$linkPagina = 'buscaavancada.php?resultado=false';
	}else if ($pagina == 'buscarsimples')
	{
		$linkPagina = 'buscasimples.php?resultado=true';
	}else if ($pagina == 'buscaravancada')
	{
		$linkPagina = 'buscaavancada.php?resultado=true';
	}else if ($pagina == 'mostrar')
	{
		if ($id_imovel != '' && $id_imagem != '')
		{
			$linkPagina = 'mostraresultado.php?resultado='+$resultado+'&id_imovel='+$id_imovel+'&id_imagem='+$id_imagem;
		}else
		{
			$linkPagina = 'mostraresultado.php?resultado=true';
		}
	}else if ($pagina == 'Solucoes')
	{
		$linkPagina = 'mostraSolucoesParkImovel.php';
	}else if ($pagina == 'faleConosco')
	{
		$linkPagina = 'mostraFaleConosco.php';
	}else
	{
		$linkPagina = 'index.php';
	}
	window.status = "";

	carregar('metasoftware', $linkPagina, 'Carregando o melhor portal Imobiliário do Brasil ...', 'Resultado');
</script>
