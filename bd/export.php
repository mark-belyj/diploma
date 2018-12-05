<!DOCTYPE HTML><html lang='ru' dir='ltr'><head><meta charset="utf-8" /><meta name="referrer" content="no-referrer" /><meta name="robots" content="noindex,nofollow" /><meta http-equiv="X-UA-Compatible" content="IE=Edge" /><link rel="icon" href="favicon.ico" type="image/x-icon" /><link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /><link rel="stylesheet" type="text/css" href="./themes/pmahomme/jquery/jquery-ui.css" /><link rel="stylesheet" type="text/css" href="js/codemirror/lib/codemirror.css?v=4.7.9" /><link rel="stylesheet" type="text/css" href="js/codemirror/addon/hint/show-hint.css?v=4.7.9" /><link rel="stylesheet" type="text/css" href="js/codemirror/addon/lint/lint.css?v=4.7.9" /><link rel="stylesheet" type="text/css" href="phpmyadmin.css.php?nocache=4567685334ltr&amp;server=1" /><link rel="stylesheet" type="text/css" href="./themes/pmahomme/css/printview.css?v=4.7.9" media="print" id="printcss"/><title>phpMyAdmin</title><script data-cfasync="false" type="text/javascript" src="js/get_scripts.js.php?scripts%5B%5D=jquery/jquery.min.js&amp;scripts%5B%5D=jquery/jquery-migrate-3.0.0.js&amp;scripts%5B%5D=sprintf.js&amp;scripts%5B%5D=ajax.js&amp;scripts%5B%5D=keyhandler.js&amp;scripts%5B%5D=jquery/jquery-ui.min.js&amp;scripts%5B%5D=jquery/jquery.cookie.js&amp;scripts%5B%5D=jquery/jquery.mousewheel.js&amp;scripts%5B%5D=jquery/jquery.event.drag-2.2.js&amp;scripts%5B%5D=jquery/jquery-ui-timepicker-addon.js&amp;v=4.7.9"></script><script data-cfasync="false" type="text/javascript" src="js/get_scripts.js.php?scripts%5B%5D=jquery/jquery.ba-hashchange-1.3.js&amp;scripts%5B%5D=jquery/jquery.debounce-1.0.5.js&amp;scripts%5B%5D=menu-resizer.js&amp;scripts%5B%5D=rte.js&amp;scripts%5B%5D=tracekit/tracekit.js&amp;scripts%5B%5D=error_report.js&amp;scripts%5B%5D=config.js&amp;scripts%5B%5D=doclinks.js&amp;scripts%5B%5D=functions.js&amp;scripts%5B%5D=navigation.js&amp;v=4.7.9"></script><script data-cfasync="false" type="text/javascript" src="js/get_scripts.js.php?scripts%5B%5D=indexes.js&amp;scripts%5B%5D=common.js&amp;scripts%5B%5D=page_settings.js&amp;scripts%5B%5D=shortcuts_handler.js&amp;scripts%5B%5D=codemirror/lib/codemirror.js&amp;scripts%5B%5D=codemirror/mode/sql/sql.js&amp;scripts%5B%5D=codemirror/addon/runmode/runmode.js&amp;scripts%5B%5D=codemirror/addon/hint/show-hint.js&amp;scripts%5B%5D=codemirror/addon/hint/sql-hint.js&amp;scripts%5B%5D=codemirror/addon/lint/lint.js&amp;v=4.7.9"></script><script data-cfasync="false" type="text/javascript" src="js/get_scripts.js.php?scripts%5B%5D=codemirror/addon/lint/sql-lint.js&amp;scripts%5B%5D=console.js&amp;v=4.7.9"></script><script data-cfasync='false' type='text/javascript' src='js/whitelist.php?v=4.7.9&amp;token=e73ead2908851bc5e7c454af3389b343'></script><script data-cfasync='false' type='text/javascript' src='js/messages.php?l=ru&amp;v=4.7.9&amp;token=e73ead2908851bc5e7c454af3389b343'></script><script data-cfasync='false' type='text/javascript' src='js/get_image.js.php?theme=pmahomme&amp;v=4.7.9&amp;token=e73ead2908851bc5e7c454af3389b343'></script><script data-cfasync="false" type="text/javascript">// <![CDATA[
PMA_commonParams.setAll({common_query:"?token=e73ead2908851bc5e7c454af3389b343",opendb_url:"db_structure.php",collation_connection:"utf8_general_ci",lang:"ru",server:"1",table:"",db:"",token:"e73ead2908851bc5e7c454af3389b343",text_dir:"ltr",show_databases_navigation_as_tree:"1",pma_text_default_tab:"Обзор",pma_text_left_default_tab:"Структура",pma_text_left_default_tab2:"",LimitChars:"50",pftext:"",confirm:"1",LoginCookieValidity:"3600",session_gc_maxlifetime:"3600",logged_in:"",PMA_VERSION:"4.7.9",auth_type:"cookie",user:""});
ConsoleEnterExecutes=false
AJAX.scriptHandler.add("jquery/jquery.min.js",0).add("jquery/jquery-migrate-3.0.0.js",0).add("whitelist.php",1).add("sprintf.js",1).add("ajax.js",0).add("keyhandler.js",1).add("jquery/jquery-ui.min.js",0).add("jquery/jquery.cookie.js",0).add("jquery/jquery.mousewheel.js",0).add("jquery/jquery.event.drag-2.2.js",0).add("jquery/jquery-ui-timepicker-addon.js",0).add("jquery/jquery.ba-hashchange-1.3.js",0).add("jquery/jquery.debounce-1.0.5.js",0).add("menu-resizer.js",1).add("rte.js",1).add("tracekit/tracekit.js",1).add("error_report.js",1).add("messages.php",0).add("get_image.js.php",0).add("config.js",1).add("doclinks.js",1).add("functions.js",1).add("navigation.js",1).add("indexes.js",1).add("common.js",1).add("page_settings.js",1).add("shortcuts_handler.js",1).add("codemirror/lib/codemirror.js",0).add("codemirror/mode/sql/sql.js",0).add("codemirror/addon/runmode/runmode.js",0).add("codemirror/addon/hint/show-hint.js",0).add("codemirror/addon/hint/sql-hint.js",0).add("codemirror/addon/lint/lint.js",0).add("codemirror/addon/lint/sql-lint.js",0).add("console.js",1);
$(function() {AJAX.fireOnload("whitelist.php");AJAX.fireOnload("sprintf.js");AJAX.fireOnload("keyhandler.js");AJAX.fireOnload("menu-resizer.js");AJAX.fireOnload("rte.js");AJAX.fireOnload("tracekit/tracekit.js");AJAX.fireOnload("error_report.js");AJAX.fireOnload("config.js");AJAX.fireOnload("doclinks.js");AJAX.fireOnload("functions.js");AJAX.fireOnload("navigation.js");AJAX.fireOnload("indexes.js");AJAX.fireOnload("common.js");AJAX.fireOnload("page_settings.js");AJAX.fireOnload("shortcuts_handler.js");AJAX.fireOnload("console.js");});
// ]]></script><noscript><style>html{display:block}</style></noscript></head><body id='loginform'><div id="page_content">
    <div class="container">
    <a href="./url.php?url=https%3A%2F%2Fwww.phpmyadmin.net%2F" target="_blank" rel="noopener noreferrer" class="logo"><img src="./themes/pmahomme/img/logo_right.png" id="imLogo" name="imLogo" alt="phpMyAdmin" border="0" /></a>
       <h1>Добро пожаловать в <bdo dir="ltr" lang="en">phpMyAdmin</bdo></h1><noscript>
<div class="error"><img src="themes/dot.gif" title="" alt="" class="icon ic_s_error" /> Для полноценной работы необходимо включить JavaScript!</div></noscript>
<div class='hide js-show'>    <form method="get" action="index.php" class="disableAjax">
    <input type="hidden" name="db" value="" /><input type="hidden" name="table" value="" /><input type="hidden" name="token" value="e73ead2908851bc5e7c454af3389b343" />
            <fieldset>
            <legend lang="en" dir="ltr"> Язык - <em>Language</em> </legend>
    
    <select name="lang" class="autosubmit" lang="en" dir="ltr" id="sel-lang">

            <!-- Is current one active ?  -->
        <option value="ar"                        >
        &#1575;&#1604;&#1593;&#1585;&#1576;&#1610;&#1577; - Arabic        </option>
            <!-- Is current one active ?  -->
        <option value="hy"                        >
        Հայերէն - Armenian        </option>
            <!-- Is current one active ?  -->
        <option value="az"                        >
        Az&#601;rbaycanca - Azerbaijani        </option>
            <!-- Is current one active ?  -->
        <option value="bn"                        >
        বাংলা - Bangla        </option>
            <!-- Is current one active ?  -->
        <option value="be"                        >
        &#1041;&#1077;&#1083;&#1072;&#1088;&#1091;&#1089;&#1082;&#1072;&#1103; - Belarusian        </option>
            <!-- Is current one active ?  -->
        <option value="pt_br"                        >
        Portugu&ecirc;s - Brazilian Portuguese        </option>
            <!-- Is current one active ?  -->
        <option value="bg"                        >
        &#1041;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080; - Bulgarian        </option>
            <!-- Is current one active ?  -->
        <option value="ca"                        >
        Catal&agrave; - Catalan        </option>
            <!-- Is current one active ?  -->
        <option value="zh_cn"                        >
        &#20013;&#25991; - Chinese simplified        </option>
            <!-- Is current one active ?  -->
        <option value="zh_tw"                        >
        &#20013;&#25991; - Chinese traditional        </option>
            <!-- Is current one active ?  -->
        <option value="cs"                        >
        Čeština - Czech        </option>
            <!-- Is current one active ?  -->
        <option value="da"                        >
        Dansk - Danish        </option>
            <!-- Is current one active ?  -->
        <option value="nl"                        >
        Nederlands - Dutch        </option>
            <!-- Is current one active ?  -->
        <option value="en"                        >
        English        </option>
            <!-- Is current one active ?  -->
        <option value="en_gb"                        >
        English (United Kingdom)        </option>
            <!-- Is current one active ?  -->
        <option value="et"                        >
        Eesti - Estonian        </option>
            <!-- Is current one active ?  -->
        <option value="fi"                        >
        Suomi - Finnish        </option>
            <!-- Is current one active ?  -->
        <option value="fr"                        >
        Fran&ccedil;ais - French        </option>
            <!-- Is current one active ?  -->
        <option value="gl"                        >
        Galego - Galician        </option>
            <!-- Is current one active ?  -->
        <option value="de"                        >
        Deutsch - German        </option>
            <!-- Is current one active ?  -->
        <option value="el"                        >
        &Epsilon;&lambda;&lambda;&eta;&nu;&iota;&kappa;&#940; - Greek        </option>
            <!-- Is current one active ?  -->
        <option value="hu"                        >
        Magyar - Hungarian        </option>
            <!-- Is current one active ?  -->
        <option value="id"                        >
        Bahasa Indonesia - Indonesian        </option>
            <!-- Is current one active ?  -->
        <option value="ia"                        >
        Interlingua        </option>
            <!-- Is current one active ?  -->
        <option value="it"                        >
        Italiano - Italian        </option>
            <!-- Is current one active ?  -->
        <option value="ja"                        >
        &#26085;&#26412;&#35486; - Japanese        </option>
            <!-- Is current one active ?  -->
        <option value="ko"                        >
        &#54620;&#44397;&#50612; - Korean        </option>
            <!-- Is current one active ?  -->
        <option value="lt"                        >
        Lietuvi&#371; - Lithuanian        </option>
            <!-- Is current one active ?  -->
        <option value="nb"                        >
        Norsk - Norwegian        </option>
            <!-- Is current one active ?  -->
        <option value="pl"                        >
        Polski - Polish        </option>
            <!-- Is current one active ?  -->
        <option value="pt"                        >
        Portugu&ecirc;s - Portuguese        </option>
            <!-- Is current one active ?  -->
        <option value="ro"                        >
        Rom&acirc;n&#259; - Romanian        </option>
            <!-- Is current one active ?  -->
        <option value="ru"                                selected="selected"
                        >
        &#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081; - Russian        </option>
            <!-- Is current one active ?  -->
        <option value="sr@latin"                        >
        Srpski - Serbian (latin)        </option>
            <!-- Is current one active ?  -->
        <option value="si"                        >
        &#3523;&#3538;&#3458;&#3524;&#3517; - Sinhala        </option>
            <!-- Is current one active ?  -->
        <option value="sq"                        >
        Shqip - Slbanian        </option>
            <!-- Is current one active ?  -->
        <option value="sk"                        >
        Sloven&#269;ina - Slovak        </option>
            <!-- Is current one active ?  -->
        <option value="sl"                        >
        Sloven&scaron;&#269;ina - Slovenian        </option>
            <!-- Is current one active ?  -->
        <option value="es"                        >
        Espa&ntilde;ol - Spanish        </option>
            <!-- Is current one active ?  -->
        <option value="sv"                        >
        Svenska - Swedish        </option>
            <!-- Is current one active ?  -->
        <option value="tr"                        >
        T&uuml;rk&ccedil;e - Turkish        </option>
            <!-- Is current one active ?  -->
        <option value="uk"                        >
        &#1059;&#1082;&#1088;&#1072;&#1111;&#1085;&#1089;&#1100;&#1082;&#1072; - Ukrainian        </option>
            <!-- Is current one active ?  -->
        <option value="vi"                        >
        Tiếng Việt - Vietnamese        </option>
    
    </select>

            </fieldset>
    
    </form>
</div>
    <br />
    <!-- Login form -->
    <form method="post" action="index.php" name="login_form" class="disableAjax login hide js-show">
        <fieldset>
        <legend>Авторизация<a href="./doc/html/index.html" target="documentation"><img src="themes/dot.gif" title="Документация" alt="Документация" class="icon ic_b_help" /></a></legend><div class="item">
                <label for="input_username">Пользователь:</label>
                <input type="text" name="pma_username" id="input_username" value="" size="24" class="textfield"/>
            </div>
            <div class="item">
                <label for="input_password">Пароль:</label>
                <input type="password" name="pma_password" id="input_password" value="" size="24" class="textfield" />
            </div><div class="item">
                <label for="select_server">Выбор сервера:</label>
                <select name="server" id="select_server"><option value="1"  selected="selected">выбрать</option>
<option value="2" >m1.i.h.mchost.ru (10.0.2.1)</option>
<option value="11" >m10.i.h.mchost.ru (10.0.2.10)</option>
<option value="12" >m11.i.h.mchost.ru (10.0.2.11)</option>
<option value="13" >m12.i.h.mchost.ru (10.0.2.12)</option>
<option value="14" >m13.i.h.mchost.ru (10.0.2.13)</option>
<option value="15" >m14.i.h.mchost.ru (10.0.2.14)</option>
<option value="16" >m15.i.h.mchost.ru (10.0.2.15)</option>
<option value="17" >m16.i.h.mchost.ru (10.0.2.16)</option>
<option value="3" >m2.i.h.mchost.ru (10.0.2.2)</option>
<option value="4" >m3.i.h.mchost.ru (10.0.2.3)</option>
<option value="5" >m4.i.h.mchost.ru (10.0.2.4)</option>
<option value="6" >m5.i.h.mchost.ru (10.0.2.5)</option>
<option value="7" >m6.i.h.mchost.ru (10.0.2.6)</option>
<option value="8" >m7.i.h.mchost.ru (10.0.2.7)</option>
<option value="9" >m8.i.h.mchost.ru (10.0.2.8)</option>
<option value="10" >m9.i.h.mchost.ru (10.0.2.9)</option>
</select></div></fieldset>
        <fieldset class="tblFooters">
            <input value="Вперёд" type="submit" id="input_go" /><input type="hidden" name="target" value="export.php" /><input type="hidden" name="token" value="e73ead2908851bc5e7c454af3389b343" /></fieldset>
    </form></div></div></body></html>