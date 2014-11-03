<?php include('bibliotecaImages/class.asido.php');

	class banner extends FuncoesComum 
	{
		public function banner()
		{
			asido::driver('gd');
		}		
		
		private function atribuirViaPost()
		{
			$this->id_banner					= $this->sequenceCrypt($_POST["id_banner"], $_POST["codSecFormulario"], false);
			$this->str_localBanner				= $this->sequenceCrypt($_POST["slc_localBanner"], $_POST["codSecFormulario"], false);
			$this->str_nomeBanner				= $this->sequenceCrypt($_POST["str_nomeBanner"], $_POST["codSecFormulario"], false);
			$this->dt_inicialBanner				= $this->converteDataBanco($this->sequenceCrypt($_POST["str_dtInicialBanner"], $_POST["codSecFormulario"], false));
			$this->dt_finalBanner				= $this->removeLixoDecriptVazio($this->converteDataBanco($this->sequenceCrypt($_POST["str_dtFinalBanner"], $_POST["codSecFormulario"], false)));
			$this->str_tituloBanner				= $this->sequenceCrypt($_POST["str_tituloBanner"], $_POST["codSecFormulario"], false);
			$this->str_chamadaBanner			= $this->sequenceCrypt($_POST["str_chamadaBanner"], $_POST["codSecFormulario"], false);
			$this->str_conteudoBanner			= nl2br($this->retornoDescricoesValidas($this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_conteudoBanner"], 2, false))));
			$this->str_url						= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_url"], $_POST["codSecFormulario"], false));
			$this->str_localJanela				= $this->sequenceCrypt($_POST["slc_localJanela"], $_POST["codSecFormulario"], false);
			$this->bln_moldeBanner				= $this->sequenceCrypt($_POST["chk_molde"], $_POST["codSecFormulario"], false);
			$this->id_moldes					= $this->sequenceCrypt($_POST["slc_id_moldes"], $_POST["codSecFormulario"], false);

			$this->bln_flash					= $this->sequenceCrypt($_POST["chk_flash"], $_POST["codSecFormulario"], false);
			
			if ($this->str_conteudoBanner != '')
			{
				$this->str_url 			= '';
				$this->str_localJanela	= 'Mesma Janela';
			}
			
			//Atribuir corretamente a imagem e diretorio
			$this->str_diretorioBanner		= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_diretorioBanner"], $_POST["codSecFormulario"], false));
			$this->str_diretorioBanner 	 	= $this->incluirDiretorioString('banners/',$this->str_diretorioBanner);
			$this->str_diretorioBannerAux 	= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_diretorioBannerAux"], $_POST["codSecFormulario"], false));
			$this->str_diretorioBannerAux 	= $this->incluirDiretorioString('banners/',$this->str_diretorioBannerAux);

			$this->atribuirVariaveisRegraFlash($this->str_diretorioBanner, $this->str_diretorioBannerAux);
			$this->atribuirVariaveisLocalBanner($this->str_localBanner, $this->str_diretorioBanner, $this->str_diretorioBannerAux);
			$this->atribuirVariaveisRegraMolde($this->bln_moldeBanner);
		}

		public function atribuirQuery($objConexao, $int_codigo)
		{
			$query = $this->consultaBanner($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);

			$this->str_localBanner				= $this->codifiStringBancoInterface($objConexao, $array["str_localbanner"]);
			$this->str_nomeBanner				= $this->codifiStringBancoInterface($objConexao, $array["str_nomebanner"]);
			$this->dt_inicialBanner				= $this->retornaDataNumerica($array["dt_inicialbanner"], 'DATA_COMPLETA');
			$this->dt_finalBanner				= $this->retornaDataNumerica($array["dt_finalbanner"], 'DATA_COMPLETA');
			$this->str_tituloBanner				= $this->codifiStringBancoInterface($objConexao, $array["str_titulobanner"]);
			$this->str_chamadaBanner			= $this->codifiStringBancoInterface($objConexao, $array["str_chamadabanner"]);
			$this->str_conteudoBanner			= $this->codifiStringBancoInterface($objConexao, $array["str_conteudobanner"]);
			$this->str_url						= $array["str_url"];
			$this->str_localJanela				= $array["str_localjanela"];
			$this->bln_moldeBanner				= $array["bln_moldebanner"];
			$this->id_moldes					= $array["id_moldes"];

			$this->str_diretorioBanner 	 		= $this->codifiStringBancoInterface($objConexao,$array["str_diretoriobanner"]);
			$this->str_diretorioBannerAux 		= $this->incluirDiretorioString('banners/',$this->str_diretorioBanner);

			$this->atribuirObrigatoriedadeDataFormulario($objConexao, $this->str_localBanner);
			
			$this->bln_moldeBannerAux	= $this->bln_moldeBanner == 't'?'true':'';
			
			$this->atribuirVariaveisRegraFlash($this->str_diretorioBanner, $this->str_diretorioBannerAux);
			$this->atribuirVariaveisLocalBanner($this->str_localBanner, $this->str_diretorioBanner, $this->str_diretorioBannerAux);
			$this->atribuirVariaveisRegraMolde($this->bln_moldeBanner);
			
		}

		public function atribuirInformeBanner($objConexao, $int_codigo)
		{
			$query = $this->consultaBanner($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);

			$this->dt_inicialBanner				= $this->retornaDataNumerica($array["dt_inicialbanner"], 'DATA_COMPLETA');

			$this->str_tituloBanner				= $array["str_titulobanner"];
			$this->str_chamadaBanner			= $array["str_chamadabanner"];
			$this->str_conteudoBanner			= $array["str_conteudobanner"];
		}
		
		public function getDt_inicialBanner()
		{
			return $this->dt_inicialBanner;
		}
		
		public function getTituloBanner()
		{
			return $this->str_tituloBanner;
		}
		
		public function getChamadaBanner()
		{
			return $this->str_chamadaBanner;
		}
		
		public function getConteudoBanner()
		{
			return $this->str_conteudoBanner;
		}

		private function atribuirVariaveisLocalBanner($str_localBanner, $str_diretorioBanner, $str_diretorioBannerAux)
		{
			if ($str_localBanner == 'Banner Topo')
			{
				$this->str_tituloBanner 		= '';
				$this->str_chamadaBanner		= '';
				$this->str_conteudoBanner		= '';
				$this->str_url 					= '';
				$this->str_localJanela			= 'Mesma Janela';
				$this->str_CamposDisable 		= 'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"';
				$this->str_CamposDisableMolde 	= 'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"';
				
				if ($this->verificaDiretorioFlash($str_diretorioBanner, $str_diretorioBannerAux))
				{
					$this->bln_moldeBanner			= 'FALSE';
					$this->bln_moldeBannerAux 		= '';
				}else
				{
					$this->bln_moldeBanner			= 't';
					$this->bln_moldeBannerAux 		= 'true';
				}				
			}			
		}
		
		private function atribuirVariaveisRegraFlash($str_diretorioBanner, $str_diretorioBannerAux)
		{

			if ($this->verificaDiretorioFlash($str_diretorioBanner, $str_diretorioBannerAux))
			{
				$this->bln_flash				= 't';
				$this->bln_flashAux 			= 'true';
				$this->str_tituloBanner 		= '';
				$this->str_chamadaBanner		= '';
				$this->str_conteudoBanner		= '';
				$this->str_url 					= '';
				$this->str_localJanela			= 'Mesma Janela';
				$this->str_CamposDisable 		= 'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"';

				$this->bln_moldeBanner			= 'FALSE';
				$this->str_CamposDisableMolde 	= 'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"';
			}else
			{
				$this->bln_flash				= "f";
				$this->bln_flashAux 			= '';
				$this->str_CamposDisable 		= 'style="width: 125px;"';
				$this->str_CamposDisableMolde 	= 'style="width: 125px;"';
			}			
		}

		private function atribuirVariaveisRegraMolde($bln_moldeBanner)
		{
			if ($bln_moldeBanner == 'FALSE' || $bln_moldeBanner == 'f')
			{
				$this->str_CamposDisableMolde = 'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"';
			}else
			{
				$this->str_CamposDisableMolde = 'style="width: 125px;"';
			}
		}
		
		private function verificaDiretorioFlash($str_diretorioBanner, $str_diretorioBannerAux)
		{
			$str_diretorioBanner 	= str_replace('banners/', '', $str_diretorioBanner);
			$str_diretorioBannerAux = str_replace('banners/', '', $str_diretorioBannerAux);
			
			$flashPlayer = explode(".", basename(strtolower($str_diretorioBanner)));
			$flashPlayerAux = explode(".", basename(strtolower($str_diretorioBannerAux)));
			
			if ($flashPlayer[count($flashPlayer)-1] == 'swf' || $flashPlayerAux[count($flashPlayerAux)-1] == 'swf')
			{
				return true;
			}
			else
			{
				return false;
			}		
		}
		
		private function atribuirDimensoesImagem($temporarioImagem)
		{
			if ( $this->retornaTiposValidos('IMAGEM',$this->str_fileTipo))
			{
				//Carregando a imagem
				$ImagemCarregada = $this->abrirArquivoImagem($temporarioImagem);
			
				if ($ImagemCarregada != false)
				{
				   //Obtendo os tamanhos originais
					$this->str_fileWidth 	= imagesx($ImagemCarregada);
					$this->str_fileHeight 	= imagesy($ImagemCarregada);
				}
				return true;
			}
			return false;
		}
		
		private function trataDimensoesImagem($objConfiguracao, $objConexao, $str_tipoMolde, $arrayFile, $diretorioReal)
		{
			if ($this->atribuirDimensoesImagem($diretorioReal))
			{
				$objConfiguracao->atribuirBanner($objConexao, $str_tipoMolde);
				
				if (($objConfiguracao->getInt_largura() != $this->str_fileWidth) || ($objConfiguracao->getInt_altura() != $this->str_fileHeight))
				{
					$constDiferenca = 25;	//Diferença aceitavel entre larguras e alturas para recortar a imagem.
					$diferencaWidthMargem 	= abs($objConfiguracao->getInt_largura() - $this->str_fileWidth);
					$diferencaHeightMargem 	= abs($objConfiguracao->getInt_altura() - $this->str_fileHeight);

					$recortar		= false;
					$redimensionar	= false;
					$proporcional	= false;					
					if ($diferencaWidthMargem == $diferencaHeightMargem)
					{
						$proporcional	= true;
					}
					if ($diferencaWidthMargem > $constDiferenca || $diferencaHeightMargem > $constDiferenca)
					{
						$redimensionar	= true;
					}else
					{
						$recortar		= true;
					}
					
					$imagem = asido::image($diretorioReal, $diretorioReal);
					if($proporcional)
					{
						Asido::resize($imagem, $objConfiguracao->getInt_largura(), $objConfiguracao->getInt_altura(), ASIDO_RESIZE_STRETCH);
					}else 
					{
						if($recortar)
						{
							asido::Crop($imagem, 0, 0, $objConfiguracao->getInt_largura(), $objConfiguracao->getInt_altura());
						}else if($redimensionar)
						{
							if ($objConfiguracao->getInt_largura() != $this->str_fileWidth)
							{
								Asido::width($imagem, $objConfiguracao->getInt_largura());
								Asido::resize($imagem, $objConfiguracao->getInt_largura(), $objConfiguracao->getInt_altura(), ASIDO_RESIZE_STRETCH);
							}
							if ($objConfiguracao->getInt_altura() != $this->str_fileHeight)
							{
								Asido::height($imagem, $objConfiguracao->getInt_altura());
								Asido::resize($imagem, $objConfiguracao->getInt_largura(), $objConfiguracao->getInt_altura(), ASIDO_RESIZE_STRETCH);
							}							
						}
					}

					//Salva Modificações Imagem
					$imagem->save(ASIDO_OVERWRITE_ENABLED);
					$this->str_fileSize 	= filesize($diretorioReal);
				}
			}
		}
		
		function trataImagemMolde($objConfiguracao, $objConexao, $str_tipoMolde, $diretorioReal, $arrayId_molde)
		{
			$objConfiguracao->atribuirBanner($objConexao, $str_tipoMolde);
			$objConfiguracao->atribuirMoldes($objConexao, $arrayId_molde[0]);

			$diretorio		= getcwd().DIRECTORY_SEPARATOR;
			$imagemJpg 		= $diretorioReal;

			$imagemPng 		= str_replace('\\banners\\', DIRECTORY_SEPARATOR, getcwd().DIRECTORY_SEPARATOR.$objConfiguracao->getDiretorioMolde());
			$imagemTexto	= $diretorio.substr(md5(mktime()), 0, 7).".png";

			$imagem = imagecreate($objConfiguracao->getInt_largura(), $objConfiguracao->getInt_altura());

			//fundo transparente
			imagecolorallocatealpha($imagem, 255, 255, 255, 127);

			$cor 		= $this->atribuirCorRGBThema($objConexao, $imagem);//atribui a cor da fonte de acordo com o thema cadastrado.
			
			$fonte 		= str_replace('\\banners', DIRECTORY_SEPARATOR, getcwd()."fontes".DIRECTORY_SEPARATOR."ariblk.ttf");
			$int_fonte 	= 15;
			
			$posLargura = $objConfiguracao->getInt_largura() - $objConfiguracao->getInt_posicaoGX();
			$posAltura 	= $objConfiguracao->getInt_altura() - $objConfiguracao->getInt_posicaoGY();
			
			if ($str_tipoMolde != 'Banner Topo')
			{
				$this->escreverTextoGrandeImagem($imagem, $int_fonte, $posLargura, $posAltura, $cor, $arrayId_molde[1], $fonte);//titulo Banner
			}

			//cor do texto
			$cinza 		= imagecolorallocate($imagem, 108, 126, 130);
			//tamanho da fonte
			$int_fonte 	= 3;
			$posLargura = $objConfiguracao->getInt_largura() - $objConfiguracao->getInt_posicaoX();
			$posAltura 	= $objConfiguracao->getInt_altura() - $objConfiguracao->getInt_posicaoY();

			if ($str_tipoMolde != 'Banner Topo')
			{
				//Escrevendo fonte pequena cinza
				$imagem = $this->escreverTextoPequenoImagem($imagem, $int_fonte, $posLargura, $posAltura, $cinza, $arrayId_molde[2], 43, 3);//chamada Banner
			}

			imagepng($imagem, $imagemTexto);	
			imagedestroy($imagem);
		
			asido::driver('gd');
			$imagem = asido::image($imagemJpg, $imagemJpg);

			//Mescla a imagem a um PNG transparente
			asido::watermark($imagem, $imagemPng, ASIDO_WATERMARK_CENTER, ASIDO_WATERMARK_SCALABLE_DISABLED);
			asido::watermark($imagem, $imagemTexto, ASIDO_WATERMARK_CENTER, ASIDO_WATERMARK_SCALABLE_DISABLED);

			//Salva Modificações Imagem
			$imagem->save(ASIDO_OVERWRITE_ENABLED);
			unlink($imagemTexto);
			$this->str_fileSize 	= filesize($diretorioReal);
		}

		public function atribuirArquivo($objConfiguracao, $objConexao, $str_tipoMolde, $arrayFile, $diretorioReal, $arrayId_molde = '')
		{

			$this->str_fileNome		= $arrayFile["name"];
			$this->str_fileTipo		= $arrayFile["type"];
			$this->str_fileSize		= $arrayFile["size"];
			$this->str_fileTemp		= $arrayFile["tmp_name"];
			
			$retorno 			= true;
			$apagaArquivo 		= false;
			$mudouNomeArquivo 	= false;
			$erro				= '';
			if ($this->str_fileNome != '')
			{
				//Cria um novo nome para o arquivo criptografando a o tempo e concatenando com o tipo do arquivo.
				$separaNomeTipo		= explode('.', $this->str_fileNome);
				$str_novoNome 		= md5(mktime()).'.'.$separaNomeTipo[1];

				$this->str_fileNome = $this->retornoUrlValido($this->str_fileNome);
				$this->str_fileNome	= basename($this->str_fileNome);

				$diretorioDestino 	= $diretorioReal.$this->str_fileNome;
				
				$erro = '';
				if(!move_uploaded_file($this->str_fileTemp, $diretorioDestino))
				{
					$erro 		   .= " @Não foi possível enviar a imagem para o servidor.";
					$retorno 		= false;
					$apagaArquivo 	= true;
				}else
				{
					$flashPlayer = explode(".", basename(strtolower($diretorioDestino)));
					if ($flashPlayer[count($flashPlayer)-1] != 'swf')
					{
						$this->trataDimensoesImagem($objConfiguracao, $objConexao, $str_tipoMolde, $arrayFile, $diretorioDestino);
						$tipoArquivo = $this->retornaTiposValidos('IMAGEM',$this->str_fileTipo);
						
						if ($arrayId_molde != '')
						{
							$this->trataImagemMolde($objConfiguracao, $objConexao, $str_tipoMolde, $diretorioDestino, $arrayId_molde);
						}
						$str_msg = 'O formato da imagem não é aceito (Escolha uma imagem JPEG, GIF ou PNG).';
					}else
					{
						$tipoArquivo = $this->retornaTiposValidos('FLASH',$this->str_fileTipo);
						$str_msg = 'O formato do arquivo não é aceito (Escolha um arquivo SWF).';
					}
				}
				if(!$tipoArquivo)
				{
					$erro		   .= " @".$str_msg;
					$retorno 		= false;
					$apagaArquivo 	= true;
				}
				if($this->str_fileSize > (680 * 1024))
				{
					$erro		   .= " @O tamanho do arquivo excede o limite máximo de ".number_format(680,2,",",".")." Kb.";
					$retorno 		= false;
					$apagaArquivo 	= true;
				}

				if(!rename($diretorioDestino, $diretorioReal.$str_novoNome))
				{
					$erro		   .= " @Não foi possível renomear o arquivo no servidor.";
					$retorno 		= false;
					$apagaArquivo 	= true;
				}else
				{
					$mudouNomeArquivo = true;
				}
			
				//Elimina o arquivo no servidor
				if ($apagaArquivo)
				{
					if ($mudouNomeArquivo)
					{
						$this->apagaArquivoDiretorio($diretorioReal.$str_novoNome, FALSE);
					}
					else
					{
						$this->apagaArquivoDiretorio($diretorioReal.$this->str_fileNome, FALSE);
					}
				}
			}else
			{
				$str_novoNome = '';
			}
			
			if ($retorno)
			{
				return $str_novoNome;
			}else
			{
?>
				<script>
					var $erro = '<?php echo $erro;?>';
					while ($erro.search('@') != -1)
					{
						$erro = $erro.replace('@','<br>');
					}
					alertMenssage ('Atenção:',$erro);
				</script>
<?php return false;
			}
		}

		public function inicializaVariaveis()
		{

			$this->id_banner					= "";
			$this->str_localBanner				= "Banner Baixo";
			$this->bln_flash					= "f";
			$this->str_CamposDisable 			= 'style="width: 125px;"';
			$this->str_nomeBanner				= "";
			$this->dt_inicialBanner				= "";
			$this->dt_finalBanner				= "";
			$this->str_tituloBanner				= "";
			$this->str_chamadaBanner			= "";
			$this->str_conteudoBanner			= "";
			$this->str_url						= "";
			$this->str_localJanela				= "Mesma Janela";
			$this->bln_moldeBanner				= "t";
			$this->id_moldes					= "";

			$this->str_diretorioBanner 	 		= "";
			$this->str_diretorioBannerAux 		= "";
			$this->bln_moldeBannerAux			= "";
			$this->bln_flashAux					= "";
		}
		
		public function comboMoldes($objConexao, $str_localBanner)
		{
			$sql = "SELECT id_moldes, str_nomemolde, str_tipomolde from msf.moldes where str_tipomolde = '".$str_localBanner."' order by id_moldes desc";	
			return	$objConexao->executaSQL($sql);
		}
		
		private function consultaBanner($objConexao,$int_codigo)	
		{
			$sql = "SELECT * from msf.banner where id_banner =".$int_codigo;
			return	$objConexao->executaSQL($sql);		
		}

		public function atribuirObrigatoriedadeDataFormulario($objConexao, $localBanner = '')	
		{
			// Condiguração default do sistema.
			$sql	= "SELECT str_bannermediolargo, str_bannermediocurto, str_bannerbaixo from msf.configuracao order by id_configuracao desc limit 1";

			$query 	= $objConexao->executaSQL($sql);
			$array 	= $objConexao->retornaArray($query);
			
			$this->dt_medioLargo	= false;
			$this->dt_medioCurto	= false;
			$this->dt_bannerBaixo	= false;
			$this->asteriscoCampoDataFinal	= '';

			if ($localBanner != '')
			{
				//verifica se os banners estao nas posições que corresponde as posições
				if ($localBanner == 'Banner Medio Largo')
				{
					if ($array["str_bannermediolargo"] == 'Randomico Periodo')
					{
						$this->asteriscoCampoDataFinal = '*';
					}
				}else if ($localBanner == 'Banner Medio Curto')
				{
					if ($array["str_bannermediocurto"] == 'Randomico Periodo')
					{
						$this->asteriscoCampoDataFinal = '*';
					}					
				}else if ($localBanner == 'Banner Baixo')
				{
					if ($array["str_bannerbaixo"] == 'Randomico Periodo')
					{
						$this->asteriscoCampoDataFinal = '*';
					}
				}
			}else
			{
				if ($array["str_bannermediolargo"] == 'Randomico Periodo')
				{
					$this->dt_medioLargo = true;
				}
				if ($array["str_bannermediocurto"] == 'Randomico Periodo')
				{
					$this->dt_medioCurto = true;
				}
				if ($array["str_bannerbaixo"] == 'Randomico Periodo')
				{
					$this->dt_bannerBaixo = true;
				}
			}
		}

		private function verificaOcupacaoTopoBanner($objConexao, $id_banner)
		{
			$sql = "SELECT id_banner from msf.configuracao where id_banner = ".$id_banner;
			if($objConexao->contaLinhas($objConexao->executaSQL($sql)) == 0)
			{
				return true;
			}else
			{
				return false;
			}
		}

		public function cadastrarBanner($objConexao)
		{
			$this->atribuirViaPost();
			
			$sql	=  "SELECT id_banner from msf.banner where str_nomebanner = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_nomeBanner)."'";

			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) == 0)
			{
				$intCodigo = $this->atualizadorSequence($objConexao, "banner", "banner_id_banner_seq");
				$sql = "INSERT INTO msf.banner
						(
							id_banner,
							str_localbanner,
							str_nomebanner,
							str_diretoriobanner,
							dt_inicialbanner,
							dt_finalbanner,
							str_titulobanner,
							str_chamadabanner,
							str_conteudobanner,
							str_url,
							str_localjanela,
							bln_moldebanner,
							id_moldes,
							dt_publicacao
						) VALUES 
						(
							 *".$intCodigo."*,
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_localBanner)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_nomeBanner)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_diretorioBanner)."',
							'".$this->dt_inicialBanner."',
							'".$this->dt_finalBanner."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_tituloBanner)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_chamadaBanner)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_conteudoBanner)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_url)."',
							'".$this->str_localJanela."',
							'".$this->bln_moldeBanner."',
							 *".$this->id_moldes."*,
							 '".date('Y-m-d H:i:s')."'
						)";

				$sql = str_replace(array("''","**"),"null",$sql);
				$sql = str_replace("*","",$sql);
				
				if ($objConexao->executaSQL($sql))
				{
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
				$this->apagaArquivoDiretorio($this->str_diretorioBanner);
?>
					<script>
						alertMenssage ('Atenção:','O nome deste banner já existe. <br>Informe outro nome para este banner.');
					</script>
<?php return false;	
			}
		}
		
		public function alterarBanner($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT str_diretoriobanner from msf.banner where id_banner = ".$this->id_banner;
			$queryOriginal 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($queryOriginal) > 0)
			{
				$sql	=  "SELECT id_banner from msf.banner where str_nomebanner = '".$this->str_nomeBanner."' and id_banner != ".$this->id_banner;
				$query 	= $objConexao->executaSQL($sql);

				if ($objConexao->contaLinhas($query) == 0)//Verifica se o banner esta alterando o nome pra algum já existente.
				{
					$sql = "UPDATE msf.banner SET
								str_localbanner			= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_localBanner)."',
								str_nomebanner			= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_nomeBanner)."',
								str_diretoriobanner		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_diretorioBanner)."',
								dt_inicialbanner		= '".$this->dt_inicialBanner."',
								dt_finalbanner			= '".$this->dt_finalBanner."',
								str_titulobanner		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_tituloBanner)."',
								str_chamadabanner		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_chamadaBanner)."',
								str_conteudobanner		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_conteudoBanner)."',
								str_url					= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_url)."',
								str_localjanela			= '".$this->str_localJanela."',
								bln_moldebanner			= '".$this->bln_moldeBanner."',
								id_moldes				= *".$this->id_moldes."*,
								dt_publicacao			= '".date('Y-m-d H:i:s')."'
							where id_banner = ".$this->id_banner;
					
					$sql = str_replace(array("''","**"),"null",$sql);
					$sql = str_replace("*","",$sql);

					if ($objConexao->executaSQL($sql))
					{
						if ($this->str_diretorioBanner != $this->str_diretorioBannerAux)
						{
							$this->apagaImagemSubstituida($objConexao, $queryOriginal, 'str_diretoriobanner');
						}

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
							alertMenssage ('Atenção:','Já existe um outro banner com este nome. <br>Informe outro nome.');
						</script>
<?php return false;	
				}
			}else
			{
?>
					<script>
						alertMenssage ('Atenção:','Este banner não foi localizado para ser alterado. <br>Selecione outro banner.');
					</script>
<?php return false;	
			}
		}
		
		public function excluirBanner($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_banner from msf.banner where id_banner = ".$this->id_banner;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				if ($this->verificaOcupacaoTopoBanner($objConexao, $this->id_banner))
				{
					$sql = "DELETE FROM msf.banner where id_banner = ".$this->id_banner;
					if ($objConexao->executaSQL($sql))
					{
						$this->apagaArquivoDiretorio($this->str_diretorioBanner);//apaga arquivo imagem.
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
						alertMenssage ('Atenção:','Este Banner esta sendo utilizado no formulário configurações. <br>Exclua outro banner ou altere o existente no formulário configuração.');
					</script>
<?php return false;				
				}
			}else
			{
?>
					<script>
						alertMenssage ('Atenção:','Não existe nenhum banner com este nome. <br>Selecione outro banner.');
					</script>
<?php return false;	
			}
		}		

	}
?>