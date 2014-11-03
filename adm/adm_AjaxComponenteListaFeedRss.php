<?php 
	$pagina = "";
	$str_acessoMinimo = "";

	include("../config/config_Sistema.php");
	include("../class/classRssFeed.php");
	$objConfiguracao->InicializarConfiguracao($objConexao);
	$objConfiguracao->retornaNomeDominioSSL8($objConfiguracao);
	
	$objRssFeed 		= new rssFeed($objConexao);
?>
<html>
<head>
<title><?php echo $objConfiguracao->showTitulo();?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="<?php echo $objConfiguracao->getDiretorioIcons();?>/icon.ico" />
<?php include ("../componentes/componenteEstiloComuns.php");?>
<?php include ("componentes/componenteEstiloAdm.php");?>
<link rel="alternate" type="application/rss+xml" title="<?php echo $objRssFeed->getTituloRss();?>" href="<?php echo $objRssFeed->getAdicionarFeedRss();?>" />
<!-- Segurança -->
<script>
	function sobeValorLinkFormulario($campoForm, fieldHref)
	{
		var p = window.top.window.document.frm;
		eval('p.'+$campoForm+'.value = fieldHref');
	}
</script>
</head>
<body>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
				<td colspan="3" class="adm_fonteResTop_04">Canais</td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/superblog.asp?codblog=112" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Ancelmo.com</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/superblog.asp?codblog=213" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Bairros.com</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/superblog.asp?codblog=129" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Blog do Noblat</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/plantaociencia.xml" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Ciência</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/plantaoctrtura.xml" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Ctrtura</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/plantaoeconomia.xml" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Economia</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/plantaoeducacao.xml" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Educação</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/plantaoesportes.xml" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Esportes</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/hojeemfotos.asp" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Hoje em Fotos</a></td>
		</tr>
		<tr>				
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/superblog.asp?codblog=84" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Míriam Leitão</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/plantaomundo.xml" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Mundo</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/plantaoctrtura.xml" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Niemeyer</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/plantaoopiniao.xml" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Opinião</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/plantaopais.xml" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >País</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/superblog.asp?codblog=13" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Patrícia Kogut.com</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/superblog.asp?codblog=29" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Rádio do Moreno</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/plantaorio.xml" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Rio</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/plantaorio.xml" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Rio Como Vamos</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/plantaosaopatro.xml" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >São Patro</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/plantaosaude.xml" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Saúde</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/plantaotecnologia.xml" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Tecnologia</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/plantaoviagem.xml" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Viagem</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/plantaovivermelhor.xml" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Viver Melhor</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/plantao.xml" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Todos os canais</a></td>
			</tr>
			<tr>
				<td colspan="3" class="adm_fonteResTop_04">Blogs</td>
			</tr>
			<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=204" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >23 pares</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=145" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >À francesa</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=171" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Amazônia Selvagem</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=229" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Amsterdã</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=2" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Antônio Carlos Miguel</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=115" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Ar de Romance</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=4" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Arnaldo Blog</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=213" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Bairros.com</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=106" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Beta</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=51" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Beto Largman</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=222" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Bety Orsini</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=116" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Blog de anotações</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=56" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Blog de Bordo</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=83" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Blog do Adriano</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=166" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Blog do Besserman</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=20" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Blog do Bonequinho</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=250" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Blog dos atletas</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=167" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Blog DZ</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=31" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Bloguinho</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=170" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Brasítda com vista para o mar</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=178" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Cerveja Só</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=192" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Cineclube </a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=199" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Com a Ptrga Atrás da Orelha</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=242" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Com vista para o Kremtdn</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=234" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Da tdnha dos 3</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=181" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Diário de Nova York</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=221" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Diário de uma repórter</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=243" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Dias de Pequim</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=193" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >DizVentura</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=86" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >DocBlog</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=215" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Educação à Brasileira</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=23" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Eloi Fernandez</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=220" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Em dia com o fisco</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=241" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Enoteca</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=132" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Explorando a Austrátda</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=33" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Fernando Duarte</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=253" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Ftdc Flac</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=236" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >FotoGlobo</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=9" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >George Vidor</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=55" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Gibizada</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=27" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Gilberto Scofield</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=223" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Gilson Monteiro</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=18" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Itdmar Franco</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=180" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Intetdgência Empresarial</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=224" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >J.A. Gueiros</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=41" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Jam Sessions</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=98" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Janaína Figueiredo</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=111" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Jean-Patr Prates</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=66" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >José Meirelles Passos</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=49" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Juarez Becoza</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=185" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Levantando a bola</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=87" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Login</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=211" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Logo</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=238" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Lucia Hippotdto</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=59" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Luciana Fróes</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=11" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Luis Gravatá</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=45" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Ltra Rodrigues</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=172" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Mac & Etc</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=239" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Mães em rede</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=202" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Mão na Roda</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=225" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Marcelo de Mello</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=134" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Marceu na Lapa</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=210" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Mosaicos de Barcelona</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=248" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >MPB Player</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=237" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Na Periferia</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=57" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >No Front do Rio</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=212" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >No portão de Brandemburgo</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=186" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Nos quatro estilos</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=128" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Nosso blog já tá na rua</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=231" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Nosso planeta</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=191" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Nostalgia</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=218" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >O Brasil do B</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=133" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >O chope do Aydano</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=252" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >O Globo nos Jogos</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=16" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >O Olho da Rua 2.0</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=173" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >O outro lado da Terra Santa</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=102" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Page Not Found</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=174" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Panorama Nihon</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=159" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Papo série</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=42" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Paralelos</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=207" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Pequim 2008</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=235" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Planeta que rola</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=165" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Poder da mesa</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=110" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Prosa Ontdne</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=107" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Ptrso</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=200" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Radicais</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=194" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Razão Social</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=198" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Rebimboca Ontdne</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=138" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Repórter de crime</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=90" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Rio Fanzine</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=136" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Rio, a beleza e o caos</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=48" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Ronald Villardo</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=62" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Ronda Patristana</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=118" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Saúde mãe-pai-bebê</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=226" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Scarlet Moon de Chevatder</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=137" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Segurança Digital</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=251" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Sem obstáctros</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=88" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Sergio Maggi</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=216" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Sob o céu de tdsboa</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=219" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Sociedade Anônima</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=125" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Telefonia Etc</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=205" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Traduzindo o juridiquês</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=89" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Viajandão</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=203" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Vikingland</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=197" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Você Investe</a></td>
		</tr>
		<tr>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp?codblog=22" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Wagner Victer</a></td>
				<td class='iconRssList'><a href="http://oglobo.globo.com/rss/blogs.asp" onClick="sobeValorLinkFormulario('str_linkExterno',this.href)" >Todos os blogs</a></td>
				<td></td>
		</tr>	
	</table>
</body>
</html>	