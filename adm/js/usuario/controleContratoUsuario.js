	function controleContratoUsuario(field)
	{
		d = document.frm;
		if (field.value == 'Gestor')
		{
			d.slc_id_contrato.style.filter = 'Alpha(Opacity=25)';
			d.slc_id_contrato.disabled = 'disabled';
			d.slc_id_contrato.id = '';	
		}else
		{
			d.slc_id_contrato.style.filter = 'Alpha(Opacity=100)';
			d.slc_id_contrato.disabled = '';
			d.slc_id_contrato.id = '*';
		}
	}