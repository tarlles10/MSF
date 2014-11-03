//Tenta criar o objeto xmlHTTP
try
{
    xmlhttp = new XMLHttpRequest();
}
catch(ee)
{
    try
	{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
	catch(e)
	{
        try
		{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
		catch(E)
		{
            xmlhttp = false;
        }
    }
}

//Fila de conex�es
fila = [];
ifila = 0;

//Fun��o para executar scripts no retorno do Ajax
function extraiScript(texto)
{
    // inicializa o inicio ><
    var ini = 0;
    // loop enquanto achar um script
    while (ini!=-1)
	{
        // procura uma tag de script
        ini = texto.indexOf('<script', ini);
        // se encontrar
        if (ini >=0)
		{
            // define o inicio para depois do fechamento dessa tag
            ini = texto.indexOf('>', ini) + 1;
            // procura o final do script
            var fim = texto.indexOf('</script>', ini);
            // extrai apenas o script
            codigo = texto.substring(ini,fim);
            // executa o script
            //eval(codigo);
			novo = document.createElement("script");
            novo.text = codigo;
            document.body.appendChild(novo);
        }
    }
}

//Carrega via XMLHTTP a url recebida e coloca seu valor no objeto com o id recebido
function ajax(url, id, metodo, menssagem, MostraIcone, prioridade, atualiza)
{
/*
    Para facilitar a programa��o, as vari�veis m�todo, atualiza e prioridade n�o s�o obrigat�rias.
	
	URL = pagina com as vari�veis que ser�o passadas para a pagina de a��o (mesmo que decida utilizar o 
	m�todo post, estas variav�is devem ser passadas na url);
	
	ID = nome do DIV que dever� receber a pagina de a��o;
	
	METODO = define se as vari�veis devem ser passadas por GET ou POST. Default GET;
	
	PRIORIDADE = se for igual a true, v�rias requisi��es podem ser feitas ao mesmo tempo, se for marcado como false,
	o brownser deve parar de executar qualquer a��o (isso vale para comandos javascript) at� que receba a p�gina 
	de a��o. Default true;
	
	ATUALIZA = Define se o brownser deve carregar a pagina de a��o em todas as solicita��es, ou pode simplesmente 
	utilizar o seu cache se a pagina for solicitada uma segunda vez. True (default) obriga que a p�gina seja 
	carregada sempre, false permite a utiliza��o do cache do brownser.    
*/
	// Tratamento de acentos
	url = encodeURIComponent(url);
	url = url.replace(/%3F/g, '?');
	url = url.replace(/%3D/g, '=');
	url = url.replace(/%26/g, '&');
	url = url.replace(/%2F/g, '/');
	url = url.replace(/%3A/g, ':');
    // define os valores default para as vari�veis que n�o s�o obrigat�rias
    if(metodo == undefined || metodo == '' )
	{
		var metodo = 'POST';
	}

    if(prioridade == undefined)
	{
		var prioridade = true;
	}
    if(atualiza == undefined)
	{
		var atualiza = true;
	}
	if(menssagem == undefined)
	{
		var menssagem = '';
	}
   
    // Caso a p�gina deva ser carrega sempre, ser� inserida uma varivel ramdonica
    if(atualiza == true)
	{
    	var possuiVariavel = url.indexOf('?');
    	if (possuiVariavel == -1)
		{
			// N�o possui nenhuma variavel
    		url = url +'?hora=' + Math.random(); //Essa variavel randomica � necess�ria, pois em alguns brownser o conteudo n�o esta sendo atualizado    		
    	}
		else
		{
			// J� possui alguma variavel
    		url = url +'&hora=' + Math.random(); //Essa variavel randomica � necess�ria, pois em alguns brownser o conteudo n�o esta sendo atualizado
    	}    	
    }
    
    // Se for o metodo POST as variav�is devem ser passadas separadamente
    if(metodo == 'POST')
	{
    	var posicao = url.indexOf('?') + 1;
		var variaveis = url.substring(posicao,url.length);
		url = url.substring(0,posicao-1);
    }
	else
	{
    	var variaveis = 'null';
    }
    
    //Carregando...
	if(MostraIcone == true)
	{
		icone  = '<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="50%" align="center" valign="bottom">';
		icone += '<img src="icons/CarregamentoAjax.gif" height="47" width="47" ></td></tr><tr>';
		icone += '<td height="50%" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #000000; text-align: center; ';
		icone += 'text-decoration: none; align="center" valign="top">'+menssagem+'</td></tr></table>';
	}else if (MostraIcone == false)
	{
		icone  = '<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0"><tr>';
		icone += '<td height="100%" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #000000; text-align: center; ';
		icone += 'text-decoration: none; cursor: pointer;" align="center" valign="top">'+menssagem+'</td></tr></table>';
	
	}else if(MostraIcone == 'formulario')
	{
		icone  = '<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="50%" align="center" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #9c9c9c; text-align: center; text-decoration: none;"><span style="background-color: #e2e2e2;"><img src="icons/CarregamentoAjax2.gif" height="16" width="16" >&nbsp;&nbsp;'+menssagem+'</span></td></tr><tr>';
	}else if(MostraIcone == 'Resultado')
	{
		icone  = '<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="50%" align="center" valign="bottom"><br />';
		icone += '<img src="icons/Adm_CarregamentoResultadoAjax.gif" height="74" width="160" ></td></tr><tr>';
		icone += '<td height="50%" style="font-family: Verdana; font-size: 10px; color: #000000; text-align: center; ';
		icone += 'text-decoration: none; align="center" valign="top">'+menssagem+'</td></tr></table>';
	}

	document.getElementById(id).innerHTML = icone;
    //Adiciona � fila
    fila[fila.length]=[id,url,metodo,prioridade,variaveis];
        
    //Se n�o h� conex�es pendentes, executa
    if((ifila+1) == fila.length)
	{
		ajaxRun();
	}
}

//Executa a pr�xima conex�o da fila
function ajaxRun()
{

	//fila[ifila][0] = DIV
	//fila[ifila][1] = URL 
	//fila[ifila][2] = METODO - GET or POST
	//fila[ifila][3] = MOSTRA ICONE

    //Abre a conex�o
    xmlhttp.open(fila[ifila][2],fila[ifila][1],fila[ifila][3]);
    if(fila[ifila][2] == 'POST'){
		xmlhttp.setRequestHeader('encoding','ISO-8859-1');
		xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=ISO-8859-1');
    }   
    //Fun��o para tratamento do retorno
    xmlhttp.onreadystatechange=function() 
	{
        if (xmlhttp.readyState==4)
		{
			if (xmlhttp.status == 200) // resposta do servidor OK
			{
				//Mostra o HTML recebido
				retorno=unescape(xmlhttp.responseText.replace(/\+/g," "));
				document.getElementById(fila[ifila][0]).innerHTML = retorno;
				//Executa os scripts
				extraiScript(retorno);
				//Roda o pr�ximo
				ifila++;
				if(ifila < fila.length) 
				{
					setTimeout("ajaxRun()",20)
				}				
			}
			else		
			{
				ajax('adm_ajaxComponente_Erro.php', fila[ifila][0], fila[ifila][2], "<div  style=\"cursor: pointer;\" onclick=\"window.location='adm_principal.php'\" title=\"Clique para tentar carregar novamente\">Ops ...</div>", fila[ifila][3]);
				//Roda o pr�ximo
				ifila++;
				if(ifila < fila.length) 
				{
					setTimeout("ajaxRun()",20)
				}				
			}
        }
    }
    //Executa
    xmlhttp.send(fila[ifila][4]);
}