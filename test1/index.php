<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?$APPLICATION->IncludeComponent(
	"test:task1", 
	"", 
	array(
		"IBLOCK_ID"=>1
	),
	false
);?>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>