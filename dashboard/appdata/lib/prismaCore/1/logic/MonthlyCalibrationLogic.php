<?php

/**
 *
 * @author: N3 S.r.l.
 */

class MonthlyCalibrationLogic
{
	public static function Save($obj)
	{
		$Person = CoreLogic::VerifyPerson();
		N3BusinessObject::Init($obj, $Person);
		$res = MonthlyCalibrationFactory::Save($obj);
		return $res;
	}

	public static function Update($obj)
	{

		$Person = CoreLogic::VerifyPerson();
		N3BusinessObject::SetModified($obj, $Person);

		return MonthlyCalibrationFactory::Update($obj);
	}

	public static function Erase($obj)
	{
		$Person = CoreLogic::VerifyPerson();
		return MonthlyCalibrationFactory::Erase($obj);
	}

	public static function Delete($obj)
	{
		$Person = CoreLogic::VerifyPerson();
		return MonthlyCalibrationFactory::Delete($obj);
	}

	public static function Get($id)
	{
		$res = false;
		$Person = CoreLogic::VerifyPerson();
		return MonthlyCalibrationFactory::Get($id);
	}

	public static function GetList()
	{
		$Person = CoreLogic::VerifyPerson();
		$ob = MonthlyCalibrationFactory::GetList();
		return $ob;
	}

    public static function SetDefaultCalibration($obj)
	{
		$Person = CoreLogic::VerifyPerson();
		N3BusinessObject::SetModified($obj, $Person);

		return MonthlyCalibrationFactory::SetDefaultCalibration($obj);
	}

	
}
