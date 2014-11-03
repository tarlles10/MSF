<?php $pagina = "AcessDenied";
	$str_acessoMinimo = "Usuario";

	include("../config/config_Sistema.php");
	include("../class/classBanner.php");
	
	$objBanner 		 = new banner($objConexao);
	
	$diretorio 		 = getcwd().DIRECTORY_SEPARATOR;

	if ($_FILES['str_diretorioBanner']['name'] != '')
	{
		if (!empty($_POST['chk_molde']) && isset($_POST['chk_molde']) || ($_POST['slc_localBanner'] == 'Banner Topo' && empty($_POST['chk_flash']) && !isset($_POST['chk_flash'])))
		{
			if (!empty($_POST['slc_id_moldes']) && isset($_POST['slc_id_moldes']))
			{
				$array[0] = $_POST['slc_id_moldes'];
				if ($_POST['slc_localBanner'] != 'Banner Topo' && empty($_POST['chk_flash']) && !isset($_POST['chk_flash']))
				{
					$array[1] = $_POST['str_tituloBanner'];
					$array[2] = $_POST['str_chamadaBanner'];
				}
				
				$retorno = $objBanner->atribuirArquivo($objConfiguracao, $objConexao, $_POST['slc_localBanner'], $_FILES['str_diretorioBanner'], $diretorio, $array);
			}else
			{
?>
				<script>
					alertMenssage ('Atenção:','Não foi possível localizar o molde para este banner.');
				</script>
<?php $retorno = false;
			}
		}else
		{
			$retorno = $objBanner->atribuirArquivo($objConfiguracao, $objConexao, $_POST['slc_localBanner'], $_FILES['str_diretorioBanner'], $diretorio);
		}
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
					window.top.window.retornoUpload('<?php echo basename($_POST['str_diretorioBannerAux']);?>');
				</script>
<?php }
?>
