<?
/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @global CDatabase $DB
 * @global CUserTypeManager $USER_FIELD_MANAGER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponent $this
 */
 
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("iblock")) die();

$getName = $_GET["name"];
if(!$arParams["IBLOCK_ID"]) die("IBLOCK_ID not set");
//$arParams["IBLOCK_ID"] = 1;

if ($this->StartResultCache(false, $getName)) //возможно, второй параметр избыточен
{
	$arSort = array("SORT"=>"ASC", "ID" => "DESC");
	$arFilter = array("%NAME"=> $getName, "IBLOCK_ID"=>$arParams["IBLOCK_ID"]);
	$arSelect = array("ID", "IBLOCK_ID", "NAME", "IBLOCK_SECTION_ID" /*, "*"*/);
	$countElements = 10;
	
	$arSectionIds = array();
	
	$res = CIBlockElement::getList($arSort, $arFilter, false, array("nTopCount" => $countElements), $arSelect);
	while($ob = $res->GetNextElement()){ 
		$arItem = $ob->GetFields();  
		$arItem["PROPERTIES"] = $ob->GetProperties();
		$arResult["ITEMS"][] = $arItem;
		
		if(!in_array($arItem["IBLOCK_SECTION_ID"], $arSectionIds))
			$arSectionIds[]=$arItem["IBLOCK_SECTION_ID"];
	}
	
	if($arSectionIds)
	{
		$arFilter = array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ID"=>$arSectionIds); 
		$rsSect = CIBlockSection::GetList(array(), $arFilter);
		while ($arSect = $rsSect->GetNext())
		{
			$arResult["SECTIONS"][$arSect["ID"]] = $arSect;
		}
	}
	
	$this->IncludeComponentTemplate();
	
}

?>