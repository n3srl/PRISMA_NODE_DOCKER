<?php
/**
 * Class for ObservedByFactory
 * 
 * @author: N3 S.r.l.
 */
class ObservedByFactoryBase
{
	public static function Save( $object )
	{
		global $db_conn;
		$ob = clone $object;
		ObservedByFactoryBase::cleanData( $ob );
		ObservedByFactory::CheckData( $ob );
		$query = "INSERT INTO pr_observed_by (`id`,`event_id`,`detection_id`,`erased`,`last_update`) VALUES ( null,$ob->event_id,$ob->detection_id,0,now())";
		$res = mysqli_query($db_conn,$query);
		if ($res === false)
			return false;
		$object->id = mysqli_insert_id($db_conn);

		return true;
	}

	public static function Delete( $object )
	{
		global $db_conn;
		$query = "DELETE FROM pr_observed_by WHERE id=" . $object->id;
		$res = mysqli_query($db_conn, $query);
		if ($res===false) return false; else return true;
	}

	public static function Erase($object)
	{
		global $db_conn;
		$query = "UPDATE pr_observed_by SET erased=1 WHERE id=" . $object->id . " AND erased=0";
		$res = mysqli_query($db_conn,$query);
		if ($res === false) return false; else return true;
	}

	public static function Update( $object )
	{
		global $db_conn;
		ObservedByFactoryBase::cleanData( $object );
		ObservedByFactory::CheckData( $object );
		$query = "UPDATE pr_observed_by SET `event_id` = $object->event_id,`detection_id` = $object->detection_id,`erased` = $object->erased,`last_update`=now() WHERE id=" . $object->id;
		$res = mysqli_query($db_conn,$query);
		if ($res === false) return false; else return true;
	}

	/** @return ObservedBy */ 
	public static function Get( $id )
	{
		global $db_conn;
		$query = "SELECT * FROM pr_observed_by WHERE id=" . $id;
		$res = @mysqli_query($db_conn,$query);
		if ($res === false || mysqli_num_rows($res) <= 0)
			return false;
		$object = mysqli_fetch_object($res);
		
		return self::LoadField($object);
	}

	/** @return ObservedBy[] */ 
	public static function GetList($where = '')
	{
		global $db_conn;
		$object_list   =   array();
		$where_ = "WHERE erased = 0";
		if ($where != '') {
			$where_ .= ' AND ' . $where;
		}
		$query = "SELECT * FROM pr_observed_by $where_";
		$res = mysqli_query( $db_conn, $query);
		if (!$res  || mysqli_num_rows($res) <= 0)
			return array();
		while ($row = mysqli_fetch_object($res,'ObservedBy')) {
			$object_list[] = self::LoadField($row);
		}
		return $object_list;
	}

	public static function CheckData($object, $clean = true){
	}

	public static function cleanData($object){
		$object->id = $object->id ;
		$object->event_id = $object->event_id ;
		$object->detection_id = $object->detection_id ;
		$object->erased = $object->erased ;
		if ($object-> erased == '1' ){
			$object->erased = 'true';
		} else {
			$object->erased = 'false';
		}
	}

	public static function LoadField($object){
		$object->last_update = strtotime($object->last_update);		return $object;
	}

	public static function getMaxId() {
		global $db_conn;
		$query = "SELECT max(id) as max_id FROM pr_observed_by";
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
			$query = "SELECT distinct ".$column." FROM pr_observed_by $where_ and ".$column." like '%$code%'; ";
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
			$query = "SELECT distinct REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'pr_observed_by' and COLUMN_NAME = '".$column."' limit 1; ";
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
