	function validaFaleConosco($interno)
	{
		d = document.frm;
		if (validaCamposDefault('*') != false)
		{
			if (d.str_nome.value != "" && d.str_nome.value.length < 5)
			{
				alertMenssage ('Atenção:','O Campo Nome deve conter pelo menos 5 caracteres.');
				d.str_nome.focus();
				return false;
			}
			if (d.str_email.value != "" && !validaEmail(d.str_email))
			{
				d.str_email.focus();
				return false;
			}
			if (d.str_mensagem.value != "" && d.str_mensagem.value.length < 10)
			{
				alertMenssage ('Atenção:','O Campo para a mensagem deve conter pelo menos 10 caracteres.');
				d.str_mensagem.focus();
				return false;
			}
			
			var $arrayNome 	= new Array ('','', '');
			var $arrayValor = new Array ("'", d.str_nome.value, "'");
			$str_nome = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			$arrayNome 	= new Array ('','', '');
			$arrayValor = new Array ("'", d.str_email.value, "'");
			$str_email = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			$arrayNome 	= new Array ('','', '');
			$arrayValor = new Array ("'", d.str_mensagem.value, "'");
			$str_mensagem = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			$arrayNome 	= new Array ('enviar', 'str_nome','str_email', 'str_mensagem');
			$arrayValor = new Array (true, $str_nome, $str_email, $str_mensagem);
	
			if ($interno)
			{
				carregarPaginacao('mostrarPortal', retornaUrlAjax('ajaxComponente_Solucoes.php', $arrayNome, $arrayValor), 'Enviando sua Mensagem...');	
			}
			else
			{
				carregarPaginacao('mostrarFaleConosco', retornaUrlAjax('ajaxComponente_FaleConosco.php', $arrayNome, $arrayValor), 'Enviando sua Mensagem...');
			}
			
		}
	}