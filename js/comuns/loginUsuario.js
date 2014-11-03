	function loginUsuario()
	{
		d = document.frm;
		if (validaCamposDefault('**'))
		{
			var $cont = sequenceCrypt('', true, true);
			var $arrayNome 	= new Array ('','','');
			var $arrayValor = new Array ("'",sequenceCrypt(d.str_login.value, $cont, true), "'");
			$str_login =  retornaUrlAjax('', $arrayNome, $arrayValor);
			
			$arrayNome 	= new Array ('', '', '');
			$arrayValor = new Array ("'", sequenceCrypt(d.str_senha.value, $cont, true), "'");
			$str_senha =  retornaUrlAjax('', $arrayNome, $arrayValor);
			
			$arrayNome 	= new Array ('str_login', 'str_senha', 'codSec');
			$arrayValor = new Array ($str_login, $str_senha, $cont);
			
			
			d.action = '';
			d.submit();
			//sleep(1);
			carregarPaginacao('metasoftware', retornaUrlAjax('autenticacaoUsuario.php', $arrayNome, $arrayValor), 'Autenticando Usuário...');	
		}
	}

	function logoffUsuario()
	{
		var $cont = sequenceCrypt('', true, true);

		$arrayNome 	= new Array ('', '', '');
		$arrayValor = new Array ("'", sequenceCrypt('true', $cont, true), "'");
		$logoff 	=  retornaUrlAjax('', $arrayNome, $arrayValor);

		$arrayNome 	= new Array ('codSec','logoff');
		$arrayValor = new Array ($cont , $logoff);

		carregarPaginacao('metasoftware', retornaUrlAjax('../autenticacaoUsuario.php', $arrayNome, $arrayValor), 'Fazendo Logoff do Usuário...');	
	}
	