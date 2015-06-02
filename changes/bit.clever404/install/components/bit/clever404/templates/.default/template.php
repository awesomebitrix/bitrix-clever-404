<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die('');?>
<?if ( !file_exists( $_SERVER['DOCUMENT_ROOT'].$arResult['PathInfo']['dirname'])){
?><p><?=GetMessage("CLEVER_404_DIR_NOT_EXIST", Array ("#DIR#" => $arResult['PathInfo']['dirname']));?></p>
<form method="post" action="<?php echo $arResult['Path']?>">
    <input type="hidden" name="dir" value="<?php echo $arResult['PathInfo']['dirname']?>">
    <label for="add_index"><?echo getMessage("CLEVER_404_ADD_INDEX")?></label>
    <input type="checkbox" value="Y" id="add_index" name="add_index">
    <input type="submit" name="make" value="Создать раздел">
</form><?
}elseif(file_exists( $_SERVER['DOCUMENT_ROOT'].$arResult['PathInfo']['dirname'])
    && !file_exists( $_SERVER['DOCUMENT_ROOT'].$arResult['Path'])
    && $arResult['PathInfo']['extension']==="php"
) {
    ?><p><?=GetMessage("CLEVER_404_FILE_NOT_EXIST", Array ("#FILE#" => basename($arResult['Path'])));?></p>
    <form method="post" action="<?php echo $arResult['Path']?>">
    <input type="hidden" name="dir" value="<?php echo $arResult['PathInfo']['dirname']?>">
    <input type="hidden" name="newfile" value="<?php echo basename($arResult['Path']);?>">
    <input type="submit" name="make" value="<?echo getMessage("CLEVER_404_CREATE_FILE")?>">
    </form><?
}
?>