<?php class construtora extends FuncoesComum 
	{
		private function atribuirViaPost()
		{
			$this->id_construtora				= $this->sequenceCrypt($_POST["id_construtora"], $_POST["codSecFormulario"], false);
			$this->str_construtora				= $this->sequenceCrypt($_POST["str_construtora"], $_POST["codSecFormulario"], false);
			$this->str_empreendimento			= $this->sequenceCrypt($_POST["str_empreendimento"], $_POST["codSecFormulario"], false);
		}

		public function inicializaVariaveis()
		{
			$this->id_construtora				= "";
			$this->str_construtora				= "";
			$this->str_empreendimento			= "";
		}
		
		public function atribuirQuery($objConexao, $int_codigo)
		{
			$query = $this->consultaConstrutora($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);

			$this->str_construtora				= $this->codifiStringBancoInterface($objConexao,$array["str_construtora"]);
			$this->str_empreendimento			= $this->codifiStringBancoInterface($objConexao,$array["str_empreendimento"]);
		}

		private function consultaConstrutora($objConexao,$int_codigo)	
		{
			$sql = "SELECT * from msf.construtora where id_construtora =".$int_codigo;
			return	$objConexao->executaSQL($sql);		
		}
		
		public function cadastrarConstrutora($objConexao)
		{
			$this->atribuirViaPost();
			
			$sql	=  "SELECT id_construtora from msf.construtora where str_construtora = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_construtora)."' && str_empreendimento = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_empreendimento)."'";

			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) == 0)
			{
				$intCodigo = $this->atualizadorSequence($objConexao, "construtora", "construtora_id_construtora_seq");
				$sql = "INSERT INTO msf.construtora
						(
							id_construtora,
							str_construtora,
							str_empreendimento
						) VALUES 
						(
							 *".$intCodigo."*,
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_construtora)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_empreendimento)."'
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
						alertMenssage ('Atenção:','O nome deste empreendimento já existe para esta construtora. <br>Informe outro empreendimento ou outra construtora.');
					</script>
<?php return false;	
			}
		}
		
		public function alterarConstrutora($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_construtora from msf.construtora where id_construtora = ".$this->id_construtora;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "UPDATE msf.construtora SET
							str_construtora		= '".$this->codifiStringInterfaceBanco($objConexao, $this->str_construtora)."',
							str_empreendimento	= '".$this->codifiStringInterfaceBanco($objConexao, $this->str_empreendimento)."'
						where id_construtora = ".$this->id_construtora;
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
						alertMenssage ('Atenção:','Esta construtora não foi localizada para ser alterada. <br>Selecione uma outra construtora.');
					</script>
<?php return false;	
			}
		}
		
		public function excluirConstrutora($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_construtora from msf.construtora where id_construtora = ".$this->id_construtora;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "DELETE FROM msf.construtora where id_construtora = ".$this->id_construtora;
				if ($objConexao->executaSQL($sql))
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
						alertMenssage ('Atenção:','Não existe nenhuma construtora com este nome. <br>Selecione outra construtora.');
					</script>
<?php return false;	
			}
		}		

	}
?>