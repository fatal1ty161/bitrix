<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test wb_stock_update");
?>

<?
//Отбираем элементы каталога
CModule::IncludeModule('iblock');
$rs = CIBlockElement::GetList(
    array(), 
    array(
		"IBLOCK_ID" => 17, //ID Инфоблока с товарами
		array("ID" => CIBlockElement::SubQuery("ID", array("IBLOCK_ID" => 17, "!PROPERTY_WB_BARCODE" => false))), //Отбор по принципу заполненности св-ва с штрихкодом для WB
    ),
    false, 
    false,
    array("ID", "NAME", "CATALOG_QUANTITY", "PROPERTY_WB_BARCODE"),
     array()
 );
 //Переменные подключения к API
 $url = "https://suppliers-api.wildberries.ru/api/v2/stocks"; 
$wbstore = '14244'; //ID склада в WB
$headers = array( 
    "Content-type: application/json", 
    "Accept: application/json", 
    "Authorization: auth_tocken"//Ваш токен для авторизации
); 
//Цикл перебора элементов и формирования строки data
while($ar = $rs->GetNext()) {
	$element_name = $ar[NAME];
	$elment_id = $ar[ID];
   $wbbarcode = $ar[PROPERTY_WB_BARCODE_VALUE];
   $wbstock = $ar[CATALOG_QUANTITY];
   $result2 = "[ { \"barcode\": \"{$wbbarcode}\", \"stock\": {$wbstock}, \"warehouseId\": {$wbstore} }]";
//Формируем и передаём запрос
$curl = curl_init(); 
curl_setopt($curl, CURLOPT_URL,$url); 
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); 
curl_setopt($curl, CURLOPT_VERBOSE, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $result2);

$result = curl_exec($curl);
	$errors .= "<li>{$element_name}///{$result}///{$elment_id}</li>";
}
print_r($errors);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
//Останется только повесить это на крон или на агента и сделать отбор по строке на error":true и записывать такие ошибки в лог
