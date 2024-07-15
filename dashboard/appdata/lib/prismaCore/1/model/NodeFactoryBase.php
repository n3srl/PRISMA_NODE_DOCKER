<?php

/**
 * Class for NodeFactory
 * 
 * @author: N3 S.r.l.
 */
class NodeFactoryBase
{
	public static function Save($object)
	{
		global $db_conn;
		$ob = clone $object;
		$ob->sequence_number = NodeFactory::SetSequenceNumber($ob->region_id);
		
		NodeFactory::CheckData($ob);
		NodeFactoryBase::cleanData($ob);
		//$query = "INSERT INTO pr_node (`id`,`oid`,`station_id`,`MAC_address`,`hostname`,`CName`,`freeture_configuration_file`,`ovpnfile`,
		//`interval_running_DEA`,`relative_path`,`modified_by`,`created_by`,`assigned`,`erased`,`last_update`) 
		//VALUES ( null,$ob->oid,$ob->station_id,$ob->MAC_address,$ob->hostname,$ob->CName,$ob->freeture_configuration_file,$ob->ovpnfile,
		//$ob->interval_running_DEA,$ob->relative_path,$ob->modified_by,$ob->created_by,$ob->assigned,0,now())";

		$query = "INSERT INTO pr_node (`oid`,`code`,`nickname`,`region_id`,`sequence_number`,
							`altitude`,`longitude`,`latitude`,`note`,`IPaddress`,`hostname`,
							`active`,`modified_by`,`created_by`,`assigned`,`nameof_company_association`,`refered_to`,`camera_model`,`focal_length`,`node_version`,`erased`,`last_update`
							)
							VALUES 
							($ob->oid,$ob->code,$ob->nickname,$ob->region_id,$ob->sequence_number,$ob->altitude,
							$ob->longitude,$ob->latitude,$ob->note,$ob->IPaddress,$ob->hostname,
							$ob->active,$ob->modified_by,$ob->created_by,$ob->assigned,$ob->nameof_company_association,$ob->refered_to,
							$ob->camera_model,$ob->focal_length,$ob->node_version,
							0,now())";

		$res = mysqli_query($db_conn, $query);
		if ($res === false)
			return false;
		$object->id = mysqli_insert_id($db_conn);

		return true;
	}

	public static function Delete($object)
	{
		global $db_conn;
		$query = "DELETE FROM pr_node WHERE id=" . $object->id;
		$res = mysqli_query($db_conn, $query);
		if ($res === false) return false;
		else return true;
	}

	public static function Erase($object)
	{
		global $db_conn;
		$query = "UPDATE pr_node SET erased=1 WHERE id=" . $object->id . " AND erased=0";
		$res = mysqli_query($db_conn, $query);
		if ($res === false) return false;
		else return true;
	}

	public static function Update($object)
	{
		global $db_conn;
		if ($object->region_id !=  NodeFactory::CheckRow($object->id)) {
			$object->sequence_number = NodeFactory::SetSequenceNumber($object->region_id);
			
			NodeFactory::CheckData($object);
			NodeFactoryBase::cleanData($object);
			$query = "UPDATE pr_node 
				SET 
				`code` =$object->code,`nickname` =$object->nickname,`region_id` =$object->region_id,`sequence_number` =$object->sequence_number,
				`altitude` =$object->altitude,`longitude` =$object->longitude,`latitude` =$object->latitude,
				`note` =$object->note,`IPaddress` =$object->IPaddress,`hostname` =$object->hostname,
				`active` =$object->active,`modified_by` =$object->modified_by,`assigned` =$object->assigned,
				`last_update`=now(),`nameof_company_association` =$object->nameof_company_association,`refered_to` =$object->refered_to,
				`camera_model` =$object->camera_model,`focal_length` =$object->focal_length,`node_version` =$object->node_version,
				`erased` =$object->erased
				 WHERE id=" . $object->id;
		} else {

			
			NodeFactory::CheckData($object);
			NodeFactoryBase::cleanData($object);
			//$query = "UPDATE pr_node SET `station_id` = $object->station_id,`MAC_address` =$object->MAC_address,`hostname` =$object->hostname,`CName` =$object->CName,`freeture_configuration_file` =$object->freeture_configuration_file,`ovpnfile` =$object->ovpnfile,`interval_running_DEA` = $object->interval_running_DEA,`relative_path` =$object->relative_path,`modified_by` = $object->modified_by,`assigned` = $object->assigned,`erased` = $object->erased,`last_update`=now() WHERE id=" . $object->id;
			$query = "UPDATE pr_node 
				SET 
				`code` =$object->code,`nickname` =$object->nickname,`region_id` =$object->region_id,
				`altitude` =$object->altitude,`longitude` =$object->longitude,`latitude` =$object->latitude,
				`note` =$object->note,`IPaddress` =$object->IPaddress,`hostname` =$object->hostname,
				`active` =$object->active,`modified_by` =$object->modified_by,`assigned` =$object->assigned,
				`last_update`=now(),`nameof_company_association` =$object->nameof_company_association,`refered_to` =$object->refered_to,
				`camera_model` =$object->camera_model,`focal_length` =$object->focal_length,`node_version` =$object->node_version,
				`erased` =$object->erased
				 WHERE id=" . $object->id;

		}



		$res = mysqli_query($db_conn, $query);
		if ($res === false) return false;
		else return true;
	}

	/** @return Node */
	public static function Get($id)
	{
		global $db_conn;
		$query = "SELECT * FROM pr_node WHERE id=" . $id;
		$res = @mysqli_query($db_conn, $query);
		if ($res === false || mysqli_num_rows($res) <= 0)
			return false;
		$object = mysqli_fetch_object($res);

		return self::LoadField($object);
	}

	/** @return Node[] */
	public static function GetList($where = '')
	{
		global $db_conn;
		$object_list   =   array();
		$where_ = "";
		$query = "SELECT * FROM pr_node $where_";
		$res = mysqli_query($db_conn, $query);
		if (!$res  || mysqli_num_rows($res) <= 0)
			return array();
		while ($row = mysqli_fetch_object($res, 'Node')) {
			$object_list[] = self::LoadField($row);
		}
		return $object_list;
	}

	public static function CheckData($object, $clean = true)
	{
	}

	public static function cleanData($object)
	{
		$object->id = $object->id;
		if ($object->oid === null || $object->oid === '') {
			$object->oid = 'null';
		} else {
			$object->oid = "'$object->oid'";
		}
		$object->code = "'$object->code'";
		$object->nickname = "'$object->nickname'";
		$object->sequence_number = "'$object->sequence_number'";
		$object->altitude = "'$object->altitude'";
		$object->note = "'$object->note'";
		$object->IPaddress = "'$object->IPaddress'";
		$object->hostname = "'$object->hostname'";
		$object->nameof_company_association = "'$object->nameof_company_association'";
		$object->camera_model = "'$object->camera_model'";
		$object->focal_length = "'$object->focal_length'";
		$object->node_version = "'$object->node_version'";
		//$object->modified_by = $object->modified_by;
		//$object->created_by = $object->created_by;
		//$object->assigned = $object->assigned;
		//$object->erased = $object->erased;
		if ($object->erased == '1') {
			$object->erased = 'true';
		} else {
			$object->erased = 'false';
		}
	}

	public static function LoadField($object)
	{
		$object->last_update = strtotime($object->last_update);
		return $object;
	}
	public static function getMaxId()
	{
		global $db_conn;
		$query = "SELECT max(id) as max_id FROM pr_node";
		$res = mysqli_query($db_conn, $query);
		if ($res === false  || mysqli_num_rows($res) <= 0)
			return 1;
		$object = mysqli_fetch_object($res);
		$id = $object->max_id;
		if ($id == null) {
			return 1;
		}
		return $id;
	}

	public static function GetListFilter($column, $code, $where = '')
	{
		global $db_conn;
		$object_list = array();
		$where_ = "WHERE erased = 0";
		if ($where != '') {
			$where_ .= ' AND ' . $where;
		}
		$query = "SELECT distinct " . $column . " FROM pr_node $where_ and " . $column . " like '%$code%'; ";
		$res = mysqli_query($db_conn, $query);
		if (!$res || mysqli_num_rows($res) <= 0)
			return array();
		while ($row = mysqli_fetch_object($res)) {
			$object_list[] = $row;
		}
		return $object_list;
	}

	public static function GetForeignKeyParams($column)
	{
		global $db_conn;
		$object_list = array();
		$query = "SELECT distinct REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'pr_node' and COLUMN_NAME = '" . $column . "' limit 1; ";
		$res = mysqli_query($db_conn, $query);
		if (!$res || mysqli_num_rows($res) <= 0)
			return array();
		while ($row = mysqli_fetch_object($res)) {
			$object_list[] = $row;
		}
		return $object_list;
	}

	public static function GetListFK($table, $column, $code, $where = '')
	{
		global $db_conn;
		$object_list = array();
		$where_ = "WHERE erased = 0";
		if ($where != '') {
			$where_ .= ' AND ' . $where;
		}
		$query = "SELECT distinct " . $column . " FROM $table $where_ and " . $column . " like '%$code%'; ";
		$res = mysqli_query($db_conn, $query);
		if (!$res || mysqli_num_rows($res) <= 0)
			return array();
		while ($row = mysqli_fetch_object($res)) {
			$object_list[] = $row;
		}
		return $object_list;
	}

	public function __construct($handle)
	{
	}
}
