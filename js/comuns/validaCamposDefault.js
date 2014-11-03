	function validaCamposDefault($caracter)
	{
		count = 0;
		
		if($caracter == undefined)
		{
			$caracter = '*';
		}
		var $controle = true;
		while(count < document.frm.length)
		{
			if(document.frm[count].id == $caracter)
			{
				if(document.frm[count].type == "checkbox")
				{
					if(document.frm[count].checked == false)
					{
						alertMenssage ('Atenção:','É preciso preencher a opção '+document.frm[count].title+'.');
						$controle = false;
						return $controle;
					}
				}
				else
				{
					var $string = document.frm[count].value;
					while ($string.indexOf(" ") != -1)
					{
						$string = $string.toString().replace( " ", "" );
					}
					
					if(document.frm[count].value == "" || $string.length==0 )
					{
						if (document.frm[count].disabled != true)
						{
							if (document.frm[count].title == '')
							{
								alertMenssage ('Atenção:','É preciso preencher todos os campos.');
							}if (document.frm[count].title == 'Arquivo')
							{
								alertMenssage ('Atenção:','É preciso informar um arquivo para upload.');
							}else
							{
								alertMenssage ('Atenção:','É preciso preencher o campo '+document.frm[count].title+'.');
							}
							$controle = false;
							return $controle;
						}
					}
				}
			}
			count++;
		}
		if ($controle)
		{
			return true;
		}
	}
