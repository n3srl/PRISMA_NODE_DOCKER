<?php

/**
 *
 * @author: N3 S.r.l.
 */
class SettingsLogic {

    public static function Save($obj) {
        $Person = CoreLogic::VerifyPerson();
        N3BusinessObject::Init($obj, $Person);
        $res = SettingsFactory::Save($obj);
        return $res;
    }

    public static function Update($obj) {

        $Person = CoreLogic::VerifyPerson();
        N3BusinessObject::SetModified($obj, $Person);

        return SettingsFactory::Update($obj);
    }

    public static function Erase($obj) {
        $Person = CoreLogic::VerifyPerson();
        return SettingsFactory::Erase($obj);
    }

    public static function Delete($obj) {
        $Person = CoreLogic::VerifyPerson();
        return SettingsFactory::Delete($obj);
    }

    public static function Get($id) {
        $res = false;
        $Person = CoreLogic::VerifyPerson();
        return SettingsFactory::Get($id);
    }

    public static function GetList($where = "") {
        $Person = CoreLogic::VerifyPerson();
        $ob = SettingsFactory::GetList($where);
        return $ob;
    }
    
    public static function GetListByModule($module, $getEmptyObject = true) {
        $Person = CoreLogic::VerifyPerson();
        return SettingsView::getSettingsView($module,$getEmptyObject);
    }
    
    public static function IdemUpdate($obj, $module) {
        $Person = CoreLogic::VerifyPerson();
        N3BusinessObject::Init($obj, $Person);
        return SettingsView::idemUpdateSettingsByModuleView($obj, $module);
    }
}
