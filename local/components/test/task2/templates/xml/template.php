<?

//данные которые отдадим в .xml
$arData = array();
foreach($arResult["USERS"] as $arItem)
{
	$arData[] = array(
		"ID"=>$arItem["ID"],
		"LOGIN"=>$arItem["LOGIN"]
	);
}

$filename = "file_".date("Y_m_d__H_i_s")."__".mt_rand(1000,9999).".xml";
$file_path = "/upload/xml/".$filename;

//=========================================
$export = new \Bitrix\Main\XmlWriter(array(
   'file' => $file_path,
   'create_file' => true,
   'charset' => SITE_CHARSET,
   'lowercase' => true //приводить ли все теги к нижнему регистру (для педантов)
));

$export->openFile();
$export->writeBeginTag('users');

foreach($arData as $item)
{
	$export->writeItem($item, 'user');
}

$export->getErrors();
$export->writeEndTag('users');

$export->closeFile();
//=========================================

header("Content-type: text/xml");
header("Content-Disposition: attachment; filename=users.xml");
header("Pragma: no-cache");
header("Expires: 0");

$out = fopen('php://output', 'w');
$filecontent = file_get_contents($_SERVER["DOCUMENT_ROOT"].$file_path);
fwrite($out, $filecontent);
fclose($out);

?>