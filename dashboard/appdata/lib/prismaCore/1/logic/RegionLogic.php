<?php
/**
*
* @author: N3 S.r.l.
*/

class RegionLogic
{
	public static function Save($obj) {
			$Person = CoreLogic::VerifyPerson();
			N3BusinessObject::Init($obj, $Person);
			$res = RegionFactory::Save($obj);
			return $res;
	}

	public static function Update($obj){

		$Person = CoreLogic::VerifyPerson();
		N3BusinessObject::SetModified($obj, $Person);

		return RegionFactory::Update($obj);
	}

	public static function Erase($obj) {
			$Person = CoreLogic::VerifyPerson();
			return RegionFactory::Erase($obj);
	}

	public static function Delete($obj) {
			$Person = CoreLogic::VerifyPerson();
			return RegionFactory::Delete($obj);
	}

	public static function Get($id) {
			$res = false;
			$Person = CoreLogic::VerifyPerson();
			return RegionFactory::Get($id);
	}	
        
        public static function GetByCode($code) {
			$res = false;
			$Person = CoreLogic::VerifyPerson();
			return RegionFactory::GetByCode($code);
	}

	public static function GetList() {
			$Person = CoreLogic::VerifyPerson();
			$ob = RegionFactory::GetList();
			return $ob;
}
}

