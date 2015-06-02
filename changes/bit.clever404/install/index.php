<?php
IncludeModuleLangFile(__FILE__);
Class bit_clever404 extends CModule
{
    var $MODULE_ID = "bit.clever404";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_GROUP_RIGHTS = "Y";

    var $sModulePath;

    function __construct()
    {
        include("version.php");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->PARTNER_NAME = GetMessage("CLEVER_404_PARTNER_NAME");
        $this->PARTNER_URI = GetMessage("CLEVER_404_PARTNER_URI");
        $this->MODULE_NAME = GetMessage("CLEVER_404_MODULE_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("CLEVER_404_MODULE_DESC");

        $this->sModulePath = "/local/modules/";
    }

    function DoInstall()
    {
        global $APPLICATION,$DOCUMENT_ROOT,$USER, $step,$arSitesList;


        if ($USER->IsAdmin())
        {
            RegisterModule($this->MODULE_ID);

            if (CopyDirFiles($_SERVER["DOCUMENT_ROOT"].$this->sModulePath.$this->MODULE_ID."/install/components/",
                $_SERVER["DOCUMENT_ROOT"]."/bitrix/components/", true, true)){

                $sErrorFilePath = $_SERVER["DOCUMENT_ROOT"].'/404.php';
                if ( file_exists($sErrorFilePath) ){
                    //Добавляем вызов компонента на 404
                    $code = 'if ($GLOBALS["USER"]->IsAdmin()) {
                        $APPLICATION->IncludeComponent("bit:clever404", "", Array());
                    }';
                    $sLookingFor = 'require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");';
                    $sFileContent = file_get_contents( $sErrorFilePath );
                    //echo $sFileContent.'<br /><hr>';
                    $sFileContent = str_replace($sLookingFor, "\n".$code."\n".$sLookingFor,$sFileContent );
                    //echo $sFileContent.'<br>';

                    if ( !file_put_contents ( $sErrorFilePath,$sFileContent ) ) die( 'error file 404 update' );
                    $APPLICATION->IncludeAdminFile( GetMessage("CLEVER_404_MODULE_INSTALL_TITLE"),  $DOCUMENT_ROOT.$this->sModulePath.$this->MODULE_ID."/install/step.php");
                    //die("install component.");
                }else {
                    echo CAdminMessage::ShowOldStyleError( getMessage("CLEVER_404_MODULE_INSTALL_ERROR") );
                }
            }else {
                echo CAdminMessage::ShowOldStyleError( getMessage("CLEVER_404_MODULE_INSTALL_ERROR") );
            }
        }
    }

    function DoUninstall()
    {
        global $APPLICATION,$DOCUMENT_ROOT;
        UnRegisterModule($this->MODULE_ID);
        if (DeleteDirFilesEx($_SERVER["DOCUMENT_ROOT"]."/bitrix/components/bit/clever404")){
            die("раздел удален!");
            $APPLICATION->IncludeAdminFile( GetMessage("CLEVER_404_MODULE_UNINSTALL_TITLE"). $this->MODULE_ID, $DOCUMENT_ROOT.$this->sModulePath.$this->MODULE_ID."/install/unstep.php");
        }/*else {
            die("ошибка удаления файлов!");
        }*/
    }

}

?>