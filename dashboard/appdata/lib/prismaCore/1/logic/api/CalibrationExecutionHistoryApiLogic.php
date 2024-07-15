<?php

/**
 *
 * @author: N3 S.r.l.
 */

class CalibrationExecutionHistoryApiLogic
{
	public static function Save($request)
	{
		try {

			$Person = CoreLogic::VerifyPerson();
			CoreLogic::CheckCSRF($request->get("token"));

			$ob = new CalibrationExecutionHistory();

			CoreLogic::getFromArray($ob, $request->get("data"));
			CoreLogic::beginTransaction();
			$res = CalibrationExecutionHistoryLogic::Save($ob);
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

			$ob = new CalibrationExecutionHistory();
			$tmp = $request->get("data");

			$ob->id = $tmp["id"];

			$ob = CalibrationExecutionHistoryLogic::Get($ob->id);

			CoreLogic::getFromArray($ob, $request->get("data"));

			CoreLogic::beginTransaction();
			$res = CalibrationExecutionHistoryLogic::Update($ob);
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

			$ob = new CalibrationExecutionHistory();
			$tmp = $request->get("data");

			$ob->id = $tmp["id"];

			$ob = CalibrationExecutionHistoryLogic::Get($ob->id);

			CoreLogic::beginTransaction();
			$res = CalibrationExecutionHistoryLogic::Erase($ob);
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

			$ob = new CalibrationExecutionHistory();
			$tmp = $request->get("data");

			$ob->id = $tmp["id"];

			$ob = CalibrationExecutionHistoryLogic::Get($ob->id);

			CoreLogic::beginTransaction();
			$res = CalibrationExecutionHistoryLogic::Delete($ob);
			CoreLogic::commitTransaction();
		} catch (ApiException $a) {
			CoreLogic::rollbackTransaction();
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return CoreLogic::GenerateResponse($res, $ob);
	}

	public static function Get($id)
	{
		try {
			$res = false;
			$Person = CoreLogic::VerifyPerson();
			$ob = CalibrationExecutionHistoryLogic::Get($id);
			$res = true;
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return CoreLogic::GenerateResponse($res, $ob);
	}

	public static function GetList()
	{
		try {
			$Person = CoreLogic::VerifyPerson();
			$ob = CalibrationExecutionHistoryLogic::GetList();
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
			$codes = CalibrationExecutionHistoryFactory::GetListFilter($columnName, $_GET['term']);
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
			$foreignKey = current(CalibrationExecutionHistoryFactory::GetForeignKeyParams($columnName)); // il metodo end() che restituiva l'ultimo elemneto dell'array 
			//e supportava come parametro solamente una variabile 
			//l'ho cambiato con il metodo current() che punta all'elemento corrente dell'array 
			// e come paramentro non ha il vincolo delle variabile 
			$codes = CalibrationExecutionHistoryFactory::GetListFK($foreignKey->REFERENCED_TABLE_NAME, $foreignKey->REFERENCED_COLUMN_NAME, $_GET['term']);
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

	public static function GetFileList($name)
	{
		try {
			$Person = CoreLogic::VerifyPerson();
			$results = array();
			$data = new stdClass();
			$calibration_files = CalibrationExecutionHistoryFactory::GetFileList($name);

			foreach ($calibration_files as $file) {
				$results[] = $file;
			}
			$data->results = $results;
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return $data;
	}

	public static function GetListDatatable()
	{
		global $db_conn;
		try {
			$Person = CoreLogic::VerifyPerson();
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		$aColumns = array('`oid`', '`camera_id`', '`date`', 'DATE_FORMAT(`execution_datetime`,"%d/%m/%Y %H:%i:%s") as `execution_datetime`', '`monthly_or_daily`', '`config_parameters`', '`stdout`', '`stderr`', '`id`', 'execution_datetime as execution_datetime_o');
		$aColumnsName = array('oid', 'camera_id', 'date', 'execution_datetime', 'monthly_or_daily', 'config_parameters', 'stdout', 'stderr', 'id');
		$aColumnsOrder = array('oid', 'camera_id', 'date', 'execution_datetime_o', 'monthly_or_daily', 'config_parameters', 'stdout', 'stderr', 'id');
		$sIndexColumn = 'id';
		$sTable = 'pr_calibration_execution_history';
		$gaSql['link'] = $db_conn;;
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
					$sOrder .= $aColumnsOrder[intval($_GET['iSortCol_' . $i])] . " 
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
		$sWhere = ' WHERE erased = 0 ';
		foreach ($aColumnsName as $index => $col) {
			if (isset($_GET[$col]) && !empty($_GET[$col])) {
				$sWhere .= ' AND(';
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
			$sWhere .= ' AND(';
			for ($i = 0; $i < count($aColumnsName); $i++) {
				if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == 'true') {;
					$sWhere .= $aColumnsName[$i] . " LIKE '%" . mysqli_real_escape_string($gaSql['link'], $_GET['sSearch']) . "%' OR ";
				}
			}
			$sWhere = substr_replace($sWhere, '', -3);
			$sWhere .= ')';
		}
		/* Individual column filtering */
		for ($i = 0; $i < count($aColumnsName); $i++) {
			if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == 'true' && $_GET['sSearch_' . $i] != '') {
				if ($sWhere == '') {
					$sWhere = 'WHERE ';
				} else {
					$sWhere .= ' AND ';
				}
				$sWhere .= $aColumnsName[$i] . " LIKE '%" . mysqli_real_escape_string($gaSql['link'], $_GET['sSearch_' . $i]) . "%' ";
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
				$rResultTotal = mysqli_query($gaSql['link'], $sQuery) or fatal_error('MySQL Error: ' . mysqli_errno($gaSql['link']));
				$aResultTotal = mysqli_fetch_array($rResultTotal);
				$iDisplayStart = $aResultTotal[0];
				if (empty($iDisplayStart)) {
					$iDisplayStart = 0;
				}
				if ($iDisplayStart <=  $iDisplayLength) {
					$pageNumber = 0;
				} else {
					$pageNumber = ($iDisplayStart / $iDisplayLength);
				}
			}
		} else {
			$pageNumber = null;
		}
		/*
		 * SQL queries
		 * Get data to display
		 */
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
			for ($i = 0; $i < count($aColumnsName); $i++) {
				if ($aColumnsName[$i] == 'id') {
					$row[] = $id;
				} else if ($aColumnsName[$i] == 'camera_id') {
					$Camera = CameraLogic::Get($aRow[$aColumnsName[$i]]);
					$row[] = $Camera->code;
				} else if ($aColumnsName[$i] == 'stderr') {
					/* General output */
					//replace \n to <br/>
					$chars = array("%");
					$message =  str_replace($chars, "<br/>%", $aRow[$aColumnsName[$i]]);
					$row[] = $message;
				} else if ($aColumnsName[$i] != ' ') {
					/* General output */
					$row[] = stripslashes($aRow[$aColumnsName[$i]]);
				}
			}
			$output['aaData'][] = $row;
		}
		return $output;
	}

	public static function GetFilesListDatatable()
    {
        global $db_conn;
        try {
            $Person = CoreLogic::VerifyPerson();
        } catch (ApiException $a) {
            return CoreLogic::GenerateErrorResponse($a->message);
        }
        $aColumns = array('`name`', '`abs_path`', '`date`', '`is_month`', '`id`');
        $aColumnsName = array('name', 'abs_path', 'date', 'is_month', 'id');
        $sIndexColumn = 'name';
        $sTable = 'pr_drv_calibration';
        $gaSql['link'] = $db_conn;;
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
        $sOrder = "ORDER BY date DESC";
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
                $rResultTotal = mysqli_query($gaSql['link'], $sQuery) or fatal_error('MySQL Error: ' . mysqli_errno($gaSql['link']));
                $aResultTotal = mysqli_fetch_array($rResultTotal);
                $iDisplayStart = $aResultTotal[0];
                if (empty($iDisplayStart)) {
                    $iDisplayStart = 0;
                }
                if ($iDisplayStart <=  $iDisplayLength) {
                    $pageNumber = 0;
                } else {
                    $pageNumber = ($iDisplayStart / $iDisplayLength);
                }
            }
        } else {
            $pageNumber = null;
        }
        $day_dir = $_GET['dayDir'];
        $is_month = $_GET['month'];

        if ($day_dir == '' and $is_month != '1') {
            $sWhere = '';
        }

        if ($day_dir == '' and $is_month == '1') {
            $sWhere = 'WHERE is_month="' . $is_month . '"';
        }

        if ($day_dir != '' and $is_month != '1') {
            $sWhere = 'WHERE node_code = "' . $day_dir . '"';
        }

        if ($day_dir != '' and $is_month == '1') {
            $sWhere = 'WHERE node_code = "' . $day_dir . '" AND is_month="' . $is_month . '"';
        }


        /*
		 * SQL queries
		 * Get data to display
		 */
        $sQuery = "";

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
            $name = $aRow['calibration_name'];
            for ($i = 0; $i < count($aColumnsName); $i++) {
                if ($aColumnsName[$i] == 'id') {
                    $row[] = $id;
                } else if ($aColumnsName[$i] ==  'name' && $is_month == '1') {
                    $row[] = $name;
                } else if ($aColumnsName[$i] != ' ') {
                    /* General output */
                    $row[] = stripslashes($aRow[$aColumnsName[$i]]);
                }
            }
            $output['aaData'][] = $row;
        }

        return $output;
    }
	// Create zip of detection
	public static function CreateZip($detection)
	{
		try {
			$Person = CoreLogic::VerifyPerson();
			$zip = self::processEventZip($detection);
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return CoreLogic::GenerateResponse(true, $zip);
	}

	// Create the zip of the passed folder and put it in /tmp-media/ in webroot
	public static function processEventZip($detection)
	{
		//Clear
		//self::clearFolder();

		//Setting up global variables
		global $elabIp, $elabUsr, $elabPsw;
		global $db_conn;

		//Setting up local variables (settings)
		$destination = _WEBROOTDIR_ . "tmp-media/" . $detection;

		//Find path for this detection
		$sQuery = "SELECT abs_path FROM pr_drv_calibration WHERE name = '" . $detection . "'";
		$rResultFTotal = mysqli_query($db_conn, $sQuery);
		$aResultFilterTotal = mysqli_fetch_array($rResultFTotal);
		$pathDown = $aResultFilterTotal[0];

		//Establish ssh connection
		$connection = ssh2_connect($elabIp, 22);
		if (!$connection) die('Connection failed');
		ssh2_auth_password($connection, $elabUsr, $elabPsw);
		$sftp = ssh2_sftp($connection);

		//Download files from elab
		ssh2_scp_recv($connection, "$pathDown", "$destination");

		//Connection closing
		unset($sftp);
		ssh2_disconnect($connection);

		//Return file name
		return $detection;
	}

	//return zip file position
	public static function GetZip($zip)
	{
		return _WEBROOTDIR_ . "tmp-media/" . $zip;
	}
}
