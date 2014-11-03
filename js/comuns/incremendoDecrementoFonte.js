// JavaScript Aumenta e Diminui o tamanho das Fontes.
	function tamanhoFonte(id)
	{
		d = document.frm;
		document.getElementById(id).style.fontSize = d.tamanhoTexto.value;
	}

	function incrementaFonte(id)
	{
		d = document.frm;
		if (Number(d.tamanhoTexto.value) < 22)
		{
			d.tamanhoTexto.value =  Number(d.tamanhoTexto.value) + 1;
			tamanhoFonte(id);
		}
	}

	function decrementaFonte(id)
	{
		d = document.frm;
		if (Number(d.tamanhoTexto.value) > 4)
		{
			d.tamanhoTexto.value = Number(d.tamanhoTexto.value) - 1;
			tamanhoFonte(id);
		}
	}