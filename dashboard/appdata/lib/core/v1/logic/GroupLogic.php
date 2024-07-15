<?php

class GroupLogic {

    public static function GetAccountGroup($Person) {
        $Group = GroupFactory::GetAccountGroup($Person->id);
        return $Group->id;
    }

    public static function Save($obj) {
        $Person = CoreLogic::VerifyPerson();
        N3BusinessObject::Init($obj, $Person);
        $res = GroupFactory::Save($obj);
        return $res;
    }

    public static function Update($obj) {

        $Person = CoreLogic::VerifyPerson();
        N3BusinessObject::SetModified($obj, $Person);

        return GroupFactory::Update($obj);
    }

    public static function Erase($obj) {
        $Person = CoreLogic::VerifyPerson();
        return GroupFactory::Erase($obj);
    }

    public static function Delete($obj) {
        $Person = CoreLogic::VerifyPerson();
        return GroupFactory::Delete($obj);
    }

    public static function Get($id) {
        $res = false;
        $Person = CoreLogic::VerifyPerson();
        return GroupFactory::Get($id);
    }

    public static function GetList() {
        $Person = CoreLogic::VerifyPerson();
        $ob = GroupFactory::GetList();
        return $ob;
    }
    
    
    public static function GetListSearch($code) {
        $Person = CoreLogic::VerifyPerson();
        $ob = GroupFactory::GetListSearch($code);
        return $ob;
    }
    
    public static function GetByType($type){
        $Person = CoreLogic::VerifyPerson();
        $ob = GroupFactory::GetByType($type);
        return $ob;
    }
    
    public static function GetGroupNameValue($Group, $idText = false) {
        $obj = new stdClass();
        if (!$idText) {
            $obj->name = $Group->name;
            $obj->value = $Group->id;
        } else {
           
            $obj->id = $Group->id;
            $obj->text = $Group->name;
        }
        return $obj;
    }

}