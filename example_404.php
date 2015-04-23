<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");
?>
    <p>Уважаемый посетитель сайта!<br>
    Запрашиваемая вами страница не существует, либо произошла ошибка!<br>
    Если вы уверены в правильности указанного адреса, то данная страница уже не существует
    на сервере или была переименована.<br><br>
    Попробуйте следующее:<br>
    1. Откройте <a href="/">главную страницу сайта</a> и попробуйте самостоятельно
    найти нужную вам страницу.<br>
    2. Кликните кнопку "Назад" ("Back") вашего броузера, что бы вернуться к предыдущей странице.<br>
    3. Либо перейдите на одну из страниц сайта по ссылке:<br></p>

<?$APPLICATION->IncludeComponent("bitrix:main.map", ".default", Array(
	"LEVEL"	=>	"3",
	"COL_NUM"	=>	"2",
	"SHOW_DESCRIPTION"	=>	"Y",
	"SET_TITLE"	=>	"Y",
	"CACHE_TIME"	=>	"3600"
	)
);
if ($GLOBALS['USER']->IsAdmin()) {
    $APPLICATION->IncludeComponent("bit:clever404", "", Array());
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>