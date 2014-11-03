//valida o CNPJ digitado
function validarCNPJ(field) 
{
	CNPJ = field.value;
	erro = new String;
	if (CNPJ.length < 18 && CNPJ.length != 0) erro += "\nE necessario preencher corretamente o numero do CNPJ! \n\n";
	if ((CNPJ.charAt(2) != ".") || (CNPJ.charAt(6) != ".") || (CNPJ.charAt(10) != "/") || (CNPJ.charAt(15) != "-"))
	{
		//if (erro.length == 0) erro += "E necessarios preencher corretamente o numero do CNPJ! \n\n";
	}

	//substituir os caracteres que nao sao numeros
	if(document.layers && parseInt(navigator.appVersion) == 4)
	{
		x = CNPJ.substring(0,2);
		x += CNPJ.substring(3,6);
		x += CNPJ.substring(7,10);
		x += CNPJ.substring(11,15);
		x += CNPJ.substring(16,18);
		CNPJ = x;
	} 
	else 
	{
		CNPJ = CNPJ.replace(".","");
		CNPJ = CNPJ.replace(".","");
		CNPJ = CNPJ.replace("-","");
		CNPJ = CNPJ.replace("/","");
	}
	var nonNumbers = /\D/;
	if (nonNumbers.test(CNPJ)) erro += "A verificacao de CNPJ suporta apenas numeros! \n\n";
	var a = [];
	var b = new Number;
	var c = [6,5,4,3,2,9,8,7,6,5,4,3,2];
	for (i=0; i<12; i++)
	{
		a[i] = CNPJ.charAt(i);
		b += a[i] * c[i+1];
	}
	if ((x = b % 11) < 2) 
	{ 
		a[12] = 0 
	} 
	else 
	{
		a[12] = 11-x 
	}
	b = 0;
	for (y=0; y<13; y++) 
	{
		b += (a[y] * c[y]);
	}
	if ((x = b % 11) < 2) 
	{ 
		a[13] = 0;
	} else 
	{ 
		a[13] = 11-x; 
	}
	if ((CNPJ.charAt(12) != a[12]) || (CNPJ.charAt(13) != a[13]))
	{
		erro +="O Dígito verificador do CNPJ está incorreto!";
	}
	if (field.value == '00.000.000/0000-00')
	{
		erro +="O CNPJ está inválido!";
	}

	if (erro.length > 0)
	{
		alertMenssage ('Atenção',erro);
		field.value = '';
		return false;
	}

	return true;
}
