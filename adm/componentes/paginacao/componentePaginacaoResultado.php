<?php function cPaginacaoResultado($objConexao, $objConfiguracao,$objPaginacao,$query)
	{
		$objConfiguracao->contadorInicial++;
		
?>
	<tr>
		<td><input name="int_paginacao" type="hidden" value=""></td>
        <td class="med_grupoRes_E"></td>
<?php $resultadoFinal 	= '';
		$contadorExibicao 	= 1;
		$condicaoImage 		= false;
		$bgColor 			= 'background="'.$objConfiguracao->getDirTheme().'/fundoLinhaResult.gif"';

		//============================================================================//
		//					Ação do clique no resultado Padrão.						  //
		//============================================================================//
		$acaoClick = 'onclick="atribuirItem('."'".$objConfiguracao->arrayCampos[0]."', '".$objConexao->retornaResultado($query,$objPaginacao->contador-1, strpos($objConfiguracao->arrayCampos[0], ' ')===false?$objConfiguracao->arrayCampos[0]:basename(str_replace(' ','/',$objConfiguracao->arrayCampos[0])))."'".');"';
		
		
		for($cont=0; $cont < count($objConfiguracao->arrayCampos)+1; $cont++)
		{

			//============================================================================//
			//                   Exibi Imagem nos Resultados.                             //
			//============================================================================//
			if (!$condicaoImage)
			{
				$condicaoImagem = (strlen($objConfiguracao->arrayExibicaoCampos[$contadorExibicao-1])>50 && $objConfiguracao->arrayExibicaoCampos[$contadorExibicao]=='mostrarImagem');
			}
		
			if ($cont==2)
			{
				$concatStyle_Inicio =	'<td class="adm_fonteResTop_01" width="230" align="center" ><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><img src="'.$objConfiguracao->getDiretorioIcons().$objConfiguracao->arrayExibicaoCampos[0].'" width="24" height="24"></td>';
				$concatColunaTabelaInicio = '<td class="adm_fonteResTop_01" style="color:#666666;" width="200" align="left">';
				$concatColunaTabelaFinal = '</td></tr></table>';

			}else
			{
				if ($cont%2==0)
				{
					$align='left';
				}else
				{
					$align='right';
				}

				$concatColunaTabelaInicio = '';
				$concatColunaTabelaFinal = '';
				$concatStyle_Inicio = '<td class="adm_fonteFormGrupo_01" align="'.$align.'">&nbsp;&nbsp;';
			}
			$concatStyle_Final 	= '</td>';


			//============================================================================//
			//            Concatena a Imagem Correspondente no array de exibição.         //
			//============================================================================//
			if ($condicaoImagem)
			{
				$concatColunaTabelaInicio = '';
				$concatColunaTabelaFinal = '';
				$concatImagem = '<td align="left"><table border="0" cellspacing="0" cellpadding="0"><tr><td style="height: 106px;" background="../imovel/mini/'.$objConexao->retornaResultado($query,$objPaginacao->contador-1,$objConfiguracao->arrayCampos[$cont-1]).'">'.$objConfiguracao->arrayExibicaoCampos[($contadorExibicao - 1)].'</td></tr></table></td>';
				$bgColor = 'background="'.$objConfiguracao->getDirTheme().'/fundoLinhaResultG.gif"';
			}
		
			//============================================================================//
			// Se segundo campoExibição for TRUE ele exibe o campo com respectivo VALOR   //
			//============================================================================//			
			if ($objConfiguracao->arrayExibicaoCampos[$contadorExibicao])
			{
				$concateMostrarString = $objConexao->retornaResultado($query,$objPaginacao->contador-1,$objConfiguracao->arrayCampos[$cont-1]);

				//============================================================================//
				//	Trata apresentação de valores por Parametro da Classe Configuração.		  //
				//============================================================================//				
				if ($objConfiguracao->arrayExibicaoCampos[6]=='MapaSatelite')
				{
					
					$str_posicaoSatelite = $objConexao->retornaResultado($query,$objPaginacao->contador-1,$objConfiguracao->arrayCampos[$cont]);
					if ($str_posicaoSatelite=='')
					{
						$concateMostrarString = 'Nao existe Mapa.';
					}else
					{
						//============================================================================//
						//					Modifica ação do clique no resultado Padrão.			  //
						//============================================================================//
						$linkClick = str_replace($objConfiguracao->retornaNomePaginaAtual(), "", $_SERVER['SCRIPT_NAME']).'adm_mostraMapaImovel.php?str_posicaoSatelite='.$objConfiguracao->sequenceCrypt($str_posicaoSatelite, 2, true);						
						$largura = $objConfiguracao->retornaLarguraAlturaSatelite($str_posicaoSatelite, 'width="');
						$altura  = $objConfiguracao->retornaLarguraAlturaSatelite($str_posicaoSatelite, 'eight="');
						$acaoClick = 'onclick="GB_showCenter(\'Mapa do Imóvel\', \''.$linkClick.'\', '.$altura.', '.$largura.');"';
						
						$concateMostrarString = 'Visualizar Mapa.';
					}
				}
				
				$concatCampo = $objConfiguracao->arrayExibicaoCampos[($contadorExibicao - 1)];
				$stringBanco = $concateMostrarString;
				$stringBanco = strlen($stringBanco)>32 ? substr($stringBanco,0,28).'...':$stringBanco;
				if ($condicaoImagem)
				{
					$stringBanco = '';
					$concatCampo = '';
				}
				$str_dadoBanco = $concatColunaTabelaInicio.$stringBanco.$concatColunaTabelaFinal;
				
				//============================================================================//
				//					Trata apresentação de valores do banco.					  //
				//============================================================================//
				switch ($str_dadoBanco) 
				{
					case "t":
						$str_dadoBanco = "Sim";
						break;
					case "f":
						$str_dadoBanco = "N&atilde;o";
						break;
					default:
						if (!$objConfiguracao->verificaExistenciaLetras($str_dadoBanco))
						{
							$str_dadoBanco = "R$".str_replace(".",",",$str_dadoBanco);
						}
						break;
				}
				
				$campo = $concatCampo." ".$objConfiguracao->codifiStringBancoInterface($objConexao, $str_dadoBanco);
				$resultadoFinal .= $concatStyle_Inicio.$campo.$concatStyle_Final;
				
				if ($cont == count($objConfiguracao->arrayCampos) && $condicaoImagem)
				{
					$resultadoFinal = $concatImagem.str_replace(array(' width="230" ',' width="200" '), ' ', $resultadoFinal);
				}				
			}
			
			$contadorExibicao +=2;
		}
		
		$concatenaGeralInicio = '<td colspan="9" '.$bgColor.' height="41" width="627" valign="middle" ><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr style="cursor:pointer;" '.$acaoClick.' >';
		$concatenaGeralFinal = '</tr></table></td>';
		echo $concatenaGeralInicio.$resultadoFinal.$concatenaGeralFinal;
?>
		<td class="med_grupoRes_D"></td>
		<td></td>
	</tr>
<?php if ($objConfiguracao->contadorInicial != $objPaginacao->totalRegistrosTela)
			{
?>
	<tr>
		<td></td>
        <td class="med_grupoRes_E"></td>
		<td colspan="9" class="adm_med_grupoRes_M_01"></td>
		<td class="med_grupoRes_D"></td>
		<td></td>
	</tr>
<?php }
			
			if ($objConfiguracao->arrayCampos[0]=='id_configuracao')
			{
?>
				<script>
                	atribuirItem('<?php echo $objConfiguracao->arrayCampos[0];?>', '<?php echo $objConexao->retornaResultado($query,$objPaginacao->contador-1, $objConfiguracao->arrayCampos[0]);?>');
                </script>
<?php }
		}
?>