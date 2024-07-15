<?php
/**
 * Class for Node
 * 
 * @author: N3 S.r.l.
 */


class Node extends N3BusinessObject
{ 
	public static $camera_names = ["BASLER1300gm", "PHX016S-MS"];
	public static $v_node = ["ITA Freeture13", "ITA Freeture", "Fripon"];
  	public $code;
	public $nickname;
	public $region_id;
	public $sequence_number;
	public $altitude=null;
	public $longitude=null;
	public $latitude=null;
	public $note=null;
	public $IPaddress=null;
	public $MAC_address=null;
	public $hostname=null;
	public $active;
	//public $modified_by;
	//public $created_by;
	//public $assigned;
	public $last_update;
	public $nameof_company_association;
	public $camera_model = null;
	public $focal_length = null;
	public $node_version = null;
	public $address=null;
	public $postcode=null;
	public $city=null;
	public $province=null;
	public $country=null;
	public $refered_to=null; 
	public $erased;
}

class BASLER1300gmNode
{

	function __construct($node)
	{
		$this->node = $node;
	}

	public function get($param)
	{
		return $this->node->$param;
	}

	public $exp_night = 33333;
	public $exp_day = 20;

	public $gain_day = 300;
	public $gain_night = 400;

	public $ACQ_REGULAR_CFG = "00h10m00s5000000e400g1f1n";
	public $ACQ_SCHEDULE = "12h00m00s2000000e5gf1n";


	public $node;
}

class PHX016SNode
{

	function __construct($node)
	{
		$this->node = $node;
	}

	public function get($param)
	{
		return $this->node->$param;
	}

	public $exp_night = 33333;
	public $exp_day = 26;

	public $gain_day = 32;
	public $gain_night = 48;

	public $ACQ_REGULAR_CFG = "00h10m00s1000000e48g1f1n";
	public $ACQ_SCHEDULE = "12h00m00s2000000e5gf1n";

	public $node;
}
?>
