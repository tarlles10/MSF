		//============================================================================//
		//              Exibir Tela de help para Tutorial do Google Talk.             //
		//============================================================================//
/*
INCLUIR CODIGO PAGINA PRINCIPAL
<div id="help"><div id="conteudoHelp" style="z-index:100; display: none; width: 538px; height: 660px;"></div></div>
<iframe id='helpIframe' style="z-index:50; display: none; position:absolute; margin-top:-5px; margin-left:-35px; top:5%; left:35%; width: 538px; height: 660px; filter: Alpha(Opacity=0, FinishOpacity=0, Style=0, StartX=0, FinishX=0, StartY=0, FinishY=0);" scrolling="no" frameborder="0"></iframe>
*/

	function apresentaHelpGoogleTalk($abrijanela)
	{
		if ($abrijanela)
		{
			carregarPaginacao('conteudoHelp', 'adm_ajaxComponente_helpGoogleTalk.php', '', false);
			document.getElementById('conteudoHelp').style.display	= '';
			document.getElementById('helpIframe').style.display	= '';
			realizaSubmit('http://www.google.com/talk/service/badge/New','_blank');
			//Biblioteco GreyBox
			//GB_showCenter('Parkimovel', 'http://www.google.com/talk/service/badge/New');
		}else
		{
			document.getElementById('conteudoHelp').style.display	= 'none';
			document.getElementById('helpIframe').style.display		= 'none';	
		}
	}