
// construindo o calendário
function popdate(obj,div,tam,ddd, diretorio)
{	
	if (diretorio == 'adm')
	{
		diretorioD = '';
	}
	else 
	{
		diretorioD = 'adm/';
	}
	
	if (ddd) 
    {
        day = ""
        mmonth = ""
        ano = ""
        c = 1
        char = ""
        for (s=0; s < parseInt(ddd.length); s++)
        {
            char = ddd.substr(s,1)
            if (char == "/") 
            {
                c++; 
                s++; 
                char = ddd.substr(s,1);
            }
            if (c==1) 
			{
				day    += char;
			}
            if (c==2) 
			{
				mmonth += char;
			}
            if (c==3) 
			{
				ano    += char;
			}
        }
		
        ddd = mmonth + "/" + day + "/" + ano;
    }
  
    if(!ddd) 
	{
		today = new Date();
	} 
	else 
	{
		today = new Date(ddd);
	}

	date_Form = eval (obj);

	if (date_Form.value == "") 
	{ 
		date_Form = new Date();
	} else 
	{
		date_Form = new Date(date_Form.value)
	}
  
    ano = today.getFullYear();
	mmonth = today.getMonth ();
	day = today.toString ().substr (8,2);
    umonth = new Array ("Janeiro", "Fevereiro", "Mar&ccedil;o", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro")
    days_Feb = (!(ano % 4) ? 29 : 28)
    days = new Array (31, days_Feb, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31)

    if ((mmonth < 0) || (mmonth > 11))
	{
		alertMenssage ('Aviso:',mmonth);
	}
    if ((mmonth - 1) == -1) 
	{
		month_prior = 11; 
		year_prior = ano - 1
	} else 
	{
		month_prior = mmonth - 1; 
		year_prior = ano
	}
    if ((mmonth + 1) == 12) 
	{
		month_next  = 0;  
		year_next  = ano + 1
	} else 
	{
		month_next  = mmonth + 1; 
		year_next  = ano
	}

	txt = "<table bgcolor='#eeeeee' style='border:solid #999999; border-width:2' cellspacing='0' cellpadding='3' border='0' width='"+tam+"' height='"+tam*1.1 +"'>";
    txt += "<tr bgcolor='#FFFFFF'><td colspan='7' align='center'><table border='0' cellpadding='0' width='100%' bgcolor='#FFFFFF'><tr>";
    txt += "<td width=20% align=center><a href=javascript:popdate('"+obj+"','"+div+"','"+tam+"','"+((mmonth+1).toString() +"/01/"+(ano-1).toString())+"','"+diretorio+"') title='Ano Anterior'><img src='"+diretorioD+"icons/calendario/icon_em.png' border='0'/></a></td>";
    txt += "<td width=20% align=center><a href=javascript:popdate('"+obj+"','"+div+"','"+tam+"','"+( "01/" + (month_prior+1).toString() + "/" + year_prior.toString())+"','"+diretorio+"')  title='M&ecirc;s Anterior'><img src='"+diretorioD+"icons/calendario/icon_e.png' border='0'/></a></td>";
    txt += "<td width=20% align=center><a href=javascript:popdate('"+obj+"','"+div+"','"+tam+"','"+( "01/" + (month_next+1).toString()  + "/" + year_next.toString())+"','"+diretorio+"')  title='Pr&oacute;ximo M&ecirc;s'><img src='"+diretorioD+"icons/calendario/icon_d.png' border='0'/></a></td>";
    txt += "<td width=20% align=center><a href=javascript:popdate('"+obj+"','"+div+"','"+tam+"','"+((mmonth+1).toString() +"/01/"+(ano+1).toString())+"','"+diretorio+"')  title='Pr&oacute;ximo Ano'><img src='"+diretorioD+"icons/calendario/icon_dm.png' border='0'/></a></td>";
    txt += "<td width=20% align=right><a href=javascript:force_close('"+div+"') title='Fechar Calend&aacute;rio'><img src='"+diretorioD+"icons/calendario/icon_fechar.png' border='0'/></a></td></tr></table></td></tr>";
    txt += "<tr><td colspan='7' align='right' bgcolor='#eeeeee' class='mes' style='background-image:url("+diretorioD+"icons/calendario/degradeMes.jpg);'><a title='Selecionar ano' href=javascript:pop_year('"+obj+"','"+div+"','"+tam+"','" + (mmonth+1) + "','"+diretorio+"') class='mes' style='background-image:url("+diretorioD+"icons/calendario/degradeMes.jpg);'>" + ano.toString() + "</a>";
    txt += " <a title='Selecionar m&ecirc;s' href=javascript:pop_month('"+obj+"','"+div+"','"+tam+"','" + ano + "','"+diretorio+"') class='mes' style='background-image:url("+diretorioD+"icons/calendario/degradeMes.jpg);'>" + umonth[mmonth] + "</a> <div id='popd' style='position:absolute'></div></td></tr>";
    txt += "<tr bgcolor='#999999'><td width='14%' class='dia' align=center>Dom</td><td width='14%' class='dia' align=center>Seg</td><td width='14%' class='dia' align=center>Ter</td><td width='14%' class='dia' align=center>Qua</td><td width='14%' class='dia' align=center>Qui</td><td width='14%' class='dia' align=center>Sex</td><td width='14%' class='dia' align=center>Sab</td></tr>";
    today1 = new Date((mmonth+1).toString() +"/01/"+ano.toString());
    diainicio = today1.getDay () + 1;
    week = d = 1
    start = false;
    for (n=1;n<= 42;n++) 
    {
        if (week == 1) 
		{
			txt += "<tr bgcolor='#ffffff' align=center>"
		}
        if (week==diainicio) 
		{
			start = true
		}
        if (d > days[mmonth]) 
		{
			start=false
		}
        if (start) 
        {
			if (d < 10) 
			{
				d = '0' + d
			}
			if (mmonth + 1 < 10) 
			{
				inc = '0' 
			}
			else
			{
				inc = ''
			}

			dat = new Date((mmonth+1).toString() + "/" + d + "/" + ano.toString())

			day_dat   = dat.toString().substr(0,10)
			day_today  = date_Form.toString().substr(0,10)
            year_dat  = dat.getFullYear ()
            year_today = date_Form.getFullYear ()
            colorcell = ((day_dat == day_today) && (year_dat == year_today) ? " bgcolor='#bdff4b' " : "" )
            txt += "<td"+colorcell+" align=center onMouseOver=\"this.style.background='#dfffa7';\" onMouseOut=\"this.style.background='#ffffff';\"><a href=javascript:block('"+  d + "/" + inc + (mmonth+1).toString() + "/" + ano.toString() +"','"+ obj +"','" + div +"') class='data'>"+ d.toString() + "</a></td>"
            d ++ 
        } 
        else 
        { 
            txt += "<td class='data' align=center> </td>"
        }
        week ++
        if (week == 8) 
        { 
            week = 1; txt += "</tr>"} 
        }
        txt += "</table>"
        div2 = eval (div)
        div2.innerHTML = txt 
}
  
// função para exibir a janela com os meses
function pop_month(obj, div, tam, ano, diretorio)
{
	txt  = "<table bgcolor='#6e6e6e' border='0' width=80>"
	for (n = 0; n < 12; n++) 
	{
		txt += "<tr class='data' ><td align=left onMouseOver=\"this.style.background='#b5d323';\" onMouseOut=\"this.style.background='';\"><a href=javascript:popdate('"+obj+"','"+div+"','"+tam+"','"+("01/" + (n+1).toString() + "/" + ano.toString())+"','"+diretorio+"')>" + umonth[n] +"</a></td></tr>" 
	}
  	txt += "</table>"
  	popd.innerHTML = txt
}

// função para exibir a janela com os anos
function pop_year(obj, div, tam, umonth, diretorio)
{
	txt  = "<table bgcolor='#6e6e6e' border='0' width=160>"
  	l = 1
	for (n=1991; n<2012; n++)
	{
		if (l == 1) 
		{
			txt += "<tr>"
		}
		txt += "<td align=center class='data' onMouseOver=\"this.style.background='#b5d323';\" onMouseOut=\"this.style.background='';\"><a href=javascript:popdate('"+obj+"','"+div+"','"+tam+"','"+(umonth.toString () +"/01/" + n) +"','"+diretorio+"')>" + n + "</a></td>"
		l++
     	if (l == 4) 
        {
			txt += "</tr>"; l = 1 
		} 
  }
  txt += "</tr></table>"
  popd.innerHTML = txt 
}

// função para fechar o calendário
function force_close(div) 
{
	div2 = eval (div); div2.innerHTML = ''
}
    
// função para fechar o calendário e setar a data no campo de data associado
function block(data, obj, div)
{ 
    force_close (div)
    obj2 = eval(obj)
    obj2.value = data 
}