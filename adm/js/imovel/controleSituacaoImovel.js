	function controleSituacaoImovel(field)
	{
		d = document.frm;
		if (field.value == 'Lançamento' || field.value == 'Na Planta')
		{
			d.str_dtEntrega.value = '';
			d.str_dtEntrega.style.filter = 'Alpha(Opacity=100)';
			d.str_dtEntrega.disabled = '';
			d.str_dtEntrega.id = '*';
		}else 
		{
			d.str_dtEntrega.style.filter = 'Alpha(Opacity=25)';
			d.str_dtEntrega.disabled = 'disabled';
			d.str_dtEntrega.id = 'str_dtEntrega';	
		}
	}