<?php
/**
 * Class for Station
 * 
 * @author: N3 S.r.l.
 */
class Station extends N3BusinessObject
{
	public $region_id;
	public $code;
	public $sequence_number;
	public $altitude=null;
	public $longitude=null;
	public $latitude=null;
	public $note;
	public $nickname=null;
	public $registration_date=null;
	public $active=1;
}
?>
