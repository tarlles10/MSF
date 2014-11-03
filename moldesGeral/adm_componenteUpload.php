<?php $pagina = "AcessDenied";
	$str_acessoMinimo = "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classMoldes.php");
	
	$objMoldes 		 = new moldes($objConexao);
	
	$diretorio 		 = getcwd().DIRECTORY_SEPARATOR;


	if ($_FILES['str_diretorioMolde']['name'] != '')
	{
		$retorno = $objMoldes->atribuirArquivo($objConfiguracao, $objConexao, $_POST['slc_tipoMolde'], $_FILES['str_diretorioMolde'], $diretorio);
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
					window.top.window.retornoUpload('<?php echo basename($_POST['str_diretorioMoldeAux']);?>');
				</script>
<?php }
?>
