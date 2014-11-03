<?php
	$objConfiguracao->tempoProcessamento('INICIO');
?>
<!--
===============================================================================================================================
Início tabela
===============================================================================================================================
-->
<table width="766" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="5" colspan="3"></td>
  </tr>
  <tr>
    <td colspan="3" height="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
	        <td width="3"></td>
            <td width="8" class="adm_top_Bar_E"></td>
            <td width="350" class="adm_top_Bar_dgrE">
            	<!-- inicio tabela Login Usuario -->
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="bar_ico_User" ></td>
                    <td class="adm_fonteBarTop" align="right">&nbsp;Usu&aacute;rio:&nbsp;</td>
                    <td><input name="str_login" type="text" class="adm_formGrupoTxt_01" id="**" style="width:98;" maxlength="70" title="Usu&aacute;rio"></td>
                    <td class="adm_fonteBarTop" align="right">&nbsp;Senha:&nbsp;</td>
                    <td><input name="str_senha" type="password" class="adm_formGrupoTxt_01" id="**" style="width:98;" maxlength="20" onKeyPress="executaFuncaoEnter(event,'loginUsuario();')" title="Senha"></td>
                    <td class="bar_ico_Botao" style="cursor: pointer;" onClick="return loginUsuario();" title="Clique aqui para entrar no Sistema Administrativo" ></td>
                  </tr>
            	</table>
                <!-- Fim tabela Login Usuario -->
            </td>
            <td width="27" class="adm_top_Bar_M"></td>
            <td width="360" class="adm_top_Bar_dgrD">
            	<!-- inicio tabela Contatos-->
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="66"></td>
                    <td width="27" align="left" class="bar_ico_Globo" alt="Saiba mais sobre este Portal"></td>
                    <td width="55" align="left" class="adm_fonteBarTop"><A  href="index.php?cod=Solucoes" title="Click para saber mais sobre este Portal.">&nbsp;Solu&ccedil;&otilde;es</A></td>
                    <td width="39"></td>
                    <td width="24" align="left" class="bar_ico_Email" title="Click para falar Conosco"></td>
                    <td width="90" align="left" class="adm_fonteBarTop"><A  href="index.php?cod=faleConosco" title="Click para falar Conosco">&nbsp;Fale Conosco</A></td>
                  </tr>
                </table>
                <!-- Fim tabela Contatos -->
			</td>
            <td width="8" class="adm_top_Bar_D"></td>
            <td width="10"></td>
          </tr>
        </table></td>
  </tr>
  <tr>
    <td height="5" colspan="3"></td>
  </tr>
  <tr>
    <td width="2"></td>
	<!-- Inicio Tabela Banner Topo -->
    <td width="755" height="121">
<?php $objConfiguracao->InicializarConfiguracao($objConexao);
			$objConfiguracao->atribuirBanner($objConexao, 'Banner Topo');
			echo $objConfiguracao->getDiretorioBanner();	
?>
	</td>
    </td>
    <td width="8"></td>
  </tr>
  <tr>
    <td width="2"></td>
    <td width="755"></td>
    <td width="9"></td>
  </tr>
</table>
<!--
===============================================================================================================================
Final tabela
===============================================================================================================================
-->