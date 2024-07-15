<?php

class PermissionLogic {

    public static function SmallPermission($Permission) {
        unset($Permission->id);
        unset($Permission->oid);
        unset($Permission->ext_oid);
        unset($Permission->person_id);
        unset($Permission->group_id);
        unset($Permission->username);
        unset($Permission->secret_token);
        unset($Permission->modified_by);
        unset($Permission->created_by);
        unset($Permission->assigned);
        unset($Permission->create_date);
        unset($Permission->valid_from);
        unset($Permission->valid_to);
        unset($Permission->erased);
        unset($Permission->last_update);
        return $Permission;
    }

    public static function Save($obj) {
        $Person = CoreLogic::VerifyPerson();
        N3BusinessObject::Init($obj, $Person);
        $res = PermissionFactory::Save($obj);
        return $res;
    }

    public static function Update($obj) {

        $Person = CoreLogic::VerifyPerson();
        N3BusinessObject::SetModified($obj, $Person);

        return PermissionFactory::Update($obj);
    }

    public static function Erase($obj) {
        $Person = CoreLogic::VerifyPerson();
        return PermissionFactory::Erase($obj);
    }

    public static function Delete($obj) {
        $Person = CoreLogic::VerifyPerson();
        return PermissionFactory::Delete($obj);
    }

    public static function Get($id) {
        $res = false;
        $Person = CoreLogic::VerifyPerson();
        return PermissionFactory::Get($id);
    }

    public static function GetByPersonAndExtOid($person_id, $ext_oid) {
        $res = false;
        $Person = CoreLogic::VerifyPerson();
        return PermissionFactory::GetByPersonAndExtOid($person_id, $ext_oid);
    }

    public static function GetByGroupAndExtOid($group_id, $ext_oid) {
        $res = false;
        $Person = CoreLogic::VerifyPerson();
        return PermissionFactory::GetByGroupAndExtOid($group_id, $ext_oid);
    }

    public static function ManagePermission($person_id, $ext_oid) {
        $res = false;
        $Person = CoreLogic::VerifyPerson();
        $res = true;
        $Permission = self::GetByPersonAndExtOid($person_id, $ext_oid);
        if ($Permission != false) {
            //Delete
            $res &= PermissionLogic::Delete($Permission);
        } else {
            //Insert
            $Permission = new Permission();
            $Permission->person_id = $person_id;
            $Permission->ext_oid = $ext_oid;
            $Permission->active = 1;
            $Permission->read = 1;
            $Permission->write = 0;
            $Permission->execute = 0;

            $res &= PermissionLogic::Save($Permission);
        }


        return $res;
    }

    public static function ChangePermission($person_id = null, $group_id = null, $ext_oid, $active = 1, $read = 1, $write = 0, $update = 0, $delete = 0, $execute = 0) {
        $Person = CoreLogic::VerifyPerson();
        $res = true;
        $res &= self::Remove($ext_oid, $person_id, $group_id);
        $Permission = new Permission();
        $Permission->person_id = $person_id;
        $Permission->group_id = $group_id;
        $Permission->ext_oid = $ext_oid;
        $Permission->active = $active;
        $Permission->read = $read;
        $Permission->write = $write;
        $Permission->update = $update;
        $Permission->delete = $delete;
        $Permission->execute = $execute;
        $res &= PermissionLogic::Save($Permission);

        return $res;
    }

    public static function GetList() {
        $Person = CoreLogic::VerifyPerson();
        $ob = PermissionFactory::GetList();
        return $ob;
    }

    public static function GetByExtOid($ext_oid) {
        $Person = CoreLogic::VerifyPerson();
        return PermissionFactory::GetByExtOid($ext_oid);
    }

    public static function GetByExtOidAndPerson($ext_oid, $person_id, $group_id) {
        $Person = CoreLogic::VerifyPerson();
        return PermissionFactory::GetByExtOidAndPerson($ext_oid, $person_id, $group_id);
    }

    public static function GetPermissionByItem($item_id) {
        $Person = CoreLogic::VerifyPerson();
        return PermissionFactory::GetPermissionByItem($item_id);
    }

    public static function CheckPermission_Read($ext_oid) {
        $Person = CoreLogic::VerifyPerson();
        $person_permission = PermissionLogic::GetByPersonAndExtOid($Person->id, $ext_oid);
        $group_permission = PermissionLogic::GetByGroupAndExtOid($Person->group_id, $ext_oid);
        if(!$person_permission){
            $person_permission = new stdClass();
            $person_permission->read = false;
        }
        if(!$group_permission){
            $group_permission = new stdClass();
            $group_permission->read = false;
        }
        if (!($person_permission->read || $group_permission->read)) {
            throw new ApiException(ApiException::$PermissionException);
        }
    }

    public static function CheckPermissionList_Read($ob) {
        $Person = CoreLogic::VerifyPerson();
        $obt = $ob;
        if ($ob != null) {
            for ($i = 0; $i < count($ob); $i++) {
                $Company = CompanyFactory::Get($ob[$i]->name_company_id);
                $person_permission = PermissionLogic::GetByPersonAndExtOid($Person->id, $Company->oid);
                $group_permission = PermissionLogic::GetByGroupAndExtOid($Person->group_id, $Company->oid);
                
                if(!$person_permission){
                    $person_permission = new stdClass();
                    $person_permission->read = false;
                }
                if(!$group_permission){
                    $group_permission = new stdClass();
                    $group_permission->read = false;
                }
                if (!($person_permission->read || $group_permission->read)) {
                    unset($obt[$i]);
                }
            }
        } else {
            return [];
        }
        return $obt;
    }

    public static function CheckPermission_Write($ext_oid) {
        $Person = CoreLogic::VerifyPerson();

        $person_permission = PermissionLogic::GetByPersonAndExtOid($Person->id, $ext_oid);
        $group_permission = PermissionLogic::GetByGroupAndExtOid($Person->group_id, $ext_oid);
        if(!$person_permission){
            $person_permission = new stdClass();
            $person_permission->write = false;
        }
        if(!$group_permission){
            $group_permission = new stdClass();
            $group_permission->write = false;
        }
        if (!($person_permission->write || $group_permission->write)) {
            throw new ApiException(ApiException::$PermissionException);
        }
    }

    public static function CheckPermission_Delete($ext_oid) {
        $Person = CoreLogic::VerifyPerson();

        $person_permission = PermissionLogic::GetByPersonAndExtOid($Person->id, $ext_oid);
        $group_permission = PermissionLogic::GetByGroupAndExtOid($Person->group_id, $ext_oid);
        if(!$person_permission){
            $person_permission = new stdClass();
            $person_permission->delete = false;
        }
        if(!$group_permission){
            $group_permission = new stdClass();
            $group_permission->delete = false;
        }
        if (!($person_permission->delete || $group_permission->delete)) {
            throw new ApiException(ApiException::$PermissionException);
        }
    }

    public static function CheckPermission_Update($ext_oid) {
        $Person = CoreLogic::VerifyPerson();

        $person_permission = PermissionLogic::GetByPersonAndExtOid($Person->id, $ext_oid);
        $group_permission = PermissionLogic::GetByGroupAndExtOid($Person->group_id, $ext_oid);
        if(!$person_permission){
            $person_permission = new stdClass();
            $person_permission->update = false;
        }
        if(!$group_permission){
            $group_permission = new stdClass();
            $group_permission->update = false;
        }
        if (!($person_permission->update || $group_permission->update)) {
            throw new ApiException(ApiException::$PermissionException);
        }
    }

    public static function CheckPermission_Active($ext_oid) {
        $Person = CoreLogic::VerifyPerson();

        $person_permission = PermissionLogic::GetByPersonAndExtOid($Person->id, $ext_oid);
        $group_permission = PermissionLogic::GetByGroupAndExtOid($Person->group_id, $ext_oid);
        if(!$person_permission){
            $person_permission = new stdClass();
            $person_permission->active = false;
        }
        if(!$group_permission){
            $group_permission = new stdClass();
            $group_permission->active = false;
        }
        if (!($person_permission->active || $group_permission->active)) {
            throw new ApiException(ApiException::$PermissionException);
        }
    }

    public static function CheckPermission_Execute($ext_oid) {
        $Person = CoreLogic::VerifyPerson();

        $person_permission = PermissionLogic::GetByPersonAndExtOid($Person->id, $ext_oid);
        $group_permission = PermissionLogic::GetByGroupAndExtOid($Person->group_id, $ext_oid);
        if(!$person_permission){
            $person_permission = new stdClass();
            $person_permission->execute = false;
        }
        if(!$group_permission){
            $group_permission = new stdClass();
            $group_permission->execute = false;
        }
        if (!($person_permission->execute || $group_permission->execute)) {
            throw new ApiException(ApiException::$PermissionException);
        }
    }

    /**
     * 
     * @param type $ext_oid
     */
    public static function Add($ext_oid, $public = false) {

        $res = true;
        $Person = CoreLogic::VerifyPerson();
        $GroupAdmin = GroupLogic::GetByType(Group::$AC);
        $res &= self::ChangePermission(null, $GroupAdmin->id, $ext_oid, 1, 1, 1, 1, 1, 0);
        try{
            if(!$public){
                if ($Person->group->type != Group::$AC) {
                    $res &= self::ChangePermission($Person->id, null, $ext_oid, 1, 1, 1, 1, 1, 0);
                }
            }
        }catch(Exception $e){
            
        }finally{
            return $res;
        }
        
    }
    public static function AddCustomer($ext_oid, $person_id = null, $public = false) {

        $res = true;
        $Person = CoreLogic::VerifyPerson();
        $GroupAdmin = GroupLogic::GetByType(Group::$AC);
        $res &= self::ChangePermission(null, $GroupAdmin->id, $ext_oid, 1, 1, 1, 1, 1, 0);
        try{
            if(!$public){
                if ($Person->group->type != Group::$AC) {
                    $res &= self::ChangePermission($Person->id, null, $ext_oid, 1, 1, 1, 1, 1, 0);
                }
            }
            if(!empty($person_id)){
                if ($Person->group->type == Group::$AC) {
                    $res &= self::ChangePermission($person_id, null, $ext_oid, 1, 1, 1, 1, 1, 0);
                }
            }
        }catch(Exception $e){
            
        }finally{
            return $res;
        }
        
    }
    public static function AddAdmin($ext_oid) {

        $res = true;
        $Person = CoreLogic::VerifyPerson();
        $GroupAdmin = GroupLogic::GetByType(Group::$AC);

        $res &= self::ChangePermission(null, $GroupAdmin->id, $ext_oid, 1, 1, 1, 1, 1, 0);
        try{
            if ($Person->group->type != Group::$AC) {
                $res &= self::ChangePermission($Person->id, null, $ext_oid, 1, 1, 1, 1, 1, 0);
            }
        }catch(Exception $e){
            
        }finally{
            return $res;
        }
        
    }

    /**
     * 
     * @param type $ext_oid
     */
    public static function Remove($ext_oid, $person_id = null, $group_id = null) {
        $Person = CoreLogic::VerifyPerson();
        $res = true;

        if ($person_id != null || $group_id != null) {
            $Permissions = self::GetByExtOidAndPerson($ext_oid, $person_id, $group_id);
        } else {
            $Permissions = self::GetByExtOid($ext_oid);
        }
        foreach ($Permissions as $p) {
            $res &= PermissionLogic::Delete($p);
        }

        return $res;
    }

}
