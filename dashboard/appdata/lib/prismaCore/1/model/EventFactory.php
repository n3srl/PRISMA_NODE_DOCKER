<?php
/**
 * Class for EventFactory
 * 
 * @author: N3 S.r.l.
 */
class EventFactory extends EventFactoryBase 
{
	public static function CheckData($object, $clean = true){
		$errors = array();
		$parse_error = false;
		if ($object->name == '') {
			$errors[] = _('name obbligatorio');
			$parse_error = true;
		}
		if ($object->abs_path == '') {
			$errors[] = _('abs_path obbligatorio');
			$parse_error = true;
		}
		if ($object->datetime == '') {
			$errors[] = _('datetime obbligatorio');
			$parse_error = true;
		}
		if ($object->is_processed == '') {
			$errors[] = _('is_processed obbligatorio');
			$parse_error = true;
		}
		if ($parse_error){
			$errors[] = ApiLogic::getFieldErrorCode();
			throw new ApiException(ApiException::$FieldException,$errors);
		}
	}
}
