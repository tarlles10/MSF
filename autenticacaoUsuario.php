<?php header("Content-Type: text/html; charset=ISO-8859-1",true);

	$pagina = "";
	$str_acessoMinimo = "";

	include("config/config_Sistema.php");

	//============================================================================//
	//        Condi��es utilizadas para autenticar  e fazer Logoff Usuario        //
	//============================================================================//
	if((isset($_POST["str_login"]) && !empty($_POST["str_login"])) || (isset($_POST["str_senha"]) && !empty($_POST["str_senha"])))
	{
	    if(!$objUsuario->autenticar($objConexao,$objSessao))
		{
?>
			<script>
				window.location='index.php';
				alert('Aten��o: \nO login e senha n�o confere. \nVerifique se a tecla Caps Lock est� ligado.')
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