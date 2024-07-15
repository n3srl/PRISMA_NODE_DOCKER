<?php
/**
 * Class for CameraConfiguration
 * 
 * @author: N3 S.r.l.
 */
class CameraConfiguration extends N3BusinessObject
{
	public $camera_configuration_id;
	public $model;
	public $exp_night;
	public $exp_day;

	public $gain_day;
	public $gain_night;

	public $ACQ_REGULAR_CFG;
	public $ACQ_SCHEDULE;
}
?>
