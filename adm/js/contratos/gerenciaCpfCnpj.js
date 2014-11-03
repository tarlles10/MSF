	function gerenciaCpf(e, field)
	{
		//346.574.887-59
		if(gerenciaValorKeydown(e, field) ==  true)
		{
			formataMascara('###.###.###-##', field);
			return true;
		}
		else
		{
			return false;		
		}
	}

	function gerenciaCnpj(e, field)
	{
		//76.974.143/0001-66
		if(gerenciaValorKeydown(e, field) ==  true)
		{
			formataMascara('##.###.###/####-##', field);
			return true;
		}
		else
		{
			return false;		
		}
	}