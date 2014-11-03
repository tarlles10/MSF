	function retornoValorRadioButon($nomeRdb)
	{
		d = document.frm;

		var $arrayNome 	= new Array ('$cont = d.','','.length -1;');
		var $arrayValor = new Array ('',$nomeRdb,'');

		var $cont;
		var $valorRdb;
		
		eval(retornaUrlAjax('', $arrayNome, $arrayValor));
		while ($cont > -1)
		{
			$arrayNome 	= new Array ('$valorRdb = d.','','[','','].checked.toString().toUpperCase();');
			$arrayValor = new Array ('',$nomeRdb,'',$cont,'');
			eval(retornaUrlAjax('', $arrayNome, $arrayValor));

			if($valorRdb == 'TRUE')
			{
				$arrayNome 	= new Array ('$valorRdb = d.','','[','','].value;');
				$arrayValor = new Array ('',$nomeRdb,'',$cont,'');
				eval(retornaUrlAjax('', $arrayNome, $arrayValor));
				return $valorRdb;
				break;
			}
			$cont --;
		}
	}
