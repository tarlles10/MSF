<?php header("Content-Type: text/html; charset=ISO-8859-1",true);
	$pagina = "AcessDenied";
	$str_acessoMinimo = "Usuario";

	include("../config/config_Sistema.php");
	
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="background-repeat:no-repeat; cursor: pointer;" onclick="apresentaHelpGoogleTalk(false)"><img src='<?php echo $objConfiguracao->getDirTheme();?>/HelpGoogleTalk.png' width="538" height="660"/></td>
  </tr>
</table>
