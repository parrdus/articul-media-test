<?

use Bitrix\Main\UserTable;
use Bitrix\Main\UI\PageNavigation;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

class CustomUserListComponent extends CBitrixComponent
{
	public function onPrepareComponentParams($arParams)
	{
		//количество пользователей на странице
		if(!$arParams["COUNT"]) $arParams["COUNT"]=10;
		
		//фильтрация
		if(strlen($arParams["FILTER_NAME"])<=0 || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"])){
			$arFilter = array();
		}else{
			$arFilter = $GLOBALS[$arParams["FILTER_NAME"]];
			if(!is_array($arFilter)) $arFilter = array();
			foreach($arFilter as $fKey => $fItem){
				if($fKey==="GROUPS_ID"){
					$arFilter["Bitrix\Main\UserGroupTable:USER.GROUP_ID"] = $fItem;
					unset($arFilter[$fKey]);
				}
			}
		}
		$arParams["FILTER"] = $arFilter;
		
		return $arParams;
	}
	
	public function getUserList()
	{
		$limit = false;
		$offset = false;
		$nav = new PageNavigation("u-list");
		$nav->allowAllRecords(true)
			->setPageSize($this->arParams["COUNT"])
			->initFromUri();
		$offset = $nav->getOffset();
		$limit = $nav->getLimit();
		
		$arSort = Array("ID"=>"ASC");
		$arSelect = Array("*");
		$arFilter = $this->arParams["FILTER"];
		
		$userList = Array();
		$rsUsr = UserTable::getList(Array(
			"order"=>$arSort,
			"filter"=>$arFilter,
			"select"=>$arSelect,
			"limit"=>$limit,
			"offset"=>$offset,
			"count_total" => true,
			"data_doubling"=>false,
		));
		while ($arRes = $rsUsr->fetch()) {
			$userList[] = $arRes;
		}
		
		$nav->setRecordCount($rsUsr->getCount());
		
		return array("USERS"=>$userList, "NAV"=>$nav);
	}
	
	
	public function executeComponent()
	{
		$isAjax = ($this->arParams["AJAX"]=="Y")?true:false;
		
		if($this->startResultCache())
		{
			$this->arResult = $this->getUserList();
			
			if($isAjax)
				$GLOBALS['APPLICATION']->RestartBuffer();
			
			$this->includeComponentTemplate();
			
			if($isAjax)
				die();
		}
		
		return $this->arResult;
	}
	
}

?>