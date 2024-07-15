<?php
/**
*
* @author: N3 S.r.l.
*/

class EventApiLogic
{
	public static function Save($request) {
		try {

			$Person = CoreLogic::VerifyPerson();
			CoreLogic::CheckCSRF($request->get("token"));

			$ob = new Event();

			CoreLogic::getFromArray($ob, $request->get("data"));
			CoreLogic::beginTransaction();
			$res = EventLogic::Save($ob);
			if(!$res)
				throw new ApiException(ApiException::$Generic);
			CoreLogic::commitTransaction();
		} catch (ApiException $a) {
			CoreLogic::rollbackTransaction();
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return CoreLogic::GenerateResponse($res, $ob);
	}

	public static function Update($request){

		try {
			$Person = CoreLogic::VerifyPerson();
			CoreLogic::CheckCSRF($request->get("token"));

			$ob = new Event();
			$tmp = $request->get("data");

			$ob->id = $tmp["id"] ;

			$ob = EventLogic::Get($ob->id);

			CoreLogic::getFromArray($ob, $request->get("data"));

			CoreLogic::beginTransaction();
			$res = EventLogic::Update($ob);
			CoreLogic::commitTransaction();
		} catch (ApiException $a) {
			CoreLogic::rollbackTransaction();
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return CoreLogic::GenerateResponse($res, $ob);
	}

	public static function Erase($request) {
		try {
			$Person = CoreLogic::VerifyPerson();
			CoreLogic::CheckCSRF($request->get("token"));

			$ob = new Event();
			$tmp = $request->get("data");

			$ob->id = $tmp["id"] ;

			$ob = EventLogic::Get($ob->id);

			CoreLogic::beginTransaction();
			$res = EventLogic::Erase($ob);
			CoreLogic::commitTransaction();
		} catch (ApiException $a) {
			CoreLogic::rollbackTransaction();
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return CoreLogic::GenerateResponse($res, $ob);
	}

	public static function Delete($request) {
		try {
			$Person = CoreLogic::VerifyPerson();
			CoreLogic::CheckCSRF($request->get("token"));

			$ob = new Event();
			$tmp = $request->get("data");

			$ob->id = $tmp["id"] ;

			$ob = EventLogic::Get($ob->id);

			CoreLogic::beginTransaction();
			$res = EventLogic::Delete($ob);
			CoreLogic::commitTransaction();
		} catch (ApiException $a) {
			CoreLogic::rollbackTransaction();
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return CoreLogic::GenerateResponse($res, $ob);
	}

	public static function Get($id) {
		try {
			$res = false;
			$Person = CoreLogic::VerifyPerson();
			$ob = EventLogic::Get($id);
			$res = true;
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return CoreLogic::GenerateResponse($res, $ob);
	}

	public static function GetList() {
		try {
			$Person = CoreLogic::VerifyPerson();
			$ob = EventLogic::GetList();
			$res = true;
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return CoreLogic::GenerateResponse($res, $ob);
	}

	public static function GetListFilterAjax($columnName) {
		try {
			$Person = CoreLogic::VerifyPerson();
			$results = array();
			$data = new stdClass();
		$codes = EventFactory::GetListFilter($columnName,$_GET['term']);
			foreach ($codes as $code){ 
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

	public static function GetListFKAjax($columnName) {
		try {
			$Person = CoreLogic::VerifyPerson();
			$results = array();
			$data = new stdClass();
			$foreignKey = end(EventFactory::GetForeignKeyParams($columnName));
			$codes = EventFactory::GetListFK($foreignKey->REFERENCED_TABLE_NAME,$foreignKey->REFERENCED_COLUMN_NAME,$_GET['term']);
			$data = new stdClass();
			foreach ($codes as $code){ 
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

	

	public static function GetListDatatable() {
		global $db_conn;
		try {
			$Person = CoreLogic::VerifyPerson();
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		$aColumns = array('`name`','`abs_path`','`datetime`','`is_processed`');
		$aColumnsName = array('name','abs_path','datetime','is_processed');
		$sIndexColumn = 'name';
		$sTable = 'pr_drv_event';
		$gaSql['link'] = $db_conn;;
		/*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
		 * no need to edit below this line
		 */
		/* Local functions */
		function fatal_error($sErrorMessage = '') {
			header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
			die($sErrorMessage);
		}
		/* Ordering */
		$sOrder = "ORDER BY datetime DESC";
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
				if(empty($iDisplayStart)){
					$iDisplayStart = 0;
				}
				if($iDisplayStart <=  $iDisplayLength){
					$pageNumber = 0;
				}else{
					$pageNumber = ($iDisplayStart / $iDisplayLength);
				}
			}
		}else{
			$pageNumber = null;
		}
		/*
		 * SQL queries
		 * Get data to display
		 */
		mysqli_query($gaSql['link'], 'SET CHARACTER SET utf8') or fatal_error('MySQL Error: ' . mysqli_errno($gaSql['link']));
		$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns)). "
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
		SELECT COUNT(". $sIndexColumn. ")
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
			$id = $aRow['name'];
			for ($i = 0; $i < count($aColumnsName); $i++) {
				if ($aColumnsName[$i] == 'name') {
					$row[] = $id;
				} else if ($aColumnsName[$i] != ' ') {
					/* General output */
					$row[] = stripslashes($aRow[$aColumnsName[$i]]);
				}
			}
			$output['aaData'][] = $row;
		}
		
		return $output;
	}

	public static function GetFilesListDatatable() {
		global $db_conn;
		try {
			$Person = CoreLogic::VerifyPerson();
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		$aColumns = array('`name`','`abs_path`','`datetime`', '`is_processed`');
		$aColumnsName = array('name','abs_path','datetime','is_processed');
		$sIndexColumn = 'name';
		$sTable = 'pr_drv_event';
		$gaSql['link'] = $db_conn;;
		/*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
		 * no need to edit below this line
		 */
		/* Local functions */
		function fatal_error($sErrorMessage = '') {
			header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
			die($sErrorMessage);
		}
		/* Ordering */
		$sOrder = "ORDER BY datetime DESC";
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
				if(empty($iDisplayStart)){
					$iDisplayStart = 0;
				}
				if($iDisplayStart <=  $iDisplayLength){
					$pageNumber = 0;
				}else{
					$pageNumber = ($iDisplayStart / $iDisplayLength);
				}
			}
		}else{
			$pageNumber = null;
		}
		$day_dir = $_GET['dayDir'];
		if($day_dir == ''){
			$sWhere = '';
		}else{
			$subquery = 'SELECT event_name FROM pr_drv_related WHERE node_code = "'.$day_dir.'"';
			$sWhere = 'WHERE name IN ('.$subquery.')';
		}
		
		

		/*
		 * SQL queries
		 * Get data to display
		 */
		mysqli_query($gaSql['link'], 'SET CHARACTER SET utf8') or fatal_error('MySQL Error: ' . mysqli_errno($gaSql['link']));
		$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns)). "
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
		SELECT COUNT(". $sIndexColumn. ")
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
			$id = $aRow['name'];
			for ($i = 0; $i < count($aColumnsName); $i++) {
				if ($aColumnsName[$i] == 'name') {
					$row[] = $id;
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
    public static function CreateZip($detection) {
        try {
            $Person = CoreLogic::VerifyPerson();
            $zip = self::processEventZip($detection);
        } catch (ApiException $a) {
            return CoreLogic::GenerateErrorResponse($a->message);
        }
        return CoreLogic::GenerateResponse(true, $zip);
    }

	// Create the zip of the passed folder and put it in /tmp-media/ in webroot
    public static function processEventZip($detection) {
		//Clear
		//self::clearFolder();

		//Setting up global variables
		global $elabIp, $elabUsr, $elabPsw;
		global $db_conn;

		//Setting up local variables (settings)
		$destination = _WEBROOTDIR_ . "tmp-media/".$detection;

		//Find path for this detection
		$sQuery = "SELECT abs_path FROM pr_drv_event WHERE name = '".$detection."'";
		$rResultFTotal = mysqli_query($db_conn, $sQuery);
		$aResultFilterTotal = mysqli_fetch_array($rResultFTotal);
		$pathDown = $aResultFilterTotal[0];

		//Establish ssh connection
		$connection = ssh2_connect($elabIp, 22);
		if (!$connection) die('Connection failed');
		ssh2_auth_password($connection, $elabUsr, $elabPsw);
		$sftp = ssh2_sftp($connection);
		
		//Create folder if not exists
		if(!file_exists($destination)){
			mkdir($destination, 0777);
		}

		//Download files from elab
		$folders = scandir('ssh2.sftp://' . $sftp . $pathDown);
		if (!empty($folders)) {
		foreach ($folders as $folder) {
			if ($folder != '.' && $folder != '..') {

				//Create subfolders if not exists
				$new_dest = $destination.'/'.$folder;
				if(!file_exists($new_dest)){
					mkdir($new_dest, 0777);
				}

				$files = scandir('ssh2.sftp://' . $sftp . $pathDown.'/'.$folder);
				if (!empty($files)) {
				foreach ($files as $file) {
					if ($file != '.' && $file != '..') {
						ssh2_scp_recv($connection, "$pathDown/$folder/$file", "$destination/$folder/$file");
					}
				}
				}
			}
		}
		}

		//Zip creation
		$command1 = "cd "._WEBROOTDIR_."tmp-media";
		//$zipDestination = $destination.'.zip';
		//$zipExec = "zip -r -D $zipDestination $destination";
		$command2 = "zip -r $detection.zip $detection";
		$zipExec = $command1.' ; '.$command2;
		$result = shell_exec($zipExec);

		//Connection closing
		unset($sftp);
		ssh2_disconnect($connection);

		//Return file name
		return $detection.'.zip';
    }

	//return zip file position
	public static function GetZip($zip) {
		return _WEBROOTDIR_ . "tmp-media/" . $zip.".zip";
	}

}

