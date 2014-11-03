<?php include('bibliotecaImages/class.asido.php');

	class arquivoimovel extends FuncoesComum 
	{
		public function arquivoimovel()
		{
			asido::driver('gd');
		}		
		
		private function atribuirViaPost()
		{
			$this->id_arquivosImovel		= $this->sequenceCrypt($_POST["id_arquivosimovel"], $_POST["codSecFormulario"], false);
			$this->id_imovel				= $this->sequenceCrypt($_POST["id_imovel"], $_POST["codSecFormulario"], false);
			$this->str_arquivosImovel		= $this->sequenceCrypt($_POST["str_arquivosImovel"], $_POST["codSecFormulario"], false);
		
			//Atribuir corretamente a arquivo e diretorio
			$this->str_diretorioArquivosImovel		= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_diretorioArquivosImovel"], $_POST["codSecFormulario"], false));
			$this->str_diretorioArquivosImovel 	 	= $this->incluirDiretorioString('arquivosImovel/',$this->str_diretorioArquivosImovel);
			$this->str_diretorioArquivosImovelAux 	= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_diretorioArquivosImovelAux"], $_POST["codSecFormulario"], false));
			$this->str_diretorioArquivosImovelAux 	= $this->incluirDiretorioString('arquivosImovel/',$this->str_diretorioArquivosImovelAux);
		}

		public function inicializaVariaveis($id_imovel='')
		{
			$this->id_arquivosImovel				= "";
			
			$this->id_imovel					= $id_imovel!=''?$id_imovel:'';
			$this->str_arquivosImovel			= "";
			$this->str_diretorioArquivosImovel	= "";
			$this->str_diretorioArquivosImovelAux= "";
		}

		public function atribuirQuery($objConexao, $int_codigo)
		{
			$query = $this->consultaArquivosImovel($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);

			$this->str_arquivosImovel			= $this->codifiStringBancoInterface($objConexao,$array["str_arquivosimovel"]);
			$this->id_imovel					= $this->codifiStringBancoInterface($objConexao,$array["id_imovel"]);
			$this->str_diretorioArquivosImovel	= $this->codifiStringBancoInterface($objConexao,$array["str_diretorioarquivosimovel"]);
			$this->str_diretorioArquivosImovelAux= $this->incluirDiretorioString('arquivosImovel/',$this->str_diretorioArquivosImovel);
		}

		private function consultaArquivosImovel($objConexao,$int_codigo)	
		{
			$sql = "SELECT * from msf.arquivosimovel where id_arquivosimovel =".$int_codigo;
			return	$objConexao->executaSQL($sql);		
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
					$erro 		   .= " @Não foi possível enviar o arquivo para o servidor.";
					$retorno 		= false;
					$apagaArquivo 	= true;
				}
				if(!$this->retornaTiposValidos('ARQUIVO',$this->str_fileTipo))
				{
					$erro		   .= " @O formato do arquivo não é aceito (Escolha uma arquivo DOC, XLS, PPT, PDF, ZIP ou RAR).";
					$retorno 		= false;
					$apagaArquivo 	= true;
				}
				if($this->str_fileSize > (2024 * 1024))
				{
					$erro		   .= " @O tamanho do arquivo excede o limite máximo de ".number_format(2024,2,",",".")." Kb.";
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

		public function cadastrarArquivosImovel($objConexao)
		{
			$this->atribuirViaPost();
			
			$sql	=  "SELECT id_imovel from msf.arquivosimovel where str_arquivosimovel = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_arquivosImovel)."'";
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) == 0)
			{
				$sql	=  "SELECT id_imovel from msf.arquivosimovel where id_imovel = ".$this->id_imovel;
				$query 	= $objConexao->executaSQL($sql);
				if ($objConexao->contaLinhas($query) <= 3)
				{
				
					$intCodigo = $this->atualizadorSequence($objConexao, "arquivosimovel", "arquivosimovel_id_arquivosimovel_seq");
					$sql = "INSERT INTO msf.arquivosimovel
							(
								id_arquivosimovel,
								id_imovel,
								str_arquivosimovel,
								str_diretorioarquivosimovel
							) VALUES 
							(
								 *".$intCodigo."*,
								 *".$this->id_imovel."*,
								'".$this->codifiStringInterfaceBanco($objConexao,$this->str_arquivosImovel)."',
								'".basename($this->codifiStringInterfaceBanco($objConexao,$this->str_diretorioArquivosImovel))."'
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
					$this->apagaArquivoDiretorio($this->str_diretorioArquivosImovel);
	?>
					<script>
						alertMenssage ('Atenção:','Este Imovel já ultrapassou o limiti de arquivos. \nInforme outro imovel para cadastrar outros arquivos.');
					</script>
	<?php return false;	
				}					
			}else
			{
				$this->apagaArquivoDiretorio($this->str_diretorioArquivosImovel);
?>
				<script>
					alertMenssage ('Atenção:','O nome deste arquivo já existe. \nInforme outro nome para este arquivo.');
				</script>
<?php return false;	
			}
		}
		
		public function alterarArquivosImovel($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_arquivosimovel from msf.arquivosimovel where id_arquivosimovel = ".$this->id_arquivosImovel;
			$queryOriginal 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($queryOriginal) > 0)
			{
				$sql	=  "SELECT id_arquivosimovel from msf.arquivosimovel where str_arquivosimovel = '".$this->str_arquivosImovel."' and id_arquivosimovel != ".$this->id_arquivosImovel;
				$query 	= $objConexao->executaSQL($sql);

				if ($objConexao->contaLinhas($query) == 0)//Verifica se o molde esta alterando o nome pra algum já existente.
				{
					$sql = "UPDATE msf.arquivosimovel SET
								id_imovel					= *".$this->id_imovel."*,
								str_arquivosimovel			= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_arquivosImovel)."',
								str_diretorioarquivosimovel	= '".basename($this->codifiStringInterfaceBanco($objConexao,$this->str_diretorioArquivosImovel))."'
							where id_arquivosimovel = ".$this->id_arquivosImovel;
					$sql = str_replace(array("''","**"),"null",$sql);
					$sql = str_replace("*","",$sql);
					
					if ($objConexao->executaSQL($sql))
					{
						if ($this->str_diretorioArquivosImovel != $this->str_diretorioArquivosImovelAux)
						{
							$this->apagaImagemSubstituida($objConexao, $queryOriginal, 'str_diretorioarquivosimovel', FALSE, 'arquivosImovel/');
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
							alertMenssage ('Atenção:','Já existe um outro arquivo com este nome. \nInforme outro nome.');
						</script>
<?php return false;	
				}
				
			}else
			{
?>
					<script>
						alertMenssage ('Atenção:','Este arquivo não foi localizado para ser alterado.<br>Selecione outro arquivo.');
					</script>
<?php return false;	
			}
		}
		
		public function excluirArquivosImovel($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_arquivosimovel from msf.arquivosimovel where id_arquivosimovel = ".$this->id_arquivosImovel;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "DELETE FROM msf.arquivosimovel where id_arquivosimovel = ".$this->id_arquivosImovel;
				if ($objConexao->executaSQL($sql))
				{
					$this->apagaArquivoDiretorio($this->str_diretorioArquivosImovel, TRUE);//apaga arquivo arquivo.
					$this->inicializaVariaveis($this->id_imovel);
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
						alertMenssage ('Atenção:','Não existe nenhum arquivo com este nome. <br>Selecione outro arquivo.');
					</script>
<?php return false;	
			}
		}		

	}
?>