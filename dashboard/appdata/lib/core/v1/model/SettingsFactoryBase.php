<?php
/**
 * Class for SettingsFactory
 * 
 * @author: N3 S.r.l.
 */
class SettingsFactoryBase
{
	public static function Save( $object )
	{
		global $db_conn;
		$ob = clone $object;
		SettingsFactoryBase::cleanData( $ob );
		SettingsFactory::CheckData( $ob );
		$query = "INSERT INTO core_settings (`id`,`oid`,`module`,`parameter_name`,`parameter_value`,`modified_by`,`created_by`,`assigned`,`create_date`,`valid_from`,`valid_to`,`erased`,`last_update`) VALUES ( null,$ob->oid,$ob->module,$ob->parameter_name,$ob->parameter_value,$ob->modified_by,$ob->created_by,$ob->assigned,$ob->create_date,$ob->valid_from,$ob->valid_to,0,now())";
                $res = mysqli_query($db_conn,$query);
		if ($res === false)
			return false;
		$object->id = mysqli_insert_id($db_conn);

		return true;
	}

	public static function Delete( $object )
	{
		global $db_conn;
		$query = "DELETE FROM core_settings WHERE id=" . $object->id;
		$res = mysqli_query($db_conn, $query);
		if ($res===false) return false; else return true;
	}

	public static function Erase($object)
	{
		global $db_conn;
		$query = "UPDATE core_settings SET erased=1 WHERE id=" . $object->id . " AND erased=0";
		$res = mysqli_query($db_conn,$query);
		if ($res === false) return false; else return true;
	}

	public static function Update( $object )
	{
		global $db_conn;
		SettingsFactoryBase::cleanData( $object );
		SettingsFactory::CheckData( $object );
		$query = "UPDATE core_settings SET `module` =$object->module,`parameter_name` =$object->parameter_name,`parameter_value` =$object->parameter_value,`modified_by` = $object->modified_by,`assigned` = $object->assigned,`valid_from` = $object->valid_from,`valid_to` = $object->valid_to,`erased` = $object->erased,`last_update`=now() WHERE id=" . $object->id;
		$res = mysqli_query($db_conn,$query);
		if ($res === false) return false; else return true;
	}

	/** @return Settings */ 
	public static function Get( $id )
	{
		global $db_conn;
		$query = "SELECT * FROM core_settings WHERE id=" . $id;
		$res = @mysqli_query($db_conn,$query);
		if ($res === false || mysqli_num_rows($res) <= 0)
			return false;
		$object = mysqli_fetch_object($res,'Settings');
		
		return self::LoadField($object);
	}

	/** @return Settings[] */ 
	public static function GetList($where = '')
	{
		global $db_conn;
		$object_list   =   array();
		$where_ = "WHERE erased = 0";
		if ($where != '') {
			$where_ .= ' AND ' . $where;
		}
		$query = "SELECT * FROM core_settings $where_";
		$res = mysqli_query( $db_conn, $query);
		if (!$res  || mysqli_num_rows($res) <= 0)
			return array();
		while ($row = mysqli_fetch_object($res,'Settings')) {
			$object_list[] = self::LoadField($row);
		}
		return $object_list;
	}

	public static function CheckData($object, $clean = true){
	}

	public static function cleanData($object){
		$object->id = $object->id ;
		$object->oid = "'$object->oid'" ;
		if($object->module === null || $object->module === ''){
			$object->module = 'null';
		} else {
			$object->module = "'$object->module'" ;
		}
		if($object->parameter_name === null || $object->parameter_name === ''){
			$object->parameter_name = 'null';
		} else {
			$object->parameter_name = "'$object->parameter_name'" ;
		}
		if($object->parameter_value === null || $object->parameter_value === ''){
			$object->parameter_value = 'null';
		} else {
			$object->parameter_value = "'$object->parameter_value'" ;
		}
		$object->modified_by = $object->modified_by ;
		$object->created_by = $object->created_by ;
		$object->assigned = $object->assigned ;
		if(empty($object->create_date)){
			$object->create_date = 'null';
		}else{
			$object->create_date = "'".DateLogic::fromUser($object->create_date)."'";
		}
		if(empty($object->valid_from)){
			$object->valid_from = 'null';
		}else{
			$object->valid_from = "'".DateLogic::fromUser($object->valid_from)."'";
		}
		if(empty($object->valid_to)){
			$object->valid_to = 'null';
		}else{
			$object->valid_to = "'".DateLogic::fromUser($object->valid_to)."'";
		}
		if($object->erased === null || $object->erased === ''){
			$object->erased = 'null';
		}
		if ($object-> erased == '1' ){
			$object->erased = 'true';
		} else {
			$object->erased = 'false';
		}
	}

	public static function LoadField($object){
		$object->create_date = DateLogic::fromUser($object->create_date);		$object->valid_from = DateLogic::fromUser($object->valid_from);		$object->valid_to = DateLogic::fromUser($object->valid_to);		$object->last_update = DateLogic::fromUser($object->last_update);		return $object;
	}

	public static function getMaxId() {
		global $db_conn;
		$query = "SELECT max(id) as max_id FROM core_settings";
		$res = mysqli_query( $db_conn, $query);
		if ($res === false  || mysqli_num_rows($res) <= 0)
			return 1;
		$object = mysqli_fetch_object($res);
		$id = $object->max_id;
		if ($id == null){
			return 1;
		}
		return $id;
	}

		public static function GetListFilter($column,$code,$where = '') {
			global $db_conn;
			$object_list = array();
			$where_ = "WHERE erased = 0";
			if ($where != '') {
				$where_ .= ' AND ' . $where;
			}
			$query = "SELECT distinct ".$column." FROM core_settings $where_ and ".$column." like '%$code%'; ";
			$res = mysqli_query($db_conn, $query);
			if (!$res || mysqli_num_rows($res) <= 0)
				return array();
			while ($row = mysqli_fetch_object($res)) {
				$object_list[] = $row;
			}
			return $object_list;
		}

		public static function GetForeignKeyParams($column) {
			global $db_conn;
			$object_list = array();
			$query = "SELECT distinct REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'core_settings' and COLUMN_NAME = '".$column."' limit 1; ";
			$res = mysqli_query($db_conn, $query);
			if (!$res || mysqli_num_rows($res) <= 0)
				return array();
			while ($row = mysqli_fetch_object($res)) {
				$object_list[] = $row;
			}
			return $object_list;
		}

		public static function GetListFK($table,$column,$code,$where = '') {
			global $db_conn;
			$object_list = array();
			$where_ = "WHERE erased = 0";
			if ($where != '') {
				$where_ .= ' AND ' . $where;
			}
			$select ="null as placeholder";
			switch(gettype($column)){
				case "array":
					$where_.= " AND(1 = 0 ";
					foreach($column as $col){
						$select.=",$col";
						$colArr = explode(strtoupper(" as "), strtoupper($col));
						$where_.= " OR UPPER(" . $colArr[0] . ") like UPPER('%$code%') collate utf8_bin ";
					}
					$where_.= ")";
					break;
				default:
					$select = $column;
					$where_.= " AND UPPER(" . $column . ") like UPPER('%$code%') collate utf8_bin";
			}
			$query = "SELECT distinct " . $select . " FROM $table $where_  ";
			$res = mysqli_query($db_conn, $query);
			if (!$res || mysqli_num_rows($res) <= 0)
				return array();
			while ($row = mysqli_fetch_object($res)) {
				$object_list[] = $row;
			}
			return $object_list;
		}

	public function __construct($handle){
	}
}
?>
