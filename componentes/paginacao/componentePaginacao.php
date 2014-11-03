<?php class CPaginacao
	{
		public function CPaginacao()
		{
			
		}
		
		private function comunicaComponenteTR($str_caminhoComponente)
		{			
			if($str_caminhoComponente != "")
			{
				if(file_exists($str_caminhoComponente))
				{
?>
<table width="766" border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td width=="7"></td>
		<td colspan="11" height="5"></td>
		<td height="5"></td>
	</tr>
	<tr>
    	<td></td>
		<td colspan="2" class="top_grupoRes_top_01"></td>
		<td colspan="2" class="top_grupoRes_top_02"><span class="adm_fonteResTop_01">Resultado da Busca</span></td>
		<td class="top_grupoRes_top_03"></td>
		<td class="top_grupoRes_top_04" style="width:196px;"><span class="adm_fonteResTop_02">Ordenar por :</span><?php $this->comboOrdenacao();?>
		</td>
		<td width="23" class="top_grupoRes_top_05"></td>
		<td colspan="2" rowspan="2" class="top_grupoRes_top_06" style="width: 281px;"><span class="adm_fonteResTop_03">Quantidade de Resultados na Tela:</span><?php $this->comboRegistroTela();?></td>
		<td colspan="2" rowspan="2" class="top_grupoRes_top_07"></td>
		<td height="24"></td>
	</tr>
	<tr>
		<td></td>
        <td class="top_grupoRes_top_08"></td>
		<td colspan="6" class="top_grupoRes_top_09"></td>
		<td height="11"></td>
	</tr>
<?php include ($str_caminhoComponente);
					return true;					
				}
				else
				{
					//============================================================================//
					//    Mostra que o componente referenciado nao existe ou nao foi localizado   //
					//============================================================================//				
?>
					<table width="766" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width=="7"></td>
							<td colspan="11" height="5"></td>
							<td height="5"></td>
						</tr>
						<tr>
							<td></td>
							<td colspan="2" class="top_grupoRes_top_01"></td>
							<td colspan="2" class="top_grupoRes_top_02"><span class="adm_fonteResTop_01">Resultado da Busca</span></td>
							<td class="top_grupoRes_top_03"></td>
							<td class="top_grupoRes_top_04" style="width:196px;"></td>
							<td width="22" class="top_grupoRes_top_05"></td>
							<td colspan="2" rowspan="2" class="top_grupoRes_top_06" style="width: 281px;"></td>
							<td colspan="2" rowspan="2" class="top_grupoRes_top_07"></td>
							<td height="24"></td>
						</tr>
						<tr>
							<td></td>
							<td class="top_grupoRes_top_08"></td>
							<td colspan="6" class="top_grupoRes_top_09"></td>
							<td height="11"></td>
						</tr>
						<tr>
							<td></td>
							<td class="med_grupoRes_E"></td>
							<td colspan="2"></td>
							<td colspan="7" width="627" height="100" class="adm_fonteFormGrupo_01" align="right">Esse componente não existe.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		</td>
							<td class="med_grupoRes_D"></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td colspan="2" class="boton_grupoRes_E"></td>
							<td colspan="7" class="boton_grupoRes_M" style="width: 739px;"></td>
							<td colspan="2" class="boton_grupoRes_D"></td>
							<td height="15"></td>
						</tr>
						<tr>
							<td></td>
							<td width="3"></td>
							<td width="5"></td>
							<td width="117"></td>
							<td width="92"></td>
							<td width="31"></td>
							<td width="195"></td>
							<td colspan="2" width="23"></td>
							<td width="281"></td>
							<td width="5"></td>
							<td width="3"></td>
							<td width="5"></td>
						</tr>
<?php return false;
				}
			}
		}
		
		public function mostraRegistroPaginadoComponenteTR($objConexao,$objConfiguracao,$query, $str_caminhoComponente)
		{	
			if($this->comunicaComponenteTR($str_caminhoComponente))
			{
				if($query['query'] != "")
				{
					$this->inicializaPaginacao($objConexao,$query);
				}
?>
				<script>
					function atribuiPaginacao($int_paginacao, $slc_totalRegistrosTela, $slc_ordenacao)
					{
						d = document.frm;
						if ($int_paginacao == undefined)
						{
							var $int_paginacao = d.int_paginacao.value;
						}
						if ($slc_totalRegistrosTela == undefined)
						{
							//Concatena a string da Ordenacao
							var $arrayNome 	= new Array ('"','', '"');
							var $arrayValor = new Array ('',document.getElementById('slc_totalRegistrosTela').value,'');
							var $slc_totalRegistrosTela = retornaUrlAjax('', $arrayNome, $arrayValor);
						}
						if ($slc_ordenacao == undefined)
						{
							//Concatena a string da Ordenacao
							var $arrayNome 	= new Array ('"','', '"');
							var $arrayValor = new Array ('',document.getElementById('slc_ordenacao').value,'');
							var $valorOrdenacao = retornaUrlAjax('', $arrayNome, $arrayValor);
						}

						var $arrayNome 	= new Array ('int_paginacao','slc_totalRegistrosTela', 'slc_ordenacao');
						var $arrayValor = new Array ($int_paginacao, $slc_totalRegistrosTela, $valorOrdenacao);
						carregarPaginacao('grupoBase', retornaUrlAjax('ajaxComponenteResultados.php', $arrayNome, $arrayValor), 'Carregando os Resultados...', 'Resultado');
					}
					
					function atribuiPaginacaoComboBox()
					{
						//Concatena a string da Ordenacao
						var $arrayNome 	= new Array ('"','', '"');
						var $arrayValor = new Array ('',document.getElementById('slc_ordenacao').value,'');
						$valorOrdenacao = retornaUrlAjax('', $arrayNome, $arrayValor);
						
						//concatena os nomes de variaveis aos respectivos valores
						$arrayNome 	= new Array ('int_paginacao','slc_totalRegistrosTela', 'slc_ordenacao');
						$arrayValor = new Array (1, document.getElementById('slc_totalRegistrosTela').value, $valorOrdenacao);
						
						//carrega novamente os registros
						carregarPaginacao('grupoBase', retornaUrlAjax('ajaxComponenteResultados.php', $arrayNome, $arrayValor), 'Carregando os Resultados...', 'Resultado');
						window.location ='#grupoBase';
					}
				</script>
				<input name="int_paginacao" id="int_paginacao" type="hidden" value="<?php echo $_POST["int_paginacao"];?>" >
<?php while (($this->contador <= $this->totalRegistros) and ($this->contador >= $this->primeiro and $this->contador <= $this->ultimo)) 
				{
					$cont++;
					cPaginacaoResultado($objConexao, $objConfiguracao, $this->query, $cont);	
					$this->contador++;
				}
				
				if($this->totalRegistros > 0)
				{
					$this->mostraPaginacao();
				}
			}
		}		
		
		public function verificaPost()
		{
			if($_POST["int_paginacao"] != "" || $_POST["slc_totalRegistrosTela"] != "")
			{
				return true;
			}
			else
			{
				return false;
			}
		}
				
		private function inicializarValores()
		{
			$this->pagina 					= $_POST['int_paginacao'];
			$this->totalRegistrosTela 		= $_POST['slc_totalRegistrosTela'];	
			$this->OrdenacaoRegistrosTela	= $_POST['slc_ordenacao'];	
			
			if($this->totalRegistrosTela == "")
			{
				$this->totalRegistrosTela = 5;
			}
			
		}
		
		public function inicializaPaginacao($objConexao,$query)
		{
			$this->inicializarValores();
			
			$this->query				= $query['query'];
			$this->totalRegistros		= $query['numRegistro'];
			$this->totalPaginas			= ceil($this->totalRegistros / $this->totalRegistrosTela);
			
			if (empty($this->pagina) or $this->pagina == 1) 
			{ 
				$this->pagina 	= 1;
				$this->primeiro = 1;
			} else 
			{
				$this->pagina 	= $_POST['int_paginacao'];
				$this->primeiro = $this->totalRegistrosTela * ($this->pagina - 1) + 1; 
			}
		
			$this->ultimo 	= $this->totalRegistrosTela * $this->pagina;
			$this->contador = $this->primeiro;			
		}		
		
		public function mostraPaginacao()
		{
?>
			<tr>
				<td></td>
				<td colspan="2" class="boton_grupoRes_E"></td>
				<td colspan="7" class="boton_grupoRes_M" style="width: 739px;"></td>
				<td colspan="2" class="boton_grupoRes_D"></td>
				<td height="15"></td>
			</tr>
			<tr>
				<td></td>
				<td width="3"></td>
				<td width="5"></td>
				<td width="117"></td>
				<td width="92"></td>
				<td width="31"></td>
				<td width="195"></td>
				<td colspan="2" width="23"></td>
				<td width="281"></td>
				<td width="5"></td>
				<td width="3"></td>
				<td width="5"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="11" height="21" align="center" class="adm_fonteTextoGrupo_01" style="text-align:center;">
<?php $pontosFrente 	= "";
			$pontosTras 	= "";
	
			if($this->pagina > 9)
			{
				$pontosTras 	= "...";				
			}

			if(($this->pagina + 9) < $this->totalPaginas)
			{
				$pontosFrente = "...";
			}				
			
			if ($this->pagina > 1) 
			{
				$anterior = $this->pagina - 1;
?>
				<a href='#grupoBase' onClick="atribuiPaginacao('1')">Primeira</a> - 
				<a href='#grupoBase' onClick="atribuiPaginacao('<?php echo $anterior;?>')">Anterior</a> - <?php echo $pontosTras;?>
<?php }			
			
			if($this->pagina > 9)
			{			
			
				if(($this->pagina + 9) <= $this->totalPaginas)
				{
					$contador = $this->pagina;
					$limiteContador = $this->pagina + 9;					
				}
				else
				{
					$contador 		= $this->totalPaginas-9;
					$limiteContador = $this->totalPaginas;
				}				
			}
			else						
			{
				$contador = 1;
				$limiteContador = 10;
			}
			
			while ($contador <= $this->totalPaginas) 
			{				
				if ($contador == $this->pagina) 
				{
?>
					<font color="#8F8F8F">[ <b><?php echo $contador;?></b> ]</font>
<?php }
				else if($contador <= $limiteContador) 
				{					
?>
					[ <a href='#grupoBase' onClick="atribuiPaginacao('<?php echo $contador;?>')"><?php echo $contador;?></a> ]
<?php }
		  
				$contador++;
			}
		
			if ($this->pagina < $this->totalPaginas) 
			{
				$proxima = $this->pagina + 1;
?>		  
				<?php echo $pontosFrente;?> - <a href='#grupoBase' onClick='atribuiPaginacao("<?php echo $proxima;?>")'>Próxima</a> - <a href='#grupoBase' onClick='atribuiPaginacao("<?php echo $this->totalPaginas;?>")'>Última</a>
<?php }
					
?>
				</td>
				<td height="21"></td>
			</tr>
<?php }
		
		public function limpar()
		{
			$_POST["slc_totalRegistrosTela"] = "";
			$_POST["slc_ordenacao"] 		 = "";
			$_POST["int_paginacao"] 		 = "";			
		}
		
		private function comboOrdenacao()
		{
			$this->inicializarValores();
			
			$arrayOrdenacao[0] = '';
			$arrayOrdenacao[1] = 'Mais Procurados';
			$arrayOrdenacao[2] = 'Mais Visitados';
			$arrayOrdenacao[3] = 'Maior Preco';
			$arrayOrdenacao[4] = 'Menor Preco';
			$arrayOrdenacao[5] = 'Tipo de Imovel';
			$arrayOrdenacao[6] = 'Tipo de Negocio';
			$arrayOrdenacao[7] = 'Bairro';

?>
			  <select name="slc_ordenacao" id="slc_ordenacao" class="adm_formResCombo_01" style="width:105" onchange="atribuiPaginacaoComboBox();">
<?php for($i=0; $i <sizeof($arrayOrdenacao); $i++)
			{
				$selected = "";
				
				if($this->OrdenacaoRegistrosTela == $arrayOrdenacao[$i])
				{
					$selected = "selected='selected'";
				}
?>
				<option value="<?php echo $arrayOrdenacao[$i];?>" <?php echo $selected;?> title="<?php echo $arrayOrdenacao[$i];?>"><?php echo $arrayOrdenacao[$i];?></option>
<?php }
?>
			</select>
<?php }		
		
		private function comboRegistroTela()
		{
			$this->inicializarValores();
			
			$array[0] = 10;
			$array[1] = 50;
			$array[2] = 100;
			$array[3] = 150;
			$array[4] = 5;
			sort($array);
?>
			  <select name="slc_totalRegistrosTela" id="slc_totalRegistrosTela" class="adm_formResCombo_01" onchange="atribuiPaginacaoComboBox();">
<?php for($i=0; $i <sizeof($array); $i++)
			{
				$selected = "";
				
				if($this->totalRegistrosTela == $array[$i])
				{
					$selected = "selected='selected'";
				}
?>
				<option value="<?php echo $array[$i];?>" <?php echo $selected;?>><?php echo $array[$i];?></option>
<?php }
?>
			</select>
<?php }
	}
?>