// JavaScript Desabilita a borda do documento.
function desabilitaActiveSwf(diretorioDocumento, largura, altura)
{
	document.write("<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=4,0,2,0' width='"+largura+"' height='"+altura+"'>");
	document.write("<param name='movie' value='"+diretorioDocumento+"'>");
	document.write("<param name='quality' value='high'>");
	document.write("<embed src='"+diretorioDocumento+"' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='"+largura+"' height='"+altura+"'></embed>");
	document.write("</object>");
}