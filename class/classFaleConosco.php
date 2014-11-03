<?php class faleConosco extends FuncoesComum 
	{
		private function atribuirViaPostFaleConosco()
		{
			$this->str_nome 		= ucfirst($this->anti_injection($_POST["str_nome"]));
			$this->str_email		= strtolower(trim($this->anti_injection($_POST["str_email"])));
			$this->str_mensagem 	= ucfirst($this->anti_injection($_POST["str_mensagem"]));
		}

		function enviarFaleConosco($objConexao, $objConfiguracao, $contatoInterno)
		{
			$this->atribuirViaPostFaleConosco();
			
			//============================================================================//
			//                     RELATÓRIO DE ENVIO DE NEWSLETTERS                      //
			//============================================================================//			
			
			$this->str_headers   = "MIME-Version: 1.0\r\n";
			$this->str_headers  .= "Content-Type:text/html;CHARSET=iso-8859-1-i\r\n";
			$this->str_headers  .= "From: ".$this->str_email." \r\n";
			
			if ($contatoInterno)
			{
				$str_origem = 'SOLUÇÕES';
			}
			else
			{
				$str_origem = 'FALE CONOSCO';
			}

			$arrayEmail["email_resposta"]	= $objConfiguracao->getEmailParkimovel();
			$arrayEmail["assunto"]			= 'MENSAGEM ENVIADA POR '.strtoupper($this->str_nome).', EM '.$str_origem.'.';
			$arrayEmail["nome_portal"] 		= $objConfiguracao->showTitulo();
			$arrayEmail["email_barra"]		= 'MENSAGEM DO '.$str_origem;
			$arrayEmail["data_atual"] 		= $objConfiguracao->retornaDataAtual('Numerico', 'Interface');
			
			$arrayEmail["email_titulo"] 	= 'Voc&ecirc; recebeu uma mensagem do visitante '.$this->str_nome.' na sess&atilde;o '.$str_origem.' do seu Portal.';
			
			$arrayEmail["email_titulo_msg"] = 'Mensagem:';
			
			$arrayEmail["email_msg"] 		= '<p>'.$this->str_mensagem.'</p><br><br>';

			//============================================================================//
			//                     			RELATÓRIO DE ENVIO					          //
			//============================================================================//
			$arrayEmail["email_destino"] 	= $objConfiguracao->getEmailParkimovel();

			if ($this->corpoLayoutEmail($objConexao, $objConfiguracao, $arrayEmail, 'EmailExterno'))
			{
?>
				<script>
					alertMenssage ('Aviso:','Obrigado pela sua mensagem.');
				</script>
<?php }else
			{
?>
				<script>
					alertMenssage ('Atenção:','Sua mensagem não pode ser enviada. <br>Tente novamente mais tarde.');
				</script>
<?php }

		}
	}
?>