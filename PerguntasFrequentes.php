<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");
	include("class/classFaleConosco.php");

?>
<html>
<head>
<!-- Google Webmaster Tools -->
<meta name="verify-v1" content="6OL5RHKN1AfUbB4+J1fj8h+wu/eoUmuTk/bSgWXwRtc=" >
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Perguntas Frequentes</title>
</head>

<body>
<table cellspacing="0" cellpadding="0">
  <tr>
    <td> </td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>"><div align="center"><strong>1</strong></div></td>
    <td></td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>" width="100%"><p><strong>O que &eacute; a ParkImovel?</strong></p></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td><div align="center"><strong></strong></div></td>
    <td> </td>
    <td width="100%">A Parkimovel a empresa que vem desenvolvendo o projeto do sistema web chamado  Metasoftware, um projeto criado para atender corretores e imobili&aacute;rias que trabalham anuciando seus im&oacute;veis e compartilhando   as suas carteiras, filosofias e   procedimentos na gest&atilde;o dos seus im&oacute;veis.<br />
    <br /></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>"><div align="center"><strong>2</strong></div></td>
    <td></td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>" width="100%"><p><strong>Como funciona a Parkimovel?</strong></p></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td><div align="center"><strong></strong></div></td>
    <td> </td>
    <td width="100%">A Parkimovel funciona na locomo um portal de imobili&aacute;rias   credenciadas que podem compartilhar ou n&atilde;o o mesmo banco de dados. Operando 100% via web, as   empresas credenciadas Parkimovel acessam em tempo real todos os im&oacute;veis que   entram para venda e loca&ccedil;&atilde;o. Essa estrutura permite potencializar os neg&oacute;cios para   as imobli&aacute;rias e proporciona um atendimento muito mais r&aacute;pido e eficaz para os   clientes.
      <!--             =&gt; Criar             e desenvolver neg&oacute;cios imobili&aacute;rios, somando compet&ecirc;ncias para compartilhar             benef&iacute;cios e aumentar resultados, objetivando o melhor atendimento             dos nossos clientes.-->
      <br />
    <br /></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>"><div align="center"><strong>3</strong></div></td>
    <td></td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>" width="100%"><p><strong>H&aacute; quanto tempo existe a Parkimovel?</strong></p></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td><div align="center"><strong></strong></div></td>
    <td> </td>
    <td width="100%">Resultado de um projeto criado em 2007, a Parkimovel nasceu em   Bras&iacute;lia. Hoje a   Parkimovel possui o mais r&aacute;pido e seguro sistema web que re&uacute;nindo importantes funcionalidades e procedimentos para operar varias carteiras   de im&oacute;veis com rapidez, qualidade e seguran&ccedil;a. <br />
    <br /></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>"><div align="center"><strong>4</strong></div></td>
    <td></td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>" width="100%"><p><strong>A Rede atua em todo o Brasil?</strong></p></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td><div align="center"><strong></strong></div></td>
    <td> </td>
    <td width="100%">A Parkimovel e capaz de atuar em todo o territ&oacute;rio nacional, oferecendo   an&uacute;ncios gratuitos para clientes de todo o Brasil.<br />      <br /></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>"><div align="center"><strong>5</strong></div></td>
    <td></td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>" width="100%"><p><strong>Qual a &aacute;rea de atua&ccedil;&atilde;o profissional da Parkimovel?</strong></p></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td><div align="center"><strong></strong></div></td>
    <td> </td>
    <td width="100%">A Parkimovel atua no desenvolvimento do Metasoftware e no seu suporte, treinamento e na  loca&ccedil;&atilde;o da ferramenta para as empresas e grandes corretores de imoveis.<br />
    <br /></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>"><div align="center"><strong>6</strong></div></td>
    <td></td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>" width="100%"><p><strong>Posso anunciar diretamente no site?</strong></p></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td><div align="center"><strong></strong></div></td>
    <td> </td>
    <td width="100%">Sim. Qualquer imobili&aacute;ria ou corretor de qualquer lugar do Brasil pode contratar os servi&ccedil;os da Parkimovel, para incluir, alugar, vender ou doar    an&uacute;ncios de im&oacute;veis no seu pr&oacute;pio portal.<br />
      <br />
      Com o sistema da Parkimovel. O an&uacute;ncio &eacute; cobrado de acordo com o que o contratante do portal determinar nas configura&ccedil;&otilde;es do sistema Metasoftware, basta informar os dados que o sistema solicitar.<br />
    <br /></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td></td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>"><div align="center"><strong>7</strong></div></td>
    <td></td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>" width="100%"><p><strong>Qual a vantagem de colocar a gest&atilde;o do seus im&oacute;veis para a venda ou loca&ccedil;&atilde;o na   Parkimovel?</strong></p></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td><div align="center"><strong></strong></div></td>
    <td> </td>
    <td width="100%">As vantagens s&atilde;o muitas. Al&eacute;m de contar com a seguran&ccedil;a e confiabilidade que s&oacute; o Metasoftware oferece a voc&ecirc;, tamb&eacute;m poder&aacute; configurar o sistema para que o portal fique customizado para a sua empresa, mantendo a qualidade da informa&ccedil;&atilde;o e design no padr&atilde;o  da Parkimovel. Gerencie seus imoveis, disponibilizando   as informa&ccedil;&otilde;es em tempo real para todos os seus corretores e clientes.<br />
      <br />
      Poder&aacute; tambem incluir o im&oacute;vel na sua melhor qualidade visual, pois s&oacute; os melhores profissionais em design e programa&ccedil;&atilde;o poderiam fazer manualmente, mas a Parkimovel automatizou tudo no Metasoftware, assim fica  simples e r&aacute;pido para publicar e gerir seus im&oacute;veis na internet.O nosso sistema oferece de forma dinamica e automatizada e com a mesma praticidade com que se opera a sua caixa de emails.<br />
      <br />
      Quando utilizar o Metasoftware, ele vai gerenciar os banners do portal, as noticias feeds pr&oacute;prios ou de terceiros automaticamente alem de disponibilizar a integra&ccedil;&atilde;o com o melhor sistema de F&oacute;rum de discuss&atilde;o da internet, produzido pelo PHPBB, seus clientes e corretores poder&atilde;o acessar os tópicos e acompanhar mais facilmente as discuss&otilde;es,  evitando redundâncias e tornando mais eficientes as retomadas aos temas, como se fossem ininterruptas.<br />
      <br />
      Com 
      o nosso newslletters voc&ecirc; poder&aacute; divulgar promo&ccedil;&otilde;es, eventos ou qualquer outro informativo a todos os visitantes cadastrados no seu portal,  at&eacute; o controle financeiro dos anunciantes  no seu portal ser&aacute; executado de forma automatizada.<br />
      <br />
      Voc&ecirc; ter&aacute; sem nenhum custo adicional toda e qualquer atualiza&ccedil;&atilde;o e upgrades do projeto Metasoftware automaticamente.<br><br>
    </td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td></td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>"><div align="center"><strong>8</strong></div></td>
    <td></td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>" width="100%"><p><strong>Posso incluir at&eacute; quantos an&uacute;ncios?</strong></p></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td><div align="center"><strong></strong></div></td>
    <td> </td>
    <td width="100%">A Parkimovel n&atilde;o limita o n&uacute;mero de publica&ccedil;&otilde;es dos seus im&oacute;veis para seus clientes.   As restri&ccedil;&otilde;es existem para os planos mais b&aacute;sicos a qual limita apenas a quantidade de an&uacute;ncios publicit&aacute;rios que sejam apresentados simultaneamente, nos planos mais completos o contratante poder&aacute; incluir anuncios publicit&aacute;rios fixos, aleat&oacute;rios ou aleatorios por per&iacute;odo pr&eacute; determinado para serem apresentados no portal.<br />
    <br /></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td></td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>"><div align="center"><strong>9</strong></div></td>
    <td></td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>" width="100%"><p><strong>Por quanto tempo os an&uacute;ncios dos assinantes do meu portal  ser&aacute; publicado?</strong></p></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td><div align="center"><strong></strong></div></td>
    <td> </td>
    <td width="100%">O an&uacute;ncio ser&aacute; publicado por at&eacute; 90 dias. Ap&oacute;s esse prazo, se   n&atilde;o for renovado, ser&aacute; automaticamente des&aacute;tivado do sistema, podendo ser reativado futuramente caso seja necess&aacute;rio.<br />
      <br /></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>"><div align="center"><strong>10</strong></div></td>
    <td></td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>" width="100%"><p><strong>Como os assinantes do meu portal faz para prorrogar um an&uacute;ncio?</strong></p></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td><div align="center"><strong></strong></div></td>
    <td> </td>
    <td width="100%">Quando o an&uacute;ncio expirar (em 90 dias), seu im&oacute;vel ser&aacute;   desativado e voc&ecirc; receber&aacute; um email com uma op&ccedil;&atilde;o para reativar o im&oacute;vel (por   mais 90 dias). Uma semana antes de seu an&uacute;ncio expirar voc&ecirc; receber&aacute; um email e   um aviso em seu celular(*), avisando que o prazo est&aacute; acabando. <strong><em>* &Eacute;   necess&aacute;rio que o celular esteja apto a receber emails.</em></strong> <br />
      <br /></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>"><div align="center"><strong>11</strong></div></td>
    <td></td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>" width="100%"><p><strong>A Parkimovel atua em qualquer regi&atilde;o?</strong></p></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td><div align="center"><strong></strong></div></td>
    <td> </td>
    <td width="100%">A Parkimovel pode atuar em todo territ&oacute;rio nacional.<br />      <br /></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>"><div align="center"><strong>12</strong></div></td>
    <td></td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>" width="100%"><p><strong>A Parkimovel fornece o endere&ccedil;o do im&oacute;vel anunciado no   portal?</strong></p></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td><div align="center"><strong></strong></div></td>
    <td> </td>
    <td width="100%">O pr&oacute;prio assinante ap&oacute;s devidamente cadastrado decide se coloca ou n&atilde;o os dados para contato ou o endere&ccedil;o do im&oacute;vel. <br />
      <br /></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>"><div align="center"><strong>13</strong></div></td>
    <td></td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>" width="100%"><p><strong>Qual o valor que &eacute; cobrado por este servi&ccedil;o?</strong></p></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td><div align="center"><strong></strong></div></td>
    <td> </td>
    <td width="100%">Varia de acordo com o plano montado, contate um de nossos vendedores e contrate o plano que melhor lhe atender.<br />
      <br /></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td> </td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>"><div align="center"><strong>14</strong></div></td>
    <td></td>
    <td bgcolor="<?php echo $objConfiguracao->getCorFundoGrupo();?>" width="100%"><p><strong>Como fa&ccedil;o para ter acesso aos im&oacute;veis da Parkimovel?</strong></p></td>
    <td valign="top"> </td>
  </tr>
  <tr>
    <td></td>
    <td><div align="center"><strong></strong></div></td>
    <td> </td>
    <td width="100%">O acesso poder&aacute; ser feito pelo site <a href="http://www.parkimovel.com.br/">www.parkimovel.com.br ou   www.parkimovel.com, parkimovel.com.br e parkimovel.com, </a>ou   ligando para qualquer uma das nossos contatos.<br />
      <br /></td>
    <td valign="top"> </td>
  </tr>
</table>
</body>
</html>
