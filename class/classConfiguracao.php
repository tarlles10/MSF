<?php class Configuracao extends FuncoesComum 
	{
		private $tituloHTML, $versao;
		public $modo;

		private function retornoQueryUsuarioLogado()
		{
			if (isset($_SESSION["sessao_str_nome"]) || !empty($_SESSION["sessao_str_nome"]))
			{
				return "where US.str_nome = '".$_SESSION["sessao_str_nome"]."'";
			}else
			{
				return "where CO.id_contrato = (SELECT id_contrato FROM msf.contrato order by id_contrato desc limit 1) order by random() LIMIT 1";						
			}
		}

		public function InicializarConfiguracao($objConexao) 
		{
			// Configuração default do sistema.
			$sql	= "SELECT 
							id_configuracao,
							id_theme,
							id_banner,
							str_nomesite,
							int_quantidadevisita,
							int_quantidadebusca,
							str_tipoinforme,
							int_quantidadeinformes,
							str_bannermediolargo,
							str_bannermediocurto,
							str_bannerbaixo,
							str_ufpadrao,
							str_emailchat			
						from msf.configuracao 
						order by id_configuracao desc limit 1";

			$query 	= $objConexao->executaSQL($sql);
			$array 	= $objConexao->retornaArray($query);

			$this->id_configuracao			= $array["id_configuracao"];
			$this->id_theme					= $array["id_theme"];
			$this->id_bannerTopo			= $array["id_banner"];
			$this->tituloHTML				= $this->codifiStringBancoInterface($objConexao,$array["str_nomesite"]);
			$this->int_quantidadeVisita		= $array["int_quantidadevisita"];
			$this->int_quantidadeBusca		= $array["int_quantidadebusca"];
			$this->str_tipoInforme			= $this->codifiStringBancoInterface($objConexao,$array["str_tipoinforme"]);
			$this->int_quantidadeInformes	= $array["int_quantidadeinformes"];
			$this->str_ufPadrao				= $array["str_ufpadrao"];
			$this->str_emailChat			= $array["str_emailchat"];

			$this->str_bannerMedioLargo		= $array["str_bannermediolargo"];
			$this->str_bannerMedioCurto		= $array["str_bannermediocurto"];
			$this->str_bannerBaixo			= $array["str_bannerbaixo"];

			$this->linkCertificadoSeguranca = ''; 
			$this->empresaRazaoSocial		= "";
			$this->modo						= "1";
			$this->versao					= "V1.0";

		//============================================================================//
		//                Condiguração do usuário que contratou o portal              //
		//============================================================================//
			$sql  = "SELECT 
						US.str_nivelacesso,
						US.str_email, 
						US.str_telefone,
						PL.bln_tipoinforme,
						PL.int_quantidadeinformes, 
						PL.bln_tipobanner, 
						PL.int_quantidadethemas, 
						PL.bln_quantidadevisitas, 
						PL.bln_quantidadebuscas,
						PL.bln_construtoras,
						PL.bln_empreendimentos,
						PL.bln_subtipoimovel,
						PL.bln_valoriptu,
						PL.bln_valorcondominio,
						PL.bln_sala,
						PL.bln_banheiro,
						PL.bln_suite,
						PL.bln_garagem,
						PL.bln_uf,
						PL.bln_municipio,
						PL.bln_dtentrega,
						CO.bln_contratoativo
						
						from msf.usuario 					US 
							 left join msf.contrato 		CO on (US.id_contrato = CO.id_contrato) 
							 left join msf.plano 			PL on (CO.id_plano = PL.id_plano) 
						".$this->retornoQueryUsuarioLogado();

			$query = $objConexao->executaSQL($sql);
			$array 	= $objConexao->retornaArray($query);

			if ($objConexao->contaLinhas($query) == 0 || $array["bln_contratoativo"] == 'f')
			{
				$this->bln_portalSemContrato = true;
			}else
			{
				$this->bln_portalSemContrato = false;
			}

			$this->str_nivelAcesso			= $array["str_nivelacesso"];
			$this->str_email				= $array["str_email"];
			$this->str_telefone				= $array["str_telefone"];			
			$this->bln_tipoInforme			= $array["bln_tipoinforme"]			==''?true:$array["bln_tipoinforme"];
			$this->int_quantidadeInformes	= $array["int_quantidadeinformes"]	==''?1:$array["int_quantidadeinformes"];
			$this->bln_tipoBanner			= $array["bln_tipobanner"]			==''?true:$array["bln_tipobanner"];
			$this->int_quantidadeThemas		= $array["int_quantidadethemas"]	==''?1:$array["int_quantidadethemas"];
			$this->bln_quantidadeVisitas	= $array["bln_quantidadevisitas"]	==''?true:$array["bln_quantidadevisitas"];
			$this->bln_quantidadeBuscas		= $array["bln_quantidadebuscas"]	==''?true:$array["bln_quantidadebuscas"];

			$this->bln_construtoras			= $array["bln_construtoras"]		==''?true:$array["bln_construtoras"];
			$this->bln_empreendimentos		= $array["bln_empreendimentos"]		==''?true:$array["bln_empreendimentos"];
			$this->bln_subTipoImovel		= $array["bln_subtipoimovel"]		==''?true:$array["bln_subtipoimovel"];
			$this->bln_valorIptu			= $array["bln_valoriptu"]			==''?true:$array["bln_valoriptu"];
			$this->bln_valorCondominio		= $array["bln_valorcondominio"]		==''?true:$array["bln_valorcondominio"];
			$this->bln_sala					= $array["bln_sala"]				==''?true:$array["bln_sala"];
			$this->bln_banheiro				= $array["bln_banheiro"]			==''?true:$array["bln_banheiro"];
			$this->bln_suite				= $array["bln_suite"]				==''?true:$array["bln_suite"];
			$this->bln_garagem				= $array["bln_garagem"]				==''?true:$array["bln_garagem"];
			$this->bln_uf					= $array["bln_uf"]					==''?true:$array["bln_uf"];
			$this->bln_municipio			= $array["bln_municipio"]			==''?true:$array["bln_municipio"];
			$this->bln_dtentrega			= $array["bln_dtentrega"]			==''?true:$array["bln_dtentrega"];

			// Configuração do thema do site.
			$this->atribuirThema($objConexao);
		}

		//==================================================================================//
		//       		 Atribuir os dados Institucionais da tabela Empresa  		        //
		//==================================================================================//
		private function atribuirArrayDadosInstitucionais($objConexao, $maxCaracteres) 
		{
			$sql	=  "SELECT 
							id_empresa, 
							id_configuracao, 
							str_tituloitem, 
							str_descricaoitem, 
							dt_publicacao 
						from msf.empresa 
						where id_configuracao = ".$this->getIdConfiguracao()." and
							  dt_publicacao < date(to_char(CURRENT_DATE , 'YYYY-MM-DD'))
						order by id_empresa";

			$query 	= $objConexao->executaSQL($sql);
			if ($objConexao->contaLinhas($query) > 0)
			{
				$cont = 1;
				$concateStringMenu = '';
				while ($array = $objConexao->retornaArray($query))
				{
					$concateStringMenu.= $array["str_tituloitem"];
					if (strlen($concateStringMenu)>=$maxCaracteres)
					{
						break;
					}
					$this->array_id_empresa[$cont]			= $array["id_empresa"];
					$this->array_str_tituloItem[$cont]		= $this->codifiStringBancoInterface($objConexao,$array["str_tituloitem"]);
					$this->array_str_descricaoItem[$cont]	= $array["str_descricaoitem"];

					$cont++;

				}
				return true;
			}else
			{
				return false;
			}
		}
		
		public function retornoIntStringMaxleghtTituloItem($objConexao, $qtd_registro = FALSE)
		{
			$sql = "SELECT str_tituloitem from msf.empresa ";
			$query = $objConexao->executaSQL($sql);
			if ($qtd_registro == TRUE)
			{
				//retorna numero de linhas da tabela
				return $this->MascaraValor($objConexao->contaLinhas($query));
			}else
			{
				$string = '';
				while($array = $objConexao->retornaArray($query))
				{
					$string .= $array["str_tituloitem"];
				}
				//retorna o a quantidade de caracteres utilizado já no banco
				return strlen($string);
			}
		}

		public function montaItensMenuBarra($objConexao, $maxCaracteres)
		{
			if ($this->atribuirArrayDadosInstitucionais($objConexao,$maxCaracteres))
			{
				$html = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>';
				
				$qtd_registros = $this->retornoIntStringMaxleghtTituloItem($objConexao,TRUE);
				for ($i = 1; $i <= $qtd_registros; $i++)
				{
					if ($i==1)
					{
						$align = 'Left';
					}else if ($i==$qtd_registros)
					{
						$align = 'Right';
					}else
					{
						$align = 'Center';
					}
					//adm_fonteTextoGrupo_01
					$html .= '<td width="'.intval($qtd_registros/100).'%" align="'.$align.'">
								<a href="mostraEmpresa.php?id_empresa='.$this->getArray_id_empresa($i).'" class="adm_fonteResTop_01" style="color:#fffff; font-size:14px;" >'.
								$this->getArray_str_tituloItem($i).
							   '</a>
							  </td>';
				}
				$html .= '</tr></table>'; 
				return $html;
			}
		}

		//============================================================================//
		//                Funções sobre os themas cadastrados no sistema              //
		//============================================================================//
		private function atribuirThema($objConexao) 
		{
			// Condiguração default do sistema.
			$sql	= "SELECT 	str_dirtheme, 
								str_dirmolde, 
								str_dirimovel,
								str_dirarqimovel, 
								str_dirminiimovel, 
								str_diretorioicons, 
								str_dirmoldegaleria, 
								str_dirmolderesultado,
								str_dirmoldegrupoes,
								str_dirmoldegrupodi, 
								str_dirmoldemostragaleria_01, 
								str_dirmoldemostragaleria_02, 
								str_dirmoldemostragaleria_03,
								str_cortopgrupo,
								str_corfundogrupo, 
								str_corfundogrupobranco, 
								str_corfundoquadrolateral_01, 
								str_corfundoquadrolateral_02
					   from msf.theme 
					   where id_theme = ".$this->getTheme();
			
			$query 	= $objConexao->executaSQL($sql);
			$array 	= $objConexao->retornaArray($query);

			$this->str_dirTheme						= $array["str_dirtheme"];
			$this->str_dirMolde						= $array["str_dirmolde"];
			$this->str_dirImovel					= $array["str_dirimovel"];
			$this->str_dirArqImovel					= $array["str_dirarqimovel"];
			$this->str_dirMiniImovel				= $array["str_dirminiimovel"];
			$this->str_diretorioIcons				= $array["str_diretorioicons"];
			$this->str_dirMoldeGaleria				= $array["str_dirmoldegaleria"];
			$this->str_dirMoldeResultado			= $array["str_dirmolderesultado"];
			$this->str_dirMoldeGrupoEs				= $array["str_dirmoldegrupoes"];
			$this->str_dirMoldeGrupoDi				= $array["str_dirmoldegrupodi"];
			$this->str_dirMoldeMostraGaleria_01		= $array["str_dirmoldemostragaleria_01"];
			$this->str_dirMoldeMostraGaleria_02		= $array["str_dirmoldemostragaleria_02"];
			$this->str_dirMoldeMostraGaleria_03		= $array["str_dirmoldemostragaleria_03"];
			$this->str_corTopGrupo					= $array["str_cortopgrupo"];
			$this->str_corFundoGrupo				= $array["str_corfundogrupo"];
			$this->str_corFundoGrupoBranco			= $array["str_corfundogrupobranco"];
			$this->str_corFundoQuadroLateral_01		= $array["str_corfundoquadrolateral_01"];
			$this->str_corFundoQuadroLateral_02		= $array["str_corfundoquadrolateral_02"];
		}		

		//============================================================================//
		//                Funções sobre os banners cadastrados no sistema             //
		//============================================================================//
		public function atribuirBanner($objConexao, $localBanner) 
		{
			// Condiguração Banner Topo.
			$sql =	"SELECT 
						id_banner,
						str_localbanner,
						str_nomebanner,
						str_diretoriobanner,
						dt_inicialbanner,
						dt_finalbanner,
						str_titulobanner,
						str_chamadabanner,
						str_conteudobanner,
						str_url,
						str_localjanela,
						bln_moldebanner,
						id_moldes
				   from msf.banner " ; 
			
			switch ($localBanner) 
			{
				case 'Banner Topo':

					$sql	.= " where id_banner = ".$this->getBanner();
					$query 	= $objConexao->executaSQL($sql);
					$array 	= $objConexao->retornaArray($query);

					$this->id_banner			= $array["id_banner"];
					$this->str_localBanner		= $array["str_localbanner"];
					$this->str_nomeBanner		= $this->codifiStringBancoInterface($objConexao,$array["str_nomebanner"]);
					$this->str_diretorioBanner	= $array["str_diretoriobanner"];
					$this->dt_inicialBanner		= $array["dt_inicialbanner"];
					$this->dt_finalBanner		= $array["dt_finalbanner"];
					$this->str_tituloBanner		= $this->codifiStringBancoInterface($objConexao,$array["str_titulobanner"]);
					$this->str_chamadaBanner	= $this->codifiStringBancoInterface($objConexao,$array["str_chamadabanner"]);
					$this->str_conteudoBanner	= $this->codifiStringBancoInterface($objConexao,$array["str_conteudobanner"]);
					$this->str_url				= "index.php";
					$this->str_localJanela		= $array["str_localjanela"];
					$this->bln_moldeBanner		= $array["bln_moldebanner"];
					$this->id_moldes			= $array["id_moldes"];
					$this->str_dirBannerAusente = 'banners/BannerAusenteTopo.jpg';
					$this->int_largura			= 755;
					$this->int_altura			= 121;

					$this->atribuirMoldes($objConexao); 
					break;

				case 'Banner Medio Largo':

					$complemento = '';
					if ($this->getBannerMedioLargo() == "Randomico")
					{
						$complemento = " order by random() LIMIT 1";
					}
					else if ($this->getBannerMedioLargo() == "Randomico Periodo")
					{
						$complemento = " and (current_date between dt_inicialbanner and dt_finalbanner) order by random() LIMIT 1";
					}else
					{
						$complemento = " order by id_banner desc limit 1";
					}
					
					$sql	.= " where str_localbanner = '".$localBanner."' ".$complemento;
							   
					$query 	= $objConexao->executaSQL($sql);
					$array 	= $objConexao->retornaArray($query);

					$this->id_banner			= $array["id_banner"];
					$this->str_localBanner		= $array["str_localbanner"];
					$this->str_nomeBanner		= $this->codifiStringBancoInterface($objConexao,$array["str_nomebanner"]);
					$this->str_diretorioBanner	= $array["str_diretoriobanner"];
					$this->dt_inicialBanner		= $array["dt_inicialbanner"];
					$this->dt_finalBanner		= $array["dt_finalbanner"];
					$this->str_tituloBanner		= $this->codifiStringBancoInterface($objConexao,$array["str_titulobanner"]);
					$this->str_chamadaBanner	= $this->codifiStringBancoInterface($objConexao,$array["str_chamadabanner"]);
					$this->str_conteudoBanner	= $this->codifiStringBancoInterface($objConexao,$array["str_conteudobanner"]);
					$this->str_url				= $array["str_url"];
					$this->str_localJanela		= $array["str_localjanela"];
					$this->bln_moldeBanner		= $array["bln_moldebanner"];
					$this->id_moldes			= $array["id_moldes"];
					$this->str_dirBannerAusente = 'banners/BannerAusenteMedioLargo.jpg';
					$this->int_largura			= 570;
					$this->int_altura			= 64;
										
					$this->atribuirMoldes($objConexao);
					break;

				case 'Banner Medio Curto':
					$complemento = '';
					if ($this->getBannerMedioCurto() == "Randomico")
					{
						$complemento = " order by random() LIMIT 1";
					}
					else if ($this->getBannerMedioCurto() == "Randomico Periodo")
					{
						$complemento = " and (current_date between dt_inicialbanner and dt_finalbanner) order by random() LIMIT 1";
					}else
					{
						$complemento = " order by id_banner desc limit 1";
					}
					
					$sql	.= " where str_localbanner = '".$localBanner."' ".$complemento;

					$query 	= $objConexao->executaSQL($sql);
					$array 	= $objConexao->retornaArray($query);
					
					$this->id_banner			= $array["id_banner"];
					$this->str_localBanner		= $array["str_localbanner"];
					$this->str_nomeBanner		= $this->codifiStringBancoInterface($objConexao,$array["str_nomebanner"]);
					$this->str_diretorioBanner	= $array["str_diretoriobanner"];
					$this->dt_inicialBanner		= $array["dt_inicialbanner"];
					$this->dt_finalBanner		= $array["dt_finalbanner"];
					$this->str_tituloBanner		= $this->codifiStringBancoInterface($objConexao,$array["str_titulobanner"]);
					$this->str_chamadaBanner	= $this->codifiStringBancoInterface($objConexao,$array["str_chamadabanner"]);
					$this->str_conteudoBanner	= $this->codifiStringBancoInterface($objConexao,$array["str_conteudobanner"]);
					$this->str_url				= $array["str_url"];
					$this->str_localJanela		= $array["str_localjanela"];
					$this->bln_moldeBanner		= $array["bln_moldebanner"];
					$this->id_moldes			= $array["id_moldes"];
					$this->str_dirBannerAusente = 'banners/BannerAusenteMedioCurto.jpg';
					$this->int_largura			= 274;
					$this->int_altura			= 64;
					
					$this->atribuirMoldes($objConexao);
					break;

				case 'Banner Baixo':

					$complemento = '';
					if ($this->getBannerBaixo() == "Randomico")
					{
						$complemento = " order by random() LIMIT 1";
					}
					else if ($this->getBannerBaixo() == "Randomico Periodo")
					{
						$complemento = " and (current_date between dt_inicialbanner and dt_finalbanner) order by random() LIMIT 1";
					}else
					{
						$complemento = " order by id_banner desc limit 1";
					}
					
					$sql	.= " where str_localbanner = '".$localBanner."' ".$complemento;

					$query 	= $objConexao->executaSQL($sql);
					$array 	= $objConexao->retornaArray($query);
					
					$this->id_banner			= $array["id_banner"];
					$this->str_localBanner		= $array["str_localbanner"];
					$this->str_nomeBanner		= $this->codifiStringBancoInterface($objConexao,$array["str_nomebanner"]);
					$this->str_diretorioBanner	= $array["str_diretoriobanner"];
					$this->dt_inicialBanner		= $array["dt_inicialbanner"];
					$this->dt_finalBanner		= $array["dt_finalbanner"];
					$this->str_tituloBanner		= $this->codifiStringBancoInterface($objConexao,$array["str_titulobanner"]);
					$this->str_chamadaBanner	= $this->codifiStringBancoInterface($objConexao,$array["str_chamadabanner"]);
					$this->str_conteudoBanner	= $this->codifiStringBancoInterface($objConexao,$array["str_conteudobanner"]);
					$this->str_url				= $array["str_url"];
					$this->str_localJanela		= $array["str_localjanela"];
					$this->bln_moldeBanner		= $array["bln_moldebanner"];
					$this->id_moldes			= $array["id_moldes"];
					$this->str_dirBannerAusente = 'banners/BannerAusenteBaixo.jpg';
					$this->int_largura			= 577;
					$this->int_altura			= 116;
					
					$this->atribuirMoldes($objConexao);
					break;
			}

		}

		//============================================================================//
		//                Funções sobre os moldes dos banners cadastrados no sistema  //
		//============================================================================//
		public function atribuirMoldes($objConexao, $id_molde = '') 
		{
			$sql = "SELECT 
						id_moldes,
						str_nomemolde,
						str_diretoriomolde,
						str_tipomolde,
						bln_modificar,
						int_posicaox,
						int_posicaoy,
						int_posicaogx,
						int_posicaogy				
					from msf.moldes ";
								
			
			if ($id_molde != '')
			{
				$sql .= " where id_moldes = ".$id_molde;
				$query 	= $objConexao->executaSQL($sql);
				$array 	= $objConexao->retornaArray($query);
				
				$this->id_moldes			= $array["id_moldes"];
				$this->str_nomeMolde		= $this->codifiStringBancoInterface($objConexao,$array["str_nomemolde"]);
				$this->str_diretorioMolde	= $array["str_diretoriomolde"];
				$this->str_tipoMolde		= $array["str_tipomolde"];
				$this->bln_modificar		= $array["bln_modificar"];
				$this->int_posicaoX			= $array["int_posicaox"];
				$this->int_posicaoY			= $array["int_posicaoy"];
				$this->int_posicaoGX		= $array["int_posicaogx"];
				$this->int_posicaoGY		= $array["int_posicaogy"];			
			}else
			{
				if ($this->getMoldeBanner())
				{
					$sql .= " where id_moldes = ".$this->getIdMoldeBanner();
					$query 	= $objConexao->executaSQL($sql);
					$array 	= $objConexao->retornaArray($query);
					
					$this->id_moldes			= $array["id_moldes"];
					$this->str_nomeMolde		= $this->codifiStringBancoInterface($objConexao,$array["str_nomemolde"]);
					$this->str_diretorioMolde	= $array["str_diretoriomolde"];
					$this->str_tipoMolde		= $array["str_tipomolde"];
					$this->bln_modificar		= $array["bln_modificar"];
					$this->int_posicaoX			= $array["int_posicaox"];
					$this->int_posicaoY			= $array["int_posicaoy"];
					$this->int_posicaoGX		= $array["int_posicaogx"];
					$this->int_posicaoGY		= $array["int_posicaogy"];
				} else
				{
					$this->id_moldes			= $this->getIdMoldeBanner();
					$this->str_nomeMolde		= "";
					$this->str_diretorioMolde	= "";
					$this->str_tipoMolde		= "";
					$this->bln_modificar		= "";
					$this->int_posicaoX			= 0;
					$this->int_posicaoY			= 0;
					$this->int_posicaoGX		= 0;
					$this->int_posicaoGY		= 0;
				}
			}

		}

		//==================================================================================//
		// Função retorna a foto da galeria do imovel mais visitado/Busca na pagina inicial //
		//==================================================================================//
		public function atribuirGaleiraInicial($objConexao, $tipoRetorno) 
		{
			if ($tipoRetorno == 'QuantidadeVisita')
			{
				$sql	=  "SELECT 	IMA.id_imagensimovel,
									IMA.id_imovel,
									IMA.str_imagensimovel,
									IMA.str_diretorioimagensimovel
							from msf.imagensimovel 		IMA
							left join msf.imovel		IMO on (IMA.id_imovel = IMO.id_imovel)
							where IMO.bln_ativo = TRUE and IMA.id_imovel in 
							(
								SELECT id_imovel from msf.cotacao where int_quantidadevisita > 0
								order by int_quantidadevisita desc limit ".$this->getQuantidadeVisita()."
							)
							order by random() limit 1";
			}
			else if($tipoRetorno == 'QuantidadeBusca')
			{
				$sql	=  "SELECT 	IMA.id_imagensimovel,
									IMA.id_imovel,
									IMA.str_imagensimovel,
									IMA.str_diretorioimagensimovel
							from msf.imagensimovel 		IMA
							left join msf.imovel		IMO on (IMA.id_imovel = IMO.id_imovel)
							where IMO.bln_ativo = TRUE and IMA.id_imovel in 
							(
								SELECT id_imovel from msf.cotacao where int_quantidadebusca > 0
								order by int_quantidadebusca desc limit ".$this->getQuantidadeBusca()."
							)
							order by random() limit 1";
			}
			else if($tipoRetorno == 'Promocional')
			{
				$sql	=  "SELECT 	IMA.id_imovel, 
									IMA.id_imagensimovel, 
									IMA.str_imagensimovel, 
									IMA.str_diretorioimagensimovel 
							from msf.imovel 				IMO 
							right join msf.imagensimovel 	IMA on (IMO.id_imovel = IMA.id_imovel) 
							where 	IMO.bln_promocao = TRUE and
									IMO.bln_ativo = TRUE
							order by random() limit 1";
			}
			else if($tipoRetorno == 'GaleriaImagem')
			{
				$sql	=  "SELECT 	IMA.id_imagensimovel,
									IMA.id_imovel,
									IMA.str_imagensimovel,
									IMA.str_diretorioimagensimovel
							from msf.imagensimovel 		IMA
							left join msf.imovel		IMO on (IMA.id_imovel = IMO.id_imovel)
							where IMO.bln_ativo = TRUE
							order by random() limit 1";
			}			
			
			$query 	= $objConexao->executaSQL($sql);
			$array 	= $objConexao->retornaArray($query);

			$this->id_imagensImovel				= $array["id_imagensimovel"];
			$this->id_imovel					= $array["id_imovel"];
			$this->str_imagensImovel			= $this->codifiStringBancoInterface($objConexao,$array["str_imagensimovel"]);
			$this->str_diretorioImagensImovel	= $array["str_diretorioimagensimovel"];
		}

		public function atribuirGaleira($objConexao, $id_imovel, $bln_randomico = FALSE) 
		{
			if ($bln_randomico)
			{
				$completaSql = " order by random() LIMIT 1";
			}else
			{
				$completaSql = " order by id_imagensimovel";
			}
			$sql	=  "SELECT 	IMA.id_imagensimovel,
								IMA.str_imagensimovel,
								IMA.str_diretorioimagensimovel
						from msf.imagensimovel 		IMA
						left join msf.imovel		IMO on (IMA.id_imovel = IMO.id_imovel)
						where IMO.bln_ativo = TRUE and IMO.id_imovel = ".$id_imovel.$completaSql;

			$query 	= $objConexao->executaSQL($sql);
			$array 	= $objConexao->retornaArray($query);

			$this->id_imagensImovel				= $array["id_imagensimovel"];
			$this->str_imagensImovel			= $this->codifiStringBancoInterface($objConexao,$array["str_imagensimovel"]);
			$this->str_diretorioImagensImovel	= $array["str_diretorioimagensimovel"];
		}

		//==================================================================================//
		//                            Função retorna a arquivo inicial                      //
		//==================================================================================//
		public function atribuirArrayArquivoInicial($objConexao, $id_imovel ='', $bln_RetornoLinhas = FALSE) 
		{
			if (!$bln_RetornoLinhas)
			{
				// ESSA VARIAVEL E REFERENTE AO NUMERO PADRAO QUE APARECE NA INICIAL DO PORTAL 
				$quantidadeRegistros = 8;
				
				if ($id_imovel == '')
				{
					$sql	=  "SELECT 	ARQ.id_arquivosimovel,
										ARQ.id_imovel,
										ARQ.str_arquivosimovel,
										ARQ.str_diretorioarquivosimovel
								from msf.arquivosimovel 	ARQ
								left join msf.imovel		IMO on (ARQ.id_imovel = IMO.id_imovel)
								where IMO.bln_ativo = TRUE order by ARQ.id_arquivosimovel desc limit ".$quantidadeRegistros;
				}else
				{
					$sql	=  "SELECT 	ARQ.id_arquivosimovel,
										ARQ.id_imovel,
										ARQ.str_arquivosimovel,
										ARQ.str_diretorioarquivosimovel
								from msf.arquivosimovel 	ARQ
								left join msf.imovel		IMO on (ARQ.id_imovel = IMO.id_imovel)
								where IMO.bln_ativo = TRUE and IMO.id_imovel = ".$id_imovel." order by ARQ.id_arquivosimovel desc limit ".$quantidadeRegistros;
				}
	
				$query 	= $objConexao->executaSQL($sql);
				if ($objConexao->contaLinhas($query) > 0)
				{
					$cont = 1;
					$contCor = $quantidadeRegistros;
					while ($array = $objConexao->retornaArray($query))
					{
						$this->array_id_arquivosImovel[$cont]				= $array["id_arquivosimovel"];
						$this->array_id_imovel[$cont]						= $array["id_imovel"];
						$this->array_str_arquivosImovel[$cont]				= $this->codifiStringBancoInterface($objConexao,$array["str_arquivosimovel"]);
						$this->array_str_diretorioArquivosImovel[$cont]		= $array["str_diretorioarquivosimovel"];
	
						switch (strtolower(substr($this->array_str_diretorioArquivosImovel[$cont], (strlen($this->array_str_diretorioArquivosImovel[$cont]) - 4) , 4))) 
						{
							case '.pdf':
								$this->array_str_iconeArquivosImovel[$cont] = "/arq_pdf.png";
								break;
							case '.doc':
								$this->array_str_iconeArquivosImovel[$cont] = "/arq_doc.png";
								break;
							case '.xls':
								$this->array_str_iconeArquivosImovel[$cont] = "/arq_xls.png";
								break;
							case '.ppt':
								$this->array_str_iconeArquivosImovel[$cont] = "/arq_ppt.png";
								break;
							case '.zip':
								$this->array_str_iconeArquivosImovel[$cont] = "/arq_zip.png";
								break;
							case '.rar':
								$this->array_str_iconeArquivosImovel[$cont] = "/arq_zip.png";
								break;
						}
						
						//======================Codigo para alternar cores de fundo=======================
						if (($contCor % 2) == 0)
						{
							$this->array_grupoQUADROLATERAL_fundo[$cont] = "grupoQUADROLATERAL_fundo_02";
						}else
						{
							$this->array_grupoQUADROLATERAL_fundo[$cont] = "grupoQUADROLATERAL_fundo_03";
						}
						//================================================================================
		
						if ($cont == $quantidadeRegistros)
						{
							break;
						}
						$cont++;
						$contCor--;
					}
					return true;
				}else
				{
					return false;
				}
			}
			else
			{
				if ($id_imovel == '')
				{
					$sql	=  "SELECT 	ARQ.id_arquivosimovel,
										ARQ.id_imovel,
										ARQ.str_arquivosimovel,
										ARQ.str_diretorioarquivosimovel
								from msf.arquivosimovel 	ARQ
								left join msf.imovel		IMO on (ARQ.id_imovel = IMO.id_imovel)
								where IMO.bln_ativo = TRUE order by ARQ.id_arquivosimovel desc ";
				}else
				{
					$sql	=  "SELECT 	ARQ.id_arquivosimovel,
										ARQ.id_imovel,
										ARQ.str_arquivosimovel,
										ARQ.str_diretorioarquivosimovel
								from msf.arquivosimovel 	ARQ
								left join msf.imovel		IMO on (ARQ.id_imovel = IMO.id_imovel)
								where IMO.bln_ativo = TRUE and IMO.id_imovel = ".$id_imovel." order by ARQ.id_arquivosimovel ";
				}
	
				$query 	= $objConexao->executaSQL($sql);
				return $objConexao->contaLinhas($query);
			}
		}

		//============================================================================//
		//                   Função sobre os Dados Imoveis PaginaInicial              //
		//============================================================================//
		public function atribuirImovelInicial($objConexao, $id_imovel = '') 
		{
			if ($id_imovel == '')
			{
				$sql	=  "SELECT 
								PRO.str_telresidencialproprietario, PRO.bln_vertelresidencialproprietario, 
								PRO.str_telcomercialproprietario, 	PRO.bln_vertelcomercialproprietario, 
								PRO.str_telcelularproprietario, 	PRO.bln_vertelcelularproprietario, 
								PRO.str_emailproprietario, 			PRO.bln_veremailproprietario,
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
								BAI.str_bairro
							from msf.imovel						IMO
								left join msf.bairro 			BAI on (IMO.id_bairro=BAI.id_bairro)
								left join msf.proprietario		PRO on (IMO.id_proprietario = PRO.id_proprietario)
							where bln_ativo = TRUE limit 1";
				$query 	= $objConexao->executaSQL($sql);
				$array 	= $objConexao->retornaArray($query);
				$this->str_posicaoSatelite	= '';
			}else
			{
				$sql	=  "SELECT 
								PRO.str_telresidencialproprietario, PRO.bln_vertelresidencialproprietario, 
								PRO.str_telcomercialproprietario, 	PRO.bln_vertelcomercialproprietario, 
								PRO.str_telcelularproprietario, 	PRO.bln_vertelcelularproprietario, 
								PRO.str_emailproprietario, 			PRO.bln_veremailproprietario,
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
								BAI.str_bairro
							from msf.imovel					IMO
								left join msf.bairro 		BAI on (IMO.id_bairro=BAI.id_bairro)
								left join msf.proprietario	PRO on (IMO.id_proprietario = PRO.id_proprietario)
							where id_imovel = ".$id_imovel." and bln_ativo = TRUE";
				$query 	= $objConexao->executaSQL($sql);
				$array 	= $objConexao->retornaArray($query);
				$this->str_posicaoSatelite	= $array["str_posicaosatelite"];
			}
			
			$this->str_tipoImovel		= $this->codifiStringBancoInterface($objConexao,$array["str_tipoimovel"]);
			$this->str_subTipoImovel	= $this->codifiStringBancoInterface($objConexao,$array["str_subtipoimovel"]);
			$this->str_situacaoImovel	= $this->codifiStringBancoInterface($objConexao,$array["str_situacaoimovel"]);
			$this->int_quarto			= $array["int_quarto"];
			$this->int_sala				= $array["int_sala"];
			$this->int_banheiro			= $array["int_banheiro"];
			$this->int_suite			= $array["int_suite"];
			$this->int_garagem			= $array["int_garagem"];
			$this->str_areaPrivativa	= $this->codifiStringBancoInterface($objConexao,$array["str_areaprivativa"]);
			$this->str_areaTerreno		= $this->codifiStringBancoInterface($objConexao,$array["str_areaterreno"]);
			$this->str_areaTotal		= $this->codifiStringBancoInterface($objConexao,$array["str_areatotal"]);
			$this->str_unidadePrivativa	= $this->codifiStringBancoInterface($objConexao,$array["str_unidadeprivativa"]);
			$this->str_unidadeTerreno	= $this->codifiStringBancoInterface($objConexao,$array["str_unidadeterreno"]);
			$this->str_unidadeTotal		= $this->codifiStringBancoInterface($objConexao,$array["str_unidadetotal"]);
			$this->str_uf				= $array["str_uf"];
			$this->str_municipios		= $this->codifiStringBancoInterface($objConexao,$array["str_municipios"]);
			$this->str_bairro			= $this->codifiStringBancoInterface($objConexao,$array["str_bairro"]);
			$this->str_tipoNegocio		= $this->codifiStringBancoInterface($objConexao,$array["str_tiponegocio"]);
			$this->str_subTipoNegocio	= $this->codifiStringBancoInterface($objConexao,$array["str_subtiponegocio"]);
			$this->str_valorImovel		= $array["str_valorimovel"];
			$this->str_valorIptu		= $array["str_valoriptu"];
			$this->str_valorCondominio	= $array["str_valorcondominio"];
			$this->str_valorTaxasExtras	= $array["str_valortaxasextras"];
			$this->bln_verValorImovel	= $array["bln_vervalorimovel"];
			$this->bln_verValorOutros	= $array["bln_vervaloroutros"];
			$this->str_descricaoImovel	= $this->codifiStringBancoInterface($objConexao,$array["str_descricaoimovel"]);
			$this->dt_entrega			= $array["dt_entrega"];

			$this->str_construtora		= $this->codifiStringBancoInterface($objConexao,$array["str_construtora"]);
			$this->str_empreendimento	= $this->codifiStringBancoInterface($objConexao,$array["str_empreendimento"]);
			// variaveis de contato do proprietário
			$this->str_telResidencialProprietario	= $array["bln_vertelresidencialproprietario"]=='t'?$array["str_telresidencialproprietario"]:'';
			$this->str_telComercialProprietario		= $array["bln_vertelcomercialproprietario"]	 =='t'?$array["str_telcomercialproprietario"]:'';
			$this->str_telCelularProprietario		= $array["bln_vertelcelularproprietario"]	 =='t'?$array["str_telcelularproprietario"]:'';
			$this->str_emailProprietario			= $array["bln_veremailproprietario"]		 =='t'?$array["str_emailproprietario"]:'';

		}

		//============================================================================//
		//                   Função sobre os Ordenaçao dos Dados Imoveis              //
		//============================================================================//
		public function retornoOrdenacaoResultados($str_ordenacao) 
		{
			switch($str_ordenacao)
			{
				case 'Mais Procurados':
					$sql	=  " and id_imovel in 
								(
									SELECT id_imovel from msf.cotacao where int_quantidadebusca > 0
									order by int_quantidadebusca desc
								)
								order by id_imovel desc";					 
					break;
				case 'Mais Visitados';
					$sql	=  " and id_imovel in 
								(
									SELECT id_imovel from msf.cotacao where int_quantidadevisita > 0
									order by int_quantidadevisita desc
								)
								order by id_imovel desc";	
					break;
				case 'Maior Preco':// cast (str_valorimovel as decimal) 
					//$sql	=  " order by to_number(str_valorimovel, '999G999G999G999G999G999G999G999G999G999D99') desc";
					$sql	=  " order by  cast (str_valorimovel as decimal) desc";
					break;
				case 'Menor Preco':
					//$sql	=  " order by to_number(str_valorimovel, '999G999G999G999G999G999G999G999G999G999D99') asc";
					$sql	=  " order by  cast (str_valorimovel as decimal) asc";
					break;
				case 'Tipo de Imovel':
					$sql	=  " order by str_tipoimovel asc";
					break;
				case 'Tipo de Negocio':
					$sql	=  " order by str_tiponegocio asc";
					break;
				case 'Bairro':
					$sql	=  " order by str_bairro asc";
					break;
				default:
					$sql	=  " order by id_imovel desc";
					break;
			}
			return $sql;
		}

		public function retornoOrdenacaoResultadosAdministrativo($str_ordenacao = "") 
		{
			$sql = "";
			if ($str_ordenacao != "" && $str_ordenacao != 'undefined')
			{
				$sql	=  " order by ".$str_ordenacao." desc";
			}
			return $sql;
		}

		public function retornoCondicaoResultadosAdministrativo($nomeCodigo, $id_codigo, $bln_aspas) 
		{
			$sql = "";
			if ($nomeCodigo != "" && $id_codigo != "")
			{
				if ($bln_aspas)
				{
					$sql	=  " where ".$nomeCodigo." = '".$id_codigo."' ";
				}else
				{
					$sql	=  " where ".$nomeCodigo." = ".$id_codigo." ";
				}
			}
			return $sql;
		}
		//============================================================================//
		//                 Funções que atualizam as cotacoes dos imoveis              //
		//============================================================================//
		public function atualizaCotacaoImovel($objConexao, $acaoCotacao, $id_imovel) 
		{
			$sql = "SELECT 
						id_cotacao,
						id_imovel,
						int_quantidadevisita,
						int_quantidadebusca			
					from msf.cotacao 
					where id_imovel = ".$id_imovel;
			$query 	= $objConexao->executaSQL($sql);
			if ($objConexao->contaLinhas($query) < 1)
			{
				$acaoExecutar = 'cria';
				switch($acaoCotacao)
				{
					case'v':
						$int_quantidadeVisita	= 1;
						$int_quantidadeBusca	= 0;
						break;
					case'b':
						$int_quantidadeVisita	= 0;
						$int_quantidadeBusca	= 1;
						break;
				}
			}else
			{
				$acaoExecutar = 'atualiza';
				$array 	= $objConexao->retornaArray($query);
				switch($acaoCotacao)
				{
					case'v':
						$int_quantidadeVisita	= 1 + $array["int_quantidadevisita"];
						$int_quantidadeBusca	= 0 + $array["int_quantidadebusca"];
						break;
					case'b':
						$int_quantidadeVisita	= 0 + $array["int_quantidadevisita"];
						$int_quantidadeBusca	= 1 + $array["int_quantidadebusca"];
						break;
				}
			}

			if ($acaoExecutar == 'cria')
			{
				$sql = "Insert into msf.cotacao
					(
						id_cotacao,
						id_imovel,
						int_quantidadevisita,
						int_quantidadebusca
					)
					values
					(
						".$this->atualizadorSequence($objConexao, 'cotacao', 'cotacao_id_cotacao_seq').",
						".$id_imovel.",
						".$int_quantidadeVisita.",
						".$int_quantidadeBusca."
					)";
			}else
			{
				$sql = "Update msf.cotacao set
							int_quantidadevisita	= ".$int_quantidadeVisita.",
							int_quantidadebusca		= ".$int_quantidadeBusca."
						where id_cotacao = ".$array["id_cotacao"];				
			}
			$objConexao->executaSQL($sql);
		}

		//============================================================================//
		//                              Gerador SiteMap			                      //
		//============================================================================//
		private function consultaSiteMapImagensImovel($objConexao) 
		{
			$sql = "SELECT
						IMO.id_imovel,
						IMA.id_imagensimovel,
						IMO.dt_publicacao
					from msf.imagensimovel 		IMA
					left join msf.imovel		IMO on (IMA.id_imovel = IMO.id_imovel)
					where IMO.bln_ativo = TRUE order by IMO.id_imovel";
			return	$objConexao->executaSQL($sql);
		}

		private function consultaSiteMapArquivosImovel($objConexao) 
		{
			$sql = "SELECT 			
						ARQ.str_diretorioarquivosimovel,
						IMO.dt_publicacao
					from msf.arquivosimovel 	ARQ
					left join msf.imovel		IMO on (ARQ.id_imovel = IMO.id_imovel)
					where IMO.bln_ativo = TRUE order by IMO.id_imovel";
			return	$objConexao->executaSQL($sql);
		}

		private function consultaSiteMapConteudoBanner($objConexao) 
		{
			$sql = "SELECT id_banner, dt_publicacao from msf.banner order by id_banner";
			return	$objConexao->executaSQL($sql);
		}

		private function consultaSiteMapFeedRss($objConexao) 
		{
			$sql = "SELECT id_rssitem, dt_publicacao from msf.rssitem order by id_rssitem";
			return	$objConexao->executaSQL($sql);
		}
		
		private function consultaSiteMapEmpresa($objConexao) 
		{
			$sql = "SELECT id_empresa, dt_publicacao from msf.empresa order by id_empresa";
			return	$objConexao->executaSQL($sql);
		}
		
		//============================================================================//
		//            Este script gera o XML do sitemap           					  //
		//============================================================================//		
		public function geradorSiteMap($objConexao)
		{
			//PESQUISAR ping trackback
			//http://blogsearch.google.com/ping?name=Official+Google+Blog&url=http://googleblog.blogspot.com/&changesURL=http://googleblog.blogspot.com/atom.xml
			//Pingar Noticias e Rss no google para atualizar o sitemap
			
			$handle = opendir(".");

			// Abre ou cria o arquivo xml
			$str_xmlSiteMap = fopen("sitemap.xml","w+");

			// Gravamos os dados iniciais do xml
			fwrite($str_xmlSiteMap,"<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n ");

			//===================================================================================================== //
			//	Geramos o lopping com os dados do nó XML IMOVEL IMAGENS												//
			//===================================================================================================== //
			$query = $this->consultaSiteMapImagensImovel($objConexao);
			while($array = $objConexao->retornaArray($query))
			{
				// Abrindo Tag Inicio da URL
				$conteudo = "<url>\n";
				
				//===================================================================================================== //
				//	URL's do portal																						//
				//===================================================================================================== //
				//	Pega o Dominio e o nome do arquivo URL, ex.. 														//
				//* Imovel		: http://localhost/imobiliaria/msf/index.php?cod=mostrar&id_imovel=1&id_imagem=2		//
				//* Arquivos	: http://localhost/imobiliaria/msf/arquivosImovel/										//
				//* Banner		: http://localhost/imobiliaria/msf/mostraConteudoBanner.php?id_banner=4					//
				//* Feed		: http://localhost/imobiliaria/msf/mostraFeedRss.php?id_rssitem=1						//
				//* Empresa		: http://localhost/imobiliaria/msf/mostraEmpresa.php?id_empresa=1						//
				//===================================================================================================== //
				$conteudo .= "<loc>".$this->escapeEntidadeSiteMap("http://".$_SERVER['HTTP_HOST']."/index.php?cod=mostrar&id_imovel=".$array["id_imovel"]."&id_imagem=".$array["id_imagensimovel"])."</loc>\n";

				//	Pega a data atual e informa no xml
				//	ex. '2005-07-25 12:13:41' // substr($array["dt_publicacao"], 0, 10) => '2005-07-25'
				$conteudo .= "<lastmod>".substr($array["dt_publicacao"], 0, 10)."</lastmod>\n";

				//===================================================================================================== //	
				//	Informa a frequencia de atualização da pagina														//
				//===================================================================================================== //
				//	'always'  - Conteúdo da página muda significativamente com cada página. 							//
				//	'hourly'																							//
				//	'daily'																								//
				//	'weekly'																							//
				//	'monthly'																							//
				//	'yearly'																							//
				//	'never'   - Arquivados páginas que não são alteradas mais alguma, documentos PDF e tal.				//
				//===================================================================================================== //
				$conteudo .= "<changefreq>daily</changefreq>\n";

				//===================================================================================================== //	
				//	Informa a prioridade da página																		//
				//===================================================================================================== //
				//	0.0 - 1.0																							//
				//===================================================================================================== //			
				$conteudo .= "<priority>0.1</priority>\n";

				// Fechando Tag Inicio da URL
				$conteudo .= "</url>\n";
				fwrite($str_xmlSiteMap,$conteudo);
			}
			//===================================================================================================== //
			//	Geramos o lopping com os dados do nó XML FEED RSS											//
			//===================================================================================================== //
			$query = $this->consultaSiteMapFeedRss($objConexao);
			while($array = $objConexao->retornaArray($query))
			{
				$conteudo = "<url>\n";
				$conteudo .= "<loc>".$this->escapeEntidadeSiteMap("http://".$_SERVER['HTTP_HOST']."/mostraFeedRss.php?id_rssitem=".$array["id_rssitem"])."</loc>\n";
				$conteudo .= "<lastmod>".substr($array["dt_publicacao"], 0, 10)."</lastmod>\n";
				$conteudo .= "<changefreq>hourly</changefreq>\n";
				$conteudo .= "<priority>0.3</priority>\n";
				$conteudo .= "</url>\n";
				fwrite($str_xmlSiteMap,$conteudo);
			}			
			//===================================================================================================== //
			//	Geramos o lopping com os dados do nó XML CONTEÚDO BANNER											//
			//===================================================================================================== //
			$query = $this->consultaSiteMapConteudoBanner($objConexao);
			while($array = $objConexao->retornaArray($query))
			{
				$conteudo = "<url>\n";
				$conteudo .= "<loc>".$this->escapeEntidadeSiteMap("http://".$_SERVER['HTTP_HOST']."/mostraConteudoBanner.php?id_banner=".$array["id_banner"])."</loc>\n";
				$conteudo .= "<lastmod>".substr($array["dt_publicacao"], 0, 10)."</lastmod>\n";
				$conteudo .= "<changefreq>weekly</changefreq>\n";
				$conteudo .= "<priority>0.5</priority>\n";
				$conteudo .= "</url>\n";
				fwrite($str_xmlSiteMap,$conteudo);
			}
			//===================================================================================================== //
			//	Geramos o lopping com os dados do nó XML IMÓVEL ARQUIVOS											//
			//===================================================================================================== //
			$query = $this->consultaSiteMapArquivosImovel($objConexao);
			while($array = $objConexao->retornaArray($query))
			{
				$conteudo = "<url>\n";
				$conteudo .= "<loc>".$this->escapeEntidadeSiteMap("http://".$_SERVER['HTTP_HOST']."/arquivosImovel/".$array["str_diretorioarquivosimovel"])."</loc>\n";
				$conteudo .= "<lastmod>".substr($array["dt_publicacao"], 0, 10)."</lastmod>\n";
				$conteudo .= "<changefreq>weekly</changefreq>\n";
				$conteudo .= "<priority>0.8</priority>\n";
				$conteudo .= "</url>\n";
				fwrite($str_xmlSiteMap,$conteudo);
			}
			//===================================================================================================== //
			//	Geramos o lopping com os dados do nó XML EMPRESA											//
			//===================================================================================================== //
			$query = $this->consultaSiteMapEmpresa($objConexao);
			while($array = $objConexao->retornaArray($query))
			{
				$conteudo = "<url>\n";
				$conteudo .= "<loc>".$this->escapeEntidadeSiteMap("http://".$_SERVER['HTTP_HOST']."/mostraEmpresa.php?id_empresa=".$array["id_empresa"])."</loc>\n";
				$conteudo .= "<lastmod>".substr($array["dt_publicacao"], 0, 10)."</lastmod>\n";
				$conteudo .= "<changefreq>monthly</changefreq>\n";
				$conteudo .= "<priority>1.0</priority>\n";
				$conteudo .= "</url>\n";
				fwrite($str_xmlSiteMap,$conteudo);
			}			
			closedir($handle);

			//	Fechamos a estrutura do xml
			fwrite($str_xmlSiteMap,"\n</urlset>");

			//	Fecha o arquivo aberto (para liberar memoria do servidor)
			fclose($str_xmlSiteMap);
		}
		
		private function escapeEntidadeSiteMap($string) 
		{
			$string = str_replace('&',	'&amp;',	$string);
			$string = str_replace('\'',	'&apos;',	$string);
			$string = str_replace('"',	'&quot;',	$string);
			$string = str_replace('>',	'&gt;',		$string);
			$string = str_replace('<',	'&lt;',		$string);
			return	$string;
		}		
		//============================================================================//
		//                              GETS default do sistema.                      //
		//============================================================================//
		private function getIdConfiguracao()
		{
			return $this->id_configuracao;
		}
		
		public function getTheme()
		{
			return $this->id_theme;
		}

		public function getBanner()
		{
			return $this->id_bannerTopo;
		}
		
		public function getTitulo()
		{
			return $this->tituloHTML;
		}
		
		public function getQuantidadeVisita()
		{
			return $this->int_quantidadeVisita;
		}
		
		public function getQuantidadeBusca()
		{
			return $this->int_quantidadeBusca;
		}

		public function getStr_TipoInforme()
		{
			return $this->str_tipoInforme;
		}

		public function getQuantidadeInformes()
		{
			return $this->int_quantidadeInformes;
		}

		public function getBannerMedioLargo()
		{
			return $this->str_bannerMedioLargo;
		}
		
		public function getBannerMedioCurto()
		{
			return $this->str_bannerMedioCurto;
		}
		
		public function getBannerBaixo()
		{
			return $this->str_bannerBaixo;
		}
		
		public function getUfPadrao()
		{
			return $this->str_ufPadrao;
		}
		
		public function getEmailChat()
		{
			return $this->str_emailChat;
		}

		public function getLinkCertificadoSeguranca()
		{
			return $this->linkCertificadoSeguranca;
		}
		
		public function getEmpresaRazaoSocial()
		{
			return $this->empresaRazaoSocial;
		}
		
		public function getVersao()
		{
			return $this->versao;
		}

		//============================================================================//
		//                             GETS configuração Banners.                     //
		//============================================================================//
		public function getBannerSite()
		{
			return $this->id_banner;
		}

		public function getLocalBanner()
		{
			return $this->str_localBanner;
		}

		public function getNomeBanner()
		{
			return $this->str_nomeBanner;
		}

		public function getBannerAusente()
		{
			return $this->str_dirBannerAusente;
		}		

		public function getDiretorioConcateEmail()
		{
			$str_protocolo = 'https://';
			if (strpos(str_replace($str_protocolo, "",$this->getLinkCertificadoSeguranca()), $_SERVER["SERVER_NAME"]) === false)
			{
				$str_protocolo = 'http://';
			}else if (!(strpos('localhost', $_SERVER["SERVER_NAME"]) === false))
			{
				$str_protocolo = 'http://';
			}
			
			return $str_protocolo.$_SERVER["SERVER_NAME"].str_replace($this->retornaNomePaginaAtual(), "",$_SERVER["SCRIPT_NAME"]);
		}		

		public function getDiretorioBanner($linkCompleto = false)
		{
			if ($linkCompleto)
			{
				$complementoLink =  'https://'.$_SERVER["SERVER_NAME"].str_replace($this->retornaNomePaginaAtual(), "",$_SERVER["SCRIPT_NAME"]);
			}else
			{
				$complementoLink = '';
			}
			if ($this->str_diretorioBanner == '')//se nao possuir banner cadastrado no sistema
			{
					$onClick = "realizaSubmit('index.php?cod=faleConosco', '');";
					$mostraBanner = '<img src="'.$complementoLink.$this->getBannerAusente().'" style="cursor:pointer;"  width="'.$this->getInt_largura().'" height="'.$this->getInt_altura().'" onclick="'.$onClick.'" >';			
			}
			else
			{
				$flashPlayer 	= explode(".", basename(strtolower($this->str_diretorioBanner)));
				if ($flashPlayer[count($flashPlayer)-1] == 'swf')
				{
					$mostraBanner = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="'.$this->getInt_largura().'" height="'.$this->getInt_altura().'"><param name="movie" value="'.$complementoLink.$this->str_diretorioBanner.'"><param name="wmode" value="opaque" /><param name="quality"s value="high"><embed src="'.$complementoLink.$this->str_diretorioBanner.'" quality="high" wmode="opaque" pluginspage="https://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="'.$this->getInt_largura().'" height="'.$this->getInt_altura().'"></embed></object>';
				}else
				{
					if ($this->getConteudoBanner() != '')
					{
						$onClick	  = "realizaSubmit('".$complementoLink."mostraConteudoBanner.php?id_banner=".$this->getBannerSite()."', '');";
					}else
					{
						$onClick	  = "realizaSubmit('".$this->getUrl()."', '".$this->getLocalJanela()."');";
					}
					$mostraBanner = '<img src="'.$complementoLink.$this->str_diretorioBanner.'" style="cursor:pointer;"  width="'.$this->getInt_largura().'" height="'.$this->getInt_altura().'" onclick="'.$onClick.'" >';				
					
				}	
			}

			return $mostraBanner;			
		}

		public function getDtInicialBanner()
		{
			return $this->dt_inicialBanner;
		}

		public function getDtFinalBanner()
		{
			return $this->dt_finalBanner;
		}

		public function getTituloBanner()
		{
			return $this->str_tituloBanner;
		}

		public function getChamadaBanner()
		{
			return $this->str_chamadaBanner;
		}

		public function getConteudoBanner()
		{
			return $this->str_conteudoBanner;
		}

		public function getUrl()
		{
			return $this->str_url;
		}
		
		public function getLocalJanela()
		{
			if ($this->str_localJanela == 'Mesma Janela')
			{
				return '_parent';
			}else if ($this->str_localJanela == 'Outra Janela')
			{
				return '_blank';
			}
			return '';
		}		

		public function getMoldeBanner()
		{
			return $this->bln_moldeBanner;
		}

		public function getIdMoldeBanner()
		{
			return $this->id_moldes;			
		}

		//============================================================================//
		//                             GETS configuração Moldes.                      //
		//============================================================================//

		public function getNomeMolde()
		{
			return $this->str_nomeMolde;
		}

		public function getDiretorioMolde()
		{
			return $this->str_diretorioMolde;
		}

		public function getTipoMolde()
		{
			return $this->str_tipoMolde;
		}

		public function getModificarMolde()
		{
			return $this->bln_modificar;
		}
		
		public function getInt_largura()
		{
			return $this->int_largura;
		}
		
		public function getInt_altura()
		{
			return $this->int_altura;
		}

		public function getInt_posicaoX()
		{
			return $this->int_posicaoX;
		}
		
		public function getInt_posicaoY()
		{
			return $this->int_posicaoY;
		}

		public function getInt_posicaoGX()
		{
			return $this->int_posicaoGX;
		}
		
		public function getInt_posicaoGY()
		{
			return $this->int_posicaoGY;
		}


		//============================================================================//
		//            GETS Condiguração do usuario que contratou o portal.            //
		//============================================================================//		
		public function getPortalSemContrato()
		{
			return $this->bln_portalSemContrato;
		}

		public function getNivelAcesso()
		{
			return $this->str_nivelAcesso;
		}
		public function getEmail()
		{
			return $this->str_email;
		}
		
		public function getEmailParkimovel()
		{
			return 'emaildoresponsaveldoportal@gmail.com';
		}
		
		public function getTelefone()
		{
			return $this->str_telefone;
		}

		public function getBln_TipoInforme()
		{
			return $this->bln_tipoInforme;
		}

		public function getTipoBanner()
		{
			return $this->bln_tipoBanner;
		}

		public function getQuantidadeThemas()
		{
			return $this->int_quantidadeThemas;
		}

		public function getQuantidadeVisitas()
		{
			return $this->bln_quantidadeVisitas;
		}

		public function getQuantidadeBuscas()
		{
			return $this->bln_quantidadeBuscas;
		}

		public function getBln_construtoras($html=false, $title='')
		{
			if ($html)
			{
				if ($this->bln_construtoras != 't')
				{
					return 'disabled title="Filtro Indisponível"';
				}else
				{
					return 'title="'.$title.'"';
				}
			}else
			{
				return $this->bln_construtoras;
			}
			
		}

		public function getBln_empreendimentos($html=false, $title='')
		{
			if ($html)
			{
				if ($this->bln_empreendimentos != 't')
				{
					return 'disabled title="Filtro Indisponível"';
				}else
				{
					return 'title="'.$title.'"';
				}
			}else
			{
				return $this->bln_empreendimentos;
			}
		}

		public function getBln_subTipoImovel($html=false, $title='')
		{
			if ($html)
			{
				if ($this->bln_subTipoImovel != 't')
				{
					return 'disabled title="Filtro Indisponível"';
				}else
				{
					return 'title="'.$title.'"';
				}
			}else
			{
				return $this->bln_subTipoImovel;
			}
		}
		
		public function getBln_valorIptu()//Este filtro e um item de um combobox o [disabled title="Filtro Indisponível"] não e necessário.
		{
			return $this->bln_valorIptu;
		}

		public function getBln_valorCondominio()//Este filtro e um item de um combobox o [disabled title="Filtro Indisponível"] não e necessário.
		{
			return $this->bln_valorCondominio;
		}

		public function getBln_sala($html=false, $title='')
		{
			if ($html)
			{
				if ($this->bln_sala != 't')
				{
					return 'disabled title="Filtro Indisponível"';
				}else
				{
					return 'title="'.$title.'"';
				}
			}else
			{
				return $this->bln_sala;
			}
		}

		public function getBln_banheiro($html=false, $title='')
		{
			if ($html)
			{
				if ($this->bln_banheiro != 't')
				{
					return 'disabled title="Filtro Indisponível"';
				}else
				{
					return 'title="'.$title.'"';
				}
			}else
			{
				return $this->bln_banheiro;
			}
		}

		public function getBln_suite($html=false, $title='')
		{
			if ($html)
			{
				if ($this->bln_suite != 't')
				{
					return 'disabled title="Filtro Indisponível"';
				}else
				{
					return 'title="'.$title.'"';
				}
			}else
			{
				return $this->bln_suite;
			}
		}

		public function getBln_garagem($html=false, $title='')
		{
			if ($html)
			{
				if ($this->bln_garagem != 't')
				{
					return 'disabled title="Filtro Indisponível"';
				}else
				{
					return 'title="'.$title.'"';
				}
			}else
			{
				return $this->bln_garagem;
			}			
		}

		public function getBln_uf($html=false, $title='')
		{
			if ($html)
			{
				if ($this->bln_uf != 't')
				{
					return 'disabled title="Filtro Indisponível"';
				}else
				{
					return 'title="'.$title.'"';
				}
			}else
			{
				return $this->bln_uf;
			}
		}

		public function getBln_municipio($html=false, $title='')
		{
			if ($html)
			{
				if ($this->bln_municipio != 't')
				{
					return 'disabled title="Filtro Indisponível"';
				}else
				{
					return 'title="'.$title.'"';
				}
			}else
			{
				return $this->bln_municipio;
			}
		}

		public function getBln_dtentrega($html=false, $title='')
		{
			if ($html)
			{
				if ($this->bln_dtentrega != 't')
				{
					return 'disabled title="Filtro Indisponível"';
				}else
				{
					return 'title="'.$title.'"';
				}
			}else
			{
				return $this->bln_dtentrega;
			}
		}
		
		//============================================================================//
		//                   GETS Condiguração do thema do site.                      //
		//============================================================================//
		public function getDirTheme()
		{
			//Página Administrativa só possui um tema por isso sempre buscará o mesmo diretorio da theme
			if (substr($this->retornaNomeArquivo(), 0, 4) == 'adm_')
			{
				return 'template1/';
			}else
			{
				return $this->str_dirTheme;
			}
		}

		public function getDirMolde()
		{
			//Página Administrativa só possui um tema por isso sempre buscará o mesmo diretorio da theme
			if (substr($this->retornaNomeArquivo(), 0, 4) == 'adm_')
			{
				return 'template1/moldes/';
			}else
			{
				return $this->str_dirMolde;
			}
		}

		public function getDirImovel()
		{
			return $this->str_dirImovel;
		}

		public function getDirArqImovel()
		{
			return $this->str_dirArqImovel;
		}

		public function getDirMiniImovel()
		{
			return $this->str_dirMiniImovel;
		}

		public function getDiretorioIcons()
		{
			//Página Administrativa só possui um tema por isso sempre buscará o mesmo diretorio da theme
			if (substr($this->retornaNomeArquivo(), 0, 4) == 'adm_')
			{
				return $this->str_diretorioIcons;
			}else
			{
				return "adm/".$this->str_diretorioIcons;
			}
		}

		public function getDirMoldeGaleria()
		{
			return $this->str_dirMoldeGaleria;
		}

		public function getDirMoldeResultado()
		{
			return $this->str_dirMoldeResultado;
		}

		public function getDirMoldeGrupoEs()
		{
			return $this->str_dirMoldeGrupoEs;
		}

		public function getDirMoldeGrupoDi()
		{
			return $this->str_dirMoldeGrupoDi;
		}

		public function getDirMoldeMostraGaleria_01()
		{
			return $this->str_dirMoldeMostraGaleria_01;
		}

		public function getDirMoldeMostraGaleria_02()
		{
			return $this->str_dirMoldeMostraGaleria_02;
		}

		public function getDirMoldeMostraGaleria_03()
		{
			return $this->str_dirMoldeMostraGaleria_03;
		}

		public function getCorTopGrupo()
		{
			return $this->str_corTopGrupo;
		}
		
		public function getCorFundoGrupo()
		{
			return $this->str_corFundoGrupo;
		}

		public function getCorFundoGrupoBranco()
		{
			return $this->str_corFundoGrupoBranco;
		}

		public function getCorFundoQuadroLateral_01()
		{
			return $this->str_corFundoQuadroLateral_01;
		}

		public function getCorFundoQuadroLateral_02()
		{
			return $this->str_corFundoQuadroLateral_02;
		}

		//============================================================================//
		//     GETS da foto da galeria do imovel mais visitado na pagina inicial.     //
		//============================================================================//
		public function getId_ImagensImovel()
		{
			return $this->id_imagensImovel;
		}

		public function getId_Imovel()
		{
			return $this->id_imovel;
		}

		public function getImagensImovel()
		{
			return $this->str_imagensImovel;
		}

		public function getDiretorioImagensImovel($tamanhoImagem = '')
		{
			if ($tamanhoImagem == 'Miniatura')
			{
				return $this->retornoImagemGaleria($this->str_diretorioImagensImovel);
			}else
			{
				return 'M'.$objConfiguracao->retornoImagemGaleria($this->str_diretorioImagensImovel);
			}
		}		

		//============================================================================//
		//		GETS dos dados Institucionais da Empresa na pagina inicial.			  //
		//============================================================================//
		public function getArray_id_empresa($cont)
		{
			return !array_key_exists($cont, $this->array_id_empresa)?'':$this->array_id_empresa[$cont];
		}

		public function getArray_str_tituloItem($cont)
		{
			return !array_key_exists($cont, $this->array_str_tituloItem)?'':$this->array_str_tituloItem[$cont];
		}

		public function getArray_str_descricaoItem($cont)
		{
			return !array_key_exists($cont, $this->array_str_descricaoItem)?'':$this->array_str_descricaoItem[$cont];
		}

		//============================================================================//
		//                GETS dos arquivos dos imoveis na pagina inicial.            //
		//============================================================================//
		public function getArray_id_arquivosImovel($cont)
		{
			return !array_key_exists($cont, $this->array_id_arquivosImovel)?'':$this->array_id_arquivosImovel[$cont];
		}

		public function getArray_id_imovel($cont)
		{
			return !array_key_exists($cont, $this->array_id_imovel)?'':$this->array_id_imovel[$cont];
		}

		public function getArray_str_arquivosImovel($cont)
		{
			return !array_key_exists($cont, $this->array_str_arquivosImovel)?'Breve mais produtos':$this->array_str_arquivosImovel[$cont];
		}

		public function getArray_str_diretorioArquivosImovel($cont)
		{
			return !array_key_exists($cont, $this->array_str_diretorioArquivosImovel)?'../index.php':$this->array_str_diretorioArquivosImovel[$cont];
		}

		public function getArray_str_iconeArquivosImovel($cont)
		{
			return !array_key_exists($cont, $this->array_str_iconeArquivosImovel)?'arq_undefined.png':$this->array_str_iconeArquivosImovel[$cont];
		}

		public function getArray_grupoQUADROLATERAL_fundo($cont)
		{
			$this->contGrupoQUADROLATERAL++;
			if (!array_key_exists($cont, $this->array_grupoQUADROLATERAL_fundo))
			{
				if ($this->contGrupoQUADROLATERAL % 2 == 0)
				{
					$corAparece = $this->array_grupoQUADROLATERAL_fundo[1];
				}else
				{
					$corAparece = '';
				}
			}
			return !array_key_exists($cont, $this->array_grupoQUADROLATERAL_fundo)?$corAparece:$this->array_grupoQUADROLATERAL_fundo[$cont];
		}		

		//============================================================================//
		//                        GETS Dados Imoveis PaginaInicial                    //
		//============================================================================//
		public function getTipoImovel()
		{
			return $this->str_tipoImovel;
		}	

		public function getSubTipoImovel()
		{
			return $this->str_subTipoImovel;
		}	

		public function getSituacaoImovel()
		{
			return $this->str_situacaoImovel;
		}

		public function getQuarto()
		{
			return $this->int_quarto;
		}	

		public function getSala()
		{
			return $this->int_sala;
		}	

		public function getBanheiro()
		{
			return $this->int_banheiro;
		}	

		public function getSuite()
		{
			return $this->int_suite;
		}	

		public function getGaragem()
		{
			return $this->int_garagem;
		}
		
		public function getRetornoAreaUnidade($intOcupacaoArea, $intOcupacaoUnidade)
		{
			switch ($this->getTipoImovel()) 
			{
				case "Apartamento":
					return '<span title="'.$this->getAreaPrivativa().': '.$this->getUnidadePrivativa().'">'.$this->ocupacaoString($this->getAreaPrivativa(), $intOcupacaoArea).':&nbsp;'.$this->ocupacaoString($this->getUnidadePrivativa(), $intOcupacaoUnidade, TRUE).'</span>';
					break;
				case "Casa":
					return '<span title="'.$this->getAreaPrivativa().': '.$this->getUnidadePrivativa().'">'.$this->ocupacaoString($this->getAreaPrivativa(), $intOcupacaoArea).':&nbsp;'.$this->ocupacaoString($this->getUnidadePrivativa(), $intOcupacaoUnidade, TRUE).'</span>';
					break;					
				case "Garagem":
					return '<span title="'.$this->getAreaTotal().': '.$this->getUnidadeTotal().'">'.$this->ocupacaoString($this->getAreaTotal(), $intOcupacaoArea).':&nbsp;'.$this->ocupacaoString($this->getUnidadeTotal(), $intOcupacaoUnidade, TRUE).'</span>';
					break;
				case "Area/Lote/Terreno":
					return '<span title="'.$this->getAreaTotal().': '.$this->getUnidadeTotal().'">'.$this->ocupacaoString($this->getAreaTotal(), $intOcupacaoArea).':&nbsp;'.$this->ocupacaoString($this->getUnidadeTotal(), $intOcupacaoUnidade, TRUE).'</span>';
					break;				
				case "Chacara":
					return '<span title="'.$this->getAreaTerreno().': '.$this->getUnidadeTerreno().'">'.$this->ocupacaoString($this->getAreaTerreno(), $intOcupacaoArea).':&nbsp;'.$this->ocupacaoString($this->getUnidadeTerreno(), $intOcupacaoUnidade, TRUE).'</span>';
					break;
				case "Fazenda":
					return '<span title="'.$this->getAreaTerreno().': '.$this->getUnidadeTerreno().'">'.$this->ocupacaoString($this->getAreaTerreno(), $intOcupacaoArea).':&nbsp;'.$this->ocupacaoString($this->getUnidadeTerreno(), $intOcupacaoUnidade, TRUE).'</span>';
					break;
				default:
					return '<span title="'.$this->getAreaPrivativa().': '.$this->getUnidadePrivativa().'">'.$this->ocupacaoString($this->getAreaPrivativa(), $intOcupacaoArea).':&nbsp;'.$this->ocupacaoString($this->getUnidadePrivativa(), $intOcupacaoUnidade, TRUE).'</span>';
					break;
			}
		}

		private function getAreaPrivativa()
		{
			return parent::MascaraValorTela($this->str_areaPrivativa);
		}

		private function getAreaTerreno()
		{
			return parent::MascaraValorTela($this->str_areaTerreno);
		}

		private function getAreaTotal()
		{
			return parent::MascaraValorTela($this->str_areaTotal);
		}

		private function getUnidadePrivativa()
		{
			return $this->str_unidadePrivativa;
		}

		private function getUnidadeTerreno()
		{
			return $this->str_unidadeTerreno;
		}

		private function getUnidadeTotal()
		{
			return $this->str_unidadeTotal;
		}
	
		public function getUf()
		{
			return $this->str_uf;
		}	

		public function getMunicipio()
		{
			return $this->str_municipios;
		}	

		public function getBairro()
		{
			return $this->str_bairro;
		}	

		public function getTipoNegocio()
		{
			return $this->str_tipoNegocio;
		}	

		public function getSubTipoNegocio()
		{
			return $this->str_subTipoNegocio;
		}

		public function getValorImovel()
		{
			if ($this->getVerValorImovel() == "t")
			{
				return parent::MascaraValorTela($this->str_valorImovel);				
			}else
			{
				return 'Sob Consulta';
			}
		}	

		public function getValorIptu()
		{
			if ($this->getVerValorOutros() == "t")
			{
				return parent::MascaraValorTela($this->str_valorIptu);
			}else
			{
				return 'Sob Consulta';
			}
		}	

		public function getValorCondominio()
		{
			if ($this->getVerValorOutros() == "t")
			{
				return parent::MascaraValorTela($this->str_valorCondominio);
			}else
			{
				return 'Sob Consulta';
			}			
		}	

		public function getValorTaxasExtras()
		{
			if ($this->getVerValorOutros() == "t")
			{
				return parent::MascaraValorTela($this->str_valorTaxasExtras);
			}else
			{
				return 'Sob Consulta';
			}
		}	

		public function getVerValorImovel()
		{
			return $this->bln_verValorImovel;
		}	

		public function getVerValorOutros()
		{
			return $this->bln_verValorOutros;
		}	

		public function getDescricaoImovel()
		{
			return $this->str_descricaoImovel;
		}	

		public function getDt_entrega()
		{
			return $this->dt_entrega;
		}	

		public function getPosicaoSatelite()
		{
			$codigoMapa = '';
			if ($this->str_posicaoSatelite != '')
			{
				$str_posicaoSatelite = $this->sequenceCrypt($this->str_posicaoSatelite, 2, true);
				$linkClick 			 = str_replace($this->retornaNomePaginaAtual(), "", $_SERVER['SCRIPT_NAME']).'mostraMapaImovel.php?str_posicaoSatelite='.$str_posicaoSatelite;
				
				$largura = $this->retornaLarguraAlturaSatelite($this->str_posicaoSatelite, 'width="');
				$altura  = $this->retornaLarguraAlturaSatelite($this->str_posicaoSatelite, 'eight="');
				
				$acaoClick = "GB_showCenter('Mapa do Imóvel', '".$linkClick."', ".$altura.", ".$largura.");";
			
				$codigoMapa = '<td width="22" height="22" valign="top" class="top_grupoRes_top_btn_MapaImovel" ></td>';
				$codigoMapa.= '<td>&nbsp;<span class="adm_fonteTextoGrupo_01"><a href="#" style="font-size: 15px;" onClick="'.$acaoClick.'" title="Mapa do Imóvel">Mapa</a></span></td>';
			}else
			{
				$codigoMapa = '<td width="22" height="22" valign="top" ></td><td>&nbsp;</td>';
			}
			return $codigoMapa;
		}	

		public function getConstrutora()
		{
			return $this->str_construtora;
		}	

		public function getEmpreendimento()
		{
			return $this->str_empreendimento;
		}

		//============================================================================//
		//                        GETS Contato do Proprietário                        //
		//============================================================================//		
		public function getTelResidencialProprietario()
		{
			return $this->str_telResidencialProprietario;
		}
		
		public function getTelComercialProprietario()
		{
			return $this->str_telComercialProprietario;
		}
		
		public function getTelCelularProprietario()
		{
			return $this->str_telCelularProprietario;
		}
		
		public function getEmailProprietario()
		{
			return $this->str_emailProprietario;
		}


		//============================================================================//
		//                        GETS Link FORUM                                     //
		//============================================================================//		
		public function getLinkForum()
		{
			return "http://".$_SERVER["SERVER_NAME"].str_replace($this->retornaNomePaginaAtual(), "",$_SERVER["SCRIPT_NAME"])."/forum/phpBB3/";
		}		
		//============================================================================//

		public function setTitulo($string)
		{
			$this->tituloHTML = $string;
		}			

		public function showVersao()
		{
			return $this->versao;
		}
		
		public function showTitulo()
		{
			return $this->tituloHTML;
		}

		//============================================================================//
		//                              Busca Nome da Pagina Atual.                   //
		//============================================================================//
		public function retornaNomeArquivo()
		{
			$nome_arquivo = str_replace(".php", "", $_SERVER['SCRIPT_NAME']);
			$quantidade = strlen($nome_arquivo);
		
			for ($cont = $quantidade; $cont > 0; $cont--) 
			{ 
				if (substr($nome_arquivo, $cont, 1) == "/")
				{
				   $nome_arquivo = substr($nome_arquivo, $cont + 1, $quantidade).".php";
				}
			}
			return $nome_arquivo;
		}
 
  		//============================================================================//
		//                        Inicializa Perfil Acesso Aministrativo              //
		//============================================================================//
 
 		public function permissaoModificarDados($str_nivel, $bln_visualizaPagina)
		{
			if ($bln_visualizaPagina)
			{
				if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_planoContratos.php')	
				{
					//    1 - Usuario 
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_modifica = false;
							break;
						case 2:
							$this->bln_modifica	= false;
							break;
						case 3:
							$this->bln_modifica	= true;
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_contrato.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_modifica	= false;
							break;
						case 2:
							$this->bln_modifica	= true;
							break;
						case 3:
							$this->bln_modifica	= true;
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_usuario.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_modifica	= false;
							break;
						case 2:
							$this->bln_modifica	= true;
							break;
						case 3:
							$this->bln_modifica	= true;
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_configuracoes.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_modifica	= true;
							break;
						case 2:
							$this->bln_modifica	= false;
							break;
						case 3:
							$this->bln_modifica	= true;
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_configuracoesEmpresa.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_modifica	= true;
							break;
						case 2:
							$this->bln_modifica	= false;
							break;
						case 3:
							$this->bln_modifica	= true;
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_moldesBanner.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_modifica	= false;
							break;
						case 2:
							$this->bln_modifica	= false;
							break;
						case 3:
							$this->bln_modifica	= true;
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_banners.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_modifica	= true;
							break;
						case 2:
							$this->bln_modifica	= false;
							break;
						case 3:
							$this->bln_modifica	= true;
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_municipios.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_modifica	= false;
							break;
						case 2:
							$this->bln_modifica	= false;
							break;
						case 3:
							$this->bln_modifica	= true;
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_construtoras.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_modifica	= true;
							break;
						case 2:
							$this->bln_modifica	= false;
							break;
						case 3:
							$this->bln_modifica	= true;
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_proprietario.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_modifica	= true;
							break;
						case 2:
							$this->bln_modifica	= false;
							break;
						case 3:
							$this->bln_modifica	= true;
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_imoveis.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_modifica	= true;
							break;
						case 2:
							$this->bln_modifica	= false;
							break;
						case 3:
							$this->bln_modifica	= true;
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_imagensImovel.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_modifica	= true;
							break;
						case 2:
							$this->bln_modifica	= false;
							break;
						case 3:
							$this->bln_modifica	= true;
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_arquivosImovel.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_modifica	= true;
							break;
						case 2:
							$this->bln_modifica	= false;
							break;
						case 3:
							$this->bln_modifica	= true;
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_sateliteImovel.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_modifica	= true;
							break;
						case 2:
							$this->bln_modifica	= false;
							break;
						case 3:
							$this->bln_modifica	= true;
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_rssFeed.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_modifica	= true;
							break;
						case 2:
							$this->bln_modifica	= false;
							break;
						case 3:
							$this->bln_modifica	= true;
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_rssFeedItem.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_modifica	= true;
							break;
						case 2:
							$this->bln_modifica	= false;
							break;
						case 3:
							$this->bln_modifica	= true;
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_newsLetters.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_modifica	= true;
							break;
						case 2:
							$this->bln_modifica	= false;
							break;
						case 3:
							$this->bln_modifica	= true;
							break;
					}
				}				
			}else
			{
?>
					<script>
						alertMenssage ('Aviso:','Seu nível de acesso não te dá permissão para acessar esta sessão.');
						window.location = "adm_principal.php";
					</script>
<?php }
		}
		
		public function getBln_modifica()
		{
			if ($this->bln_modifica)
			{
				return '';
			}else
			{
				return 'disabled="disabled"';
			}
		}
 
 		public function atribuirQueryComponenteResultados($nomePagina, $ordenacao='', $id_query='')
		{
			switch ($nomePagina) 
			{
				case 'adm_ajaxComponente_planoContratos.php':
				$this->arrayCampos = 	  array('id_plano',
												'str_nomeplano',
												'bln_tipoinforme',
												'int_quantidadeinformes',
												'bln_tipobanner',
												'int_quantidadethemas',
												'bln_quantidadevisitas',
												'bln_quantidadebuscas',
												'bln_construtoras',
												'bln_empreendimentos',
												'bln_subtipoimovel',
												'bln_valoriptu',
												'bln_valorcondominio',
												'bln_sala',
												'bln_banheiro',
												'bln_suite',
												'bln_garagem',
												'bln_uf',
												'bln_municipio',
												'bln_dtentrega',
												'bln_pacotediluido',
												'str_valorpacotesistema',
												'str_valormensalsistema'
												);
				$this->arrayOrdenacao =	  array('Cadastro',						'id_plano',
												'Nome do Plano',				'str_nomeplano',
												'Valor do Sistema',				'str_valorpacotesistema',
												'Valor das Mensalidades',		'str_valormensalsistema'
												);
				$this->arrayExibicaoCampos = 			  array('/planoContratoPB.png', 	false,
																'id_plano', 				false,
																'', 						true,
																'bln_tipoinforme', 			false,
																'int_quantidadeinformes', 	false,
																'bln_tipobanner', 			false,
																'int_quantidadethemas',		false,
																'bln_quantidadevisitas',	false,
																'bln_quantidadebuscas',		false,
																'bln_construtoras',			false,
																'bln_empreendimentos',		false,
																'bln_subtipoimovel',		false,
																'bln_valoriptu',			false,
																'bln_valorcondominio',		false,
																'bln_sala',					false,
																'bln_banheiro',				false,
																'bln_suite',				false,
																'bln_garagem',				false,
																'bln_uf',					false,
																'bln_municipio',			false,
																'bln_dtentrega',			false,
																'Pacote Diluído',			true,
																'Valor Pacote',				true,
																'Valor Mensal',				true
																);
					if($ordenacao != "")
					{
						$this->str_queryTabelas = 'from msf.plano '.$ordenacao; 
					}else
					{
						$this->str_queryTabelas = 'from msf.plano '; 
					}
					break;
				case 'adm_ajaxComponente_contrato.php':
				$this->arrayCampos = 	  array('id_contrato',
												'str_numerocontrato',
												'str_nomeresponsavelcontrato',
												'str_nomevendedorsistema',
												'bln_pessoafisica',
												'str_cnpj',
												'str_cpf',
												'str_complemento',
												'id_numerocep',
												'str_telefone',
												'id_plano',
												'dt_iniciovigencia',
												'dt_finalvigencia',
												'str_diavencimento',
												'bln_contratoativo'
												);
				$this->arrayOrdenacao =	  array('Cadastro',						'id_contrato',
												'Nº. Contrato',					'str_numerocontrato',
												'Responsavel',					'str_nomeresponsavelcontrato'
												);
				$this->arrayExibicaoCampos = 			  array('/contratoPB.png', 				false,
																'id_contrato',					false,
																'',								true,
																'Responsavel',					true,
																'str_nomevendedorsistema',		false,
																'bln_pessoafisica',				false,
																'str_cnpj',						false,
																'str_cpf',						false,
																'str_complemento',				false,
																'id_numerocep',					false,
																'Tel.',							true,
																'id_plano',						false,
																'dt_iniciovigencia',			false,
																'dt_finalvigencia',				false,
																'str_diavencimento',			false,
																'Ativo',						true
																);
					if($ordenacao != "")
					{
						$this->str_queryTabelas = 'from msf.contrato '.$ordenacao; 
					}else
					{
						$this->str_queryTabelas = 'from msf.contrato '; 
					}
					break;
				case 'adm_ajaxComponente_usuario.php':
				$this->arrayCampos = 	  array('id_usuario',
												'str_nome',
												'str_senha',
												'str_email',
												'str_nivelacesso',
												'str_nomeimobiliaria',
												'str_telefone',
												'id_contrato'
												);
				$this->arrayOrdenacao =	  array('Cadastro',						'id_usuario',
												'Nome',							'str_nome',
												'email',						'str_email',
												'Acesso',						'str_nivelacesso',
												'Número Contrato',				'id_contrato'
												);
				$this->arrayExibicaoCampos = 			  array('/usuarioPB.png', 		false,
																'id_usuario',			false,
																'',						true,
																'str_senha',			false,
																'',						true,
																'Acesso.',				true,
																'str_nomeimobiliaria',	false,
																'Tel.',					true,
																'id_contrato',			false
																);
					if($ordenacao != "")
					{
						$this->str_queryTabelas = 'from msf.usuario '.$ordenacao; 
					}else
					{
						$this->str_queryTabelas = 'from msf.usuario '; 
					}				
					break;
				case 'adm_ajaxComponente_configuracoes.php':
				$this->arrayCampos = 	  array('id_configuracao',
												'str_nomesite',
												'int_quantidadevisita',
												'int_quantidadebusca',
												'str_tipoinforme',
												'int_quantidadeinformes',
												'str_bannermediolargo',
												'str_bannermediocurto',
												'str_bannerbaixo',
												'str_ufpadrao',
												'str_emailchat',
												'id_theme',
												'id_banner'
												);
				$this->arrayOrdenacao =	  array('Cadastro',						'id_configuracao',
												'Configuração',					'str_nomesite'
												);
				$this->arrayExibicaoCampos = 			  array('/configuracaoPB.png', 		false,
																'id_configuracao',			false,
																'',							true,
																'Top Visitas',				true,
																'Top Buscas',				true,
																'Tipo Informe',				true,
																'int_quantidadeinformes',	false,
																'str_bannermediolargo',		false,
																'str_bannermediocurto',		false,
																'str_bannerbaixo',			false,
																'Padrão',					true,
																'str_emailchat',			false,
																'id_theme',					false,
																'id_banner',				false
																);
					if($ordenacao != "")
					{
						$this->str_queryTabelas = 'from msf.configuracao '.$ordenacao; 
					}else
					{
						$this->str_queryTabelas = 'from msf.configuracao '; 
					}				
					break;
					
				case 'adm_ajaxComponente_configuracoesEmpresa.php':
				$this->arrayCampos = 	  array('id_empresa',
												'str_tituloitem',
												'str_descricaoitem',
												'id_configuracao',
												'dt_publicacao'
												);

				$this->arrayOrdenacao =	  array('Cadastro',						'id_empresa',
												'Título',						'str_tituloitem',
												'Descrição',					'str_descricaoitem',
												'Data Publicação',				'dt_publicacao'
												);

				$this->arrayExibicaoCampos = 			  array('/configuracaoPB.png', 			false,
																'id_empresa',					false,
																'',								true,	//str_tituloitem
																'',								true,	//str_descricaoitem
																'id_configuracao',				false,	//
																'',								true 	//dt_publicacao
																);
					if ($id_query != '')
					{
						if($ordenacao != "")
						{
							$this->str_queryTabelas = 'from msf.empresa '.$this->retornoCondicaoResultadosAdministrativo('id_configuracao', $id_query, false).$ordenacao; 
						}else
						{
							$this->str_queryTabelas = 'from msf.empresa '.$this->retornoCondicaoResultadosAdministrativo('id_configuracao', $id_query, false); 
						}
					}else
					{
						if($ordenacao != "")
						{
							$this->str_queryTabelas = 'from msf.empresa '.$ordenacao; 
						}else
						{
							$this->str_queryTabelas = 'from msf.empresa '; 
						}
					}
					break;
					
				case 'adm_ajaxComponente_moldesBanner.php':
				$this->arrayCampos = 	  array('id_moldes',
												'str_nomemolde',
												'str_diretoriomolde',
												'str_tipomolde',
												'bln_modificar',
												'int_posicaox',
												'int_posicaoy',
												'int_posicaogx',
												'int_posicaogy'
												);
				$this->arrayOrdenacao =	  array('Cadastro',						'id_moldes',
												'Nome do Molde',				'str_tipomolde',
												'Tipo do Molde',				'str_tipomolde',
												'Modificavel',					'bln_modificar'
												);
				$this->arrayExibicaoCampos = 			  array('/moldeBannerPB.png', 		false,
																'id_moldes',				false,
																'',							true,
																'str_diretoriomolde',		false,
																'Tipo do Molde',			true,
																'Modificavel',				true,
																'int_posicaox',				false,
																'int_posicaoy',				false,
																'int_posicaogx',			false,
																'int_posicaogy',			false
																);
					if($ordenacao != "")
					{
						$this->str_queryTabelas = 'from msf.moldes '.$ordenacao; 
					}else
					{
						$this->str_queryTabelas = 'from msf.moldes '; 
					}
					break;
				case 'adm_ajaxComponente_banners.php':
				$this->arrayCampos = 	  array('id_banner',
												'str_nomebanner',
												'str_localbanner',
												'str_diretoriobanner',
												'dt_inicialbanner',
												'dt_finalbanner',
												'str_titulobanner',
												'str_chamadabanner',
												'str_conteudobanner',
												'bln_moldebanner',
												'id_moldes'
												);
				$this->arrayOrdenacao =	  array('Cadastro',						'id_moldes',
												'Nome do Banner',				'str_nomebanner',
												'Local do Banner',				'str_localbanner',
												'Início da Publicação',			'dt_inicialbanner',
												'Final da Publicação',			'dt_finalbanner'
												);
				$this->arrayExibicaoCampos = 			  array('/bannersPB.png', 			false,
																'id_banner',				false,
																'',							true,
																'',							true,
																'str_diretoriobanner',		false,
																'dt_inicialbanner',			false,
																'dt_finalbanner',			false,
																'str_titulobanner',			false,
																'str_chamadabanner',		false,
																'str_conteudobanner',		false,
																'Possui Molde',				true,
																'id_moldes',				false
																);
					if($ordenacao != "")
					{
						$this->str_queryTabelas = 'from msf.banner '.$ordenacao; 
					}else
					{
						$this->str_queryTabelas = 'from msf.banner '; 
					}
					break;
				case 'adm_ajaxComponente_municipios.php':
				$this->arrayCampos = 	  array('BA.id_municipio as id_municipio',
												'str_uf',
												'str_municipios',
												'BA.id_bairro',
												'str_bairro',
												'id_numerocep'
												);
				$this->arrayOrdenacao =	  array('Cadastro',						'id_municipio',
												'UF',							'str_uf',
												'Municípios',					'str_municipios',
												);
				$this->arrayExibicaoCampos = 			  array('/municipiosPB.png', 		false,
																'id_municipio', 			false,
																'', 						true,
																'', 						true,
																'BA.id_bairro', 			false,
																'', 						true,
																'id_numerocep', 			false
																);
					if($ordenacao != "")
					{
						$this->str_queryTabelas = 'from msf.municipio MU 
						inner join msf.bairro BA on (MU.id_municipio=BA.id_municipio) 
						inner join msf.logradouro LO on (BA.id_bairro=LO.id_bairro) '.$ordenacao; 
					}else
					{
						$this->str_queryTabelas = 'from msf.municipio MU 
						inner join msf.bairro BA on (MU.id_municipio=BA.id_municipio) 
						inner join msf.logradouro LO on (BA.id_bairro=LO.id_bairro) '; 
					}
					break;
				case 'adm_ajaxComponente_construtoras.php':
				$this->arrayCampos = 	  array('id_construtora',
												'str_construtora',
												'str_empreendimento'
												);
				$this->arrayOrdenacao =	  array('Cadastro',						'id_construtora',
												'Construtora',					'str_construtora',
												'Empreendimento',				'str_empreendimento'
												);
				$this->arrayExibicaoCampos = 			  array('/construtorasPB.png', 			false,
																'id_construtora',				false,
																'',								true,
																'',								true
																);
					if($ordenacao != "")
					{
						$this->str_queryTabelas = 'from msf.construtora '.$ordenacao; 
					}else
					{
						$this->str_queryTabelas = 'from msf.construtora '; 
					}																
					break;
				case 'adm_ajaxComponente_proprietario.php':
				$this->arrayCampos = 	  array('id_proprietario',
												'str_nomeproprietario',
												'str_profissaoproprietario',
												'str_cpfProprietario',
												'str_nacionalidadeproprietario',
												'str_naturalidadeproprietario',
												'str_complemento',
												'id_numerocep',
												'str_telresidencialproprietario',
												'str_telcomercialproprietario',
												'str_telcelularproprietario',
												'str_emailproprietario'
												);
				$this->arrayOrdenacao =	  array('Cadastro',						'id_proprietario',
												'Nome',							'str_nomeproprietario',
												'Profissão',					'str_profissaoproprietario',
												'CPF',							'str_cpfProprietario',
												'E-mail',						'str_emailproprietario'
												);
				$this->arrayExibicaoCampos = 			  array('/proprietarioPB.png', 			false,
																'id_proprietario',				false,
																'',								true,
																'str_profissaoproprietario',	false,
																'str_cpfProprietario',			false,
																'str_nacionalidadeproprietario',false,
																'str_naturalidadeproprietario',	false,
																'str_complemento',				false,
																'id_numerocep',					false,
																'',								true,//	tel residencial
																'str_telcomercialproprietario',	false,
																'',								true,//	tel celular
																'',								true //	email
																);
					if($ordenacao != "")
					{
						$this->str_queryTabelas = 'from msf.proprietario '.$ordenacao; 
					}else
					{
						$this->str_queryTabelas = 'from msf.proprietario '; 
					}
					break;
				case 'adm_ajaxComponente_imoveis.php':
				$this->arrayCampos = 	  array('id_imovel',
												'str_tipoimovel',
												'str_subtipoimovel',
												'str_situacaoimovel',
												'str_mobiliado',
												'int_quarto',
												'int_sala',
												'int_banheiro',
												'int_suite',
												'int_garagem',
												'str_areaprivativa',
												'str_areaterreno',
												'str_areatotal',
												'str_unidadeprivativa',
												'str_unidadeterreno',
												'str_unidadetotal',
												'id_bairro',
												'str_tiponegocio',
												'str_subtiponegocio',
												'str_valorimovel',
												'str_valoriptu',
												'str_valorcondominio',
												'str_valortaxasextras',
												'bln_vervalorimovel',
												'bln_vervaloroutros',
												'str_descricaoimovel',
												'dt_entrega',
												'str_construtora',
												'str_empreendimento',
												'bln_promocao',
												'bln_ativo',
												'id_proprietario'
												);
				$this->arrayOrdenacao =	  array('Cadastro',						'id_imovel',
												'Tipo de Imóvel',				'str_tipoimovel',
												'Categoria do Imóvel',			'str_subtipoimovel',
												'Situação do Imóvel',			'str_situacaoimovel',
												'Mobiliado',					'str_mobiliado',
												'Tipo do Negócio',				'str_tiponegocio',
												'Valor do Imóvel',				'str_valorimovel',
												'Bairro',						'id_bairro'
												);
				$this->arrayExibicaoCampos = 			  array('/imovelPB.png', 		false,
																'id_imovel', 			false,
																'', 					true,
																'str_subtipoimovel', 	false,
																'str_situacaoimovel',	false,
																'str_mobiliado', 		false,
																'int_quarto', 			false,
																'int_sala', 			false,
																'int_banheiro', 		false,
																'int_suite', 			false,
																'int_garagem', 			false,
																'str_areaprivativa', 	false,
																'str_areaterreno', 		false,
																'str_areatotal', 		false,
																'str_unidadeprivativa', false,
																'str_unidadeterreno', 	false,
																'str_unidadetotal', 	false,
																'id_bairro', 			false,
																'', 					true,
																'str_subtiponegocio', 	false,
																'Valor',				true,
																'str_valoriptu', 		false,
																'str_valorcondominio', 	false,
																'str_valortaxasextras', false,
																'bln_vervalorimovel', 	false,
																'bln_vervaloroutros', 	false,
																'str_descricaoimovel', 	false,
																'dt_entrega', 			false,
																'str_construtora', 		false,
																'str_empreendimento', 	false,
																'bln_promocao', 		false,
																'Ativo', 				true,
																'id_proprietario', 		false
																);
					if ($id_query != '')
					{
						if($ordenacao != "")
						{
							$this->str_queryTabelas = 'from msf.imovel '.$this->retornoCondicaoResultadosAdministrativo('id_proprietario', $id_query, false).$ordenacao; 
						}else
						{
							$this->str_queryTabelas = 'from msf.imovel '.$this->retornoCondicaoResultadosAdministrativo('id_proprietario', $id_query, false); 
						}
					}else
					{
						if($ordenacao != "")
						{
							$this->str_queryTabelas = 'from msf.imovel '.$ordenacao; 
						}else
						{
							$this->str_queryTabelas = 'from msf.imovel '; 
						}
					}				
					break;
				case 'adm_ajaxComponente_imagensImovel.php':
				
				$this->arrayCampos = 	  array('id_imagensimovel',
												'str_imagensimovel',
												'id_imovel',
												'str_diretorioimagensimovel'
												);
				$this->arrayOrdenacao =	  array('Cadastro',						'id_imagensimovel',
												'Imóvel',						'id_imovel',
												'Nome',							'str_imagensimovel'
												);

				$moldeImagem = '<img src="'.$this->getDirMolde().'MbannerGrupoRes_04.png" width="122" height="106" />';
				$this->arrayExibicaoCampos = 			  array('/imagemPB.png', 				false,
																'id_imagensimovel',				false,
																'',								true, 	//
																'id_imovel',					false,	//
																$moldeImagem,					'mostrarImagem'	//str_diretorioimagensimovel
																);
					if ($id_query != '')
					{
						if($ordenacao != "")
						{
							$this->str_queryTabelas = 'from msf.imagensimovel '.$this->retornoCondicaoResultadosAdministrativo('id_imovel', $id_query, false).$ordenacao; 
						}else
						{
							$this->str_queryTabelas = 'from msf.imagensimovel '.$this->retornoCondicaoResultadosAdministrativo('id_imovel', $id_query, false); 
						}
					}else
					{
						if($ordenacao != "")
						{
							$this->str_queryTabelas = 'from msf.imagensimovel '.$ordenacao; 
						}else
						{
							$this->str_queryTabelas = 'from msf.imagensimovel '; 
						}
					}
					break;
				case 'adm_ajaxComponente_arquivosImovel.php':
				$this->arrayCampos = 	  array('id_arquivosimovel',
												'str_arquivosimovel',
												'id_imovel',
												'str_diretorioarquivosimovel'
												);

				$this->arrayOrdenacao =	  array('Cadastro',						'id_arquivosimovel',
												'Imóvel',						'id_imovel',
												'Nome',							'str_arquivosimovel'
												);

				$this->arrayExibicaoCampos = 			  array('/arquivosPB.png', 				false,
																'id_arquivosimovel',			false,
																'',								true,	//str_arquivosimovel
																'cod. imovel',					true,	//id_imovel
																'str_diretorioarquivosimovel',	false
																);
					if ($id_query != '')
					{
						if($ordenacao != "")
						{
							$this->str_queryTabelas = 'from msf.arquivosimovel '.$this->retornoCondicaoResultadosAdministrativo('id_imovel', $id_query, false).$ordenacao; 
						}else
						{
							$this->str_queryTabelas = 'from msf.arquivosimovel '.$this->retornoCondicaoResultadosAdministrativo('id_imovel', $id_query, false); 
						}
					}else
					{
						if($ordenacao != "")
						{
							$this->str_queryTabelas = 'from msf.arquivosimovel '.$ordenacao; 
						}else
						{
							$this->str_queryTabelas = 'from msf.arquivosimovel '; 
						}
					}
					break;
				case 'adm_ajaxComponente_sateliteImovel.php':
				$this->arrayCampos = 	  array('id_imovel',
												'id_imovel',
												'str_posicaosatelite'
												);
				$this->arrayOrdenacao =	  array('Cadastro',	'id_imovel');
				
				$this->arrayExibicaoCampos = 			  array('/satelitePB.png', 		false,
																'id_imovel', 			false,
																'', 					true,	//id_imovel
																'MapaSatelite', 		false	//str_posicaosatelite
																);
					if ($id_query != '')
					{
						if($ordenacao != "")
						{
							$this->str_queryTabelas = 'from msf.imovel '.$this->retornoCondicaoResultadosAdministrativo('id_imovel', $id_query, false).$ordenacao; 
						}else
						{
							$this->str_queryTabelas = 'from msf.imovel '.$this->retornoCondicaoResultadosAdministrativo('id_imovel', $id_query, false); 
						}
					}else
					{
						if($ordenacao != "")
						{
							$this->str_queryTabelas = 'from msf.imovel '.$ordenacao; 
						}else
						{
							$this->str_queryTabelas = 'from msf.imovel '; 
						}
					}				
					break;
				case 'adm_ajaxComponente_rssFeed.php':
				$this->arrayCampos = 	  array('id_rss',
												'str_titulo',
												'bln_externo',
												'str_linkexterno',
												'str_descricao',
												'str_copyright'
												);

				$this->arrayOrdenacao =	  array('Cadastro',						'id_rss',
												'Título',						'str_titulo',
												'Descrição',					'str_descricao',
												'Externa',						'bln_externo'
												);

				$this->arrayExibicaoCampos = 			  array('/rssPB.png', 					false,
																'id_rss',						false,
																'',								true,//str_titulo																
																'Externa',						true,//bln_externo
																'',								true,//str_linkexterno
																'str_descricao',				false,
																'str_copyright',				false,
																);
					if ($id_query != '')
					{
						if($ordenacao != "")
						{
							$this->str_queryTabelas = 'from msf.rss '.$this->retornoCondicaoResultadosAdministrativo('id_rss', $id_query, false).$ordenacao; 
						}else
						{
							$this->str_queryTabelas = 'from msf.rss '.$this->retornoCondicaoResultadosAdministrativo('id_rss', $id_query, false); 
						}
					}else
					{
						if($ordenacao != "")
						{
							$this->str_queryTabelas = 'from msf.rss '.$ordenacao; 
						}else
						{
							$this->str_queryTabelas = 'from msf.rss '; 
						}
					}
					break;
				case 'adm_ajaxComponente_rssFeedItem.php':
				$this->arrayCampos = 	  array('id_rssitem',
												'id_rss',
												'str_tituloitem',
												'str_descricaoitem',
												'dt_publicacao'
												);

				$this->arrayOrdenacao =	  array('Cadastro',						'id_rssitem',
												'Título',						'str_tituloitem',
												'Descrição',					'str_descricaoitem',
												'Data Publicação',				'dt_publicacao'
												);

				$this->arrayExibicaoCampos = 			  array('/rssPB.png', 					false,
																'id_rssitem',					false,
																'',								true,	//id_rss
																'',								true,	//str_tituloitem
																'',								true,	//str_descricaoitem
																'dt_publicacao',				false
																);
					if ($id_query != '')
					{
						if($ordenacao != "")
						{
							$this->str_queryTabelas = 'from msf.rssitem '.$this->retornoCondicaoResultadosAdministrativo('id_rss', $id_query, false).$ordenacao; 
						}else
						{
							$this->str_queryTabelas = 'from msf.rssitem '.$this->retornoCondicaoResultadosAdministrativo('id_rss', $id_query, false); 
						}
					}else
					{
						if($ordenacao != "")
						{
							$this->str_queryTabelas = 'from msf.rssitem '.$ordenacao; 
						}else
						{
							$this->str_queryTabelas = 'from msf.rssitem '; 
						}
					}
					break;
					
				case 'adm_ajaxComponente_newsLetters.php':
				$this->arrayCampos = 	  array('id_newslettersboletim',
												'bln_enviarnewsletters',
												'str_assunto',
												'str_titulo',
												'str_descricao',
												'dt_publicacao',
												'str_emailresposta',
												
												'str_diretorionewsletters'
												);

				$this->arrayOrdenacao =	  array('Cadastro',						'id_newslettersboletim',
												'Assunto',						'str_assunto',
												'Título',						'str_titulo',
												'Data Publicação',				'dt_publicacao'
												);

				$this->arrayExibicaoCampos = 			  array('/newslettersPB.png', 			false,
																'id_newslettersboletim',		false,
																'',								true,//bln_enviarnewsletters
																'Assunto ',						true,	
																'str_titulo',					false,	
																'str_descricao',				false,	
																'',								true,//dt_publicacao
																'str_emailresposta',			false,
																'str_diretorionewsletters',		false
																);
					if ($id_query != '')
					{
						if($ordenacao != "")
						{
							$this->str_queryTabelas = 'from msf.newslettersboletim '.$this->retornoCondicaoResultadosAdministrativo('id_newslettersboletim', $id_query, false).$ordenacao; 
						}else
						{
							$this->str_queryTabelas = 'from msf.newslettersboletim '.$this->retornoCondicaoResultadosAdministrativo('id_newslettersboletim', $id_query, false); 
						}
					}else
					{
						if($ordenacao != "")
						{
							$this->str_queryTabelas = 'from msf.newslettersboletim '.$ordenacao; 
						}else
						{
							$this->str_queryTabelas = 'from msf.newslettersboletim '; 
						}
					}
					break;					
			}
		}
 
		public function permissaoAcesso($str_nivel, $str_nivelMinimo, $pagina)
		{
			if ($pagina == "AcessDenied")
			{
				//Define quais as paginas os nivel de usuario poderá modificar.
				if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_planoContratos.php')
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor 
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_visualizaPagina	= false;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 2:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 3:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_contrato.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 2:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 3:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_usuario.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 2:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 3:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_configuracoes.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 2:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 3:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_configuracoesEmpresa.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 2:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 3:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_moldesBanner.php')	
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_visualizaPagina	= false;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 2:
							$this->bln_visualizaPagina	= false;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 3:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_banners.php')
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 2:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 3:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_municipios.php')
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 2:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 3:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_construtoras.php')
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 2:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 3:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_proprietario.php')
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 2:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 3:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_imoveis.php')
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 2:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 3:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_imagensImovel.php')
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 2:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 3:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_arquivosImovel.php')
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 2:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 3:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_sateliteImovel.php')
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 2:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 3:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_rssFeed.php')
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 2:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 3:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_rssFeedItem.php')
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 2:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 3:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
					}
				}else if ($this->retornaNomeArquivo() == 'adm_ajaxComponente_newsLetters.php')
				{
					//    1 - Usuario  
					//    2 - Vendas   
					//    3 - Gestor   	
					switch ($this->nivelAcesso($str_nivel)) 
					{
						case 1:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 2:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
						case 3:
							$this->bln_visualizaPagina	= true;
							$this->permissaoModificarDados($str_nivel, $this->bln_visualizaPagina);
							break;
					}
				}
				
			//Define o nivel de acesso mínimo para acessar uma pagina.	
			}else if ($pagina == "")
			{
				if($this->nivelAcesso($str_nivel) > $this->nivelAcesso($str_nivelMinimo))
				{
?>
					<script>
						alertMenssage ('Aviso:','Seu nível de acesso não te dá permissão para acessar essa página.');
						window.location = "../index.php";
					</script>
<?php return false;
				}				
			}
		}

		//Atribui cores aos icones das sessoões que o nivel de usuário permite acesso.
		public function atribuiNivelAcessoIcones($str_nivel)
		{
			//    1 - Usuario  
			//    2 - Vendas   
			//    3 - Gestor  			
			switch ($this->nivelAcesso($str_nivel))
			{
				case 1:
					$this->ico_planoContrato 	='PB';
					$this->ico_contrato			='CL';
					$this->ico_usuario 			='CL';
					$this->ico_configuracoes 	='CL';
					$this->ico_moldesBanner 	='PB';
					$this->ico_banners 			='CL';
					$this->ico_municipios 		='PB';
					$this->ico_construtoras 	='CL';
					$this->ico_imoveis 			='CL';
					$this->ico_rssFeed			='CL';
					$this->ico_newsLetters		='CL';
					break;
		
				case 2:
					$this->ico_planoContrato 	='CL';
					$this->ico_contrato			='CL';
					$this->ico_usuario 			='CL';
					$this->ico_configuracoes 	='CL';
					$this->ico_moldesBanner 	='PB';
					$this->ico_banners 			='CL';
					$this->ico_municipios 		='PB';
					$this->ico_construtoras 	='CL';
					$this->ico_imoveis 			='CL';
					$this->ico_rssFeed			='CL';
					$this->ico_newsLetters		='PB';
					break;

				case 3:
					$this->ico_planoContrato 	='CL';
					$this->ico_contrato			='CL';
					$this->ico_usuario 			='CL';
					$this->ico_configuracoes 	='CL';
					$this->ico_moldesBanner 	='CL';
					$this->ico_banners 			='CL';
					$this->ico_municipios 		='CL';
					$this->ico_construtoras 	='CL';
					$this->ico_imoveis 			='CL';
					$this->ico_rssFeed			='CL';
					$this->ico_newsLetters		='CL';
					break;
			}
	
		}

		//============================================================================//
		//                  Retorno Tempo de Processamento Paginas.                   //
		//============================================================================//
		public function tempoProcessamento($inicioFim)
		{
			$this->startGetTempo = 'DESLIGADO';
			if ($inicioFim == "INICIO")
			{
				$tempo = explode(" ", microtime());
				$this->inicioTempo = $tempo[0]+$tempo[1];
				$this->startGetTempo = 'LIGADO';
			}
			else if ($inicioFim == "FINAL")
			{
				$tempo = explode(" ", microtime());
				$this->finalTempo = $tempo[0] + $tempo[1];	
				if ($this->startGetTempo = 'LIGADO')
				{
					return substr($this->finalTempo - $this->inicioTempo, 0, 10);
				}
			}
		}

//========================================================================================================================================================//
//========================================================================================================================================================//
//========================================================================================================================================================//

		//============================================================================//
		//                 Funçoes CLASSE CONFIGURAÇÕES DO ADM do Site.            //
		//============================================================================//

		private function atribuirViaPost()
		{
			$this->id_configuracao				= $this->sequenceCrypt($_POST["id_configuracao"], $_POST["codSecFormulario"], false);
			$this->id_theme						= $this->sequenceCrypt($_POST["slc_theme"], $_POST["codSecFormulario"], false);
			$this->id_banner					= $this->sequenceCrypt($_POST["slc_banner"], $_POST["codSecFormulario"], false);
			$this->str_nomeSite					= $this->sequenceCrypt($_POST["str_nomeSite"], $_POST["codSecFormulario"], false);
			$this->int_quantidadeVisita			= $this->sequenceCrypt($_POST["str_quantidadeVisita"], $_POST["codSecFormulario"], false);
			$this->int_quantidadeBusca			= $this->sequenceCrypt($_POST["str_quantidadeBusca"], $_POST["codSecFormulario"], false);
			$this->str_tipoInforme				= $this->sequenceCrypt($_POST["slc_tipoInforme"], $_POST["codSecFormulario"], false);
			$this->int_quantidadeInformesInterno= $this->sequenceCrypt($_POST["slc_quantidadeInformes"], $_POST["codSecFormulario"], false);
			$this->str_bannerMedioLargo			= $this->sequenceCrypt($_POST["slc_bannerMedioLargo"], $_POST["codSecFormulario"], false);
			$this->str_bannerMedioCurto			= $this->sequenceCrypt($_POST["slc_bannerMedioCurto"], $_POST["codSecFormulario"], false);
			$this->str_bannerBaixo				= $this->sequenceCrypt($_POST["slc_bannerBaixo"], $_POST["codSecFormulario"], false);
			$this->str_ufPadrao					= $this->sequenceCrypt($_POST["slc_ufPadrao"], $_POST["codSecFormulario"], false);
			$this->str_emailChatInterno			= strtolower($this->sequenceCrypt($_POST["str_emailChatInterno"], $_POST["codSecFormulario"], false));
		}

		public function inicializaVariaveis()
		{
			$this->id_configuracao				= '';
			$this->id_theme						= '1';
			$this->id_banner					= '1';
			$this->str_nomeSite					= '';
			$this->int_quantidadeVisita			= '1';
			$this->int_quantidadeBusca			= '1';
			$this->str_tipoInforme				= 'Fixo';
			$this->int_quantidadeInformesInterno= $this->getQuantidadeInformes();
			$this->str_bannerMedioLargo			= 'Fixo';
			$this->str_bannerMedioCurto			= 'Fixo';
			$this->str_bannerBaixo				= 'Fixo';
			$this->str_ufPadrao					= 'AC';
			$this->str_emailChatInterno			= '';
		}
		
		public function atribuirQuery($objConexao, $int_codigo)
		{
			$query = $this->consultaConfiguracao($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);

			$this->id_theme						= $array["id_theme"];
			$this->id_banner					= $array["id_banner"];
			$this->str_nomeSite					= $array["str_nomesite"];
			$this->int_quantidadeVisita			= $array["int_quantidadevisita"];
			$this->int_quantidadeBusca			= $array["int_quantidadebusca"];
			$this->str_tipoInforme				= $this->codifiStringBancoInterface($objConexao,$array["str_tipoinforme"]);
			$this->int_quantidadeInformesInterno= $array["int_quantidadeinformes"];
			$this->str_bannerMedioLargo			= $this->codifiStringBancoInterface($objConexao,$array["str_bannermediolargo"]);
			$this->str_bannerMedioCurto			= $this->codifiStringBancoInterface($objConexao,$array["str_bannermediocurto"]);
			$this->str_bannerBaixo				= $this->codifiStringBancoInterface($objConexao,$array["str_bannerbaixo"]);
			$this->str_ufPadrao					= $array["str_ufpadrao"];

			$this->str_emailChatInterno			= $array["str_emailchat"];
		}

		public function comboUF($objConexao)
		{
			$sql = "SELECT distinct str_uf from msf.municipio order by str_uf";	
			return	$objConexao->executaSQL($sql);
		}
		
		public function comboThema($objConexao)
		{
			$sql = "SELECT id_theme, str_theme from msf.theme order by id_theme limit ".$this->getQuantidadeThemas();
			return	$objConexao->executaSQL($sql);
		}

		public function comboBanner($objConexao)
		{
			$sql = "SELECT id_banner, str_nomebanner from msf.banner where str_localbanner = 'Banner Topo' order by id_banner, str_nomebanner";
			return	$objConexao->executaSQL($sql);
		}

		private function consultaConfiguracao($objConexao,$int_codigo)	
		{
			$sql = "SELECT * from msf.configuracao where id_configuracao =".$int_codigo;
			return	$objConexao->executaSQL($sql);		
		}

		public function cadastrarConfiguracao($objConexao)
		{
			$this->atribuirViaPost();
			
			$sql	=  "SELECT * from msf.configuracao where str_nomesite = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_nomeSite)."'";

			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) == 0)
			{
				$intCodigo = $this->atualizadorSequence($objConexao, "configuracao", "configuracao_id_configuracao_seq");
				$str_emailChatInterno = $this->retornaEmailChatInterno($this->str_emailChatInterno);
				$sql = "INSERT INTO msf.configuracao
						(
							id_configuracao,
							id_theme,
							id_banner,
							str_nomesite,
							int_quantidadevisita,
							int_quantidadebusca,
							str_tipoinforme,
							int_quantidadeinformes,
							str_bannermediolargo,
							str_bannermediocurto,
							str_bannerbaixo,
							str_ufpadrao,
							str_emailchat
						) VALUES 
						(
							 ".$intCodigo.",
							'".$this->id_theme."',
							'".$this->id_banner."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_nomeSite)."',
							'".$this->int_quantidadeVisita."',
							'".$this->int_quantidadeBusca."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_tipoInforme)."',
							'".$this->int_quantidadeInformesInterno."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_bannerMedioLargo)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_bannerMedioCurto)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_bannerBaixo)."',
							'".$this->str_ufPadrao."',
							'".$str_emailChatInterno."'
						)";
				$sql = str_replace(array("''","**"),"null",$sql);
				$sql = str_replace("*","",$sql);
				
				if ($str_emailChatInterno != false)// Só cadastra se o $str_emailChatInterno for válido.
				{
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
				}

			}else
			{
?>
					<script>
						alertMenssage ('Atenção:','Já existe uma configuração com este nome de site. \nInforme outro nome de site para esta configuração.');
					</script>
<?php return false;	
			}
		}
		
		public function alterarConfiguracao($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT * from msf.configuracao where id_configuracao = ".$this->id_configuracao;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$str_emailChatInterno = $this->retornaEmailChatInterno($this->str_emailChatInterno);
				$sql = "UPDATE msf.configuracao SET
							id_theme					= '".$this->id_theme."',
							id_banner					= '".$this->id_banner."',
							str_nomesite				= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_nomeSite)."',
							int_quantidadevisita		= '".$this->int_quantidadeVisita."',
							int_quantidadebusca			= '".$this->int_quantidadeBusca."',
							str_tipoinforme				= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_tipoInforme)."',
							int_quantidadeinformes		= '".$this->int_quantidadeInformesInterno."',
							str_bannermediolargo		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_bannerMedioLargo)."',
							str_bannermediocurto		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_bannerMedioCurto)."',
							str_bannerbaixo				= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_bannerBaixo)."',
							str_ufpadrao				= '".$this->str_ufPadrao."',
							str_emailchat				= '".$str_emailChatInterno."'			
						where id_configuracao = ".$this->id_configuracao;
				$sql = str_replace(array("''","**"),"null",$sql);
				$sql = str_replace("*","",$sql);

				if ($str_emailChatInterno != false)// Só altera se o $str_emailChatInterno for válido.
				{
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
				}
			}else
			{
?>
					<script>
						alertMenssage ('Atenção:','Esta configuração não foi localizada para ser modificada. <br>Selecione outra configuração.');
					</script>
<?php return false;	
			}
		}
		
		public function excluirConfiguracao($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT * from msf.configuracao where id_configuracao = ".$this->id_configuracao;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql = "DELETE FROM msf.configuracao where id_configuracao = ".$this->id_configuracao;
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
						alertMenssage ('Atenção:','Esta configuração não foi localizada para ser excluída. <br>Selecione outra configuração.');
					</script>
<?php return false;	
			}
		}		

	}
?>