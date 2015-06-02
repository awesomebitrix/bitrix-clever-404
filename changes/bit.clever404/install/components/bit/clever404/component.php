<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)die();

//TODO: шаблон создаваемой страницы
define("NEW_DIR_PERMISSION", 0755);
define("DEFAULT_FILE_TEMPLATE","file.php");

//считываем шаблон файла
$this->initComponentTemplate();
$sTemplatePath =  $this->__template->__folder;

$sFileContent = '<' . '?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?' . '>' . PHP_EOL . '<' . '?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>';
if (file_exists( $_SERVER['DOCUMENT_ROOT'].$sTemplatePath.'/'.DEFAULT_FILE_TEMPLATE)){
    $sFileContent = file_get_contents( $_SERVER['DOCUMENT_ROOT'].$sTemplatePath.'/'.DEFAULT_FILE_TEMPLATE );
}


if (isset($_POST['make'])) {

    $newFile = isset($_POST['newfile'])?$_POST['newfile']:"";

    if (isset($_POST['dir']) && !file_exists($_SERVER['DOCUMENT_ROOT'] . $_POST['dir'])
        && preg_match('#^[a-я\w\s\/_-]+$#i',$_POST['dir'])
    ) {
        $dirPath = $_SERVER['DOCUMENT_ROOT'] . $_POST['dir'];
        if (mkdir($dirPath, NEW_DIR_PERMISSION, true)) {
            echo getMessage("CLEVER_404_DIR_CREATED");
            if ($_POST['add_index']==="Y" && empty($newFile)){
                $newFile = "index.php";
            }
        } else {
            echo getMessage("CLEVER_404_ERROR_DIR_CREATE");
        }
    }

    if (!empty($newFile) && preg_match('#^[а-я\w\s\._-]+$#i', $newFile) 
        && preg_match('#^[a-я\w\s\/_-]+$#i',$_POST['dir'])
    ) {
        $sFullFilePath = $_SERVER['DOCUMENT_ROOT'] . $_POST['dir'] . '/' . $newFile;
        if (file_put_contents($sFullFilePath, $sFileContent)) {
            echo getMessage("CLEVER_404_FILE_CREATED");
            $dir = $_POST['dir'] ?$_POST['dir'] . '/':"";
            LocalRedirect( $dir. $newFile);
            return false;
        } else {
            echo getMessage("CLEVER_404_ERROR_FILE_CREATE") . $sFileContent;
        }
    }
}


$arResult['Path'] = $APPLICATION->GetCurPage(true);
$arResult['PathInfo'] = pathinfo($arResult['Path']);

$this->IncludeComponentTemplate();