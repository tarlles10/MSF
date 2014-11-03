	function retornaNumeros(e, field)
	{
		
		var evt = window.event || e;
		var key = evt.keyCode || evt.which;
		var valorkey =  parseInt(key);
		//alert(key + " = " + String.fromCharCode(key));
		if (key == 8)
		{
			field.value = '';
		}else
		{
			if(valorkey < 48  || valorkey > 57)
			{
				return false;
			}else
			{
				return true;
			}
		}
	}