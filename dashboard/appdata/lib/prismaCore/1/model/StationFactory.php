<?php
/**
 * Class for StationFactory
 * 
 * @author: N3 S.r.l.
 */
class StationFactory extends StationFactoryBase 
{
    
    /** @return Station */ 
	public static function GetByCode( $code )
	{
		global $db_conn;
		$query = "SELECT * FROM pr_station WHERE code='$code'" ;
                
		$res = @mysqli_query($db_conn,$query);
		if ($res === false || mysqli_num_rows($res) <= 0)
			return false;
		$object = mysqli_fetch_object($res);
		
		return self::LoadField($object);
	}

        
	public static function CheckData($object, $clean = true)
        {
		$errors = array();
		$parse_error = false;
		if ($object->region_id == '') {
			$errors[] = _('region_id obbligatorio');
			$parse_error = true;
		}
		if (!is_numeric($object->region_id) && $object->region_id!= null && $object->region_id!='' && $object->region_id!= 'null') {
			$errors[] = _('region_id non numerico');
			$parse_error = true;
		}
		if ($object->code == '') {
			$errors[] = _('code obbligatorio');
			$parse_error = true;
		}
		if ($object->sequence_number == '') {
			$errors[] = _('sequence_number obbligatorio');
			$parse_error = true;
		}
		if (!is_numeric($object->longitude) && $object->longitude!= null && $object->longitude!='' && $object->longitude!= 'null') {
			$errors[] = _('longitude non numerico');
			$parse_error = true;
		}
		if (!is_numeric($object->latitude) && $object->latitude!= null && $object->latitude!='' && $object->latitude!= 'null') {
			$errors[] = _('latitude non numerico');
			$parse_error = true;
		}
		if ($object->active == '') {
			$errors[] = _('active obbligatorio');
			$parse_error = true;
		}
		if (!is_numeric($object->active) && $object->active!= null && $object->active!='' && $object->active!= 'null') {
			$errors[] = _('active non numerico');
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
