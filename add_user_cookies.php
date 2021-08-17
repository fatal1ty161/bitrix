<? $FATREFER=$_SERVER["HTTP_REFERER"];
$utm_med_f = strstr($_SERVER["HTTP_REFERER"], "utm_medium");
$_GET['utm_medium']

$utm_med = $query['utm_medium'];
	$utm_cont = $query['utm_content'];
	$utm_rekl = $query['ad'];
	$utm_camp = $query['utm_campaign'];
	
	setcookie("fanalytics", $test, time() + (86400*5), "/" , "site.com"); //Берем значение переменных из HTTP_REFER и записываем в cookie на 5 дней
    setcookie("fanalytics-source", $frefer, time() + (86400*5), "/" , "site.com"); //Берем значение переменных из HTTP_REFER и записываем в cookie на 5 дней
    setcookie("fanalytics-refer", $freferformat, time() + (86400*5), "/" , "site.com"); //Берем значение переменных из HTTP_REFER и записываем в cookie на 5 дней
    setcookie("fanalytics-ip", $fip, time() + (86400*5), "/" , "site.com"); //Берем значение переменных из HTTP_REFER и записываем в cookie на 5 дней
    setcookie("fanalytics-requri", $frequest, time() + (86400*5), "/" , "site.com"); //Берем значение переменных из HTTP_REFER и записываем в cookie на 5 дней
	setcookie("fanalytics-utmmed", $utmsource, time() + (86400*5), "/" , "site.com"); //Берем значение переменных из HTTP_REFER и записываем в cookie на 5 дней
	setcookie("fanalytics-utmcont", $utmcont, time() + (86400*5), "/" , "site.com"); //Берем значение переменных из HTTP_REFER и записываем в cookie на 5 дней
	setcookie("fanalytics-utmcamp", $utmcamp, time() + (86400*5), "/" , "site.com"); //Берем значение переменных из HTTP_REFER и записываем в cookie на 5 дней
	setcookie("fanalytics-utmad", $utmad, time() + (86400*5), "/" , "site.com"); //Берем значение переменных из HTTP_REFER и записываем в cookie на 5 дней

/* IPUSER - IP-покупателя - fanalytics-ip
	REFUSER - Источник перехода на сайт - fanalytics-refer
	CPCUSER - Тип трафика - fanalytics-utmmed
	UTMCONTUSER - ID товар или тип объявления - fanalytics-utmcont
	UTMCAMPUSER - Группа товаров или название рек компании - fanalytics-utmcamp
	UTMADUSER - Номер рекламного объявления - fanalytics-utmad */

   // сохраняем utm-метки в cookie 
    if(isset($_GET["utm_source"])) setcookie("utm_source",$_GET["utm_source"],time()+3600*24*30,"/"); 
    if(isset($_GET["utm_medium"])) setcookie("utm_medium",$_GET["utm_medium"],time()+3600*24*30,"/"); 
    if(isset($_GET["utm_campaign"])) setcookie("utm_campaign",$_GET["utm_campaign"],time()+3600*24*30,"/"); 
    if(isset($_GET["utm_content"])) setcookie("utm_content",$_GET["utm_content"],time()+3600*24*30,"/"); 
    if(isset($_GET["utm_term"])) setcookie("utm_term",$_GET["utm_term"],time()+3600*24*30,"/"); 
    
    if(isset($_GET["utm_source"])) setcookie("fanalyticsutm_source",$_GET["utm_source"],time()+3600*24*30,"/"); 
	if(isset($_GET["utm_medium"])) setcookie("fanalyticsutm_medium",$_GET["utm_medium"],time()+3600*24*30,"/"); 
	if(isset($_GET["utm_campaign"])) setcookie("fanalyticsutm_campaign",$_GET["utm_campaign"],time()+3600*24*30,"/"); 
	if(isset($_GET["utm_content"])) setcookie("fanalyticsutm_content",$_GET["utm_content"],time()+3600*24*30,"/"); 
	if(isset($_GET["utm_term"])) setcookie("fanalyticsutm_term",$_GET["utm_term"],time()+3600*24*30,"/"); 

    //пример использования события OnSaleOrderBeforeSaved интересен для записи в свойства заказа параметров из куки например

use Bitrix\Main; 
Main\EventManager::getInstance()->addEventHandler(
    'sale',
    'OnSaleOrderBeforeSaved',
    'myFunction2'
);

//в обработчике изменим комментарий:

function myFunction2(Main\Event $event)
{
    /** @var Order $order */
    $order = $event->getParameter("ENTITY");
	$ufip = echo $_COOKIE["fanalytics-ip"];
    $order->setField('COMMENTS', $ufip);
    $event->addResult(
            new Main\EventResult(
                Main\EventResult::SUCCESS, $order
            )
        );
}  
?>
