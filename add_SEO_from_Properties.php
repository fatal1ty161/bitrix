<? //Получаем SEO свойства
    $iblockId = 8; // ID инфоблока с элементами
    $elementId = $brand_res["ID"]; // Получаем ID из массива элементов 
    $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($iblockId,$elementId);// Тащим SEO свойства
    $arSeoProps = $ipropValues->getValues(); // Записываем в массив
?>
<? //Формируем тайтл элемента и альты и тайтлы для картинок
    $brandtitlepage = $brand_res2 . $arSeoProps["ELEMENT_META_TITLE"];
    $descr_dop = ' с доставкой';
    $branddescrpage = $arSeoProps["ELEMENT_META_DESCRIPTION"] . $brand_res2 . $descr_dop;
    $imgaltelbrand = $brand_res2 . $arSeoProps["ELEMENT_DETAIL_PICTURE_FILE_ALT"];
    $imgtitlebrand = $brand_res2 . $arSeoProps["ELEMENT_DETAIL_PICTURE_FILE_TITLE"];
//echo $brandtitlepage;
?>
<? // Устанавливаем тайтл и дескрипшен для страниц
    $APPLICATION->SetPageProperty('title', $brandtitlepage);
    $APPLICATION->SetPageProperty('description', $branddescrpage);
?>
<? // Печать массива для проверки
    if($USER->IsAdmin()) {
    echo "<pre>"; print_r($arSeoProps); echo "</pre>";
    };
?>
/*Пример установки тайтлов и альтов для картинок*/
<img src="<?=$rsFile["SRC"]?>" alt="<? echo $imgaltelbrand ?>" title="<? echo $imgtitlebrand ?>" srcset="<?=$arFields["SRC"]?>">
