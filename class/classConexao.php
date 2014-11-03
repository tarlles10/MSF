<?php
	class Conexao
	{
		private $host, $user, $password, $post, $tipo;
		private $base, $conectado, $baseSelecionada;
			
		public function Conexao($base = "",$tipo = "") 
		{
			$this->tipoBanco($tipo);
			$this->dataBase($base);
		}

		private function dataBase($base)
		{
			if($base == "")
			{
				$this->alertMenssage('A base de dados não foi escolhida.');
				exit();
			}
			else
			{
				$this->base = $base;
			}
		}

		private function tipoBanco($tipo)
		{	
			if($tipo == 'mysql')
			{
				$this->host 	= '';
				$this->user		= '';
				$this->password = '';
				$this->port		= '3600';
			}
			else if($tipo == 'postgre')
			{
				$this->host 	= 'localhost'; //
				$this->user		= 'designcontexto';
				$this->password = 'dospro10';
				$this->port		= '5432';
			}
			else
			{
				$this->msgBancoDadosError($tipo);
			}
			
			$this->tipo = $tipo;
		}
		
		public function forcaTipoBancoManual($tipo="",$host="",$user="",$password="",$port="")
		{
			$count = 0;
			
			$array[0][0]	= $tipo;
			$array[0][1]	= "Tipo de banco.";
			$array[1][0]	= $host;
			$array[1][1]	= "Endereço host";
			$array[2][0]	= $user;
			$array[2][1]	= "Usuário";
			$array[3][0]	= $password;
			$array[3][1]	= "Senha";
			$array[4][0]	= $port;
			$array[4][1]	= "Porta de conexão";
			
			while($count < sizeof($array))
			{
				if($array[$count] == "")
				{
					$this->alertMenssage('É necessário setar todas configurações. <br>Variável-> '.$array[$count][1].', vazia.');
					exit();				
				}
			}
								
			$this->tipo 	= $array[0];
			$this->host 	= $array[1];
			$this->user		= $array[2];
			$this->password = $array[3];
			$this->port		= $array[4];
		}
				
		public function iniciaConexao()
		{
			if($this->tipo == "mysql")
			{
				$this->conectado		= $this->mysqlConecta();
				$this->baseSelecionada  = $this->mysqlSelecionaDB();
			}
			else if($this->tipo == "postgre")
			{
				$this->conectado		= $this->postgreConecta();
				$this->baseSelecionada  = true;
			}
			else
			{
				$this->msgBancoDadosError($this->tipo);
			}
			
			if(!($this->conectado))
			{
				$this->alertMenssage('Não conectou no banco ( '.$this->tipo.' ).');
				exit();
			}
			else
			{			
				if (!($this->baseSelecionada))
				{
					$this->alertMenssage('Não selecionou a base de dados ( '.$this->base.' ).');
					exit();
				}				
			}
		}
		
		public function executaSQL($sql, $msg = "")
		{
			
			if($this->tipo == "mysql")
			{
				$query = $this->mysqlExecutaSQL($sql);
			}
			else if($this->tipo == "postgre")
			{
				$query = $this->postgreExecutaSQL($sql);
			}
			else
			{
				$this->msgBancoDadosError($this->tipo);
			}
			return ($query);
		}
		
		public function fechaConexao()
		{
			if($this->tipo == "mysql")
			{
				$fechaConexao = $this->mysqlFechaConexao();
			}
			else if($this->tipo == "postgre")
			{
				$fechaConexao = $this->postgreFechaConexao();
			}
			else
			{
				$this->msgBancoDadosError($this->tipo);
			}
			
			if(!($fechaConexao))
			{
				$this->alertMenssage('Não conseguiu fechar a conexão do banco ( '.$tipo.' ).');
				exit();
			}			
		}
		
		public function contaLinhas($query)
		{
			if($this->tipo == "mysql")
			{
				$contaLinhas = $this->mysqlContaLinhas($query);
			}
			else if($this->tipo == "postgre")
			{
				$contaLinhas = $this->postgreContaLinhas($query);
			}
			else
			{
				$this->msgBancoDadosError($this->tipo);
			}
			
			return $contaLinhas;
		}
		
		public function contaCampos($query)
		{
			if($this->tipo == "mysql")
			{
				$contaCampos = $this->mysqlContaCampos($query);
			}
			else if($this->tipo == "postgre")
			{
				$contaCampos = $this->postgreContaCampos($query);
			}
			else
			{
				$this->msgBancoDadosError($this->tipo);
			}
			
			return $contaCampos;
		}		

		public function codificacaoBanco()
		{
			if($this->tipo == "mysql")
			{
				$codificacaoBanco = $this->mysqlCodificacao();
			}
			else if($this->tipo == "postgre")
			{
				$codificacaoBanco = $this->postgreCodificacao();
			}
			else
			{
				$this->msgBancoDadosError($this->tipo);
			}
			
			return $codificacaoBanco;
		}
		
		public function retornaArray($query)
		{
			if($this->tipo == "mysql")
			{
				$retornaArray = $this->mysqlRetornaArray($query);
			}
			else if($this->tipo == "postgre")
			{
				$retornaArray = $this->postgreRetornaArray($query);
			}
			else
			{
				$this->msgBancoDadosError($this->tipo);
			}
			
			return $retornaArray;
		}
		
		public function retornaObjeto($query)
		{
			if($this->tipo == "mysql")
			{
				$retornaObjeto = $this->mysqlRetornaObjeto($query);
			}
			else if($this->tipo == "postgre")
			{
				$retornaObjeto = $this->postgreRetornaObjeto($query);
			}
			else
			{
				$this->msgBancoDadosError($this->tipo);
			}
						
			return $retornaObjeto;
		}

		public function getContadorQuery()
		{
			if($this->tipo == "mysql")
			{
				return $this->mysqlContador;
			}
			else if($this->tipo == "postgre")
			{
				return $this->postgreContador;
			}
			else
			{
				$this->msgBancoDadosError($this->tipo);
			}
		}
		 
		private function msgBancoDadosError($tipo)
		{
			if($tipo == "")
			{
				$this->alertMenssage('O banco de dados não foi escolhido.');
				exit();
			}
			else
			{
				$this->alertMenssage('Não existe configuração para o tipo de banco de dados escolhido.');
				exit();			
			}
		}

		private function alertMenssage($menssagem)
		{
			header("Content-Type: text/html; charset=ISO-8859-1",true);

			$nome_arquivo = basename($_SERVER['SCRIPT_NAME']);
			if (substr($nome_arquivo, 0, 4) == 'adm_')
			{
				$diretorios = '../';
			}else
			{
				$diretorios = '';
			}			
?>
			<style type="text/css">body{margin-left:0px;margin-top:0px;margin-right:0px;margin-bottom:0px;font-size:10px;}</style>
			<link rel="stylesheet" type="text/css" href="<?php echo $diretorios;?>js/css/black-tie/jquery-ui-1.7.1.custom.css">
			<script src  ="<?php echo $diretorios;?>js/jquery-ui/jquery-1.3.2.min.js"	></script> 
			<script src  ="<?php echo $diretorios;?>js/jquery-ui/jquery-ui-1.7.1.js"	></script>
			<script src  ="<?php echo $diretorios;?>js/comuns/alertMenssage.js"			></script>
            <body>
            	<div id="menssagem"  style="display:none;"></div>
            </body>
            <script>
                alertMenssage ('Atenção:','<?php echo $menssagem;?>');
            </script>
			
<?php echo"<div align='center' align='center'><img src='ParkImovel.jpg'></div><div align='center' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&copy; ParkImovel, 2008</div><br /><br /><br /><div  class='  ' style='color: #000000;' align='center' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;ESTA CONTA ESTÁ EM MANUTENÇÃO PARA MELHOR ATENDELO. ENTRE EM CONTATO COM O SUPORTE PARA MAIORES INFORMAÇÕES.</div>"; exit();
		}


//-------------------------------------- Funções Mysql --------------------------------------\\		
		
		private function mysqlSelecionaDB()
		{
			return mysql_select_db($this->base,$this->conectado);
		}
		
		private function mysqlConecta()
		{
			$this->mysqlContador++;
			return mysql_connect($this->host,$this->user,$this->password);
		}

		private function mysqlCodificacao()
		{
			return 'SQL_ASCII';
		}
		
		public function mysqlGetContadorQuery()
		{
			return $this->mysqlContador;
		}
		
		private function mysqlExecutaSQL($sql)
		{
			return mysql_query($this->baseSelecionada,$sql);
		}	
		
		private function mysqlContaLinhas($query)
		{
			return mysql_num_rows($query);
		}

		private function mysqlContaCampos($query)
		{
			return mysql_num_fields($query);
		}		

		private function mysqlRetornaArray($query)
		{
			return mysql_fetch_array($query);
		}
		
		private function mysqlRetornaObjeto($query)
		{
			return mysql_fetch_object($query);
		}
		
		private function mysqlFechaConexao()
		{
			return mysql_close($this->conectado);		
		}
		
//-------------------------------------- Funções Postgre --------------------------------------\\

		private function postgreConecta()
		{
			return pg_connect("host=".$this->host." port=".$this->port." dbname=".$this->base." user=".$this->user." password=".$this->password."");
		}
				
		private function postgreExecutaSQL($sql)
		{
			$this->postgreContador++;
			//echo $sql.'<br \>';
			return pg_query($this->conectado,$sql);
		}

		private function postgreCodificacao()
		{
			return pg_client_encoding ($this->conectado);
		}

		public function postgreGetContadorQuery()
		{
			return $this->postgreContador;
		}
		
		public function postgreContaLinhas($query)
		{
			return pg_num_rows($query);
		}
		
		public function postgreCampos($query)
		{
			return pg_num_fields($query);
		}		
		
		public function postgreRetornaArray($query)
		{
			return pg_fetch_array($query);
		}
		
		public function postgreRetornaObjeto($query)
		{
			return pg_fetch_object($query);
		}		
		
		public function retornoSelect($sql , $retornoLinha = "")
		{
			$query = $this->executaSQL($sql);
			$linhas = $this->contaLinhas($query);

			if ($linhas <= 0)
			{
				$resultado = "";
			} else 
			{
				$resultado = pg_fetch_result($query,0,0);
			}
			if ($retornoLinha != "")
			{
				return $linhas;
			} else
			{
				return $resultado;
			}
		}

		public function verificaRegistro($tabela, $campo, $condicional, $valor , $objConexao, $bln_mostraMsg = false)
		{
			if ($condicional == "") $condicional = $campo;
			$str_verifica = "SELECT $campo from $tabela where $condicional = '$valor'";
			
			$resultado = $objConexao->retornoSelect($str_verifica);
			if ($resultado != "")
			{
				if ($bln_mostraMsg != false)
				{
					$this->alertMenssage('Já existe o '.$bln_mostraMsg.' '.$valor.' cadastrado! <br>Informe outro '.$bln_mostraMsg.' !');
				}
			}
			return $resultado;
		}
		
		public function retornaResultado($query,$rows,$field)
		{
			return pg_fetch_result($query,$rows,$field);
		}
		
		private function postgreFechaConexao()
		{
			return pg_close($this->conectado);		
		}		
	}
?>