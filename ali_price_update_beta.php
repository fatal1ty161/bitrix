<? 
set_time_limit(1500);
ini_set('session.gc_maxlifetime', 1500);
$_SERVER["DOCUMENT_ROOT"] = "/var/www/site.com/";
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
include "/var/www/site.com/include/aliexpress/TopSdk.php";
date_default_timezone_set('Asia/Shanghai'); 
$c = new TopClient;
$c->appkey = 'app_key';
$c->secretKey = 'sec_key';
$sessionKey ='session_key';
$rs = CIBlockElement::GetList(
    array(), 
    array(
    "IBLOCK_ID" => 17, 
    array("ID" => CIBlockElement::SubQuery("ID", array("IBLOCK_ID" => 17, "!PROPERTY_AE_ID" => false, "!CATALOG_PRICE_10" => false))),
    ),
    false, 
    false,
    array("ID", "NAME", "PROPERTY_AE_ID", "CATALOG_PRICE_10"),
     array()
 );
 while($ar = $rs->GetNext()) {
	$IDar = $ar[ID];/*артикул товара в aliexpress,он же sku_code, в моём случае это id товаров на сайте*/
	$AEID = $ar[PROPERTY_AE_ID_VALUE];/*Чтобы работало нужно уже иметь заполненное свойство для товаров, в котором содержуться id именно aliexpress, не путать с id товаров на сайте, это разные вещи*/
    $AEPRICE = $ar[CATALOG_PRICE_10]; /*Тип цены*/
    $req = new AliexpressSolutionBatchProductPriceUpdateRequest;
    $mutiple_product_update_list = new SynchronizeProductRequestDto;
    $mutiple_product_update_list->product_id=$AEID;
    $multiple_sku_update_list = new SynchronizeSkuRequestDto;
    $multiple_sku_update_list->price=$AEPRICE;
    $multiple_sku_update_list->sku_code=$IDar;
    $mutiple_product_update_list->multiple_sku_update_list = $multiple_sku_update_list;
    $multi_country_price_configuration = new MultiCountryPriceConfigurationDto;
    $multi_country_price_configuration->price_type="absolute";
    $country_price_list = new SingleCountryPriceDto;
    $country_price_list->ship_to_country="RU";
    $sku_price_by_country_list = new SingleSkuPriceByCountryDto;
    $sku_price_by_country_list->sku_code=$IDar;
    $sku_price_by_country_list->price=$AEPRICE;
    $country_price_list->sku_price_by_country_list = $sku_price_by_country_list;
    $multi_country_price_configuration->country_price_list = $country_price_list;
    $mutiple_product_update_list->multi_country_price_configuration = $multi_country_price_configuration;
    $req->setMutipleProductUpdateList(json_encode($mutiple_product_update_list));
    $resp = $c->execute($req, $sessionKey);
    print_r ($resp);
}
?>
