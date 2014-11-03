	function gerenciaValorKeydown(e, field)
	{
		var evt = window.event || e;
		var tecla = evt.keyCode || evt.which;		

		count = 0;
		teclasPermitidas = [];
		teclasPermitidas[0] = 8;
		teclasPermitidas[1] = 9;
		teclasPermitidas[2] = 35;
		teclasPermitidas[3] = 36;
		teclasPermitidas[4] = 37;
		teclasPermitidas[5] = 39;
		teclasPermitidas[6] = 46;				

		if((tecla >= 48 && tecla <= 57) || (tecla >= 96 && tecla <= 105))
		{
			return true;
		}
		else
		{			
			while(count < teclasPermitidas.length)
			{
				if(tecla == teclasPermitidas[count])
				{
					return true;
				}
				count++;
			}
			
			return false;
		}
	}