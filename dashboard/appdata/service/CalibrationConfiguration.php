<?php
/**
 * Class for CalibrationConfigurationController
 * 
 * @author: N3 S.r.l.
 */
class CalibrationConfigurationController extends Controller
{
	public function editOperation() {
		parent::securityCheck();
		global $CalibrationConfiguration;
		global $params;
		$par = 0;
		if (isset($params[0]) && !empty($params[0])) {
			$par = $params[0];
		}
		echo '<script>var ObjID = ' . $par. ';</script>';
	}


}
