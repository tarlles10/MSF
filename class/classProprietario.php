<?php class proprietario extends FuncoesComum 
	{
		private function atribuirViaPost()
		{
			$this->id_proprietario					= $this->sequenceCrypt($_POST["id_proprietario"], $_POST["codSecFormulario"], false);
			$this->str_nomeProprietario				= $this->sequenceCrypt($_POST["str_nomeProprietario"], $_POST["codSecFormulario"], false);
			$this->str_profissaoProprietario		= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_profissaoProprietario"], $_POST["codSecFormulario"], false));
			$this->str_cpfProprietario				= $this->sequenceCrypt($_POST["str_cpfProprietario"], $_POST["codSecFormulario"], false);
			$this->str_nacionalidadeProprietario	= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_nacionalidadeProprietario"], $_POST["codSecFormulario"], false));
			$this->str_naturalidadeProprietario		= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_naturalidadeProprietario"], $_POST["codSecFormulario"], false));
			
			$this->str_complemento					= $this->sequenceCrypt($_POST["str_complemento"], $_POST["codSecFormulario"], false);
			$this->str_uf							= $this->sequenceCrypt($_POST["slc_uf"], $_POST["codSecFormulario"], false);
			$this->id_municipio						= $this->sequenceCrypt($_POST["slc_municipios"], $_POST["codSecFormulario"], false);
			$this->str_municipios					= $this->sequenceCrypt($_POST["str_municipios"], $_POST["codSecFormulario"], false);
			$this->id_bairro						= $this->sequenceCrypt($_POST["slc_bairro"], $_POST["codSecFormulario"], false);
			$this->id_numeroCep						= $this->sequenceCrypt($_POST["slc_descricaoLogradouro"], $_POST["codSecFormulario"], false);			
			
			$this->str_telResidencialProprietario	= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_telResidencialProprietario"], $_POST["codSecFormulario"], false));
			$this->str_telComercialProprietario		= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_telComercialProprietario"], $_POST["codSecFormulario"], false));
			$this->str_telCelularProprietario		= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_telCelularProprietario"], $_POST["codSecFormulario"], false));
			$this->str_emailProprietario			= $this->removeLixoDecriptVazio(strtolower($this->sequenceCrypt($_POST["str_emailProprietario"], $_POST["codSecFormulario"], false)));
			
			
			//variaveis visualizar de campos
			$this->bln_verTelResidencialProprietario	= $this->sequenceCrypt($_POST["chk_verTelResidencialProprietario"], $_POST["codSecFormulario"], false);
			$this->bln_verTelComercialProprietario		= $this->sequenceCrypt($_POST["chk_verTelComercialProprietario"], $_POST["codSecFormulario"], false);
			$this->bln_verTelCelularProprietario		= $this->sequenceCrypt($_POST["chk_verTelCelularProprietario"], $_POST["codSecFormulario"], false);
			$this->bln_verEmailProprietario				= $this->sequenceCrypt($_POST["chk_verEmailProprietario"], $_POST["codSecFormulario"], false);
			
			$this->bln_verTelResidencialProprietarioAux	= $this->bln_verTelResidencialProprietario == 't'?'true':'';
			$this->bln_verTelComercialProprietarioAux	= $this->bln_verTelComercialProprietario == 't'?'true':'';
			$this->bln_verTelCelularProprietarioAux		= $this->bln_verTelCelularProprietario == 't'?'true':'';
			$this->bln_verEmailProprietarioAux			= $this->bln_verEmailProprietario == 't'?'true':'';
			
			$condicaoVerTelResidencialProprietario	= ($this->bln_verTelResidencialProprietario != 't');
			$condicaoVerTelComercialProprietario	= ($this->bln_verValorImovel != 't');
			$condicaoVerTelCelularProprietario	= ($this->bln_verValorImovel != 't');
			$condicaoVerEmailProprietario	= ($this->bln_verValorImovel != 't');
			
			$this->str_DisableTelResidencialProprietario = $condicaoVerTelResidencialProprietario==true?'style="width: 95px; filter: Alpha(Opacity=25);" disabled="disabled"':'style="width: 95px;"';
			$this->str_DisableTelComercialProprietario = $condicaoVerTelComercialProprietario==true?'style="width: 95px; filter: Alpha(Opacity=25);" disabled="disabled"':'style="width: 95px;"';
			$this->str_DisableTelCelularProprietario = $condicaoVerTelCelularProprietario==true?'style="width: 95px; filter: Alpha(Opacity=25);" disabled="disabled"':'style="width: 95px;"';
			$this->str_DisableEmailProprietario = $condicaoVerEmailProprietario==true?'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"':'style="width: 125px;"';
		}

		public function inicializaVariaveis()
		{
			$this->id_proprietario					= "";
			$this->str_nomeProprietario				= "";
			$this->str_profissaoProprietario		= "";
			$this->str_cpfProprietario				= "";
			$this->str_nacionalidadeProprietario	= "";
			$this->str_naturalidadeProprietario		= "";
			$this->str_telResidencialProprietario	= "";
			$this->str_telComercialProprietario		= "";
			$this->str_telCelularProprietario		= "";
			$this->str_emailProprietario			= "";
			
			$this->str_complemento					= "";
			$this->str_uf							= "";
			$this->id_municipio						= "";
			$this->str_municipios					= "";
			$this->id_bairro						= "";
			$this->str_bairro						= "";
			$this->id_numeroCep						= "";
			$this->str_descricaoLogradouro			= "";
			$this->str_descricaoTipo				= "";			
			
			//variaveis visualizar de campos
			$this->bln_verTelResidencialProprietario= "t";
			$this->bln_verTelComercialProprietario	= "t";
			$this->bln_verTelCelularProprietario	= "t";
			$this->bln_verEmailProprietario			= "t";
			
			$this->bln_verTelResidencialProprietarioAux	= $this->bln_verTelResidencialProprietario == 't'?'true':'';
			$this->bln_verTelComercialProprietarioAux	= $this->bln_verTelComercialProprietario == 't'?'true':'';
			$this->bln_verTelCelularProprietarioAux		= $this->bln_verTelCelularProprietario == 't'?'true':'';
			$this->bln_verEmailProprietarioAux			= $this->bln_verEmailProprietario == 't'?'true':'';
			
			$this->str_DisableTelResidencialProprietario= 'style="width: 95px;"';
			$this->str_DisableTelComercialProprietario 	= 'style="width: 95px;"';
			$this->str_DisableTelCelularProprietario 	= 'style="width: 95px;"';
			$this->str_DisableEmailProprietario			= 'style="width: 125px;"';
		}

		public function atribuirQueryMunicipios($objConexao, $int_codigo)
		{
			$query = $this->consultaMunicipios($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);

			$this->str_uf						= $this->codifiStringBancoInterface($objConexao,$array["str_uf"]);
			$this->id_municipio					= $this->codifiStringBancoInterface($objConexao,$array["id_municipio"]);
			$this->str_municipios				= $this->codifiStringBancoInterface($objConexao,$array["str_municipios"]);
			$this->id_bairro					= $this->codifiStringBancoInterface($objConexao,$array["id_bairro"]);
			$this->str_bairro					= $this->codifiStringBancoInterface($objConexao,$array["str_bairro"]);
			$this->id_numeroCep					= $this->codifiStringBancoInterface($objConexao,$array["id_numerocep"]);
			$this->str_descricaoLogradouro		= $this->codifiStringBancoInterface($objConexao,$array["str_descricaologradouro"]);
			$this->str_descricaoTipo			= $this->codifiStringBancoInterface($objConexao,$array["str_descricaotipo"]);
		}

		public function atribuirQuery($objConexao, $int_codigo)
		{
			$query = $this->consultaProprietario($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);
			
			$this->atribuirQueryMunicipios($objConexao, $array["id_numerocep"]);

			$this->id_proprietario					= $array["id_proprietario"];
			$this->str_nomeProprietario				= $this->codifiStringBancoInterface($objConexao,$array["str_nomeproprietario"]);
			$this->str_profissaoProprietario		= $this->codifiStringBancoInterface($objConexao,$array["str_profissaoproprietario"]);
			$this->str_cpfProprietario				= $array["str_cpfproprietario"];
			$this->str_nacionalidadeProprietario	= $this->codifiStringBancoInterface($objConexao,$array["str_nacionalidadeproprietario"]);
			$this->str_naturalidadeProprietario		= $this->codifiStringBancoInterface($objConexao,$array["str_naturalidadeproprietario"]);
			
			$this->str_complemento					= $this->codifiStringBancoInterface($objConexao,$array["str_complemento"]);
			
			$this->str_telResidencialProprietario	= $array["str_telresidencialproprietario"];
			$this->str_telComercialProprietario		= $array["str_telcomercialproprietario"];
			$this->str_telCelularProprietario		= $array["str_telcelularproprietario"];
			$this->str_emailProprietario			= $array["str_emailproprietario"];
			
			
			//variaveis visualizar de campos
			$this->bln_verTelResidencialProprietario= $array["bln_vertelresidencialproprietario"];
			$this->bln_verTelComercialProprietario	= $array["bln_vertelcomercialproprietario"];
			$this->bln_verTelCelularProprietario	= $array["bln_vertelcelularproprietario"];
			$this->bln_verEmailProprietario			= $array["bln_veremailproprietario"];
			
			$this->bln_verTelResidencialProprietarioAux	= $this->bln_verTelResidencialProprietario == 't'?'true':'';
			$this->bln_verTelComercialProprietarioAux	= $this->bln_verTelComercialProprietario == 't'?'true':'';
			$this->bln_verTelCelularProprietarioAux		= $this->bln_verTelCelularProprietario == 't'?'true':'';
			$this->bln_verEmailProprietarioAux			= $this->bln_verEmailProprietario == 't'?'true':'';
			
			$condicaoVerTelResidencialProprietario	= ($this->bln_verTelResidencialProprietario != 't');
			$condicaoVerTelComercialProprietario	= ($this->bln_verTelComercialProprietario != 't');
			$condicaoVerTelCelularProprietario		= ($this->bln_verTelCelularProprietario != 't');
			$condicaoVerEmailProprietario			= ($this->bln_verEmailProprietario != 't');
			
			$this->str_DisableTelResidencialProprietario = $condicaoVerTelResidencialProprietario==true?'style="width: 95px; filter: Alpha(Opacity=25);" disabled="disabled"':'style="width: 95px;"';
			$this->str_DisableTelComercialProprietario = $condicaoVerTelComercialProprietario==true?'style="width: 95px; filter: Alpha(Opacity=25);" disabled="disabled"':'style="width: 95px;"';
			$this->str_DisableTelCelularProprietario = $condicaoVerTelCelularProprietario==true?'style="width: 95px; filter: Alpha(Opacity=25);" disabled="disabled"':'style="width: 95px;"';
			$this->str_DisableEmailProprietario = $condicaoVerEmailProprietario==true?'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"':'style="width: 125px;"';			
		}

		private function consultaProprietario($objConexao,$int_codigo)	
		{
			$sql = "SELECT * from msf.proprietario where id_proprietario =".$int_codigo;
			return	$objConexao->executaSQL($sql);		
		}

		public function comboProprietario($objConexao, $id_proprietario='')
		{
			if ($id_proprietario == '')
			{
				$sql = "SELECT id_proprietario, str_nomeproprietario from msf.proprietario order by str_nomeproprietario";	
			}else
			{
				$sql = "SELECT id_proprietario, str_nomeproprietario from msf.proprietario where id_proprietario =".$id_proprietario." order by str_nomeproprietario";	
			}
			return	$objConexao->executaSQL($sql);
		}		

		private function consultaMunicipios($objConexao, $int_codigo)
		{
			$sql = "SELECT 
						str_uf,  
						BA.id_municipio as id_municipio , 
						str_municipios, 
						BA.id_bairro, 
						BA.str_bairro, 
						id_numerocep, 
						str_descricaologradouro, 
						str_descricaotipo 
					from msf.municipio MU 
						left join msf.bairro BA on (MU.id_municipio=BA.id_municipio) 
						left join msf.logradouro LO on (BA.id_bairro=LO.id_bairro)
					where id_numerocep = ".$int_codigo;

			return	$objConexao->executaSQL($sql);
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

		public function cadastrarProprietario($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT str_cpfproprietario from msf.proprietario where str_cpfproprietario = '".$this->str_cpfProprietario."'";
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) == 0)
			{
				$intCodigo = $this->atualizadorSequence($objConexao, "proprietario", "proprietario_id_proprietario_seq");
				$sql = "INSERT INTO msf.proprietario
						(
							id_proprietario,
							str_nomeproprietario,
							str_profissaoproprietario,
							str_cpfproprietario,
							str_nacionalidadeproprietario,
							str_naturalidadeproprietario,
							str_complemento,
							id_numerocep,
							str_telresidencialproprietario,
							str_telcomercialproprietario,
							str_telcelularproprietario,
							str_emailproprietario,
							bln_vertelresidencialproprietario,
							bln_vertelcomercialproprietario,
							bln_vertelcelularproprietario,
							bln_veremailproprietario
						) VALUES 
						(
							 *".$intCodigo."*,
							 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_nomeProprietario)."',
							 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_profissaoProprietario)."',						 
							 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_cpfProprietario)."',
							 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_nacionalidadeProprietario)."',
							 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_naturalidadeProprietario)."',
							 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_complemento)."',
							 *".$this->id_numeroCep."*,
							 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_telResidencialProprietario)."',
							 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_telComercialProprietario)."',
							 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_telCelularProprietario)."',
							 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_emailProprietario)."',
							 '".$this->bln_verTelResidencialProprietario."',
							 '".$this->bln_verTelComercialProprietario."',
							 '".$this->bln_verTelCelularProprietario."',
							 '".$this->bln_verEmailProprietario."'
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
?>
					<script>
						alertMenssage ('Atenção:','Existe já um proprietário com este cpf. <br>Informe outro proprietário.');
					</script>
<?php return false;	
			}
		}
		
		public function alterarProprietario($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_proprietario from msf.proprietario where id_proprietario = ".$this->id_proprietario;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql	=  "SELECT id_proprietario from msf.proprietario where str_cpfproprietario = '".$this->str_cpfProprietario."' and id_proprietario != ".$this->id_proprietario;
				$query = $objConexao->executaSQL($sql);
				if ($objConexao->contaLinhas($query) == 0)//Verifica se o proprietario esta alterando o cpf pra algum já existente.
				{
					$sql = "UPDATE msf.proprietario SET
								str_nomeproprietario			= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_nomeProprietario)."',
								str_profissaoproprietario		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_profissaoProprietario)."',	
								str_cpfproprietario				= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_cpfProprietario)."',
								str_nacionalidadeproprietario	= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_nacionalidadeProprietario)."',
								str_naturalidadeproprietario	= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_naturalidadeProprietario)."',
								str_complemento					= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_complemento)."', 
								id_numerocep					= *".$this->id_numeroCep."*,
								str_telresidencialproprietario	= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_telResidencialProprietario)."',
								str_telcomercialproprietario	= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_telComercialProprietario)."',
								str_telcelularproprietario		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_telCelularProprietario)."',
								str_emailproprietario			= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_emailProprietario)."',
								bln_vertelresidencialproprietario	= '".$this->bln_verTelResidencialProprietario."',
								bln_vertelcomercialproprietario		= '".$this->bln_verTelComercialProprietario."',
								bln_vertelcelularproprietario		= '".$this->bln_verTelCelularProprietario."',
								bln_veremailproprietario			= '".$this->bln_verEmailProprietario."'
							where id_proprietario = ".$this->id_proprietario;

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
							alertMenssage ('Atenção:','Já existe um outro proprietário com este cpf. <br>Informe outro cpf.');
						</script>
<?php return false;	
				}

			}else
			{
?>
					<script>
						alertMenssage ('Atenção:','Este proprietário não foi localizado para ser alterado. <br>Selecione outro proprietário.');
					</script>
<?php return false;	
			}
		}
		
		public function excluirProprietario($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_proprietario from msf.proprietario where id_proprietario = ".$this->id_proprietario;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "DELETE FROM msf.proprietario where id_proprietario = ".$this->id_proprietario;
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
						alertMenssage ('Atenção:','Este proprietário não foi localizado para ser excluído. <br>Selecione outro proprietário.');
					</script>
<?php return false;	
			}
		}		

	}
?>