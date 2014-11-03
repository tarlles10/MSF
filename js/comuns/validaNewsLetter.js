	function validaNewsLetter()
	{
		d = document.frm;
		if (validaCamposDefault('*')!=false && validaCampoEmail(d.str_email)!=false)
		{
			var $arrayNome 	= new Array ('','', '');
			var $arrayValor = new Array ("'", d.str_nome.value, "'");
			$str_nome = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			$arrayValor = new Array ("'", d.str_email.value, "'");
			$str_email = retornaUrlAjax('', $arrayNome, $arrayValor);

			$arrayNome 	= new Array ('cod','str_nome','str_email');
			$arrayValor = new Array (true, $str_nome, $str_email);
			carregarPaginacao('formularioNewsLetter', retornaUrlAjax('ajaxComponente_NewsLetters.php', $arrayNome, $arrayValor), 'Cadastrando...', false);
		}
	}

	function validaIndiqueAmigo()
	{
		d = document.frm;
		if (validaCamposDefault('##')!=false && validaCampoEmail(d.str_emailInd)!=false)
		{
			var $arrayNome 	= new Array ('','', '');
			var $arrayValor = new Array ("'", d.str_nomeInd.value, "'");
			$str_nome = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			$arrayValor = new Array ("'", d.str_emailInd.value, "'");
			$str_email = retornaUrlAjax('', $arrayNome, $arrayValor);

			$arrayValor = new Array ("'", d.id_imovelInd.value, "'");
			$id_imovel = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			$arrayValor = new Array ("'", d.id_imagemInd.value, "'");
			$id_imagem = retornaUrlAjax('', $arrayNome, $arrayValor);			

			$arrayNome 	= new Array ('cod','str_nomeInd','str_emailInd','id_imovelInd','id_imagemInd');
			$arrayValor = new Array (true, $str_nome, $str_email, $id_imovel, $id_imagem);
			carregarPaginacao('divIndiqueAmigo', retornaUrlAjax('ajaxComponente_IndiqueAmigo.php', $arrayNome, $arrayValor), '<div style="background-color:#FFFFFF; border: 1px solid #7f9db9;">Enviando...</div>', false);
		}
	}

	function validaEmailProprietario()
	{
		d = document.frm;
		if (validaCamposDefault('@@')!=false && validaCampoEmail(d.str_emailPro)!=false && validaCampoEmail( d.str_emailProprietario)!=false)
		{
			var $arrayNome 	= new Array ('','', '');
			var $arrayValor = new Array ("'", d.str_emailPro.value, "'");
			$str_email = retornaUrlAjax('', $arrayNome, $arrayValor);

			var $arrayNome 	= new Array ('','', '');
			var $arrayValor = new Array ("'", d.str_emailProprietario.value, "'");
			$emailPro = retornaUrlAjax('', $arrayNome, $arrayValor);

			$arrayValor = new Array ("'", d.str_menssagemPro.value, "'");
			$str_menssagem = retornaUrlAjax('', $arrayNome, $arrayValor);

			$arrayValor = new Array ("'", d.id_imovelPro.value, "'");
			$id_imovel = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			$arrayValor = new Array ("'", d.id_imagemPro.value, "'");
			$id_imagem = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			$arrayNome 	= new Array ('cod','str_emailPro', 'str_emailProprietario','str_menssagemPro', 'id_imovelPro', 'id_imagemPro');
			$arrayValor = new Array (true, $str_email, $emailPro, $str_menssagem, $id_imovel, $id_imagem);

			carregarPaginacao('divEmailProprietario', retornaUrlAjax('ajaxComponente_EmailProprietario.php', $arrayNome, $arrayValor), '<div style="background-color:#FFFFFF; border: 1px solid #7f9db9;">Enviando...</div>', false);
		}
	}