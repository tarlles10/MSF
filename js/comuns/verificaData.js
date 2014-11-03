
var expressao = /^((0?[1-9]|[12][1-8])\/(0?[1-9]|1[0-2])\/((19|20)?\d{2}))|(29\/(0?[2])\/((19|2[01])([02468][048]|[13579][26])))|([29|30]\/(0?[13-9]|1[0-2])\/((19|20)?\d{2}))|(31\/(0?[13578]|1[02])\/((19|20)?\d{2}))$/;
function verificaData(strDate)
{
	eval("reDate = expressao");
	if (reDate.test(strDate.value)) 
	{
		return true;
	} else if (strDate.value != null && strDate.value != "") 
	{
		alertMenssage ('Aviso:','A data informada é inválida. <br>Selecione uma data no ícone a esquerda do campo ou digite uma data válida.');
		strDate.value = '';
		return false;
	}
}

