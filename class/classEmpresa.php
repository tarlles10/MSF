<?php class empresa extends FuncoesComum 
	{
		private function atribuirViaPost()
		{
			$this->id_empresa					= $this->sequenceCrypt($_POST["id_empresa"], $_POST["codSecFormulario"], false);
			$this->id_configuracao				= $this->sequenceCrypt($_POST["id_configuracao"], $_POST["codSecFormulario"], false);
			$this->str_tituloItem				= $this->sequenceCrypt($_POST["str_tituloItem"], $_POST["codSecFormulario"], false);
			$this->str_descricaoItem			= nl2br($this->retornoDescricoesValidas($this->sequenceCrypt($_POST["str_descricaoItem"], 2, false)));
			$this->dt_publicacao				= $this->converteDataBanco($this->sequenceCrypt($_POST["str_dtPublicacao"], $_POST["codSecFormulario"], false)).' '.date('H:i:s');

		}

		public function inicializaVariaveis($id_configuracao = '')
		{
			$this->id_empresa					= "";
			$this->id_configuracao				= $id_configuracao!=''?$id_configuracao:'';
			$this->str_tituloItem				= "";
			$this->str_descricaoItem			= "";
			$this->dt_publicacao				= "";
		}
		
		public function atribuirQuery($objConexao, $int_codigo)
		{
			$query = $this->consultaEmpresa($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);
			
			$this->id_configuracao				= $array["id_configuracao"];
			$this->str_tituloItem				= $this->codifiStringBancoInterface($objConexao, $array["str_tituloitem"]);
			$this->str_descricaoItem			= $this->codifiStringBancoInterface($objConexao, $array["str_descricaoitem"]);
			$this->dt_publicacao				= $this->retornaDataNumerica($array["dt_publicacao"], 'DATA_COMPLETA');
			
		}

		public function atribuirInformeEmpresa($objConexao, $int_codigo)
		{
			$query = $this->consultaEmpresa($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);

			$this->dt_publicacao				= $this->retornaDataNumerica($array["dt_publicacao"], 'DATA_COMPLETA');
			$this->str_tituloItem				= $array["str_tituloitem"];
			$this->str_descricaoItem			= $array["str_descricaoitem"];
		}

		public function getDt_publicacao()
		{
			return $this->dt_publicacao;
		}
		
		public function getTituloItem()
		{
			return $this->str_tituloItem;
		}
		
		public function getDescricaoItem()
		{
			return $this->str_descricaoItem;
		}

		private function consultaEmpresa($objConexao,$int_codigo)	
		{
			$sql = "SELECT * from msf.empresa where id_empresa =".$int_codigo;
			return	$objConexao->executaSQL($sql);		
		}
		
		public function cadastrarEmpresa($objConexao)
		{
			$this->atribuirViaPost();
			
			$sql	=  "SELECT id_empresa from msf.empresa where str_tituloitem = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_tituloItem)."'";

			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) == 0)
			{
				$intCodigo = $this->atualizadorSequence($objConexao, "empresa", "empresa_id_empresa_seq");
				$sql = "INSERT INTO msf.empresa
						(
							id_empresa,
							id_configuracao,
							str_tituloitem,
							str_descricaoitem,
							dt_publicacao
						) VALUES 
						(
							*".$intCodigo."*,
							*".$this->id_configuracao."*,
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_tituloItem)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_descricaoItem)."',
							'".$this->dt_publicacao."'
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
						alertMenssage ('Atenção:','Existe já um dado institucional com este título. <br>Informe outra dado institucional.');
					</script>
<?php return false;	
			}
		}
		
		public function alterarEmpresa($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_empresa from msf.empresa where id_empresa = ".$this->id_empresa;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "UPDATE msf.empresa SET
							id_configuracao				= *".$this->id_configuracao."*,
							str_tituloitem		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_tituloItem)."',
							str_descricaoitem	= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_descricaoItem)."',
							dt_publicacao		= '".$this->dt_publicacao."'
						where id_empresa = ".$this->id_empresa;
				
				$sql = str_replace(array("''","**"),"null",$sql);
				$sql = str_replace("*","",$sql);
					
				if ($objConexao->executaSQL($sql))
				{
					$this->inicializaVariaveis($this->id_configuracao);
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
						alertMenssage ('Atenção:','Este dado institucional não foi localizado para ser alterado. <br>Selecione outro dado institucional.');
					</script>
<?php return false;	
			}
		}
		
		public function excluirEmpresa($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_empresa from msf.empresa where id_empresa = ".$this->id_empresa;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "DELETE FROM msf.empresa where id_empresa = ".$this->id_empresa;
				if ($objConexao->executaSQL($sql))
				{
					$this->inicializaVariaveis($this->id_configuracao);
?>
					<script>
						alertMenssage ('Aviso:','nExcluído com sucesso.');
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
						alertMenssage ('Atenção:','Não existe nenhuma dado institucional com este nome. <br>Selecione outro dado institucional.');
					</script>
<?php return false;	
			}
		}		

	}
?>