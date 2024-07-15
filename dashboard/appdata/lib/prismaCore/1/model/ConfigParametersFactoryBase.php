<?php
/**
 * Class for ConfigParametersFactory
 * 
 * @author: N3 S.r.l.
 */
class ConfigParametersFactoryBase
{
	public static function Save( $object )
	{
		global $db_conn;
		$ob = clone $object;
		ConfigParametersFactoryBase::cleanData( $ob );
		ConfigParametersFactory::CheckData( $ob );
		$query = "INSERT INTO pr_config_parameters (`id`,`oid`,`general_quiet`,`general_on_error`,`general_except`,`image_report_photo`,`daily_report_astro`,`daily_histo`,`monthly_report_astro`,`monthly_histo`,`event_fill_frames`,`event_recenter`,`event_box_bolide`,`event_model_psf`,`event_model_bar`,`event_report`,`event_image`,`event_video`,`modified_by`,`created_by`,`assigned`,`erased`,`last_update`) VALUES ( null,$ob->oid,$ob->general_quiet,$ob->general_on_error,$ob->general_except,$ob->image_report_photo,$ob->daily_report_astro,$ob->daily_histo,$ob->monthly_report_astro,$ob->monthly_histo,$ob->event_fill_frames,$ob->event_recenter,$ob->event_box_bolide,$ob->event_model_psf,$ob->event_model_bar,$ob->event_report,$ob->event_image,$ob->event_video,$ob->modified_by,$ob->created_by,$ob->assigned,0,now())";
		$res = mysqli_query($db_conn,$query);
		if ($res === false)
			return false;
		$object->id = mysqli_insert_id($db_conn);

		return true;
	}

	public static function Delete( $object )
	{
		global $db_conn;
		$query = "DELETE FROM pr_config_parameters WHERE id=" . $object->id;
		$res = mysqli_query($db_conn, $query);
		if ($res===false) return false; else return true;
	}

	public static function Erase($object)
	{
		global $db_conn;
		$query = "UPDATE pr_config_parameters SET erased=1 WHERE id=" . $object->id . " AND erased=0";
		$res = mysqli_query($db_conn,$query);
		if ($res === false) return false; else return true;
	}

	public static function Update( $object )
	{
		global $db_conn;
		ConfigParametersFactoryBase::cleanData( $object );
		ConfigParametersFactory::CheckData( $object );
		$query = "UPDATE pr_config_parameters SET `general_quiet` = $object->general_quiet,`general_on_error` = $object->general_on_error,`general_except` = $object->general_except,`image_report_photo` =$object->image_report_photo,`daily_report_astro` =$object->daily_report_astro,`daily_histo` =$object->daily_histo,`monthly_report_astro` =$object->monthly_report_astro,`monthly_histo` =$object->monthly_histo,`event_fill_frames` =$object->event_fill_frames,`event_recenter` =$object->event_recenter,`event_box_bolide` = $object->event_box_bolide,`event_model_psf` =$object->event_model_psf,`event_model_bar` =$object->event_model_bar,`event_report` =$object->event_report,`event_image` =$object->event_image,`event_video` =$object->event_video,`modified_by` = $object->modified_by,`assigned` = $object->assigned,`erased` = $object->erased,`last_update`=now() WHERE id=" . $object->id;
		$res = mysqli_query($db_conn,$query);
		if ($res === false) return false; else return true;
	}

	/** @return ConfigParameters */ 
	public static function Get( $id )
	{
		global $db_conn;
		$query = "SELECT * FROM pr_config_parameters WHERE id=" . $id;
		$res = @mysqli_query($db_conn,$query);
		if ($res === false || mysqli_num_rows($res) <= 0)
			return false;
		$object = mysqli_fetch_object($res);
		
		return self::LoadField($object);
	}

	/** @return ConfigParameters[] */ 
	public static function GetList($where = '')
	{
		global $db_conn;
		$object_list   =   array();
		$where_ = "WHERE erased = 0";
		if ($where != '') {
			$where_ .= ' AND ' . $where;
		}
		$query = "SELECT * FROM pr_config_parameters $where_";
		$res = mysqli_query( $db_conn, $query);
		if (!$res  || mysqli_num_rows($res) <= 0)
			return array();
		while ($row = mysqli_fetch_object($res,'ConfigParameters')) {
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
		$object->general_quiet = $object->general_quiet ;
		if ($object-> general_quiet == '1' ){
			$object->general_quiet = 'true';
		} else {
			$object->general_quiet = 'false';
		}
		$object->general_on_error = $object->general_on_error ;
		if ($object-> general_on_error == '1' ){
			$object->general_on_error = 'true';
		} else {
			$object->general_on_error = 'false';
		}
		$object->general_except = $object->general_except ;
		if ($object-> general_except == '1' ){
			$object->general_except = 'true';
		} else {
			$object->general_except = 'false';
		}
		$object->image_report_photo = "'$object->image_report_photo'" ;
		$object->daily_report_astro = "'$object->daily_report_astro'" ;
		$object->daily_histo = "'$object->daily_histo'" ;
		$object->monthly_report_astro = "'$object->monthly_report_astro'" ;
		$object->monthly_histo = "'$object->monthly_histo'" ;
		$object->event_fill_frames = "'$object->event_fill_frames'" ;
		$object->event_recenter = "'$object->event_recenter'" ;
		$object->event_box_bolide = $object->event_box_bolide ;
		$object->event_model_psf = "'$object->event_model_psf'" ;
		$object->event_model_bar = "'$object->event_model_bar'" ;
		$object->event_report = "'$object->event_report'" ;
		$object->event_image = "'$object->event_image'" ;
		$object->event_video = "'$object->event_video'" ;
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
		$object->last_update = strtotime($object->last_update);		return $object;
	}

	public static function getMaxId() {
		global $db_conn;
		$query = "SELECT max(id) as max_id FROM pr_config_parameters";
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
			$query = "SELECT distinct ".$column." FROM pr_config_parameters $where_ and ".$column." like '%$code%'; ";
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
			$query = "SELECT distinct REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'pr_config_parameters' and COLUMN_NAME = '".$column."' limit 1; ";
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
