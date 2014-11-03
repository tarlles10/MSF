<?php include('bibliotecaImages/class.asido.php');

	class moldes extends FuncoesComum 
	{
		public function moldes()
		{
			asido::driver('gd');
		}		
		
		private function atribuirViaPost()
		{
			$this->id_moldes					= $this->sequenceCrypt($_POST["id_moldes"], $_POST["codSecFormulario"], false);
			$this->str_nomeMolde				= $this->sequenceCrypt($_POST["str_nomeMolde"], $_POST["codSecFormulario"], false);

			$this->int_posicaox					= $this->sequenceCrypt($_POST["int_posicaox"], $_POST["codSecFormulario"], false);
			$this->int_posicaoy					= $this->sequenceCrypt($_POST["int_posicaoy"], $_POST["codSecFormulario"], false);
			$this->int_posicaogx				= $this->sequenceCrypt($_POST["int_posicaogx"], $_POST["codSecFormulario"], false);
			$this->int_posicaogy				= $this->sequenceCrypt($_POST["int_posicaogy"], $_POST["codSecFormulario"], false);

		
			//Atribuir corretamente a imagem e diretorio
			$this->str_diretorioMolde		= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_diretorioMolde"], $_POST["codSecFormulario"], false));
			$this->str_diretorioMolde 	 	= $this->incluirDiretorioString('moldesGeral/',$this->str_diretorioMolde);
			$this->str_diretorioMoldeAux 	= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_diretorioMoldeAux"], $_POST["codSecFormulario"], false));
			$this->str_diretorioMoldeAux 	= $this->incluirDiretorioString('moldesGeral/',$this->str_diretorioMoldeAux);

		//############################################################################//
		//          			Funções sobre regra de negócio           			  //
			$this->str_tipoMolde				= $this->sequenceCrypt($_POST["slc_tipoMolde"], $_POST["codSecFormulario"], false);
			if ($this->str_tipoMolde == 'Banner Topo')
			{
				$this->bln_modificar = 'FALSE';
			}else
			{
				$this->bln_modificar				= $this->sequenceCrypt($_POST["chk_modificar"], $_POST["codSecFormulario"], false);
			}
		//																			  //
		//############################################################################//
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

		public function atribuirArquivo($objConfiguracao, $objConexao, $str_tipoMolde, $arrayFile, $diretorioReal)
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
					$this->trataDimensoesImagem($objConfiguracao, $objConexao, $str_tipoMolde, $arrayFile, $diretorioDestino);
				}
				if(!$this->retornaTiposValidos('IMAGEM_TRANSPARENTE',$this->str_fileTipo))
				{
					$erro		   .= " @O formato da imagem não é aceito (Escolha uma imagem PNG).";
					$retorno 		= false;
					$apagaArquivo 	= true;
				}
				if($this->str_fileSize > (150 * 1024))
				{
					$erro		   .= " @O tamanho da imagem excede o limite máximo de ".number_format(150,2,",",".")." Kb.";
					$retorno 		= false;
					$apagaArquivo 	= true;
				}

				if(!rename($diretorioDestino, $diretorioReal.$str_novoNome))
				{
					$erro		   .= " @Não foi possível renomear a imagem no servidor.";
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
			$this->id_moldes					= "";
			$this->str_nomeMolde				= "";
			$this->str_diretorioMolde			= "";
			$this->str_tipoMolde				= "Banner Base";
			$this->bln_modificar				= "t";
			$this->int_posicaox					= "";
			$this->int_posicaoy					= "";
			$this->int_posicaogx				= "";
			$this->int_posicaogy				= "";
			
			$this->str_diretorioMoldeAux		= "";
			$this->bln_modificarAux				= "";
		}
		
		public function atribuirQuery($objConexao, $int_codigo)
		{
			$query = $this->consultaMoldes($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);

			$this->str_nomeMolde				= $this->codifiStringBancoInterface($objConexao,$array["str_nomemolde"]);
			$this->str_diretorioMolde			= $this->codifiStringBancoInterface($objConexao,$array["str_diretoriomolde"]);
			$this->str_tipoMolde				= $this->codifiStringBancoInterface($objConexao,$array["str_tipomolde"]);
			$this->bln_modificar				= $array["bln_modificar"];
			$this->int_posicaox					= $array["int_posicaox"];
			$this->int_posicaoy					= $array["int_posicaoy"];
			$this->int_posicaogx				= $array["int_posicaogx"];
			$this->int_posicaogy				= $array["int_posicaogy"];
			
			$this->str_diretorioMoldeAux		= $this->incluirDiretorioString('moldesGeral/',$this->str_diretorioMolde);
			
			
			if ($this->bln_modificar == 't')
			{
				$this->bln_modificarAux = 'true';
			}else
			{
				$this->bln_modificarAux = '';
			}
		}

		private function consultaMoldes($objConexao,$int_codigo)	
		{
			$sql = "SELECT * from msf.moldes where id_moldes =".$int_codigo;
			return	$objConexao->executaSQL($sql);		
		}
		
		public function cadastrarMoldes($objConexao)
		{
			$this->atribuirViaPost();
			
			$sql	=  "SELECT id_moldes from msf.moldes where str_nomemolde = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_nomeMolde)."'";

			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) == 0)
			{
				$intCodigo = $this->atualizadorSequence($objConexao, "moldes", "moldes_id_moldes_seq");
				$sql = "INSERT INTO msf.moldes
						(
							id_moldes,
							str_nomemolde,
							str_diretoriomolde,
							str_tipomolde,
							bln_modificar,
							int_posicaox,
							int_posicaoy,
							int_posicaogx,
							int_posicaogy
						) VALUES 
						(
							*".$intCodigo."*,
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_nomeMolde)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_diretorioMolde)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_tipoMolde)."',
							'".$this->bln_modificar."',
							*".$this->int_posicaox."*,
							*".$this->int_posicaoy."*,
							*".$this->int_posicaogx."*,
							*".$this->int_posicaogy."*
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
				$this->apagaArquivoDiretorio($this->str_diretorioMolde);
?>
				<script>
					alertMenssage ('Atenção:','O nome deste molde já existe. <br>Informe outro nome para este molde.');
				</script>
<?php return false;	
			}
		}
		
		public function alterarMoldes($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_moldes from msf.moldes where id_moldes = ".$this->id_moldes;
			$queryOriginal 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($queryOriginal) > 0)
			{
				$sql	=  "SELECT id_moldes from msf.moldes where str_nomemolde = '".$this->str_nomeMolde."' and id_moldes != ".$this->id_moldes;
				$query 	= $objConexao->executaSQL($sql);

				if ($objConexao->contaLinhas($query) == 0)//Verifica se o molde esta alterando o nome pra algum já existente.
				{
					$sql = "UPDATE msf.moldes SET
								str_nomemolde		= '".$this->codifiStringInterfaceBanco($objConexao, $this->str_nomeMolde)."',
								str_diretoriomolde	= '".$this->str_diretorioMolde."',
								str_tipomolde		= '".$this->codifiStringInterfaceBanco($objConexao, $this->str_tipoMolde)."',
								bln_modificar		= '".$this->bln_modificar."',
								int_posicaox		= *".$this->int_posicaox."*,
								int_posicaoy		= *".$this->int_posicaoy."*,
								int_posicaogx		= *".$this->int_posicaogx."*,
								int_posicaogy		= *".$this->int_posicaogy."*
							where id_moldes = ".$this->id_moldes;
					$sql = str_replace(array("''","**"),"null",$sql);
					$sql = str_replace("*","",$sql);
					
					if ($objConexao->executaSQL($sql))
					{
						if ($this->str_diretorioMolde != $this->str_diretorioMoldeAux)
						{
							$this->apagaImagemSubstituida($objConexao, $queryOriginal, 'str_diretoriomolde');
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
							alertMenssage ('Atenção:','Já existe um outro molde com este nome. <br>Informe outro nome.');
						</script>
<?php return false;	
				}
			}else
			{
?>
					<script>
						alertMenssage ('Atenção:','Este Molde não foi localizado para ser alterado. <br>Selecione outro molde.');
					</script>
<?php return false;	
			}
		}
		
		public function excluirMoldes($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_moldes from msf.moldes where id_moldes = ".$this->id_moldes;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "DELETE FROM msf.moldes where id_moldes = ".$this->id_moldes;
				if ($objConexao->executaSQL($sql))
				{
					$this->apagaArquivoDiretorio($this->str_diretorioMolde);//apaga arquivo imagem.
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
						alertMenssage ('Atenção:','Não existe nenhum molde com este nome. <br>Selecione outro molde.');
					</script>
<?php return false;	
			}
		}		

	}
?>