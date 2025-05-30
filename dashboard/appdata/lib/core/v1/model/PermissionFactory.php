<?php

/**
 * Class for PermissionFactory
 * 
 * @author: N3 S.r.l.
 */
class PermissionFactory extends PermissionFactoryBase {

    public static function CheckData($object, $clean = true) {
        $errors = array();
        $parse_error = false;
        if (!is_numeric($object->person_id) && $object->person_id != null && $object->person_id != '' && $object->person_id != 'null') {
            $errors[] = _('person_id non numerico');
            $parse_error = true;
        }
        if (!is_numeric($object->group_id) && $object->group_id != null && $object->group_id != '' && $object->group_id != 'null') {
            $errors[] = _('group_id non numerico');
            $parse_error = true;
        }
        if (($object->execute === true && $object->execute != null) || $object->execute == 'true' || $object->execute == '1') {
            $object->execute = 1;
        } else {
            $object->execute = 0;
        }
        if (!is_numeric($object->execute) && $object->execute != null && $object->execute != '' && $object->execute != 'null') {
            $errors[] = _('execute non numerico');
            $parse_error = true;
        }
        if (($object->read === true && $object->read != null) || $object->read == 'true' || $object->read == '1') {
            $object->read = 1;
        } else {
            $object->read = 0;
        }
        if (!is_numeric($object->read) && $object->read != null && $object->read != '' && $object->read != 'null') {
            $errors[] = _('read non numerico');
            $parse_error = true;
        }
        if (($object->update === true && $object->update != null) || $object->update == 'true' || $object->update == '1') {
            $object->update = 1;
        } else {
            $object->update = 0;
        }
        if (!is_numeric($object->update) && $object->update != null && $object->update != '' && $object->update != 'null') {
            $errors[] = _('update non numerico');
            $parse_error = true;
        }
        if (($object->delete === true && $object->delete != null) || $object->delete == 'true' || $object->delete == '1') {
            $object->delete = 1;
        } else {
            $object->delete = 0;
        }
        if (!is_numeric($object->delete) && $object->delete != null && $object->delete != '' && $object->delete != 'null') {
            $errors[] = _('delete non numerico');
            $parse_error = true;
        }
        if (($object->write === true && $object->write != null) || $object->write == 'true' || $object->write == '1') {
            $object->write = 1;
        } else {
            $object->write = 0;
        }
        if (!is_numeric($object->write) && $object->write != null && $object->write != '' && $object->write != 'null') {
            $errors[] = _('write non numerico');
            $parse_error = true;
        }
        if (($object->active === true && $object->active != null) || $object->active == 'true' || $object->active == '1') {
            $object->active = 1;
        } else {
            $object->active = 0;
        }
        if (!is_numeric($object->active) && $object->active != null && $object->active != '' && $object->active != 'null') {
            $errors[] = _('active non numerico');
            $parse_error = true;
        }
        if (!is_numeric($object->modified_by) && $object->modified_by != null && $object->modified_by != '' && $object->modified_by != 'null') {
            $errors[] = _('modified_by non numerico');
            $parse_error = true;
        }
        if (!is_numeric($object->created_by) && $object->created_by != null && $object->created_by != '' && $object->created_by != 'null') {
            $errors[] = _('created_by non numerico');
            $parse_error = true;
        }
        if (!is_numeric($object->assigned) && $object->assigned != null && $object->assigned != '' && $object->assigned != 'null') {
            $errors[] = _('assigned non numerico');
            $parse_error = true;
        }
        if (($object->erased === true && $object->erased != null) || $object->erased == 'true' || $object->erased == '1') {
            $object->erased = 1;
        } else {
            $object->erased = 0;
        }
        if (!is_numeric($object->erased) && $object->erased != null && $object->erased != '' && $object->erased != 'null') {
            $errors[] = _('erased non numerico');
            $parse_error = true;
        }
        if ($parse_error) {
            throw new FieldException($errors);
        }
    }

    /** @return Permission[] */
    public static function Get4Gui($person, $gui) {
        global $db_conn;
        $object_list = array();
        $query = "select distinct * 
                        from core_permission
                        where ext_oid = (
                            select oid 
                            from core_gui 
                            where name = '$gui') AND (person_id = $person->id or group_id in (select group_id from core_group_has_person where person_id = $person->id)
                        ) and active = 1 and erased  = 0;";
        $res = mysqli_query($db_conn, $query);
        if ($res === false || mysqli_num_rows($res) <= 0)
            return false;
        $object = mysqli_fetch_object($res);
        return $object;
    }

    /** @return Permission[] */
    public static function GetMenu() {
        global $db_conn;
        $object_list = array();
        $where_ = "WHERE erased = 0";
        if ($where != '') {
            $where_ .= ' AND ' . $where;
        }
        $query = "SELECT * FROM core_permission $where_";
        $res = mysqli_query($db_conn, $query);
        if (!$res || mysqli_num_rows($res) <= 0)
            return array();
        while ($row = mysqli_fetch_object($res, 'Permission')) {
            $object_list[] = self::LoadField($row);
        }
        return $object_list;
    }
    
    /** @return Permission */
    public static function GetByPersonAndExtOid($person_id, $ext_oid) {
        global $db_conn;
        $query = "SELECT * FROM core_permission WHERE person_id=$person_id and ext_oid = '$ext_oid' ";
        $res = @mysqli_query($db_conn, $query);
        if ($res === false || mysqli_num_rows($res) <= 0)
            return false;
        $object = mysqli_fetch_object($res);

        return self::LoadField($object);
    }
    
    /** @return Permission */
    public static function GetByGroupAndExtOid($group_id, $ext_oid) {
        global $db_conn;
        $query = "SELECT * FROM core_permission WHERE group_id=$group_id and ext_oid = '$ext_oid' ";
        $res = @mysqli_query($db_conn, $query);
        if ($res === false || mysqli_num_rows($res) <= 0)
            return false;
        $object = mysqli_fetch_object($res);

        return self::LoadField($object);
    }
    
    /** @return Permission[] */ 
    public static function GetPermissionByItem($item_id)
    {
            global $db_conn;
            $object_list   =   array();

            $query = "SELECT * FROM person_item_permission_v where permission_id is not null and product_id = $item_id";
            $res = mysqli_query( $db_conn, $query);
            if (!$res  || mysqli_num_rows($res) <= 0)
                    return array();
            while ($row = mysqli_fetch_object($res,'Permission')) {
                    $object_list[] = self::LoadField($row);
            }
            return $object_list;
    }
    
    /** @return Permission[] */ 
    public static function GetByExtOid($ext_oid)
    {
            global $db_conn;
            $object_list   =   array();

            $query = "SELECT * FROM core_permission where ext_oid = '$ext_oid'";
            $res = mysqli_query( $db_conn, $query);
            if (!$res  || mysqli_num_rows($res) <= 0)
                    return array();
            while ($row = mysqli_fetch_object($res,'Permission')) {
                    $object_list[] = self::LoadField($row);
            }
            return $object_list;
    }
    /** @return Permission[] */ 
    public static function GetByExtOidAndPerson($ext_oid, $person_id, $group_id)
    {
            global $db_conn;
            $object_list   =   array();

            $query = "SELECT * FROM core_permission where ext_oid = '$ext_oid' and person_id ".($person_id==null?' is null ': " = ".$person_id)." and group_id".($group_id==null?' is null':" = ".$group_id)."";
            $res = mysqli_query( $db_conn, $query);
            if (!$res  || mysqli_num_rows($res) <= 0)
                    return array();
            while ($row = mysqli_fetch_object($res,'Permission')) {
                    $object_list[] = self::LoadField($row);
            }
            return $object_list;
    }

}
