<?
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=users.csv");
header("Pragma: no-cache");
header("Expires: 0");

//данные которые отдадим в .csv
$arData = array();
foreach($arResult["USERS"] as $arItem)
{
	$arData[] = array(
		"ID"=>$arItem["ID"],
		"LOGIN"=>$arItem["LOGIN"]
	);
}

//отдача данных
$out = fopen('php://output', 'w');
foreach($arData as $item)
{
	fputcsv($out, $item);
}
fclose($out);
?>