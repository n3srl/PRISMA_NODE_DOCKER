<?php

/**
 *
 * @author: N3 S.r.l.
 */

class NodeApiLogic
{
	public static function Save($request)
	{
		try {

			$Person = CoreLogic::VerifyPerson();
			CoreLogic::CheckCSRF($request->get("token"));

			$ob = new Node();

			CoreLogic::getFromArray($ob, $request->get("data"));
			CoreLogic::beginTransaction();
			$res = NodeLogic::Save($ob);
			if (!$res)
				throw new ApiException(ApiException::$Generic);
			CoreLogic::commitTransaction();
		} catch (ApiException $a) {
			CoreLogic::rollbackTransaction();
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return CoreLogic::GenerateResponse($res, $ob);
	}

	public static function Update($request)
	{

		try {
			$Person = CoreLogic::VerifyPerson();
			CoreLogic::CheckCSRF($request->get("token"));

			$ob = new Node();
			$tmp = $request->get("data");

			$ob->id = $tmp["id"];

			$ob = NodeLogic::Get($ob->id);

			CoreLogic::getFromArray($ob, $request->get("data"));

			CoreLogic::beginTransaction();
			$res = NodeLogic::Update($ob);
			CoreLogic::commitTransaction();
		} catch (ApiException $a) {
			CoreLogic::rollbackTransaction();
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return CoreLogic::GenerateResponse($res, $ob);
	}

	public static function UpdateNodeStatus($request)
	{
		try {
			$Person = CoreLogic::VerifyPerson();
			CoreLogic::CheckCSRF(($request->get("token")));

			$ob = new Node();
			$tmp = $request->get("data");

			$ob->id = $tmp["id"];

			$ob = NodeLogic::Get($ob->id);

			CoreLogic::GetFromArray($ob, $request->get("data"));

			CoreLogic::beginTransaction();
			$res = NodeLogic::UpdateNodeStatus($ob);
			CoreLogic::commitTransaction();
		} catch (ApiException $a) {
			CoreLogic::rollbackTransaction();
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return CoreLogic::GenerateResponse($res, $ob);
	}

	public static function Erase($request)
	{
		try {
			$Person = CoreLogic::VerifyPerson();
			CoreLogic::CheckCSRF($request->get("token"));

			$ob = new Node();
			$tmp = $request->get("data");

			$ob->id = $tmp["id"];

			$ob = NodeLogic::Get($ob->id);

			CoreLogic::beginTransaction();
			$res = NodeLogic::Erase($ob);
			CoreLogic::commitTransaction();
		} catch (ApiException $a) {
			CoreLogic::rollbackTransaction();
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return CoreLogic::GenerateResponse($res, $ob);
	}

	public static function Delete($request)
	{
		try {
			$Person = CoreLogic::VerifyPerson();
			CoreLogic::CheckCSRF($request->get("token"));

			$ob = new Node();
			$tmp = $request->get("data");

			$ob->id = $tmp["id"];

			$ob = NodeLogic::Get($ob->id);

			CoreLogic::beginTransaction();
			$res = NodeLogic::Delete($ob);
			CoreLogic::commitTransaction();
		} catch (ApiException $a) {
			CoreLogic::rollbackTransaction();
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return CoreLogic::GenerateResponse($res, $ob);
	}

	public static function GetCameraModels()
	{
		try {
			//$Person = CoreLogic::VerifyPerson();
			$models = Node::$camera_names;
			$results = array();
			$data = new stdClass();
			
			$data = new stdClass();
			foreach ($models as $model) {
				$obj = new stdClass();
				$obj->id = $model;
				$obj->text = $model;
				$results[] = $obj;
			}
			$data->results = $results;
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return $data;
	}

	public static function GetNodeVersions()
	{
		try {
			//$Person = CoreLogic::VerifyPerson();
			$models = Node::$v_node;
			$results = array();
			$data = new stdClass();
			
			$data = new stdClass();
			foreach ($models as $model) {
				$obj = new stdClass();
				$obj->id = $model;
				$obj->text = $model;
				$results[] = $obj;
			}
			$data->results = $results;
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return $data;
	}


	public static function Get($id)
	{
		try {
			$res = false;
			$Person = CoreLogic::VerifyPerson();
			$ob = NodeLogic::Get($id);
			$res = true;
			$active = new stdClass();
			$status = new NodeStatus();
			$regionName = RegionFactory::GetRegionName($ob->region_id);

			$refered_contact = ContactLogic::Get($ob->refered_to);
			
			$refered_to = new stdClass();
			$refered_to->text = $refered_contact->first_name." ".$refered_contact->last_name;
			$refered_to->id = $ob->refered_to;
			// $region = new stdClass();
			// $region->text = $regionName;
			// $region->id = $ob->region_id;
			$ob->region_id = $regionName;
			$active->text  = $status->descriptions[$ob->active];
			$active->id = $ob->active;
			$ob->active = $active;
			$ob->refered_to = $refered_to;
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return CoreLogic::GenerateResponse($res, $ob);
	}

	public static function GetList()
	{
		try {
			$Person = CoreLogic::VerifyPerson();
			$ob = NodeLogic::GetList();
			$res = true;
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return CoreLogic::GenerateResponse($res, $ob);
	}

	public static function GetListFilterAjax($columnName)
	{
		try {
			$Person = CoreLogic::VerifyPerson();
			$results = array();
			$data = new stdClass();
			$codes = NodeFactory::GetListFilter($columnName, $_GET['term']);
			foreach ($codes as $code) {
				$obj = new stdClass();
				$obj->id = $code->{$columnName};
				$obj->text = $code->{$columnName};
				$results[] = $obj;
			}
			$data->results = $results;
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return $data;
	}

	public static function GetListFKAjax($columnName)
	{
		try {
			$Person = CoreLogic::VerifyPerson();
			$results = array();
			$data = new stdClass();
			$foreignKey = end(NodeFactory::GetForeignKeyParams($columnName));
			$codes = NodeFactory::GetListFK($foreignKey->REFERENCED_TABLE_NAME, $foreignKey->REFERENCED_COLUMN_NAME, $_GET['term']);
			$data = new stdClass();
			foreach ($codes as $code) {
				$obj = new stdClass();
				$obj->id = $code->{$foreignKey->REFERENCED_COLUMN_NAME};
				$obj->text = $code->{$foreignKey->REFERENCED_COLUMN_NAME};
				$results[] = $obj;
			}
			$data->results = $results;
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return $data;
	}

	public static function GetRegionFKAjax($columnName)
	{
		try {
			$Person = CoreLogic::VerifyPerson();
			$results = array();
			$data = new stdClass();
			$foreignKey = end(NodeFactory::GetForeignKeyParams($columnName));
			$codes = NodeFactory::GetRegionFK($foreignKey->REFERENCED_TABLE_NAME, $foreignKey->REFERENCED_COLUMN_NAME, $_GET['term']);
			$data = new stdClass();
			foreach ($codes as $code) {
				$obj = new stdClass();
				$obj->id = $code->{$foreignKey->REFERENCED_COLUMN_NAME};
				$obj->text = $code->name;
				$results[] = $obj;
			}
			$data->results = $results;
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return $data;
	}

	public static function GetPersonFKAjax($columnName)
	{
		
		try {
			//echo "GET PERSON:" . $columnName . " -> ";
			$Person = CoreLogic::VerifyPerson();
			$results = array();
			$data = new stdClass();
			$foreignKey = end(NodeFactory::GetForeignKeyParams($columnName));
			//echo $foreignKey->REFERENCED_COLUMN_NAME . " -> ";
			$codes = NodeFactory::GetPersonFK($foreignKey->REFERENCED_TABLE_NAME, $foreignKey->REFERENCED_COLUMN_NAME, $_GET['term']);
			$data = new stdClass();
			foreach ($codes as $code) {
				$obj = new stdClass();
				$obj->id = $code->{$foreignKey->REFERENCED_COLUMN_NAME};
				$obj->text = $code->last_name . " " . $code->first_name;
				$results[] = $obj;
			}
			$data->results = $results;
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return $data;
	}

	public static function GenerateCode($region_id)
	{
		try {
			$Person = CoreLogic::VerifyPerson();
			$res = false;
			$code = NodeLogic::GenerateCode($region_id);
			$res = true;
			$obj = new stdClass();
			//$results[] = $code;
			$obj->code = $code;
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		//return $obj;
		return CoreLogic::GenerateResponse($res, $obj);
	}
	public static function GenerateHostname($region_id)
	{
		try {
			$Person = CoreLogic::VerifyPerson();
			$res = false;
			$hostname = NodeLogic::GenerateHostname($region_id);
			$res = true;
			$obj = new stdClass();
			//$results[] = $code;
			$obj->hostname = $hostname;
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		//return $obj;
		return CoreLogic::GenerateResponse($res, $obj);
	}

	public static function GetNodeStatus()
	{
		try {
			$Person = CoreLogic::VerifyPerson();
			$results = array();
			$data = new stdClass();
			$status = NodeFactory::GetNodeStatus();
			$data = new stdClass();
			foreach ($status as $object) {
				$obj = new stdClass();
				$obj->id = $object->id;
				$obj->text = $object->text;
				$results[] = $obj;
			}
			$data->results = $results;
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return $data;
	}

	public static function GetSolutionFile()
	{
		return NodeFactory::CreateSolutionFile();
	}

	public static function GetListDatatable()
	{
		global $db_conn;
		try {
			$Person = CoreLogic::VerifyPerson();
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		// Nameof company association
		// Address
		// Postocde
		// City
		// Province
		// Country
		$aColumns = array(
			'`code`', '`nickname`', '`region_id`', '`IPaddress`', '`refered_to`', '`altitude`',
			'`longitude`', '`latitude`', '`note`', '`hostname`', '`active`', '`nameof_company_association`', '`camera_model`', '`focal_length`', '`node_version`', '`id`'
		);

		$aColumnsName = array(
			'code', 'nickname', 'region_id', 'IPaddress', 'refered_to', 'altitude',
			'longitude', 'latitude', 'note', 'hostname', 'active', 'nameof_company_association', 'camera_model', 'focal_length', 'node_version', 'id'
		);

		$sIndexColumn = 'id';
		$sTable = 'pr_node';
		$gaSql['link'] = $db_conn;
		/*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
		 * no need to edit below this line
		 */
		/* Local functions */
		function fatal_error($sErrorMessage = '')
		{
			header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
			die($sErrorMessage);
		}
		/* Ordering */
		$sOrder = '';
		if (isset($_GET['iSortCol_0'])) {
			$sOrder = 'ORDER BY  ';
			for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {;
				if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == 'true') {
					$sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . " 
						 " . ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
				}
			}
			$sOrder = substr_replace($sOrder, '', -2);
			if ($sOrder == 'ORDER BY') {
				$sOrder = '';
			}
		}
		/*
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
		$sWhere = 'WHERE erased = 0 ';
		foreach ($aColumnsName as $index => $col) {
			if (isset($_GET[$col]) && !empty($_GET[$col])) {
				$sWhere .= ' AND (';
				if (is_array($_GET[$col])) {
					foreach ($_GET[$col] as $c) {
						$filter = mysqli_escape_string($db_conn, $c);
						$sWhere .= "  $aColumns[$index] like '%$filter%' OR ";
					}
					$sWhere = substr_replace($sWhere, '', -3);
					$sWhere .= ') ';
				} else {
					$filter = mysqli_escape_string($db_conn, $_GET[$col]);
					$sWhere .= "  $aColumns[$index] like '%$filter%' OR ";
					$sWhere = substr_replace($sWhere, '', -3);
					$sWhere .= ') ';
				}
			}
		}

		if (isset($_GET['sSearch']) && $_GET['sSearch'] != '') {
			//$sWhere .= ' AND(';
			if ($sWhere == '') {
				$sWhere = 'WHERE (';
			} else {
				$sWhere .= ' AND (';
			}
			for ($i = 0; $i < count($aColumns); $i++) {
				if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == 'true') {;
					$sWhere .= $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($gaSql['link'], $_GET['sSearch']) . "%' OR ";
				}
			}
			$sWhere = substr_replace($sWhere, '', -3);

			$sWhere .= ')';
		}
		/* Individual column filtering */
		for ($i = 0; $i < count($aColumnsName); $i++) {
			if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == 'true' && $_GET['sSearch_' . $i] != '') {
				// if ($sWhere == '') {
				// 	$sWhere = 'WHERE ';
				// } else {
				// 	$sWhere .= ' AND ';
				// }
				$sWhere .= ' AND (';
				$sWhere .= $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($gaSql['link'], $_GET['sSearch_' . $i]) . "%' ";
			}
		}
		/* DATATABLE show page by id */

		
		$sLimit = '';
		if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
			$sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " . intval($_GET['iDisplayLength']);
		}
		if (isset($_GET['searchPageById']) && !empty($_GET['searchPageById']) && $_GET['searchPageById'] != -1) {
			if ($_GET['iDisplayLength'] != '-1') {
				$iDisplayLength = intval($_GET['iDisplayLength']);
				$bsearchPageById = mysqli_escape_string($gaSql['link'],  $_GET['searchPageById']);
				$sQuery = "select FLOOR(row_number / $iDisplayLength) * $iDisplayLength from("
					. "SELECT @row_number:= @row_number + 1 AS row_number, $sIndexColumn FROM $sTable, (SELECT @row_number:= 0) AS t "
					. "$sWhere"
					. "$sOrder"
					. ") as a where a.$sIndexColumn =  $bsearchPageById";
					//echo $sQuery;
				$rResultTotal = mysqli_query($gaSql['link'], $sQuery) or fatal_error('MySQL Error: ' . mysqli_errno($gaSql['link']));
				$aResultTotal = mysqli_fetch_array($rResultTotal);
				$iDisplayStart = $aResultTotal[0];
				if (empty($iDisplayStart)) {
					$iDisplayStart = 0;
				}

				//verificare utilità if
				if ($iDisplayStart <=  $iDisplayLength) {
					$pageNumber = 0;
				} else {
				}
				$pageNumber = ($iDisplayStart / $iDisplayLength);
			}
		} else {
			$pageNumber = null;
		}
		/*
		 * SQL queries
		 * Get data to display
		 */
		//$sWhere = '';
		mysqli_query($gaSql['link'], 'SET CHARACTER SET utf8') or fatal_error('MySQL Error: ' . mysqli_errno($gaSql['link']));
		$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
		";
		$rResult = mysqli_query($gaSql['link'], $sQuery) or fatal_error('MySQL Error: ' . mysqli_errno($gaSql['link']));
		/* Data set length after filtering */
		$sQuery = "
		SELECT FOUND_ROWS()";
		$rResultFilterTotal = mysqli_query($gaSql['link'], $sQuery) or fatal_error('MySQL Error: ' . mysqli_errno($gaSql['link']));
		$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
		$iFilteredTotal = $aResultFilterTotal[0];
		/* Total data set length */
		$sQuery = "
		SELECT COUNT(" . $sIndexColumn . ")
		FROM   $sTable
		";
		$rResultTotal = mysqli_query($gaSql['link'], $sQuery) or fatal_error('MySQL Error: ' . mysqli_errno($gaSql['link']));
		$aResultTotal = mysqli_fetch_array($rResultTotal);
		$iTotal = $aResultTotal[0];
		/*
		 * Output
		 */
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"pageToShow" => $pageNumber,
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
		);
		while ($aRow = mysqli_fetch_array($rResult)) {
			$row = array();
			$id = $aRow['id'];
			$active = new NodeStatus();
			$region = new stdClass();
			// $region->id = $aRow['region_id'];
			// $region->name = RegionFactory::GetRegionName($region->id);
			$region = RegionFactory::GetRegionName($aRow['region_id']);
			$contact = NodeFactory::GetContactName($aRow['refered_to']);
			$active->status_id = $aRow['active'];
			$active->status_description  = $active->descriptions[$active->status_id];

			for ($i = 0; $i < count($aColumnsName); $i++) {
				if ($aColumnsName[$i] == 'id') {
					$row[] = $id;
				} else if ($aColumnsName[$i] == 'active') {
					$row[] = array($active->status_id, $active->status_description);
				} else if ($aColumnsName[$i] == 'region_id') {
					$row[] = $region->text;
				} else if ($aColumnsName[$i] == 'refered_to') {
					$row[] = $contact->name;
				} else if ($aColumnsName[$i] == 'code') {
					$row[] = '<a target = "_blank" href = "/lib/prismaCore/1/node/configuration/download?id='.$id.'"><i style = "text-decoration:none; color: #414C68; margin-right: 10px; font-size:20px" class="fa fa-file-zip-o"></i></a>'.$aRow[$aColumnsName[$i]];
				} else if ($aColumnsName[$i] != ' ') {
					/* General output */
					$row[] = stripslashes($aRow[$aColumnsName[$i]]);
				}
				// if ($aColumnsName[$i] == 'code') {
				// 	$aRow['region_id'] = $aRow[$aColumnsName[$i]];
				// 	$row[] = stripslashes($aRow['region_id']);
				// }
			}
			$output['aaData'][] = $row;
		}
		return $output;
	}

	public static function GetNodeConfiguration()
	{
		$id = $_GET['id'];
		if(!NodeFactory::GetNodeConfiguration($id)) return false;
		return NodeFactory::GetNodeConfigurationZipped($id);
	}
}
