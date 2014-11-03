<?php class CPaginacaoGaleria
	{
		public function CPaginacaoGaleria()
		{
			
		}
		
		public function consultaImovelPaginacaoGaleria($objConexao, $int_codigo)	
		{
			$sql = "SELECT 	
							IMO.id_imovel,						IMO.id_proprietario,
							IMO.str_tipoimovel,					IMO.str_subtipoimovel,
							IMO.str_situacaoimovel,				IMO.str_mobiliado,
							IMO.int_quarto,						IMO.int_sala,
							IMO.int_banheiro,					IMO.int_suite,
							IMO.int_garagem,					IMO.str_areaprivativa,
							IMO.str_areaterreno,				IMO.str_areatotal,
							IMO.str_unidadeprivativa,			IMO.str_unidadeterreno,
							IMO.str_unidadetotal,				IMO.str_tiponegocio,
							IMO.str_subtiponegocio,				IMO.str_valorimovel,
							IMO.str_valoriptu,					IMO.str_valorcondominio,
							IMO.str_valortaxasextras,			IMO.bln_vervalorimovel,
							IMO.bln_vervaloroutros,				IMO.str_descricaoimovel,
							IMO.dt_entrega,						IMO.str_construtora,
							IMO.str_empreendimento,				IMO.str_posicaosatelite,
							IMO.bln_promocao,					IMO.dt_publicacao,
							IMO.bln_ativo,						BAI.id_bairro,
							BAI.str_bairro,						IMA.id_imagensimovel,
							IMA.id_imovel,						IMA.str_imagensimovel,
							IMA.str_diretorioimagensimovel
					from msf.imagensimovel 			IMA
						left join msf.imovel		IMO on (IMA.id_imovel = IMO.id_imovel)
						left join msf.bairro 		BAI on (IMO.id_bairro=BAI.id_bairro)
					where IMO.bln_ativo = TRUE and IMA.id_imovel = *".$int_codigo."* order by IMA.id_imagensimovel";
			$sql = str_replace(array("''","**"),"null",$sql);
			$sql = str_replace("*","",$sql);					
			return	$objConexao->executaSQL($sql);		
		}
		
		private function comunicaComponenteGaleriaTR($objConfiguracao, $str_caminhoComponente)
		{			
			if($str_caminhoComponente != "")
			{
				if(file_exists($str_caminhoComponente))
				{
					include ($str_caminhoComponente);
					return true;					
				}
				else
				{
					//============================================================================//
					//    Mostra que o componente referenciado nao existe ou nao foi localizado   //
					//============================================================================//				
		echo	"<table width='577' border='0' cellpadding='0' cellspacing='0'>
					<tr>
						<td rowspan='7' style='background-repeat: no-repeat;'>
							<table width='458' height='342' border='0' cellpadding='0' cellspacing='0'>
								<tr>
									<td width='8' class='top_grupoRes_top_01'></td>
									<td width='261' class='top_grupoRes_top_02' style='width:261px;'><span class='adm_fonteResTop_01'>Galeria de Imagens</span></td>
									<td width='31' class='top_grupoRes_top_03'></td>
									<td width='63' class='top_grupoRes_top_04'></td>
									<td width='95'><img src='".$objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeMostraGaleria_01()."' width='95' height='24'></td>
									<td height='24'></td>
								</tr>
								<tr>
								  <td colspan='5' width='458' height='342' class='adm_fonteFormGrupo_01' align='center'>Esse componente não existe.</td>
								  <td></td>
								  </tr>
								<tr>
								  <td width='8'></td>
								  <td width='261'></td>
								  <td width='31'></td>
								  <td width='63'></td>
								  <td width='95'></td>
								  <td></td>
							  </tr>
							</table>
						<!-- Fim Tabela Mostra Foto Grande -->
						</td>
						<td rowspan='7' width='8'></td>
						<td class='banner_molde_galeriaRes_02' background='".$objConfiguracao->getDirImovel().$objConfiguracao->getDirMiniImovel()."/semFoto.jpg'><img src='".$objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeMostraGaleria_02()."' width='111' height='89'></td>
						<td colspan='2' height='89'></td>
					</tr>
					<tr>
						<td height='3' colspan='2'></td>
						<td colspan='2' height='3'></td>
					</tr>
					<tr>
						<td class='banner_molde_galeriaRes_02' background='".$objConfiguracao->getDirImovel().$objConfiguracao->getDirMiniImovel()."/semFoto.jpg'><img src='".$objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeMostraGaleria_02()."' width='111' height='89'></td>
						<td colspan='2' height='89'></td>
					</tr>
					<tr>
						<td height='4'></td>
						<td height='4'></td>
						<td colspan='2' height='4'></td>
					</tr>
					<tr>
					  <td class='banner_molde_galeriaRes_02' background='".$objConfiguracao->getDirImovel().$objConfiguracao->getDirMiniImovel()."/semFoto.jpg'><img src='".$objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeMostraGaleria_02()."' width='111' height='89'></td>
						<td colspan='2' height='89'></td>
					</tr>
					<tr>
						<td height='4'></td>
						<td height='4'></td>
						<td colspan='2' height='4'></td>
					</tr>
					<tr>
					  <td background='".$objConfiguracao->getDirImovel().$objConfiguracao->getDirMiniImovel()."/semFoto.jpg' class='banner_molde_galeriaRes_02' ><img src='".$objConfiguracao->getDirMolde().$objConfiguracao->getDirMoldeMostraGaleria_02()."' width='111' height='89'></td>
						<td colspan='2' height='89'></td>
					</tr>
					<tr>
					  <td width='458'></td>
					  <td width='8'></td>
					  <td width='111'></td>
					  <td colspan='2'></td>
					</tr>
				</table>";
					return false;
				}
			}
		}
		
		public function mostraRegistroPaginadoComponenteTR($objConexao,$objConfiguracao,$query, $str_caminhoComponente)
		{	
			if($this->comunicaComponenteGaleriaTR($objConfiguracao, $str_caminhoComponente))
			{
				if($query != '')
				{
					$this->inicializaPaginacao($objConexao,$query);
				}
?>
				<script>
					function atribuiPaginacaoGaleria($int_paginacaoGaleria, $totalRegistrosTela)
					{
						d = document.frm;
						if ($int_paginacaoGaleria == undefined)
						{
							var $int_paginacaoGaleria = d.int_paginacaoGaleria.value;
						}
						
						var $arrayNome 	= new Array ('id_imovel','id_imagem','int_paginacaoGaleria');
						var $arrayValor = new Array ('<?php echo $_POST["id_imovel"];?>','<?php echo $_POST["id_imagem"];?>',$int_paginacaoGaleria);
						carregarPaginacao('galeriaFotos', retornaUrlAjax('ajaxComponenteGaleriaFotos.php', $arrayNome, $arrayValor), 'Carregando Galeria...');
					}
				</script>
				<input name='int_paginacaoGaleria' id='int_paginacaoGaleria' type='hidden' value='<?php echo $_POST['int_paginacaoGaleria'];?>' >
<?php cPaginacaoResultadoGaleria($objConexao, $objConfiguracao,$this,$this->query);
			}
		}		
				
		private function inicializarValores()
		{
			$this->pagina 				= $_POST['int_paginacaoGaleria'];
			$this->totalRegistrosTela 	= 4;			
		}
		
		public function inicializaPaginacao($objConexao,$query)
		{
			$this->inicializarValores();
			
			$this->query				= $query;
			$this->totalRegistros		= $objConexao->contaLinhas($this->query);
			$this->totalPaginas			= ceil($this->totalRegistros / $this->totalRegistrosTela);
			
			if ($this->totalPaginas > 1)
			{
				$this->bln_mostra = true;
			}else
			{
				$this->bln_mostra = false;
			}
			
			if (empty($this->pagina) or $this->pagina == 1) 
			{ 
				$this->pagina 	= 1;
				$this->primeiro = 1;
				
			} 
			else
			{
				$this->pagina 	= $_POST['int_paginacaoGaleria'];
				$this->primeiro = $this->totalRegistrosTela * ($this->pagina - 1) + 1;
			}
		
			$this->ultimo 	= $this->totalRegistrosTela * $this->pagina;
			$this->contador = $this->primeiro;			
		}		
		
		public function mostraPaginacao($objConfiguracao)
		{
			if($this->pagina > 2)
			{			
			
				if(($this->pagina + 2) <= $this->totalPaginas)
				{
					$contador 		= $this->pagina;
					$limiteContador = $this->pagina + 2;					
				}
				else
				{
					$contador 		= $this->totalPaginas-2;
					$limiteContador = $this->totalPaginas;
				}				
			}
			else						
			{
				$contador = 1;
				$limiteContador = 10;
			}
			
			if($this->bln_mostra)
			{
			
				if ($this->pagina == 1)
				{
					$proxima = $this->pagina + 1;
					
	?>
					<table width='100%' border='0' cellspacing='0' cellpadding='0'>
					  <tr>
						<td class='top_grupoRes_Btn_E2'></td>
						<td width='13'></td>
						<td width='19'>
							<!-- inicio Tabela Botoes GaleriaFoto Pequeno-->
							<table width='100%' border='0' cellspacing='0' cellpadding='0'>
							  <tr>
								 <td class='top_grupoRes_Btn_E'></td>
								<td width='7'></td>
								<td class='top_grupoRes_Btn_D' >
									<img src="<?php echo $objConfiguracao->getDirTheme();?>/top_grupoRes_Btn_D.gif" style="cursor: pointer;" width='5' height='8' onClick="atribuiPaginacaoGaleria('<?php echo $proxima;?>');" alt="Próxima">
								</td>
							  </tr>
							</table>
							<!-- Fim Tabela Botoes GaleriaFoto Pequeno -->
						</td>
						<td width='13'></td>
						<td class='top_grupoRes_Btn_D2'>
							<img src="<?php echo $objConfiguracao->getDirTheme();?>/top_grupoRes_Btn_D2.gif" style="cursor: pointer;" width='10' height='8' onClick="atribuiPaginacaoGaleria('<?php echo $this->totalPaginas;?>');" alt="Última">
						</td>
					  </tr>
					</table>
<?php }
	
				if (($this->pagina > 1) && ($this->pagina < $this->totalPaginas)) 
				{
		
					$anterior 	= $this->pagina - 1;
					$proxima 	= $this->pagina + 1;
?>
					<table width='100%' border='0' cellspacing='0' cellpadding='0'>
					  <tr>
						<td class='top_grupoRes_Btn_E2'>
							<img src="<?php echo $objConfiguracao->getDirTheme();?>/top_grupoRes_Btn_E2.gif" style="cursor: pointer;" width='10' height='8' onClick="atribuiPaginacaoGaleria('1');" alt="Primeira">
						</td>
						<td width='13'></td>
						<td width='19'>
							<!-- inicio Tabela Botoes GaleriaFoto Pequeno-->
							<table width='100%' border='0' cellspacing='0' cellpadding='0'>
							  <tr>
								 <td class='top_grupoRes_Btn_E'>
								<img src="<?php echo $objConfiguracao->getDirTheme();?>/top_grupoRes_Btn_E.gif" style="cursor: pointer;" width='5' height='8' onClick="atribuiPaginacaoGaleria('<?php echo $anterior;?>');" alt="Anterior">
								</td>
								<td width='7'></td>
								<td class='top_grupoRes_Btn_D' >
									<img src="<?php echo $objConfiguracao->getDirTheme();?>/top_grupoRes_Btn_D.gif" style="cursor: pointer;" width='5' height='8' onClick="atribuiPaginacaoGaleria('<?php echo $proxima;?>');" alt="Próxima">
								</td>
							  </tr>
							</table>
							<!-- Fim Tabela Botoes GaleriaFoto Pequeno -->
						</td>
						<td width='13'></td>
						<td class='top_grupoRes_Btn_D2'>
							<img src="<?php echo $objConfiguracao->getDirTheme();?>/top_grupoRes_Btn_D2.gif" style="cursor: pointer;" width='10' height='8' onClick="atribuiPaginacaoGaleria('<?php echo $this->totalPaginas;;?>');" alt="Última">
						</td>
					  </tr>
					</table>
<?php }
				
				if ($this->pagina == $this->totalPaginas) 
				{
				
				$anterior = $this->pagina - 1;
?>
				<table width='100%' border='0' cellspacing='0' cellpadding='0'>
				  <tr>
					<td class='top_grupoRes_Btn_E2'>
						<img src="<?php echo $objConfiguracao->getDirTheme();?>/top_grupoRes_Btn_E2.gif" style="cursor: pointer;" width='10' height='8' onClick="atribuiPaginacaoGaleria('1');" alt="Primeira">
					</td>
					<td width='13'></td>
					<td width='19'>
						<!-- inicio Tabela Botoes GaleriaFoto Pequeno-->
						<table width='100%' border='0' cellspacing='0' cellpadding='0'>
						  <tr>
							 <td class='top_grupoRes_Btn_E'>
							<img src="<?php echo $objConfiguracao->getDirTheme();?>/top_grupoRes_Btn_E.gif" style="cursor: pointer;" width='5' height='8' onClick="atribuiPaginacaoGaleria('<?php echo $anterior;?>');" alt="Anterior">
							</td>
							<td width='7'></td>
							<td class='top_grupoRes_Btn_D' ></td>
						  </tr>
						</table>
						<!-- Fim Tabela Botoes GaleriaFoto Pequeno -->
					</td>
					<td width='13'></td>
					<td class='top_grupoRes_Btn_D2'></td>
				  </tr>
				</table>
<?php }
			}					
		}
		
		public function limpar()
		{
			$_POST['int_paginacaoGaleria'] 	= '';			
		}
	}
?>