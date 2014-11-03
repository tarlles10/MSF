<?php //informe no array a lista de arquivos e diretorios que deverao serem ignorados
	//$list_ignore = array ('.','..','images','adm','crackwindowsxp.rar');
	//Abre o diretorio raiz
	$handle= @opendir(".");
	
	// abre ou cria o arquivo xml
	$xml = fopen("sitemap.xml","w+");
	
	//Gravamos os dados iniciais do xml
	fwrite($xml,"<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">");
	
	//Geramos o lopping com os dados do nó XML
	while ($file = readdir($handle)) 
	{
		if (@is_file($file)) 
		{
			// Abrindo Tag Inicio da URL
			$conteudo = '<url>';
			
			//	Pega o Dominio e o nome do arquivo URL, ex.. '/what-is-new.htm?page=17&itemsPerPage=10'
			$conteudo .= '<loc>http://'.$_SERVER['HTTP_HOST'].'/'.$file.'</loc>';
			
			//	Pega a data atual e informa no xml ex. '2005-07-25 12:13:41'
			$conteudo .= '<lastmod>'.date('Y-m-d').'</lastmod>';
			
			//===================================================================================================== //	
			//	Informa a frequencia de atualização da pagina														//
			//===================================================================================================== //
			//	'always'  - Conteúdo da página muda significativamente com cada página. 							//
			//	'hourly'																							//
			//	'daily'																								//
			//	'weekly'																							//
			//	'monthly'																							//
			//	'yearly'																							//
			//	'never'   - Arquivados páginas que não são alteradas mais alguma, documentos PDF e tal.				//
			//===================================================================================================== //
			$conteudo .= '<changefreq>weekly</changefreq>';
			
			//===================================================================================================== //	
			//	Informa a prioridade da pagina																		//
			//===================================================================================================== //
			//	0.0 - 1.0																							//
			//===================================================================================================== //			
			$conteudo .= '<priority>0.1</priority>';
			
			// Fechando Tag Inicio da URL
			$conteudo .= '</url>';
			
			fwrite($xml,$conteudo);
		}
	}
	closedir($handle);
	
	//	Fechamos a estrutura do xml
	fwrite($xml,"\n</urlset>");
	
	//	Fecha o arquivo aberto (para liberar memoria do servidor)
	fclose($xml);
	
	echo "sitemap gerado com sucesso";
?>