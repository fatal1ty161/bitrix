<?
require($_SERVER['DOCUMENT_ROOT']."/bitrix/header.php");
$pass = '123456';
$B = $USER->Update(1,array("PASSWORD"=>$pass));
if ($B){
  echo "Password successfully reset to: ";
  echo "<br>Login ".$_ENV['LOGNAME'];
  echo "<br>Password ".$pass;
}
else echo $USER->LAST_ERROR;
require($_SERVER['DOCUMENT_ROOT']."/bitrix/footer.php");
?>

/*ssh recovery from console*/
<ssh>UPDATE `b_user` SET `PASSWORD` = MD5('123456') WHERE `ID`=1;</ssh>
