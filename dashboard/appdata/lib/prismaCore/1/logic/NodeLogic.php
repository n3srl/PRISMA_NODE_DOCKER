<?php

/**
 *
 * @author: N3 S.r.l.
 */

class NodeLogic
{
	public static function Save($obj)
	{
		$Person = CoreLogic::VerifyPerson();
		N3BusinessObject::Init($obj, $Person);
		// Create file cfg
		
		// Create vpn certificate
		$res = NodeFactory::Save($obj);
		return $res;
	}

	public static function Update($obj)
	{

		$Person = CoreLogic::VerifyPerson();
		N3BusinessObject::SetModified($obj, $Person);

		return NodeFactory::Update($obj);
	}

	public static function UpdateNodeStatus($obj)
	{
		$Person = CoreLogic::VerifyPerson();
		N3BusinessObject::SetModified($obj, $Person);

		return NodeFactory::UpdateNodeStatus($obj);
	}

	public static function Erase($obj)
	{
		$Person = CoreLogic::VerifyPerson();
		return NodeFactory::Erase($obj);
	}

	public static function Delete($obj)
	{
		$Person = CoreLogic::VerifyPerson();
		return NodeFactory::Delete($obj);
	}

	public static function Get($id)
	{
		$res = false;
		$Person = CoreLogic::VerifyPerson();
		return NodeFactory::Get($id);
	}

	public static function GetList()
	{
		$Person = CoreLogic::VerifyPerson();
		$ob = NodeFactory::GetList();
		return $ob;
	}

	public static function GenerateCode($region_id)
	{
		$Person = CoreLogic::VerifyPerson();	

		$region = NodeFactory::GetRegionCode($region_id);
		//$sequence_number = NodeFactory::GetLastSequenceNumber($region_id);
		$sequence_number = NodeFactory::SetSequenceNumber($region_id);

		$code = $region->state . $region->code . $sequence_number;

		return $code;

	}

	public static function GenerateHostname($region_id)
	{
		//$hostname = "prismanode." . NodeLogic::GenerateCode($region_id);
		$hostname = NodeLogic::GenerateCode($region_id) . ".local";
		return $hostname;
	}

	public static function GetNodeStatus()
	{
		$status = NodeFactory::GetNodeStatus();
		
		return $status;
	}
}
