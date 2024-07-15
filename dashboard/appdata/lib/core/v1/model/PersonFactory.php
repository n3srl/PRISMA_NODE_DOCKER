<?php

/**
 * Class for PersonFactory
 * 
 * @author: N3 S.r.l.
 */
class PersonFactory extends PersonFactoryBase {

    public static function CheckData($object, $clean = true) {
        $errors = array();
        $parse_error = false;
        if (!is_numeric($object->modified_by) && $object->timezone != null && $object->timezone != '' && $object->timezone != 'null') {
            $errors[] = _('timezone non numerico');
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
        
        if ($object->is_station_referer == '') {
			$errors[] = _('is_station_referer obbligatorio');
			$parse_error = true;
		}
		if (($object->is_station_referer === true && $object->is_station_referer!=null) || $object->is_station_referer =='true' || $object->is_station_referer =='1' ) {$object->is_station_referer = 1;}else{ $object->is_station_referer = 0;}
		if (!is_numeric($object->is_station_referer) && $object->is_station_referer!= null && $object->is_station_referer!='' && $object->is_station_referer!= 'null') {
			$errors[] = _('is_station_referer non numerico');
			$parse_error = true;
		}
		if ($object->is_administrator == '') {
			$errors[] = _('is_administrator obbligatorio');
			$parse_error = true;
		}
		if (($object->is_administrator === true && $object->is_administrator!=null) || $object->is_administrator =='true' || $object->is_administrator =='1' ) {$object->is_administrator = 1;}else{ $object->is_administrator = 0;}
		if (!is_numeric($object->is_administrator) && $object->is_administrator!= null && $object->is_administrator!='' && $object->is_administrator!= 'null') {
			$errors[] = _('is_administrator non numerico');
			$parse_error = true;
		}
        
        if ($parse_error) {
            throw new FieldException($errors);
        }
    }

    /** @return Person */
    public static function Get4Username($username) {
        global $db_conn;
        $query = "SELECT * FROM core_person WHERE username ='$username' and erased = 0";
        $res = @mysqli_query($db_conn, $query);
        if ($res === false || mysqli_num_rows($res) <= 0)
            return false;
        $object = mysqli_fetch_object($res);

        return self::LoadField($object);
    }
    
    
    
    public static function GetListPersonName($code, $where = '') {
        global $db_conn;
        $object_list = array();
        $where_ = "WHERE erased = 0 ";
        if ($where != '') {
            $where_ .= ' AND ' . $where;
        }
        $query = "SELECT id,first_name, last_name FROM core_person $where_ and concat(ifnull(last_name,''),' ',ifnull(first_name,'')) like '%$code%';";

        $res = mysqli_query($db_conn, $query);
        if (!$res || mysqli_num_rows($res) <= 0)
            return array();
        while ($row = mysqli_fetch_object($res, 'Person')) {
            $object_list[] = self::LoadField($row);
        }
        return $object_list;
    }

}
