<?php 
	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");
	include('class/bibliotecaImages/class.asido.php');

	//###################################################################
	//#                 Busca nome da imagem no Banco                   #
	//###################################################################

	$localBanner = 'Banner Medio Curto';
	
	$objConfiguracao->atribuirBanner($objConexao, $localBanner);
	$imagemJpg 		= getcwd()."/".$objConfiguracao->getDiretorioBanner();
	$imagemPng 		= getcwd()."/".$objConfiguracao->getDirMolde().$objConfiguracao->getDiretorioMolde();
	$imagemNova 	= getcwd()."/banners/".substr(md5(mktime()), 0, 7).".jpg"; 
	$imagemTexto	= getcwd()."/banners/".substr(md5(mktime()), 0, 7).".png";

	$imagem = imagecreate($objConfiguracao->getInt_largura(),$objConfiguracao->getInt_altura());

	//fundo transparente
	imagecolorallocatealpha($imagem, 255, 255, 255, 127);

	$string 	= $objConfiguracao->getTituloBanner();
	$cor 		= imagecolorallocate($imagem, 65,166,234);
	$fonte 		= "ariblk.ttf";
	$int_fonte 	= 15;	
	
	$posLargura = $objConfiguracao->getInt_largura() - $objConfiguracao->getInt_posicaoGX();
	$posAltura 	= $objConfiguracao->getInt_altura() - $objConfiguracao->getInt_posicaoGY();
	
	$objConfiguracao->escreverTextoGrandeImagem($imagem, $int_fonte, $posLargura, $posAltura, $cor, $string, $fonte);

	//###################################################################
	//#                 ESCREVER TEXTO PEQUENO                          #
	//###################################################################
	//cor do texto
	$cinza 		= imagecolorallocate($imagem, 108, 126, 130);
	//tamanho da fonte
	$int_fonte 	= 3;
	$posLargura = $objConfiguracao->getInt_largura() - $objConfiguracao->getInt_posicaoX();
	$posAltura 	= $objConfiguracao->getInt_altura() - $objConfiguracao->getInt_posicaoY();
	
	//Escrevendo fonte pequena cinza
	
	$imagem = $objConfiguracao->escreverTextoPequenoImagem($imagem, $int_fonte, $posLargura, $posAltura, $cinza, $objConfiguracao->getChamadaBanner(), 43, 3);	

	imagepng($imagem, $imagemTexto);	
	imagedestroy($imagem);


/*					

					asido::Crop($imagem, 0, 0, $objConfiguracao->getInt_largura(), $objConfiguracao->getInt_altura());
					
					Asido::width($imagem, $objConfiguracao->getInt_largura());
					
					Asido::height($imagem, $objConfiguracao->getInt_altura());
					
					Asido::resize($imagem, $objConfiguracao->getInt_largura(), $objConfiguracao->getInt_altura(), ASIDO_RESIZE_STRETCH);
					
					Asido::Fit($imagem, $objConfiguracao->getInt_largura(),$objConfiguracao->getInt_altura());
*/

	asido::driver('gd');

	//###################################################################
	//#               Seleciona o fundo a uma nova imagem               #
	//###################################################################
	$i1 = asido::image($imagemJpg, $imagemNova);
	
	//###################################################################
	//#                    Redimensiona a Imagem                        #
	//###################################################################
	//Asido::resize($i1, $objConfiguracao->getInt_largura(), $objConfiguracao->getInt_altura(), ASIDO_RESIZE_STRETCH);

	//###################################################################
	//#                        Corta a Imagem                           #
	//###################################################################
	asido::Crop($i1, 0, 0, $objConfiguracao->getInt_largura(), $objConfiguracao->getInt_altura());
	
	//###################################################################
	//#               Mescla a imagem a um PNG transparente             #
	//###################################################################
	//asido::watermark($i1, $imagemPng, ASIDO_WATERMARK_BOTTOM_RIGHT, ASIDO_WATERMARK_SCALABLE_ENABLED);
	asido::watermark($i1, $imagemPng, ASIDO_WATERMARK_CENTER, ASIDO_WATERMARK_SCALABLE_DISABLED);
	asido::watermark($i1, $imagemTexto, ASIDO_WATERMARK_CENTER, ASIDO_WATERMARK_SCALABLE_DISABLED);
	
	$i1->save(ASIDO_OVERWRITE_ENABLED);
	unlink($imagemTexto);
?>