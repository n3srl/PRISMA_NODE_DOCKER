<?php
/**
 * Class for MonthlyCalibrationController
 * 
 * @author: N3 S.r.l.
 */
class MonthlyCalibrationController extends Controller
{
	public function editOperation() {
		parent::securityCheck();
		global $MonthlyCalibration;
		global $params;
		$par = 0;
		if (isset($params[0]) && !empty($params[0])) {
			$par = $params[0];
		}
		echo '<script>var ObjID = ' . $par. ';</script>';
	}


}
