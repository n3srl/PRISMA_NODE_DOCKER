<?php
/**
 * Class for EventController
 * 
 * @author: N3 S.r.l.
 */
class EventController extends Controller
{

	public function editOperation() {
		parent::securityCheck();
		global $Event;
		global $params;
		$par = 0;
		if (isset($params[0]) && !empty($params[0])) {
			$par = $params[0];
		}
		echo '<script>var ObjID = ' . $par. ';</script>';
	}

	public function showOperation() {
		parent::securityCheck();
		global $Event;
		global $params;
		$par = 0;
		if (isset($params[0]) && !empty($params[0])) {
			$par = $params[0];
		}
		echo '<script>alert("ciao");</script>';
	}


}
