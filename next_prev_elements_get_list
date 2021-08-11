<?/*Для выборки элементов воспользуемся функцией CIBlockElement::GetList. 
Чтобы выбрать соседние элементы, достаточно в четвертый параметр добавить значения: 
nElementID равное ID элемента, для которого будем выбирать соседей, и nPageSize, 
которое указывает по сколько соседей с каждой стороны нужно выбрать.*/ 
 $k = 0;
$neighboring = array();
$arSelect = array("ID", "NAME", "DETAIL_PAGE_URL");
$arFilter = array("IBLOCK_ID" => $arResult["IBLOCK_ID"], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(array("SORT" => "ASC", "ID" => "DESC"), $arFilter, false, array("nElementID" => $arResult["ID"], "nPageSize" => 1), $arSelect);
while($ob = $res->GetNext())
{
	if($arResult["ID"] == $ob["ID"])
	{
		$neighboring["CURRENT"] = $ob;
	}
	elseif($k > 0 && !empty($neighboring["CURRENT"]))
	{
		$neighboring["PREV"] = $ob;
	}

	if($k == 0 && empty($neighboring["CURRENT"]))
	{
		$neighboring["NEXT"] = $ob;
	}
	$k++;
}

if(!empty($neighboring)) {
	$arResult["NEIGHTBORING"] = $neighboring;
}
?>
