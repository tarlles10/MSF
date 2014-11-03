	function zeraValorCombos($combo, $str_componente)
	{
		$str_componente = $str_componente.replace("_uf.php","");
		$str_componente = $str_componente.replace("_municipio.php","");
		$str_componente = $str_componente.replace("_bairro.php","");
		switch($combo)
		{
			case 'MUNICIPIO':

				var $arrayNome 	= new Array ('"','','"');
				var $arrayValor = new Array ('','','');
				$id_municipio = retornaUrlAjax('', $arrayNome, $arrayValor);
				
				$arrayNome 	= new Array ($str_componente);
				$arrayValor = new Array ('_municipio.php');
				$str_urlCombo = retornaUrlAjax('', $arrayNome, $arrayValor);
				
				$arrayNome 	= new Array ('id_municipio');
				$arrayValor = new Array ($id_municipio);
				carregarPaginacao('Bairro', retornaUrlAjax($str_urlCombo, $arrayNome, $arrayValor), 'aguarde...', 'formulario');
				
				if (document.getElementById('Logradouro') !=  undefined)
				{
					$arrayNome 	= new Array ('"','','"');
					$arrayValor = new Array ('','','');
					$id_bairro = retornaUrlAjax('', $arrayNome, $arrayValor);
					
					$arrayNome 	= new Array ($str_componente);
					$arrayValor = new Array ('_bairro.php');
					$str_urlCombo = retornaUrlAjax('', $arrayNome, $arrayValor);
					
					$arrayNome 	= new Array ('id_bairro');
					$arrayValor = new Array ($id_bairro);
					carregarPaginacao('Logradouro', retornaUrlAjax($str_urlCombo, $arrayNome, $arrayValor), 'aguarde...', 'formulario');
				}
				break;

			case 'BAIRRO':
				if (document.getElementById('Logradouro') !=  undefined)
				{
					var $arrayNome 	= new Array ('"','','"');
					var $arrayValor = new Array ('','','');
					$id_bairro = retornaUrlAjax('', $arrayNome, $arrayValor);
					
					$arrayNome 	= new Array ($str_componente);
					$arrayValor = new Array ('_bairro.php');
					$str_urlCombo = retornaUrlAjax('', $arrayNome, $arrayValor);
					
					$arrayNome 	= new Array ('id_bairro');
					$arrayValor = new Array ($id_bairro);
					carregarPaginacao('Logradouro', retornaUrlAjax($str_urlCombo, $arrayNome, $arrayValor), 'aguarde...', 'formulario');				
				}
				break;
		}
	}

	function enviaValorUf($str_uf, $str_componente)
	{
		if ($str_uf.value != '')
		{
			var $arrayNome 	= new Array ('"','','"');
			var $arrayValor = new Array ('',$str_uf.value,'');
			$str_uf = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			$arrayNome 	= new Array ('str_uf');
			$arrayValor = new Array ($str_uf);
			carregarPaginacao('Municipio', retornaUrlAjax($str_componente, $arrayNome, $arrayValor), 'aguarde...', 'formulario');
			zeraValorCombos('MUNICIPIO', $str_componente);
		}
	}
	
	function enviaValorMunicipio($id_municipio, $str_componente)
	{
		if ($id_municipio.value != '')
		{
			var $arrayNome 	= new Array ('"','','"');
			var $arrayValor = new Array ('',$id_municipio.value,'');
			$id_municipio = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			$arrayNome 	= new Array ('id_municipio');
			$arrayValor = new Array ($id_municipio);
			carregarPaginacao('Bairro', retornaUrlAjax($str_componente, $arrayNome, $arrayValor), 'aguarde...', 'formulario');
			zeraValorCombos('BAIRRO', $str_componente);
		}
	}
	
	function enviaValorBairro($id_bairro, $str_componente)
	{
		if ($id_bairro.value != '')
		{
			var $arrayNome 	= new Array ('"','','"');
			var $arrayValor = new Array ('',$id_bairro.value,'');
			$id_bairro = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			$arrayNome 	= new Array ('id_bairro');
			$arrayValor = new Array ($id_bairro);
			carregarPaginacao('Logradouro', retornaUrlAjax($str_componente, $arrayNome, $arrayValor), 'aguarde...', 'formulario');
		}
	}
	
	function enviaValorLogradouro($id_logradouro)
	{
		if ($id_logradouro.value != '')
		{
			var $arrayNome 	= new Array ('"','','"');
			var $arrayValor = new Array ('',$id_logradouro.value,'');
			$id_logradouro = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			$arrayNome 	= new Array ('id_logradouro');
			$arrayValor = new Array ($id_logradouro);
			var $nomePagina = sequenceCrypt(document.getElementById('str_nomePagina').value, document.getElementById('codSec').value, false);
			carregarPaginacao('metasoftware', retornaUrlAjax($nomePagina, $arrayNome, $arrayValor), 'Carregando o formulário...');
		}
	}
	
