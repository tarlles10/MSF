	window.onLoad = initialize();
	
	function initialize()
	{
		statusField = "liberado";
		codName = "";
	}
	
	function validaNomeProprio(field)
	{
		if(statusField == "liberado" || codName == field.title)
		{
			statusField = "usando";
			codName = field.title;	
			
			if(field.value.length < 5 && field.value != "")
			{
				alertMenssage ('Aviso:','O Campo '+field.title+' deve conter pelo menos 5 caracteres.');
				field.value = '';
				field.focus();
				return false;
			}
	
			statusField = "liberado";
		}	
	}

	function validaCampoCpf(field)
	{
		if(statusField == "liberado" || codName == "Cpf")
		{
			statusField = "usando";
			codName = "Cpf";	
	
			if(!validarCPF(field) && field.value != "")
			{
				field.value = '';
				field.focus();
				return false;
			}
	
			statusField = "liberado";
		}
	}

	function validaCampoCnpj(field)
	{
		if(statusField == "liberado" || codName == "Cnpj")
		{
			statusField = "usando";
			codName = "Cnpj";	
	
			if(!validarCNPJ(field) && field.value != "")
			{
				field.value = '';
				field.focus();
				return false;
			}
	
			statusField = "liberado";
		}
	}

	function validaCampoEmail(field)
	{
		if(statusField == "liberado" || codName == "Email")
		{
			statusField = "usando";
			codName = "Email";	
	
			if(!validaEmail(field) && field.value != "")
			{
				field.value = '';
				field.focus();
				return false;
			}
			statusField = "liberado";
		}
	}

	function validaCampoTelefone(field)
	{
		if(statusField == "liberado" || codName == "Telefone")
		{
			statusField = "usando";
			codName = "Telefone";

			if (field.value != "")
			{
				if(field.value.length < 12 || (field.value.search(" ") == -1 || field.value.search('-')== -1))
				{
					alertMenssage ('Aviso','O Campo telefone deve conter pelo menos 10 números. \nInforme o telefone no formato 66 6666-6666.');
					field.value = '';
					return false;
				}
			}
			statusField = "liberado";
		}	
	}

	function validaCampoDiaVencimento(field)
	{
		$valorCampo = field.value;
		if(statusField == "liberado" || codName == "Final Vigência")
		{
			statusField = "usando";
			codName = "Final Vigência";	
			
			if((parseInt($valorCampo) > 31 || parseInt($valorCampo) == 0) && field.value != "")
			{
				alertMenssage ('Aviso:','O dia do vencimento e inválido.');
				field.value = '';
				return false;
			}
			statusField = "liberado";
		}	
	}
