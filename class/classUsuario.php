<?php class Usuario extends FuncoesComum
	{
		public function Usuario($objSessao)
		{
			$objSessao->abrirSessao();
		}
		
		public function atribuirViaPost()
		{
			/*Atribuição dos valores as variaveis do usuário
			=====================================================*/
			$this->str_nome 			= $this->anti_injection($this->sequenceCrypt($_POST["str_login"], $_POST["codSec"], false));
			$this->str_senha 			= $this->anti_injection($this->sequenceCrypt($_POST["str_senha"], $_POST["codSec"], false));
		}

		private function atribuirViaPostInterno()
		{
			
			/*Atribuição dos valores as variaveis do usuário
			=====================================================*/
			$this->id_usuario			= $this->sequenceCrypt($_POST["id_usuario"], $_POST["codSecFormulario"], false);
			$this->str_nome 			= $this->anti_injection($this->sequenceCrypt($_POST["str_nome"], $_POST["codSecFormulario"], false));
			$this->str_senha 			= $this->anti_injection($this->sequenceCrypt($_POST["str_senha"], $_POST["codSecFormulario"], false));
			$this->str_email			= $this->anti_injection(strtolower($this->sequenceCrypt($_POST["str_email"], $_POST["codSecFormulario"], false)));
			$this->str_telefone			= $this->sequenceCrypt($_POST["str_telefone"], $_POST["codSecFormulario"], false);
			$this->str_nivelAcesso		= $this->sequenceCrypt($_POST["slc_nivelAcesso"], $_POST["codSecFormulario"], false);
			$this->id_contrato			= $this->str_nivelAcesso=='Gestor'?'':$this->sequenceCrypt($_POST["slc_id_contrato"], $_POST["codSecFormulario"], false);
			$this->str_nomeImobiliaria	= $this->removeLixoDecriptVazio($this->anti_injection($this->sequenceCrypt($_POST["str_nomeimobiliaria"], $_POST["codSecFormulario"], false)));
			
			//controle variáveis disables
			$this->str_DisableContrato = $this->str_nivelAcesso=='Gestor'?'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"':'style="width: 125px;"';

		}
	
		public function inicializaVariaveis()
		{
			$this->id_usuario			= "";
			$this->id_contrato			= "";
			$this->str_nome 			= "";
			$this->str_senha 			= "";
			$this->str_email			= "";
			$this->str_telefone			= "";
			$this->str_nivelAcesso		= "";
			$this->str_nomeImobiliaria	= "";
			
			//controle variáveis disables
			$this->str_DisableContrato = 'style="width: 125px; filter: Alpha(Opacity=100);"';			
		}

		public function atribuirQuery($objConexao, $int_codigo)
		{
			$query = $this->consultaUsuario($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);

			$this->id_usuario			= $this->codifiStringBancoInterface($objConexao,$array["id_usuario"]);
			$this->id_contrato			= $this->codifiStringBancoInterface($objConexao,$array["id_contrato"]);
			$this->str_nome 			= $this->codifiStringBancoInterface($objConexao,$array["str_nome"]);
			$this->str_senha 			= $this->codifiStringBancoInterface($objConexao,$array["str_senha"]);
			$this->str_email			= $this->codifiStringBancoInterface($objConexao,$array["str_email"]);
			$this->str_telefone			= $this->codifiStringBancoInterface($objConexao,$array["str_telefone"]);
			$this->str_nivelAcesso		= $this->codifiStringBancoInterface($objConexao,$array["str_nivelacesso"]);
			$this->str_nomeImobiliaria	= $this->codifiStringBancoInterface($objConexao,$array["str_nomeimobiliaria"]);
			
			//controle variáveis disables
			$this->str_DisableContrato = $this->str_nivelAcesso=='Gestor'?'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"':'style="width: 125px;"';

		}

		public function comboContrato($objConexao)
		{
			$sql = "SELECT id_contrato, str_numerocontrato from msf.contrato order by str_numerocontrato";	
			return	$objConexao->executaSQL($sql);
		}
		
		private function consultaUsuario($objConexao,$int_codigo)	
		{
			$sql = "SELECT id_usuario, id_contrato, str_nome, str_senha, str_email, str_telefone, str_nivelacesso, str_nomeimobiliaria 
					from msf.usuario
					where id_usuario = ".$int_codigo;						

			return	$objConexao->executaSQL($sql);		
		}
		
		private function retornoPlanoContrato($objConexao,$int_codigo)	
		{
			$sql = "SELECT id_plano from msf.contrato where id_contrato =".$int_codigo;
			$array = $objConexao->retornaArray($objConexao->executaSQL($sql));
			return $array['id_plano'];
		}		

		public function verificarUsuarioLogado($objSessao)
		{   
		   if(!$objSessao->getNomeSessao("sessao_str_nome"))
		   {
			   $this->alertMenssage('Proibido o acesso sem Login!');
?>
			 <script>
				window.location='../index.php';
			 </script>
<?php }
		}

		private function alertMenssage($menssagem)
		{
			header("Content-Type: text/html; charset=ISO-8859-1",true);

			$nome_arquivo = basename($_SERVER['SCRIPT_NAME']);
			if (substr($nome_arquivo, 0, 4) == 'adm_')
			{
				$diretorios = '../';
			}else
			{
				$diretorios = '';
			}			
?>
			<style type="text/css">body{margin-left:0px;margin-top:0px;margin-right:0px;margin-bottom:0px;font-size:10px;}</style>
			<link rel="stylesheet" type="text/css" href="<?php echo $diretorios;?>js/css/black-tie/jquery-ui-1.7.1.custom.css">
			<script src  ="<?php echo $diretorios;?>js/jquery-ui/jquery-1.3.2.min.js"	></script> 
			<script src  ="<?php echo $diretorios;?>js/jquery-ui/jquery-ui-1.7.1.js"	></script>
			<script src  ="<?php echo $diretorios;?>js/comuns/alertMenssage.js"			></script>
            <body>
            	<div id="menssagem"  style="display:none;"></div>
            </body>
            <script>
                alertMenssage ('Aviso:','<?php echo $menssagem;?>');
            </script>
<?php }

		private function diretivaSegurancaUsuarioNotifica($objConexao,$objConfiguracao)
		{
			if ($this->nivelAcesso($this->getNivelAcesso())!= 3)
			{
				$this->atribuirViaPostInterno();
				$sql  = "SELECT 
						 US.str_nivelacesso,
						 US.str_email, 
						 US.str_telefone,
						 CO.id_plano,
						 CO.str_numerocontrato, 
						 CO.str_nomeresponsavelcontrato,
						 PL.str_valormensalsistema,
						 now() as notificacao						
						 from msf.usuario 					US 
							 left join msf.contrato 		CO on (US.id_contrato = CO.id_contrato) 
							 left join msf.plano 			PL on (CO.id_plano = PL.id_plano) 
						 where US.str_nome = '".$this->getNomeUsuario()."'";

				$query = $objConexao->executaSQL($sql);
				$array = $objConexao->retornaArray($query);

				$sqlAux  = "SELECT str_numerocontrato, str_valormensalsistema 
							from msf.plano 					PL
								left join msf.contrato 		CO on (PL.id_plano = CO.id_plano)
							where CO.id_contrato = ".$this->id_contrato;		 
				$queryAux = $objConexao->executaSQL($sqlAux);
				$arrayAux = $objConexao->retornaArray($queryAux);
				
				if (($this->nivelAcesso($this->str_nivelAcesso) > $this->nivelAcesso($array["str_nivelacesso"]))||(intval($arrayAux['str_valormensalsistema']) != intval($array['str_valormensalsistema'])))
				{
					$sql = "UPDATE msf.contrato SET bln_contratoativo = FALSE where str_numerocontrato = '".$array["str_numerocontrato"]."'";
					$objConexao->executaSQL($sql);
?>
					<script>
						alertMenssage ('Atenção:','"<?php echo strtoupper($this->getNomeUsuario());?>": <br>O sistema notificou uma tentativa não autorizada de alteração. <br>Esta ação violou a 5ª e 8ª cláusula do contrato de prestação de serviço. <br>As partes envolvidas serão notificadas para medidas judiciais cabíveis.');
						setTimeout("logoffUsuario()",10000);
					</script>
<?php $arrayEmail["email_resposta"]	= $objConfiguracao->getEmailParkimovel();
					$arrayEmail["assunto"]			= 'Notificação do Sistema (Quebra de Contrato).';
					$arrayEmail["nome_portal"] 		= $objConfiguracao->showTitulo();
					$arrayEmail["email_barra"]		= 'ALTERAÇÃO NÃO AUTORIZADA';
					$arrayEmail["data_atual"] 		= $objConfiguracao->retornaDataAtual('Numerico', 'Interface');
					
					$arrayEmail["email_titulo"] 	= 'Ocorreu uma tentativa de altera&ccedil;&atilde;o n&atilde;o autorizada pelo usuario '.$this->getNomeUsuario().' no sistema administrativo.';
					
					$arrayEmail["email_titulo_msg"] = 'O sistema METASOFTWARE notificou o usu&aacute;rio '.$this->getNomeUsuario().' tentando alterar o seu n&iacute;vel de acesso afim de obter  privil&eacute;gios no sistema.<br>Das OBRIGA&Ccedil;&Otilde;ES DO CONTRATANTE '.$array["str_nomeresponsavelcontrato"].' consta no contrato N&deg;.'.$array["str_numerocontrato"].': ';
					
					$arrayEmail["email_msg"] 		= 'Cl&aacute;usula 5&ordf; - N&atilde;o tentar, ou efetivamente quebrar as senhas, invadir os sites alheios ou burlar a seguran&ccedil;a do sistema (METAFOFTWARE) para obter privil&eacute;gios. Neste caso, ocorrer&aacute; o imediato cancelamento da conta, sem preju&iacute;zo das medidas judiciais cab&iacute;veis.<br>Cl&aacute;usula 8&ordf; - Zelar para que suas informa&ccedil;&otilde;es de acesso (nome de usu&aacute;rio e senha) n&atilde;o sejam "hackeadas", quando utilizar locais p&uacute;blicos ou particulares para acessar &agrave; Internet. <br><br><br>HORARIO: '.$array["notificacao"].' <br>IP: '.$_SERVER['REMOTE_ADDR'].'<br>Browser:'.$_SERVER['HTTP_USER_AGENT'];

					//============================================================================//
					//                     RELATÓRIO DE ENVIO DE NOTIFICAÇÃO CONTRATADO           //
					//============================================================================//
					$arrayEmail["email_destino"] 	= $objConfiguracao->getEmailParkimovel();
					$this->corpoLayoutEmail($objConexao, $objConfiguracao, $arrayEmail);
					//============================================================================//
					//                     RELATÓRIO DE ENVIO DE NOTIFICAÇÃO CONTRATANTE          //
					//============================================================================//			
					$arrayEmail["email_destino"] 	= $array["str_email"];
					$this->corpoLayoutEmail($objConexao, $objConfiguracao, $arrayEmail);
					exit();

				}
			}
		}

		public function autenticar($objConexao,$objSessao)
		{
			$this->atribuirViaPost();
			$sql  = "SELECT  str_nome, str_senha, str_nivelacesso
					 from msf.usuario 
					 where str_nome='".$this->str_nome."' and str_senha='".$this->str_senha."'";
			$query = $objConexao->executaSQL($sql);
			
			if($objConexao->contaLinhas($query) > 0)
			{
?>
				<script>
					window.location='adm/adm_principal.php';
				</script>
<?php 
				$array = $objConexao->retornaArray($query);
				$objSessao->setNomeSessao("sessao_str_nome", $this->str_nome);
				$objSessao->setNomeSessao("sessao_str_nivelAcesso", $array["str_nivelacesso"]);
				return true;
			}else
			{
				return false;
			}
		}
	
		function cadastrarUsuario($objConexao)
		{
			$this->atribuirViaPostInterno();
			
			$sql	=  "SELECT  id_usuario from msf.usuario where str_email = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_email)."'";

			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) == 0)
			{
				$intCodigo = $this->atualizadorSequence($objConexao, "usuario", "usuario_id_usuario_seq");
				$sql = "INSERT INTO msf.usuario
						(
							id_usuario,
							id_contrato,
							str_nome,
							str_senha,
							str_email,
							str_telefone,
							str_nivelacesso,
							str_nomeimobiliaria
						) VALUES 
						(
							 *".$intCodigo."*,
							 *".$this->id_contrato."*,
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_nome)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_senha)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_email)."',
							'".$this->str_telefone."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_nivelAcesso)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_nomeImobiliaria)."'
						); ";

				$sql = str_replace(array("''","**"),"null",$sql);
				$sql = str_replace("*","",$sql);
				


				if ($objConexao->executaSQL($sql))
				{
					$this->atribuirQuery($objConexao, $intCodigo);
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
						alertMenssage ('Atenção:','Existe já um usuário com este email. <br>Informe outro email.');
					</script>
<?php return false;	
			}
		}
	
		function alterarUsuario($objConexao,$objConfiguracao)
		{
			$this->atribuirViaPostInterno();

			$sql	=  "SELECT  id_usuario from msf.usuario where id_usuario = ".$this->id_usuario;
			$query 	= $objConexao->executaSQL($sql);
			if ($objConexao->contaLinhas($query) > 0)//Verifica se o usuário ainda existe no banco.
			{
				$sql	=  "SELECT id_usuario from msf.usuario where str_email = '".$this->str_email."' and id_usuario != ".$this->id_usuario;
				$query = $objConexao->executaSQL($sql);
				if ($objConexao->contaLinhas($query) == 0)//Verifica se o usuário esta alterando o email pra algum já existente.
				{
					$this->diretivaSegurancaUsuarioNotifica($objConexao,$objConfiguracao);
					$sql = "UPDATE msf.usuario SET
								id_contrato				= *".$this->id_contrato."*,
								str_nome				= '".$this->codifiStringInterfaceBanco($objConexao, $this->str_nome)."',
								str_senha				= '".$this->codifiStringInterfaceBanco($objConexao, $this->str_senha)."',
								str_email				= '".$this->codifiStringInterfaceBanco($objConexao, $this->str_email)."',
								str_telefone			= '".$this->codifiStringInterfaceBanco($objConexao, $this->str_telefone)."',
								str_nivelacesso			= '".$this->codifiStringInterfaceBanco($objConexao, $this->str_nivelAcesso)."',
								str_nomeimobiliaria		= '".$this->codifiStringInterfaceBanco($objConexao, $this->str_nomeImobiliaria)."'
							where id_usuario = ".$this->id_usuario.";";

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
							alertMenssage ('Aviso:','Já existe um outro usuário com este email. <br>Informe outro email.');
						</script>
<?php return false;	
				}
			}else
			{
?>
					<script>
						alertMenssage ('Atenção:','Este usuário não foi localizado para ser alterado. <br>Selecione outro usuário.');
					</script>
<?php return false;	
			}
		}
		
		function excluirUsuario($objConexao)
		{
			$this->atribuirViaPostInterno();
	
			$sql	= "SELECT id_usuario from msf.usuario where id_usuario = ".$this->id_usuario;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "DELETE FROM msf.usuario where id_usuario = ".$this->id_usuario.";";

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
						alertMenssage ('Atenção:','Este usuário não foi localizado. <br>Selecione outro usuário.');
					</script>
<?php return false;	
			}
		}
	
		public function acessoUsuario($objConexao)
		{
			$this->atribuirViaPost();
			$sql = "SELECT str_nivelacesso from msf.usuario where str_login = '".$this->str_loginLogado."'";
			return $objConexao->retornoSelect($sql);
		}
	
		function sair($objSessao)
		{
			$objSessao->fecharSessao();
		}
		
		//============================================================================//
		//                        GETS Dados Imoveis PaginaInicial                    //
		//============================================================================//
		public function getNomeUsuario()
		{
			return $_SESSION["sessao_str_nome"];
		}

		public function getNivelAcesso()
		{
			return $_SESSION["sessao_str_nivelAcesso"];
		}
	}
?>
