<?php 
	$pagina = "";
	$str_acessoMinimo = "";

	include("../config/config_Sistema.php");

?>
<html>
<head>
<title>Sistema Administrativo <?php echo $objConfiguracao->showTitulo()?> :: <?php echo $objConfiguracao->showVersao();?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php include ("../componentes/componenteEstilo.php");?>
<script language="javascript">
	function iprint(d)
	{ 
		d.focus(); 
		window.print(); 
	}
</script>

</head>
<body bgcolor="#FFFFFF">
<form name="frm" method="post" action="">
<div id="contratoImprimir">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
<!--
===============================================================================================================================
Inicio Contrato <img src="template1/margemContrato.png" width="766" height="96">
===============================================================================================================================
-->
	<table width="766" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td align="center" background="template1/margemContrato.png" width="766" height="96" style="text-align:right;"></td>
		<td></td>
	  </tr>
	  <tr>
		<td>
		<div align="center">
			<P>
				<B style="mso-bidi-font-weight: normal">POL&Iacute;TICA DE PRIVACIDADE</B>
			</P>
		</div>
			<p>O <strong>metasoftware</strong> &eacute; um produto/servi&ccedil;o de propriedade da empresa <strong><?php echo $objConfiguracao->getEmpresaRazaoSocial();?></strong>. A comercializa&ccedil;&atilde;o do <strong>metasoftware</strong> se d&aacute; em car&aacute;ter de  &ldquo;licenciamento&rdquo; mediante pagamento para uso do servi&ccedil;o. Ao contratar o <strong>metasoftware</strong>, voc&ecirc; estar&aacute; fornecendo  algumas informa&ccedil;&otilde;es pessoais para o licenciamento em seu nome ou da sua  empresa.<br>
			  <br>
			  Sabemos o quanto &eacute; importante para voc&ecirc; estar seguro sobre  a utiliza&ccedil;&atilde;o dos seus dados pessoais. Por este motivo, a utiliza&ccedil;&atilde;o de suas  informa&ccedil;&otilde;es estar&atilde;o preservadas segundo nossa pol&iacute;tica de privacidade. <br>
			  <br>
			  Ao fazer seu cadastramento pelo site <a href="http://www.parkimovel.com.br/">www.parkimovel.com.br</a> para utiliza&ccedil;&atilde;o  do servi&ccedil;o nele oferecido, voc&ecirc; est&aacute; concordando com os procedimentos  discriminados nesta Pol&iacute;tica de Privacidade e Seguran&ccedil;a. <br>
			  <br>
			  Para assegurar regras claras, o site <strong>ParkImovel</strong> pode alterar esta pol&iacute;tica periodicamente. Recomenda-se sua leitura de tempos  em tempos. <br>
  <strong><br>
  Como s&atilde;o usadas as  informa&ccedil;&otilde;es coletadas?</strong><br>
			  Para fazer seu cadastramento, gerenciamento on-line e pagamento do servi&ccedil;o &eacute;  indispens&aacute;vel o requerimento e utiliza&ccedil;&atilde;o de algumas informa&ccedil;&otilde;es pessoais. Toda  a sua informa&ccedil;&atilde;o pessoal &eacute; armazenada em um servidor seguro, tornando  imposs&iacute;vel algu&eacute;m obter esta informa&ccedil;&atilde;o pela rede. Esta seguran&ccedil;a &eacute; garantida  devido ao nosso investimento em servidores e softwares de criptografia modernos  que garantem a seguran&ccedil;a de seus dados pessoais e informa&ccedil;&otilde;es financeiras. <br>
			  <br>
			  As informa&ccedil;&otilde;es gen&eacute;ricas e n&atilde;o identificadas podem ser  usadas para campanhas de marketing pela <?php echo $objConfiguracao->getEmpresaRazaoSocial();?>.<br>
  <strong><br>
  Como as informa&ccedil;&otilde;es  s&atilde;o divulgadas?</strong><br>
			  De modo algum a <?php echo $objConfiguracao->getEmpresaRazaoSocial();?> vender&aacute; ou negociar&aacute; suas  informa&ccedil;&otilde;es pessoais, ou seja, seus dados pessoais e informa&ccedil;&otilde;es financeiras  para terceiros. Esta informa&ccedil;&atilde;o ser&aacute; utilizada apenas internamente em regime de  confidencialidade a fim de melhorar nosso atendimento.<br>
			  <br>
			  Dependendo do conte&uacute;do das informa&ccedil;&otilde;es divulgadas, a <?php echo $objConfiguracao->getEmpresaRazaoSocial();?> poder&aacute; se resguardar nos rigores legais a fim de proteger os direitos  de propriedade da empresa, bem como os de seus usu&aacute;rios.<br>
  <strong><br>
  Links Externos </strong><br>
			  O site do ParkImovel poder&aacute; vir a conter links a outros sites, cujo  conte&uacute;do est&aacute; fora de nosso controle. A <?php echo $objConfiguracao->getEmpresaRazaoSocial();?> n&atilde;o se  responsabiliza pelo conte&uacute;do a qual voc&ecirc; divulga no portal contratado.<br>
  <strong><br>
  O que s&atilde;o Cookies? </strong><br>
			  Cookies s&atilde;o pequenos arquivos de texto enviados ao seu computador e nele  armazenados atrav&eacute;s do seu browser. Estes arquivos servem para tornar a  navega&ccedil;&atilde;o mais r&aacute;pida.<br>
			  <br>
			  O uso de cookies para acompanhar e armazenar informa&ccedil;&otilde;es  possibilitar&aacute; ao site ParkImovel oferecer um servi&ccedil;o mais personalizado,  proporcionar servi&ccedil;os diferenciados, acompanhar o andamento de promo&ccedil;&otilde;es, medir  padr&otilde;es de navega&ccedil;&atilde;o e facilitar e agilizar o preenchimento de formul&aacute;rios.<br>
			  <br>
			  Para desabilitar o uso de cookies, consulte as se&ccedil;&otilde;es  &quot;help&quot; ou &quot;ajuda&quot; de seu browser. <br>
  <strong><br>
  E-Mail</strong><br>
			  Periodicamente, a <?php echo $objConfiguracao->getEmpresaRazaoSocial();?>, atrav&eacute;s do site ParkImovel,  pode enviar e-mails comunicando atualiza&ccedil;&otilde;es, novidades ou ofertas promocionais  relativas ao seu site. Para deixar de receber esses e-mails entre em contato  com a <?php echo $objConfiguracao->getEmpresaRazaoSocial();?>. Voc&ecirc; pode cancelar o envio a qualquer  momento.<br>
			  <br>
			  Caso ainda tenha d&uacute;vidas, ou queira fazer uma sugest&atilde;o ou  reclama&ccedil;&atilde;o entre em contato pelo email <?php echo $objConfiguracao->getEmailParkimovel();?>.</p>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">&nbsp;</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">&nbsp;</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">&nbsp;</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">&nbsp;</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">&nbsp;</P>
			</td>
		<td valign="top"><img src="<?php echo $objConfiguracao->getDiretorioIcons()."/impressaoG.png";?>" width="32" height="32" style="cursor:pointer;" onClick="iprint(contratoImprimir); return false;" title="Clique aqui para imprimir."></td>
	  </tr>
	</table>
<!--
===============================================================================================================================
Final Contrato
===============================================================================================================================
-->
    </td>
  </tr>
</table>
</div>
</form>
</body>
</html>