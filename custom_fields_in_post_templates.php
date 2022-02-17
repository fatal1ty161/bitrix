<?
//add in /bitrix/init.php
AddEventHandler("main", "OnAfterUserAdd", "OnAfterUserRegisterHandler");
AddEventHandler("main", "OnAfterUserRegister", "OnAfterUserRegisterHandler");
function OnAfterUserRegisterHandler(&$arFields)
{
   if (intval($arFields["ID"])>0)
   {
    $kkid = $arFields["ID"];//Получим ID текущего пользователя
    $arFilter = array("ID" => $kkid);
        $arParams["SELECT"] = array("UF_INN");//INN
        $arRes = CUser::GetList($by,$desc,$arFilter,$arParams);
        if ($res = $arRes->Fetch()) {
            $kk2 = $res["UF_INN"];
        }
        $arParams["SELECT"] = array("UF_OGRN");
        $arRes = CUser::GetList($by,$desc,$arFilter,$arParams);
        if ($res = $arRes->Fetch()) {
            $kk3 = $res["UF_OGRN"];
        }
        $arParams["SELECT"] = array("UF_SPECIAL_NOTES");
        $arRes = CUser::GetList($by,$desc,$arFilter,$arParams);
        if ($res = $arRes->Fetch()) {
            $kk4 = $res["UF_SPECIAL_NOTES"];
        }
        $arParams["SELECT"] = array("UF_TCOMPANY");
        $arRes = CUser::GetList($by,$desc,$arFilter,$arParams);
        if ($res = $arRes->Fetch()) {
            foreach ($res["UF_TCOMPANY"] as $id) {
                $rsRes= CUserFieldEnum::GetList(array(), array(
                    "ID" => $id,
                ));
                if($arTCOMPANY = $rsRes->GetNext())
                    $kk5 = $arTCOMPANY["VALUE"];
            }   
        }
        $arParams["SELECT"] = array("UF_SNALOG");
        $arRes = CUser::GetList($by,$desc,$arFilter,$arParams);
        if ($res = $arRes->Fetch()) {
            foreach ($res["UF_SNALOG"] as $id) {
                $rsRes= CUserFieldEnum::GetList(array(), array(
                    "ID" => $id,
                ));
                if($arSNALOG = $rsRes->GetNext())
                    $kk6 = $arSNALOG["VALUE"];
            }   
        }
    
      $toSend = Array();
      $toSend["SNALOG"] = $kk6;
      $toSend["TCOMPANY"] = $kk5;
      $toSend["NOTES"] = $kk4;
      $toSend["INN"] = $kk2;
      $toSend["OGRN"] = $kk3;
      $toSend["PASSWORD"] = $arFields["CONFIRM_PASSWORD"];
      $toSend["EMAIL"] = $arFields["EMAIL"];
      $toSend["PHONE"] = $arFields["PERSONAL_PHONE"];
      $toSend["WORK_COMPANY"] = $arFields["WORK_COMPANY"];
      $toSend["CITY"] = $arFields["WORK_CITY"];
      $toSend["WORK_POSITION"] = $arFields["WORK_POSITION"];
      $toSend["USER_ID"] = $arFields["ID"];
      $toSend["USER_IP"] = $arFields["USER_IP"];
      $toSend["USER_HOST"] = $arFields["USER_HOST"];
      $toSend["LOGIN"] = $arFields["LOGIN"];
      $toSend["NAME"] = (trim ($arFields["NAME"]) == "")? $toSend["NAME"] = htmlspecialchars('<Не указано>'): $arFields["NAME"];
      $toSend["LAST_NAME"] = (trim ($arFields["LAST_NAME"]) == "")? $toSend["LAST_NAME"] = htmlspecialchars('<Не указано>'): $arFields["LAST_NAME"];
      CEvent::SendImmediate ("MY_NEW_USER", SITE_ID, $toSend);// create_post_event_"MY_NEW_USER"_and_create_post_template
   }
   return $arFields;
}
?>
