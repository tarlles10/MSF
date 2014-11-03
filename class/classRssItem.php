<?php class rssfeeditem extends FuncoesComum 
	{
		private function atribuirViaPost()
		{
			$this->id_rssItem					= $this->sequenceCrypt($_POST["id_rssitem"], $_POST["codSecFormulario"], false);
			$this->id_rss						= $this->sequenceCrypt($_POST["id_rss"], $_POST["codSecFormulario"], false);
			$this->str_tituloItem				= $this->sequenceCrypt($_POST["str_tituloItem"], $_POST["codSecFormulario"], false);
			$this->str_descricaoItem			= nl2br($this->retornoDescricoesValidas($this->sequenceCrypt($_POST["str_descricaoItem"], 2, false)));
			$this->dt_publicacao				= $this->converteDataBanco($this->sequenceCrypt($_POST["str_dtPublicacao"], $_POST["codSecFormulario"], false)).' '.date('H:i:s');

		}

		public function inicializaVariaveis($id_rss = '')
		{
			$this->id_rssItem					= "";
			$this->id_rss						= $id_rss!=''?$id_rss:'';
			$this->str_tituloItem				= "";
			$this->str_descricaoItem			= "";
			$this->dt_publicacao				= "";
		}
		
		public function atribuirQuery($objConexao, $int_codigo)
		{
			$query = $this->consultaRssFeedItem($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);
			
			$this->id_rss						= $array["id_rss"];
			$this->str_tituloItem				= $this->codifiStringBancoInterface($objConexao, $array["str_tituloitem"]);
			$this->str_descricaoItem			= $this->codifiStringBancoInterface($objConexao, $array["str_descricaoitem"]);
			$this->dt_publicacao				= $this->retornaDataNumerica($array["dt_publicacao"], 'DATA_COMPLETA');
			
		}
	

		private function consultaRssFeedItem($objConexao,$int_codigo)	
		{
			$sql = "SELECT * from msf.rssitem where id_rssitem =".$int_codigo;
			return	$objConexao->executaSQL($sql);		
		}
		
		public function cadastrarRssFeedItem($objConexao)
		{
			$this->atribuirViaPost();
			
			$sql	=  "SELECT id_rssitem from msf.rssitem where str_tituloitem = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_tituloItem)."'";

			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) == 0)
			{
				$intCodigo = $this->atualizadorSequence($objConexao, "rssitem", "rssitem_id_rssitem_seq");
				$sql = "INSERT INTO msf.rssitem
						(
							id_rssitem,
							id_rss,
							str_tituloitem,
							str_descricaoitem,
							dt_publicacao
						) VALUES 
						(
							*".$intCodigo."*,
							*".$this->id_rss."*,
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
						alertMenssage ('Atenção:','Existe já uma notícia com este título. <br>Informe outra notícia.');
					</script>
<?php return false;	
			}
		}
		
		public function alterarRssFeedItem($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_rssitem from msf.rssitem where id_rssitem = ".$this->id_rssItem;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "UPDATE msf.rssitem SET
							id_rss				= *".$this->id_rss."*,
							str_tituloitem		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_tituloItem)."',
							str_descricaoitem	= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_descricaoItem)."',
							dt_publicacao		= '".$this->dt_publicacao."'
						where id_rssitem = ".$this->id_rssItem;
				
				$sql = str_replace(array("''","**"),"null",$sql);
				$sql = str_replace("*","",$sql);
					
				if ($objConexao->executaSQL($sql))
				{
					$this->inicializaVariaveis($this->id_rss);
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
						alertMenssage ('Atenção:','Esta notícia não foi localizada para ser alterado. <br>Selecione outro notícia.');
					</script>
<?php return false;	
			}
		}
		
		public function excluirRssFeedItem($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_rssitem from msf.rssitem where id_rssitem = ".$this->id_rssItem;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "DELETE FROM msf.rssitem where id_rssitem = ".$this->id_rssItem;
				if ($objConexao->executaSQL($sql))
				{
					$this->inicializaVariaveis($this->id_rss);
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
						alertMenssage ('Atenção:','Não existe nenhuma notícia com este nome. <br>Selecione outro notícia.');
					</script>
<?php return false;	
			}
		}		

	}
?>