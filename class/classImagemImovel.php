<?php include('bibliotecaImages/class.asido.php');

	class imagemimovel extends FuncoesComum 
	{
		public function imagemimovel()
		{
			asido::driver('gd');
		}		
		
		private function atribuirViaPost()
		{
			$this->id_imagensImovel			= $this->sequenceCrypt($_POST["id_imagensimovel"], $_POST["codSecFormulario"], false);
			$this->id_imovel				= $this->sequenceCrypt($_POST["id_imovel"], $_POST["codSecFormulario"], false);
			$this->str_imagensImovel		= $this->sequenceCrypt($_POST["str_imagensImovel"], $_POST["codSecFormulario"], false);
		
			//Atribuir corretamente a imagem e diretorio
			$this->str_diretorioImagensImovel		= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_diretorioImagensImovel"], $_POST["codSecFormulario"], false));
			$this->str_diretorioImagensImovel 	 	= $this->incluirDiretorioString('imovel/',$this->str_diretorioImagensImovel);
			$this->str_diretorioImagensImovelAux 	= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_diretorioImagensImovelAux"], $_POST["codSecFormulario"], false));
			$this->str_diretorioImagensImovelAux 	= $this->incluirDiretorioString('imovel/',$this->str_diretorioImagensImovelAux);
		}

		public function inicializaVariaveis($id_imovel='')
		{
			$this->id_imagensImovel				= "";
			
			$this->id_imovel					= $id_imovel!=''?$id_imovel:'';
			$this->str_imagensImovel			= "";
			$this->str_diretorioImagensImovel	= "";
			$this->str_diretorioImagensImovelAux= "";
		}

		public function atribuirQuery($objConexao, $int_codigo)
		{
			$query = $this->consultaImagensImovel($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);

			$this->str_imagensImovel			= $this->codifiStringBancoInterface($objConexao,$array["str_imagensimovel"]);
			$this->id_imovel					= $this->codifiStringBancoInterface($objConexao,$array["id_imovel"]);
			$this->str_diretorioImagensImovel	= $this->codifiStringBancoInterface($objConexao,$array["str_diretorioimagensimovel"]);
			$this->str_diretorioImagensImovelAux= $this->incluirDiretorioString('imovel/M',$this->str_diretorioImagensImovel);
		}

		private function consultaImagensImovel($objConexao,$int_codigo)	
		{
			$sql = "SELECT * from msf.imagensimovel where id_imagensimovel =".$int_codigo;
			return	$objConexao->executaSQL($sql);		
		}

		private function atribuirDimensoesImagem($temporarioImagem)
		{
			if ($this->retornaTiposValidos('IMAGEM',$this->str_fileTipo))
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
		
		private function criaImagemImovelMenor($diretorioReal, $nomeImagem)
		{
			$str_imagemGrandeWidth = 197;
			$str_imagemGrandeHeight = 132;
			$imagem = asido::image($diretorioReal.'M'.$nomeImagem, $diretorioReal.'mini'.DIRECTORY_SEPARATOR.$nomeImagem);

			Asido::resize($imagem, $str_imagemGrandeWidth, $str_imagemGrandeHeight, ASIDO_RESIZE_STRETCH);
			//Salva Imagem Miniatura
			$imagem->save(ASIDO_OVERWRITE_ENABLED);
		}		

		private function trataDimensoesImagem($objConfiguracao, $objConexao, $arrayFile, $diretorioReal)
		{
			if ($this->atribuirDimensoesImagem($diretorioReal))
			{
				$str_imagemGrandeWidth = 458;
				$str_imagemGrandeHeight = 366;
				
				if (($str_imagemGrandeWidth != $this->str_fileWidth) || ($str_imagemGrandeHeight != $this->str_fileHeight))
				{
					$constDiferenca = 25;	//Diferença aceitavel entre larguras e alturas para recortar a imagem.
					$diferencaWidthMargem 	= abs($str_imagemGrandeWidth - $this->str_fileWidth);
					$diferencaHeightMargem 	= abs($str_imagemGrandeHeight - $this->str_fileHeight);

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
						Asido::resize($imagem, $str_imagemGrandeWidth, $str_imagemGrandeHeight, ASIDO_RESIZE_STRETCH);
					}else 
					{
						if($recortar)
						{
							asido::Crop($imagem, 0, 0, $str_imagemGrandeWidth, $str_imagemGrandeHeight);
						}else if($redimensionar)
						{
							if ($str_imagemGrandeWidth != $this->str_fileWidth)
							{
								Asido::width($imagem, $str_imagemGrandeWidth);
								Asido::resize($imagem, $str_imagemGrandeWidth, $str_imagemGrandeHeight, ASIDO_RESIZE_STRETCH);
							}
							if ($str_imagemGrandeHeight != $this->str_fileHeight)
							{
								Asido::height($imagem, $str_imagemGrandeHeight);
								Asido::resize($imagem, $str_imagemGrandeWidth, $str_imagemGrandeHeight, ASIDO_RESIZE_STRETCH);
							}							
						}
					}

					//Salva Modificações Imagem
					$imagem->save(ASIDO_OVERWRITE_ENABLED);
					$this->str_fileSize 	= filesize($diretorioReal);
				}
			}
		}

		public function atribuirArquivo($objConfiguracao, $objConexao, $arrayFile, $diretorioReal)
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
					$this->trataDimensoesImagem($objConfiguracao, $objConexao, $arrayFile, $diretorioDestino);
				}
				if(!$this->retornaTiposValidos('IMAGEM',$this->str_fileTipo))
				{
					$erro		   .= " @O formato da imagem não é aceito (Escolha uma imagem JPEG, GIF ou PNG).";
					$retorno 		= false;
					$apagaArquivo 	= true;
				}
				if($this->str_fileSize > (750 * 1024))
				{
					$erro		   .= " @O tamanho da imagem excede o limite máximo de ".number_format(750,2,",",".")." Kb.";
					$retorno 		= false;
					$apagaArquivo 	= true;
				}

				if(!rename($diretorioDestino, $diretorioReal.'M'.$str_novoNome))
				{
					$erro		   .= " @Não foi possível renomear a imagem no servidor.";
					$retorno 		= false;
					$apagaArquivo 	= true;
				}else
				{
					$this->criaImagemImovelMenor($diretorioReal, $str_novoNome);
					$mudouNomeArquivo = true;
				}

			
				//Elimina o arquivo no servidor
				if ($apagaArquivo)
				{
					if ($mudouNomeArquivo)
					{
						$this->apagaArquivoDiretorio($diretorioReal.'M'.$str_novoNome, FALSE, TRUE);
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

		public function cadastrarImagensImovel($objConexao)
		{
			$this->atribuirViaPost();
			
			$sql	=  "SELECT id_imagensimovel from msf.imagensimovel where str_imagensimovel = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_imagensImovel)."'";
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) == 0)
			{
				$intCodigo = $this->atualizadorSequence($objConexao, "imagensimovel", "imagensimovel_id_imagensimovel_seq");
				$sql = "INSERT INTO msf.imagensimovel
						(
							id_imagensimovel,
							id_imovel,
							str_imagensimovel,
							str_diretorioimagensimovel
						) VALUES 
						(
							 *".$intCodigo."*,
							 *".$this->id_imovel."*,
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_imagensImovel)."',
							'".basename($this->codifiStringInterfaceBanco($objConexao,$this->str_diretorioImagensImovel))."'
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
				$this->apagaArquivoDiretorio($this->str_diretorioImagensImovel);
?>
				<script>
					alertMenssage ('Atenção:','O nome desta imagem já existe. <br>Informe outro nome para esta imagem.');
				</script>
<?php return false;	
			}
		}
		
		public function alterarImagensImovel($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT str_diretorioimagensimovel from msf.imagensimovel where id_imagensimovel = ".$this->id_imagensImovel;
			$queryOriginal 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($queryOriginal) > 0)
			{
				$sql	=  "SELECT id_imagensimovel from msf.imagensimovel where str_imagensimovel = '".$this->str_imagensImovel."' and id_imagensimovel != ".$this->id_imagensImovel;
				$query 	= $objConexao->executaSQL($sql);

				if ($objConexao->contaLinhas($query) == 0)//Verifica se o molde esta alterando o nome pra algum já existente.
				{
					$sql = "UPDATE msf.imagensimovel SET
								id_imovel					= *".$this->id_imovel."*,
								str_imagensimovel			= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_imagensImovel)."',
								str_diretorioimagensimovel	= '".str_replace('M','',basename($this->codifiStringInterfaceBanco($objConexao,$this->str_diretorioImagensImovel)))."'
							where id_imagensimovel = ".$this->id_imagensImovel;
					$sql = str_replace(array("''","**"),"null",$sql);
					$sql = str_replace("*","",$sql);
					
					if ($objConexao->executaSQL($sql))
					{
						if ($this->str_diretorioImagensImovel != $this->str_diretorioImagensImovelAux)
						{
							$this->apagaImagemSubstituida($objConexao, $queryOriginal, 'str_diretorioimagensimovel', TRUE);
						}

						$this->inicializaVariaveis($this->id_imovel);
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
							alertMenssage ('Atenção:','Já existe uma outra imagem com este nome. <br>Informe outro nome.');
						</script>
<?php return false;	
				}
				
			}else
			{
?>
					<script>
						alertMenssage ('Atenção:','Esta imagem não foi localizado para ser alterado. <br>Selecione outra imagem.');
					</script>
<?php return false;	
			}
		}
		
		public function excluirImagensImovel($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_imagensimovel from msf.imagensimovel where id_imagensimovel = ".$this->id_imagensImovel;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "DELETE FROM msf.imagensimovel where id_imagensimovel = ".$this->id_imagensImovel;
				if ($objConexao->executaSQL($sql))
				{
					$this->apagaArquivoDiretorio($this->str_diretorioImagensImovel, TRUE, TRUE);//apaga arquivo imagem.
					$this->inicializaVariaveis($this->id_imovel);
?>
					<script>
						alertMenssage ('Aviso:', 'Excluído com sucesso.');
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
						alertMenssage ('Atenção:','Não existe nenhuma imagem com este nome. <br>Selecione outra imagem.');
					</script>
<?php return false;	
			}
		}		

	}
?>