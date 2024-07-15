<?php

/**
 *
 * @author: N3 S.r.l.
 */
class SettingsApiLogic {

    public static function Save($request, $module) {
        try {

            $Person = CoreLogic::VerifyPerson();
            //CoreLogic::CheckCSRF($request->get("token"));

            $ob = new SettingsView();

            CoreLogic::getFromArray($ob, $request->get("data"));
            CoreLogic::beginTransaction();
            $res = SettingsLogic::IdemUpdate($ob, $module);
            if (!$res)
                throw new ApiException(ApiException::$Generic);
            CoreLogic::commitTransaction();
        } catch (ApiException $a) {
            CoreLogic::rollbackTransaction();
            return CoreLogic::GenerateErrorResponse($a->message);
        }
        return CoreLogic::GenerateResponse($res, $ob);
    }

    public static function Update($request, $module) {

        try {
            $Person = CoreLogic::VerifyPerson();
            CoreLogic::CheckCSRF($request->get("token"));
            
            $ob = new SettingsView();

            $tmp = $request->get("data");

            $ob = SettingsLogic::GetListByModule($module);

            CoreLogic::getFromArray($ob, $request->get("data"));

            CoreLogic::beginTransaction();
            $res = SettingsLogic::IdemUpdate($ob, $module);
            CoreLogic::commitTransaction();
        } catch (ApiException $a) {
            CoreLogic::rollbackTransaction();
            return CoreLogic::GenerateErrorResponse($a->message);
        }
        return CoreLogic::GenerateResponse($res, $ob);
    }

    public static function Get($module) {
        try {
            $res = false;
            $Person = CoreLogic::VerifyPerson();
            $ob = SettingsLogic::GetListByModule($module);
            $res = true;
        } catch (ApiException $a) {
            return CoreLogic::GenerateErrorResponse($a->message);
        }
        return CoreLogic::GenerateResponse($res, $ob);
    }
}
