<?php class municipios extends FuncoesComum 
	{
		private function atribuirViaPost()
		{
			$this->str_uf						= $this->sequenceCrypt($_POST["str_uf"], $_POST["codSecFormulario"], false);
			$this->id_municipio					= $this->sequenceCrypt($_POST["id_municipio"], $_POST["codSecFormulario"], false);
			$this->str_municipios				= $this->sequenceCrypt($_POST["str_municipios"], $_POST["codSecFormulario"], false);
			$this->id_bairro					= $this->sequenceCrypt($_POST["id_bairro"], $_POST["codSecFormulario"], false);
			$this->id_numeroCep					= $this->sequenceCrypt($_POST["id_numerocep"], $_POST["codSecFormulario"], false);
			$this->str_descricaoLogradouro		= $this->sequenceCrypt($_POST["str_descricaologradouro"], $_POST["codSecFormulario"], false);			
			$this->str_descricaoTipo			= $this->sequenceCrypt($_POST["str_descricaoTipo"], $_POST["codSecFormulario"], false);			
		}

		public function inicializaVariaveis()
		{
			$this->str_uf						= "";
			$this->id_municipio					= "";
			$this->str_municipios				= "";
			$this->id_bairro					= "";
			$this->id_numeroCep					= "";		
			$this->str_descricaoLogradouro		= "";
			$this->str_descricaoTipo			= "";
		}
		
		public function atribuirQuery($objConexao, $int_codigo)
		{
			$query = $this->consultaMunicipios($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);

			$this->str_uf						= $this->codifiStringBancoInterface($objConexao,$array["str_uf"]);
			$this->id_municipio					= $this->codifiStringBancoInterface($objConexao,$array["id_municipio"]);
			$this->str_municipios				= $this->codifiStringBancoInterface($objConexao,$array["str_municipios"]);
			$this->id_bairro					= $this->codifiStringBancoInterface($objConexao,$array["id_bairro"]);
			$this->id_numeroCep					= $this->codifiStringBancoInterface($objConexao,$array["id_numerocep"]);
			$this->str_descricaoLogradouro		= $this->codifiStringBancoInterface($objConexao,$array["str_descricaologradouro"]);
			$this->str_descricaoTipo			= $this->codifiStringBancoInterface($objConexao,$array["str_descricaotipo"]);
		}
		
		public function comboMunicipioAtribuirCep($objConexao , $id_logradouro)	
		{
			$sql = "SELECT str_uf,  BA.id_municipio as id_municipio, str_municipios, BA.id_bairro, id_numerocep, str_descricaologradouro, str_descricaotipo from 
					msf.municipio MU 
						inner join msf.bairro BA on (MU.id_municipio=BA.id_municipio) 
						inner join msf.logradouro LO on (BA.id_bairro=LO.id_bairro) 
					where LO.id_numerocep = ".$id_logradouro;

			$query = $objConexao->executaSQL($sql);
			$array = $objConexao->retornaArray($query);
			
			$this->str_uf						= $this->codifiStringBancoInterface($objConexao,$array["str_uf"]);
			$this->id_municipio					= $this->codifiStringBancoInterface($objConexao,$array["id_municipio"]);
			$this->str_municipios				= $this->codifiStringBancoInterface($objConexao,$array["str_municipios"]);
			$this->id_bairro					= $this->codifiStringBancoInterface($objConexao,$array["id_bairro"]);
			$this->id_numeroCep					= $this->codifiStringBancoInterface($objConexao,$array["id_numerocep"]);
			$this->str_descricaoLogradouro		= $this->codifiStringBancoInterface($objConexao,$array["str_descricaologradouro"]);
			$this->str_descricaoTipo			= $this->codifiStringBancoInterface($objConexao,$array["str_descricaotipo"]);
		}		
		
		public function comboUF($objConexao)
		{
			$sql = "SELECT distinct str_uf from msf.municipio order by str_uf";	
			return	$objConexao->executaSQL($sql);
		}

		public function comboMunicipio($objConexao, $str_uf)
		{
			$sql = "SELECT id_municipio, str_municipios from msf.municipio where str_uf = '".$str_uf."' order by str_municipios";
			return	$objConexao->executaSQL($sql);
		}		

		public function comboBairro($objConexao, $id_municipio)
		{
			$sql = "SELECT id_municipio, id_bairro, str_bairro from msf.bairro where id_municipio = ".$id_municipio." order by str_bairro";
			return	$objConexao->executaSQL($sql);
		}
		
		public function comboLogradouro($objConexao, $id_bairro)
		{
			$sql = "SELECT id_numerocep, str_descricaologradouro from msf.logradouro where id_bairro = ".$id_bairro." order by str_descricaologradouro";
			return	$objConexao->executaSQL($sql);
		}

		private function consultaMunicipios($objConexao,$int_codigo)	
		{
			$sql = "SELECT str_uf,  BA.id_municipio as id_municipio , str_municipios, BA.id_bairro, id_numerocep, str_descricaologradouro, str_descricaotipo from 
					msf.municipio MU 
						inner join msf.bairro BA on (MU.id_municipio=BA.id_municipio) 
						inner join msf.logradouro LO on (BA.id_bairro=LO.id_bairro) 
					where BA.id_municipio =".$int_codigo;
			return	$objConexao->executaSQL($sql);		
		}
		
		public function cadastrarMunicipios($objConexao)
		{
			$this->atribuirViaPost();
			
			$sql	=  "SELECT id_municipio from msf.municipio where str_bairro = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_bairro)."'";

			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) == 0)
			{
				$intCodigo = $this->atualizadorSequence($objConexao, "municipio", "municipio_id_municipio_seq");
				$sql = "INSERT INTO msf.municipio
						(
							id_municipio,
							str_municipios,
							str_codibge,
							str_uf,
							str_descricaologradouro,
							str_bairro
						) VALUES 
						(
							*".$intCodigo."*,
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_municipios)."',
							'".$this->str_uf."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_descricaoLogradouro)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_bairro)."'
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
						alertMenssage ('Atenção:','Existe já um bairro com este nome. <br>Informe outro bairro.');
					</script>
<?php return false;	
			}
		}
		
		public function alterarMunicipios($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_municipio from msf.municipio where id_municipio = ".$this->id_municipio;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "UPDATE msf.municipio SET
							str_municipios				= '".$this->codifiStringInterfaceBanco($objConexao, $this->str_municipios)."',
							str_uf						= '".$this->str_uf."',
							str_descricaologradouro		= '".$this->codifiStringInterfaceBanco($objConexao, $this->str_descricaoLogradouro)."',
							str_bairro					= '".$this->codifiStringInterfaceBanco($objConexao, $this->str_bairro)."'
						where id_municipio 				= ".$this->id_municipio;
				$sql = str_replace(array("''","**"),"null",$sql);
				$sql = str_replace("*","",$sql);		
				if ($objConexao->executaSQL($sql))
				{
					$this->inicializaVariaveis();
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
						alertMenssage ('Atenção:','Este bairro não foi localizado para ser alterado. <br>Selecione outro bairro.');
					</script>
<?php return false;	
			}
		}
		
		public function excluirMunicipios($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_municipio from msf.municipio where id_municipio = ".$this->id_municipio;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "DELETE FROM msf.municipio where id_municipio = ".$this->id_municipio;
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
						alertMenssage ('Atenção:','Não existe nenhum bairro com este nome. <br>Selecione outro bairro.');
					</script>
<?php return false;	
			}
		}		
	}
?>