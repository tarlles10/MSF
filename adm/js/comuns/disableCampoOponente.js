	function disableCampoOponente(field, $campoOponente)
	{
		if(field.checked.toString().toUpperCase() == 'FALSE')
		{
			if (document.getElementById($campoOponente) == undefined)
			{
				eval('document.frm.'+$campoOponente+'.style.filter = "Alpha(Opacity=25)"');
				eval('document.frm.'+$campoOponente+'.disabled = "disabled"');
			}else
			{
				document.getElementById($campoOponente).style.filter = 'Alpha(Opacity=25)';
				document.getElementById($campoOponente).disabled 	 = 'disabled';
			}
		}else
		{
			if (document.getElementById($campoOponente) == undefined)
			{
				eval('document.frm.'+$campoOponente+'.style.filter = "Alpha(Opacity=100)"');
				eval('document.frm.'+$campoOponente+'.disabled = ""');
			}else
			{
				document.getElementById($campoOponente).style.filter = 'Alpha(Opacity=100)';
				document.getElementById($campoOponente).disabled 	 = '';
			}
		}
	}