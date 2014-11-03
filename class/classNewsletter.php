<?php class newsLetter extends FuncoesComum 
	{
		private function atribuirViaPost()
		{
			$this->id_newslettersboletim	= $this->sequenceCrypt($_POST["id_newslettersboletim"], $_POST["codSecFormulario"], false);
			$this->str_assunto				= $this->sequenceCrypt($_POST["str_assunto"], $_POST["codSecFormulario"], false);
			$this->str_titulo				= $this->sequenceCrypt($_POST["str_titulo"], $_POST["codSecFormulario"], false);
			$this->str_descricao			= nl2br($this->retornoDescricoesValidas($this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_descricao"], 2, false))));
			$this->dt_publicacao			= $this->converteDataBanco($this->sequenceCrypt($_POST["str_dtPublicacao"], $_POST["codSecFormulario"], false)).' '.date('H:i:s');
			$this->str_emailResposta		= strtolower($this->sequenceCrypt($_POST["str_emailResposta"], $_POST["codSecFormulario"], false));
			$this->bln_enviarNewsletters	= $this->sequenceCrypt($_POST["chk_enviarNewsletters"], $_POST["codSecFormulario"], false);
			$this->str_diretorioNewsLetters = $this->incluirDiretorioString('newsletters/',$this->str_diretorioNewsLetters).md5(mktime()).".txt";
		}

		public function inicializaVariaveis()
		{
			$this->id_newslettersboletim	= "";
			$this->str_assunto				= "";
			$this->str_titulo				= "";
			$this->str_descricao			= "";
			$this->dt_publicacao			= "";
			$this->str_emailResposta		= "";
			$this->bln_enviarNewsletters	= "t";
			$this->bln_enviarNewslettersAux = "true";
			$this->str_diretorioNewsLetters = "";
		}
		
		public function atribuirQuery($objConexao, $int_codigo)
		{
			$query = $this->consultaNewsLetter($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);

			$this->str_assunto				= $this->codifiStringBancoInterface($objConexao,$array["str_assunto"]);
			$this->str_titulo				= $this->codifiStringBancoInterface($objConexao,$array["str_titulo"]);
			$this->str_descricao			= $this->codifiStringBancoInterface($objConexao,$array["str_descricao"]);
			$this->dt_publicacao			= $this->retornaDataNumerica($array["dt_publicacao"], 'DATA_COMPLETA');
			$this->str_emailResposta		= $this->codifiStringBancoInterface($objConexao,$array["str_emailresposta"]);
			$this->str_diretorioNewsLetters	= $this->codifiStringBancoInterface($objConexao,$array["str_diretorionewsletters"]);
			$this->bln_enviarNewsletters	= $array["bln_enviarnewsletters"];
			$this->bln_enviarNewslettersAux	= $this->bln_enviarNewsletters == 't'?'true':'';
		}	

		private function consultaNewsLetter($objConexao,$int_codigo)	
		{
			$sql = "SELECT * from msf.newslettersboletim where id_newslettersboletim =".$int_codigo;
			return	$objConexao->executaSQL($sql);		
		}

		public function cadastrarNewsLetter($objConexao)
		{
			$this->atribuirViaPost();
			
			
			$sql	=  "SELECT id_newslettersboletim from msf.newslettersboletim where str_assunto = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_assunto)."'";
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) == 0)
			{
				$intCodigo = $this->atualizadorSequence($objConexao, "newslettersboletim", "newslettersboletim_id_newslettersboletim_seq");
				$sql = "INSERT INTO msf.newslettersboletim
						(
							id_newslettersboletim,
							str_assunto,
							str_titulo,
							str_descricao,
							dt_publicacao,
							str_emailresposta,
							bln_enviarnewsletters,
							str_diretorionewsletters
						) VALUES 
						(
							*".$intCodigo."*,
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_assunto)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_titulo)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_descricao)."',
							'".$this->dt_publicacao."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_emailResposta)."',
							'".$this->bln_enviarNewsletters."',
							'".$this->str_diretorioNewsLetters."'
						)";
				$sql = str_replace(array("''","**"),"null",$sql);
				$sql = str_replace("*","",$sql);

				if ($objConexao->executaSQL($sql))
				{
					$this->atribuirQuery($objConexao, $intCodigo);
					$objConexao->executaSQL("UPDATE msf.newsletters SET bln_enviado = FALSE");
?>
					<script>
						alertMenssage ('Aviso:','Cadastrado com sucesso.');
					</script>
<?php return true;
				}else
				{
					return false;
				}

			}else
			{
?>
					<script>
						alertMenssage ('Atenção:','Já existe este assunto. <br>Informe outro assunto.');
					</script>
<?php return false;	
			}
		}
		
		public function alterarNewsLetter($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_newslettersboletim from msf.newslettersboletim where id_newslettersboletim = ".$this->id_newslettersboletim;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "UPDATE msf.newslettersboletim SET
							str_assunto				 = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_assunto)."',
							str_titulo				 = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_titulo)."',
							str_descricao			 = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_descricao)."',
							dt_publicacao			 = '".$this->dt_publicacao."',
							str_emailresposta		 = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_emailResposta)."',
							bln_enviarnewsletters	 = '".$this->bln_enviarNewsletters."'
						where id_newslettersboletim  = ".$this->id_newslettersboletim;
				
				$sql = str_replace(array("''","**"),"null",$sql);
				$sql = str_replace("*","",$sql);
				
				if ($objConexao->executaSQL($sql))
				{
					$this->inicializaVariaveis();
?>
					<script>
						alertMenssage ('Aviso:','Alterado com sucesso.');
					</script>
<?php return true;
				}else
				{
					return false;
				}

			}else
			{
?>
					<script>
						alertMenssage ('Atenção:','Este newsletters não foi localizado para ser alterado. <br>Selecione outro newsletters.');
					</script>
<?php return false;	
			}
		}
		
		public function excluirNewsLetter($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_newslettersboletim from msf.newslettersboletim where id_newslettersboletim = ".$this->id_newslettersboletim;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "DELETE FROM msf.newslettersboletim where id_newslettersboletim = ".$this->id_newslettersboletim;
				if ($objConexao->executaSQL($sql))
				{
					$this->inicializaVariaveis();
?>
					<script>
						alertMenssage ('Aviso:','Excluído com sucesso.');
					</script>
<?php return true;
				}else
				{
					return false;
				}

			}else
			{
?>
					<script>
						alertMenssage ('Atenção:','Este newsletters não foi localizado para ser excluído. <br>Selecione outro newsletters.');
					</script>
<?php return false;	
			}
		}		
		
	
		//============================================================================//
		//                   Função sobre os Dados NewsletterBoletim                  //
		//============================================================================//
		public function atribuirViaPostNewsLetterBoletim($objConexao, $id_newslettersboletim = "") 
		{
			if ($id_newslettersboletim != "")
			{
				$sql	=  "SELECT * from msf.newslettersboletim where id_newslettersboletim =".$id_newslettersboletim;
			}else
			{
				$sql	=  "SELECT * from msf.newslettersboletim order by id_newslettersboletim desc limit 1";
			}
			
			$query 	= $objConexao->executaSQL($sql);
			$array 	= $objConexao->retornaArray($query);

			$this->id_newsLettersBoletim 	= $array["id_newslettersboletim"];
			$this->str_assunto				= $array["str_assunto"];
			$this->str_titulo				= $array["str_titulo"];
			$this->str_descricao			= $array["str_descricao"];
			$this->str_emailResposta		= $array["str_emailresposta"];

			$this->dt_publicacao			= "Atualizado em ".$this->retornaDataNumerica($array["dt_publicacao"], 'DATA_COMPLETA')." ".$this->retornaDataNumerica($array["dt_publicacao"], 'HORA_COMPLETA');

			$this->bln_enviarNewsLetters	= $array["bln_enviarnewsletters"];
			$this->str_diretorioNewsLetters	= $array["str_diretorionewsletters"];
		}

		private function atribuirViaPostNewsLetter()
		{
			$this->str_nome 	= ucfirst($this->anti_injection($_POST["str_nome"]));
			$this->str_email	= strtolower(trim($this->anti_injection($_POST["str_email"])));
		}

		//============================================================================//
		//                   Função sobre os Dados Usuarios do Newsletter             //
		//============================================================================//
		public function atribuirArrayUsuarioNewsLetter($objConexao) 
		{
			$sql	=  "SELECT id_newsletters, str_nome, str_email from msf.newsletters where bln_enviado = FALSE order by id_newsletters asc";
			//$sql	=  "SELECT id_newsletters, str_nome, str_email from msf.newsletters where bln_ativo = TRUE && bln_enviado = FALSE order by id_newsletters asc";
			
			$query 	= $objConexao->executaSQL($sql);
			
			$this->contadorUsuariosNewsLetter = $objConexao->contaLinhas($query);
			if ($objConexao->contaLinhas($query) > 0)
			{
				$cont = 0;
				while ($array = $objConexao->retornaArray($query))
				{
					$cont++;
					$this->array_id_newsletters[$cont] 	= $array["id_newsletters"];
					$this->array_str_nome[$cont]		= $array["str_nome"];
					$this->array_str_email[$cont]		= $array["str_email"];
				}
			}
		}
		
		function notificaEmailEnviado($objConexao, $id_newsLetters)
		{
			$sql = "UPDATE msf.newsletters SET
							bln_enviado	= TRUE
					where id_newsletters = ".$id_newsLetters;
			$objConexao->executaSQL($sql);
		}
				
		//============================================================================//
		//        Função ativar o envio de Newsletters no horario permitido           //
		//============================================================================//
		public function ativarEnvioNewsLetters($objConexao, $str_menssagem) 
		{
			$this->atribuirViaPostNewsLetterBoletim($objConexao);
			//*criar isso na funcao de inserir o NewsLetterBoletim
			//*$filename = "newsletters\\".md5(mktime()).".txt";
			
			if (!$handle = fopen($this->getDiretorioNewsLetters(), 'w+')) 
			{
?>
				<script>
					alertMenssage ('Erro:','Erro ao abrir o arquivo ($this->getDiretorioNewsLetters()).');
				</script>	
<?php return false;
			}
		
			if (!fwrite($handle, $str_menssagem)) 
			{
?>
				<script>
					alertMenssage ('Erro:','Erro ao escrever no arquivo ($this->getDiretorioNewsLetters()).');
				</script>	
<?php return false;
			}
			fclose($handle);
			
			$sql = "Update msf.newslettersboletim set 
						bln_enviarnewsletters = TRUE 
					where id_newslettersboletim = ".$this->getId_newsLettersBoletim();
			if ($objConexao->executaSQL($sql))
			{
?>
				<script>
					alertMenssage ('Aviso:','Sua mensagem foi gravada em arquivo para envio no horário de 00:00 as 06:00.');
				</script>	
<?php return true;
			}

		}

		public function incluirMailBlockList($objConexao) 
		{
			$this->atribuirViaPostNewsLetterBoletim($objConexao);

			$filenameOriginal 	= "newsletters\\mercado_imobiliario.txt";
			$filename		 	= "newsletters\\mercado_imobiliarioNOVO.txt";

			$handle 		= fopen($filenameOriginal, 'r+');		

			$handleNovo 	= fopen($filename, 'w+');

/*
//==========1º colocar <br /> na quebra de linhas			
			$conteudo = fread ($handle, filesize ($filenameOriginal));
			$conteudo = nl2br ($conteudo);
			fwrite($handleNovo, $conteudo);
			fflush($handleNovo);
*/
/*
//==========2º colocar INSERT na quebra de linhas	com id #
			$conteudo = fread ($handle, filesize ($filenameOriginal));
			$conteudo = str_replace('<br />', "', false, false);".chr(13)."INSERT INTO \"msf\".\"newsletters\" (\"id_newsletters\", \"str_nome\", \"str_email\", \"bln_ativo\", \"bln_enviado\") VALUES (#, 'Senhor(a)', '", $conteudo);
			fwrite($handleNovo, $conteudo);
			fflush($handleNovo);
*/
/*
//==========3º substituir # por id's
			$int_id 	= 1958347;
			while (!feof ($handle)) 
			{
				$conteudo = fgets($handle, 4096);
				$conteudo = preg_replace('(#)',$int_id, $conteudo, 1);
				$int_id ++;
				fwrite($handleNovo, $conteudo);
				fflush($handleNovo);
			}
*/
/*
//==========4º remover espaço entre ' e o email
			$conteudo = fread ($handle, filesize ($filenameOriginal));
			$conteudo = str_replace("'
", "'", $conteudo);
			fwrite($handleNovo, $conteudo);
			fflush($handleNovo);
*/

/*
//==========5º incluir no banco de dados.
			while (!feof ($handle)) 
			{
				$sql = fgets($handle, 4096);
				
				if (!$objConexao->executaSQL($sql))
				{
					fwrite($handleNovo, $conteudo);
					fflush($handleNovo);	
				}
			}
*/
			fclose($handleNovo);
			fclose($handle);


		}


		function enviarNewsLetter($objConexao, $objConfiguracao, $publicidade = false, $agora = false)
		{
			$sql = "SELECT id_newslettersboletim from msf.newslettersboletim where bln_enviarnewsletters = TRUE";
			$query 	= $objConexao->executaSQL($sql);
			
			$array = $objConexao->retornaArray($query);

			$this->atribuirViaPostNewsLetterBoletim($objConexao, $array["id_newslettersboletim"]);
			$this->atribuirArrayUsuarioNewsLetter($objConexao);

			$contadorLinhas = $this->getContadorUsuariosNewsLetter();
				
			$this->str_headers   = "MIME-Version: 1.0\r\n";
			$this->str_headers  .= "Content-Type:text/html;CHARSET=iso-8859-1-i\r\n";
			$this->str_headers  .= "From: ".$this->getEmailResposta()."\r\n";

			// ler o conteúdo do arquivo para uma string
			$handle = fopen ($this->getDiretorioNewsLetters(), "r");
			$this->str_menssagem = fread ($handle, filesize ($this->getDiretorioNewsLetters()));
			fclose ($handle);
			
			$this->contEmailEnviados = 0;
			$this->contEmailFalhos = 0;	
			$contadorBloco = 0;
			
			$horaAtual = getdate(); 
			$horaAtual['hours'];
			
			$listaEmailsFalhos = '';

			for($i = $contadorLinhas; $i > 0; $i--)
			{
				if ($horaAtual['hours'] >= 0 && $horaAtual['hours'] <= 5 or $agora == TRUE)
				{
					if (mail($this->getArray_str_email($i), $this->getAssunto(), $this->str_menssagem, $this->str_headers))
					{
						$this->contEmailEnviados++;
						$this->notificaEmailEnviado($objConexao, $this->array_id_newsletters[$i]);
						
					}else
					{
						$this->contEmailFalhos++;
						$listaEmailsFalhos .= $this->getArray_str_email($i).',<br/>';
						$sql = "delete from msf.newsletters where str_email ='".$this->getArray_str_email($i)."'";
						$objConexao->executaSQL($sql);
					}
					
					$contadorBloco++;
					if ($contadorBloco == 10000 || $contadorLinhas == 0)
					{
						$contadorBloco = 0;
						break;
					}
				}else
				{
					break;
				}
			}
			
			if ($this->contEmailFalhos!=0)
			{
				$objConfiguracao->atribuirBanner($objConexao, 'Banner Topo');

				$arrayEmail["email_resposta"]	= $objConfiguracao->getEmailParkimovel();
				$arrayEmail["assunto"]			= 'RELATÓRIO DIÁRIO DO ENVIO DE NEWSLETTERS.';
				$arrayEmail["nome_portal"] 		= $objConfiguracao->showTitulo();
				$arrayEmail["email_barra"]		= 'MENSAGEM DO SISTEMA NEWSLETTERS';
				$arrayEmail["data_atual"] 		= $this->getDt_publicacao();
				$arrayEmail["email_titulo"] 	= 'OBRIGADO POR UTILIZAR NOSSO SISTEMA DE NEWSLETTERS.';
				$arrayEmail["email_titulo_msg"] = 'RELATÓRIO DO NEWSLETTERS';
				
				$arrayEmail["email_msg"] 		= '<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #000000; text-align: justify; text-decoration: none;">Houve sucesso no envio de '.$this->contEmailEnviados.' emails.<br />E '.$this->contEmailFalhos.' emails falharam no seu envio, em um total de '.$contadorLinhas.' emails.</span><br /><br />'.$listaEmailsFalhos;
	
				//============================================================================//
				//                     			RELATÓRIO DE ENVIO					          //
				//============================================================================//
				$arrayEmail["email_destino"] 	= $objConfiguracao->getEmail();
				$this->corpoLayoutEmail($objConexao, $objConfiguracao, $arrayEmail, 'EmailExterno');

			}
			$sql = "select id_newsletters from msf.newsletters where bln_enviado = FALSE";
			if ($objConexao->contaLinhas($objConexao->executaSQL($sql)) == 0)
			{
				$sql = "Update msf.newslettersboletim set bln_enviarnewsletters = FALSE where id_newslettersboletim = ".$array["id_newslettersboletim"];
				$objConexao->executaSQL($sql);
			}
		}

		
		function gerarNewsLetter($objConfiguracao, $objConexao, $publicidade=FALSE)
		{
			//============================================================================//
			//                    CRIAÇAO DE ARQUIVO NEWSLETTERS EM ARQUIVO TXT           //
			//============================================================================//
			if (!$publicidade)
			{
				$this->atribuirViaPostNewsLetterBoletim($objConexao);
				$this->atribuirArrayUsuarioNewsLetter($objConexao);
				$objConfiguracao->atribuirBanner($objConexao, 'Banner Topo');

				$bannerWeb 	= strpos('ssl8', $objConfiguracao->getDiretorioBanner(TRUE)) === false ?str_replace(array("https://","http://"),'http://',$objConfiguracao->getDiretorioBanner(TRUE)):str_replace(array("https://","http://"),'https://',$objConfiguracao->getDiretorioBanner(TRUE));
				$objConfiguracao->getDiretorioBanner(TRUE); 

				$this->str_menssagem = '
				<html>
				<head>
				<title>'.$objConfiguracao->showTitulo().'</title>
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
							<td width="300" height="25" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/adm_top_Bar_dgrE.gif"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #FFFFFF; text-decoration: none;">'.$objConfiguracao->showTitulo().'</span></td>
							<td width="27" height="25" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/adm_top_Bar_M.gif"></td>
							<td width="410" height="25" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/adm_top_Bar_dgrD.gif">Olá Senhor(a), saiba tudo sobre as novidades imobiliárias.</td>
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
						<td width="286" height="24" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/email/top_grupoRes_top_02.gif"><span style="	font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #FFFFFF; text-decoration: none;">'.$this->getAssunto().'</span></td>
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
						<td colspan="5" height="11" bgcolor="'.$objConfiguracao->getCorFundoGrupo().'"></td>
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
								<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #999999;">'.$this->getDt_publicacao().'</span><br />
								<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 18px; color: #525252; vertical-align: bottom; a {text-decoration: none;}"><a href="'.$objConfiguracao->getDiretorioConcateEmail().'">'.$this->getTitulo().'</a></span></td>
								<td width="170"></td>
							  </tr>
							  <tr>
								<td></td>
								<td colspan="2" align="left" valign="top"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #000000; text-align: justify; text-decoration: none;">'.$this->getDescricao().'</span><br /><br /></td>
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
			}else
			{
				$link = $_SERVER["SERVER_NAME"].str_replace($this->retornaNomePaginaAtual(), "",$_SERVER["SCRIPT_NAME"]);
				$this->str_menssagem = '
					<html>
					<head>
					<title>'.$objConfiguracao->showTitulo().'</title>
					<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
					</head>
					<style>
						.adm_fonteTextoGrupo_01{
							font-family: Verdana, Arial, Helvetica, sans-serif;
							font-size: 10px;
							color: #000000;
							text-align: justify;
							text-decoration: none;
						}
						.adm_fonteTextoGrupo_01 a{
							font-family: Verdana, Arial, Helvetica, sans-serif;
							font-size: 10px;
							color: #000000;
							text-align: justify;
							text-decoration: none;
						}
						.adm_fonteTextoGrupo_01 a:hover{
							font-family: Verdana, Arial, Helvetica, sans-serif;
							font-size: 10px;
							color: <?php echo $objConfiguracao->getCorTopGrupo();?>;
							text-align: justify;
							text-decoration: none;
						}
						.adm_fonteTextoGrupo_01 a:visited{
							font-family: Verdana, Arial, Helvetica, sans-serif;
							font-size: 10px;
							color: #000000;
							text-align: justify;
							text-decoration: none;
						}					
					</style>
					<body bgcolor="#FFFFFF">
					<form name="frm" method="post" action="">
					<span class="adm_fonteTextoGrupo_01" style="text-align:center;">
					<table width="770" height="984" border="0" cellpadding="0" cellspacing="0" >
						<tr>
							<td>
								<img src="'.$objConfiguracao->getDiretorioConcateEmail().'publicidade/images/publicidade_01.jpg" width="770" height="440" alt=""></td>
						</tr>
						<tr>
							<td>
								<img src="'.$objConfiguracao->getDiretorioConcateEmail().'publicidade/images/publicidade_02.jpg" width="770" height="162" alt=""></td>
						</tr>
						<tr>
							<td>
								<img src="'.$objConfiguracao->getDiretorioConcateEmail().'publicidade/images/publicidade_03.jpg" width="770" height="161" alt=""></td>
						</tr>
						<tr>
							<td>
								<img src="'.$objConfiguracao->getDiretorioConcateEmail().'publicidade/images/publicidade_04.jpg" width="770" height="221" alt=""></td>
						</tr>
					</table>
					<a href="'.$objConfiguracao->getDiretorioConcateEmail().'index.php?cod=Solucoes" target="_blank">parkimovel.com</a>
					</span>
					</form>
					</body>
					</html>';
			}
			
			$this->ativarEnvioNewsLetters($objConexao, $this->str_menssagem);				
		}
		
		//============================================================================//
		//                   Função sobre os Dados Usuarios do Newsletter             //
		//============================================================================//
		public function cadastrarUsuarioNewsLetter($objConexao, $objConfiguracao) 
		{
			$this->atribuirViaPostNewsLetter();
			
			$sql	=  "SELECT id_newsletters from msf.newsletters where str_email = '".$this->str_email."'";
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) == 0)
			{
				$intCodigo = $this->atualizadorSequence($objConexao, "newsletters", "newsletters_id_newsletters_seq");
				$sql = "INSERT INTO msf.newsletters 
						(
							id_newsletters, 
							str_nome, 
							str_email, 
							bln_ativo
						) VALUES 
						(
							*".$intCodigo."*, 
							'".$this->str_nome."',
							'".$this->str_email."', 
							TRUE
						)";
				$sql = str_replace(array("''","**"),"null",$sql);
				$sql = str_replace("*","",$sql);
				if ($objConexao->executaSQL($sql))
				{
					$this->enviarConfirmacaoNewsLetters($objConexao, $objConfiguracao);
					return true;
				}

			}else
			{
?>
					<script>
						alertMenssage ('Atenção:','Este Email já foi cadastrado. <br>Informe outro Email.');
					</script>
<?php return false;	
			}
		}

		public function validaUsuarioNewsLetter($objConexao, $str_email) 
		{
			$sql	=  "SELECT bln_ativo from msf.newsletters where str_email = '".$str_email."'";
			$query 	= $objConexao->executaSQL($sql);
			if ($objConexao->contaLinhas($query) > 0)
			{
				$array	= $objConexao->retornaArray($query);
				if ($array["bln_ativo"] == "t")
				{
?>
						<script>
							alertMenssage ('Aviso:','Seu email ja foi validado anteriormente.');
						</script>
<?php }else
				{

					$sql = "Update msf.newsletters set bln_ativo = TRUE where str_email = '".$str_email."'";
					if ($objConexao->executaSQL($sql))
					{
?>
						<script>
							alertMenssage ('Aviso:','Parabéns. <br>Seu email foi validado.');
						</script>
<?php }
				}
			}
		}
		
		private function atribuirViaPostIndicaAmigo()
		{
			$this->str_nome 	= ucfirst($this->anti_injection($_POST["str_nomeInd"]));
			$this->str_email	= strtolower(trim($this->anti_injection($_POST["str_emailInd"])));
			
			$this->id_imovel	= trim($this->anti_injection($_POST["id_imovelInd"]));
			$this->id_imagem	= trim($this->anti_injection($_POST["id_imagemInd"]));
		}

		private function atribuirViaPostEmailProprietario()
		{
			$this->str_email			= strtolower(trim($this->anti_injection($_POST["str_emailPro"])));
			$this->str_emailDestino		= strtolower(trim($this->anti_injection($_POST["str_emailProprietario"])));
			$this->str_menssagemPro 	= ucfirst($this->anti_injection($_POST["str_menssagemPro"]));
						
			$this->id_imovel	= trim($this->anti_injection($_POST["id_imovelPro"]));
			$this->id_imagem	= trim($this->anti_injection($_POST["id_imagemPro"]));
		}

		public function enviarEmailProprietario($objConexao, $objConfiguracao)
		{
			$this->atribuirViaPostEmailProprietario();
			
			//============================================================================//
			//             CRIPTOGRAFA O LINK DE VALIDAÇÃO DO USUÁRIO                     //
			//============================================================================//			
			$cont = $this->sequenceCrypt('', true, true);
			$str_linkConfirmacao = $objConfiguracao->getDiretorioConcateEmail().'/index.php?cod=mostrar&id_imovel='.$this->id_imovel.'&id_imagem='.$this->id_imagem;

			//============================================================================//
			//Paramentros do array para usar essa função 								  //
			//============================================================================//
			$arrayEmail["email_resposta"]	= $this->str_email;
			$arrayEmail["email_destino"] 	= $this->str_emailDestino;
			$arrayEmail["assunto"]       	= 'MENSSAGEM DO VISITANTE DO SEU IMÓVEL';
			$arrayEmail["nome_portal"]   	= $objConfiguracao->showTitulo();
			$arrayEmail["email_barra"]	 	= 'MENSSAGEM DO VISITANTE';
			$arrayEmail["data_atual"]    	= $objConfiguracao->retornaDataAtual('Numerico', 'Interface');
			$arrayEmail["email_titulo"]  	= 'O portal '.$objConfiguracao->showTitulo().' não se responsabiliza pelo conteúdo das menssagens enviadas por visitantes do seu imóvel.';
			$arrayEmail["email_titulo_msg"]	= 'Visitante do <a href='.$str_linkConfirmacao.'>imovel</a> escreveu:';
			$arrayEmail["email_msg"]	 	= $this->str_menssagemPro;

			//============================================================================//
			//             ENVIO DE EMAIL PARA INDICAÇÃO DE IMÓVEL		                  //
			//============================================================================//	
			return $this->corpoLayoutEmail($objConexao, $objConfiguracao, $arrayEmail, 'EmailExterno');
		}
		
		public function enviarIndicacaoAmigo($objConexao, $objConfiguracao)
		{
			$this->atribuirViaPostIndicaAmigo();
			//============================================================================//
			//             CRIPTOGRAFA O LINK DE VALIDAÇÃO DO USUÁRIO                     //
			//============================================================================//			
			$cont = $this->sequenceCrypt('', true, true);
			$str_linkConfirmacao = $objConfiguracao->getDiretorioConcateEmail().'/index.php?cod=mostrar&id_imovel='.$this->id_imovel.'&id_imagem='.$this->id_imagem;


			//============================================================================//
			//Paramentros do array para usar essa função 								  //
			//============================================================================//
			$arrayEmail["email_resposta"]	= 'parkimovel@parkimovel.com';
			$arrayEmail["email_destino"] 	= $this->str_email;
			$arrayEmail["assunto"]       	= 'Olá, o seu amigo(a) '.$this->str_nome.' te indicou um imóvel.';
			$arrayEmail["nome_portal"]   	= $objConfiguracao->showTitulo();
			$arrayEmail["email_barra"]	 	= 'INDICAÇÃO DE IMÓVEL';
			$arrayEmail["data_atual"]    	= $objConfiguracao->retornaDataAtual('Numerico', 'Interface');
			$arrayEmail["email_titulo"]  	= 'Olá, seu amigo(a) '.$this->str_nome.', te indicou este imóvel.<br /><br /><a href='.$str_linkConfirmacao.'>Clique aqui para Visualizar o Imóvel que te Indicaram.</a>';
			$arrayEmail["email_titulo_msg"]	= '<br /><br />';
			$arrayEmail["email_msg"]	 	= 'Caso não consiga vizualizar o imóvel no link acima copie e cole no seu navegador o endereço abaixo:<br />'.str_replace(array('https://','http://'),'',$str_linkConfirmacao);

			//============================================================================//
			//             ENVIO DE EMAIL PARA INDICAÇÃO DE IMÓVEL		                  //
			//============================================================================//	
			return $this->corpoLayoutEmail($objConexao, $objConfiguracao, $arrayEmail, 'EmailExterno');			

		}
		
		//============================================================================//
		// DEVE SE COLOCAR UMA OPÇÃO PARA O USUÁRIO NÃO RECEBER MAIS EMAILS           //
		//============================================================================//
		private function enviarConfirmacaoNewsLetters($objConexao, $objConfiguracao)
		{
			$this->atribuirViaPostNewsLetter();

			//============================================================================//
			//             CRIPTOGRAFA O LINK DE VALIDAÇÃO DO USUÁRIO                     //
			//============================================================================//			
			$cont = $this->sequenceCrypt('', true, true);
			$str_linkConfirmacao = $objConfiguracao->getDiretorioConcateEmail().'/index.php?codSec='.$cont.'&validacaoNewslette='.$this->sequenceCrypt('"validacao"', $cont, true).'&str_email='.$this->sequenceCrypt("'".$this->str_email."'", $cont, true);

			//============================================================================//
			//Paramentros do array para usar essa função 								  //
			//============================================================================//
			$arrayEmail["email_resposta"]	= $this->str_email;
			$arrayEmail["email_destino"] 	= $this->str_emailDestino;
			$arrayEmail["assunto"]       	= 'Olá '.$this->str_nome.', confirme agora seu cadastro para saber tudo sobre as novidades do mundo imobiliário.';
			$arrayEmail["nome_portal"]   	= $objConfiguracao->showTitulo();
			$arrayEmail["email_barra"]	 	= 'MENSSAGEM DO VISITANTE';
			$arrayEmail["data_atual"]    	= $objConfiguracao->retornaDataAtual('Numerico', 'Interface');
			$arrayEmail["email_titulo"]  	= 'O portal '.$objConfiguracao->showTitulo().' não se responsabiliza pelo conteúdo das menssagens enviadas por visitantes do seu imóvel.';
			$arrayEmail["email_titulo_msg"]	= 'Visitante do <a href='.$str_linkConfirmacao.'>imovel</a> escreveu:';
			$arrayEmail["email_msg"]	 	= $this->str_menssagemPro;

			//============================================================================//
			//             ENVIO DE EMAIL PARA INDICAÇÃO DE IMÓVEL		                  //
			//============================================================================//	
			return $this->corpoLayoutEmail($objConexao, $objConfiguracao, $arrayEmail, 'EmailExterno');
			
			

			
			//============================================================================//
			//             ENVIO DE CONFIRMAÇÃO DO CADASTRO DO NEWSLETTERS                //
			//============================================================================//			
			$this->str_menssagem = '
				<html>
				<head>
				<title>'.$objConfiguracao->showTitulo().'</title>
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
					<td width="755" height="121" align="left">'.$objConfiguracao->getDiretorioBanner(TRUE).'</td>
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
							<td width="8" height="25" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/adm_top_Bar_E.gif"></td>
							<td width="300" height="25" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/adm_top_Bar_dgrE.gif"><span style="	font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 18px; color: #FFFFFF; text-decoration: none;">'.$objConfiguracao->showTitulo().'</span></td>
							<td width="27" height="25" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/adm_top_Bar_M.gif"></td>
							<td width="410" height="25" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/adm_top_Bar_dgrD.gif">Olá '.$this->str_nome.', saiba tudo sobre as novidades imobiliárias.</td>
							<td width="8" height="25" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/adm_top_Bar_D.gif"></td>
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
						<td colspan="2" width="8" height="24" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/top_grupoRes_top_01.gif"></td>
						<td width="286" height="24" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/top_grupoRes_top_02.gif"><span style="	font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 18px; color: #FFFFFF; text-decoration: none;">Confirmação de Cadastro</span></td>
						<td width="31" height="24" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/top_grupoRes_top_03.gif"></td>
						<td height="24" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/top_grupoRes_top_04.gif" valign="bottom" align="left"></td>
					  <td width="23" height="24" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/top_grupoRes_top_05.gif"></td>
						<td colspan="2" rowspan="2" height="35" width="225" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/top_grupoRes_top_06.gif"></td>
						<td colspan="2" rowspan="2" height="35" width="8" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/top_grupoRes_top_07.gif"></td>
						<td height="24"></td>
					</tr>
					<tr>
						<td></td>
						<td width="3" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/top_grupoRes_top_08.gif"></td>
						<td colspan="5" height="11" bgcolor="'.$objConfiguracao->getCorFundoGrupo().'"></td>
						<td height="11"></td>
					</tr>
					<tr>
						<td></td>
						<td width="3" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/med_grupoRes_E.gif"></td>
						<td colspan="8"></td>
						<td width="3" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/med_grupoRes_D.gif"></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td width="3" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/med_grupoRes_E.gif"></td>
						<td colspan="8" width="627" valign="top" align="left">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td colspan="3" height="5"></td>
							  </tr>
							  <tr>
								<td width="15"></td>
								<td width="457" height="70" align="left" valign="top"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #000000; text-align: justify; text-decoration: none;">'.$assunto.'</span><br /><br />
								</td>
								<td width="170"></td>
							  </tr>
							  <tr>
								<td></td>
								<td colspan="2" align="left" valign="top"><br />
									<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 18px; color: #525252; vertical-align: bottom; a {text-decoration: none;}"><a href='.$str_linkConfirmacao.'>Clique aqui para Confirmar o seu Cadastro.</a></span><br />
								</td>
							  </tr>
							</table>
						</td>
						<td background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/med_grupoRes_D.gif"></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td colspan="2" width="8" height="15" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/boton_grupoRes_E.gif"></td>
						<td colspan="6" height="15" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/boton_grupoRes_M.gif"></td>
						<td colspan="2" height="15" width="8" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/boton_grupoRes_D.gif"></td>
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
					  <td width="677" height="37" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/bottonBar_info.gif" style="width:678px;"></td>
					  <td width="89" height="37" background="'.$objConfiguracao->getDiretorioConcateEmail().$objConfiguracao->getDirTheme().'/bottonBar_logo_02.jpg"></td>
					</tr>
				</table>
				</DIV>
				</form>
				</body>
				</html>
			';

			$this->str_headers   = "MIME-Version: 1.0\r\n";
			$this->str_headers  .= "Content-Type:text/html;CHARSET=iso-8859-1-i\r\n";
			$this->str_headers  .= "From: parkimovel@parkimovel.com \r\n";
			sleep(1);
			//mail($this->str_email, $assunto, $this->str_menssagem, $this->str_headers);
		}

		//============================================================================//
		//                        GETS Dados NewsletterBoletim                        //
		//============================================================================//
		public function getId_newsLettersBoletim()
		{
			return $this->id_newsLettersBoletim;
		}
		public function getAssunto()
		{
			return $this->str_assunto;
		}
		public function getTitulo()
		{
			return $this->str_titulo;
		}
		public function getDescricao()
		{
			return $this->str_descricao;
		}
		public function getDt_publicacao()
		{
			return $this->dt_publicacao;
		}
		public function getEmailResposta()
		{
			return $this->str_emailResposta;
		}
		
		public function getBln_enviarNewsLetters()
		{
			return $this->bln_enviarNewsLetters;
		}
		
		public function getDiretorioNewsLetters()
		{
			return $this->str_diretorioNewsLetters;
		}			
	
		//============================================================================//
		//                        GETS Dados Usuarios do Newsletter                   //
		//============================================================================//
		public function getArray_id_newsletters($cont)
		{
			return $this->array_id_newsletters[$cont];
		}

		public function getArray_str_nome($cont)
		{
			return $this->array_str_nome[$cont];
		}

		public function getArray_str_email($cont)
		{
			return $this->array_str_email[$cont];
		}

		public function getContadorUsuariosNewsLetter()
		{
			return $this->contadorUsuariosNewsLetter;
		}


	}
?>