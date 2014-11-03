<?php class contratos extends FuncoesComum 
	{
		private function atribuirViaPost()
		{
			$this->id_contrato					= $this->sequenceCrypt($_POST["id_contrato"], $_POST["codSecFormulario"], false);
			$this->str_numeroContrato			= $this->sequenceCrypt($_POST["str_numeroContrato"], $_POST["codSecFormulario"], false);
			$this->str_nomeResponsavelContrato	= $this->sequenceCrypt($_POST["str_nomeResponsavelContrato"], $_POST["codSecFormulario"], false);
			$this->str_nomeVendedorSistema		= $this->sequenceCrypt($_POST["str_nomeVendedorSistema"], $_POST["codSecFormulario"], false);
			$this->bln_pessoaFisica				= $this->sequenceCrypt($_POST["chk_pessoaFisica"], $_POST["codSecFormulario"], false);
			$this->str_cnpj						= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_cnpj"], $_POST["codSecFormulario"], false));
			$this->str_cpf						= $this->removeLixoDecriptVazio($this->sequenceCrypt($_POST["str_cpf"], $_POST["codSecFormulario"], false));
			$this->str_telefone					= $this->sequenceCrypt($_POST["str_telefone"], $_POST["codSecFormulario"], false);
			$this->id_plano						= $this->sequenceCrypt($_POST["slc_id_plano"], $_POST["codSecFormulario"], false);
			$this->dt_inicioVigencia			= $this->converteDataBanco($this->sequenceCrypt($_POST["str_dtInicioVigencia"], $_POST["codSecFormulario"], false));
			$this->dt_finalVigencia				= $this->converteDataBanco($this->sequenceCrypt($_POST["str_dtFinalVigencia"], $_POST["codSecFormulario"], false));
			$this->str_diaVencimento			= $this->sequenceCrypt($_POST["str_diaVencimento"], $_POST["codSecFormulario"], false);
			$this->bln_contratoAtivo			= $this->sequenceCrypt($_POST["chk_contratoAtivo"], $_POST["codSecFormulario"], false);

			$this->str_complemento				= $this->sequenceCrypt($_POST["str_complemento"], $_POST["codSecFormulario"], false);
			$this->str_uf						= $this->sequenceCrypt($_POST["slc_uf"], $_POST["codSecFormulario"], false);
			$this->id_municipio					= $this->sequenceCrypt($_POST["slc_municipios"], $_POST["codSecFormulario"], false);
			$this->str_municipios				= $this->sequenceCrypt($_POST["str_municipios"], $_POST["codSecFormulario"], false);
			$this->id_bairro					= $this->sequenceCrypt($_POST["slc_bairro"], $_POST["codSecFormulario"], false);
			$this->id_numeroCep					= $this->sequenceCrypt($_POST["slc_descricaoLogradouro"], $_POST["codSecFormulario"], false);

			if ($this->bln_pessoaFisica == 'FALSE')
			{
				$this->str_cnpjDisable				= 'style="width: 125px;"';
				$this->str_cpfDisable				= 'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"';
			}else
			{
				$this->str_cnpjDisable				= 'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"';
				$this->str_cpfDisable				= 'style="width: 125px;"';
			}
			
		}

		public function inicializaVariaveis()
		{
			$this->id_contrato					= "";
			$this->str_numeroContrato			= "";
			$this->str_nomeResponsavelContrato	= "";
			$this->str_nomeVendedorSistema		= "";
			$this->bln_pessoaFisica				= "f";
			$this->str_cnpj						= "";
			$this->str_cpf						= "";
			$this->str_cnpjDisable				= 'style="width: 125px;"';
			$this->str_cpfDisable				= 'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"';
			$this->str_telefone					= "";
			$this->id_plano						= "";
			$this->dt_inicioVigencia			= "";
			$this->dt_finalVigencia				= "";
			$this->str_diaVencimento			= "";
			$this->bln_contratoAtivo			= "t";

			$this->bln_pessoaFisicaAux 			= "";
			$this->bln_contratoAtivoAux			= "";

			$this->str_complemento				= "";
			$this->str_uf						= "";
			$this->id_municipio					= "";
			$this->str_municipios				= "";
			$this->id_bairro					= "";
			$this->str_bairro					= "";
			$this->id_numeroCep					= "";
			$this->str_descricaoLogradouro		= "";
			$this->str_descricaoTipo			= "";


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
			$query = $this->consultaContrato($objConexao,$int_codigo);
			$array = $objConexao->retornaArray($query);

			$this->atribuirQueryMunicipios($objConexao, $array["id_numerocep"]);

			$this->str_numeroContrato			= $this->codifiStringBancoInterface($objConexao,$array["str_numerocontrato"]);
			$this->str_nomeResponsavelContrato	= $this->codifiStringBancoInterface($objConexao,$array["str_nomeresponsavelcontrato"]);
			$this->str_nomeVendedorSistema		= $this->codifiStringBancoInterface($objConexao,$array["str_nomevendedorsistema"]);
			$this->bln_pessoaFisica				= $array["bln_pessoafisica"];
			$this->str_cnpj						= $array["str_cnpj"];
			$this->str_cpf						= $array["str_cpf"];
			$this->str_complemento				= $this->codifiStringBancoInterface($objConexao,$array["str_complemento"]);

			$this->str_telefone					= $array["str_telefone"];
			$this->id_plano						= $array["id_plano"];
			$this->dt_inicioVigencia			= $this->retornaDataNumerica($array["dt_iniciovigencia"], 'DATA_COMPLETA');
			$this->dt_finalVigencia				= $this->retornaDataNumerica($array["dt_finalvigencia"], 'DATA_COMPLETA');
			$this->str_diaVencimento			= $array["str_diavencimento"];
			$this->bln_contratoAtivo			= $array["bln_contratoativo"];

			if ($this->bln_pessoaFisica == 't')
			{
				$this->bln_pessoaFisicaAux = 'true';
				$this->str_cnpjDisable				= 'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"';
				$this->str_cpfDisable				= 'style="width: 125px;"';
			}else
			{
				$this->bln_pessoaFisicaAux = '';
				$this->str_cnpjDisable				= 'style="width: 125px;"';
				$this->str_cpfDisable				= 'style="width: 125px; filter: Alpha(Opacity=25);" disabled="disabled"';
			}
			
			if ($this->bln_contratoAtivo == 't')
			{
				$this->bln_contratoAtivoAux = 'true';
			}else
			{
				$this->bln_contratoAtivoAux = '';
			}
			
		}
		
		public function atribuiVariaveisBoletoContratos($objConexao, $objConfiguracao)
		{
			$int_diasPagamento = 5;
			
			$sql = "SELECT 
						CO.id_contrato,
						CO.str_nomeresponsavelcontrato,
						CO.str_complemento,
						CO.id_bairro,
						CO.str_numerocontrato,
						date(to_char(CURRENT_DATE , 'YYYY-MM')||'-'||CO.str_diavencimento ) as str_diareferecia,
						(date(to_char(CURRENT_DATE , 'YYYY-MM')||'-'||CO.str_diavencimento )+".$int_diasPagamento.") as str_diavencimento,
						CASE WHEN (
									PL.bln_pacotediluido = TRUE AND 
									(to_number(to_char(CURRENT_DATE , 'YYYY'), '9999D') - to_number(to_char(CO.dt_iniciovigencia , 'YYYY'), '9999D')=0)
								  ) 
							 THEN to_number(PL.str_valormensalsistema, '9999999999D99')+(to_number(PL.str_valorpacotesistema, '9999999999D99')/12)
						     WHEN (
							 		PL.bln_pacotediluido = TRUE AND 
									(to_number(to_char(CURRENT_DATE , 'YYYY'), '9999D') - to_number(to_char(CO.dt_iniciovigencia , 'YYYY'), '9999D')=1) AND
									(to_number(to_char(CURRENT_DATE , 'MM'), '99D') < to_number(to_char(CO.dt_iniciovigencia , 'MM'), '99D'))
								  ) 
							 THEN to_number(PL.str_valormensalsistema, '9999999999D99')+(to_number(PL.str_valorpacotesistema, '9999999999D99')/12)
						     WHEN (
							 		PL.bln_pacotediluido = TRUE AND 
									(to_number(to_char(CURRENT_DATE , 'YYYY'), '9999D') - to_number(to_char(CO.dt_iniciovigencia , 'YYYY'), '9999D')=1) AND
									(to_number(to_char(CURRENT_DATE , 'MM'), '99D') >= to_number(to_char(CO.dt_iniciovigencia , 'MM'), '99D'))
								  ) 
							 THEN to_number(PL.str_valormensalsistema, '9999999999D99')
						     WHEN (
							 		PL.bln_pacotediluido = TRUE AND 
									(to_number(to_char(CURRENT_DATE , 'YYYY'), '9999D') - to_number(to_char(CO.dt_iniciovigencia , 'YYYY'), '9999D')>1)
								  ) 
							THEN to_number(PL.str_valormensalsistema, '9999999999D99')
						     WHEN (
							 		PL.bln_pacotediluido = FALSE AND 
									(to_number(to_char(CURRENT_DATE , 'YYYY'), '9999D') - to_number(to_char(CO.dt_iniciovigencia , 'YYYY'), '9999D')>=0) AND
									(to_number(to_char(CURRENT_DATE , 'MM'), '99D') > to_number(to_char(CO.dt_iniciovigencia , 'MM'), '99D'))
								  ) 
							THEN to_number(PL.str_valormensalsistema, '9999999999D99')
						     ELSE to_number(PL.str_valormensalsistema, '9999999999D99')+to_number(PL.str_valorpacotesistema, '9999999999D99')
						END AS str_valordocumento
					from msf.contrato 			CO
					left join msf.plano 		PL on (CO.id_plano = PL.id_plano) 
					left join msf.boleto 		BO on (CO.id_contrato = BO.id_contrato)
					where  
						(CO.bln_contratoativo = TRUE) AND
						((BO.bln_boletoenviado IS NULL AND BO.bln_boletopago IS NULL) OR (BO.bln_boletoenviado <> TRUE AND BO.bln_boletopago <> TRUE)) AND
						(date(to_char(CURRENT_DATE , 'YYYY-MM')||'-'||CO.str_diavencimento )-".$int_diasPagamento.") = CURRENT_DATE";//-".$int_diasPagamento."

			$query = $objConexao->executaSQL($sql);
			if ($objConexao->contaLinhas($query)>0)
			{
				while($array = $objConexao->retornaArray($query))
				{
					$intCodigo = $this->atualizadorSequence($objConexao, "boleto", "boleto_id_boleto_seq");
					$sql = "INSERT INTO msf.boleto
							(
								id_boleto,
								id_contrato,
								str_nossonumero,
								str_numerodocumento,
								dt_datavencimento,
								dt_datadocumento,
								dt_diareferecia,
								str_valorboleto,
								bln_boletoenviado,
								bln_boletopago
							) VALUES 
							(
								*".$intCodigo."*,
								*".$array["id_contrato"]."*,
								lpad('*".$intCodigo."*', 5, '0'),
								lpad('*".$intCodigo."*', 12, '0'),
								'".$array["str_diavencimento"]."',
								CURRENT_DATE,
								'".$array["str_diareferecia"]."',
								'".$array["str_valordocumento"]."',
								FALSE,
								FALSE								
							)";
						
					$sql = str_replace(array("''","**"),"null",$sql);
					$sql = str_replace("*","",$sql);
					$objConexao->executaSQL($sql);
					$this->atribuirQueryGeracaoBoleto($objConexao, $objConfiguracao);
				}
			}
		}
		
		public function atribuirQueryGeracaoBoleto($objConexao, $objConfiguracao, $intCodigo='')
		{
			$sql = "SELECT 
						CO.id_contrato,
						CO.str_numerocontrato,
						CO.str_nomeresponsavelcontrato,
						CO.str_complemento,
						CO.id_bairro,
						US.str_email,
						BO.id_boleto,
						BO.str_nossonumero,
						BO.str_numerodocumento,
						BO.dt_datavencimento,
						BO.dt_datadocumento,
						BO.dt_diareferecia,
						BO.str_valorboleto,
						BO.bln_boletoenviado,
						BO.bln_boletopago
					from msf.boleto 			BO
						left join  msf.contrato CO on (BO.id_contrato = CO.id_contrato)
						inner join  msf.usuario 	US on (CO.id_contrato = US.id_contrato)
					where ";
			
			if($intCodigo=='')
			{
				$sql.= " (US.str_nivelacesso='Usuario') AND (BO.bln_boletoenviado = FALSE OR BO.bln_boletopago = FALSE) order by US.id_usuario asc";
			}else
			{
				$sql.= " (US.str_nivelacesso='Usuario') AND (BO.bln_boletopago = FALSE) AND BO.id_boleto = ".$intCodigo." order by US.id_usuario asc";	
			}
			
			$query = $objConexao->executaSQL($sql);
			if ($objConexao->contaLinhas($query)>0)
			{
				$arrayQuery = $objConexao->retornaArray($query);
				// DADOS DO BOLETO PARA O SEU CLIENTE
				$int_taxaBoleto 					= 2.95;
				$dias_de_prazo_para_pagamento 		= 5;
				
				$dadosboleto["nosso_numero"] 		= $arrayQuery["str_nossonumero"];//"87654";
				$dadosboleto["numero_documento"] 	= $arrayQuery["str_numerodocumento"];//"27.030195.10"; // Num do pedido ou do documento
				$dadosboleto["data_vencimento"] 	= $this->retornaDataNumerica($arrayQuery["dt_datavencimento"], 'DATA_COMPLETA');
				$dadosboleto["data_documento"] 		= date("d/m/Y"); 				// Data de emissão do Boleto
				$dadosboleto["data_processamento"] 	= $this->retornaDataNumerica($arrayQuery["dt_datadocumento"], 'DATA_COMPLETA');
				$dadosboleto["valor_boleto"] 		= number_format(str_replace(",", ".",$arrayQuery["str_valorboleto"])+$int_taxaBoleto, 2, ',', '');
				
				// DADOS DO SEU CLIENTE
				$this->atribuirQueryMunicipios($objConexao, $array["id_bairro"]);
				$dadosboleto["sacado"] 				= $this->codifiStringBancoInterface($objConexao, $arrayQuery["str_nomeresponsavelcontrato"]);
				$dadosboleto["endereco1"] 			= $this->codifiStringBancoInterface($objConexao, $arrayQuery["str_complemento"]);
				$dadosboleto["endereco2"] 			= $this->codifiStringBancoInterface($objConexao, $this->str_municipios." - ".$this->str_uf." ".$this->str_bairro);
				
				// INFORMACOES PARA O CLIENTE
				$dadosboleto["demonstrativo1"] 		= "Pagamento de Pretação de Serviços da ".$objConfiguracao->getEmpresaRazaoSocial();
				$dadosboleto["demonstrativo2"] 		= "Mensalidade referente a ".$this->retornaDataNumerica($arrayQuery["dt_diareferecia"], 'DATA_COMPLETA')."<br>Taxa bancária - R$ ".number_format($int_taxaBoleto, 2, ',', '');
				$dadosboleto["demonstrativo3"] 		= $objConfiguracao->showTitulo()." - ".$objConfiguracao->retornaNomeDominioSSL8($objConfiguracao,TRUE);
				
				// INSTRUÇÕES PARA O CAIXA
				$dadosboleto["instrucoes1"] 		= "- Sr. Caixa, cobrar multa de 15% após o vencimento";
				$dadosboleto["instrucoes2"] 		= "- Receber até 10 dias após o vencimento";
				$dadosboleto["instrucoes3"] 		= "- Em caso de dúvidas entre em contato conosco: ".$objConfiguracao->getEmailParkimovel();
				$dadosboleto["instrucoes4"] 		= "&nbsp; Emitido pelo sistema MetaSoftware da ParkImovel - www.parkimovel.com.br";
				
				// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
				$dadosboleto["quantidade"] 			= "1";
				$dadosboleto["valor_unitario"] 		= number_format(str_replace(",", ".",$arrayQuery["str_valorboleto"])+$int_taxaBoleto, 2, ',', '');
				$dadosboleto["aceite"] 				= "N";		
				$dadosboleto["especie"] 			= "R$";
				$dadosboleto["especie_doc"] 		= "DM";
				
				// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //

				// DADOS DA SUA CONTA - BANCO DO BRASIL
				$dadosboleto["agencia"] 			= "4591"; 	// Num da agencia, sem digito
				$dadosboleto["conta"] 				= "14603"; 	// Num da conta, sem digito
				
				// DADOS PERSONALIZADOS - BANCO DO BRASIL
				$dadosboleto["convenio"]			= "18121585";// Num do convênio - REGRA: 6 ou 7 ou 8 dígitos
				$dadosboleto["contrato"] 			= $arrayQuery["str_numerocontrato"];// Num do seu contrato
				$dadosboleto["carteira"] 			= "18";
				$dadosboleto["variacao_carteira"] 	= "-019";  	// Variação da Carteira, com traço (opcional)
				
				// TIPO DO BOLETO
				$dadosboleto["formatacao_convenio"] 	= "7"; 	// REGRA: 8 p/ Convênio c/ 8 dígitos, 7 p/ Convênio c/ 7 dígitos, ou 6 se Convênio c/ 6 dígitos
				$dadosboleto["formatacao_nosso_numero"] = "2"; 	// REGRA: Usado apenas p/ Convênio c/ 6 dígitos: informe 1 se for NossoNúmero de até 5 dígitos ou 2 para opção de até 17 dígitos
				// SEUS DADOS
				$dadosboleto["identificacao"] 		= $objConfiguracao->getEmpresaRazaoSocial();
				$dadosboleto["cpf_cnpj"] 			= ""; //cpf
				$dadosboleto["endereco"] 			= ""; //endereço
				$dadosboleto["cidade_uf"] 			= ""; //cidade uf
				$dadosboleto["cedente"] 			= 'RESPONSAVÉL PELO PORTAL';

				//============================================================================//
				//Mostra o boleto para o usuário imprimir									  //
				//============================================================================//
				if($intCodigo!='')
				{
					$nome_arquivo = basename($_SERVER['SCRIPT_NAME']);
					if (substr($nome_arquivo, 0, 4) == 'adm_')
					{
						$diretorios = '../';
					}else
					{
						$diretorios = '';
					}
					include($diretorios."adm/boleto_include/adm_funcoes_bb.php"); 
					include($diretorios."adm/boleto_include/adm_layout_bb.php");
					exit();
				}

				//============================================================================//
				//Dados para envio do email													  //
				//============================================================================//
				$cont = 4;//$this->sequenceCrypt('', true, true);
				
				$str_linkConfirmacao = str_replace("adm/","",$this->retornaNomeDominioSSL8($objConfiguracao, TRUE)).'/index.php?codSec='.$cont.'&validacaoBoleto='.$this->sequenceCrypt('"validadoGeradorBoleto"', $cont, true).'&auxfinanceiro='.$this->sequenceCrypt($arrayQuery["id_boleto"], $cont, true);
			
				$arrayEmail["email_resposta"]	= $objConfiguracao->getEmailParkimovel();
				$arrayEmail["assunto"]			= 'Pagamento ParkImovel Mensalidade Ref.'.$this->retornaDataNumerica($arrayQuery["dt_diareferecia"], 'DATA_COMPLETA');
				$arrayEmail["nome_portal"] 		= $objConfiguracao->showTitulo();
				$arrayEmail["email_barra"] 		= 'Mensalidade Ref.'.$this->retornaDataNumerica($arrayQuery["dt_diareferecia"]);

				$arrayEmail["data_atual"] 		= $objConfiguracao->retornaDataAtual('Numerico', 'Interface');
				$arrayEmail["email_titulo"] 	= 'Depto Financeiro ParkImovel Mensalidade Ref.'.$this->retornaDataNumerica($arrayQuery["dt_diareferecia"], 'DATA_COMPLETA');
				
				$arrayEmail["email_titulo_msg"] ='Depto Financeiro<br>
												 '.$objConfiguracao->getEmpresaRazaoSocial().'<br>
												  http://parkimovel.com |<br>
												  http://parkimovel.com.br<br>
												  CPF: cpf do responsavel do portal<br>';
				
				$arrayEmail["email_msg"] 		='<br>
												  <br>
												  <br>
												  <br>
												  Link para boleto: <a href="'.$str_linkConfirmacao.'">Clique aqui</a><br>
												  Valor: '.$dadosboleto["valor_boleto"].'<br>
												  Data de vencimento: '.$dadosboleto["data_vencimento"].'<br>
												  N&ordm;. documento: '.$dadosboleto["numero_documento"].'<br>
												  Produto: Presta&ccedil;&atilde;o de Servi&ccedil;os com Portal Imobili&aacute;rio<br>
												  <br>
												  <br>
												  <br>
												  OBS: Caso o link n&atilde;o possa ser visualizado, copie a linha abaixo na barra de <br>
												endere&ccedil;os do seu navegador para obeter o boleto banc&aacute;rio:<br>'.$str_linkConfirmacao;

				$query = $objConexao->executaSQL($sql);
				while($array = $objConexao->retornaArray($query))
				{
					$arrayEmail["email_destino"] 	= $array['str_email'];
					if($this->corpoLayoutEmail($objConexao, $objConfiguracao, $arrayEmail))
					{
						$sql = "UPDATE msf.boleto SET bln_boletoenviado = TRUE where id_boleto = ".$array["id_boleto"];
						$objConexao->executaSQL($sql);
					}
				}
			}
		}

		public function comboPlanoContratos($objConexao)
		{
			$sql = "SELECT id_plano, str_nomeplano from msf.plano order by id_plano desc";	
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
		
		private function consultaContrato($objConexao,$int_codigo)	
		{
			$sql = "SELECT * from msf.contrato where id_contrato =".$int_codigo;
			return	$objConexao->executaSQL($sql);		
		}

		private function diretivaSegurancaContratoNotifica($objConexao,$objConfiguracao)
		{
			if ($this->nivelAcesso($this->getNivelAcesso())!= 3)
			{
				$this->atribuirViaPost();
				$sql  = "SELECT 
						 US.str_nivelacesso,
						 US.str_email, 
						 US.str_telefone,
						 CO.id_plano,
						 CO.str_numerocontrato, 
						 CO.str_nomeresponsavelcontrato,
						 PL.str_valormensalsistema,
						 now() as notificacao						
						 from msf.usuario 					US 
							 left join msf.contrato 		CO on (US.id_contrato = CO.id_contrato) 
							 left join msf.plano 			PL on (CO.id_plano = PL.id_plano) 
						 where US.str_nome = '".$this->getNomeUsuario()."'";
				$query = $objConexao->executaSQL($sql);
				$array = $objConexao->retornaArray($query);
				
				$sqlAux  = "SELECT str_numerocontrato, str_valormensalsistema 
							from msf.plano 					PL
								left join msf.contrato 		CO on (PL.id_plano = CO.id_plano)
							where PL.id_plano = ".$this->id_plano;		 
				$queryAux = $objConexao->executaSQL($sqlAux);
				$arrayAux = $objConexao->retornaArray($queryAux);
				
				if (intval($arrayAux['str_valormensalsistema']) != intval($array['str_valormensalsistema']))
				{
					$sql = "UPDATE msf.contrato SET bln_contratoativo = FALSE where str_numerocontrato = '".$array["str_numerocontrato"]."'";
					$objConexao->executaSQL($sql);
?>
					<script>
						alertMenssage ('Atenção:','<?php echo strtoupper($this->getNomeUsuario());?> : <br>O sistema notificou uma tentativa não autorizada de alteração. <br>Esta ação violou a 5ª e 8ª cláusula do contrato de prestação de serviço. <br>As partes envolvidas serão notificadas para medidas judiciais cabíveis.');
						setTimeout("logoffUsuario()",10000);
					</script>
<?php $arrayEmail["email_resposta"]	= $objConfiguracao->getEmailParkimovel();
					$arrayEmail["assunto"]			= 'Notificação do Sistema (Quebra de Contrato).';
					$arrayEmail["nome_portal"] 		= $objConfiguracao->showTitulo();
					$arrayEmail["email_barra"]		= 'ALTERAÇÃO NÃO AUTORIZADA';
					$arrayEmail["data_atual"] 		= $objConfiguracao->retornaDataAtual('Numerico', 'Interface');
					
					$arrayEmail["email_titulo"] 	= 'Ocorreu uma tentativa de altera&ccedil;&atilde;o n&atilde;o autorizada pelo usuario '.$this->getNomeUsuario().' no sistema administrativo.';
					
					$arrayEmail["email_titulo_msg"] = 'O sistema METASOFTWARE notificou o usu&aacute;rio '.$this->getNomeUsuario().' tentando alterar o seu contrato de N&ordm;. '.$array['str_numerocontrato'].' para outro contrato de N&ordm;. '.$arrayAux['str_numerocontrato'].'  afim de obter  privil&eacute;gios no sistema.<br>Das OBRIGA&Ccedil;&Otilde;ES DO CONTRATANTE '.$array["str_nomeresponsavelcontrato"].' consta no contrato N&deg;.'.$array["str_numerocontrato"].': ';
					
					$arrayEmail["email_msg"] 		= 'Cl&aacute;usula 5&ordf; - N&atilde;o tentar, ou efetivamente quebrar as senhas, invadir os sites alheios ou burlar a seguran&ccedil;a do sistema (METAFOFTWARE) para obter privil&eacute;gios. Neste caso, ocorrer&aacute; o imediato cancelamento da conta, sem preju&iacute;zo das medidas judiciais cab&iacute;veis.<br>Cl&aacute;usula 8&ordf; - Zelar para que suas informa&ccedil;&otilde;es de acesso (nome de usu&aacute;rio e senha) n&atilde;o sejam "hackeadas", quando utilizar locais p&uacute;blicos ou particulares para acessar &agrave; Internet. <br><br><br>HORARIO: '.$array["notificacao"].' <br>IP: '.$_SERVER['REMOTE_ADDR'].'<br>Browser:'.$_SERVER['HTTP_USER_AGENT'];

					//============================================================================//
					//                     RELATÓRIO DE ENVIO DE NOTIFICAÇÃO CONTRATADO           //
					//============================================================================//
					$arrayEmail["email_destino"] 	= $objConfiguracao->getEmailParkimovel();
					$this->corpoLayoutEmail($objConexao, $objConfiguracao, $arrayEmail);
					//============================================================================//
					//                     RELATÓRIO DE ENVIO DE NOTIFICAÇÃO CONTRATANTE          //
					//============================================================================//			
					$arrayEmail["email_destino"]	= $array["str_email"];
					$this->corpoLayoutEmail($objConexao, $objConfiguracao, $arrayEmail);
					exit();
				}
			}
		}
		
		public function cadastrarContratos($objConexao)
		{
			$this->atribuirViaPost();
			
			$sql	=  "SELECT id_contrato from msf.contrato where str_numerocontrato = '".$this->codifiStringInterfaceBanco($objConexao,$this->str_numeroContrato)."'";
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) == 0)
			{
				$intCodigo = $this->atualizadorSequence($objConexao, "contrato", "contrato_id_contrato_seq");
				$sql = "INSERT INTO msf.contrato
						(
							id_contrato,
							str_numerocontrato,
							str_nomeresponsavelcontrato,
							str_nomevendedorsistema,
							bln_pessoafisica,
							str_cnpj,
							str_cpf,
							str_complemento,
							id_numerocep,
							str_telefone,
							id_plano,
							dt_iniciovigencia,
							dt_finalvigencia,
							str_diavencimento,
							bln_contratoativo
						) VALUES 
						(
							 *".$intCodigo."*, 
							lpad('*".$intCodigo."*', 10, '0'),
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_nomeResponsavelContrato)."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_nomeVendedorSistema)."',
							'".$this->bln_pessoaFisica."',
							'".$this->str_cnpj."',
							'".$this->str_cpf."',
							'".$this->codifiStringInterfaceBanco($objConexao,$this->str_complemento)."',
							*".$this->id_numeroCep."*,
							'".$this->str_telefone."',
							*".$this->id_plano."*,
							'".$this->dt_inicioVigencia."',
							'".$this->dt_finalVigencia."',
							'".$this->str_diaVencimento."',
							'".$this->bln_contratoAtivo."'
							
						)";
				$sql = str_replace(array("''","**"),"null",$sql);
				$sql = str_replace("*","",$sql);

				if ($objConexao->executaSQL($sql))
				{
					$this->atribuirQuery($objConexao, $intCodigo);
?>
					<script>
						alertMenssage ('Aviso:','Cadastrado com sucesso.');
						//mostra contrato
						GB_showFullScreen('CONTRATO DE PRESTAÇÃO DE SERVIÇO', '../../adm/adm_impressao_contrato.php?id_contrato=<?php echo $intCodigo;?>');						
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
						alertMenssage ('Atenção:','Existe já um contrato com este número. <br>Informe outro número para este contrato.');
					</script>
<?php return false;	
			}
		}
		
		public function alterarContratos($objConexao,$objConfiguracao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_contrato from msf.contrato where id_contrato = ".$this->id_contrato;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$this->diretivaSegurancaContratoNotifica($objConexao,$objConfiguracao);
				$sql = "UPDATE msf.contrato SET
							str_numerocontrato			= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_numeroContrato)."', 
							str_nomeresponsavelcontrato	= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_nomeResponsavelContrato)."', 
							str_nomevendedorsistema		= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_nomeVendedorSistema)."', 
							bln_pessoafisica			= '".$this->bln_pessoaFisica."',
							str_cnpj					= '".$this->str_cnpj."',
							str_cpf						= '".$this->str_cpf."',
							str_complemento				= '".$this->codifiStringInterfaceBanco($objConexao,$this->str_complemento)."', 
							id_numerocep				= *".$this->id_numeroCep."*,
							str_telefone				= '".$this->str_telefone."',
							id_plano					= *".$this->id_plano."*,
							dt_iniciovigencia			= '".$this->dt_inicioVigencia."',
							dt_finalvigencia			= '".$this->dt_finalVigencia."',
							str_diavencimento			= '".$this->str_diaVencimento."',
							bln_contratoativo			= '".$this->bln_contratoAtivo."'
						where id_contrato = ".$this->id_contrato;
				
				$sql = str_replace(array("''","**"),"null",$sql);
				$sql = str_replace("*","",$sql);		
				
				if ($objConexao->executaSQL($sql))
				{

?>
					<script>
						alertMenssage ('Aviso:','Alterado com sucesso.');
						//mostra contrato
						GB_showFullScreen('CONTRATO DE PRESTAÇÃO DE SERVIÇO', '../../adm/adm_impressao_contrato.php?id_contrato=<?php echo $this->id_contrato;?>');						
					</script>
<?php $this->inicializaVariaveis();
					return true;
				}else
				{
					return false;
				}

			}else
			{
?>
					<script>
						alertMenssage ('Atenção:','Este contrato não foi localizado para ser alterado. <br>Selecione outro contrato.');
					</script>
<?php return false;	
			}
		}
		
		public function excluirContratos($objConexao)
		{
			$this->atribuirViaPost();
			$sql	=  "SELECT id_contrato from msf.contrato where id_contrato = ".$this->id_contrato;
			$query 	= $objConexao->executaSQL($sql);

			if ($objConexao->contaLinhas($query) > 0)
			{
				$sql	=  "SELECT id_usuario from msf.usuario where id_contrato = ".$this->id_contrato;
				$query 	= $objConexao->executaSQL($sql);
	
				if ($objConexao->contaLinhas($query) == 0)
				{
					$sql = "DELETE FROM msf.contrato where id_contrato = ".$this->id_contrato;
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
						alertMenssage ('Atenção:','Existe usuários vinculados a este contrato. <br>Exclua os usuários vinculados a este contrato ou selecione outro contrato.');
					</script>
<?php }
			}else
			{
?>
					<script>
						alertMenssage ('Atenção:','Não existe nenhum contrato com este número. <br>Selecione outro contrato.');
					</script>
<?php return false;	
			}
		}		
		//============================================================================//
		//                        GETS Dados Imoveis PaginaInicial                    //
		//============================================================================//
		private function getNomeUsuario()
		{
			return $_SESSION["sessao_str_nome"];
		}

		private function getNivelAcesso()
		{
			return $_SESSION["sessao_str_nivelAcesso"];
		}
	}
?>