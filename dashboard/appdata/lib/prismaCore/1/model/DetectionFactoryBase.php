<?php
/**
 * Class for DetectionFactory
 * 
 * @author: N3 S.r.l.
 */
class DetectionFactoryBase
{
	public static function Save( $object )
	{
		global $db_conn;
		$ob = clone $object;
		DetectionFactoryBase::cleanData( $ob );
		DetectionFactory::CheckData( $ob );
		$query = "INSERT INTO pr_detection (`id`,`oid`,`node_id`,`event_id`,`inserted_timestamp`,`detected_timestamp`,`is_fake`,`modified_by`,`created_by`,`assigned`,`erased`,`last_update`) VALUES ( null,$ob->oid,$ob->node_id,$ob->event_id,$ob->inserted_timestamp,$ob->detected_timestamp,$ob->is_fake,$ob->modified_by,$ob->created_by,$ob->assigned,0,now())";
		$res = mysqli_query($db_conn,$query);
		if ($res === false)
			return false;
		$object->id = mysqli_insert_id($db_conn);

		return true;
	}

	public static function Delete( $object )
	{
		global $db_conn;
		$query = "DELETE FROM pr_detection WHERE id=" . $object->id;
		$res = mysqli_query($db_conn, $query);
		if ($res===false) return false; else return true;
	}

	public static function Erase($object)
	{
		global $db_conn;
		$query = "UPDATE pr_detection SET erased=1 WHERE id=" . $object->id . " AND erased=0";
		$res = mysqli_query($db_conn,$query);
		if ($res === false) return false; else return true;
	}

	public static function Update( $object )
	{
		global $db_conn;
		DetectionFactoryBase::cleanData( $object );
		DetectionFactory::CheckData( $object );
		$query = "UPDATE pr_detection SET `node_id` = $object->node_id,`event_id` = $object->event_id,`inserted_timestamp` = $object->inserted_timestamp,`detected_timestamp` = $object->detected_timestamp,`is_fake` = $object->is_fake,`modified_by` = $object->modified_by,`assigned` = $object->assigned,`erased` = $object->erased,`last_update`=now() WHERE id=" . $object->id;
		$res = mysqli_query($db_conn,$query);
		if ($res === false) return false; else return true;
	}

	/** @return Detection */ 
	public static function Get( $id )
	{
		global $db_conn;
		$query = "SELECT * FROM pr_detection WHERE id=" . $id;
		$res = @mysqli_query($db_conn,$query);
		if ($res === false || mysqli_num_rows($res) <= 0)
			return false;
		$object = mysqli_fetch_object($res);
		
		return self::LoadField($object);
	}

	/** @return Detection[] */ 
	public static function GetList($where = '')
	{
		global $db_conn;
		$object_list   =   array();
		$where_ = "WHERE erased = 0";
		if ($where != '') {
			$where_ .= ' AND ' . $where;
		}
		$query = "SELECT * FROM pr_detection $where_";
		$res = mysqli_query( $db_conn, $query);
		if (!$res  || mysqli_num_rows($res) <= 0)
			return array();
		while ($row = mysqli_fetch_object($res,'Detection')) {
			$object_list[] = self::LoadField($row);
		}
		return $object_list;
	}

	public static function CheckData($object, $clean = true){
	}

	public static function cleanData($object){
		$object->id = $object->id ;
		if($object->oid === null || $object->oid === ''){
			$object->oid = 'null';
		} else {
			$object->oid = "'$object->oid'" ;
		}
		$object->node_id = $object->node_id ;
		if($object->event_id === null || $object->event_id === ''){
			$object->event_id = 'null';
		}
		if(empty($object->inserted_timestamp)){
			$object->inserted_timestamp = 'null';
		}else{
			$object->inserted_timestamp = "'".DateLogic::fromUser($object->inserted_timestamp)."'";
		}
		if(empty($object->detected_timestamp)){
			$object->detected_timestamp = 'null';
		}else{
			$object->detected_timestamp = "'".DateLogic::fromUser($object->detected_timestamp)."'";
		}
		$object->is_fake = $object->is_fake ;
		if ($object-> is_fake == '1' ){
			$object->is_fake = 'true';
		} else {
			$object->is_fake = 'false';
		}
		$object->modified_by = $object->modified_by ;
		$object->created_by = $object->created_by ;
		$object->assigned = $object->assigned ;
		$object->erased = $object->erased ;
		if ($object-> erased == '1' ){
			$object->erased = 'true';
		} else {
			$object->erased = 'false';
		}
	}

	public static function LoadField($object){
		$object->inserted_timestamp = strtotime($object->inserted_timestamp);		$object->detected_timestamp = strtotime($object->detected_timestamp);		$object->last_update = strtotime($object->last_update);		return $object;
	}

	public static function getMaxId() {
		global $db_conn;
		$query = "SELECT max(id) as max_id FROM pr_detection";
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
			$query = "SELECT distinct ".$column." FROM pr_detection $where_ and ".$column." like '%$code%'; ";
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
			$query = "SELECT distinct REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'pr_detection' and COLUMN_NAME = '".$column."' limit 1; ";
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
