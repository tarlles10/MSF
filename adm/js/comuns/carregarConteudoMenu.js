	function carregarConteudoMenu($int_paginacao, $slc_totalRegistrosTela, $slc_ordenacao, $link, $cont, $int_codigo)
	{
		var $arrayNome 	= new Array ();
		var $arrayValor = new Array ();

		if ($int_paginacao == undefined)
		{
			var $int_paginacao = d.int_paginacao.value;
		}
		if ($slc_totalRegistrosTela == undefined)
		{
			//Concatena a string do totaldeRegistros
			$arrayNome 	= new Array ('"','', '"');
			$arrayValor = new Array ('',document.getElementById('slc_totalRegistrosTela').value,'');
			var $slc_totalRegistrosTela = retornaUrlAjax('', $arrayNome, $arrayValor);
		}
		if ($slc_ordenacao == undefined)
		{
			//Concatena a string da Ordenacao
			$arrayNome 	= new Array ('"','', '"');
			$arrayValor = new Array ('',document.getElementById('slc_ordenacao').value,'');
			var $valorOrdenacao = retornaUrlAjax('', $arrayNome, $arrayValor);
		}

		var $nomePagina = sequenceCrypt($link, $cont, false);
		document.getElementById('str_nomePagina').value = $link;
		document.getElementById('codSec').value = $cont;
		carregarPaginacao('metasoftware', $nomePagina, 'Carregando o formulário...');

		$arrayNome 	= new Array ('"','', '"');
		$arrayValor = new Array ('',$nomePagina,'');
		$nomePagina = retornaUrlAjax('', $arrayNome, $arrayValor);

		if ($int_codigo == undefined || $int_codigo == '')
		{
			$arrayNome 	= new Array ('int_paginacao','slc_totalRegistrosTela', 'slc_ordenacao', 'nomePagina');
			$arrayValor = new Array ($int_paginacao, $slc_totalRegistrosTela, $valorOrdenacao, $nomePagina);
			carregarPaginacao('ResultadoAdministrativo', retornaUrlAjax('adm_ajaxComponenteResultados.php', $arrayNome, $arrayValor), 'Carregando os Resultados...', 'Resultado');
		}else
		{
			$arrayNome 	= new Array ('"','', '"');
			$arrayValor = new Array ('',$int_codigo,'');
			$int_codigo = retornaUrlAjax('', $arrayNome, $arrayValor);
			$arrayNome 	= new Array ('int_paginacao','slc_totalRegistrosTela', 'slc_ordenacao', 'nomePagina', 'int_cod');
			$arrayValor = new Array ($int_paginacao, $slc_totalRegistrosTela, $valorOrdenacao, $nomePagina, $int_codigo);
			carregarPaginacao('ResultadoAdministrativo', retornaUrlAjax('adm_ajaxComponenteResultadosIntCodigo.php', $arrayNome, $arrayValor), 'Carregando os Resultados...', 'Resultado');
		}
	}
	
	function carregarConteudoMenuExterno($int_paginacao, $slc_totalRegistrosTela, $slc_ordenacao, $link, $cont, $int_codigo)
	{
		var $arrayNome 	= new Array ();
		var $arrayValor = new Array ();

		if ($int_paginacao == undefined)
		{
			var $int_paginacao = d.int_paginacao.value;
		}
		if ($slc_totalRegistrosTela == undefined)
		{
			//Concatena a string do totaldeRegistros
			$arrayNome 	= new Array ('"','', '"');
			$arrayValor = new Array ('',document.getElementById('slc_totalRegistrosTela').value,'');
			var $slc_totalRegistrosTela = retornaUrlAjax('', $arrayNome, $arrayValor);
		}
		if ($slc_ordenacao == undefined)
		{
			//Concatena a string da Ordenacao
			$arrayNome 	= new Array ('"','', '"');
			$arrayValor = new Array ('',document.getElementById('slc_ordenacao').value,'');
			var $valorOrdenacao = retornaUrlAjax('', $arrayNome, $arrayValor);
		}

		var $nomePagina = sequenceCrypt($link, $cont, false);

		$arrayNome 	= new Array ('"','', '"');
		$arrayValor = new Array ('',$nomePagina,'');
		$nomePagina = retornaUrlAjax('', $arrayNome, $arrayValor);

		if ($int_codigo == undefined || $int_codigo == '')
		{
			$arrayNome 	= new Array ('int_paginacao','slc_totalRegistrosTela', 'slc_ordenacao', 'nomePagina');
			$arrayValor = new Array ($int_paginacao, $slc_totalRegistrosTela, $valorOrdenacao, $nomePagina);
			carregarPaginacao('grupoBase', retornaUrlAjax('ajaxComponenteResultados.php', $arrayNome, $arrayValor), 'Carregando Resultado da Busca...', 'Resultado');
		}else
		{
			$arrayNome 	= new Array ('"','', '"');
			$arrayValor = new Array ('',$int_codigo,'');
			$int_codigo = retornaUrlAjax('', $arrayNome, $arrayValor);
			$arrayNome 	= new Array ('int_paginacao','slc_totalRegistrosTela', 'slc_ordenacao', 'nomePagina', 'int_cod');
			$arrayValor = new Array ($int_paginacao, $slc_totalRegistrosTela, $valorOrdenacao, $nomePagina, $int_codigo);
			carregarPaginacao('grupoBase', retornaUrlAjax('ajaxComponenteResultadosIntCodigo.php', $arrayNome, $arrayValor), 'Carregando Resultado da Busca...', 'Resultado');
		}
	}	