<?php
/**
 * Class for CalibrationExecutionHistory
 * 
 * @author: N3 S.r.l.
 */
class CalibrationExecutionHistory extends N3BusinessObject
{
	public $camera_id;
	public $date;
	public $execution_datetime;
	public $monthly_or_daily;
	public $config_parameters;
	public $stdout;
	public $stderr;
}
?>
