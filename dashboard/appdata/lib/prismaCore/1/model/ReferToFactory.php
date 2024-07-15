<?php
/**
 * Class for ReferToFactory
 * 
 * @author: N3 S.r.l.
 */
class ReferToFactory extends ReferToFactoryBase 
{
	public static function CheckData($object, $clean = true){
		$errors = array();
		$parse_error = false;
		if ($object->core_person_id == '') {
			$errors[] = _('core_person_id obbligatorio');
			$parse_error = true;
		}
		if (!is_numeric($object->core_person_id) && $object->core_person_id!= null && $object->core_person_id!='' && $object->core_person_id!= 'null') {
			$errors[] = _('core_person_id non numerico');
			$parse_error = true;
		}
		if ($object->station_id == '') {
			$errors[] = _('station_id obbligatorio');
			$parse_error = true;
		}
		if (!is_numeric($object->station_id) && $object->station_id!= null && $object->station_id!='' && $object->station_id!= 'null') {
			$errors[] = _('station_id non numerico');
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
