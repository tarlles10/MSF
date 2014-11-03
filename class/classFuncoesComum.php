<?php class FuncoesComum
	{

		public function ocupacaoString($string, $tamanhoMax, $numerico = FALSE)
		{
			//garante que se a string for do tipo númerica o retorno de concatenação será diferente.
			if ($numerico)
			{
				$concatenaFinal = "...";
				$diminuidorString = 3;
				
			}else
			{
				$concatenaFinal = ".";
				$diminuidorString = 1;
			}
			//Busca a posição da primeira ocorrencia que o caracter " "(espaço) existe na variavel $string.
			$ocorrencia = $this->buscaPosicaoOcorrenciaCaracter($string, " ", FALSE);
			if (strlen($string) > $tamanhoMax)
			{
				//Garante que a ocorrencia do caracter " "(espaço) esteja dentro do tamanho maximo permitido.
				if ($ocorrencia < $tamanhoMax && $ocorrencia != 0)
				{
					//Busca a quantidade de ocorrencias que o caracter " "(espaço) existe na variavel $string.
					//Garante que uma quantidade igual ou superior a 4 de caracteres apos o espaço esteja dentro do tamanho máximo permitido.
					if ((($tamanhoMax - ($ocorrencia + 2)) >= 4) && ($this->buscaQuantidadeOcorrenciaCaracter($string, " ") < 2))
					{
						return ucfirst(strtolower(substr($string, 0, $ocorrencia + (($tamanhoMax - ($ocorrencia + 1))-$diminuidorString)).$concatenaFinal));
					}else
					{
						return ucfirst(strtolower(substr($string, 0, $ocorrencia)));
					}
				}else
				{
					//Não existindo possibilidade de se trabalhar um corte na string pelo primeiro caracter " "(espaço) e so pontuar e apresentar o dado.
					return ucfirst(strtolower(substr($string, 0, $tamanhoMax - $diminuidorString).$concatenaFinal));
				}
			} else
			{
				//Garante que a string estará toda em caracteres minusculos e só as primeiras letras de cada palavra esteja em maiusculo.
				return ucfirst(strtolower($string));
			}
		}

		public function quebraTexto($string, $tamanhoLinha, $quantidadeLinha)
		{
			$tamanho = strlen($string);
			$tamanhoGeral = $tamanhoLinha * $quantidadeLinha;
			$contadorGeral = 0;
			$novaString = '';
			for ($cont = 0; $cont < $tamanhoGeral; $cont++) 
			{
				$contadorGeral++;
				if ($cont == 0 || substr($string, $cont - 2, 2) == ". " || substr($string, $cont - 1, 1) == ".")
				{
					$novaString .= strtoupper(substr($string, $cont, 1));
				}else
				{
					$novaString .= strtolower(substr($string, $cont, 1));
				}
			}
			if ($tamanhoGeral < $tamanho)
			{
				return substr($novaString, 0, $tamanhoGeral - 3)."...";
			}else
			{
				return substr($novaString, 0, $tamanhoGeral);
			}
		}

		function atribuirCorRGBThema($objConexao, $imagem)
		{
			$sql	= "SELECT id_theme from msf.configuracao order by id_configuracao desc limit 1";
			$array 	= $objConexao->retornaArray($objConexao->executaSQL($sql));
			switch ($array["id_theme"])
			{
				case 1:
					return imagecolorallocate($imagem, 49,150,218);
					break;
				case 2:
					return imagecolorallocate($imagem, 193,85,12);
					break;
				case 3:
					return imagecolorallocate($imagem, 108,132,156);
					break;
				case 4:
					return imagecolorallocate($imagem, 117,108,109);
					break;
				case 5:
					return imagecolorallocate($imagem, 129,146,22);
					break;
				case 6:
					return imagecolorallocate($imagem, 2,156,154);
					break;
				default:
					return imagecolorallocate($imagem, 49,150,218);
			}
		}

		function escreverTextoGrandeImagem($imagem, $int_fonte, $posLargura, $posAltura, $cor, $string, $fonte)
		{
			for ($controleCores = 3; $controleCores >= 1; $controleCores--) 
			{
				//controle para desenhar a borda da string
				for ($controleBordas = 1; $controleBordas <= 4; $controleBordas++) 
				{
					//define a cor a ser escrita
					switch ($controleCores) 
					{
						case 1:
							$corTexto	= imagecolorallocate($imagem, 255, 255, 255);
							break;
						case 2:
							$corTexto	= imagecolorallocate($imagem, 255, 255, 255);
							break;
						case 3 :
							$corTexto	= imagecolorallocate($imagem, 150, 150, 150);
							break;
					}
					//define a posição da cor a ser escrita para fazer o efeito de borda
					switch ($controleBordas) 
					{
						case 1:
							$largura 	= $posLargura + $controleCores;
							$altura 	= $posAltura + $controleCores;
							break;
						case 2:
							$largura 	= $posLargura + $controleCores;
							$altura 	= $posAltura - $controleCores;							
							break;
						case 3:
							$largura 	= $posLargura - $controleCores;
							$altura 	= $posAltura + $controleCores;							
							break;
						case 4:
							$largura 	= $posLargura - $controleCores;
							$altura 	= $posAltura - $controleCores;
							break;
					}					
					imagettftext($imagem, $int_fonte, 0, $largura, $altura, -$corTexto, $fonte, $string);
				}
			}
			imagettftext($imagem, $int_fonte, 0, $posLargura, $posAltura, -$cor, $fonte, $string);
			imageantialias($imagem, true);
		}
		
		function escreverTextoPequenoImagem($imagem, $int_fonte, $posLargura, $posAltura, $cor, $string, $tamanhoLinha, $quantidadeLinha)
		{
			$tamanho = strlen($string);
			$tamanhoGeral = $tamanhoLinha * $quantidadeLinha;
			$contadorGeral = 0;
			$contadorGeralImagem = 0;
			$contLinhasImagem = 0;
			$novaString = '';
			for ($cont = 0; $cont < $tamanhoGeral; $cont++) 
			{
				$contadorGeral++;
				$contadorGeralImagem++;
				
				if ($cont == 0 || substr($string, $cont - 2, 2) == ". " || substr($string, $cont - 1, 1) == ".")
				{
					$novaString .= strtoupper(substr($string, $cont, 1));
				}else
				{
					$novaString .= strtolower(substr($string, $cont, 1));
				}
				
				if($contadorGeralImagem == $tamanhoLinha)
				{
					$contLinhasImagem++;
					switch ($contLinhasImagem) 
					{
						case 1:
							$espacadorEscritaLinhas = 0;
							break;
						case 2:
							$espacadorEscritaLinhas = 13;
							break;
						case 3:
							$espacadorEscritaLinhas = 26;
							$contLinhasImagem = 0;
							break;
					}
					
					imagestring($imagem, $int_fonte, $posLargura, $posAltura+$espacadorEscritaLinhas, $novaString, $cor);
					$novaString = "";
					$contadorGeralImagem = 0;
				}
			}
			
			return $imagem;
		}
		
		public function buscaPosicaoOcorrenciaCaracter($string, $caracter, $primeiraOcorrencia = TRUE)
		{
			$tamanho = strlen($string);

			$posicao = 0;
			for ($cont = 1; $cont < $tamanho; $cont++) 
			{ 
				if (substr($string, $cont, 1) == $caracter)
				{
					$posicao = $cont;
					if ($primeiraOcorrencia)
					{
						break;
					}
				}
			}
			
			if ($posicao == $tamanho)
			{
				return 0;
			} else
			{
				return $posicao;
			}
		}
		
		public function buscaQuantidadeOcorrenciaCaracter($string, $caracter)
		{
			$tamanho = strlen($string);
			$contadorOcorrencia = 0;
			for ($cont = 1; $cont < $tamanho; $cont++) 
			{ 
				if (substr($string, $cont, 1) == $caracter)
				{
					$contadorOcorrencia ++;
				}
			}
			return $contadorOcorrencia;
		}		

		protected function MascaraValor($num)
		{
			 //Procura por virgulas na string.
			 $ver_virgula = strpos($num,",");

			 //Formata o valor.
			 if ($ver_virgula === false)
			 {
				$num_formatado = number_format($num,2,'.','');
			 } else
			 {
				$num = "$num";
				$num = str_replace(".","",$num);
				$num = str_replace(",",".",$num);
				$num_formatado = number_format($num,2,'.','');
			 }
	
			 //retorna o valor formatado.
			 return $num_formatado;
		}

		function MascaraValorTela($num)
		{
			 //Procura por virgulas na string.
			$ver_virgula = strpos($num,",");
			
			//Formata o valor.
			if ($ver_virgula === false)
			{
				$num_formatado = number_format(floatval($num),2,',','.');
			} else
			{
				$num_formatado = number_format(floatval($num),2,',','.');
			}
	
			//retorna o valor formatado.
			return $num_formatado;
		}

		//============================================================================//
		//                Função que retorna nome da pagina atual                     //
		//============================================================================//
		public function retornaNomePaginaAtual()
		{
			return basename($_SERVER['SCRIPT_NAME']);
		}
		
		public function retornaNomeDominioSSL8($objConfiguracao, $retorno = FALSE)
		{
			//https://ssl8.porta80.com.br/
			$linkCertificadoSeguranca = $objConfiguracao->getLinkCertificadoSeguranca();

			$nomeDominio = $_SERVER["SERVER_NAME"]; 

   			if (strpos($linkCertificadoSeguranca, $nomeDominio) === false && $retorno == FALSE)
			{
				$arrayStringsRemover = array('http://', 'https://');
				
				for ($cont = 0; $cont < count($arrayStringsRemover); $cont++) 
				{
					$nomeDominio = str_replace($arrayStringsRemover[$cont], '', $nomeDominio);
				}
	
				$arrayDominio = explode(".", $nomeDominio);
	
				if ($arrayDominio[0] == 'www')
				{
					$nomeDominio = $arrayDominio[1];
				}else
				{
					$nomeDominio = $arrayDominio[0];
				}

				if (strpos('localhost', $nomeDominio) === false) // caso esteja trabalhando na maquina local
				{
					//return $linkCertificadoSeguranca.$nomeDominio.'/adm/adm_principal.php';
					header('Location: '.$linkCertificadoSeguranca.$nomeDominio.'/');
				}
			} else if ($retorno)
			{
				if (strpos('localhost', $nomeDominio) === false) // caso esteja trabalhando na produção ou maquina local
				{
					$nomeDominio = str_replace($this->retornaNomePaginaAtual(), "", $_SERVER['SCRIPT_NAME']);
					return $linkCertificadoSeguranca.$nomeDominio; 
				} else
				{
					return 'http://'.$nomeDominio.'/IMOBILIARIA/MSF/';
				}
			}
		}
/*
<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com.br/?ie=UTF8&amp;ll=-12.46876,-53.085937&amp;spn=0.003675,0.004989&amp;t=h&amp;z=4&amp;output=embed&amp;s=AARTsJqzARj-Z8VnW5pkPMLMmZbqrJcYpw"></iframe>
*/
		public function retornaLarguraAlturaSatelite($str_posicaoSatelite, $stringLarguraAltura)
		{
			$quantidade = strlen($str_posicaoSatelite);
			$str_posicaoSateliteLimpo = '';
			$bln_entrou	= false;
			for ($cont = 0; $cont <= $quantidade; $cont++) 
			{
				if (substr($str_posicaoSatelite, $cont, 7) == $stringLarguraAltura)//comparando ( width=" ou eight=" )
				{
					$contWhile = $cont+7;
					while (substr($str_posicaoSatelite, $contWhile, 1) != '"')
					{
						$str_posicaoSateliteLimpo.= substr($str_posicaoSatelite, $contWhile, 1);
						$contWhile++;
						$bln_entrou = true;
					}
					if ($bln_entrou)
					{
						break;
					}
				}
			}
			return $str_posicaoSateliteLimpo;
		}


		public function retornaPosicaoSatelite($str_posicaoSatelite)
		{
			if (strpos($str_posicaoSatelite, 'http://maps.google.com.br/?ie=UTF8') === false)
			{
?>
				<script>
					alertMenssage ('Atenção:','O código informado não confere. <br>Siga os passos do tutorial no botão de ajuda para obter o código correto.');
				</script>
<?php return false;					
			}else
			{
/*
				REMOVE O LINK DO CÓDIGO GERADOR DO GOOGLEMAP
				=================================================================================
<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com.br/?ie=UTF8&ll=-12.46876,-53.085937&spn=0.003675,0.004989&t=h&z=4&output=embed&s=AARTsJqzARj-Z8VnW5pkPMLMmZbqrJcYpw"></iframe><br /><small><a href="http://maps.google.com.br/?ie=UTF8&ll=-12.46876,-53.085937&spn=0.003675,0.004989&t=h&z=4&source=embed" style="color:#0000FF;text-align:left">Exibir mapa ampliado</a></small>
				=================================================================================
*/
				$quantidade = strlen($str_posicaoSatelite);
				$str_posicaoSateliteLimpo = '';
				for ($cont = 0; $cont <= $quantidade; $cont++) 
				{
					if (substr($str_posicaoSatelite, $cont, 13) == "<br /><small>" || $quantidade == $cont)
					{
						break;
					}
					$str_posicaoSateliteLimpo .= substr($str_posicaoSatelite, $cont, 1);
				}
				return $str_posicaoSateliteLimpo;
			}
		}
		
		public function retornaEmailChatInterno($str_emailChatInterno)
		{
			if (strpos($str_emailChatInterno, 'chat with') === false)
			{
				//Chat with Italo Pablo Imoveis: http://www.google.com/talk/service/badge/Start?tk=z01q6amlq31da77voa9h99p6j90ephidqf7ne5427epen8cjs26uhohcs95j899416kgajur8kobpi2du906lq0gd1vdn2t6j4scbjgi3hoq17mnnabvnfm0d956kjngqhv0g2gefrirm0c37e9ktbhvnvbbmh7i2rn4pjmt3
				if (strpos($str_emailChatInterno, 'http://www.google.com/talk/service/badge/start?tk=') === false)
				{
?>
					<script>
						alertMenssage ('Atenção:','O código informado não confere. <br>Siga os passos do tutorial no botão de ajuda para obter o código correto.');
					</script>
<?php return false;					
				}else
				{
					
					$quantidade = strlen($str_emailChatInterno);
					for ($cont = 0; $cont <= $quantidade; $cont++) 
					{ 
						if (substr($str_emailChatInterno, $cont, 1) == "=")
						{
							$str_emailChatInterno = substr($str_emailChatInterno, $cont+1);
							break;
						}
					}
					return 'http://www.google.com/talk/service/badge/Start?tk='.$str_emailChatInterno;
				}
			}else
			{
				$quantidade = strlen($str_emailChatInterno);
				
				for ($cont = 0; $cont <= $quantidade; $cont++) 
				{ 
					if (substr($str_emailChatInterno, $cont, 1) == "=")
					{
						$str_emailChatInterno = substr($str_emailChatInterno, $cont+1);
						break;
					}
				}
				return 'http://www.google.com/talk/service/badge/Start?tk='.$str_emailChatInterno;
			}
		}

		//============================================================================//
		// Função que retorna dados de acordo com a codificação Correta das Strings   //
		//============================================================================//
		function codifiStringBancoInterface($objConexao, $str_string)
		{
			if ($objConexao->codificacaoBanco() == 'SQL_ASCII')
			{
				return utf8_decode($str_string);
			}
			else if ($objConexao->codificacaoBanco() == 'UTF8')
			{
				return utf8_encode ($str_string);
			}
			else
			{
				return utf8_decode($str_string);
			}
		}
		function codifiStringInterfaceBanco($objConexao, $str_string)
		{
			if ($objConexao->codificacaoBanco() == 'SQL_ASCII')
			{
				return utf8_encode($str_string);
			}
			else if ($objConexao->codificacaoBanco() == 'UTF8')
			{
				return utf8_decode ($str_string);
			}
			else
			{
				return utf8_encode($str_string);
			}
		}

		//============================================================================//
		//Função que envia o design do email										  //
		//============================================================================//		
		function corpoLayoutEmail($objConexao, $objConfiguracao, $arrayEmail, $localWeb='EmailAdministrativo')
		{
			$objConfiguracao->atribuirBanner($objConexao, 'Banner Topo');

		//============================================================================//
		//Paramentros do array para usar essa função 								  //
		//============================================================================//
		// $arrayEmail["email_resposta"]=>EMAIL PARA QUAL VAI SER ENVIADO A RESPOSTA  //
		// $arrayEmail["email_destino"] =>EMAIL PARA QUAL VAI A MENSSAGEM             //
		// $arrayEmail["assunto"]       =>ASSUNTO DO EMAIL                            //
		// $arrayEmail["nome_portal"]   =>TITULO DO BODY HTML QUE FORMA A MENSSAGEM   //
		// $arrayEmail["email_barra"]	=>TEXTO PARA PREENCHER A BARRA LAYOUT DO EMAIL// 
		// $arrayEmail["data_atual"]    =>A DATA ATUAL A QUAL O SERVIDOR ENVIA A MSG  //
		// $arrayEmail["email_titulo"]  =>PEQUENO TITULO PARA 1.BARRA DO LAYOUT DA MSG//
		// $arrayEmail["email_titulo_msg"]=>TITULO MAIOR PARA INICIO DA MSG           //
		// $arrayEmail["email_msg"]		=>A MENSSAGEM DO EMAIL PROPRIAMENTE DITO      //
		//============================================================================//		
			if ($localWeb == 'EmailExterno')
			{
				$localWeb 	= ' bgcolor="'.$objConfiguracao->getCorFundoGrupo().'" ';
				$bannerWeb 	= strpos('ssl8', $objConfiguracao->getDiretorioBanner(TRUE)) === false ? str_replace('https://','http://',$objConfiguracao->getDiretorioBanner(TRUE)) : str_replace('https://','http://',$objConfiguracao->getDiretorioBanner(TRUE));

				$objConfiguracao->getDiretorioBanner(TRUE); 
			}else if ($localWeb == 'EmailAdministrativo')
			{
				$localWeb 	= ' bgcolor="#cdcdcd" ';
				$bannerWeb 	= '<img src="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/administrativo_10.jpg" style="cursor:pointer;"  width="755" height="121" >'; 
			}
			
			$str_headers   		 = "MIME-Version: 1.0\r\n";
			$str_headers  		.= "Content-Type:text/html;CHARSET=iso-8859-1-i\r\n";
			$str_headers  		.= "From: ".$arrayEmail["email_resposta"]." \r\n";
			
			$str_menssagem = '
				<html>
				<head>
				<title>'.$arrayEmail["nome_portal"].'</title>
				<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
				</head>
				<body bgcolor="#FFFFFF">
				<form name="frm" method="post" action="">
				<input name="tamanhoTexto" type="hidden" value="10"/>
				<DIV align="center">
				<table width="766" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td height="5" colspan="3"></td>
				  </tr>
				  <tr>
					<td height="5" colspan="3"></td>
				  </tr>
				  <tr>
					<td width="2"></td>
					<td width="755" height="121" align="left">'.$bannerWeb.'</td>
					</td>
					<td width="8"></td>
				  </tr>
				  <tr>
					<td height="5"></td>
					<td width="755"></td>
					<td width="9"></td>
				  </tr>  
				  <tr>
					<td colspan="3" height="25" align="left">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td width="3"></td>
							<td width="8" height="25" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/adm_top_Bar_E.gif"></td>
							<td width="300" height="25" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/adm_top_Bar_dgrE.gif"><span style="	font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 18px; color: #FFFFFF; text-decoration: none;">'.$arrayEmail["nome_portal"].'</span></td>
							<td width="27" height="25" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/adm_top_Bar_M.gif"></td>
							<td width="410" height="25" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/adm_top_Bar_dgrD.gif">'.$arrayEmail["assunto"].'</td>
							<td width="8" height="25" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/adm_top_Bar_D.gif"></td>
							<td width="10"></td>
						  </tr>
						</table>
					</td>
				  </tr>
				</table>
				</DIV>
				<DIV align="center">
				<table width="756" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width=="7"></td>
						<td colspan="10" height="5"></td>
						<td height="5"></td>
					</tr>
					<tr>
						<td></td>
						<td colspan="2" width="8" height="24" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/top_grupoRes_top_01.gif"></td>
						<td width="286" height="24" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/top_grupoRes_top_02.gif"><span style="	font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; color: #FFFFFF; text-decoration: none;">'.$arrayEmail["email_barra"].'</span></td>
						<td width="31" height="24" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/top_grupoRes_top_03.gif"></td>
						<td height="24" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/top_grupoRes_top_04.gif" valign="bottom" align="left"></td>
					  <td width="23" height="24" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/top_grupoRes_top_05.gif"></td>
						<td colspan="2" rowspan="2" height="35" width="225" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/top_grupoRes_top_06.gif"></td>
						<td colspan="2" rowspan="2" height="35" width="8" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/top_grupoRes_top_07.gif"></td>
						<td height="24"></td>
					</tr>
					<tr>
						<td></td>
						<td width="3" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/top_grupoRes_top_08.gif"></td>
						<td colspan="5" height="11" '.$localWeb.'></td>
						<td height="11"></td>
					</tr>
					<tr>
						<td></td>
						<td width="3" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/med_grupoRes_E.gif"></td>
						<td colspan="8"></td>
						<td width="3" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/med_grupoRes_D.gif"></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td width="3" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/med_grupoRes_E.gif"></td>
						<td colspan="8" width="627" valign="top" align="left">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td colspan="3" height="5"></td>
							  </tr>
							  <tr>
								<td width="15"></td>
								<td width="457" height="70" align="left" valign="top">
								<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #999999;">'.$arrayEmail["data_atual"].'</span><br />
								<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #525252; vertical-align: bottom; a {text-decoration: none;}">'.$arrayEmail["email_titulo"].'</span></td>
								<td width="170"></td>
							  </tr>
							  <tr>
								<td></td>
  <td colspan="2" align="left" valign="top"><p><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #000000; text-align: justify; text-decoration: none;">'.$arrayEmail["email_titulo_msg"].'</span></p>								
								  <p>'.$arrayEmail["email_msg"].'</p>
								<br /><br /></td>
							  </tr>
							</table>
						</td>
						<td background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/med_grupoRes_D.gif"></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td colspan="2" width="8" height="15" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/boton_grupoRes_E.gif"></td>
						<td colspan="6" height="15" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/boton_grupoRes_M.gif"></td>
						<td colspan="2" height="15" width="8" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/boton_grupoRes_D.gif"></td>
						<td height="15"></td>
					</tr>
					<tr>
						<td></td>
						<td width="3"></td>
						<td width="5"></td>
						<td width="266"></td>
						<td width="31"></td>
						<td width="45"></td>
						<td colspan="2" width="24"></td>
						<td width="364"></td>
						<td width="5"></td>
						<td width="3"></td>
						<td width="5"></td>
					</tr>
				</table>
				</DIV>
				<DIV align="center">
				<table width="760" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td colspan="2" height="5"></td>
					</tr>
					<tr>
					  <td width="677" height="37" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/bottonBar_info.gif" style="width:678px;"></td>
					  <td width="89" height="37" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/bottonBar_logo_02.jpg"></td>
					</tr>
				</table>
				</DIV>
				</form>
				</body>
				</html>
			';
			
			if (mail($arrayEmail["email_destino"], $arrayEmail["assunto"], $str_menssagem, $str_headers))
			{
				return true;
			}else
			{
				return false;
			}
		}
		
		//============================================================================//
		//Função que atualiza as sequeces de acordo com o ultimo reg cadastrado no bd.//
		//============================================================================//
		protected function atualizadorSequence($objConexao, $str_nomeTabela, $str_nomeSequence)
		{
			$sql 			= "SELECT nextval('msf.".$str_nomeSequence."') as id_".$str_nomeTabela;
			$query 			= $objConexao->executaSQL($sql);
			$arraySequence	= $objConexao->retornaArray($query);
	
			$sql 			= "SELECT id_".$str_nomeTabela." from msf.".$str_nomeTabela." order by  id_".$str_nomeTabela." desc limit 1";
			$query 			= $objConexao->executaSQL($sql);
			$arrayTabela	= $objConexao->retornaArray($query);
			
			if ($arraySequence["id_".$str_nomeTabela] < $arrayTabela["id_".$str_nomeTabela])
			{
				$novo_start = (intval($arrayTabela["id_".$str_nomeTabela]) + 1);

				$sql = "ALTER SEQUENCE msf.".$str_nomeSequence." RESTART WITH ".$novo_start.";";
				$objConexao->executaSQL($sql);
				return $novo_start;
			}else
			{
				return $arraySequence["id_".$str_nomeTabela]; 
			}
		}
		
		
		//============================================================================//
		//         Função que monta as querys de acordo com os Arrays.               //
		//============================================================================//
		function montaQuerys($arrayCampos, $str_queryTabelas)
		{
			//concatena query com os devidos campos.
			for ($cont=0; $cont < count($arrayCampos); $cont++)
			{
				if ($cont == 0)
				{
					$sql_concatena = 'SELECT ';
				}else
				{
					$sql_concatena .= ', ';
				}
				
				if (!empty($arrayCampos[$cont]))
				{
					$sql_concatena .= $arrayCampos[$cont];
				}
			}
			$sql_concatena .= " ".$str_queryTabelas;
			return $sql_concatena;
		}

		//============================================================================//
		//                Função que retorna data do dia atual                        //
		//============================================================================//
		public function retornaDataAtual($formato, $padrao = "BancoDados")
		{
			if ($formato == 'DataInterface')
			{
				$dia_num = date("w");
				$mes_num = date("m");
				if($dia_num == 0)
				{
					$data = "Domingo";
				}else if($dia_num == 1)
				{
					$data = "Segunda-Feira";
				}else if($dia_num == 2)
				{
					$data = "Terça-Feira";
				}else if($dia_num == 3)
				{
					$data = "Quarta-Feira";
				}else if($dia_num == 4)
				{
					$data = "Quinta-Feira";
				}else if($dia_num == 5)
				{
					$data = "Sexta-Feira";
				}else
				{
					$data = "Sábado";
				}
				$data .= ', '.date("d").' de ';
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
				return $data.' de '.date("Y");

			}else if ($formato == 'Numerico')
			{
				if($padrao == "BancoDados")
				{
					return date("Y")."-".date("m")."-".date("d");
				}
				else if($padrao == "Interface")
				{
					return date("d")."/".date("m")."/".date("Y");
				}
			}
		}
		public function converteDataBanco($str_data)
		{
			// converter de 12/01/1981 para 1981-01-12
			if (strlen($str_data)==10)
			{
				return substr($str_data, 6, 4)."-".substr($str_data, 3, 2)."-".substr($str_data, 0, 2);
			}else
			{
				return '';
			}
		}

		public function retornaDataNumerica($str_data, $itemData = 'HORA_COMPLETA')
		{
			//Thu, 03 Apr 2008 14:27:15 -0300
			if (strlen($str_data) == 31 || strlen($str_data) == 30)
			{
				if (strlen($str_data) == 30)
				{
					$dia = substr($str_data, 5, 2);
					$dia = '0'.str_replace(' ', '' ,$dia);
					$concatenaInicioAno = 11;
				}else
				{
					$dia = substr($str_data, 5, 2);
					$concatenaInicioAno = 12;
				}			
				switch ($itemData) 
				{
					case 'HORA_COMPLETA':
						return substr($str_data, 17, 8);
						break;
					case 'DATA_COMPLETA':
						return $dia."/".$this->retornaMesNumerico($str_data)."/".substr($str_data, $concatenaInicioAno, 4);
						break;	
					case 'HH':
						return substr($str_data, 17, 2);
						break;

					case 'MI':
						return substr($str_data, 20, 2);
						break;

					case 'SS':
						return substr($str_data, 23, 2);
						break;

					case 'DD':
						return substr($str_data, 5, 2);
						break;

					case 'MM':
						return $this->retornaMesNumerico($str_data);
						break;

					case 'YYYY':
						return substr($str_data, 12, 4);
						break;
				}
			}else if (strlen($str_data) == 19)
			{
				//2008-05-16 02:24:48
				switch ($itemData) 
				{
					case 'HORA_COMPLETA':
						return substr($str_data, 11, 8);
						break;
					case 'DATA_COMPLETA':
						return substr($str_data, 8, 2)."/".substr($str_data, 5, 2)."/".substr($str_data, 0, 4);
						break;						
					case 'HH':
						return substr($str_data, 11, 2);
						break;

					case 'MI':
						return substr($str_data, 14, 2);
						break;

					case 'SS':
						return substr($str_data, 17, 2);
						break;

					case 'DD':
						return substr($str_data, 8, 2);
						break;

					case 'MM':
						return substr($str_data, 5, 2);
						break;

					case 'YYYY':
						return substr($str_data, 0, 4);
						break;
				}
			}//2008-05-16
			else if(strlen($str_data) == 10)
			{
				return substr($str_data, 8, 2)."/".substr($str_data, 5, 2)."/".substr($str_data, 0, 4);
			}
			else if (strlen($str_data) == 0)
			{
				return "";
			}
		}

		private function retornaMesNumerico($str_data)
		{
			//string recebida imprimi o valor neste formato Thu, 03 Apr 2008 14:27:15 -0300
			if(substr($str_data, 8, 3) == 'Jan')
			{
				$data = "01";
			}else if(substr($str_data, 8, 3) == 'Feb')
			{
				$data = "02";
			}else if(substr($str_data, 8, 3) == 'Mar')
			{
				$data = "03";
			}else if(substr($str_data, 8, 3) == 'Apr')
			{
				$data = "04";
			}else if(substr($str_data, 8, 3) == 'May')
			{
				$data = "05";
			}else if(substr($str_data, 8, 3) == 'Jun')
			{
				$data = "06";
			}else if(substr($str_data, 8, 3) == 'Jul')
			{
				$data = "07";
			}else if(substr($str_data, 8, 3) == 'Aug')
			{
				$data = "08";
			}else if(substr($str_data, 8, 3) == 'Sep')
			{
				$data = "09";
			}else if(substr($str_data, 8, 3) == 'Oct')
			{
				$data = "10";
			}else if(substr($str_data, 8, 3) == 'Nov')
			{
				$data = "11";
			}else
			{
				$data = "12";
			}
			return $data;
		}
		
		//============================================================================//
		//            Verifica se a String não possui caracteres String.              //
		//============================================================================//

		function verificaExistenciaLetras($string)
		{
			$arrayString = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "x", "y", "w", "z", 
								 "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "X", "Y", "W", "Z");
			$sentinela = false;			   
			for($cont = 0; $cont < count($arrayString); $cont++)
			{
				if (!strpos($string, $arrayString[$cont]))
				{
					break;
					$sentinela = true;
				}
			}
			
			if (($sentinela == false)  && ((float)$string) && (substr_count($string, ".") == 1))
			{
				$sentinela = false;
			}else
			{
				$sentinela = true;
			}
			
			return $sentinela;
		}
		
		//============================================================================//
		//                   Funções de Controle de nivel de Acesso.                  //
		//============================================================================//
		public function nivelAcesso($str_nivel)
		{
			switch ($str_nivel) 
			{
				case "Usuario":
					return 1;
					break;
				case "Vendas":
					return 2;
					break;
				case "Gestor":
					return 3;
					break;
			}
		}
				
		//============================================================================//
		//                    Funções de Criptografia de strings.                     //
		//============================================================================//

		function encodeHex($string)
		{
			$hex='';
			for ($i=0; $i < strlen($string); $i++)
			{
				$hex .= dechex(ord($string[$i]));
			}
			return $hex;
		}
		
		function decodeHex($hex)
		{
			$string='';
			for ($i=0; $i < strlen($hex)-1; $i+=2)
			{
				$string .= chr(hexdec($hex[$i].$hex[$i+1]));
			}
			return $string;
		}

		function encodeBase64($string)
		{
			return base64_encode($string);
		}
		
		function decodeBase64($string)
		{
			return base64_decode($string);
		}

		function sequenceCrypt($string, $cont, $bln_sifraDesifra)
		{
			if ($cont == true && $string == '')
			{
				do
				{
					if ($cont%2==0)
					{
						break;
					}
					$cont = rand (1, 10);
				}while($cont % 2 != 0);
				return $cont;
			}else
			{
				$senha = $string;
				for ($i=($cont-1); $i >= 0; $i--)
				{
					if ($bln_sifraDesifra==true)
					{
						if ($i%2==0)
						{
							$senha = $this->encodeHex($senha);
						}else
						{
							$senha = $this->encodeBase64($senha);
						}
					}else
					{
						if ($i%2==0)
						{
							$senha = $this->decodeBase64($senha);
						}else
						{
							$senha = $this->decodeHex($senha);
						}			
					}
				}
				return $senha;
			}
		}

		function anti_injection($string)
		{
			// remove palavras que contenham sintaxe sql
			$string = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$string);
			$string = trim($string);//limpa espaços vazio
			$string = strip_tags($string);//tira tags html e php
			$string = addslashes($string);//Adiciona barras invertidas a uma string
			return $string;
		}

		function removeLixoDecriptVazio($string)
		{
			if (strlen($string) <= 2)
			{
				return '';
			}else
			{
				return $string;
			}
		}
		
		function incluirDiretorioString($diretorio,$string)
		{
			$posicaoString = strpos($string,$diretorio);
			if ($posicaoString === FALSE)
			{
				return $diretorio.$string;
			}else
			{
				$string = str_replace($diretorio, '', $string);
				return $diretorio.$string;
			}
		}

		function retornoImagemGaleria($imagem)
		{
			//retornar a imagem indisponivel quando nao existir valor no campo do banco
			if ($imagem != "")
			{
				return $imagem;
			}else
			{
				return "semFoto.jpg";
			}
		}
		
		function abrirArquivoImagem($str_file) 
		{
			# JPEG:
			$arquivoAberto = imagecreatefromjpeg($str_file);
			if ($arquivoAberto !== false) { return $arquivoAberto; }
		
			# GIF:
			$arquivoAberto = imagecreatefromgif($str_file);
			if ($arquivoAberto !== false) { return $arquivoAberto; }
		
			# PNG:
			$arquivoAberto = imagecreatefrompng($str_file);
			if ($arquivoAberto !== false) { return $arquivoAberto; }
		
			# GD File:
			$arquivoAberto = imagecreatefromgd($str_file);
			if ($arquivoAberto !== false) { return $arquivoAberto; }
		
			# GD2 File:
			$arquivoAberto = imagecreatefromgd2($str_file);
			if ($arquivoAberto !== false) { return $arquivoAberto; }
		
			# WBMP:
			$arquivoAberto = imagecreatefromwbmp($str_file);
			if ($arquivoAberto !== false) { return $arquivoAberto; }
		
			# XBM:
			$arquivoAberto = imagecreatefromxbm($str_file);
			if ($arquivoAberto !== false) { return $arquivoAberto; }
		
			# XPM:
			$arquivoAberto = imagecreatefromxpm($str_file);
			if ($arquivoAberto !== false) { return $arquivoAberto; }
		
			# Refazer e ler a string:
			$arquivoAberto = imagecreatefromstring(file_get_contents($str_file));
			if ($arquivoAberto !== false) { return $arquivoAberto; }
		
			return false;
		}
		
		public function apagaArquivoDiretorio($diretorioArquivo, $bln_apagaDepois = TRUE, $bln_apagaMiniatura = FALSE)
		{
			$diretorioArquivoMiniatura = '';
			if ($bln_apagaMiniatura)
			{
				if (strpos($diretorioArquivo, 'M')===false)
				{
					$diretorioArquivo = $this->incluirDiretorioString('imovel/','M'.basename($diretorioArquivo));
					$posicaoCaracterBarra = strrpos($diretorioArquivo, DIRECTORY_SEPARATOR);
					$diretorioArquivo = substr($diretorioArquivo, 0, $posicaoCaracterBarra).basename($diretorioArquivo);
				}
				$diretorioArquivoMiniatura = $this->incluirDiretorioString('mini/',str_replace('M','',$diretorioArquivo));
				$diretorioArquivoMiniatura = $this->incluirDiretorioString('imovel/',str_replace('M','',$diretorioArquivoMiniatura));
				
				if ($bln_apagaDepois)
				{
					$diretorioArquivoMiniatura 	= str_replace(array('\\','/'), DIRECTORY_SEPARATOR, $diretorioArquivoMiniatura);
					$diretorioArquivoMiniatura	= str_replace('adm\\', $diretorioArquivoMiniatura, getcwd().DIRECTORY_SEPARATOR);
				}
				unlink($diretorioArquivoMiniatura);
				$diretorioArquivo = $this->incluirDiretorioString('imovel/',$diretorioArquivo);
			}
			
			if ($bln_apagaDepois)
			{
				$diretorioArquivo 	= str_replace(array('\\','/'), DIRECTORY_SEPARATOR, $diretorioArquivo);
				$diretorioArquivo	= str_replace('adm\\', $diretorioArquivo, getcwd().DIRECTORY_SEPARATOR);
			}
			unlink($diretorioArquivo);
		}

		public function apagaImagemSubstituida($objConexao, $query, $campoDiretorio, $bln_apagaMiniatura = FALSE, $diretorioCampo='')
		{
			$array 	= $objConexao->retornaArray($query);
			if ($bln_apagaMiniatura)
			{
				$this->apagaArquivoDiretorio($array[$campoDiretorio], TRUE, TRUE);
			}else
			{
				if ($diretorioCampo!='')
				{
					$this->apagaArquivoDiretorio($this->incluirDiretorioString($diretorioCampo,$array[$campoDiretorio]));
				}else
				{
					$this->apagaArquivoDiretorio($array[$campoDiretorio]);
				}
			}
		}
						
		protected function retornoUrlValido ($str_url)
		{
			$str_url = strtolower($str_url);
			
			$str_url = str_replace(array('\\','/'), DIRECTORY_SEPARATOR, $str_url);//corrigir barras do diretorio
			
			$str_url = str_replace(array('!','@','#','$','%','¨','&','*','(',')','+','=','{','}','[',']',';',',',"'",'§','¬','¢','£','~','^','´','`') , '_',$str_url);
			$str_url = str_replace(array('|','<','>','?','ª','º',' ','	') , '_',$str_url);

			$str_url = str_replace('¹','1',$str_url);
			$str_url = str_replace('²','2',$str_url);
			$str_url = str_replace('³','3',$str_url);

			$str_url = str_replace(array('á','ã','à','â', 'ä') 	, 'a',$str_url);
			$str_url = str_replace(array('ó','õ','ò','ô', 'ö') 	, 'o',$str_url);
			$str_url = str_replace(array('é','è','ê', 'ë') 		, 'e',$str_url);
			$str_url = str_replace(array('í','ì','î', 'ï') 		, 'i',$str_url);
			$str_url = str_replace(array('ú','ù','û', 'ü') 		, 'u',$str_url);
			return $str_url;
		}

		public function retornoDescricoesValidas ($str_descricao)
		{
			$str_url = strtolower($str_descricao);
			
			$str_descricao = str_replace(array('¨','{','}','[',']',';','§','¬','¢','£','~','^','´','`') , '',$str_descricao);
			$str_descricao = str_replace(array("'") , '"',$str_descricao);
			$str_descricao = str_replace(array('|','ª','º') , '',$str_descricao);
			$str_descricao = str_replace(array('<br/>','<BR>','<Br>','<bR>') , '<br>',$str_descricao);

			$str_descricao = str_replace('¹','1',$str_descricao);
			$str_descricao = str_replace('²','2',$str_descricao);
			$str_descricao = str_replace('³','3',$str_descricao);

			return $str_descricao;
		}
		
		public function retornaTiposValidos($file ,$tipoFile)
		{
			if ($file == 'IMAGEM')
			{
				$aceitos[0] = "image/gif";
				$aceitos[1] = "image/pjpeg";
				$aceitos[2] = "image/jpeg";
				$aceitos[3] = "image/pjpg";
				$aceitos[4] = "image/jpg";
				$aceitos[5] = "image/x-png";
				$aceitos[6] = "image/png";			
			}
			else if ($file == 'IMAGEM_TRANSPARENTE')
			{
				$aceitos[0] = "image/x-png";
				$aceitos[1] = "image/png";			
			}
			else if ($file == 'FLASH')
			{
				$aceitos[0] = "application/x-shockwave-flash";
			}
			else if ($file == 'ARQUIVO')
			{
				$aceitos[0] = "application/vnd.ms-excel";
				$aceitos[1] = "application/msword";
				$aceitos[2] = "application/pdf";
				$aceitos[3] = "application/x-zip-compressed";
				$aceitos[4] = "application/octet-stream";
			}
			
			$return = false;
			
			for( $i=0; $i < count($aceitos); $i++ )
			{
				if ( $aceitos[$i] == $tipoFile )
				{
					$return = true;
				}
			}
			return $return;
		}
	}
?>