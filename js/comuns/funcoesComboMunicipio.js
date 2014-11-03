// FUNÇÃO EXTERNA MUDA NA INTERNA DENTRO DO ADM/JS POIS ELA ENVIA O PARAMETRO $iconeAjax PARA FUNÇÃO AJAX.
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
	
	function enviaValorUf($str_uf, $str_componente, $iconeAjax)
	{
		if ($str_uf.value != '')
		{	
			var $arrayNome 	= new Array ('"','','"');
			var $arrayValor = new Array ('',$str_uf.value,'');
			$str_uf = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			$arrayNome 	= new Array ('str_uf');
			$arrayValor = new Array ($str_uf);
			carregarPaginacao('Municipio', retornaUrlAjax($str_componente, $arrayNome, $arrayValor), 'aguarde...', $iconeAjax);
			zeraValorCombos('MUNICIPIO', $str_componente);
		}
	}

	function enviaValorMunicipio($id_municipio, $str_componente, $iconeAjax)
	{
		if ($id_municipio.value != '')
		{
			var $arrayNome 	= new Array ('"','','"');
			var $arrayValor = new Array ('',$id_municipio.value,'');
			$id_municipio = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			$arrayNome 	= new Array ('id_municipio');
			$arrayValor = new Array ($id_municipio);
			carregarPaginacao('Bairro', retornaUrlAjax($str_componente, $arrayNome, $arrayValor), 'aguarde...', $iconeAjax);
			zeraValorCombos('BAIRRO', $str_componente);
		}
	}
	
	function enviaValorBairro($id_bairro, $str_componente, $iconeAjax)
	{
		if ($id_bairro.value != '')
		{
			var $arrayNome 	= new Array ('"','','"');
			var $arrayValor = new Array ('',$id_bairro.value,'');
			$id_bairro = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			$arrayNome 	= new Array ('id_bairro');
			$arrayValor = new Array ($id_bairro);
			carregarPaginacao('Logradouro', retornaUrlAjax($str_componente, $arrayNome, $arrayValor), 'aguarde...', $iconeAjax);
		}
	}	