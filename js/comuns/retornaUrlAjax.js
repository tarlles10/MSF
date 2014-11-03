	function basename(path, suffix) 
	{ 
		path = path.replace(/ /g, '/');
		path = path.replace(/^.*[/\\]/g, '');

		if (typeof(suffix) == 'string' && path.substr(-suffix.length) == suffix) 
		{
			path = path.substr(0, path.length-suffix.length);
		}
		return path;
	}
	
	function retornaUrlAjax($url, $arrayNome, $arrayValor)
	{
		//concatena Strings como variaveis com os respectivos valores
		if ($url != '')
		{
			for ($cont=0; $cont < $arrayNome.length; $cont++)
			{
				$arrayNome[$cont] = basename($arrayNome[$cont], '');
				if ($cont == 0)
				{
					$url += '?';
				}else
				{
					$url += '&';
				}

				if ($arrayValor[$cont] == undefined)
				{
					eval('var $'+$arrayNome[$cont]+'= document.frm.'+$arrayNome[$cont]+'.value');
				}else
				{
					eval('var $'+$arrayNome[$cont]+'='+$arrayValor[$cont]);
				}
	
				$url += $arrayNome[$cont]+'='+eval('$'+$arrayNome[$cont]);
			}
		//concatena qualquer string
		}else
		{
			for ($cont=0; $cont < $arrayNome.length; $cont++)
			{
				if ($arrayValor[$cont] != undefined)
				{
					$url += $arrayNome[$cont]+$arrayValor[$cont];
				}
			}
		}
		return $url;
	}