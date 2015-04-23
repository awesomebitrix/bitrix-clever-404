<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die('');?>
<?if ( !file_exists( $_SERVER['DOCUMENT_ROOT'].$arResult['PathInfo']['dirname'])){
?><p>Раздел "<?php echo $arResult['PathInfo']['dirname'];?>" не существует.</p>
<form method="post" action="<?php echo $arResult['Path']?>">
    <input type="hidden" name="dir" value="<?php echo $arResult['PathInfo']['dirname']?>">
    <label for="add_index">добавить index.php</label><input type="checkbox" value="Y" id="add_index" name="add_index">
    <input type="submit" name="make" value="Создать раздел">
</form><?
}elseif(file_exists( $_SERVER['DOCUMENT_ROOT'].$arResult['PathInfo']['dirname'])
    && !file_exists( $_SERVER['DOCUMENT_ROOT'].$arResult['Path'])
    && $arResult['PathInfo']['extension']==="php"
) {
    ?><p>Файл "<?php echo basename($arResult['Path']);?>" не существует.</p>
    <form method="post" action="<?php echo $arResult['Path']?>">
    <input type="hidden" name="dir" value="<?php echo $arResult['PathInfo']['dirname']?>">
    <input type="hidden" name="newfile" value="<?php echo basename($arResult['Path']);?>">
    <input type="submit" name="make" value="Создать файл">
    </form><?
}
?>