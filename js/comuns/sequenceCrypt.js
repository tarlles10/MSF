	function sequenceCrypt($string, $cont, $bln_sifraDesifra)
	{
		var whichQuote = get_random();
		var quote = new Array(5);
		quote[0] = 2;
		quote[1] = 4;
		quote[2] = 6;
		quote[3] = 8;   
		quote[4] = 10;  
   		
		if ($cont == true && $string == '')
		{
			return quote[whichQuote];
		}else 
		{
			var $senha = $string;
			for ($i=($cont-1); $i >= 0; $i--)
			{
				
				if ($bln_sifraDesifra==true)
				{
					if ($i%2==0)
					{
						$senha = encodeHex($senha);
					}else
					{
						$senha = encodeBase64($senha);
					}
				}else
				{
					if ($i%2==0)
					{
						$senha = decodeBase64($senha);
					}else
					{
						$senha = decodeHex($senha);
					}			
				}
			}
			return $senha;
		}
	}
	
	function get_random()
	{
		var ranNum= Math.floor(Math.random() * 5);
		return ranNum;
	}
	