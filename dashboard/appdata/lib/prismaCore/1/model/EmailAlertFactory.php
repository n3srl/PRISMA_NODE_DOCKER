<?php
/**
 * Class for EmailAlertFactory
 * 
 * @author: N3 S.r.l.
 */
class EmailAlertFactory extends EmailAlertFactoryBase 
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
		if ($object->core_person_id == '') {
			$errors[] = _('core_person_id obbligatorio');
			$parse_error = true;
		}
		if (!is_numeric($object->core_person_id) && $object->core_person_id!= null && $object->core_person_id!='' && $object->core_person_id!= 'null') {
			$errors[] = _('core_person_id non numerico');
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
