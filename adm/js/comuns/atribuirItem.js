		//============================================================================//
		//              Mantem os dados dos Formulários do Administrativo.            //
		//============================================================================//
		
	function atribuirItem($str_nome, $str_valor, $acaoPagina)
	{
		if ($acaoPagina == undefined)
		{
			if($str_nome == undefined && $str_valor == undefined)
			{
				var $nomePagina = sequenceCrypt(document.getElementById('str_nomePagina').value, document.getElementById('codSec').value, false);
				carregarPaginacao('metasoftware', $nomePagina, 'Carregando o formulário...');
			}else
			{
				var $arrayNome 	= new Array ($str_nome);
				var $arrayValor = new Array ($str_valor);
				var $nomePagina = sequenceCrypt(document.getElementById('str_nomePagina').value, document.getElementById('codSec').value, false);
				carregarPaginacao('metasoftware', retornaUrlAjax($nomePagina, $arrayNome, $arrayValor), 'Carregando o formulário...');
			}
		}else
		{
			var $arrayNome 	= $str_nome;
			var $arrayValor = $str_valor;
			
			var $nomePagina = sequenceCrypt(document.getElementById('str_nomePagina').value, document.getElementById('codSec').value, false);
			carregarPaginacao('metasoftware', retornaUrlAjax($nomePagina, $arrayNome, $arrayValor), 'Carregando o formulário...');
		}
	}



	function atribuirItemExterno($str_nome, $str_valor, $acaoPagina)
	{
		var $arrayNome 	= $str_nome;
		var $arrayValor = $str_valor;
		var $nomePagina = sequenceCrypt(document.getElementById('str_nomePagina').value, document.getElementById('codSec').value, false);
		carregarPaginacao('grupoBase', retornaUrlAjax($nomePagina, $arrayNome, $arrayValor), 'Carregando Resultado da Busca...', 'Resultado');
	}	