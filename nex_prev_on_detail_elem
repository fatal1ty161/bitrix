<?//создадим файл result_modifier.php
$res = CIBlockElement::GetList(
     array( 'sort' => 'asc' ), 
     array( 'IBLOCK_ID' => $arResult['IBLOCK_ID'], // здесь ID инфоблока, в котором находится элемент 
            'ACTIVE' => 'Y', 
            'SECTION_ID' => $arResult['IBLOCK_SECTION_ID'] ), 
            false, 
array( 'nElementID' => $arResult['ID'], 
        'nPageSize' => 1 
    )
);
$nearElementsSide = 'LEFT';
while ($arElem = $res->GetNext()) { 
    if ($arElem['ID'] == $arResult['ID']) { 
        $nearElementsSide = 'RIGHT'; 
        continue; 
    } 
    $arResult['NEAR_ELEMENTS'][$nearElementsSide][] = $arElem;
}
?>

<? //В шаблоне дернем инфу из массива
if($USER->IsAdmin()) {
    echo "<pre>"; print_r($arResult['NEAR_ELEMENTS']); echo "</pre>";
    };
?>
<? //Вытащим в шаблон нужные нам свойства из ранее полученного массива
?>
<section class="test-section">
<div class="row">
<div class="col-6">
<a href="<?=$arResult['NEAR_ELEMENTS']['LEFT'][0]['DETAIL_PAGE_URL'] ?>">предыдущий элемент<?=$arResult['NEAR_ELEMENTS']['LEFT'][0]['NAME']?>
<img src="<?=CFile::GetPath($arResult['NEAR_ELEMENTS']['LEFT'][0]['DETAIL_PICTURE'])?>">
</a>
</div>
<div class="col-6">
<a href="<?=$arResult['NEAR_ELEMENTS']['RIGHT'][0]['DETAIL_PAGE_URL'] ?>">следующий элемент <?=$arResult['NEAR_ELEMENTS']['RIGHT'][0]['NAME']?>
<img src="<?=CFile::GetPath($arResult['NEAR_ELEMENTS']['RIGHT'][0]['DETAIL_PICTURE'])?>">
</a>
</div>
</div>
</section>
