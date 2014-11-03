<?php class planoContratos extends FuncoesComum 
	{
		private function atribuirViaPost()
		{
			$this->id_plano						= $this->sequenceCrypt($_POST["id_plano"], $_POST["codSecFormulario"], false);
			$this->str_nomePlano				= $this->sequenceCrypt($_POST["str_nomePlano"], $_POST["codSecFormulario"], false);
			$this->bln_tipoInforme				= $this->sequenceCrypt($_POST["rdb_tipoInforme"], $_POST["codSecFormulario"], false);
			$this->int_quantidadeInformes		= $this->sequenceCrypt($_POST["slc_quantidadeInformes"], $_POST["codSecFormulario"], false);
			$this->bln_tipoBanner				= $this->sequenceCrypt($_POST["rdb_tipoBanner"], $_POST["codSecFormulario"], false);
			$this->int_quantidadeThemas			= $this->sequenceCrypt($_POST["slc_quantidadeThemas"], $_POST["codSecFormulario"], false);
			$this->bln_quantidadeVisitas		= $this->sequenceCrypt($_POST["rdb_quantidadeVisitas"], $_POST["codSecFormulario"], false);
			$this->bln_quantidadeBuscas			= $this->sequenceCrypt($_POST["rdb_quantidadeBuscas"], $_POST["codSecFormulario"], false);
			$this->bln_construtoras				= $this->sequenceCrypt($_POST["rdb_construtoras"], $_POST["codSecFormulario"], false);
			$this->bln_empreendimentos			= $this->sequenceCrypt($_POST["rdb_empreendimentos"], $_POST["codSecFormulario"], false);
			$this->bln_subTipoImovel			= $this->sequenceCrypt($_POST["rdb_subTipoImovel"], $_POST["codSecFormulario"], false);
			$this->bln_valorIptu				= $this->sequenceCrypt($_POST["rdb_valorIptu"], $_POST["codSecFormulario"], false);
			$this->bln_valorCondominio			= $this->sequenceCrypt($_POST["rdb_valorCondominio"], $_POST["codSecFormulario"], false);
			$this->bln_sala						= $this->sequenceCrypt($_POST["rdb_sala"], $_POST["codSecFormulario"], false);
			$this->bln_banheiro					= $this->sequenceCrypt($_POST["rdb_banheiro"], $_POST["codSecFormulario"], false);
			$this->bln_suite					= $this->sequenceCrypt($_POST["rdb_suite"], $_POST["codSecFormulario"], false);
			$this->bln_garagem					= $this->sequenceCrypt($_POST["rdb_garagem"], $_POST["codSecFormulario"], false);
			$this->bln_uf						= $this->sequenceCrypt($_POST["rdb_uf"], $_POST["codSecFormulario"], false);
			$this->bln_municipio				= $this->sequenceCrypt($_POST["rdb_municipio"], $_POST["codSecFormulario"], false);
			$this->bln_dtEntrega				= $this->sequenceCrypt($_POST["rdb_dtEntrega"], $_POST["codSecFormulario"], false);
			$this->bln_pacoteDiluido			= $this->sequenceCrypt($_POST["chk_pacoteDiluido"], $_POST["codSecFormulario"], false);
			
			$this->str_valorPacoteSistema		= $this->MascaraValor($this->sequenceCrypt($_POST["str_valorPacoteSistema"], $_POST["codSecFormulario"], false));
			$this->str_valorMensalSistema		= $this->MascaraValor($this->sequenceCrypt($_POST["str_valorMensalSistema"], $_POST["codSecFormulario"], false));
			
			if ($this->bln_pacoteDiluido == 'TRUE')
			{
				$this->str_valorPacoteSistemaAux	= 0;
				$this->str_valorMensalSistemaAux	= $this->str_valorMensalSistema + intval($this->sequenceCrypt($_POST["str_valorMensalSistema"], $_POST["codSecFormulario"], false)/12);
				$this->bln_pacoteDiluidoAux = 'true';
			}else
			{
				$this->str_valorPacoteSistemaAux	= $this->str_valorPacoteSistema;
				$this->str_valorMensalSistemaAux	= $this->str_valorMensalSistema;
				$this->bln_pacoteDiluidoAux = '';
			}
		}

		public function inicializaVariaveis()
		{

			$this->id_plano						= "";
			$this->str_nomePlano				= "";
			$this->bln_tipoInforme				= "f";
			$this->int_quantidadeInformes		= "1";
			$this->bln_tipoBanner				= "f";
			$this->int_quantidadeThemas			= "1";
			$this->bln_quantidadeVisitas		= "f";
			$this->bln_quantidadeBuscas			= "f";
			$this->bln_construtoras				= "f";
			$this->bln_empreendimentos			= "f";
			$this->bln_subTipoImovel			= "f";
			$this->bln_valorImovel				= "f";
			$this->bln_valorIptu				= "f";
			$this->bln_valorCondominio			= "f";
			$this->bln_sala						= "f";
			$this->bln_banheiro					= "f";
			$this->bln_suite					= "f";
			$this->bln_garagem					= "f";
			$this->bln_uf						= "f";
			$this->bln_municipio				= "f";
			$this->bln_dtEntrega				= "f";
			$this->bln_pacoteDiluido			= "f";
			$this->str_valorPacoteSistema		= "120,00";
			$this->str_valorMensalSistema		= "10,00";

			$this->str_valorPacoteSistemaAux	= $this->str_valorPacoteSistema;
			$this->str_valorMensalSistemaAux	= $this->str_valorMensalSistema;
			$this->bln_pacoteDiluidoAux 		= "";			
		}
		
		public function atribuirQuery($objConexao, $int_codigo)
		{
			$query = $this->consultaPlano($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);
			
			$this->str_nomePlano				= $this->codifiStringBancoInterface($objConexao,$array["str_nomeplano"]);
			$this->bln_tipoInforme				= $array["bln_tipoinforme"];
			$this->int_quantidadeInformes		= $array["int_quantidadeinformes"];
			$this->bln_tipoBanner				= $array["bln_tipobanner"];
			$this->int_quantidadeThemas			= $array["int_quantidadethemas"];
			$this->bln_quantidadeVisitas		= $array["bln_quantidadevisitas"];
			$this->bln_quantidadeBuscas			= $array["bln_quantidadebuscas"];
			$this->bln_construtoras				= $array["bln_construtoras"];
			$this->bln_empreendimentos			= $array["bln_empreendimentos"];
			$this->bln_subTipoImovel			= $array["bln_subtipoimovel"];
			$this->bln_valorIptu				= $array["bln_valoriptu"];
			$this->bln_valorCondominio			= $array["bln_valorcondominio"];
			$this->bln_sala						= $array["bln_sala"];
			$this->bln_banheiro					= $array["bln_banheiro"];
			$this->bln_suite					= $array["bln_suite"];
			$this->bln_garagem					= $array["bln_garagem"];
			$this->bln_uf						= $array["bln_uf"];
			$this->bln_municipio				= $array["bln_municipio"];
			$this->bln_dtEntrega				= $array["bln_dtentrega"];
			$this->bln_pacoteDiluido			= $array["bln_pacotediluido"];
			$this->str_valorPacoteSistema		= $this->MascaraValorTela($array["str_valorpacotesistema"]);
			$this->str_valorMensalSistema		= $this->MascaraValorTela($array["str_valormensalsistema"]);

			if ($this->bln_pacoteDiluido == 't')
			{
				$this->str_valorPacoteSistemaAux	= 0;
				$this->str_valorMensalSistemaAux	= $this->MascaraValorTela($array["str_valormensalsistema"] + intval($array["str_valorpacotesistema"]/12));
				$this->bln_pacoteDiluidoAux = 'true';
			}else
			{
				$this->str_valorPacoteSistemaAux	= $this->MascaraValorTela($array["str_valorpacotesistema"]);
				$this->str_valorMensalSistemaAux	= $this->MascaraValorTela($array["str_valormensalsistema"]);
				$this->bln_pacoteDiluidoAux = '';
			}
			
			
		}
		
		private function consultaPlano($objConexao,$int_codigo)	
		{
			$sql = "SELECT * from msf.plano where id_plano =".$int_codigo;
			return	$objConexao->executaSQL($sql);		
		}
		
		public function cadastrarPlanoContratos($objConexao)
		{
			$this->atribuirViaPost();
			
			$sql	=  "SELECT id_plano from msf.plano where str_nomePlano = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_nomePlano)."'";
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) == 0)
			{
				$intCodigo = $this->atualizadorSequence($objConexao, "plano", "plano_id_plano_seq");
				$sql = "INSERT INTO msf.plano
						(
							id_plano, 
							str_nomeplano, 
							bln_tipoinforme, 
							int_quantidadeinformes, 
							bln_tipobanner, 
							int_quantidadethemas, 
							bln_quantidadevisitas, 
							bln_quantidadebuscas, 
							bln_construtoras, 
							bln_empreendimentos, 
							bln_subtipoimovel, 
							bln_valoriptu, 
							bln_valorcondominio, 
							bln_sala, 
							bln_banheiro, 
							bln_suite, 
							bln_garagem, 
							bln_uf, 
							bln_municipio, 
							bln_dtentrega, 
							bln_pacotediluido, 
							str_valorpacotesistema, 
							str_valormensalsistema
						) VALUES 
						(
							*".$intCodigo."*,
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_nomePlano)."', 
							'".$this->bln_tipoInforme."', 
							*".$this->int_quantidadeInformes."*,
							'".$this->bln_tipoBanner."',
							*".$this->int_quantidadeThemas."*, 
							'".$this->bln_quantidadeVisitas."', 
							'".$this->bln_quantidadeBuscas."', 
							'".$this->bln_construtoras."', 
							'".$this->bln_empreendimentos."', 
							'".$this->bln_subTipoImovel."', 
							'".$this->bln_valorIptu."', 
							'".$this->bln_valorCondominio."', 
							'".$this->bln_sala."', 
							'".$this->bln_banheiro."', 
							'".$this->bln_suite."', 
							'".$this->bln_garagem."', 
							'".$this->bln_uf."', 
							'".$this->bln_municipio."', 
							'".$this->bln_dtEntrega."', 
							'".$this->bln_pacoteDiluido."', 
							'".$this->str_valorPacoteSistema."', 
							'".$this->str_valorMensalSistema."'
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
						alertMenssage ('Atenção:','Existe já um plano com este nome. <br>Informe outro nome para este plano.');
					</script>
<?php return false;	
			}
		}
		
		public function alterarPlanoContratos($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_plano from msf.plano where id_plano = ".$this->id_plano;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "UPDATE msf.plano SET
							str_nomeplano			= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_nomePlano)."', 
							bln_tipoinforme			= '".$this->bln_tipoInforme."',
							int_quantidadeinformes	= *".$this->int_quantidadeInformes."*, 
							bln_tipobanner			= '".$this->bln_tipoBanner."',
							int_quantidadethemas	= *".$this->int_quantidadeThemas."*,
							bln_quantidadevisitas	= '".$this->bln_quantidadeVisitas."', 
							bln_quantidadebuscas	= '".$this->bln_quantidadeBuscas."',
							bln_construtoras		= '".$this->bln_construtoras."', 
							bln_empreendimentos		= '".$this->bln_empreendimentos."',
							bln_subtipoimovel		= '".$this->bln_subTipoImovel."',
							bln_valoriptu			= '".$this->bln_valorIptu."', 
							bln_valorcondominio		= '".$this->bln_valorCondominio."',
							bln_sala				= '".$this->bln_sala."', 
							bln_banheiro			= '".$this->bln_banheiro."',
							bln_suite				= '".$this->bln_suite."', 
							bln_garagem				= '".$this->bln_garagem."',
							bln_uf					= '".$this->bln_uf."', 
							bln_municipio			= '".$this->bln_municipio."',
							bln_dtentrega			= '".$this->bln_dtEntrega."',
							bln_pacotediluido		= '".$this->bln_pacoteDiluido."',
							str_valorpacotesistema	= '".$this->str_valorPacoteSistema."',
							str_valormensalsistema	= '".$this->str_valorMensalSistema."'
						where id_plano = ".$this->id_plano;
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
						alertMenssage ('Atenção:','Este Plano não foi localizado para ser alterado. <br>Selecione outro plano.');
					</script>
<?php return false;	
			}
		}
		
		public function excluirPlanoContratos($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_plano from msf.plano where id_plano = ".$this->id_plano;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "DELETE FROM msf.plano where id_plano = ".$this->id_plano;
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
						alertMenssage ('Atenção:','Não existe nenhum plano com este nome. <br>Selecione outro plano.');
					</script>
<?php return false;	
			}
		}		

	}
?>