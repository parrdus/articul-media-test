<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?
$template = ".default";
if($_REQUEST["get"]=="csv") $template = "csv";
if($_REQUEST["get"]=="xml") $template = "xml";

?>
<?$APPLICATION->IncludeComponent(
	"test:task2", 
	$template, 
	array(
		"AJAX"=>($_REQUEST["get"])?"Y":"N"
	),
	false
);?>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>