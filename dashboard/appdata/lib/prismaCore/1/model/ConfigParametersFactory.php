<?php
/**
 * Class for ConfigParametersFactory
 * 
 * @author: N3 S.r.l.
 */
class ConfigParametersFactory extends ConfigParametersFactoryBase 
{
	public static function CheckData($object, $clean = true){
		$errors = array();
		$parse_error = false;
		if ($object->general_quiet == '') {
			$errors[] = _('general_quiet obbligatorio');
			$parse_error = true;
		}
		if (($object->general_quiet === true && $object->general_quiet!=null) || $object->general_quiet =='true' || $object->general_quiet =='1' ) {$object->general_quiet = 1;}else{ $object->general_quiet = 0;}
		if (!is_numeric($object->general_quiet) && $object->general_quiet!= null && $object->general_quiet!='' && $object->general_quiet!= 'null') {
			$errors[] = _('general_quiet non numerico');
			$parse_error = true;
		}
		if ($object->general_on_error == '') {
			$errors[] = _('general_on_error obbligatorio');
			$parse_error = true;
		}
		if (($object->general_on_error === true && $object->general_on_error!=null) || $object->general_on_error =='true' || $object->general_on_error =='1' ) {$object->general_on_error = 1;}else{ $object->general_on_error = 0;}
		if (!is_numeric($object->general_on_error) && $object->general_on_error!= null && $object->general_on_error!='' && $object->general_on_error!= 'null') {
			$errors[] = _('general_on_error non numerico');
			$parse_error = true;
		}
		if ($object->general_except == '') {
			$errors[] = _('general_except obbligatorio');
			$parse_error = true;
		}
		if (($object->general_except === true && $object->general_except!=null) || $object->general_except =='true' || $object->general_except =='1' ) {$object->general_except = 1;}else{ $object->general_except = 0;}
		if (!is_numeric($object->general_except) && $object->general_except!= null && $object->general_except!='' && $object->general_except!= 'null') {
			$errors[] = _('general_except non numerico');
			$parse_error = true;
		}
		if ($object->image_report_photo == '') {
			$errors[] = _('image_report_photo obbligatorio');
			$parse_error = true;
		}
		if ($object->daily_report_astro == '') {
			$errors[] = _('daily_report_astro obbligatorio');
			$parse_error = true;
		}
		if ($object->daily_histo == '') {
			$errors[] = _('daily_histo obbligatorio');
			$parse_error = true;
		}
		if ($object->monthly_report_astro == '') {
			$errors[] = _('monthly_report_astro obbligatorio');
			$parse_error = true;
		}
		if ($object->monthly_histo == '') {
			$errors[] = _('monthly_histo obbligatorio');
			$parse_error = true;
		}
		if ($object->event_fill_frames == '') {
			$errors[] = _('event_fill_frames obbligatorio');
			$parse_error = true;
		}
		if ($object->event_recenter == '') {
			$errors[] = _('event_recenter obbligatorio');
			$parse_error = true;
		}
		if ($object->event_box_bolide == '') {
			$errors[] = _('event_box_bolide obbligatorio');
			$parse_error = true;
		}
		if (!is_numeric($object->event_box_bolide) && $object->event_box_bolide!= null && $object->event_box_bolide!='' && $object->event_box_bolide!= 'null') {
			$errors[] = _('event_box_bolide non numerico');
			$parse_error = true;
		}
		if ($object->event_model_psf == '') {
			$errors[] = _('event_model_psf obbligatorio');
			$parse_error = true;
		}
		if ($object->event_model_bar == '') {
			$errors[] = _('event_model_bar obbligatorio');
			$parse_error = true;
		}
		if ($object->event_report == '') {
			$errors[] = _('event_report obbligatorio');
			$parse_error = true;
		}
		if ($object->event_image == '') {
			$errors[] = _('event_image obbligatorio');
			$parse_error = true;
		}
		if ($object->event_video == '') {
			$errors[] = _('event_video obbligatorio');
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
