	function controleFlash(field , $concorrente)
	{
		d = document.frm;
		f = document;
		var $bln_phpOcultaForm;
		var $bln_phpMostraForm;

		if (field.type == 'checkbox')
		{
			eval('$bln_phpOcultaForm = (field.checked.toString().toUpperCase() == "TRUE")');
			eval('$bln_phpMostraForm = (field.checked.toString().toUpperCase() == "FALSE" && f.getElementById($concorrente).value != "Banner Topo")');
		}else if (field.type == 'select-one')
		{
			eval('$bln_phpOcultaForm = (field.value == "Banner Topo")');
			eval('$bln_phpMostraForm = (field.value != "Banner Topo") && f.getElementById($concorrente).checked == false');
		}
		if ($bln_phpOcultaForm)
		{
			d.str_tituloBanner.style.filter 				 = 'Alpha(Opacity=25)';
			d.str_tituloBanner.disabled  					 = 'disabled';
			d.str_tituloBanner.value 						 = '';

			d.str_chamadaBanner.style.filter 				 = 'Alpha(Opacity=25)';
			d.str_chamadaBanner.disabled					 = 'disabled';
			d.str_chamadaBanner.value 						 = '';

			d.str_url.style.filter 				 			= 'Alpha(Opacity=25)';
			d.str_url.disabled  					 		= 'disabled';
			d.str_url.value 						 		= '';

			d.str_conteudoBanner.style.filter 	 			= 'Alpha(Opacity=25)';
			d.str_conteudoBanner.disabled  			 		= 'disabled';
			d.str_conteudoBanner.value 				 		= '';

			if (navigator.appName == 'Microsoft Internet Explorer')
			{
				f.getElementById('TabelaEditor1').disabled	 	= 'disabled';
				f.getElementById('TabelaEditor1').style.display = 'none';			

				f.getElementById('TabelaEditor3').disabled	 	= 'disabled';
				f.getElementById('TabelaEditor3').style.display = 'none';
			}
			
			f.getElementById('chk_molde').style.filter 		 = 'Alpha(Opacity=25)';
			f.getElementById('chk_molde').disabled	 		 = 'disabled';
			f.getElementById('chk_molde').checked			 = true;

			if (f.getElementById('slc_id_moldes') != null)
			{
				f.getElementById('slc_id_moldes').style.filter 	 = 'Alpha(Opacity=25)';
				f.getElementById('slc_id_moldes').disabled	 	 = 'disabled';
			}

			f.getElementById('slc_localJanela').style.filter = 'Alpha(Opacity=25)';
			f.getElementById('slc_localJanela').disabled	 = 'disabled';
		}
		else if ($bln_phpMostraForm)
		{
			d.str_tituloBanner.style.filter 				 = 'Alpha(Opacity=100)';
			d.str_tituloBanner.disabled  					 = '';

			d.str_chamadaBanner.style.filter 				 = 'Alpha(Opacity=100)';
			d.str_chamadaBanner.disabled					 = '';

			d.str_url.style.filter 				 			= 'Alpha(Opacity=100)';
			d.str_url.disabled  					 		= '';

			d.str_conteudoBanner.style.filter 	 			= 'Alpha(Opacity=100)';
			d.str_conteudoBanner.disabled  			 		= '';

			if (navigator.appName == 'Microsoft Internet Explorer')
			{
				f.getElementById('TabelaEditor1').disabled	 	= '';
				f.getElementById('TabelaEditor1').style.display = '';

				f.getElementById('TabelaEditor3').disabled	 	= '';
				f.getElementById('TabelaEditor3').style.display = '';
			}

			f.getElementById('chk_molde').style.filter 		 = 'Alpha(Opacity=100)';
			f.getElementById('chk_molde').disabled	 		 = '';
			f.getElementById('chk_molde').checked			 = false;
			
			if (f.getElementById('slc_id_moldes') != null)
			{
				f.getElementById('slc_id_moldes').style.filter 	 = 'Alpha(Opacity=25)';
				f.getElementById('slc_id_moldes').disabled	 	 = 'disabled';
			}

			f.getElementById('slc_localJanela').style.filter = 'Alpha(Opacity=100)';
			f.getElementById('slc_localJanela').disabled	 = '';
		}
	}

	function controleRssExterno(field)
	{
		d = document.frm;
		f = document;

		if (field.checked.toString().toUpperCase() == "TRUE")
		{
			d.str_titulo.style.filter 				= 'Alpha(Opacity=25)';
			d.str_titulo.disabled  					= 'disabled';
			d.str_titulo.value 						= '';

			d.str_copyright.style.filter 			= 'Alpha(Opacity=25)';
			d.str_copyright.disabled				= 'disabled';
			d.str_copyright.value 					= '';

			d.str_descricao.style.filter 			= 'Alpha(Opacity=25)';
			d.str_descricao.disabled  				= 'disabled';
			d.str_descricao.value 					= '';

			d.str_linkExterno.style.filter 	 		= 'Alpha(Opacity=100)';
			d.str_linkExterno.disabled  			= '';
			
			if (d.id_rss.value=='')
			{
				f.getElementById('btn_botaoP').disabled	= 'disabled';
				f.getElementById('btn_botaoP').style.display= 'none';
			}

			if (navigator.appName == 'Microsoft Internet Explorer')
			{
				f.getElementById('TabelaEditor1').disabled	 	= 'disabled';
				f.getElementById('TabelaEditor1').style.display = 'none';			

				f.getElementById('TabelaEditor3').disabled	 	= 'disabled';
				f.getElementById('TabelaEditor3').style.display = 'none';
			}
		}
		else
		{
			d.str_titulo.style.filter 				= 'Alpha(Opacity=100)';
			d.str_titulo.disabled  					= '';

			d.str_copyright.style.filter 			= 'Alpha(Opacity=100)';
			d.str_copyright.disabled				= '';

			d.str_descricao.style.filter 			= 'Alpha(Opacity=100)';
			d.str_descricao.disabled  				= '';

			d.str_linkExterno.style.filter 			= 'Alpha(Opacity=25)';
			d.str_linkExterno.disabled  			= 'disabled';
			d.str_linkExterno.value 				= '';
	
			if (navigator.appName == 'Microsoft Internet Explorer')
			{
				f.getElementById('TabelaEditor1').disabled	 	= '';
				f.getElementById('TabelaEditor1').style.display = '';

				f.getElementById('TabelaEditor3').disabled	 	= '';
				f.getElementById('TabelaEditor3').style.display = '';
			}
		}
	}