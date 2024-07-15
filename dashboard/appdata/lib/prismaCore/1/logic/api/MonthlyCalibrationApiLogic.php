<?php

use MonthlyCalibration as GlobalMonthlyCalibration;

/**
 *
 * @author: N3 S.r.l.
 */

class MonthlyCalibrationApiLogic
{
    // public static function Save($request)
    // {
    //     try {

    //         $Person = CoreLogic::VerifyPerson();
    //         CoreLogic::CheckCSRF($request->get("token"));

    //         $ob = new MonthlyCalibration();

    //         CoreLogic::getFromArray($ob, $request->get("data"));
    //         CoreLogic::beginTransaction();
    //         $res = NodeLogic::Save($ob);
    //         if (!$res)
    //             throw new ApiException(ApiException::$Generic);
    //         CoreLogic::commitTransaction();
    //     } catch (ApiException $a) {
    //         CoreLogic::rollbackTransaction();
    //         return CoreLogic::GenerateErrorResponse($a->message);
    //     }
    //     return CoreLogic::GenerateResponse($res, $ob);
    // }

    // public static function Update($request)
    // {

    //     try {
    //         $Person = CoreLogic::VerifyPerson();
    //         CoreLogic::CheckCSRF($request->get("token"));

    //         $ob = new MonthlyCalibration();
    //         $tmp = $request->get("data");

    //         $ob->id = $tmp["id"];

    //         $ob = MonthlyCalibrationLogic::Get($ob->id);

    //         CoreLogic::getFromArray($ob, $request->get("data"));

    //         CoreLogic::beginTransaction();
    //         $res = MonthlyCalibrationLogic::Update($ob);
    //         CoreLogic::commitTransaction();
    //     } catch (ApiException $a) {
    //         CoreLogic::rollbackTransaction();
    //         return CoreLogic::GenerateErrorResponse($a->message);
    //     }
    //     return CoreLogic::GenerateResponse($res, $ob);
    // }


    // public static function Erase($request)
    // {
    //     try {
    //         $Person = CoreLogic::VerifyPerson();
    //         CoreLogic::CheckCSRF($request->get("token"));

    //         $ob = new MonthlyCalibration();
    //         $tmp = $request->get("data");

    //         $ob->id = $tmp["id"];

    //         $ob = MonthlyCalibrationLogic::Get($ob->id);

    //         CoreLogic::beginTransaction();
    //         $res = MonthlyCalibrationLogic::Erase($ob);
    //         CoreLogic::commitTransaction();
    //     } catch (ApiException $a) {
    //         CoreLogic::rollbackTransaction();
    //         return CoreLogic::GenerateErrorResponse($a->message);
    //     }
    //     return CoreLogic::GenerateResponse($res, $ob);
    // }

    // public static function Delete($request)
    // {
    //     try {
    //         $Person = CoreLogic::VerifyPerson();
    //         CoreLogic::CheckCSRF($request->get("token"));

    //         $ob = new MonthlyCalibration();
    //         $tmp = $request->get("data");

    //         $ob->id = $tmp["id"];

    //         $ob = MonthlyCalibrationLogic::Get($ob->id);

    //         CoreLogic::beginTransaction();
    //         $res = MonthlyCalibrationLogic::Delete($ob);
    //         CoreLogic::commitTransaction();
    //     } catch (ApiException $a) {
    //         CoreLogic::rollbackTransaction();
    //         return CoreLogic::GenerateErrorResponse($a->message);
    //     }
    //     return CoreLogic::GenerateResponse($res, $ob);
    // }


    // public static function Get($id)
    // {
    //     try {
    //         $res = false;
    //         $Person = CoreLogic::VerifyPerson();
    //         $ob = MonthlyCalibrationLogic::Get($id);
    //         $res = true;
    //     } catch (ApiException $a) {
    //         return CoreLogic::GenerateErrorResponse($a->message);
    //     }
    //     return CoreLogic::GenerateResponse($res, $ob);
    // }

    // public static function GetList()
    // {
    //     try {
    //         $Person = CoreLogic::VerifyPerson();
    //         $ob = MonthlyCalibrationLogic::GetList();
    //         $res = true;
    //     } catch (ApiException $a) {
    //         return CoreLogic::GenerateErrorResponse($a->message);
    //     }
    //     return CoreLogic::GenerateResponse($res, $ob);
    // }

    // public static function GetListFilterAjax($columnName)
    // {
    //     try {
    //         $Person = CoreLogic::VerifyPerson();
    //         $results = array();
    //         $data = new stdClass();
    //         $codes = MonthlyCalibrationLogic::GetListFilter($columnName, $_GET['term']);
    //         foreach ($codes as $code) {
    //             $obj = new stdClass();
    //             $obj->id = $code->{$columnName};
    //             $obj->text = $code->{$columnName};
    //             $results[] = $obj;
    //         }
    //         $data->results = $results;
    //     } catch (ApiException $a) {
    //         return CoreLogic::GenerateErrorResponse($a->message);
    //     }
    //     return $data;
    // }

    // public static function GetListFKAjax($columnName)
    // {
    //     try {
    //         $Person = CoreLogic::VerifyPerson();
    //         $results = array();
    //         $data = new stdClass();
    //         $foreignKey = end(MonthlyCalibrationLogic::GetForeignKeyParams($columnName));
    //         $codes = MonthlyCalibrationLogic::GetListFK($foreignKey->REFERENCED_TABLE_NAME, $foreignKey->REFERENCED_COLUMN_NAME, $_GET['term']);
    //         $data = new stdClass();
    //         foreach ($codes as $code) {
    //             $obj = new stdClass();
    //             $obj->id = $code->{$foreignKey->REFERENCED_COLUMN_NAME};
    //             $obj->text = $code->{$foreignKey->REFERENCED_COLUMN_NAME};
    //             $results[] = $obj;
    //         }
    //         $data->results = $results;
    //     } catch (ApiException $a) {
    //         return CoreLogic::GenerateErrorResponse($a->message);
    //     }
    //     return $data;
    // }

    public static function SetDefaultCalibration($request)
    {
        try {
            $Person = CoreLogic::VerifyPerson();
            CoreLogic::CheckCSRF($request->get("token"));

            $ob = new MonthlyCalibration();
            $tmp = $request->get("data");

            $ob->name = $tmp["name"];

            $ob = MonthlyCalibrationLogic::Get($ob->name);

            CoreLogic::beginTransaction();
            $res = MonthlyCalibrationLogic::SetDefaultCalibration($ob);
            CoreLogic::commitTransaction();
        } catch (ApiException $a) {
            CoreLogic::rollbackTransaction();
            return CoreLogic::GenerateErrorResponse($a->message);
        }
        return CoreLogic::GenerateResponse($res, $ob);
    }



    public static function GetMonthlyCalibrationListDatatable()
    {
        global $db_conn;
        try {
            $Person = CoreLogic::VerifyPerson();
        } catch (ApiException $a) {
            return CoreLogic::GenerateErrorResponse($a->message);
        }
        $aColumns = array('`name`', "DATE_FORMAT(datetime, '%Y-%m')", '`report_count`', '`is_default`', '`id`');
        $aColumnsName = array('name', "DATE_FORMAT(datetime, '%Y-%m')", 'report_count', 'is_default', 'id');
        $sIndexColumn = 'name';
        $sTable = 'pr_drv_monthly_calibration';
        $gaSql['link'] = $db_conn;;
        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
		 * no need to edit below this line
		 */
        /* Local functions */
        // function fatal_error($sErrorMessage = '')
        // {
        // 	header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
        // 	die($sErrorMessage);
        // }

        $sWhere = '';
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
        // $is_month = $_GET['month'];

        // if ($day_dir == '' and $is_month != '1') {
        // 	$sWhere = '';
        // }

        // if ($day_dir == '' and $is_month == '1') {
        // 	$sWhere = 'WHERE is_month="' . $is_month . '"';
        // }

        if ($day_dir != '') {
            $sWhere = 'WHERE node_code = "' . $day_dir . '"';
        }

        // if ($day_dir != '' and $is_month == '1') {
        // 	$sWhere = 'WHERE node_code = "' . $day_dir . '" AND is_month="' . $is_month . '"';
        // }


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
            for ($i = 0; $i < count($aColumnsName); $i++) {
                if ($aColumnsName[$i] == 'id') {
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
}
