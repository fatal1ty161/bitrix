В командной PHP строке выполняем команды:
COption::SetOptionString("catalog", "DEFAULT_SKIP_SOURCE_CHECK", "Y" ); COption::SetOptionString("sale", "secure_1c_exchange", "N" );

Заходим на сайт администратором и последовательно выполняем запросы, не меняя окна браузера

http://ВАШ_САЙТ/bitrix/admin/1c_exchange.php?type=sale&mode=checkauth
http://ВАШ_САЙТ/bitrix/admin/1c_exchange.php?type=sale&mode=init
http://ВАШ_САЙТ/bitrix/admin/1c_exchange.php?type=sale&mode=query
