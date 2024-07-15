<?php
/**
 * Class for EventExecutionHistoryFactory
 * 
 * @author: N3 S.r.l.
 */
class EventExecutionHistoryFactory extends EventExecutionHistoryFactoryBase 
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
		if ($object->execution_datetime == '') {
			$errors[] = _('execution_datetime obbligatorio');
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
		if (!is_numeric($object->modified_by) && $object->modified_by!= null && $object->modified_by!='' && $object->modified_by!= 'null') {
			$errors[] = _('modified_by non numerico');
			$parse_error = true;
		}
		if ($object->created_by == '') {
			$errors[] = _('created_by obbligatorio');
			$parse_error = true;
		}
		if (!is_numeric($object->created_by) && $object->created_by!= null && $object->created_by!='' && $object->created_by!= 'null') {
			$errors[] = _('created_by non numerico');
			$parse_error = true;
		}
		if ($object->assigned == '') {
			$errors[] = _('assigned obbligatorio');
			$parse_error = true;
		}
		if (!is_numeric($object->assigned) && $object->assigned!= null && $object->assigned!='' && $object->assigned!= 'null') {
			$errors[] = _('assigned non numerico');
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
