<?php class imovel extends FuncoesComum 
	{
		private function atribuirViaPost()
		{
			$this->id_imovel				= $this->sequenceCrypt($_POST["id_imovel"], $_POST["codSecFormulario"], false);
			$this->id_proprietario			= $_POST["slc_proprietario"];
			$this->str_tipoImovel			= $this->sequenceCrypt($_POST["slc_tipoImovel"], $_POST["codSecFormulario"], false);
			$this->str_subTipoImovel		= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["slc_subTipoImovel"], $_POST["codSecFormulario"], false));
			$this->str_situacaoImovel		= $this->sequenceCrypt($_POST["slc_situacaoImovel"], $_POST["codSecFormulario"], false);
			$this->str_mobiliado			= $this->sequenceCrypt($_POST["slc_mobiliado"], $_POST["codSecFormulario"], false);
			$this->int_quarto				= $this->sequenceCrypt($_POST["slc_quarto"], $_POST["codSecFormulario"], false);
			$this->int_sala					= $this->sequenceCrypt($_POST["slc_sala"], $_POST["codSecFormulario"], false);
			$this->int_banheiro				= $this->sequenceCrypt($_POST["slc_banheiro"], $_POST["codSecFormulario"], false);
			$this->int_suite				= $this->sequenceCrypt($_POST["slc_suite"], $_POST["codSecFormulario"], false);
			$this->int_garagem				= $this->sequenceCrypt($_POST["slc_garagem"], $_POST["codSecFormulario"], false);
			$this->str_areaPrivativa		= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_areaPrivativa"], $_POST["codSecFormulario"], false));
			$this->str_areaTerreno			= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_areaTerreno"], $_POST["codSecFormulario"], false));
			$this->str_areaTotal			= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_areaTotal"], $_POST["codSecFormulario"], false));
			$this->str_unidadePrivativa		= $this->sequenceCrypt($_POST["slc_unidadePrivativa"], $_POST["codSecFormulario"], false);
			$this->str_unidadeTerreno		= $this->sequenceCrypt($_POST["slc_unidadeTerreno"], $_POST["codSecFormulario"], false);
			$this->str_unidadeTotal			= $this->sequenceCrypt($_POST["slc_unidadeTotal"], $_POST["codSecFormulario"], false);

			$this->str_uf					= $this->sequenceCrypt($_POST["slc_uf"], $_POST["codSecFormulario"], false);
			$this->id_municipio				= $this->sequenceCrypt($_POST["slc_municipios"], $_POST["codSecFormulario"], false);
			$this->str_municipios			= $this->sequenceCrypt($_POST["str_municipios"], $_POST["codSecFormulario"], false);
			$this->id_bairro				= $this->sequenceCrypt($_POST["slc_bairro"], $_POST["codSecFormulario"], false);
			$this->id_numeroCep				= $this->sequenceCrypt($_POST["slc_descricaoLogradouro"], $_POST["codSecFormulario"], false);	

			$this->str_tipoNegocio			= $this->sequenceCrypt($_POST["slc_tipoNegocio"], $_POST["codSecFormulario"], false);
			$this->str_subTipoNegocio		= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["slc_subTipoNegocio"], $_POST["codSecFormulario"], false));
			$this->str_valorImovel			= $this->MascaraValor($this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_valorImovel"], $_POST["codSecFormulario"], false)));
			$this->str_valorIptu			= $this->MascaraValor($this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_valorIptu"], $_POST["codSecFormulario"], false)));
			$this->str_valorCondominio		= $this->MascaraValor($this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_valorCondominio"], $_POST["codSecFormulario"], false)));
			$this->str_valorTaxasExtras		= $this->MascaraValor($this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_valorTaxasExtras"], $_POST["codSecFormulario"], false)));
			$this->bln_verValorImovel		= $this->sequenceCrypt($_POST["chk_verValorImovel"], $_POST["codSecFormulario"], false);
			$this->bln_verValorOutros		= $this->sequenceCrypt($_POST["chk_verValorOutros"], $_POST["codSecFormulario"], false);
			$this->str_descricaoImovel		= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_descricaoImovel"], $_POST["codSecFormulario"], false));
			$this->dt_entrega				= $this->converteDataBanco($this->sequenceCrypt($_POST["str_dtEntrega"], $_POST["codSecFormulario"], false));
			$this->str_construtora			= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["slc_construtora"], $_POST["codSecFormulario"], false));
			$this->str_empreendimento		= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["slc_empreendimento"], $_POST["codSecFormulario"], false));
			$this->bln_promocao				= $this->sequenceCrypt($_POST["chk_promocao"], $_POST["codSecFormulario"], false);
			$this->bln_ativo				= $this->sequenceCrypt($_POST["chk_ativo"], $_POST["codSecFormulario"], false);

			$this->bln_promocaoAux			= $this->bln_promocao == 't'?'true':'';
			$this->bln_ativoAux				= $this->bln_ativo == 't'?'true':'';
			$this->bln_verValorImovelAux	= $this->bln_verValorImovel == 't'?'true':'';
			$this->bln_verValorOutrosAux	= $this->bln_verValorOutros == 't'?'true':'';

			//controle variáveis disables
			$condicaoPeriodoNegocio = ($this->str_tipoNegocio=='Venda');
			$condicaoDt_Entrega 	= ($this->str_situacaoImovel != 'Lançamento' && $this->str_situacaoImovel != 'Na Planta');
			$condicaoVerValorOutros	= ($this->bln_verValorOutros != 't');
			$condicaoVerValorImovel	= ($this->bln_verValorImovel != 't');
			
			$this->str_DisablePeriodoNegocio = $condicaoPeriodoNegocio==true?'style="width: 139px; filter: Alpha(Opacity=25);" disabled="disabled"':'style="width: 139px;"';
			$this->str_DisableDt_Entrega 	 = $condicaoDt_Entrega==true?'style="width: 70px; filter: Alpha(Opacity=25);" disabled="disabled"':'style="width: 70px;"';
			$this->str_DisableVerValorOutros = $condicaoVerValorOutros==true?'style="width: 85px; filter: Alpha(Opacity=25);" disabled="disabled"':'style="width: 85px;"';
			$this->str_DisableVerValorImovel = $condicaoVerValorImovel==true?'style="width: 85px; filter: Alpha(Opacity=25);" disabled="disabled"':'style="width: 85px;"';
		}

		private function atribuirViaPostSimples()
		{
			$this->bln_venda				= $this->sequenceCrypt($_POST["chk_venda"], $_POST["codSecFormulario"], false);
			$this->bln_vendaAux				= $this->bln_venda == 't'?'true':'';
			
			$this->bln_aluguel				= $this->sequenceCrypt($_POST["chk_aluguel"], $_POST["codSecFormulario"], false);
			$this->bln_aluguelAux			= $this->bln_aluguel == 't'?'true':'';
			
			$this->str_tipoImovel			= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["slc_tipoImovel"], $_POST["codSecFormulario"], false));
			$this->str_situacaoImovel		= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["slc_situacaoImovel"], $_POST["codSecFormulario"], false));
			$this->id_bairro				= $_POST["slc_bairro"];
			$this->str_descricaoImovel		= $this->removeLixoDecriptVazio($this->anti_injection($this->sequenceCrypt($_POST["str_descricaoImovel"], $_POST["codSecFormulario"], false)));
			$this->int_quarto				= $_POST["slc_quarto"];
			
			$this->str_valorInicial			= $this->MascaraValor($this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_valorInicial"], $_POST["codSecFormulario"], false)));
			$this->str_valorFinal			= $this->MascaraValor($this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_valorFinal"], $_POST["codSecFormulario"], false)));
			$this->str_tipoValor			= $this->sequenceCrypt($_POST["slc_tipoValor"], $_POST["codSecFormulario"], false);
			
		}

		private function atribuirViaPostAvancadas()
		{
			$this->bln_venda				= $this->sequenceCrypt($_POST["chk_venda"], $_POST["codSecFormulario"], false);
			$this->bln_vendaAux				= $this->bln_venda == 't'?'true':'';
			$this->bln_aluguel				= $this->sequenceCrypt($_POST["chk_aluguel"], $_POST["codSecFormulario"], false);
			$this->bln_aluguelAux			= $this->bln_aluguel == 't'?'true':'';
			$this->str_tipoImovel			= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["slc_tipoImovel"], $_POST["codSecFormulario"], false));
			$this->str_situacaoImovel		= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["slc_situacaoImovel"], $_POST["codSecFormulario"], false));
			$this->str_descricaoImovel		= $this->removeLixoDecriptVazio($this->anti_injection($this->sequenceCrypt($_POST["str_descricaoImovel"], $_POST["codSecFormulario"], false)));
			$this->int_quarto				= $_POST["slc_quarto"];
			$this->str_valorInicial			= $this->MascaraValor($this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_valorInicial"], $_POST["codSecFormulario"], false)));
			$this->str_valorFinal			= $this->MascaraValor($this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_valorFinal"], $_POST["codSecFormulario"], false)));
			$this->str_tipoValor			= $this->sequenceCrypt($_POST["slc_tipoValor"], $_POST["codSecFormulario"], false);

			//inicio variaveis busca avançada...
			$this->bln_temporada			= $this->sequenceCrypt($_POST["chk_temporada"], $_POST["codSecFormulario"], false);
			$this->bln_temporadaAux			= $this->bln_temporada == 't'?'true':'';
			$this->str_subTipoImovel		= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["slc_subTipoImovel"], $_POST["codSecFormulario"], false));
			$this->str_construtora			= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["slc_construtora"], $_POST["codSecFormulario"], false));
			$this->str_empreendimento		= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["slc_empreendimento"], $_POST["codSecFormulario"], false));
			$this->int_sala					= $_POST["slc_sala"];
			$this->int_banheiro				= $_POST["slc_banheiro"];
			$this->dt_entrega				= $this->converteDataBanco($this->removeLixoDecriptVazio($this->anti_injection($this->sequenceCrypt($_POST["str_dtEntrega"], $_POST["codSecFormulario"], false))));
			$this->int_garagem				= $_POST["slc_garagem"];
			$this->int_suite				= $_POST["slc_suite"];
			
			$this->str_uf					= $_POST["slc_uf"];
			$this->id_municipio				= $_POST["slc_municipios"];
			$this->str_municipios			= $this->sequenceCrypt($_POST["str_municipios"], $_POST["codSecFormulario"], false);
			$this->id_bairro				= $_POST["slc_bairro"];
		}

		private function verificaVariavelConsultaSessao($objConexao, $objSessao)
		{
			$objSessao->abrirSessao();
			
			if ($objSessao->getNomeSessao('SQL_CONSULTA') == FALSE && (isset($_POST["slc_tipoValor"]) || !empty($_POST["slc_tipoValor"])))
			{
				return true;
			}else if ($objSessao->getNomeSessao('SQL_CONSULTA') == TRUE && (isset($_POST["slc_tipoValor"]) || !empty($_POST["slc_tipoValor"])))
			{
				return true;
			}else if ($objSessao->getNomeSessao('SQL_CONSULTA') == TRUE && !(isset($_POST["slc_tipoValor"]) || !empty($_POST["slc_tipoValor"])))
			{
				return false;
			}
		}

		public function consultaBuscaFacil($objConexao, $objSessao, $str_ordenacao="")
		{
			if ($this->verificaVariavelConsultaSessao($objConexao, $objSessao))
			{
				$this->atribuirViaPostSimples();
	
				$sql = "SELECT 
							id_imovel,
							id_proprietario,
							str_tipoimovel,
							str_subtipoimovel,
							str_situacaoimovel,
							str_mobiliado,
							int_quarto,
							int_sala,
							int_banheiro,
							int_suite,
							int_garagem,
							str_areaprivativa,
							str_areaterreno,
							str_areatotal,
							str_unidadeprivativa,
							str_unidadeterreno,
							str_unidadetotal,
							str_tiponegocio,
							str_subtiponegocio,
							str_valorimovel,
							str_valoriptu,
							str_valorcondominio,
							str_valortaxasextras,
							bln_vervalorimovel,
							bln_vervaloroutros,
							str_descricaoimovel,
							dt_entrega,
							str_construtora,
							str_empreendimento,
							str_posicaosatelite,
							bln_promocao,
							dt_publicacao,
							bln_ativo,
							BAI.id_bairro,							
							BAI.str_bairro
				from msf.bairro BAI 
					inner join msf.imovel IMO on (BAI.id_bairro = IMO.id_bairro) 
					inner join msf.municipio MUN on (MUN.id_municipio=BAI.id_municipio) 
				where bln_ativo = TRUE";
		
				$count 	= 0;
				$count2 = 0;
				
				if($this->bln_venda == 'TRUE' && $this->bln_aluguel == 'TRUE')
				{
					$sql .= " and ( str_tiponegocio = 'Venda' or str_tiponegocio = 'Aluguel' ) ";
					$count = 1;
				}else if ($this->bln_venda == 'TRUE' && $this->bln_aluguel == 'FALSE')
				{
					$sql .= " and str_tiponegocio = 'Venda' ";
					$count = 1;				
				}else if ($this->bln_venda == 'FALSE' && $this->bln_aluguel == 'TRUE')
				{
					$sql .= " and str_tiponegocio = 'Aluguel' ";
					$count = 1;				
				}
	
				if($this->str_tipoImovel != '')
				{
					$sql .= " and str_tipoimovel = '".$this->str_tipoImovel."' ";
				}
	
				if ($this->str_situacaoImovel != '')
				{
					$sql .= " and str_situacaoimovel = '".$this->codifiStringInterfaceBanco($objConexao, $this->str_situacaoImovel)."' ";
				}
	
				if($this->id_bairro != '')
				{
					$sql .= " and id_bairro = *".$this->id_bairro."* ";
				}
	
				if($this->str_descricaoImovel != '')
				{
					$sql .= " and str_descricaoimovel ilike '%".$this->codifiStringInterfaceBanco($objConexao, $this->str_descricaoImovel)."%' ";
				}
	
				if($this->int_quarto != '')
				{
					$sql .= " and int_quarto = ".$this->int_quarto." ";
				}
	
				if(!(($this->str_valorInicial == '' or $this->str_valorInicial == '0.00') && ($this->str_valorFinal == '' or $this->str_valorFinal == '0.00')))
				{
					switch ($this->str_tipoValor)
					{
						case 'Condomínio':
							$tipoValorComparar = ' cast (str_valorcondominio as decimal) ';
	
							break;
						case 'IPTU':
							$tipoValorComparar = ' cast (str_valoriptu as decimal) ';
							break;
						default:
							$tipoValorComparar = ' cast (str_valorimovel as decimal) ';
					} 
	
					$sql .= " and ".$tipoValorComparar." between ".floatval($this->str_valorInicial)." and ".floatval($this->str_valorFinal)." ";
				}
		
				$objSessao->setNomeSessao('SQL_CONSULTA', $sql);

				$sql = $_SESSION["SQL_CONSULTA"];
				
				if ($str_ordenacao!='')
				{
					$objSessao->setNomeSessao('SQL_ORDENACAO', $str_ordenacao);
					$sql .= $str_ordenacao;
				}				

			}else
			{
				$sql = $_SESSION["SQL_CONSULTA"];

				if ($str_ordenacao!='')
				{
					$objSessao->setNomeSessao('SQL_ORDENACAO', $str_ordenacao);
					$sql .= $str_ordenacao;
				}
			}
			$sql = str_replace(array("''","**"),"null",$sql);
			$sql = str_replace("*","",$sql);
			return $sql;
		}

		public function consultaBuscaAvancada($objConexao, $objSessao, $str_ordenacao="")
		{
			
			if ($this->verificaVariavelConsultaSessao($objConexao, $objSessao))
			{
				$this->atribuirViaPostAvancadas();
	
				$sql = "SELECT 
							id_imovel,
							id_proprietario,
							str_tipoimovel,
							str_subtipoimovel,
							str_situacaoimovel,
							str_mobiliado,
							int_quarto,
							int_sala,
							int_banheiro,
							int_suite,
							int_garagem,
							str_areaprivativa,
							str_areaterreno,
							str_areatotal,
							str_unidadeprivativa,
							str_unidadeterreno,
							str_unidadetotal,
							str_tiponegocio,
							str_subtiponegocio,
							str_valorimovel,
							str_valoriptu,
							str_valorcondominio,
							str_valortaxasextras,
							bln_vervalorimovel,
							bln_vervaloroutros,
							str_descricaoimovel,
							dt_entrega,
							str_construtora,
							str_empreendimento,
							str_posicaosatelite,
							bln_promocao,
							dt_publicacao,
							bln_ativo,
							str_uf,  
							MUN.id_municipio as id_municipio,
							BAI.id_bairro
					from msf.bairro BAI 
						inner join msf.imovel IMO on (BAI.id_bairro = IMO.id_bairro) 
						inner join msf.municipio MUN on (MUN.id_municipio=BAI.id_municipio) 							
					where bln_ativo = TRUE ";
		
				$count 	= 0;
				$count2 = 0;
				
				if($this->bln_venda == 'TRUE' && $this->bln_aluguel == 'TRUE' && $this->bln_temporada == 'TRUE')			// V V V
				{
					$sql .= " and ( str_tiponegocio = 'Venda' or str_tiponegocio = 'Aluguel' or str_tiponegocio = 'Temporada' ) ";
					$count = 1;
				}else if($this->bln_venda == 'TRUE' && $this->bln_aluguel == 'TRUE' && $this->bln_temporada == 'FALSE')		// V V F
				{
					$sql .= " and ( str_tiponegocio = 'Venda' or str_tiponegocio = 'Aluguel') ";
					$count = 1;				
				}else if($this->bln_venda == 'TRUE' && $this->bln_aluguel == 'FALSE' && $this->bln_temporada == 'TRUE')		// V F V
				{
					$sql .= " and ( str_tiponegocio = 'Venda' or str_tiponegocio = 'Temporada' ) ";
					$count = 1;				
				}else if($this->bln_venda == 'FALSE' && $this->bln_aluguel == 'TRUE' && $this->bln_temporada == 'TRUE')		// F V V
				{
					$sql .= " and ( str_tiponegocio = 'Aluguel' or str_tiponegocio = 'Temporada' ) ";
					$count = 1;				
				}else if($this->bln_venda == 'TRUE' && $this->bln_aluguel == 'FALSE' && $this->bln_temporada == 'FALSE')	// V F F
				{
					$sql .= " and str_tiponegocio = 'Venda' ";
					$count = 1;				
				}else if($this->bln_venda == 'FALSE' && $this->bln_aluguel == 'TRUE' && $this->bln_temporada == 'FALSE')	// F V F
				{
					$sql .= " and str_tiponegocio = 'Aluguel' ";
					$count = 1;				
				}else if($this->bln_venda == 'FALSE' && $this->bln_aluguel == 'FALSE' && $this->bln_temporada == 'TRUE')	// F F V
				{
					$sql .= " and str_tiponegocio = 'Temporada' ";
					$count = 1;				
				}
	
				if($this->str_tipoImovel != '')
				{
					$sql .= " and str_tipoimovel = '".$this->str_tipoImovel."' ";
				}
				
				if ($this->str_subTipoImovel != '')
				{
					$sql .= " and str_subtipoimovel = '".$this->str_subTipoImovel."' ";
				}
				
	
				if ($this->str_situacaoImovel != '')
				{
					$sql .= " and str_situacaoimovel = '".$this->codifiStringInterfaceBanco($objConexao, $this->str_situacaoImovel)."' ";
				}
			
				if ($this->str_uf != '')
				{
					$sql .= " and str_uf = '".$this->str_uf."' ";
				}
				
				if ($this->id_municipio != '')
				{
					$sql .= " and MUN.id_municipio = *".$this->id_municipio."* ";
				}

				if($this->id_bairro != '')
				{
					$sql .= " and BAI.id_bairro = *".$this->id_bairro."* ";
				}
	
				if($this->str_descricaoImovel != '')
				{
					$sql .= " and str_descricaoimovel ilike '%".$this->codifiStringInterfaceBanco($objConexao, $this->str_descricaoImovel)."%' ";
				}
	
				if($this->int_quarto != '')
				{
					$sql .= " and int_quarto = ".$this->int_quarto." ";
				}
				
				if ($this->int_sala != '')
				{
					$sql .= " and int_sala = ".$this->int_sala." ";
				}
				
				if ($this->int_banheiro != '')
				{
					$sql .= " and int_banheiro = ".$this->int_banheiro." ";
				}
				
				if ($this->int_garagem != '')
				{
					$sql .= " and int_garagem = ".$this->int_garagem." ";
				}
				
				if ($this->int_suite != '')
				{
					$sql .= " and int_suite = ".$this->int_suite." ";
				}				
	
				if(!(($this->str_valorInicial == '' or $this->str_valorInicial == '0.00') && ($this->str_valorFinal == '' or $this->str_valorFinal == '0.00')))
				{
					switch ($this->str_tipoValor)
					{
						case 'Condomínio':
							$tipoValorComparar = ' cast (str_valorcondominio as decimal) ';
	
							break;
						case 'IPTU':
							$tipoValorComparar = ' cast (str_valoriptu as decimal) ';
							break;
						default:
							$tipoValorComparar = ' cast (str_valorimovel as decimal) ';
					} 
	
					$sql .= " and ".$tipoValorComparar." between ".floatval($this->str_valorInicial)." and ".floatval($this->str_valorFinal)." ";
				}
				
				if ($this->str_construtora != '')
				{
					$sql .= " and str_construtora = '".$this->str_construtora."' ";
				}
				
				if ($this->str_empreendimento != '')
				{
					$sql .= " and str_empreendimento = '".$this->str_empreendimento."' ";
				}

				if ($this->dt_entrega != '')//12-12-2008
				{
					$sql .= " and (date_part('months', dt_entrega) = '".substr($this->dt_entrega,5,2)."' and date_part('year', dt_entrega) = '".substr($this->dt_entrega,0,4)."' )";
				}
				
				$objSessao->setNomeSessao('SQL_CONSULTA', $sql);

				$sql = $_SESSION["SQL_CONSULTA"];
				
				if ($str_ordenacao!='')
				{
					$sql .= $str_ordenacao;
				}				

			}else
			{
				$sql = $_SESSION["SQL_CONSULTA"];

				if ($str_ordenacao!='')
				{
					$sql .= $str_ordenacao;
				}
			}
			
			$sql = str_replace(array("''","**"),"null",$sql);
			$sql = str_replace("*","",$sql);
			return $sql;
		}
		
		public function inicializaVariaveis($id_proprietario='')
		{
			$this->id_imovel				= "";
			$this->id_proprietario			= $id_proprietario!=''?$id_proprietario:'';
			$this->str_tipoImovel			= "";
			$this->str_subTipoImovel		= "";
			$this->str_situacaoImovel		= "Usado";
			$this->str_mobiliado			= "";
			$this->int_quarto				= "0";
			$this->int_sala					= "0";
			$this->int_banheiro				= "0";
			$this->int_suite				= "0";
			$this->int_garagem				= "0";
			$this->str_areaPrivativa		= "0";
			$this->str_areaTerreno			= "0";
			$this->str_areaTotal			= "0";
			$this->str_unidadePrivativa		= "";
			$this->str_unidadeTerreno		= "";
			$this->str_unidadeTotal			= "";
			
			$this->str_uf					= "";
			$this->id_municipio				= "";
			$this->str_municipios			= "";
			$this->id_bairro				= "";
			$this->str_bairro				= "";
			$this->id_numeroCep				= "";
			$this->str_descricaoLogradouro	= "";
			$this->str_descricaoTipo		= "";	

			$this->str_tipoNegocio			= "Venda";
			$this->str_subTipoNegocio		= "";
			$this->str_valorImovel			= "0,00";
			$this->str_valorIptu			= "0,00";
			$this->str_valorCondominio		= "0,00";
			$this->str_valorTaxasExtras		= "0,00";
			$this->bln_verValorImovel		= "t";
			$this->bln_verValorOutros		= "t";
			$this->str_descricaoImovel		= "";
			$this->dt_entrega				= "";
			$this->str_construtora			= "";
			$this->str_empreendimento		= "";
			$this->bln_promocao				= "";
			$this->bln_ativo				= "t";

			//controle variáveis checkboxs
			$this->bln_promocaoAux			= $this->bln_promocao == 't'?'true':'';
			$this->bln_ativoAux				= $this->bln_ativo == 't'?'true':'';
			$this->bln_verValorImovelAux	= $this->bln_verValorImovel == 't'?'true':'';
			$this->bln_verValorOutrosAux	= $this->bln_verValorOutros == 't'?'true':'';
			
			//controle variáveis disables
			$this->str_DisablePeriodoNegocio = 'style="width: 139px; filter: Alpha(Opacity=25);" disabled="disabled"';
			$this->str_DisableDt_Entrega 	 = 'style="width: 70px; filter: Alpha(Opacity=25);" disabled="disabled"';
			$this->str_DisableVerValorOutros = 'style="width: 85px;"';
			$this->str_DisableVerValorImovel = 'style="width: 85px;"';
		}

		public function inicializaVariaveisSimples()
		{
			$this->bln_venda				= "t";
			$this->bln_vendaAux				= $this->bln_venda == 't'?'true':'';
			
			$this->bln_aluguel				= "";
			$this->bln_aluguelAux			= $this->bln_aluguel == 't'?'true':'';
			
			$this->str_tipoImovel			= "Apartamento";
			$this->str_situacaoImovel		= "Lançamento";
			$this->str_bairro				= "";
			$this->str_descricaoImovel		= "";
			$this->int_quarto				= "1";
			
			$this->str_valorInicial			= "0,00";
			$this->str_valorFinal			= "0,00";
			
			$this->str_tipoValor			= "Imóvel";
		}

		public function inicializaVariaveisAvancadas()
		{
			$this->bln_venda				= "t";
			$this->bln_vendaAux				= $this->bln_venda == 't'?'true':'';
			$this->bln_aluguel				= "";
			$this->bln_aluguelAux			= $this->bln_aluguel == 't'?'true':'';
			$this->str_tipoImovel			= "";
			$this->str_situacaoImovel		= "";
			$this->str_bairro				= "";
			$this->str_descricaoImovel		= "";
			$this->int_quarto				= "1";
			$this->str_valorInicial			= "0,00";
			$this->str_valorFinal			= "0,00";
			$this->str_tipoValor			= "Imóvel";

			//inicio variaveis busca avançada...
			$this->bln_temporada			= "";
			$this->bln_temporadaAux			= $this->bln_temporada == 't'?'true':'';
			$this->str_subTipoImovel		= "";
			$this->str_construtora			= "";
			$this->str_empreendimento		= "";
			$this->int_sala					= "";
			$this->int_banheiro				= "";
			$this->dt_entrega				= "";
			$this->str_uf					= "";
			$this->str_municipio			= "";
			$this->int_garagem				= "";
			$this->int_suite				= "";
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
			$query = $this->consultaImovel($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);
			
			$this->atribuirQueryMunicipios($objConexao, $array["id_bairro"]);

			$this->id_proprietario			= $array["id_proprietario"];
			$this->str_tipoImovel			= $array["str_tipoimovel"];
			$this->str_subTipoImovel		= $this->codifiStringBancoInterface($objConexao,$array["str_subtipoimovel"]);
			$this->str_situacaoImovel		= $this->codifiStringBancoInterface($objConexao,$array["str_situacaoimovel"]);
			$this->str_mobiliado			= $this->codifiStringBancoInterface($objConexao,$array["str_mobiliado"]);
			$this->int_quarto				= $array["int_quarto"];
			$this->int_sala					= $array["int_sala"];
			$this->int_banheiro				= $array["int_banheiro"];
			$this->int_suite				= $array["int_suite"];
			$this->int_garagem				= $array["int_garagem"];
			$this->str_areaPrivativa		= $array["str_areaprivativa"] == ''?'0':$array["str_areaprivativa"];
			$this->str_areaTerreno			= $array["str_areaterreno"] == ''?'0':$array["str_areaterreno"];
			$this->str_areaTotal			= $array["str_areatotal"] == ''?'0':$array["str_areatotal"];
			$this->str_unidadePrivativa		= $this->codifiStringBancoInterface($objConexao,$array["str_unidadeprivativa"]);
			$this->str_unidadeTerreno		= $this->codifiStringBancoInterface($objConexao,$array["str_unidadeterreno"]);
			$this->str_unidadeTotal			= $this->codifiStringBancoInterface($objConexao,$array["str_unidadetotal"]);
			$this->str_tipoNegocio			= $array["str_tiponegocio"];
			$this->str_subTipoNegocio		= $this->codifiStringBancoInterface($objConexao,$array["str_subtiponegocio"]);
			$this->str_valorImovel			= $this->MascaraValorTela($array["str_valorimovel"]);
			$this->str_valorIptu			= $this->MascaraValorTela($array["str_valoriptu"]);
			$this->str_valorCondominio		= $this->MascaraValorTela($array["str_valorcondominio"]);
			$this->str_valorTaxasExtras		= $this->MascaraValorTela($array["str_valortaxasextras"]);
			$this->bln_verValorImovel		= $array["bln_vervalorimovel"];
			$this->bln_verValorOutros		= $array["bln_vervaloroutros"];
			$this->str_descricaoImovel		= $this->codifiStringBancoInterface($objConexao,$array["str_descricaoimovel"]);
			$this->dt_entrega				= $this->retornaDataNumerica($array["dt_entrega"], 'DATA_COMPLETA');
			$this->str_construtora			= $this->codifiStringBancoInterface($objConexao,$array["str_construtora"]);
			$this->str_empreendimento		= $this->codifiStringBancoInterface($objConexao,$array["str_empreendimento"]);
			$this->bln_promocao				= $array["bln_promocao"];
			$this->bln_ativo				= $array["bln_ativo"];
			
			$this->bln_promocaoAux			= $this->bln_promocao == 't'?'true':'';
			$this->bln_ativoAux				= $this->bln_ativo == 't'?'true':'';
			$this->bln_verValorImovelAux	= $this->bln_verValorImovel == 't'?'true':'';
			$this->bln_verValorOutrosAux	= $this->bln_verValorOutros == 't'?'true':'';

			//controle variáveis disables
			$condicaoPeriodoNegocio = ($this->str_tipoNegocio=='Venda');
			$condicaoDt_Entrega 	= ($this->str_situacaoImovel != 'Lançamento' && $this->str_situacaoImovel != 'Na Planta');
			$condicaoVerValorOutros	= ($this->bln_verValorOutros != 't');
			$condicaoVerValorImovel	= ($this->bln_verValorImovel != 't');
			
			$this->str_DisablePeriodoNegocio = $condicaoPeriodoNegocio==true?'style="width: 139px; filter: Alpha(Opacity=25);" disabled="disabled"':'style="width: 139px;"';
			$this->str_DisableDt_Entrega 	 = $condicaoDt_Entrega==true?'style="width: 70px; filter: Alpha(Opacity=25);" disabled="disabled"':'style="width: 70px;"';
			$this->str_DisableVerValorOutros = $condicaoVerValorOutros==true?'style="width: 85px; filter: Alpha(Opacity=25);" disabled="disabled"':'style="width: 85px;"';
			$this->str_DisableVerValorImovel = $condicaoVerValorImovel==true?'style="width: 85px; filter: Alpha(Opacity=25);" disabled="disabled"':'style="width: 85px;"';			
		}

		private function atribuirViaPostSatelite()
		{
			$this->id_imovel				= $this->sequenceCrypt($_POST["id_imovel"], $_POST["codSecFormulario"], false);
			$this->str_posicaoSatelite		= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_posicaoSatelite"], $_POST["codSecFormulario"], false));
		}

		public function inicializaVariaveisSatelite($id_imovel='')
		{
			$this->id_imovel				= $id_imovel!=''?$id_imovel:'';
			$this->str_posicaoSatelite		= "";
		}

		public function atribuirQuerySatelite($objConexao, $int_codigo)
		{
			$query = $this->consultaImovel($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);
			$this->id_imovel			= $int_codigo;
			$this->str_posicaoSatelite	= $array["str_posicaosatelite"];
		}

		private function possuiCodigoMapaCadastrado($objConexao,$int_codigo)	
		{
			$sql = "SELECT str_posicaosatelite from msf.imovel where id_imovel =".$int_codigo." and  str_posicaosatelite is not null ";
			return $objConexao->contaLinhas($objConexao->executaSQL($sql))==1 ? TRUE : FALSE;
		}

		public function comboConstrutora($objConexao)
		{
			$sql = "SELECT distinct str_construtora from msf.construtora order by str_construtora";	
			return	$objConexao->executaSQL($sql);
		}

		public function comboEmpreendimento($objConexao, $str_construtora)
		{
			$sql = "SELECT distinct str_empreendimento from msf.construtora where str_construtora = '".$str_construtora."' order by str_empreendimento";
			return	$objConexao->executaSQL($sql);
		}

		private function consultaImovel($objConexao,$int_codigo)	
		{
			$sql = "SELECT 
							id_imovel,
							id_proprietario,
							str_tipoimovel,
							str_subtipoimovel,
							str_situacaoimovel,
							str_mobiliado,
							int_quarto,
							int_sala,
							int_banheiro,
							int_suite,
							int_garagem,
							str_areaprivativa,
							str_areaterreno,
							str_areatotal,
							str_unidadeprivativa,
							str_unidadeterreno,
							str_unidadetotal,
							id_bairro,
							str_tiponegocio,
							str_subtiponegocio,
							str_valorimovel,
							str_valoriptu,
							str_valorcondominio,
							str_valortaxasextras,
							bln_vervalorimovel,
							bln_vervaloroutros,
							str_descricaoimovel,
							dt_entrega,
							str_construtora,
							str_empreendimento,
							str_posicaosatelite,
							bln_promocao,
							dt_publicacao,
							bln_ativo			
					from msf.imovel where id_imovel =".$int_codigo;
			return	$objConexao->executaSQL($sql);		
		}

		public function comboTipoImovel($objConexao)
		{
			$sql = "SELECT distinct str_tipoimovel from msf.tipoimovel order by str_tipoimovel";	
			return	$objConexao->executaSQL($sql);
		}

		public function comboSubTipoImovel($objConexao, $str_tipoImovel)
		{
			$sql = "SELECT distinct str_subtipoimovel from msf.tipoimovel where str_tipoimovel = '".$str_tipoImovel."' order by str_subtipoimovel";
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
					where BA.id_bairro = ".$int_codigo." limit 1";

			return	$objConexao->executaSQL($sql);
		}
		
		public function comboBairroUf($objConexao, $str_Uf)
		{
			$sql = "SELECT 
						str_uf,  
						BA.id_municipio as id_municipio , 
						str_municipios, 
						BA.id_bairro, 
						BA.str_bairro 
					from msf.municipio MU 
						left join msf.bairro BA on (MU.id_municipio=BA.id_municipio) 
					where str_uf = '".$str_Uf."' order by str_bairro";
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

		public function cadastrarImovel($objConexao)
		{
			$this->atribuirViaPost();
			
			$intCodigo = $this->atualizadorSequence($objConexao, "imovel", "imovel_id_imovel_seq");
			$sql = "INSERT INTO msf.imovel
					(
						id_imovel,
						id_proprietario,
						str_tipoimovel,
						str_subtipoimovel,
						str_situacaoimovel,
						str_mobiliado,
						int_quarto,
						int_sala,
						int_banheiro,
						int_suite,
						int_garagem,
						str_areaprivativa,
						str_areaterreno,
						str_areatotal,
						str_unidadeprivativa,
						str_unidadeterreno,
						str_unidadetotal,
						id_bairro,
						str_tiponegocio,
						str_subtiponegocio,
						str_valorimovel,
						str_valoriptu,
						str_valorcondominio,
						str_valortaxasextras,
						bln_vervalorimovel,
						bln_vervaloroutros,
						str_descricaoimovel,
						dt_entrega,
						str_construtora,
						str_empreendimento,
						bln_promocao,
						bln_ativo,
						dt_publicacao
					) VALUES 
					(
						 *".$intCodigo."*,
						 *".$this->id_proprietario."*,
						 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_tipoImovel)."',
						 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_subTipoImovel)."',
						 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_situacaoImovel)."',
						 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_mobiliado)."',
						 *".$this->int_quarto."*,
						 *".$this->int_sala."*,
						 *".$this->int_banheiro."*,
						 *".$this->int_suite."*,
						 *".$this->int_garagem."*,
						 '".$this->str_areaPrivativa."',
						 '".$this->str_areaTerreno."',
						 '".$this->str_areaTotal."',
						 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_unidadePrivativa)."',
						 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_unidadeTerreno)."',
						 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_unidadeTotal)."',
						 *".$this->id_bairro."*,
						 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_tipoNegocio)."',
						 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_subTipoNegocio)."',
						 '".$this->str_valorImovel."',
						 '".$this->str_valorIptu."',
						 '".$this->str_valorCondominio."',
						 '".$this->str_valorTaxasExtras."',
						 '".$this->bln_verValorImovel."',
						 '".$this->bln_verValorOutros."',
						 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_descricaoImovel)."',
						 '".$this->dt_entrega."',
						 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_construtora)."',
						 '".$this->codifiStringInterfaceBanco($objConexao,$this->str_empreendimento)."',
						 '".$this->bln_promocao."',
						 '".$this->bln_ativo."',
						 '".date('Y-m-d H:i:s')."'
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
		}
		
		public function alterarImovel($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_imovel from msf.imovel where id_imovel = ".$this->id_imovel;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "UPDATE msf.imovel SET
							id_proprietario			= *".$this->id_proprietario."*,
							str_tipoimovel			= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_tipoImovel)."',
							str_subtipoimovel		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_subTipoImovel)."',
							str_situacaoimovel		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_situacaoImovel)."',
							str_mobiliado			= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_mobiliado)."',
							int_quarto				= *".$this->int_quarto."*,
							int_sala				= *".$this->int_sala."*,
							int_banheiro			= *".$this->int_banheiro."*,
							int_suite				= *".$this->int_suite."*,
							int_garagem				= *".$this->int_garagem."*,
							str_areaprivativa		= '".$this->str_areaPrivativa."',
							str_areaterreno			= '".$this->str_areaTerreno."',
							str_areatotal			= '".$this->str_areaTotal."',
							str_unidadeprivativa	= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_unidadePrivativa)."',
							str_unidadeterreno		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_unidadeTerreno)."',
							str_unidadetotal		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_unidadeTotal)."',
							id_bairro				= *".$this->id_bairro."*,
							str_tiponegocio			= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_tipoNegocio)."',
							str_subtiponegocio		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_subTipoNegocio)."',
							str_valorimovel			= '".$this->str_valorImovel."',
							str_valoriptu			= '".$this->str_valorIptu."',
							str_valorcondominio		= '".$this->str_valorCondominio."',
							str_valortaxasextras	= '".$this->str_valorTaxasExtras."',
							bln_vervalorimovel		= '".$this->bln_verValorImovel."',
							bln_vervaloroutros		= '".$this->bln_verValorOutros."',
							str_descricaoimovel		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_descricaoImovel)."',
							dt_entrega				= '".$this->dt_entrega."',
							str_construtora			= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_construtora)."',
							str_empreendimento		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_empreendimento)."',
							bln_promocao			= '".$this->bln_promocao."',
							bln_ativo				= '".$this->bln_ativo."',
							dt_publicacao			= '".date('Y-m-d H:i:s')."'
							
						where id_imovel = ".$this->id_imovel;

				$sql = str_replace(array("''","**"),"null",$sql);
				$sql = str_replace("*","",$sql);
				/*
				header("Content-Type: text/html; charset=UTF-8",true);
				echo $sql; exit;
				*/

				if ($objConexao->executaSQL($sql))
				{
					$this->inicializaVariaveis($this->id_proprietario);
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
						alertMenssage ('Atenção:','Este Imóvel não foi localizado para ser alterado. <br>Selecione outro imovél.');
					</script>
<?php return false;	
			}
		}
		
		public function excluirImovel($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_imovel from msf.imovel where id_imovel = ".$this->id_imovel;
			$query 	= $objConexao->executaSQL($sql);
			
			if ($objConexao->contaLinhas($query) > 0)
			{
				//=========================================================================//
				//este loop apagará todos os arquivos de imagens cadastras para este imovel//
				//=========================================================================//
				$sql	=  "SELECT str_diretorioimagensimovel from msf.imagensimovel where id_imovel = ".$this->id_imovel;
				$query 	= $objConexao->executaSQL($sql);
				while($array = $objConexao->retornaArray($query))
				{
					$this->apagaArquivoDiretorio($array["str_diretorioimagensimovel"], TRUE, TRUE);//apaga arquivo imagem.
				}
				//=========================================================================//
				//este loop apagará todos os arquivos cadastrados para este imovel         //
				//=========================================================================//
				$sql	=  "SELECT str_diretorioarquivosimovel from msf.arquivosimovel where id_imovel = ".$this->id_imovel;
				$query 	= $objConexao->executaSQL($sql);
				while($array = $objConexao->retornaArray($query))
				{
					$this->apagaArquivoDiretorio($this->incluirDiretorioString('arquivosImovel/',$array["str_diretorioarquivosimovel"]), TRUE);//apaga arquivo do imovel.
				}

				$sql = "DELETE FROM msf.imovel where id_imovel = ".$this->id_imovel;
				$sqlCotacao = "DELETE FROM msf.cotacao where id_imovel = ".$this->id_imovel;
				if ($objConexao->executaSQL($sql))
				{
					$objConexao->executaSQL($sqlCotacao);
					$this->excluirImagensImovel($objConexao, $this->id_imovel);
					$this->excluirArquivosImovel($objConexao, $this->id_imovel);
					$this->inicializaVariaveis($this->id_proprietario);
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
						alertMenssage ('Atenção:','Este imovél não foi localizado para ser excluído. <br>Selecione outro imovél.');
					</script>
<?php return false;	
			}
		}

		public function alterarSateliteImovel($objConexao, $acaoBotao)
		{
			$this->atribuirViaPostSatelite();
			$sql	=  "SELECT id_imovel from msf.imovel where id_imovel = ".$this->id_imovel;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$str_posicaoSatelite = $this->retornaPosicaoSatelite($this->str_posicaoSatelite);
				if ($str_posicaoSatelite != false)// Só cadastra se o $str_posicaoSatelite for válido.
				{			
					if ($acaoBotao == 'Excluir')
					{
						$sql = "UPDATE msf.imovel SET
									str_posicaosatelite		= ''
								where id_imovel = ".$this->id_imovel;			
					}else
					{
						$sql = "UPDATE msf.imovel SET
									str_posicaosatelite		= '".$str_posicaoSatelite."'
								where id_imovel = ".$this->id_imovel;
					}

					$sql = str_replace(array("''","**"),"null",$sql);
					$sql = str_replace("*","",$sql);
					if ($objConexao->executaSQL($sql))
					{
						$this->inicializaVariaveisSatelite($this->id_imovel);
						if ($acaoBotao == 'Cadastrar')
						{
?>
						<script>
							alertMenssage ('Aviso:','Cadastrado com sucesso.');
						</script>
<?php }else if ($acaoBotao == 'Alterar')
						{
?>
						<script>
							alertMenssage ('Aviso:','Alterado com sucesso.');
						</script>
<?php }else if ($acaoBotao == 'Excluir')
						{
?>
						<script>
							alertMenssage ('Aviso:','Excluído com sucesso.');
						</script>
<?php }
						return true;
					}else
					{
						return false;
					}
				}else
				{
					return false;
				}
			}else
			{
					if ($acaoBotao == 'Cadastrar')
					{
?>
					<script>
						alertMenssage ('Atenção:','Este Imóvel não foi localizado para cadastrado sua posição. <br>Selecione outro imovél.');
					</script>
<?php }else if ($acaoBotao == 'Alterar')
					{
?>
					<script>
						alertMenssage ('Atenção:','Este Imóvel não foi localizado para alterar sua posição. <br>Selecione outro imovél.');
					</script>
<?php }if ($acaoBotao == 'Excluir')
					{
?>
					<script>
						alertMenssage ('Atenção:','Este Imóvel não foi localizado para excluir sua posição. <br>Selecione outro imovél.');
					</script>
<?php }
					return false;	
			}
		}

		private function excluirImagensImovel($objConexao, $id_imovel)
		{
			$sql	=  "SELECT id_imagensimovel, str_diretorioimagensimovel from msf.imagensimovel where id_imovel = ".$id_imovel;
			$query 	= $objConexao->executaSQL($sql);
			$numeroImagens = $objConexao->contaLinhas($query);

			if ($numeroImagens > 0)
			{
				$sucesso = true;
				while ($array = $objConexao->retornaArray($query))
				{
					$sql = "DELETE FROM msf.imagensimovel where id_imagensimovel = ".$array["id_imagensimovel"];
					if ($objConexao->executaSQL($sql))
					{
						$this->apagaArquivoDiretorio($array["str_diretorioimagensimovel"], TRUE, TRUE);//apaga arquivo imagem.
					}else
					{
						$sucesso = false;
					}				
				}
			}else
			{
				$sucesso = true;
			}
			return $sucesso;
		}
		
		private function excluirArquivosImovel($objConexao, $id_imovel)
		{
			$sql	=  "SELECT id_arquivosimovel, str_diretorioarquivosimovel from msf.arquivosimovel where id_imovel = ".$id_imovel;
			$query 	= $objConexao->executaSQL($sql);
			$numeroArquivos = $objConexao->contaLinhas($query);

			if ($numeroArquivos > 0)
			{
				$sucesso = true;
				while ($array = $objConexao->retornaArray($query))
				{
					$sql = "DELETE FROM msf.arquivosimovel where id_arquivosimovel = ".$array["id_arquivosimovel"];
					if ($objConexao->executaSQL($sql))
					{
						$this->apagaArquivoDiretorio($this->incluirDiretorioString('arquivosImovel/',$array["str_diretorioarquivosimovel"]), TRUE);//apaga arquivo imagem.
					}else
					{
						$sucesso = false;
					}
				}

			}else
			{
				$sucesso = false;
			}
			
			return $sucesso;
		}		

	}
?>