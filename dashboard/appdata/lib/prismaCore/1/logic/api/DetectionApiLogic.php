<?php
/**
*
* @author: N3 S.r.l.
*/

class DetectionApiLogic
{
	public static function Save($request) {
		try {

			$Person = CoreLogic::VerifyPerson();
			CoreLogic::CheckCSRF($request->get("token"));

			$ob = new Detection();

			CoreLogic::getFromArray($ob, $request->get("data"));
			CoreLogic::beginTransaction();
			$res = DetectionLogic::Save($ob);
			if(!$res)
				throw new ApiException(ApiException::$Generic);
			CoreLogic::commitTransaction();
		} catch (ApiException $a) {
			CoreLogic::rollbackTransaction();
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return CoreLogic::GenerateResponse($res, $ob);
	}

	public static function Update($request) {

		try {
			$Person = CoreLogic::VerifyPerson();
			CoreLogic::CheckCSRF($request->get("token"));

			$ob = new Detection();
			$tmp = $request->get("data");

			$ob->id = $tmp["id"] ;

			$ob = DetectionLogic::Get($ob->id);

			CoreLogic::getFromArray($ob, $request->get("data"));

			CoreLogic::beginTransaction();
			$res = DetectionLogic::Update($ob);
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

			$ob = new Detection();
			$tmp = $request->get("data");

			$ob->id = $tmp["id"] ;

			$ob = DetectionLogic::Get($ob->id);

			CoreLogic::beginTransaction();
			$res = DetectionLogic::Erase($ob);
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

			$ob = new Detection();
			$tmp = $request->get("data");

			$ob->id = $tmp["id"] ;

			$ob = DetectionLogic::Get($ob->id);

			CoreLogic::beginTransaction();
			$res = DetectionLogic::Delete($ob);
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
			$ob = DetectionLogic::Get($id);
                        
                        $SystemConfiguration = SystemConfigurationLogic::GetList();
                        $Node    = NodeLogic::Get($ob->node_id);
                        $Station = StationLogic::Get($Node->station_id);

                        $relative_path = $SystemConfiguration[0]->parameter_value."/".$Station->code."/".$Node->relative_path."_".date("Ymd",$ob->detected_timestamp)."/events/";
                        $event_name = $Node->relative_path."_".date("Ymd",$ob->detected_timestamp)."T".date("His",$ob->detected_timestamp)."_UT";
                        $event_path = $relative_path.$event_name."/";
                        
                        $ob->event_path = $event_path;
                        
                        
                        $not_found = "data:image/png;base64,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";
                        
                        $GeMap_imgbinary = fread(fopen($event_path."GeMap.bmp", "r"), filesize($event_path."GeMap.bmp"));
                        if (!empty($GeMap_imgbinary))
                            $GeMap_64 =  'data:image/bmp;base64,' . base64_encode($GeMap_imgbinary);
                        else 
                            $GeMap_64 = $not_found;
                        
                        $DirMap_imgbinary = fread(fopen($event_path."DirMap.bmp", "r"), filesize($event_path."DirMap.bmp"));
                        
                        if (!empty($DirMap_imgbinary))
                           $DirMap_64 =  'data:image/bmp;base64,' . base64_encode($DirMap_imgbinary);
                        else 
                           $DirMap_64 = $not_found;
                        
                        $Event_imgbinary = fread(fopen($event_path.$event_name.".jpg", "r"), filesize($event_path.$event_name.".jpg"));
                        
                        if (!empty($Event_imgbinary))
                            $Event_64 =  'data:image/jpg;base64,' . base64_encode($Event_imgbinary);
                        else
                            $Event_64 =  $not_found;
                        
                        $ob->GeMapImg = $GeMap_64;
                        $ob->DirMapImg = $DirMap_64;
                        $ob->EventImg = $Event_64;
                         
			$res = true;
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		return CoreLogic::GenerateResponse($res, $ob);
	}

	public static function GetList() {
		try {
			$Person = CoreLogic::VerifyPerson();
			$ob = DetectionLogic::GetList();
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
		$codes = DetectionFactory::GetListFilter($columnName,$_GET['term']);
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
			$foreignKey = current(DetectionFactory::GetForeignKeyParams($columnName));// il metodo end() che restituiva l'ultimo elemneto dell'array 
                                                                           //e supportava come parametro solamente una variabile 
                                                                           //l'ho cambiato con il metodo current() che punta all'elemento corrente dell'array 
                                                                         // e come paramentro non ha il vincolo delle variabile 
			$codes = DetectionFactory::GetListFK($foreignKey->REFERENCED_TABLE_NAME,$foreignKey->REFERENCED_COLUMN_NAME,$_GET['term']);
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

	public static function GetDaysListDatatable() {
		global $db_conn;
		try {
			$Person = CoreLogic::VerifyPerson();
		} catch (ApiException $a) {
			return CoreLogic::GenerateErrorResponse($a->message);
		}
		$aColumns = array('`code`','`region_id`','`nickname`');
		$aColumnsName = array('code','region_id','nickname');
		$sIndexColumn = 'id';
		$sTable = 'pr_node';
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
		$sOrder = "ORDER BY code ASC";
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
		$sWhere = '';
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
			$id = $aRow['id'];

			$region = RegionFactory::GetRegionName($aRow['region_id']);
			for ($i = 0; $i < count($aColumnsName); $i++) {
				if ($aColumnsName[$i] == 'id') {
					$row[] = $id;
				} else if ($aColumnsName[$i] == 'region_id') {
					$row[] = $region->text;
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
		$aColumns = array('`name`','`node_code`','`datetime`');
		$aColumnsName = array('name','node_code','datetime');
		$sIndexColumn = 'name';
		$sTable = 'pr_drv_detection';
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
			$sWhere = 'WHERE `node_code` = ';
			$sWhere .= '"';
			$sWhere .= $day_dir;
			$sWhere .= '"';
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

	//return zip file position
	public static function GetZip($zip) {
		return _WEBROOTDIR_ . "tmp-media/" . $zip.".zip";
	}

	//return video file position
	public static function GetVideo($zip) {
		return _WEBROOTDIR_ . "tmp-media/" .$zip.'/'."video.avi";
	}

	// Create zip of detection
    public static function CreateZip($detection) {
        try {
            $Person = CoreLogic::VerifyPerson();
            $zip = self::processDetectionZip($detection);
        } catch (ApiException $a) {
            return CoreLogic::GenerateErrorResponse($a->message);
        }
        return CoreLogic::GenerateResponse(true, $zip);
    }

	// Create video of detection
    public static function CreateVideo($detection) {
        try {
            $Person = CoreLogic::VerifyPerson();
            $zip = self::processDetectionVideo($detection);
        } catch (ApiException $a) {
            return CoreLogic::GenerateErrorResponse($a->message);
        }
        return CoreLogic::GenerateResponse(true, $zip);
    }

	//Empty the tmp-media folder
	public static function clearFolder(){
		$result = shell_exec('rm -r '._WEBROOTDIR_.'tmp-media/*');
		return '';
	}

	// Create the zip of the passed folder and put it in /tmp-media/ in webroot
    public static function processDetectionZip($detection) {
		//Clear
		self::clearFolder();

		//Setting up global variables
		global $elabIp, $elabUsr, $elabPsw;
		global $db_conn;

		//Setting up local variables (settings)
		$destination = _WEBROOTDIR_ . "tmp-media/".$detection;

		//Find path for this detection
		$sQuery = "SELECT abs_path FROM pr_drv_detection WHERE name = '".$detection."'";
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
		$files = scandir('ssh2.sftp://' . $sftp . $pathDown);
		if (!empty($files)) {
		foreach ($files as $file) {
			if ($file != '.' && $file != '..') {
			ssh2_scp_recv($connection, "$pathDown/$file", "$destination/$file");
			}
		}
		}

		//Zip creation
		$zipDestination = $destination.'.zip';
		$zipExec = "zip -r -j $zipDestination $destination";
		$result = shell_exec($zipExec);

		//Connection closing
		unset($sftp);
		ssh2_disconnect($connection);

		//Return file name
		return $detection.'.zip';
    }

	// Create the video of the passed folder and put it in /tmp-media/ in webroot
    public static function processDetectionVideo($detection) {
		//Clear
		self::clearFolder();

		//Setting up global variables
		global $elabIp, $elabUsr, $elabPsw;
		global $db_conn;

		//Setting up local variables (settings)
		$destination = _WEBROOTDIR_ . "tmp-media/".$detection;

		//Find path for this detection
		$sQuery = "SELECT abs_path FROM pr_drv_detection WHERE name = '".$detection."'";
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
		$files = scandir('ssh2.sftp://' . $sftp . $pathDown);
		if (!empty($files)) {
		foreach ($files as $file) {
			if ($file != '.' && $file != '..') {
			ssh2_scp_recv($connection, "$pathDown/$file", "$destination/$file");
			}
		}
		}

		//Connection closing
		unset($sftp);
		ssh2_disconnect($connection);

		//Return file name
		return $detection;
    }
}

