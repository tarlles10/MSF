<?php $pagina = "AcessDenied";
	$str_acessoMinimo = "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classImagemImovel.php");
	
	$objConfiguracao = new Configuracao($objConexao);
	$objImagem 		 = new imagemimovel($objConexao);
	
	$diretorio 		 = getcwd().DIRECTORY_SEPARATOR;


	if ($_FILES['str_diretorioImagensImovel']['name'] != '')
	{
		$retorno = $objImagem->atribuirArquivo($objConfiguracao, $objConexao, $_FILES['str_diretorioImagensImovel'], $diretorio);
		if ($retorno != false)
		{
?>
				<script>
					window.top.window.retornoUpload('<?php echo $retorno;?>');
				</script>
<?php }
	}else
	{
?>
				<script>
					window.top.window.retornoUpload('<?php echo basename($_POST['str_diretorioImagensImovelAux']);?>');
				</script>
<?php }
?>
