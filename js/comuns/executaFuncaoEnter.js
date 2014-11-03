	function executaFuncaoEnter(e, $string)
	{
		var characterCode
	
		if(e && e.which)
		{ //if which property of event object is supported (NN4)
			e = e;
			characterCode = e.which; //character code is contained in NN4's which property
		}else
		{
			e = event;
			characterCode = e.keyCode; //character code is contained in IE's keyCode property
		}
	
		if(characterCode == 13)
		{
			eval($string);
		}
		else
		{
			return true
		}

	}