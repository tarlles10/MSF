	function controlePeriodoNegocio(field)
	{
		d = document.frm;
		if (field.value == 'Temporada')
		{
			d.slc_subTipoNegocio.value = 'Diaria';
			d.slc_subTipoNegocio.style.filter = 'Alpha(Opacity=100)';
			d.slc_subTipoNegocio.disabled = '';
			d.slc_subTipoNegocio.id = '*';

		}else if (field.value == 'Aluguel')
		{
			d.slc_subTipoNegocio.value = 'Mensal';
			d.slc_subTipoNegocio.style.filter = 'Alpha(Opacity=100)';
			d.slc_subTipoNegocio.disabled = '';
			d.slc_subTipoNegocio.id = '*';
		}else if (field.value == 'Venda')
		{
			d.slc_subTipoNegocio.value = '';
			d.slc_subTipoNegocio.style.filter = 'Alpha(Opacity=25)';
			d.slc_subTipoNegocio.disabled = 'disabled';
			d.slc_subTipoNegocio.id = 'slc_subTipoNegocio';			
		}
	}