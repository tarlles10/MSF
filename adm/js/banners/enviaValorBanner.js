
	function enviaValorBanner($str_localBanner, $bln_flash,  $bln_molde)
	{
		$bln_flash = document.getElementById($bln_flash).checked.toString().toUpperCase();
		$bln_molde = document.getElementById($bln_molde).checked.toString().toUpperCase();		
		if ($str_localBanner.value != '')
		{
			var $arrayNome 	= new Array ('"','','"');
			var $arrayValor = new Array ('',$str_localBanner.value,'');
			$str_localBanner = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			var $arrayValor = new Array ('',$bln_flash,'');
			$bln_flash = retornaUrlAjax('', $arrayNome, $arrayValor);
			
			var $arrayValor = new Array ('',$bln_molde,'');
			$bln_molde = retornaUrlAjax('', $arrayNome, $arrayValor);

			$arrayNome 	= new Array ('slc_localBanner', 'comboFlash', 'comboMolde');
			$arrayValor = new Array ($str_localBanner, $bln_flash, $bln_molde);
			carregarPaginacao('Moldes', retornaUrlAjax('adm_ajaxComponente_banners_comboFlash.php', $arrayNome, $arrayValor), 'aguarde...', 'formulario');
		}
	}
	
	function disableArrayCampoOponente(field, $ArrayCampoOponente)
	{
		d = document.frm;
		var $AlphaCondicao;
		
		for ($cont=0; $cont < $ArrayCampoOponente.length; $cont++)
		{
			if(field.checked.toString().toUpperCase() == 'FALSE')
			{
				eval ('$AlphaCondicao = (d.'+$ArrayCampoOponente[$cont]+'.style.filter == "Alpha(Opacity=25)");');
				
				eval('d.'+$ArrayCampoOponente[$cont]+'.style.filter = "Alpha(Opacity=25)";');
				eval('d.'+$ArrayCampoOponente[$cont]+'.disabled = "disabled";');
			}else
			{
				eval('d.'+$ArrayCampoOponente[$cont]+'.style.filter = "Alpha(Opacity=100)";');
				eval('d.'+$ArrayCampoOponente[$cont]+'.disabled = "";');
			}
		}
	}
