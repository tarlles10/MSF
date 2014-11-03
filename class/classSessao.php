<?php class Sessao
	{
		public function abrirSessao()
		{
			session_start();
		}
		
		public function setNomeSessao($nome_sessao, $valor_sessao)
		{
			$_SESSION[$nome_sessao] = $valor_sessao;
		}
		
		public function getNomeSessao($nome_sessao)
		{
			return (isset($nome_sessao));
		}
		
		public function fecharSessao()
		{
			session_destroy();
		}
	}
?>