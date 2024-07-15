<?php
/**
 * Class for EventFactory
 * 
 * @author: N3 S.r.l.
 */
class EventFactoryBase
{
	public static function Save( $object )
	{
		global $db_conn;
		$ob = clone $object;
		EventFactoryBase::cleanData( $ob );
		EventFactory::CheckData( $ob );
		$query = "INSERT INTO pr_drv_event (`name`,`abs_path`,`datetime`,`is_processed`) VALUES ($ob->name,$ob->abs_path,$ob->datetime,$ob->is_processed)";
		$res = mysqli_query($db_conn,$query);
		if ($res === false)
			return false;
		$object->id = mysqli_insert_id($db_conn);

		return true;
	}

	public static function Delete( $object )
	{
		global $db_conn;
		$query = "DELETE FROM pr_drv_event WHERE name=" . $object->name;
		$res = mysqli_query($db_conn, $query);
		if ($res===false) return false; else return true;
	}

	//da cancellare
	public static function Erase($object)
	{
		global $db_conn;
		$query = "";
		$res = mysqli_query($db_conn,$query);
		if ($res === false) return false; else return true;
	}

	public static function Update( $object )
	{
		global $db_conn;
		EventFactoryBase::cleanData( $object );
		EventFactory::CheckData( $object );
		$query = "" . $object->id;
		$res = mysqli_query($db_conn,$query);
		if ($res === false) return false; else return true;
	}

	/** @return Event */ 
	public static function Get( $name )
	{
		global $db_conn;
		$query = "SELECT * FROM pr_drv_event WHERE name=" . $name;
		$res = @mysqli_query($db_conn,$query);
		if ($res === false || mysqli_num_rows($res) <= 0)
			return false;
		$object = mysqli_fetch_object($res);

		return self::LoadField($object);
	}

	/** @return Event[] */ 
	public static function GetList($where = '')
	{
		global $db_conn;
		$object_list   =   array();
		$where_ = "WHERE ";
		if ($where != '') {
			$where_ .= ' AND ' . $where;
		}
		$query = "SELECT * FROM pr_drv_event $where_";
		$res = mysqli_query( $db_conn, $query);
		if (!$res  || mysqli_num_rows($res) <= 0)
			return array();
		while ($row = mysqli_fetch_object($res,'Event')) {
			$object_list[] = self::LoadField($row);
		}
		return $object_list;
	}

	public static function CheckData($object, $clean = true){
	}

	public static function cleanData($object){
		/*
		$object->name = $object->name ;
		if($object->oid === null || $object->oid === ''){
			$object->oid = 'null';
		} else {
			$object->oid = "'$object->oid'" ;
		}
		$object->code = "'$object->code'" ;
		$object->to_process = $object->to_process ;
		if ($object-> to_process == '1' ){
			$object->to_process = 'true';
		} else {
			$object->to_process = 'false';
		}
		$object->modified_by = $object->modified_by ;
		$object->created_by = $object->created_by ;
		$object->assigned = $object->assigned ;
		$object->erased = $object->erased ;
		if ($object-> erased == '1' ){
			$object->erased = 'true';
		} else {
			$object->erased = 'false';
		}*/
	}

	public static function LoadField($object){
		return $object;
	}

	public static function getMaxId() {
		global $db_conn;
		$query = "SELECT max(id) as max_id FROM pr_event";
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
			$query = "SELECT distinct ".$column." FROM pr_event $where_ and ".$column." like '%$code%'; ";
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
			$query = "SELECT distinct REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'pr_event' and COLUMN_NAME = '".$column."' limit 1; ";
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
			$query = "SELECT distinct ".$column." FROM $table $where_ and ".$column." like '%$code%'; ";
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
