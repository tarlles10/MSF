<?php 
	$pagina = "";
	$str_acessoMinimo = "";

	include("../config/config_Sistema.php");
	include("../class/classContratos.php");
	$objContratos 	= new contratos($objConexao);

	function mostraDataString($str_data, $str_mes = false)
	{
		//01/04/2008
		if ($str_mes)
		{
			$mes_num = date('m');
			$data = '';
		}else
		{
			$mes_num = substr($str_data, 4, 2);
			$data = substr($str_data, 0, 2).' de ';
		}
		
		if($mes_num == 01)
		{
			$data .= "Janeiro";
		}else if($mes_num == 02)
		{
			$data .= "Fevereiro";
		}else if($mes_num == 03)
		{
			$data .= "Março";
		}else if($mes_num == 04)
		{
			$data .= "Abril";
		}else if($mes_num == 05)
		{
			$data .= "Maio";
		}else if($mes_num == 06)
		{
			$data .= "Junho";
		}else if($mes_num == 07)
		{
			$data .= "Julho";
		}else if($mes_num == 08)
		{
			$data .= "Agosto";
		}else if($mes_num == 09)
		{
			$data .= "Setembro";
		}else if($mes_num == 10)
		{
			$data .= "Outubro";
		}else if($mes_num == 11)
		{
			$data .= "Novembro";
		}else
		{
			$data .= "Dezembro";
		}
		if ($str_mes)
		{
			return $data;
		}else
		{
			return $data.' de '.substr($str_data, 6, 4);
		}
	}


	if (isset($_GET["id_contrato"]) || !empty($_GET["id_contrato"]))
	{
		if ($_GET["id_contrato"] != "")
		{
			$objContratos->atribuirQuery($objConexao, $objConfiguracao->anti_injection($_GET["id_contrato"]));

			if ($objContratos->str_cpf != '')
			{
				$str_valor01 = 'CPF ';
				$str_valor02 = $objContratos->str_cpf;
				$str_valor03 = ', residente e domiciliado na ';
			}else
			{
				$str_valor01 = 'CNPJ ';
				$str_valor02 = $objContratos->str_cnpj;
				$str_valor03 = ', com sede na';
			}
			
			$objContratos->str_nomeResponsavelContrato 	= strtoupper($objContratos->str_nomeResponsavelContrato);
			$objContratos->str_endereco					= strtoupper($objContratos->codifiStringBancoInterface($objConexao, $objContratos->str_descricaoLogradouro.' '.$objContratos->str_descricaoTipo.' '.$objContratos->str_complemento.' '.$objContratos->str_bairro.' '.$objContratos->str_municipios.'-'.$objContratos->str_uf));
		}else
		{
			$objContratos->str_cnpj 				= '00.000.000/0000-00';
			$objContratos->str_cpf					= '000.000.000-00';
			$objContratos->str_numeroContrato		= 'xxxxxxxxxx';
			
			$objContratos->str_nomeVendedorSistema	= 'NOME DO CONTRATANTE';

			$objContratos->str_endereco				= '[LOGRADOURO] [TIPO DE LOGRADOURO] [COMPLEMENTO DO ENDEREÇO DO CONTRATANTE] [MUNICIPIO] [BAIRRO - UF]';
			$objContratos->id_numeroCep				= '00000-000';
			$objContratos->str_telefone				= '00 0000-0000';
			$objContratos->dt_inicioVigencia		= '01/01/0001';
			$objContratos->dt_finalVigencia			= '01/01/0001';
			$objContratos->str_diaVencimento		= '00';
		}
	}	
	
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
		<td align="center" background="template1/margemContrato.png" width="766" height="96" style="text-align:right;">Contrato N.º <?php echo $objContratos->str_numeroContrato;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td></td>
	  </tr>
	  <tr>
		<td>
		<div align="center">
			<P>
				<B style="mso-bidi-font-weight: normal">CONTRATO DE PRESTA&Ccedil;&Atilde;O DE SERVI&Ccedil;O</B>
			</P>
		</div>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				Obrigam-se ao cumprimento integral deste contrato de presta&ccedil;&atilde;o de servi&ccedil;o de um lado 
				<B style="mso-bidi-font-weight: normal">RESPONSAVÉL PELO PORTAL</B>
				, nacionalidade, estado civil, profissão, RG orgao emissor, CPF , residente e domiciliado na endereço CEP., Bairro - UF, telefone número, doravante denominado 
				<B style="mso-bidi-font-weight: normal">CONTRATADO</B>
				, e de outro lado, 
				<B style="mso-bidi-font-weight: normal"><?php echo $objContratos->str_nomeResponsavelContrato;?></B> 
				<?php echo $str_valor01;?> 
				<B style="mso-bidi-font-weight: normal"><?php echo $str_valor02;?></B>
				<?php echo $str_valor03;?> 
				<B style="mso-bidi-font-weight: normal"><?php echo $objContratos->str_endereco;?></B>
                &nbsp;,CEP.
                <B style="mso-bidi-font-weight: normal"><?php echo $objContratos->id_numeroCep;?></B>
				, telefones: 
				<B style="mso-bidi-font-weight: normal"><?php echo $objContratos->str_telefone;?></B>
				, doravante denominado 
				<B style="mso-bidi-font-weight: normal">CONTRATANTE</B>
				, se sujeitam, pelo presente contrato de presta&ccedil;&atilde;o de servi&ccedil;os, devidamente aceito pelas partes contratantes, &eacute; v&aacute;lido de pleno direito e se reger&aacute; pelas cl&aacute;usulas abaixo transcritas:
			</P>
			<p align="center">
				<strong>DO OBJETO DO CONTRATO</strong>
			</p>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 1&ordf;</B> 
				- &Eacute; objeto deste contrato a presta&ccedil;&atilde;o do servi&ccedil;o (METASOFTWARE) ora disponibilizado ao CONTRATANTE sob forma de licenciamento pelo CONTRATADO respons&aacute;vel pelo desenvolvimento e propriedade intelectual do software. Entende-se pelo denominado &quot;software&quot; as ferramentas contidas na &aacute;rea Administrativa do Metasoftware e os modelos de sites.
			</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify"></P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 2&ordf;</B>- 
				</span>
				A licen&ccedil;a de uso do servi&ccedil;o (METAFOFTWARE) ser&aacute; efetivada na forma de softwares instalados em servidores de terceiros contratados pelo CONTRATADO com a &Uacute;nica finalidade do CONTRATANTE montar e administrar seu site para que possa incluir e divulgar im&oacute;veis.
			</P>
			<p align="center">
				<strong>OBRIGA&Ccedil;&Otilde;ES DO CONTRATANTE</strong>
			</p>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 3&ordf;</B> - 
				</span>
				N&atilde;o publicar qualquer informa&ccedil;&atilde;o, dado ou material que viole lei federal, estadual ou municipal, bem como propagandas enganosas, fotos ou informa&ccedil;&otilde;es com direitos reservados, de propriedade intelectual ou com copyright, difama&ccedil;&atilde;o de pessoas ou neg&oacute;cios, alega&ccedil;&otilde;es consideradas perigosas ou obscenas, protegido por segredo de Estado ou outro estatuto legal.
			</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify"></P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 4&ordf;</B> - 
				</span>
				N&atilde;o transferir a terceiros ou permitir que se utilizem da conta, que &eacute; de uso exclusivo do CONTRATANTE.
			</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify"></P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 5&ordf;</B> -				</span>
				N&atilde;o tentar, ou efetivamente quebrar as senhas, invadir os sites alheios ou burlar a seguran&ccedil;a do sistema <span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">(METAFOFTWARE)</span> para obter privil&eacute;gios. Neste caso, ocorrer&aacute; o imediato cancelamento da conta, sem preju&iacute;zo das medidas judiciais cab&iacute;veis.			</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify"></P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 6&ordf;</B> - 
				</span>
				Fornecer ao CONTRATADO todas as informa&ccedil;&otilde;es necess&aacute;rias &agrave; realiza&ccedil;&atilde;o do servi&ccedil;o. O fornecimento de dados inver&iacute;dicos, acarretar&aacute; no cancelamento deste contrato, sem preju&iacute;zo das medidas judiciais cab&iacute;veis.
			</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify"></P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 7&ordf;</B> - 
				</span>
				Efetuar o pagamento nas formas e condi&ccedil;&otilde;es estabelecidas nas cl&aacute;usulas 12&ordf;, 13&ordf;, 14&ordf;, 15&ordf;, 16&ordf; , 17&ordf;, 18&ordf; e 19&ordf;.
			</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify"></P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 8&ordf;</B> - 
				</span>
				Zelar para que suas informa&ccedil;&otilde;es de acesso (nome de usu&aacute;rio e senha) n&atilde;o sejam &quot;hackeadas&quot;, quando utilizar locais p&uacute;blicos ou particulares para cessar &agrave; Internet.
			</P>
			<p align="center">
				<strong>OBRIGA&Ccedil;&Otilde;ES DO CONTRATADO</strong>
			</p>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 9&ordf;</B> -
				</span>
				Zelar pela efetividade do site do CONTRATANTE, adotando junto a todos os usu&aacute;rios as medidas necess&aacute;rias para evitar preju&iacute;zos ao funcionamento do sistema (METASOFTWARE), bem como fornecer suporte t&eacute;cnico ao CONTRATANTE, consistente de informa&ccedil;&otilde;es de configura&ccedil;&atilde;o para publica&ccedil;&atilde;o das p&aacute;ginas. O suporte t&eacute;cnico ser&aacute; prestado via e-mail (<?php echo $objConfiguracao->getEmailParkimovel();?>) e por telefone.
			</P>
		    <P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify"></P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 10&ordf;</B> - 
				</span>
				Manter o site no ar durante  99.5% do tempo (janela de tempo considerada: 365 dias x 24 horas). Excluem-se  da garantia as interrup&ccedil;&otilde;es necess&aacute;rias para ajustes t&eacute;cnicos ou manuten&ccedil;&atilde;o,  falha de linha de comunica&ccedil;&atilde;o de acesso, falha na presta&ccedil;&atilde;o de servi&ccedil;os de  terceiros, erros do CONTRATANTE, furto ou destrui&ccedil;&atilde;o por algum acesso n&atilde;o  autorizado, fracasso de disco r&iacute;gido, suspens&atilde;o por falta de pagamento ou  viola&ccedil;&atilde;o dessas pol&iacute;ticas de uso, e situa&ccedil;&otilde;es imprevistas como guerras,  terremotos, tuf&otilde;es e outros casos fortuitos.
			</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify"></P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 11&ordf;</B> - 
				</span>
				O CONTRATADO n&atilde;o &eacute; respons&aacute;vel por publica&ccedil;&atilde;o de im&oacute;veis, imagens e textos no site do CONTRATANTE.
			</P>
			<p align="center">
				<strong>DO SIGILO DAS INFORMA&Ccedil;&Otilde;ES</strong>
			</p>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 12&ordf;</B> - 
				</span>
				O CONTRATADO compromete-se a n&atilde;o ceder a outras empresas as informa&ccedil;&otilde;es referentes ao cadastro de im&oacute;veis efetuados pela CONTRATANTE , bem como seus respectivos propriet&aacute;rios.
			</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify"></P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 13&ordf;</B> -
				</span>
				CONTRATADO poder&aacute; utilizar o cadastro de im&oacute;veis da CONTRATANTE, no seu ve&iacute;culo de divulga&ccedil;&atilde;o como internet e/ou em outros meios de divulga&ccedil;&atilde;o, mencionando o nome da CONTRATANTE e/ou endere&ccedil;o do site da CONTRATANTE. Caso a CONTRATANTE n&atilde;o esteja de acordo e desautorize a referida divulga&ccedil;&atilde;o, dever&aacute; manifestar-se por escrito.
			</P>
			<p align="center">
				<strong>DO PRE&Ccedil;O E DAS CONDI&Ccedil;&Otilde;ES DE PAGAMENTO</strong>
			</p>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 14&ordf;</B> - 
				</span>
				A remunera&ccedil;&atilde;o pela licen&ccedil;a de uso do servi&ccedil;o (METASOFTWARE) &eacute; aquela estabelecida na Tabela de Pre&ccedil;os contida no sistema administrativo  plano de contrato no sistema (
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">METASOFTWARE</span>
				)  e ser&aacute; efetivada pela CONTRATANTE &agrave; CONTRATADA observando as condi&ccedil;&otilde;es estabelecidas nas cl&aacute;usulas 15&ordf;, 16&ordf;, 17&ordf; e 18&ordf;.
			</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify"></P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 15&ordf;</B> -				</span>
				O pagamento das mensalidades, referente ao Plano de Contrato utilizado, dever&aacute; ser efetuado pelo CONTRATANTE rigorosamente nas datas de vencimento, tendo como base a data de assinatura.
				<br>
				O boleto ser&aacute; gerado na area administrativa do portal ou <span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">ser&aacute; enviada para o e-mail dos usu&aacute;rios do CONTRATANTE 5 (cinco) dias antes da data do vencimento, com instru&ccedil;&otilde;es de pagamento</span>.			</P>
			<p>
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 16&ordf;</B> - 
				</span>
				O n&atilde;o cumprimento do disposto na cl&aacute;usula 12&ordf;, ser&aacute; considerado como infra&ccedil;&atilde;o contratual, acarretando na desativa&ccedil;&atilde;o dos servi&ccedil;os. Ap&oacute;s 7 (sete) dias da data de vencimento, permanecendo a inadimpl&ecirc;ncia por parte do CONTRATANTE, a presta&ccedil;&atilde;o dos servi&ccedil;os ser&aacute; interrompida, sendo o acesso ao site do cliente, substitu&iacute;do por uma p&aacute;gina tempor&aacute;ria, com a logomarca do Metasoftware. Para a reabilita&ccedil;&atilde;o do servi&ccedil;o, dever&aacute; o CONTRATANTE entrar em contato com o CONTRATADO, atrav&eacute;s do email (<?php echo $objConfiguracao->getEmailParkimovel();?>) ou pelo telefone (61-8165-2522). O servi&ccedil;o ser&aacute; reativado ap&oacute;s a CONTRATADA receber a compensa&ccedil;&atilde;o banc&aacute;ria do pagamento.
			</p>
			<p>
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 17&ordf;</B> -
				</span>
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					A falta de pagamento por parte do CONTRATANTE acarretar&aacute; a suspens&atilde;o IMEDIATA do servi&ccedil;o e conseq&uuml;ente multa no valor de 13% (treze por cento) do valor da mensalidade.
				</span>
				Ap&oacute;s 180 (cento e oitenta) dias da data do vencimento da pend&ecirc;ncia de pagamento, a CONTRATADA ir&aacute; deletar todos os dados, arquivos ou outras informa&ccedil;&otilde;es que estiverem armazenadas na conta do CONTRATANTE, cancelando definitivamente a presta&ccedil;&atilde;o dos servi&ccedil;os, com o cancelamento autom&aacute;tico do contrato firmado entre as partes.
			</p>
			<p>
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 18&ordf;</B> -
				</span>
				A mensalidade ser&aacute; cobrada  sempre 
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					no dia
					<B style="mso-bidi-font-weight: normal"><?php echo $objContratos->str_diaVencimento;?></B>
				</span> 
				de cada m&ecirc;s.
			</p>
			<p>
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 19&ordf;</B> - 
				</span>
				Como forma de ativa&ccedil;&atilde;o e configura&ccedil;&atilde;o da presta&ccedil;&atilde;o do servi&ccedil;o (METASOFTWARE), a CONTRATANTE pagar&aacute; uma taxa de inscri&ccedil;&atilde;o (valor &Uacute;nico) &agrave; CONTRATADA, cujo valor est&aacute; contido no sistema administrativo, este valor poder&aacute; ser dividido entre as mensalidades do primeiro ano ou pago integralmente na primeira mensalidade. O valor da taxa de inscri&ccedil;&atilde;o n&atilde;o poder&aacute; ser reembolsado, tendo em vista o o CONTRATANTE tem a possibilidade de testar o servi&ccedil;o por 7 dias antes de pagar.
			</p>
			<p align="center">
				<strong>DO CANCELAMENTO DO CONTRATO</strong>
			</p>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 20&ordf;</B> - 
					<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
						O prazo do presente contrato se inicia <?php echo mostraDataString($objContratos->dt_inicioVigencia);?> e terminar&aacute; <?php echo mostraDataString($objContratos->dt_finalVigencia);?>, sendo que este se prorrogar&aacute; caso as partes concordem, caso contrario poder&aacute; o presente instrumento ser cancelado por qualquer uma das partes, sem que haja qualquer tipo de motivo relevante, n&atilde;o obstante a outra parte dever&aacute; ser avisada previamente, no prazo de 15 (quinze) dias da data de termino.
					</span>
				</span>
			</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify"></P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 21&ordf;</B> 
					- No caso de cancelamento de  servi&ccedil;o, as informa&ccedil;&otilde;es ficar&atilde;o no banco de dados da empresa CONTRATADA por um  per&iacute;odo de 3 (tr&ecirc;s) meses. Caso o cliente queira voltar a utilizar o servi&ccedil;o &eacute;  s&oacute; come&ccedil;ar a pagar a mensalidade novamente entranto em contato com o CONTRATADO pelo email (<?php echo $objConfiguracao->getEmailParkimovel();?>). Ap&oacute;s o per&iacute;odo de 6 meses para  voltar a utilizar o servi&ccedil;o ser&aacute; cobrada taxa de inscri&ccedil;&atilde;o novamente.
				</span>
			</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify"></P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 22&ordf;</B> 
					- Os softwares, conforme condi&ccedil;&otilde;es estabelecidas nas cl&aacute;usulas 1&ordf; e 2&ordf;, n&atilde;o poder&atilde;o ser requeridos pelo CONTRATANTE.
				</span>
			</P>
			<p align="center"><strong>DO DOM&Iacute;NIO</strong></p>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 23&ordf;</B> - 
				</span>
				O registro do dominio ser&aacute; realizado pela CONTRATADA, em nome da CONTRATADA ou seus representantes, ficando a CONTRATADA respons&aacute;vel pelo pagamento de taxas relacionadas ao dom&iacute;nio. Entende-se por dom&iacute;nio o nome do site na Internet.
			</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify"></P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 24&ordf;</B>
				</span>
				- No t&eacute;rmino do contrato o CONTRATANTE tem o direito de requerer a propriedade do dom&iacute;nio, requerendo a devida transfer&ecirc;ncia a CONTRATADA e arcando com os custos de transfer&ecirc;ncia.
			</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify"></P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 25&ordf; - </B>
				</span>
				Caso a CONTRATANTE j&aacute;  possua dominio registrado ou deseje registrar o dominio por conta pr&oacute;pria, n&atilde;o  se aplicam as cl&aacute;usulas 23 &ordf; e 24&ordf;.
			</P>
			<p align="center">
				<strong>DO PRAZO</strong>
			</p>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 26&ordf; - </B>
				</span>
				O prazo de dura&ccedil;&atilde;o deste contrato &eacute; de um ano, devendo as partes informar por escrito, fax, ou e-mail, o cancelamento com 15 (quize) dias de anteced&ecirc;ncia 
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">da data do t&eacute;rmino do contrato.</span>
			</P>
			<p align="center">
				<strong>DAS CONDI&Ccedil;&Otilde;ES GERAIS</strong>
			</p>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 27&ordf; - </B>
				</span>
				Fica compactuado entre as partes a total inexist&ecirc;ncia de v&iacute;nculo trabalhista entre as partes contratantes, excluindo as obriga&ccedil;&otilde;es previdenci&aacute;rias e os encargos sociais, n&atilde;o havendo entre CONTRATADO e CONTRATANTE qualquer tipo de rela&ccedil;&atilde;o de subordina&ccedil;&atilde;o.
			</P>
			<p align="center">
				<strong>DO FORO</strong>
			</p>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">
					<B style="mso-bidi-font-weight: normal">Cl&aacute;usula 28&ordf;</B> - 
				</span>
				Para dirimir quaisquer  controv&eacute;rsias oriundas do presente contrato, as partes elegem o foro da 
				<span class="MsoNormal" style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify"> Justi&ccedil;a de Bras&iacute;lia &ndash; DF, para serem demandados ou demandarem relativamente a qualquer cl&aacute;usula deste contrato, com ren&uacute;ncia expressa de qualquer outro.</span>
			</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">&nbsp;</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">Bras&iacute;lia,&nbsp;<?php echo date("d");?>&nbsp;de 
				<SPAN style="mso-spacerun: yes">
					&nbsp;<?php echo mostraDataString('', true);?>&nbsp;de 
				</SPAN>
				<?php echo date("Y");?>.
			</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">&nbsp;</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">&nbsp;</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">&nbsp;</P>
			<BR style="mso-ignore: vglayout" clear=all>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">RESPONSAVÉL PELO PORTAL (CONTRATADO)</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">&nbsp;</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">&nbsp;</P>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify">&nbsp;</P>
			<BR style="mso-ignore: vglayout" clear=all>
			<P class=MsoNormal style="MARGIN: 0cm 0cm 0pt; TEXT-ALIGN: justify"><?php echo $objContratos->str_nomeResponsavelContrato;?> (CONTRATANTE)</P>
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