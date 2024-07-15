<?php

/**
 * Class for CalibrationExecutionHistoryFactory
 * 
 * @author: N3 S.r.l.
 */
class CalibrationExecutionHistoryFactory extends CalibrationExecutionHistoryFactoryBase
{
	public static function CheckData($object, $clean = true)
	{
		$errors = array();
		$parse_error = false;
		if ($object->camera_id == '') {
			$errors[] = _('camera_id obbligatorio');
			$parse_error = true;
		}
		if (!is_numeric($object->camera_id) && $object->camera_id != null && $object->camera_id != '' && $object->camera_id != 'null') {
			$errors[] = _('camera_id non numerico');
			$parse_error = true;
		}
		if ($object->date == '') {
			$errors[] = _('date obbligatorio');
			$parse_error = true;
		}
		if (!is_numeric($object->date) && $object->date != null && $object->date != '' && $object->date != 'null') {
			$errors[] = _('date non numerico');
			$parse_error = true;
		}
		if ($object->execution_datetime == '') {
			$errors[] = _('execution_datetime obbligatorio');
			$parse_error = true;
		}
		if ($object->monthly_or_daily == '') {
			$errors[] = _('monthly_or_daily obbligatorio');
			$parse_error = true;
		}
		if (($object->monthly_or_daily === true && $object->monthly_or_daily != null) || $object->monthly_or_daily == 'true' || $object->monthly_or_daily == '1') {
			$object->monthly_or_daily = 1;
		} else {
			$object->monthly_or_daily = 0;
		}
		if (!is_numeric($object->monthly_or_daily) && $object->monthly_or_daily != null && $object->monthly_or_daily != '' && $object->monthly_or_daily != 'null') {
			$errors[] = _('monthly_or_daily non numerico');
			$parse_error = true;
		}
		if ($object->config_parameters == '') {
			$errors[] = _('config_parameters obbligatorio');
			$parse_error = true;
		}
		if ($object->modified_by == '') {
			$errors[] = _('modified_by obbligatorio');
			$parse_error = true;
		}
		if (!is_numeric($object->modified_by) && $object->modified_by != null && $object->modified_by != '' && $object->modified_by != 'null') {
			$errors[] = _('modified_by non numerico');
			$parse_error = true;
		}
		if ($object->created_by == '') {
			$errors[] = _('created_by obbligatorio');
			$parse_error = true;
		}
		if (!is_numeric($object->created_by) && $object->created_by != null && $object->created_by != '' && $object->created_by != 'null') {
			$errors[] = _('created_by non numerico');
			$parse_error = true;
		}
		if ($object->assigned == '') {
			$errors[] = _('assigned obbligatorio');
			$parse_error = true;
		}
		if (!is_numeric($object->assigned) && $object->assigned != null && $object->assigned != '' && $object->assigned != 'null') {
			$errors[] = _('assigned non numerico');
			$parse_error = true;
		}
		if ($object->erased == '') {
			$errors[] = _('erased obbligatorio');
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
			$errors[] = ApiLogic::getFieldErrorCode();
			throw new ApiException(ApiException::$FieldException, $errors);
		}
	}

	public static function GetFileList($name, $where = '')
	{

		global $db_conn;
		$object_list = array();
		$where_ = "WHERE name LIKE '%$name%' AND is_month = '1'";
		if ($where != '') {
			$where_ = ' AND ' . $where;
		}
		$query = "SELECT name, node_code FROM pr_drv_calibration $where_";
		$res = mysqli_query($db_conn, $query);

		if (!$res || mysqli_num_rows($res) <= 0)
			return array();

		while ($row = mysqli_fetch_object($res)) {
			$object_list[] = $row;
		}
		return $object_list;
	}
}
