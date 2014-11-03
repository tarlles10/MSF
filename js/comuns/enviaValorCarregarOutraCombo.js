// FUNÇÃO EXTERNA MUDA NA INTERNA DENTRO DO ADM/JS POIS ELA ENVIA O PARAMETRO $iconeAjax PARA FUNÇÃO AJAX.

	function enviaValorCarregarOutraCombo(field, $str_componente, $id_carregamento, $iconeAjax)
	{
		var $arrayNome 	= new Array ('"','','"');
		var $arrayValor = new Array ('',field.value,'');
		$str_field = retornaUrlAjax('', $arrayNome, $arrayValor);
		
		if ($iconeAjax==undefined)
		{
			$iconeAjax = 'formulario';	
		}

		$nomeVariavel = field.name.replace('slc','str');

		$arrayNome 	= new Array ($nomeVariavel);
		$arrayValor = new Array ($str_field);
		carregarPaginacao($id_carregamento, retornaUrlAjax($str_componente, $arrayNome, $arrayValor), 'aguarde...', $iconeAjax);
	}