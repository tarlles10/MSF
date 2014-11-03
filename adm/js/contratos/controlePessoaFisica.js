	function controlePessoFisica(field)
	{
		d = document.frm;
		if (field.checked.toString().toUpperCase() == 'TRUE')
		{
			d.str_cnpj.style.filter = 'Alpha(Opacity=25)';
			d.str_cnpj.disabled 	= 'disabled';
			d.str_cnpj.value		= ''
			
			d.str_cpf.style.filter 	= 'Alpha(Opacity=100)';
			d.str_cpf.disabled 		= '';
		}
		else if (field.checked.toString().toUpperCase() == 'FALSE')
		{
			d.str_cnpj.style.filter = 'Alpha(Opacity=100)';
			d.str_cnpj.disabled 	= '';
			
			d.str_cpf.style.filter 	= 'Alpha(Opacity=25)';
			d.str_cpf.disabled 		= 'disabled';
			d.str_cpf.value			= ''
		}
	}