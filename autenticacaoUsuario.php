<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");

	//============================================================================//
	//        Condições utilizadas para autenticar  e fazer Logoff Usuario        //
	//============================================================================//
	if((isset($_POST["str_login"]) && !empty($_POST["str_login"])) || (isset($_POST["str_senha"]) && !empty($_POST["str_senha"])))
	{
	    if(!$objUsuario->autenticar($objConexao,$objSessao))
		{
?>
			<script>
				window.location='index.php';
				alert('Atenção: \nO login e senha não confere. \nVerifique se a tecla Caps Lock está ligado.')
			</script>
<?php }
    }else if ($objUsuario->sequenceCrypt($_POST["logoff"], $_POST["codSec"], false))
	{
		$objUsuario->sair($objSessao)
?>
		<script>
			window.location='../index.php';
		</script>
<?php }
	//============================================================================//
?>