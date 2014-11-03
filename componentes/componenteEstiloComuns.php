<style type="text/css">
/*
===================================================
	Inicio script correção renderização PNG no IE6
===================================================
*/
* html img {
	filter:expression( this.alphaxLoaded ? "" : ( this.src.substr(this.src.length-4)==".png" ? ( (!this.complete) ? "" : this.runtimeStyle.filter= ("progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+this.src+"')")+ (this.onbeforeprint="this.runtimeStyle.filter='';this.src='"+this.src+"'").substr(0,0)+ String(this.alphaxLoaded=true).substr(0,0)+ (this.src="template1/blank.png").substr(0,0) ) : this.runtimeStyle.filter = "" ) );
}
/*
================================================
	Fim script correção renderização PNG no IE6
================================================
*/


/*
=============================================
CSS DO LAYER DE AJUDA SOBRE ADMINISTRATIVO   
=============================================
*/
#help {
	position:absolute;
	margin-top:-5px;
	margin-left:-35px;
	top:5%;
	left:35%;
	z-index:100;
}

/*
=============================================
CSS DO ICONES BAR TOP PORTAL   
=============================================
*/
.bar_ico_Globo {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/iconTemplateSkin.gif);
	background-position:-22px -26px;
	background-repeat:no-repeat;
	height: 25px;
	width: 15px;
}
.bar_ico_Email {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/iconTemplateSkin.gif);
	background-position:-43px -26px;
	background-repeat:no-repeat;
	height: 25px;
	width: 15px;
}
.bar_ico_User {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/iconTemplateSkin.gif);
	background-position:-10px -26px;
	background-repeat:no-repeat;
	height: 25px;
	width: 10px;
}

/*
=============================================
CSS DO BAR TOP PORTAL   
=============================================
*/
.adm_top_Bar_E {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/iconTemplateSkin.gif);
	background-position:-1px -26px;
	height: 25px;
	width: 8px;
}
.adm_top_Bar_D {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/iconTemplateSkin.gif);
	background-position:-111px -26px;
	height: 25px;
	width: 8px;
}
.adm_top_Bar_M {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/iconTemplateSkin.gif);
	background-position:-82px -26px;
	height: 25px;
	width: 27px;
}
.adm_top_Bar_dgrE {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/degradesVerticaisTemplateSkin.gif);
	background-position:0px -135px;
	background-repeat: repeat-x;
	height: 25px;
	width: 350px;
}
.adm_top_Bar_dgrD {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/degradesVerticaisTemplateSkin.gif);
	background-position:0px -161px;
	background-repeat: repeat-x;
	height: 25px;
	width: 360px;
}
/*
=============================================
CSS DO BAR MEDIO DO PORTAL   
=============================================
*/
.adm_med_Bar_E {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/iconTemplateSkin.gif);
	background-position:-73px -1px;
	background-repeat: no-repeat;
	height: 22px;
	width: 8px;
}
.adm_med_Bar_D {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/iconTemplateSkin.gif);
	background-position:-147px -1px;
	background-repeat: no-repeat;
	height: 22px;
	width: 8px;
}
.adm_med_Bar_M {
	height: 22px;
	width: 561px;
	background-color: #474747;
}

/*
=============================================
CSS DAS FONTES DO SISTEMA
=============================================
*/

.adm_fonteBarTop {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #5d696c;
	font-weight: bold;
	vertical-align: middle;
	text-decoration: none;
}

.adm_fonteBarTop a {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #5d696c;
	font-weight: bold;
	vertical-align: middle;
	text-decoration: none;
}
.adm_fonteBarTop a:hover {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: <?php echo $objConfiguracao->getCorTopGrupo();?>;
	font-weight: bold;
	vertical-align: middle;
	text-decoration: none;
}
.adm_fonteBarTop a:visited {
	text-decoration: none;
}

.adm_fonteMenuEsq_01{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #FFFFFF;
	text-decoration: none;
	vertical-align: bottom;
	text-align: left;
}
.adm_fonteMenuEsq_01 a {
	color: #FFFFFF;
	text-decoration: none;
}
.adm_fonteMenuEsq_01 a:hover {
	color: #EEFFD5;
	text-decoration: none;
}
.adm_fonteMenuEsq_01 a:visited {
	color: #FFFFFF;
	text-decoration: none;
}
.adm_fonteFormGrupo_01{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
}
.adm_fonteResTop_01{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: #FFFFFF;
	text-decoration: none;
}
.adm_fonteResTop_01 a {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: #FFFFFF;
	text-decoration: none;
}
.adm_fonteResTop_01 a:hover {
	color: #FFFFFF;
	text-decoration: none;
}
.adm_fonteResTop_01 a:visited {
	color: #FFFFFF;
	text-decoration: none;
}
.adm_fonteResTop_02{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #FFFFFF;
	text-indent: 8px;
}
.adm_fonteResTop_03{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
	text-indent: 8px;
}
.adm_fonteResTop_04{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: #525252;
	vertical-align: bottom;
}
.adm_fonteBoton_01{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	color: #ababab;
}
.adm_fonteTextoGrupo_01{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
	text-align: justify;
	text-decoration: none;
}
.adm_fonteTextoGrupo_01 a{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
	text-align: justify;
	text-decoration: none;
}
.adm_fonteTextoGrupo_01 a:hover{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: <?php echo $objConfiguracao->getCorTopGrupo();?>;
	text-align: justify;
	text-decoration: none;
}
.adm_fonteTextoGrupo_01 a:visited{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
	text-align: justify;
	text-decoration: none;
}
.adm_fonteTextoGrupo_02 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: <?php echo $objConfiguracao->getCorTopGrupo();?>;
	text-decoration: none;
}
.adm_fonteTextoGrupo_02 a {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: <?php echo $objConfiguracao->getCorTopGrupo();?>;
	text-decoration: none;
}
.adm_fonteTextoGrupo_02 a:hover {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: <?php echo $objConfiguracao->getCorTopGrupo();?>;
	text-decoration: none;
}
.adm_fonteTextoGrupo_02 a:visited {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: <?php echo $objConfiguracao->getCorTopGrupo();?>;
	text-decoration: none;
}
.adm_fonteTextoGrupo_03{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
	color: #585858;
	text-align: center;
}
/*
=============================================
CSS DO FORMULARIOS DO PORTAL   
=============================================
*/
.adm_formResCombo_01 {
	border: 1px solid #7f9db9;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
}
.adm_formGrupoTxt_01 {
	border: 1px solid #7f9db9;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
}
/*
=============================================
CSS DA BARRA BOTTON SITE
=============================================
*/
.bottonBar_info {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/bottonBar_info.gif);
	background-repeat: no-repeat;
	height: 37px;
	width: 677px;
}
.bottonBar_logo_02 {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/barrasGrupoConteudoTemplateSkin.gif);
	background-position:-90px -97px;
	background-repeat: no-repeat;
	height: 37px;
	width: 88px;
}

/*
=============================================
CSS DO CALENDARIO
=============================================
*/
.mao {
	cursor: pointer;
}
.dia {
	cursor: pointer;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #FFFFFF;
	background-color: #979797;
	text-align: center;
	vertical-align: middle;
	border: 1px solid #FFFFFF;
	font-weight: bold;
}
.mes {
	cursor: pointer;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #ffffff;
	background-color: #cccccc;
	text-align: center;
	vertical-align: middle;
	font-weight: bold;
	background-repeat: repeat-x;
	text-decoration: none;
}
.data {
	cursor: pointer;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
	text-align: center;
	vertical-align: middle;
	font-weight: normal;
	text-decoration: none;
	border: 1px solid #999999;
	height: 15px;
	width: 25px;
}

.adm_fonteCalendario{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
	text-decoration: none;
	vertical-align: bottom;
	text-align: left;
}
.adm_fonteCalendario a {
	color: #0c0c0c;
	text-decoration: none;
}
.adm_fonteCalendario a:hover {
	color: #0099CC;
	text-decoration: none;
}
.adm_fonteCalendario a:visited {
	color: #666666;
	text-decoration: none;
}

/*
=============================================
CSS DO GRUPO DE RESULTADOS
=============================================
*/
.top_grupoRes_top_01 {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/iconTemplateSkin.gif);
	background-position:-82px -1px;
	background-repeat: no-repeat;
	height: 24px;
	width: 8px;
}
.top_grupoRes_top_02 {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/degradesVerticaisTemplateSkin.gif);
	background-position:0px -74px;
	height: 24px;
	background-repeat: repeat-x;
}
.top_grupoRes_top_03 {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/iconTemplateSkin.gif);
	background-position:-91px -1px;
	background-repeat: no-repeat;
	height: 24px;
	width: 31px;
}
.top_grupoRes_top_04 {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/degradesVerticaisTemplateSkin.gif);
	background-position:0px -26px;
	height: 24px;
	background-repeat: repeat-x;
}
.top_grupoRes_top_05 {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/iconTemplateSkin.gif);
	background-position:-123px -1px;
	background-repeat: no-repeat;	
	height: 24px;
	width: 23px;
}
.top_grupoRes_top_06 {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/degradesVerticaisTemplateSkin.gif);
	background-position:0px -99px;
	background-repeat: repeat-x;
	height: 35px;
}
.top_grupoRes_top_07 {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/iconTemplateSkin.gif);
	background-position:-159px -19px;
	background-repeat: no-repeat;
	height: 35px;
	width: 8px;
}
.top_grupoRes_top_08 {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/degradesHorizontaisTemplateSkin.gif);
	background-position:-41px 0px;
	background-repeat: repeat-y;
	width: 3px;
}
.top_grupoRes_top_09 {
	background-color: <?php echo $objConfiguracao->getCorFundoGrupo();?>;
	height: 11px;
}
.med_grupoRes_E {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/degradesHorizontaisTemplateSkin.gif);
	background-position:-45px 0px;
	width: 3px;
	background-repeat: repeat-y;
}
.med_grupoRes_D {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/degradesHorizontaisTemplateSkin.gif);
	background-position:-49px 0px;
	width: 3px;
	background-repeat: repeat-y;
}
.boton_grupoRes_E {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/iconTemplateSkin.gif);
	background-position:-120px -39px;
	background-repeat: no-repeat;
	width: 8px;
	height: 15px;
}
.boton_grupoRes_D {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/iconTemplateSkin.gif);
	background-position:-129px -39px;
	background-repeat: no-repeat;
	width: 8px;
	height: 15px;
}
.boton_grupoRes_M {
	background-image: url(<?php echo $objConfiguracao->getDirTheme();?>/degradesVerticaisTemplateSkin.gif);
	background-position:0px -235px;
	background-repeat: repeat-x;
	height: 15px;
}
/*
===================================================
	Inicio script CSS BIBLIOTECA GreyBox_v5_53
===================================================
*/
#GB_overlay {
    background-color: <?php echo $objConfiguracao->getCorTopGrupo();?>;
    position: absolute;
    margin: auto;
    top: 0;
    left: 0;
    z-index: 100;
}

#GB_window {
    left: 0;
    top: 0;
    font-size: 1px;
    position: absolute;
    overflow: visible;
    z-index: 150;
}

#GB_window .content {
    width: auto;
    margin: 0;
    padding: 0;
}

#GB_frame {
    border: 0;
    margin: 0;
    padding: 0;
    overflow: auto;
    white-space: nowrap;
}


.GB_Gallery {
    margin: 0 22px 0 22px;
}

.GB_Gallery .content {
    background-color: #fff;
    border: 3px solid #ddd;
}

.GB_header {
    top: 10px;
    left: 0;
    margin: 0;
    z-index: 500;
    position: absolute;
    border-bottom: 2px solid #555;
    border-top: 2px solid #555;
}

.GB_header .inner {
    background-color: #333;
    font-family: Arial, Verdana, sans-serif;
    padding: 2px 20px 2px 20px;
}

.GB_header table {
    margin: 0;
    width: 96%;
    border-collapse: collapse;
}

.GB_header .caption {
    text-align: left;
    color: #eee;
    white-space: nowrap;
    font-size: 20px;
}

.GB_header .close {
    text-align: right;
}

.GB_header .close img {
    z-index: 500;
    cursor: pointer;
}

.GB_header .middle {
    white-space: nowrap;
    text-align: center;
}


#GB_middle {
    color: #eee;
}

#GB_middle img {
    cursor: pointer;
    vertical-align: middle;
}

#GB_middle .disabled {
    cursor: default;
}

#GB_middle .left {
    padding-right: 10px;
}

#GB_middle .right {
    padding-left: 10px;
}


.GB_Window .content {
    background-color: #fff;
    border: 3px solid #ccc;
    border-top: none;
}

.GB_Window .header {
    border-bottom: 1px solid #aaa;
    border-top: 1px solid #999;
    border-left: 3px solid #ccc;
    border-right: 3px solid #ccc;
    margin: 0;

    height: 22px;
    font-size: 12px;
    padding: 3px 0;
    color: #333;
}

.GB_Window .caption {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #007fb2;
	vertical-align: middle;
	font-weight: bold;
    text-align: left;
    white-space: nowrap;
    padding-right: 20px;
}

.GB_Window .close { text-align: right; }
.GB_Window .close span { 
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #007fb2;
	vertical-align: middle;
	font-weight: bold;
    cursor: pointer; 
}
.GB_Window .close img {
    cursor: pointer;
    padding: 0 3px 0 0;
}

.GB_Window .on { border-bottom: 1px solid #333; }
.GB_Window .click { border-bottom: 1px solid red; }


</style>
