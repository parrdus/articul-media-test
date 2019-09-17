<a href="<?=$APPLICATION->GetCurPageParam("get=csv", array("get"))?>">Скачать .csv</a> <a href="<?=$APPLICATION->GetCurPageParam("get=xml", array("xml"))?>">Скачать .xml</a>
<br/><br/>

<div class="ajax-content">
	<?foreach($arResult["USERS"] as $arItem):?>
	Логин: <?=$arItem["LOGIN"];?><br/>
	<hr/>
	<?endforeach;?>
	<div class="ajax-nav">
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.pagenavigation",
		".default",
		array(
			"NAV_OBJECT" => $arResult["NAV"],
			"SEF_MODE" => "N",
		),
		false
	);?>
	</div>
<div/>
<?

//pr($arResult);

?>