/*Для того, чтобы все работало, нужно иметь зареганный магазин в aliexpress c уже выгруженными товарами. 
Знать для ваших товаров внутреннние id aliexpress(лучше чтобы уже были заполнены в каком-нибудь свойстве для товаров каталога) и sku_code(артикул при выгрузке на али товаров).
Зарегистрироваться как разработчик в https://developers.aliexpress.com/en/doc.htm?docId=108970&docType=1
Создать там своё приложение и получить необходимые ключи и токен.
Инструкция на русском - https://infostart.ru/1c/articles/1254959/
Скачать SDK для PHP из ЛК разработчика aliexpress - https://console.aliexpress.com/ и положить SDK в папку на сайте */
<?php
set_time_limit(1500); /*Увеличиваем продолжительность выполнения скрипта*/
ini_set('session.gc_maxlifetime', 1500);
$_SERVER["DOCUMENT_ROOT"] = "/var/www/mysite.com/"; /*Добавляем путь до своего сайта иначе при запуске через Cron будет ошибка*/
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");/*Вызываем prolog_before, чтобы инициализировать модуль инфоблока*/
CModule::IncludeModule('iblock');
include "/var/www/mysite.com/mydirectory/aliexpress/TopSdk.php"; /*Подключаем SDK aliexpress*/
    date_default_timezone_set('Asia/Shanghai'); 
    $c = new TopClient;
    $c->appkey = 'your_api_key';
    $c->secretKey = 'your_secret_api_key';
	$sessionKey ='your_token';
  /*При помощи фильтруем товары по нужным нам свойствам*/
$rs = CIBlockElement::GetList(
   array(), 
   array(
   "IBLOCK_ID" => 17, 
   array("ID" => CIBlockElement::SubQuery("ID", array("IBLOCK_ID" => 17, "!PROPERTY_AE_ID" => false))),
   ),
   false, 
   false,
   array("ID", "NAME", "CATALOG_QUANTITY", "PROPERTY_AE_ID"),
    array()
);
/*Перебираем товары и получаем нужные значения и скармливаем в api aliexpress*/
while($ar = $rs->GetNext()) {
	$IDar = $ar[ID];/*артикул товара в aliexpress,он же sku_code, в моём случае это id товаров на сайте*/
	$QNT = $ar[CATALOG_QUANTITY];/*Кол-во товаров на остатке*/
	$AEID = $ar[PROPERTY_AE_ID_VALUE];/*Чтобы работало нужно уже иметь заполненное свойство для товаров, в котором содержуться id именно aliexpress, не путать с id товаров на сайте, это разные вещи*/
    $req = new AliexpressSolutionBatchProductInventoryUpdateRequest;
    $mutiple_product_update_list = new SynchronizeProductRequestDto;
    $mutiple_product_update_list->product_id=$AEID;
    $multiple_sku_update_list = new SynchronizeSkuRequestDto;
    $multiple_sku_update_list->sku_code=$IDar;
    $multiple_sku_update_list->inventory=$QNT;
    $mutiple_product_update_list->multiple_sku_update_list = $multiple_sku_update_list;
    $req->setMutipleProductUpdateList(json_encode($mutiple_product_update_list));
    $resp = $c->execute($req, $sessionKey);
}
/* проверяем и ставим скрипт на крон и ловим профит Profit*/
?>
