function validaEmail(field)
{
	var mask = /^[\w-]+(\.[\w-]+)*@(([A-Za-z\d][A-Za-z\d-]{0,61}[A-Za-z\d]\.)+[A-Za-z]{2,6}|\[\d{1,3}(\.\d{1,3}){3}\])$/;
	var str_email = field.value;
	
	if (mask.test(str_email)) 
	{
		return true;		
	} 
	else if (str_email != null && str_email != "") 
	{
		alertMenssage ('Aten��o:','Esse e-mail n�o � um endere�o v�lido.');
		field.focus();
		return false;		
	}
} 