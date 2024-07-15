<?php
/**
 * Class for ContactFactory
 * 
 * @author: N3 S.r.l.
 */
class ContactFactory extends ContactFactoryBase 
{
	public static function CheckData($object, $clean = true){
		$parse_error = false;
		if ($object->first_name == '') {
			$errors[] = _('first name obbligatorio');
			$parse_error = true;
		}

		if ($object->last_name == '') {
			$errors[] = _('last name obbligatorio');
			$parse_error = true;
		}

		if ($parse_error) {
			$errors[] = ApiLogic::getFieldErrorCode();
			throw new ApiException(ApiException::$FieldException, $errors);
		}
	}
}
