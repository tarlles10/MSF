	function controleObrigatoriedade(field, $bln_bannerMedio, $bln_bannerCurto, $bln_bannerBaixo)
	{
		f = document;
		if (field.value == 'Banner Medio Largo' && $bln_bannerMedio == 'true')
		{
			f.getElementById('str_dtFinalBanner').id = '*';
		}else if (field.value == 'Banner Medio Curto' && $bln_bannerCurto == 'true')
		{
			f.getElementById('str_dtFinalBanner').id = '*';
		}else if (field.value == 'Banner Baixo' && $bln_bannerBaixo == 'true')
		{
			f.getElementById('str_dtFinalBanner').id = '*';
		}else
		{
			f.getElementById('str_dtFinalBanner').id = '';
		}
	}