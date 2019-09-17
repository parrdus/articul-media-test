<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<?foreach($arResult["ITEMS"] as $arItem):?>
Название: <?=$arItem["NAME"];?><br/>
Раздел: <?=($arResult["SECTIONS"][$arItem["IBLOCK_SECTION_ID"]])?$arResult["SECTIONS"][$arItem["IBLOCK_SECTION_ID"]]["NAME"]:"";?><br/>
<hr/>
<?endforeach;?>
