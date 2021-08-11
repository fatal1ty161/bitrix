<?
$productId = -1;

if (!\Bitrix\Main\Loader::includeModule('catalog')) {
    throw new \Bitrix\Main\SystemException('Ошибка подключения модуля "catalog"');
}

$addResult = Add2BasketByProductID(
    $productId, 
    1, 
    [
        'LID' => 's1',
    ], 
    []
);

if (!$addResult) {

    $strError = '';

    /** @global $APPLICATION $ex */
    if ($ex = $APPLICATION->GetException()) {
        $strError = $ex->GetString();
    }

    echo sprintf('Ошибка добавления товара %s в корзину: %s', $productId, $strError);

} else {

    echo sprintf('Товар %s успешно добавлен в корзину', $productId);

}
?>
