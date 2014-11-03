function carregar(div, url, messagem, mostraIcone, cod) 
{

	if(mostraIcone == undefined)
	{
		var mostraIcone = true;
	}
	if(cod == undefined)
	{
		var cod = '';
	}else
	{
		cod = '?cod='+cod;
	}

	ajax(url+cod, div,'GET', messagem, mostraIcone);
}

function carregarPaginacao(div, url, messagem, mostraIcone) 
{
	document.getElementById(div).style.display	= '';
	if(mostraIcone == undefined)
	{
		var mostraIcone = true;
	}
	ajax(url, div,'POST', messagem, mostraIcone);
}

function fechar(div)
{
	document.getElementById(div).style.display	= 'none';
	document.getElementById(div).style.width	= '0px';
	document.getElementById(div).style.height	= '0px';
}
