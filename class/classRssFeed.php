<?php class rssFeed extends FuncoesComum 
	{
		//============================================================================//
		//                   Função sobre os Dados RSS Feed                           //
		//============================================================================//
		public function rssFeed($objConexao) 
		{
			
			if ($this->retornaNomePaginaAtual() == 'rssfeed_ready.php')
			{
				$sql	=  "SELECT 
								id_rss,
								bln_externo,
								str_linkexterno,
								str_titulo,
								str_descricao,
								str_copyright					
							from msf.rss 
							where bln_externo = false 
							order by random() limit 1";
			}else
			{
				$sql	=  "SELECT 
								id_rss,
								bln_externo,
								str_linkexterno,
								str_titulo,
								str_descricao,
								str_copyright					
							from msf.rss 
							order by random() limit 1";
			}

			$query 	= $objConexao->executaSQL($sql);
			$array 	= $objConexao->retornaArray($query);

			$this->id_rss			= $array["id_rss"];
			$this->bln_externo		= $array["bln_externo"];
			$this->str_linkExterno	= $array["str_linkexterno"];
			$this->str_tituloRss	= $array["str_titulo"];
			$this->str_descricao	= $array["str_descricao"];
			$this->str_copyright	= $array["str_copyright"];
			
			$this->atribuirExternoInternoRssFeed();
			$this->adicionadorFeedRss = FALSE;
			$this->adicionarGeralRssFeed();
		}

		private function atribuirViaPost()
		{
			$this->id_rss 			= $this->sequenceCrypt($_POST["id_rss"], $_POST["codSecFormulario"], false);
			$this->bln_externo 		= $this->sequenceCrypt($_POST["chk_externo"], $_POST["codSecFormulario"], false);
			$this->str_linkExterno 	= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_linkExterno"], $_POST["codSecFormulario"], false));
			$this->str_titulo 		= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_titulo"], $_POST["codSecFormulario"], false));
			$this->str_descricao 	= nl2br($this->retornoDescricoesValidas($this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_descricao"], 2, false))));
			$this->str_copyright 	= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_copyright"], $_POST["codSecFormulario"], false));
			
			if ($this->bln_externo == 't')
			{
				$this->str_linkDisable		= 'style="width: 125px; filter: Alpha(Opacity=100);"';
				$this->str_dadosDisable		= 'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"';
				$this->btn_botaoP			= 'filter: Alpha(Opacity=0);" display: none; disabled="disabled"';
			}else
			{
				$this->str_linkDisable		= 'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"';
				$this->str_dadosDisable		= 'style="width: 125px; filter: Alpha(Opacity=100);"';
				$this->btn_botaoP			= 'filter: Alpha(Opacity=100);"';
			}			

		}

		public function inicializaVariaveis()
		{
			$this->id_rss			= "";
			$this->bln_externo 		= "t";
			$this->str_linkExterno 	= "";
			$this->str_titulo 		= "";
			$this->str_descricao 	= "";
			$this->str_copyright	= "";

			$this->btn_botaoP			= 'filter: Alpha(Opacity=0);" display: none; disabled="disabled"';
			$this->str_linkDisable		= 'style="width: 125px; filter: Alpha(Opacity=100);"';
			$this->str_dadosDisable		= 'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"';
			
		}
		
		public function atribuirQuery($objConexao, $int_codigo)
		{
			$query = $this->consultaRssFeed($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);

			$this->bln_externo		= $this->codifiStringBancoInterface($objConexao,$array["bln_externo"]);
			$this->str_linkExterno	= $this->codifiStringBancoInterface($objConexao,$array["str_linkexterno"]);
			$this->str_titulo		= $this->codifiStringBancoInterface($objConexao,$array["str_titulo"]);
			$this->str_descricao	= $this->codifiStringBancoInterface($objConexao,$array["str_descricao"]);
			$this->str_copyright	= $this->codifiStringBancoInterface($objConexao,$array["str_copyright"]);
			
			if ($this->bln_externo == 't')
			{
				$this->str_linkDisable		= 'style="width: 125px; filter: Alpha(Opacity=100);"';
				$this->str_dadosDisable		= 'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"';
				$this->btn_botaoP			= 'filter: Alpha(Opacity=0);" display: none; disabled="disabled"';
			}else
			{
				$this->str_linkDisable		= 'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"';
				$this->str_dadosDisable		= 'style="width: 125px; filter: Alpha(Opacity=100);"';
				$this->btn_botaoP			= 'filter: Alpha(Opacity=100);"';
			}			
		}
		
		private function consultaRssFeed($objConexao, $int_codigo)	
		{
			$sql = "SELECT 
						id_rss,
						bln_externo,
						str_linkexterno,
						str_titulo,
						str_descricao,
						str_copyright			
					from msf.rss 
					where id_rss =".$int_codigo;
			return	$objConexao->executaSQL($sql);		
		}

		public function consultaRssFeedItem($objConexao) 
		{
			$sql	=  "SELECT 
							ITE.id_rssitem, 
							ITE.id_rss, 
							ITE.str_tituloitem, 
							ITE.str_descricaoitem, 
							ITE.dt_publicacao 
						from msf.rss TIT 
							right join msf.rssitem ITE on (TIT.id_rss = ITE.id_rss) 
						where TIT.id_rss = ".$this->getId_rss()." order by ITE.dt_publicacao desc";
			return $objConexao->executaSQL($sql);
		}

		public function cadastrarRssFeed($objConexao)
		{
			$this->atribuirViaPost();
			
			$sql	=  "SELECT id_rss from msf.rss where str_titulo = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_titulo)."' OR (bln_externo == TRUE && str_linkexterno = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_linkExterno)."')";

			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) == 0)
			{
				$intCodigo = $this->atualizadorSequence($objConexao, "rss", "rss_id_rss_seq");
				$sql = "INSERT INTO msf.rss
						(
							id_rss,
							bln_externo,
							str_linkexterno,
							str_titulo,
							str_descricao,
							str_copyright
						) VALUES 
						(
							*".$intCodigo."*,
							'".$this->bln_externo."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_linkExterno)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_titulo)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_descricao)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_copyright)."'
						)";
				$sql = str_replace(array("''","**"),"null",$sql);
				$sql = str_replace("*","",$sql);
				
				if ($objConexao->executaSQL($sql))
				{
					$this->atribuirQuery($objConexao, $intCodigo);
?>
					<script>
						alertMenssage ('Aviso:','Cadastrado com sucesso.');
					</script>
<?php return true;
				}else
				{
					return false;
				}

			}else
			{
?>
					<script>
						alertMenssage ('Atenção:','Este Rss com este "título ou link de feed" já foi cadastrado. <br>Informe outro "título ou link de feed" para este Rss.');
					</script>
<?php return false;	
			}
		}
		
		public function alterarRssFeed($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_rss from msf.rss where id_rss = ".$this->id_rss;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "UPDATE msf.rss SET
							bln_externo			= '".$this->bln_externo."',
							str_linkexterno		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_linkExterno)."',
							str_titulo			= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_titulo)."',
							str_descricao		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_descricao)."',
							str_copyright		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_copyright)."'
						where id_rss = ".$this->id_rss;
				$sql = str_replace(array("''","**"),"null",$sql);
				$sql = str_replace("*","",$sql);
				
				if ($objConexao->executaSQL($sql))
				{
					$this->inicializaVariaveis();
?>
					<script>
						alertMenssage ('Aviso:','Alterado com sucesso.');
					</script>
<?php return true;
				}else
				{
					return false;
				}

			}else
			{
?>
					<script>
						alertMenssage ('Atenção:','Este Rss não foi localizado para ser alterado. <br>Selecione outro Rss.');
					</script>
<?php return false;	
			}
		}
		
		public function excluirRssFeed($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_rss from msf.rss where id_rss = ".$this->id_rss;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "DELETE FROM msf.rss where id_rss = ".$this->id_rss;
				if ($objConexao->executaSQL($sql) && $this->excluirRssFeedItem($objConexao, $this->id_rss))
				{
					$this->inicializaVariaveis();
?>
					<script>
						alertMenssage ('Aviso:','Excluído com sucesso.');
					</script>
<?php return true;
				}else
				{
					return false;
				}

			}else
			{
?>
					<script>
						alertMenssage ('Atenção:','Não existe nenhum Rss com este "título | link de feed". <br>Selecione outro Rss.');
					</script>
<?php return false;	
			}
		}		

		private function excluirRssFeedItem($objConexao, $id_rss)
		{
			$sql	=  "SELECT id_rss from msf.rssitem where id_rss = ".$id_rss;
			$query 	= $objConexao->executaSQL($sql);
			$numeroRssItem = $objConexao->contaLinhas($query);

			if ($numeroRssItem > 0)
			{
				$sucesso = true;
				while ($array = $objConexao->retornaArray($query))
				{
					$sql = "DELETE FROM msf.rssitem where id_rss = ".$array["id_rss"];
					if (!$objConexao->executaSQL($sql))
					{
						$sucesso = false;
					}				
				}
			}else
			{
				$sucesso = true;
			}
			return $sucesso;
		}

		public function adicionarGeralRssFeed()
		{
			if ($this->getBln_externo() == "f")
			{
				$this->adicionadorFeedRss = TRUE;
			}
		}		

		private function atribuirExternoInternoRssFeed($retornoLinkFeed = FALSE) 
		{
			if ($retornoLinkFeed)
			{
				return "http://".$_SERVER["SERVER_NAME"].str_replace($this->retornaNomePaginaAtual(), "",$_SERVER["SCRIPT_NAME"])."/rssfeed_ready.php";
			}else
			{
				if ($this->getBln_externo() == "t")
				{
					return $this->getLinkExterno();
				}else if ($this->getBln_externo() == "f")
				{
					return "http://".$_SERVER["SERVER_NAME"].str_replace($this->retornaNomePaginaAtual(), "",$_SERVER["SCRIPT_NAME"])."/rssfeed_ready.php";
				}
			}
		}
		
		private function montandoXmlRssFeed()
		{
			if (($feedAberto = fopen($this->atribuirExternoInternoRssFeed(),"r")) == FALSE)
			{
				return FALSE;
			}else
			{
				$this->str_xml 		= '';
				$this->image 		= 0;
				$this->channel    	= 0;
				$this->item			= 0;
				while (!feof($feedAberto)) 
				{
					$this->str_xml = $this->str_xml.fgets($feedAberto);
				}
				
				$codificacao = xml_parser_create('utf-8');

				xml_parse_into_struct($codificacao, $this->str_xml, $arrayRss, $this->index);
				xml_parser_free($codificacao);
				
				$indice = 1;
				$this->contadorRss	= 0;
				
				for ($i = 1; array_key_exists($i, $arrayRss); $i++) 
				{
					if ($arrayRss[$i]['tag'] == 'CHANNEL') 
					{
						if ($arrayRss[$i]['type'] == 'open') $this->channel = 1;
						if ($arrayRss[$i]['type'] == 'close') $this->channel = 0;
					}

					if ($arrayRss[$i]['tag'] == 'IMAGE') 
					{
						if ($arrayRss[$i]['type'] == 'open') 
						{
							$this->image 		= 0;
							$this->channel 		= 0;
							$this->item       	= 0;
						}
						
						if ($arrayRss[$i]['type'] == 'close')
						{
							$this->image = 0;
						}
					}
					
					if ($arrayRss[$i]['tag'] == 'ITEM') 
					{
						if ($arrayRss[$i]['type'] == 'open') 
						{
							$this->image 		= 0;
							$this->channel 		= 0;
							$this->item  		= 1;
							$this->contadorRss++;
						}
						
						if ($arrayRss[$i]['type'] == 'close') 
						{
							$indice++;
						}
					}
					
					if ($this->image == 1) 
					{
						if ($arrayRss[$i]['tag'] == 'TITLE' 	&& array_key_exists('value', $arrayRss[$i])) 	$this->tituloImg 		= $arrayRss[$i]['value'];
						if ($arrayRss[$i]['tag'] == 'URL' 		&& array_key_exists('value', $arrayRss[$i])) 	$this->urlImg    		= $arrayRss[$i]['value'];
						if ($arrayRss[$i]['tag'] == 'LINK' 		&& array_key_exists('value', $arrayRss[$i])) 	$this->linkImg   		= $arrayRss[$i]['value'];
					}
					
					if ($this->channel == 1) 
					{
						if ($arrayRss[$i]['tag'] == 'TITLE'		&& array_key_exists('value', $arrayRss[$i])) 	$this->tituloDoSite 	= $arrayRss[$i]['value'];
						if ($arrayRss[$i]['tag'] == 'COPYRIGHT'	&& array_key_exists('value', $arrayRss[$i]))	$this->notaCopyright	= $arrayRss[$i]['value'];
						if ($arrayRss[$i]['tag'] == 'DESCRIPTION' && array_key_exists('value', $arrayRss[$i]))	$this->descricaoSite	= $arrayRss[$i]['value']; 
					}
					
					if ($this->item == 1) 
					{
						if ($arrayRss[$i]['tag'] == 'TITLE'		&& array_key_exists('value', $arrayRss[$i])) 	$this->tituloNoticia[$indice] 	= $arrayRss[$i]['value'];
						if ($arrayRss[$i]['tag'] == 'LINK' 		&& array_key_exists('value', $arrayRss[$i]))	$this->linkNoticia[$indice]		= $arrayRss[$i]['value'];
						if ($arrayRss[$i]['tag'] == 'DESCRIPTION' && array_key_exists('value', $arrayRss[$i]))	$this->descNoticia[$indice]		= $arrayRss[$i]['value'];
						if ($arrayRss[$i]['tag'] == 'PUBDATE'	&& array_key_exists('value', $arrayRss[$i])) 	$this->dataPublicacao[$indice]	= $arrayRss[$i]['value'];			
					}
				}	
				
				$indice--;
				return true;
			}
		}

		public function escrevendoRssFeed($indice, $bln_Copyright = FALSE, $bln_continuacao = FALSE) 
		{		
			if ($this->montandoXmlRssFeed())
			{
				$str_rssFeed = "";
				$cont = 1;
				
				if ($bln_continuacao == FALSE)
				{
					$this->continuacao = 1;
					$this->indiceAux = $indice;
				}else
				{
					$this->continuacao = $this->indiceAux + 1;
					$indice += $this->indiceAux;
				}
				
				
				for ($i = $this->continuacao; $i <= $indice; $i++) 
				{

					if ($indice > $this->contadorRss )
					{
						if ($i > $this->contadorRss)
						{
							break;
						}
					}
					
					if (strlen($this->dataPublicacao[$i]) == 0)
					{
						$quantidadeCaracteres = 38;
					}else
					{
						$quantidadeCaracteres = 32;
					}
					
					if ($this->getBln_externo() == "t")
					{
						$janela = '_blank';
					}else
					{
						$janela = '_parent';
					}
					$stringDescricao = utf8_decode($this->tituloNoticia[$i]);
					$str_rssFeed .= "<a href='".$this->linkNoticia[$i]."#' target='".$janela."'>".$this->retornaDataNumerica(substr($this->dataPublicacao[$i],0,31), 'DATA_COMPLETA')." &raquo; ".$this->ocupacaoString($stringDescricao, $quantidadeCaracteres)."</a></br>";
					if ($cont == 4)
					{
						$str_rssFeed .= '<tr><td class="grupoEI_fundo_03"></td></tr></span></td></tr><tr><td class="grupoEI_fundo_02" style="height:43px;"><span class="adm_fonteTextoGrupo_01">';
					}
					
					$cont++;
				}
	
				if (isset($this->notaCopyright) && $bln_Copyright)
				{
					$str_rssFeed .= $this->notaCopyright;
				}
				if ($str_rssFeed == "")
				{
					$this->contadorGeral++;
					$str_rssFeed = "<div style=\"background-color:'#ffffe3'; text-align: justify; vertical-align: middle; height:113px;\">Aviso: Servidor de notícias se encontra ocupado tente novamente em segundos.</div>";
				}
				return $str_rssFeed;
			}
			else
			{
				$this->contadorGeral++;
				$str_rssFeed = "<div style=\"
									background-color:'#fff8f8'; 
									text-align: justify; 
									vertical-align: middle; 
									height:113px;\"
								>
									Atenção: Servidor de notícias se encontra fora de serviço ou não pode 
									ser localizado pelo endereço especificado do cod.".$this->getId_rss().".
								</div>";
				return $str_rssFeed;
			}
		}

		public function apresentandoRssFeed($objConexao, $id_rssItem) 
		{
			if ($id_rssItem == 'semsuporte')
			{
					$msgErro = 'Aviso: Este navegador não possui suporte para adicionar Feed RSS <br /> Cadastre o link do Feed abaixo no seu agregador de Feeds <br /><br /><br /><span class="adm_fonteTextoGrupo_01"><a href="#">'.$this->atribuirExternoInternoRssFeed(TRUE)."</a></span>";
	
					$this->str_tituloItem		= "";
					$this->str_descricaoItem	= "";
					$this->dt_publicacao		= "";
					$this->msgErro				= $msgErro;	
			}else
			{
				$sql	=  "SELECT 
								str_tituloitem,
								str_descricaoitem,
								dt_publicacao
							from msf.rssitem 
							where id_rssitem = ".$id_rssItem." limit 1";
				$query 	= $objConexao->executaSQL($sql);
				if ($objConexao->contaLinhas($query) > 0)
				{
					$array 	= $objConexao->retornaArray($query);
	
					$this->str_tituloItem		= $array["str_tituloitem"];
					$this->str_descricaoItem	= $array["str_descricaoitem"];
					//2008-05-21 01:55:29
					$this->dt_publicacao		= "Atualizado em ".$this->retornaDataNumerica($array["dt_publicacao"], 'DATA_COMPLETA')." ".$this->retornaDataNumerica($array["dt_publicacao"], 'HORA_COMPLETA');
					$this->msgErro				= "";
				}else
				{
					$msgErro = 'Aviso: Não existe nenhuma informação relacionada a este Cod.'.$id_rssItem;
	
					$this->str_tituloItem		= "";
					$this->str_descricaoItem	= "";
					$this->dt_publicacao		= "";
					$this->msgErro				= $msgErro;				
				}
			}
		}

		public function lendoRssFeed($objConexao) 
		{
			$items 		= 	array();
			$channel 	= 	array
								(
									"title"        => $this->getTituloRss(),
									"description"  => $this->getDescricao(),
									"link"         => $this->atribuirExternoInternoRssFeed(TRUE) ,
									"copyright"    => "Copyright (C) ".$this->getCopyright()
								);

			$query 	= $this->consultaRssFeedItem($objConexao);

			while($array = $objConexao->retornaArray($query))
			{	
				$novoArray = array
							(
								"title"       => $array["str_tituloitem"],
								"description" => $array["str_descricaoitem"],
								"link"        => "mostraFeedRss.php?id_rssitem=".$array["id_rssitem"],
								"pubDate"     => date(
														"D, d M Y H:i:s O", 
														mktime(
																$this->retornaDataNumerica($array["dt_publicacao"], 'HH'), 
																$this->retornaDataNumerica($array["dt_publicacao"], 'MI'), 
																$this->retornaDataNumerica($array["dt_publicacao"], 'SS'), 
																$this->retornaDataNumerica($array["dt_publicacao"], 'MM'), 
																$this->retornaDataNumerica($array["dt_publicacao"], 'DD'), 
																$this->retornaDataNumerica($array["dt_publicacao"], 'YYYY')
															  )
													 )
							);
				array_push($items, $novoArray);
			}
				
			$str_rssFeed = '<?xml version="1.0" encoding="utf-8"?>';
			$str_rssFeed .= '<rss version="2.0">';
			$str_rssFeed .= "<channel>";
			$str_rssFeed .= "<title>" . $channel["title"] . "</title>";
			$str_rssFeed .= "<description>" . $channel["description"] . "</description>";
			$str_rssFeed .= "<link>" . $channel["link"] . "</link>";
			$str_rssFeed .= "<copyright>" . $channel["copyright"] . "</copyright>";
		 
			foreach ($items as $item) 
			{
				$str_rssFeed .= "<item>";
				$str_rssFeed .= "<title>" . $item["title"] . "</title>";
				$str_rssFeed .= "<description>" . $item["description"] . "</description>";
				$str_rssFeed .= "<link>" . $item["link"] . "</link>";
				$str_rssFeed .= "<pubDate>" . $item["pubDate"] . "</pubDate>";
				$str_rssFeed .= "</item>";
			}
			$str_rssFeed .= "</channel>";
			$str_rssFeed .= "</rss>";
			
			return $str_rssFeed;
		}		

		//============================================================================//
		//                        GETS Dados RSS Feed                                 //
		//============================================================================//
		public function getId_rss()
		{
			return $this->id_rss;
		}

		public function getBln_externo()
		{
			return $this->bln_externo;
		}

		public function getLinkExterno()
		{
			return $this->str_linkExterno;
		}

		public function getTituloRss()
		{
			return $this->str_tituloRss;
		}

		public function getDescricao()
		{
			return $this->str_descricao;
		}

		public function getCopyright()
		{
			return $this->str_copyright;
		}

		public function getAdicionarFeedRss($internoFeedRss = FALSE)
		{
			//Opera/9.27 (Windows NT 5.1; U; pt-br)
			if ($internoFeedRss)
			{
				if (substr($_SERVER["HTTP_USER_AGENT"], 25, 8) == 'MSIE 6.0' || substr($_SERVER["HTTP_USER_AGENT"], 0, 5) == 'Opera')
				{
					$this->str_ondeAbriJanela = "_parent";
					return 'mostraFeedRss.php?id_rssitem=semsuporte';
				}else
				{
					$this->str_ondeAbriJanela = "_blank";
					return 'rssfeed_ready.php';
				}
			}else
			{
				if ($this->getBln_externo() == "t")
				{
					return $this->getLinkExterno();
				}else
				{
					$this->str_ondeAbriJanela = "_blank";
					return 'rssfeed_ready.php';
				}
			}
		}

		public function getOndeAbriJanela()
		{
			return $this->str_ondeAbriJanela;
		}
		//============================================================================//
		//                        GETS Dados Item RSS Feed                            //
		//============================================================================//

		public function getTituloItem()
		{
			return $this->str_tituloItem;
		}
		
		public function getDescricaoItem()
		{
			return $this->str_descricaoItem;
		}
		
		public function getDt_publicacao()
		{
			return $this->dt_publicacao;
		}
		public function getMsgErro()
		{
			return $this->msgErro;
		}

	}
?>