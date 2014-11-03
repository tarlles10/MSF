<!--
===============================================================================================================================
Início tabela
===============================================================================================================================
-->
<table width="765" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="5" colspan="3"></td>
  </tr>
  <tr>
    <td colspan="3" height="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
	        <td width="6"></td>
            <td width="8" class="adm_top_Bar_E"></td>
            <td width="350" class="adm_top_Bar_dgrE">
            	<!-- inicio tabela Login Usuario -->
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="bar_ico_User" ></td>
                    <td align="left" class="adm_fonteBarTop">&nbsp;<A  href="#" onclick="logoffUsuario();" title="Click para sair do Sistema Administrativo">Ol&aacute; <?php echo $objUsuario->getNomeUsuario();?>, <span style="font-weight:normal;">clique para sair</span>.</A>&nbsp;</td>
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
                    <td width="27" align="left" class="bar_ico_Globo"></td>
                    <td width="55" align="left" class="adm_fonteBarTop">&nbsp;Suporte</td>
                    <td width="39"></td>
                    <td width="24" align="left" class="bar_ico_Email" style="cursor: pointer;" onclick="GB_showFullScreen('Política de Privacidade', '../../adm/adm_impressao_politicaPrivacidade.php');" title="Click para ver nossa pol&iacute;tica de privacidade"></td>
                    <td width="90" align="left" class="adm_fonteBarTop"><A  href="#" onclick="javascript:GB_showFullScreen('Pol&iacute;tica de Privacidade', '../../adm/adm_impressao_politicaPrivacidade.php');" title="Click para ver nossa pol&iacute;tica de privacidade">&nbsp;Privacidade</A></td>
                  </tr>
                </table>
                <!-- Fim tabela Contatos -->
			</td>
            <td width="8" class="adm_top_Bar_D"></td>
            <td width="7"></td>
          </tr>
        </table></td>
  </tr>
</table>
<!--
===============================================================================================================================
Final tabela
===============================================================================================================================
-->