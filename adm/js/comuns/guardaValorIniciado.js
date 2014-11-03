	function guardaValorIniciado($str_campo)
	{
		d=document.frm;
		
		if ($str_campo.type == 'checkbox')
		{
			$string = 'd.'+$str_campo.name+'Aux.value = $str_campo.checked';		
		}else
		{
			$string = 'd.'+$str_campo.name+'Aux.value = $str_campo.value';		
		}
		eval($string)
	}	