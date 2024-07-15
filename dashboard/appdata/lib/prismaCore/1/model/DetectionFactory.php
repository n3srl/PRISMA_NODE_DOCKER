<?php
/**
 * Class for DetectionFactory
 * 
 * @author: N3 S.r.l.
 */
class DetectionFactory extends DetectionFactoryBase 
{
	public static function CheckData($object, $clean = true){
		$errors = array();
		$parse_error = false;
		if ($object->node_id == '') {
			$errors[] = _('node_id obbligatorio');
			$parse_error = true;
		}
		if (!is_numeric($object->node_id) && $object->node_id!= null && $object->node_id!='' && $object->node_id!= 'null') {
			$errors[] = _('node_id non numerico');
			$parse_error = true;
		}
		if (!is_numeric($object->event_id) && $object->event_id!= null && $object->event_id!='' && $object->event_id!= 'null') {
			$errors[] = _('event_id non numerico');
			$parse_error = true;
		}
		if ($object->is_fake == '') {
			$errors[] = _('is_fake obbligatorio');
			$parse_error = true;
		}
		if (($object->is_fake === true && $object->is_fake!=null) || $object->is_fake =='true' || $object->is_fake =='1' ) {$object->is_fake = 1;}else{ $object->is_fake = 0;}
		if (!is_numeric($object->is_fake) && $object->is_fake!= null && $object->is_fake!='' && $object->is_fake!= 'null') {
			$errors[] = _('is_fake non numerico');
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
