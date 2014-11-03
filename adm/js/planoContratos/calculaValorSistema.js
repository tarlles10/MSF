	function calculaValorSistema($str_campo)
	{
		d = document.frm;

		campoPacoteSistemaAux 	= d.str_valorPacoteSistemaAux.value;
		campoPacoteMensalAux	= d.str_valorMensalSistemaAux.value;
		campoPacoteSistema 	= d.str_valorPacoteSistema.value;
		campoPacoteMensal	= d.str_valorMensalSistema.value;		

		while (campoPacoteSistema.indexOf('.') != -1)
		{
			campoPacoteSistema = campoPacoteSistema.toString().replace('.','');
		}
		while (campoPacoteMensal.indexOf('.') != -1)
		{
			campoPacoteMensal = campoPacoteMensal.toString().replace('.','');
		}
		while (campoPacoteSistemaAux.indexOf('.') != -1)
		{
			campoPacoteSistemaAux = campoPacoteSistemaAux.toString().replace('.','');
		}
		while (campoPacoteMensalAux.indexOf('.') != -1)
		{
			campoPacoteMensalAux = campoPacoteMensalAux.toString().replace('.','');
		}
		
		campoPacoteSistema = campoPacoteSistema.replace(',', '');
		campoPacoteSistema = parseInt(campoPacoteSistema);

		campoPacoteMensal = campoPacoteMensal.replace(',', '');
		campoPacoteMensal = parseInt(campoPacoteMensal);

		campoPacoteSistemaAux = campoPacoteSistemaAux.replace(',', '');
		campoPacoteSistemaAux = parseInt(campoPacoteSistemaAux);

		campoPacoteMensalAux = campoPacoteMensalAux.replace(',', '');
		campoPacoteMensalAux = parseInt(campoPacoteMensalAux);

		if (d.str_valorPacoteSistemaAux.value == 0 || d.str_valorPacoteSistemaAux.value == '')
		{
			campoPacoteSistemaAux = 200000
		}
		if (d.str_valorMensalSistemaAux.value == 0 || d.str_valorMensalSistemaAux.value == '')
		{
			campoPacoteMensalAux = 20000
		}
		if (d.str_valorPacoteSistema.value == 0 || d.str_valorPacoteSistema.value == '')
		{
			campoPacoteSistema = 200000
		}
		if (d.str_valorMensalSistema.value == 0 || d.str_valorMensalSistema.value == '')
		{
			campoPacoteMensal = 20000
		}

		if ($str_campo.type == 'radio')
		{
			if ($str_campo.value == 'FALSE')
			{
				campoPacoteSistema 	= campoPacoteSistema - 11100;
				campoPacoteMensal	= campoPacoteMensal - 1100;

				campoPacoteSistemaAux 	= campoPacoteSistemaAux - 11100;
				campoPacoteMensalAux	= campoPacoteMensalAux - 1100;
			}else if ($str_campo.value == 'TRUE')
			{
				
				campoPacoteSistema = campoPacoteSistema + 11100;
				campoPacoteMensal	= campoPacoteMensal + 1100;

				campoPacoteSistemaAux = campoPacoteSistemaAux + 11100;
				campoPacoteMensalAux	= campoPacoteMensalAux + 1100;
			}
		}else if ($str_campo.type == 'select-one')
		{
			if (eval('d.'+$str_campo.name+'Aux.value > $str_campo.value'))
			{
				eval('$cont = d.'+$str_campo.name+'Aux.value')
				for ($cont; $cont > $str_campo.value; $cont--)
				{
					campoPacoteSistema 	= campoPacoteSistema - 11100;
					campoPacoteMensal	= campoPacoteMensal - 1100;

					campoPacoteSistemaAux 	= campoPacoteSistemaAux - 11100;
					campoPacoteMensalAux	= campoPacoteMensalAux - 1100;					
				}
			}else if (eval('d.'+$str_campo.name+'Aux.value < $str_campo.value'))
			{
				eval('$cont = d.'+$str_campo.name+'Aux.value')
				for ($cont; $cont < $str_campo.value; $cont++)
				{
					campoPacoteSistema 	= campoPacoteSistema + 11100;
					campoPacoteMensal	= campoPacoteMensal + 1100;

					campoPacoteSistemaAux 	= campoPacoteSistemaAux + 11100;
					campoPacoteMensalAux	= campoPacoteMensalAux + 1100;					
				}
			}
		}
		
		if (document.getElementById('chk_pacoteDiluido').checked == false && document.getElementById('chk_pacoteDiluidoAux').value == 'true')
		{
			campoPacoteSistemaAux = d.str_valorPacoteSistema.value;
			campoPacoteMensalAux  = d.str_valorMensalSistema.value;			
		}
		if (document.getElementById('chk_pacoteDiluido').checked == true)
		{
			campoPacoteMensalAux 	= campoPacoteMensal + parseInt(campoPacoteSistema/12);
			campoPacoteSistemaAux 	= 0;
		}
			//$naoMudaCampo = true;

		d.str_valorPacoteSistemaAux.value = campoPacoteSistemaAux;
		d.str_valorMensalSistemaAux.value = campoPacoteMensalAux;
		formataValorDinheiroSemTecla(d.str_valorPacoteSistemaAux);
		formataValorDinheiroSemTecla(d.str_valorMensalSistemaAux);

		d.str_valorPacoteSistema.value = campoPacoteSistema;
		d.str_valorMensalSistema.value = campoPacoteMensal;
		formataValorDinheiroSemTecla(d.str_valorPacoteSistema);
		formataValorDinheiroSemTecla(d.str_valorMensalSistema);
	}