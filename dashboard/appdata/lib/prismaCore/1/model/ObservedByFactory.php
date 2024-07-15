<?php
/**
 * Class for ObservedByFactory
 * 
 * @author: N3 S.r.l.
 */
class ObservedByFactory extends ObservedByFactoryBase 
{
	public static function CheckData($object, $clean = true){
		$errors = array();
		$parse_error = false;
		if ($object->event_id == '') {
			$errors[] = _('event_id obbligatorio');
			$parse_error = true;
		}
		if (!is_numeric($object->event_id) && $object->event_id!= null && $object->event_id!='' && $object->event_id!= 'null') {
			$errors[] = _('event_id non numerico');
			$parse_error = true;
		}
		if ($object->detection_id == '') {
			$errors[] = _('detection_id obbligatorio');
			$parse_error = true;
		}
		if (!is_numeric($object->detection_id) && $object->detection_id!= null && $object->detection_id!='' && $object->detection_id!= 'null') {
			$errors[] = _('detection_id non numerico');
			$parse_error = true;
		}
		if ($object->erased == '') {
			$errors[] = _('erased obbligatorio');
			$parse_error = true;
		}
		if (($object->erased === true && $object->erased!=null) || $object->erased =='true' || $object->erased =='1' ) {$object->erased = 1;}else{ $object->erased = 0;}
		if (!is_numeric($object->erased) && $object->erased!= null && $object->erased!='' && $object->erased!= 'null') {
			$errors[] = _('erased non numerico');
			$parse_error = true;
		}
		if ($parse_error){
			$errors[] = ApiLogic::getFieldErrorCode();
			throw new ApiException(ApiException::$FieldException,$errors);
		}
	}
}
