<?php
/**
 * Class for ContactController
 * 
 * @author: N3 S.r.l.
 */
class ContactController extends Controller
{
	public function editOperation() {
		parent::securityCheck();
		global $Contact;
		global $params;
		$par = 0;
		if (isset($params[0]) && !empty($params[0])) {
			$par = $params[0];
		}
		echo '<script>var ObjID = ' . $par. ';</script>';
	}


}
