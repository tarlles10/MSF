<?php
	//============================================================================//
	//                      Ocultar Erros de Pagina		            			  //
	//============================================================================//
	if ($_SERVER["SERVER_NAME"] == 'localhost') // caso esteja trabalhando na produção
	{
		//Não exibe as mensagens de erro, como da tela de login e outras funcionalidades. Habilitar em ambiente de prodiução
		error_reporting (E_ALL ^ E_NOTICE);
        //error_reporting(0);
	}else
	{
		//Exibe as mensagens de erro. Habilitar somente em ambiente de desenvolvimento
		error_reporting(0);
	}

	//============================================================================//
	//                      Segurança dos parametros da URL            			  //
	//============================================================================//
	$cracktrack 	= $_SERVER['QUERY_STRING'];
	$wormprotector 	= array('chr(', 'chr=', 'chr%20', '%20chr', 'wget%20', '%20wget', 'wget(',
							'cmd=', '%20cmd', 'cmd%20', 'rush=', '%20rush', 'rush%20',
							'union%20', '%20union', 'union(', 'union=', 'echr(', '%20echr', 'echr%20', 'echr=',
							'esystem(', 'esystem%20', 'cp%20', '%20cp', 'cp(', 'mdir%20', '%20mdir', 'mdir(',
							'mcd%20', 'mrd%20', 'rm%20', '%20mcd', '%20mrd', '%20rm',
							'mcd(', 'mrd(', 'rm(', 'mcd=', 'mrd=', 'mv%20', 'rmdir%20', 'mv(', 'rmdir(',
							'chmod(', 'chmod%20', '%20chmod', 'chmod(', 'chmod=', 'chown%20', 'chgrp%20', 'chown(', 'chgrp(',
							'locate%20', 'grep%20', 'locate(', 'grep(', 'diff%20', 'kill%20', 'kill(', 'killall',
							'passwd%20', '%20passwd', 'passwd(', 'telnet%20', 'vi(', 'vi%20',
							'insert%20into', 'select%20', 'nigga(', '%20nigga', 'nigga%20', 'fopen', 'fwrite', '%20like', 'like%20',
							'$_request', '$_get', '$request', '$get', '.system', 'HTTP_PHP', '&aim', '%20getenv', 'getenv%20',
							'new_password', '&icq','/etc/password','/etc/shadow', '/etc/groups', '/etc/gshadow',
							'HTTP_USER_AGENT', 'HTTP_HOST', '/bin/ps', 'wget%20', 'unamex20-a', '/usr/bin/id',
							'/bin/echo', '/bin/kill', '/bin/', '/chgrp', '/chown', '/usr/bin', 'g++', 'bin/python',
							'bin/tclsh', 'bin/nasm', 'perl%20', 'traceroute%20', 'ping%20', '.pl', '/usr/X11R6/bin/xterm', 'lsof%20',
							'/bin/mail', '.conf', 'motd%20', 'HTTP/1.', '.inc.php', 'config.php', 'cgi-', '.eml',
							'file://', 'window.open', '<SCRIPT>', 'javascript://','img src', 'img%20src','.jsp','ftp.exe',
							'xp_enumdsn', 'xp_availablemedia', 'xp_filelist', 'xp_cmdshell', 'nc.exe', '.htpasswd',
							'servlet', '/etc/passwd', 'wwwacl', '~root', '~ftp', '.js', '.jsp', 'admin_', '.history',
							'bash_history', '.bash_history', '~nobody', 'server-info', 'server-status', 'reboot%20', 'halt%20',
							'powerdown%20', '/home/ftp', '/home/www', 'secure_site, ok', 'chunked', 'org.apache', '/servlet/con',
							'<script', '/robot.txt' ,'/perl' ,'mod_gzip_status', 'db_mysql.inc', '.inc', 'select%20from',
							'select from', 'drop%20', '.system', 'getenv', 'http_', '_php', 'php_', 'phpinfo()', '<?php', '?>', 'sql=');
		
	$checkworm = str_replace($wormprotector, '*', $cracktrack);
	$nome_arquivo = basename($_SERVER['SCRIPT_NAME']);		
	if (str_replace('.js','',$cracktrack) != str_replace('.js','',$checkworm))
	{
		header("location:$nome_arquivo");
		exit();
	}


	//============================================================================//
	//                      Final Segurança dos parametros da URL            	  //
	//============================================================================//

	if (substr($nome_arquivo, 0, 4) == 'adm_')
	{
		$diretorios = '../';
	}else
	{
		$diretorios = '';
	}
	
	include($diretorios."class/classConexao.php");
	include($diretorios."class/classSessao.php");
	include($diretorios."class/classFuncoesComum.php");
	include($diretorios."class/classConfiguracao.php");
	include($diretorios."class/classUsuario.php");

	$objSessao			= new Sessao();
	$objUsuario			= new Usuario($objSessao);
	$objConexao 		= new Conexao("designcontexto","postgre");
	$objConexao->iniciaConexao();

	$objConfiguracao 	= new Configuracao($objConexao);
	if($pagina == "AcessDenied")
	{
		$objUsuario->verificarUsuarioLogado($objSessao);	
	}

	if($str_acessoMinimo != '')
	{
		$objConfiguracao->permissaoAcesso($objUsuario->getNivelAcesso(), $str_acessoMinimo, $pagina);
	}

?>