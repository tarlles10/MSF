	function menuConcatenacaoStringsParametro($link, $cont)
	{
			var $arrayNome 	= new Array ('"','', '"');
			var $arrayValor = new Array ('',document.getElementById('slc_totalRegistrosTela').value,'');
			var $slc_totalRegistrosTela = retornaUrlAjax('', $arrayNome, $arrayValor);

			$arrayValor = new Array ('',document.getElementById('slc_ordenacao').value,'');
			var $slc_ordenacao = retornaUrlAjax('', $arrayNome, $arrayValor);

			carregarConteudoMenu(1, $slc_totalRegistrosTela, $slc_ordenacao, $link, $cont);	
	}
	
	function carregaProximoAnterior($link, $cont, $bln_proxAnt, $nome_campo, $int_codigo)
	{
			var $arrayNome 	= new Array ('"','', '"');
			var $arrayValor = new Array ('',document.getElementById('slc_totalRegistrosTela').value,'');
			var $slc_totalRegistrosTela = retornaUrlAjax('', $arrayNome, $arrayValor);

			$arrayValor = new Array ('',document.getElementById('slc_ordenacao').value,'');
			var $slc_ordenacao = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			if ($bln_proxAnt)
			{
				document.getElementById($nome_campo).value = $int_codigo;
				carregarConteudoMenu(1, $slc_totalRegistrosTela, $slc_ordenacao, $link, $cont, $int_codigo);	
			}else
			{
				document.getElementById($nome_campo).value = '';
				carregarConteudoMenu(1, $slc_totalRegistrosTela, $slc_ordenacao, $link, $cont);
			}
			
			
	}	