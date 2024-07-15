<?php

/**
 * Class for GroupFactory
 * 
 * @author: N3 S.r.l.
 */
class GroupFactory extends GroupFactoryBase {

    public static $ADMIN = 1;
    public static $OPERATORE = 2;
    public static $COMMERCIALE = 3;
    public static $DASHBOARD = 4;
    public static function CheckData($object, $clean = true) {
        $errors = array();
        $parse_error = false;
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

    /** @return Group */
    public static function GetAccountGroup($person_id) {

        global $db_conn;
        $query = "SELECT * FROM core_group WHERE (type = '" . Group::$AC . "' or type = '".Group::$AG."' or type = '" . Group::$CO . "') and id in (select distinct group_id from core_group_has_person where person_id = $person_id )";
        $res = @mysqli_query($db_conn, $query);
        if ($res === false || mysqli_num_rows($res) <= 0)
            return false;
        $object = mysqli_fetch_object($res);

        return self::LoadField($object);
    }
    
    /** @return Group */
    public static function GetByType($type) {

        global $db_conn;
        $query = "SELECT * FROM core_group WHERE type = '" .$type. "'";
        $res = @mysqli_query($db_conn, $query);
        if ($res === false || mysqli_num_rows($res) <= 0)
            return false;
        $object = mysqli_fetch_object($res);

        return self::LoadField($object);
    }
    
    /** @return Group[] */
    public static function GetListSearch($code,$where = '') {
        global $db_conn;
        $object_list = array();
        $where_ = "WHERE erased = 0";
        if ($where != '') {
            $where_ .= ' AND ' . $where;
        }
        $query = "SELECT * FROM core_group $where_ and  UPPER(ifnull(name,'')) like  UPPER('%$code%')";
        $res = mysqli_query($db_conn, $query);
        if (!$res || mysqli_num_rows($res) <= 0)
            return array();
        while ($row = mysqli_fetch_object($res, 'Group')) {
            $object_list[] = self::LoadField($row);
        }
        return $object_list;
    }

}