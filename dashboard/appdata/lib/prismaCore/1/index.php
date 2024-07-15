<?php

/**
 *
 * @author: N3 S.r.l.
 */

require_once __DIR__ . '/autoload.php';
require_once _EXTLIB_ . 'sylex/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

$app = new Silex\Application();

$app->before(function (Request $request) {
	if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
		$data = json_decode($request->getContent(), true);
		$request->request->replace(is_array($data) ? $data : array());
	}
});

/************************************************************

CONTACTS

 ************************************************************/
/**
 *
 * GET CONTACTS DATATABLE
 *
 * */
$app->GET('/contact/datatable/list', function(Application $app, Request $request) {

    $result = ContactApiLogic::GetListContactDatatable();
    $resp = new Response(json_encode($result));
    $resp->setStatusCode(200);
    return $resp;
});
/**
 *
 * INSERT
 *
 **/

 $app->POST('/contact', function (Application $app, Request $request) {
	$result = ContactApiLogic::Save($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

$app->POST('/contact', function (Application $app, Request $request) {
	$result = ContactApiLogic::Save($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

$app->GET('/contact/{contactId}', function (Application $app, Request $request, $contactId) {
	
	$result = ContactApiLogic::Get($contactId);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * UPDATE
 *
 **/

 $app->PUT('/contact', function (Application $app, Request $request) {

	$result = ContactApiLogic::Update($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * DELETE
 *
 **/

 $app->PATCH('/contact', function (Application $app, Request $request) {

	$result = ContactApiLogic::Delete($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});
/************************************************************

CALIBRATIONEXECUTIONHISTORY

 ************************************************************/

/**
 *
 * INSERT
 *
 **/

$app->POST('/calibrationexecutionhistory', function (Application $app, Request $request) {

	$result = CalibrationExecutionHistoryApiLogic::Save($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * UPDATE
 *
 **/

$app->PUT('/calibrationexecutionhistory', function (Application $app, Request $request) {

	$result = CalibrationExecutionHistoryApiLogic::Update($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * DELETE
 *
 **/

$app->DELETE('/calibrationexecutionhistory', function (Application $app, Request $request) {

	$result = CalibrationExecutionHistoryApiLogic::Delete($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * ERASED
 *
 **/

$app->PATCH('/calibrationexecutionhistory', function (Application $app, Request $request) {

	$result = CalibrationExecutionHistoryApiLogic::Erase($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET
 *
 **/

$app->GET('/calibrationexecutionhistory/{calibrationexecutionhistoryId}', function (Application $app, Request $request, $calibrationexecutionhistoryId) {

	$result = CalibrationExecutionHistoryApiLogic::Get($calibrationexecutionhistoryId);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET LIST
 *
 **/

$app->GET('/calibrationexecutionhistory', function (Application $app, Request $request) {

	$result = CalibrationExecutionHistoryApiLogic::GetList();
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET DATATABLE
 *
 **/

$app->GET('/calibrationexecutionhistory/datatable/list', function (Application $app, Request $request) {

	$result = CalibrationExecutionHistoryApiLogic::GetListDatatable();
	$resp = new Response(json_encode($result));
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET AUTOCOMPLETE
 *
 **/

$app->GET('/calibrationexecutionhistory/autocomplete/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = CalibrationExecutionHistoryApiLogic::GetListFilterAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET FOREIGN KEY
 *
 **/

$app->GET('/calibrationexecutionhistory/foreignkey/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = CalibrationExecutionHistoryApiLogic::GetListFKAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET DATATABLE FILES
 *
 * */
$app->GET('/calibrationexecutionhistory/datatable/filelist', function (Application $app, Request $request) {

	$result = CalibrationExecutionHistoryApiLogic::GetFilesListDatatable($request);
	$encode = json_encode($result);
	$resp = new Response($encode);
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * CREATE ZIP
 *
 * */
$app->POST('/calibrationexecutionhistory/createzip/{detection}', function (Application $app, Request $request, $detection) {

	//session_write_close();
	$detection = explode(":", $detection)[0] . "." . explode(":", $detection)[1];
	$result = CalibrationExecutionHistoryApiLogic::CreateZip($detection);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET ZIP
 *
 * */
$app->GET('/calibrationexecutionhistory/download/{detection}', function (Application $app, Request $request, $detection) {

	$detection = explode(":", $detection)[0] . "." . explode(":", $detection)[1];
	$result = CalibrationExecutionHistoryApiLogic::GetZip($detection);
	$resp = new BinaryFileResponse($result);
	$resp->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT);
	$resp->setStatusCode(200);
	return $resp;
});

/**
 * TEMP
 * 
 * 
 */

/**
 * 
 * GET MONTHLY CALIBRATION FILES
 * 
 */
$app->GET('/monthlycalibration/calibrationfiles/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = CalibrationExecutionHistoryApiLogic::GetFileList($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(404);
	}
	return $resp;
});



/************************************************************

MONTHLY CALIBRATION

 ************************************************************/

/**
 * 
 * GET DATATABLE
 * 
 */
$app->GET('/monthlycalibration/datatable/monthlycalibration', function (Application $app, Request $request) {

	$result = MonthlyCalibrationApiLogic::GetMonthlyCalibrationListDatatable();
	$resp = new Response(json_encode($result));
	$resp->setStatusCode(200);
	return $resp;
});

/**
 * 
 * SET DEFAULT CALIBRATION
 * 
 */
$app->PATCH('/monthlycalibration/defaultcalibration/set', function (Application $app, Request $request) {

	$result = MonthlyCalibrationApiLogic::SetDefaultCalibration($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/************************************************************

CAMERA

 ************************************************************/

/**
 *
 * INSERT
 *
 **/

$app->POST('/camera', function (Application $app, Request $request) {

	$result = CameraApiLogic::Save($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * UPDATE
 *
 **/

$app->PUT('/camera', function (Application $app, Request $request) {

	$result = CameraApiLogic::Update($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * DELETE
 *
 **/

$app->DELETE('/camera', function (Application $app, Request $request) {

	$result = CameraApiLogic::Delete($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * ERASED
 *
 **/

$app->PATCH('/camera', function (Application $app, Request $request) {

	$result = CameraApiLogic::Erase($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET
 *
 **/

$app->GET('/camera/{cameraId}', function (Application $app, Request $request, $cameraId) {

	$result = CameraApiLogic::Get($cameraId);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET LIST
 *
 **/

$app->GET('/camera', function (Application $app, Request $request) {

	$result = CameraApiLogic::GetList();
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET DATATABLE
 *
 **/

$app->GET('/camera/datatable/list', function (Application $app, Request $request) {

	$result = CameraApiLogic::GetListDatatable();
	$resp = new Response(json_encode($result));
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET AUTOCOMPLETE
 *
 **/

$app->GET('/camera/autocomplete/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = CameraApiLogic::GetListFilterAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET FOREIGN KEY
 *
 **/

$app->GET('/camera/foreignkey/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = CameraApiLogic::GetListFKAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/************************************************************

CONFIGPARAMETERS

 ************************************************************/

/**
 *
 * INSERT
 *
 **/

$app->POST('/configparameters', function (Application $app, Request $request) {

	$result = ConfigParametersApiLogic::Save($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * UPDATE
 *
 **/

$app->PUT('/configparameters', function (Application $app, Request $request) {

	$result = ConfigParametersApiLogic::Update($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * DELETE
 *
 **/

$app->DELETE('/configparameters', function (Application $app, Request $request) {

	$result = ConfigParametersApiLogic::Delete($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * ERASED
 *
 **/

$app->PATCH('/configparameters', function (Application $app, Request $request) {

	$result = ConfigParametersApiLogic::Erase($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET
 *
 **/

$app->GET('/configparameters/{configparametersId}', function (Application $app, Request $request, $configparametersId) {

	$result = ConfigParametersApiLogic::Get($configparametersId);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET LIST
 *
 **/

$app->GET('/configparameters', function (Application $app, Request $request) {

	$result = ConfigParametersApiLogic::GetList();
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET DATATABLE
 *
 **/

$app->GET('/configparameters/datatable/list', function (Application $app, Request $request) {

	$result = ConfigParametersApiLogic::GetListDatatable();
	$resp = new Response(json_encode($result));
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET AUTOCOMPLETE
 *
 **/

$app->GET('/configparameters/autocomplete/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = ConfigParametersApiLogic::GetListFilterAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET FOREIGN KEY
 *
 **/

$app->GET('/configparameters/foreignkey/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = ConfigParametersApiLogic::GetListFKAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/************************************************************

COREPERSON

 ************************************************************/

// /**
// *
// * INSERT
// *
// **/

// $app->POST('/coreperson', function(Application $app, Request $request) {

// 	$result = CorePersonApiLogic::Save($request->request);
// 	if ($result->result) {
// 		$resp = new Response(json_encode($result));
// 		$resp->setStatusCode(200);
// 	} else {
// 		$resp = new Response(json_encode($result));
// 		$resp->setStatusCode(403);
// 	}
// 	return $resp;
// });

// /**
// *
// * UPDATE
// *
// **/

// $app->PUT('/coreperson', function(Application $app, Request $request) {

// 	$result = CorePersonApiLogic::Update($request->request);
// 	if ($result->result) {
// 		$resp = new Response(json_encode($result));
// 		$resp->setStatusCode(200);
// 	} else {
// 		$resp = new Response(json_encode($result));
// 		$resp->setStatusCode(403);
// 	}
// 	return $resp;
// });

// /**
// *
// * DELETE
// *
// **/

// $app->DELETE('/coreperson', function(Application $app, Request $request) {

// 	$result = CorePersonApiLogic::Delete($request->request);
// 	if ($result->result) {
// 		$resp = new Response(json_encode($result));
// 		$resp->setStatusCode(200);
// 	} else {
// 		$resp = new Response(json_encode($result));
// 		$resp->setStatusCode(403);
// 	}
// 	return $resp;
// });

// /**
// *
// * ERASED
// *
// **/

// $app->PATCH('/coreperson', function(Application $app, Request $request) {

// 	$result = CorePersonApiLogic::Erase($request->request);
// 	if ($result->result) {
// 		$resp = new Response(json_encode($result));
// 		$resp->setStatusCode(200);
// 	} else {
// 		$resp = new Response(json_encode($result));
// 		$resp->setStatusCode(403);
// 	}
// 	return $resp;
// });

// /**
// *
// * GET
// *
// **/

// $app->GET('/coreperson/{corepersonId}', function(Application $app, Request $request, $corepersonId) {

// 	$result = CorePersonApiLogic::Get($corepersonId);
// 	if ($result->result) {
// 		$resp = new Response(json_encode($result));
// 		$resp->setStatusCode(200);
// 	} else {
// 		$resp = new Response(json_encode($result));
// 		$resp->setStatusCode(403);
// 	}
// 	return $resp;
// });

// /**
// *
// * GET LIST
// *
// **/

// $app->GET('/coreperson', function(Application $app, Request $request) {

// 	$result = CorePersonApiLogic::GetList();
// 	if ($result->result) {
// 		$resp = new Response(json_encode($result));
// 		$resp->setStatusCode(200);
// 	} else {
// 		$resp = new Response(json_encode($result));
// 		$resp->setStatusCode(403);
// 	}
// 	return $resp;
// });

// /**
// *
// * GET DATATABLE
// *
// **/

// $app->GET('/coreperson/datatable/list', function(Application $app, Request $request) {

// 	$result = CorePersonApiLogic::GetListDatatable();
// 		$resp = new Response(json_encode($result));
// 		$resp->setStatusCode(200);
// 	return $resp;
// });

// /**
// *
// * GET AUTOCOMPLETE
// *
// **/

// $app->GET('/coreperson/autocomplete/{companyColumn}', function(Application $app, Request $request, $companyColumn) {

// 	$result = CorePersonApiLogic::GetListFilterAjax($companyColumn);
// 	if ($result->results) {
// 		$resp = new Response(json_encode($result));
// 		$resp->setStatusCode(200);
// 	} else {
// 		$resp = new Response(json_encode($result));
// 		$resp->setStatusCode(403);
// 	}
// 	return $resp;
// });

// /**
// *
// * GET FOREIGN KEY
// *
// **/

// $app->GET('/coreperson/foreignkey/{companyColumn}', function(Application $app, Request $request, $companyColumn) {

// 	$result = CorePersonApiLogic::GetListFKAjax($companyColumn);
// 	if ($result->results) {
// 		$resp = new Response(json_encode($result));
// 		$resp->setStatusCode(200);
// 	} else {
// 		$resp = new Response(json_encode($result));
// 		$resp->setStatusCode(403);
// 	}
// 	return $resp;
// });

/************************************************************

DETECTION

 ************************************************************/

/**
 *
 * INSERT
 *
 **/

$app->POST('/detection', function (Application $app, Request $request) {

	$result = DetectionApiLogic::Save($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * UPDATE
 *
 **/

$app->PUT('/detection', function (Application $app, Request $request) {

	$result = DetectionApiLogic::Update($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * DELETE
 *
 **/

$app->DELETE('/detection', function (Application $app, Request $request) {

	$result = DetectionApiLogic::Delete($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * ERASED
 *
 **/

$app->PATCH('/detection', function (Application $app, Request $request) {

	$result = DetectionApiLogic::Erase($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET
 *
 **/

$app->GET('/detection/{detectionId}', function (Application $app, Request $request, $detectionId) {

	$result = DetectionApiLogic::Get($detectionId);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET LIST
 *
 **/

$app->GET('/detection', function (Application $app, Request $request) {

	$result = DetectionApiLogic::GetList();
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET DATATABLE
 *
 **/

$app->GET('/detection/datatable/list', function (Application $app, Request $request) {

	$result = DetectionApiLogic::GetListDatatable();
	$resp = new Response(json_encode($result));
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET DATATABLE DAYS
 *
 * */
$app->GET('/detection/datatable/daylist', function (Application $app, Request $request) {

	$result = DetectionApiLogic::GetDaysListDatatable($request);
	$encode = json_encode($result);
	$resp = new Response($encode);
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET DATATABLE FILES
 *
 * */
$app->GET('/detection/datatable/filelist', function (Application $app, Request $request) {

	$result = DetectionApiLogic::GetFilesListDatatable($request);
	$encode = json_encode($result);
	$resp = new Response($encode);
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * CREATE ZIP
 *
 * */
$app->POST('/detection/createzip/{detection}', function (Application $app, Request $request, $detection) {

	session_write_close();
	$result = DetectionApiLogic::CreateZip($detection);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * CREATE VIDEO
 *
 * */
$app->POST('/detection/createvideo/{detection}', function (Application $app, Request $request, $detection) {

	session_write_close();
	$result = DetectionApiLogic::CreateVideo($detection);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET ZIP
 *
 * */
$app->GET('/detection/download/{detection}', function (Application $app, Request $request, $detection) {

	$result = DetectionApiLogic::GetZip($detection);
	$resp = new BinaryFileResponse($result);
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET VIDEO
 *
 * */
$app->GET('/detection/downloadvideo/{detection}', function (Application $app, Request $request, $detection) {

	$result = DetectionApiLogic::GetVideo($detection);
	$resp = new BinaryFileResponse($result);
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET AUTOCOMPLETE
 *
 **/

$app->GET('/detection/autocomplete/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = DetectionApiLogic::GetListFilterAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET FOREIGN KEY
 *
 **/

$app->GET('/detection/foreignkey/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = DetectionApiLogic::GetListFKAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});


/************************************************************

EMAILALERT

 ************************************************************/

/**
 *
 * INSERT
 *
 **/

$app->POST('/emailalert', function (Application $app, Request $request) {

	$result = EmailAlertApiLogic::Save($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * UPDATE
 *
 **/

$app->PUT('/emailalert', function (Application $app, Request $request) {

	$result = EmailAlertApiLogic::Update($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * DELETE
 *
 **/

$app->DELETE('/emailalert', function (Application $app, Request $request) {

	$result = EmailAlertApiLogic::Delete($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * ERASED
 *
 **/

$app->PATCH('/emailalert', function (Application $app, Request $request) {

	$result = EmailAlertApiLogic::Erase($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET
 *
 **/

$app->GET('/emailalert/{emailalertId}', function (Application $app, Request $request, $emailalertId) {

	$result = EmailAlertApiLogic::Get($emailalertId);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET LIST
 *
 **/

$app->GET('/emailalert', function (Application $app, Request $request) {

	$result = EmailAlertApiLogic::GetList();
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET DATATABLE
 *
 **/

$app->GET('/emailalert/datatable/list', function (Application $app, Request $request) {

	$result = EmailAlertApiLogic::GetListDatatable();
	$resp = new Response(json_encode($result));
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET AUTOCOMPLETE
 *
 **/

$app->GET('/emailalert/autocomplete/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = EmailAlertApiLogic::GetListFilterAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET FOREIGN KEY
 *
 **/

$app->GET('/emailalert/foreignkey/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = EmailAlertApiLogic::GetListFKAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/************************************************************

EVENT

 ************************************************************/

/**
 *
 * INSERT
 *
 **/

$app->POST('/event', function (Application $app, Request $request) {

	$result = EventApiLogic::Save($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * UPDATE
 *
 **/

$app->PUT('/event', function (Application $app, Request $request) {

	$result = EventApiLogic::Update($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * DELETE
 *
 **/

$app->DELETE('/event', function (Application $app, Request $request) {

	$result = EventApiLogic::Delete($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * ERASED
 *
 **/

$app->PATCH('/event', function (Application $app, Request $request) {

	$result = EventApiLogic::Erase($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET
 *
 **/

$app->GET('/event/{eventId}', function (Application $app, Request $request, $eventId) {

	echo "<script type='text/javascript'>alert('AAAA');</script>";
	$result = EventApiLogic::Get($eventId);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET LIST
 *
 **/

$app->GET('/event', function (Application $app, Request $request) {


	$result = EventApiLogic::GetList();
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET DATATABLE FILES
 *
 * */
$app->GET('/event/datatable/filelist', function (Application $app, Request $request) {

	$result = EventApiLogic::GetFilesListDatatable($request);
	$encode = json_encode($result);
	$resp = new Response($encode);
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET DATATABLE
 *
 **/

$app->GET('/event/datatable/list', function (Application $app, Request $request) {

	$result = EventApiLogic::GetListDatatable();
	$resp = new Response(json_encode($result));
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET AUTOCOMPLETE
 *
 **/

$app->GET('/event/autocomplete/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = EventApiLogic::GetListFilterAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET FOREIGN KEY
 *
 **/

$app->GET('/event/foreignkey/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = EventApiLogic::GetListFKAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * CREATE ZIP
 *
 * */
$app->POST('/event/createzip/{detection}', function (Application $app, Request $request, $detection) {

	session_write_close();
	$result = EventApiLogic::CreateZip($detection);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET ZIP
 *
 * */
$app->GET('/event/download/{detection}', function (Application $app, Request $request, $detection) {

	$result = EventApiLogic::GetZip($detection);
	$resp = new BinaryFileResponse($result);
	$resp->setStatusCode(200);
	return $resp;
});

/************************************************************

EVENTEXECUTIONHISTORY

 ************************************************************/

/**
 *
 * INSERT
 *
 **/

$app->POST('/eventexecutionhistory', function (Application $app, Request $request) {

	$result = EventExecutionHistoryApiLogic::Save($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * UPDATE
 *
 **/

$app->PUT('/eventexecutionhistory', function (Application $app, Request $request) {

	$result = EventExecutionHistoryApiLogic::Update($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * DELETE
 *
 **/

$app->DELETE('/eventexecutionhistory', function (Application $app, Request $request) {

	$result = EventExecutionHistoryApiLogic::Delete($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * ERASED
 *
 **/

$app->PATCH('/eventexecutionhistory', function (Application $app, Request $request) {

	$result = EventExecutionHistoryApiLogic::Erase($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET
 *
 **/

$app->GET('/eventexecutionhistory/{eventexecutionhistoryId}', function (Application $app, Request $request, $eventexecutionhistoryId) {

	$result = EventExecutionHistoryApiLogic::Get($eventexecutionhistoryId);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET LIST
 *
 **/

$app->GET('/eventexecutionhistory', function (Application $app, Request $request) {

	$result = EventExecutionHistoryApiLogic::GetList();
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET DATATABLE
 *
 **/

$app->GET('/eventexecutionhistory/datatable/list', function (Application $app, Request $request) {

	$result = EventExecutionHistoryApiLogic::GetListDatatable();
	$resp = new Response(json_encode($result));
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET AUTOCOMPLETE
 *
 **/

$app->GET('/eventexecutionhistory/autocomplete/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = EventExecutionHistoryApiLogic::GetListFilterAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET FOREIGN KEY
 *
 **/

$app->GET('/eventexecutionhistory/foreignkey/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = EventExecutionHistoryApiLogic::GetListFKAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/************************************************************

LOGPROGRAMFILE

 ************************************************************/

/**
 *
 * INSERT
 *
 **/

$app->POST('/logprogramfile', function (Application $app, Request $request) {

	$result = LogProgramFileApiLogic::Save($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * UPDATE
 *
 **/

$app->PUT('/logprogramfile', function (Application $app, Request $request) {

	$result = LogProgramFileApiLogic::Update($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * DELETE
 *
 **/

$app->DELETE('/logprogramfile', function (Application $app, Request $request) {

	$result = LogProgramFileApiLogic::Delete($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * ERASED
 *
 **/

$app->PATCH('/logprogramfile', function (Application $app, Request $request) {

	$result = LogProgramFileApiLogic::Erase($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET
 *
 **/

$app->GET('/logprogramfile/{logprogramfileId}', function (Application $app, Request $request, $logprogramfileId) {

	$result = LogProgramFileApiLogic::Get($logprogramfileId);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET LIST
 *
 **/

$app->GET('/logprogramfile', function (Application $app, Request $request) {

	$result = LogProgramFileApiLogic::GetList();
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET DATATABLE
 *
 **/

$app->GET('/logprogramfile/datatable/list', function (Application $app, Request $request) {

	$result = LogProgramFileApiLogic::GetListDatatable();
	$resp = new Response(json_encode($result));
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET AUTOCOMPLETE
 *
 **/

$app->GET('/logprogramfile/autocomplete/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = LogProgramFileApiLogic::GetListFilterAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET FOREIGN KEY
 *
 **/

$app->GET('/logprogramfile/foreignkey/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = LogProgramFileApiLogic::GetListFKAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/************************************************************

NODE

 ************************************************************/

/**
 *
 * INSERT
 *
 **/

$app->POST('/node', function (Application $app, Request $request) {

	$result = NodeApiLogic::Save($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * UPDATE
 *
 **/

$app->PUT('/node', function (Application $app, Request $request) {

	$result = NodeApiLogic::Update($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * DELETE
 *
 **/

$app->DELETE('/node', function (Application $app, Request $request) {

	$result = NodeApiLogic::Delete($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * ERASED
 *
 **/

$app->PATCH('/node', function (Application $app, Request $request) {

	$result = NodeApiLogic::Erase($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET
 *
 **/

$app->GET('/node/{nodeId}', function (Application $app, Request $request, $nodeId) {

	$result = NodeApiLogic::Get($nodeId);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET LIST
 *
 **/

$app->GET('/node', function (Application $app, Request $request) {

	$result = NodeApiLogic::GetList();
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET DATATABLE
 *
 **/

$app->GET('/node/datatable/list', function (Application $app, Request $request) {

	$result = NodeApiLogic::GetListDatatable();
	$resp = new Response(json_encode($result));
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET AUTOCOMPLETE
 *
 **/

$app->GET('/node/autocomplete/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = NodeApiLogic::GetListFilterAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET FOREIGN KEY
 *
 **/

$app->GET('/node/foreignkey/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = NodeApiLogic::GetListFKAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET REGION NAME
 *
 **/

$app->GET('/node/regionname/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = NodeApiLogic::GetRegionFKAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET CAMERA MODEL NAME
 *
 **/

 $app->GET('/cameramodel', function (Application $app, Request $request) {
	
	$result = NodeApiLogic::GetCameraModels();
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET NODE VERSION
 *
 **/

 $app->GET('/nodeversion', function (Application $app, Request $request) {
	
	$result = NodeApiLogic::GetNodeVersions();
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});


$app->GET('/node/referedtoname/{personId}', function (Application $app, Request $request, $personId) {

	$result = NodeApiLogic::GetPersonFKAjax($personId);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GENERATE STATION CODE
 *
 **/

$app->GET('/node/stationcode/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	// $result = NodeApiLogic::GenerateCode($companyColumn);
	// 	$resp = new Response(json_encode($result));
	// 	$resp->setStatusCode(200);
	// return $resp;
	$result = NodeApiLogic::GenerateCode($companyColumn);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GENERATE STATION HOSTNAME
 *
 **/

$app->GET('/node/stationhostname/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	// $result = NodeApiLogic::GenerateCode($companyColumn);
	// 	$resp = new Response(json_encode($result));
	// 	$resp->setStatusCode(200);
	// return $resp;
	$result = NodeApiLogic::GenerateHostname($companyColumn);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 * 
 * GET NODE STATUS
 * 
 */
$app->GET('/node/status/nodestatus', function (Application $app, Request $request) {

	// $result = NodeApiLogic::GenerateCode($companyColumn);
	// 	$resp = new Response(json_encode($result));
	// 	$resp->setStatusCode(200);
	// return $resp;
	$result = NodeApiLogic::GetNodeStatus();
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * UPDATE NODE STATUS
 *
 **/

$app->PATCH('/node/status/update', function (Application $app, Request $request) {

	$result = NodeApiLogic::UpdateNodeStatus($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 * 
 *  GET SOLUTIONS FILE
 * 
 */

$app->GET('/node/solutions/download', function (Application $app, Request $request) {
	$result = NodeApiLogic::GetSolutionFile();
	$resp = new BinaryFileResponse($result);
	$resp->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT);
	$resp->setStatusCode(200);
	return $resp;
});

/**
 * 
 *  GET NODE CONFIGURATION FILE
 * 
 */
error_reporting(E_ALL);
 $app->GET('/node/configuration/download', function (Application $app, Request $request) {
	$result = NodeApiLogic::GetNodeConfiguration($request);
	$resp = new BinaryFileResponse($result);
	$resp->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT);
	$resp->setStatusCode(200);
	return $resp;
});
/************************************************************

OBSERVEDBY

 ************************************************************/

/**
 *
 * INSERT
 *
 **/

$app->POST('/observedby', function (Application $app, Request $request) {

	$result = ObservedByApiLogic::Save($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * UPDATE
 *
 **/

$app->PUT('/observedby', function (Application $app, Request $request) {

	$result = ObservedByApiLogic::Update($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * DELETE
 *
 **/

$app->DELETE('/observedby', function (Application $app, Request $request) {

	$result = ObservedByApiLogic::Delete($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * ERASED
 *
 **/

$app->PATCH('/observedby', function (Application $app, Request $request) {

	$result = ObservedByApiLogic::Erase($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET
 *
 **/

$app->GET('/observedby/{observedbyId}', function (Application $app, Request $request, $observedbyId) {

	$result = ObservedByApiLogic::Get($observedbyId);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET LIST
 *
 **/

$app->GET('/observedby', function (Application $app, Request $request) {

	$result = ObservedByApiLogic::GetList();
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET DATATABLE
 *
 **/

$app->GET('/observedby/datatable/list', function (Application $app, Request $request) {

	$result = ObservedByApiLogic::GetListDatatable();
	$resp = new Response(json_encode($result));
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET AUTOCOMPLETE
 *
 **/

$app->GET('/observedby/autocomplete/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = ObservedByApiLogic::GetListFilterAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET FOREIGN KEY
 *
 **/

$app->GET('/observedby/foreignkey/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = ObservedByApiLogic::GetListFKAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/************************************************************

REFERTO

 ************************************************************/

/**
 *
 * INSERT
 *
 **/

$app->POST('/referto', function (Application $app, Request $request) {

	$result = ReferToApiLogic::Save($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * UPDATE
 *
 **/

$app->PUT('/referto', function (Application $app, Request $request) {

	$result = ReferToApiLogic::Update($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * DELETE
 *
 **/

$app->DELETE('/referto', function (Application $app, Request $request) {

	$result = ReferToApiLogic::Delete($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * ERASED
 *
 **/

$app->PATCH('/referto', function (Application $app, Request $request) {

	$result = ReferToApiLogic::Erase($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET
 *
 **/

$app->GET('/referto/{refertoId}', function (Application $app, Request $request, $refertoId) {

	$result = ReferToApiLogic::Get($refertoId);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET LIST
 *
 **/

$app->GET('/referto', function (Application $app, Request $request) {

	$result = ReferToApiLogic::GetList();
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET DATATABLE
 *
 **/

$app->GET('/referto/datatable/list', function (Application $app, Request $request) {

	$result = ReferToApiLogic::GetListDatatable();
	$resp = new Response(json_encode($result));
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET AUTOCOMPLETE
 *
 **/

$app->GET('/referto/autocomplete/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = ReferToApiLogic::GetListFilterAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET FOREIGN KEY
 *
 **/

$app->GET('/referto/foreignkey/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = ReferToApiLogic::GetListFKAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/************************************************************

REGION

 ************************************************************/

/**
 *
 * INSERT
 *
 **/

$app->POST('/region', function (Application $app, Request $request) {

	$result = RegionApiLogic::Save($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * UPDATE
 *
 **/

$app->PUT('/region', function (Application $app, Request $request) {

	$result = RegionApiLogic::Update($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * DELETE
 *
 **/

$app->DELETE('/region', function (Application $app, Request $request) {

	$result = RegionApiLogic::Delete($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * ERASED
 *
 **/

$app->PATCH('/region', function (Application $app, Request $request) {

	$result = RegionApiLogic::Erase($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET
 *
 **/

$app->GET('/region/{regionId}', function (Application $app, Request $request, $regionId) {

	$result = RegionApiLogic::Get($regionId);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET LIST
 *
 **/

$app->GET('/region', function (Application $app, Request $request) {

	$result = RegionApiLogic::GetList();
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET DATATABLE
 *
 **/

$app->GET('/region/datatable/list', function (Application $app, Request $request) {

	$result = RegionApiLogic::GetListDatatable();
	$resp = new Response(json_encode($result));
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET AUTOCOMPLETE
 *
 **/

$app->GET('/region/autocomplete/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = RegionApiLogic::GetListFilterAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET FOREIGN KEY
 *
 **/

$app->GET('/region/foreignkey/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = RegionApiLogic::GetListFKAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/************************************************************

STATION

 ************************************************************/

/**
 *
 * INSERT
 *
 **/

$app->POST('/station', function (Application $app, Request $request) {

	$result = StationApiLogic::Save($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * UPDATE
 *
 **/

$app->PUT('/station', function (Application $app, Request $request) {

	$result = StationApiLogic::Update($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * DELETE
 *
 **/

$app->DELETE('/station', function (Application $app, Request $request) {

	$result = StationApiLogic::Delete($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * ERASED
 *
 **/

$app->PATCH('/station', function (Application $app, Request $request) {

	$result = StationApiLogic::Erase($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET
 *
 **/

$app->GET('/station/{stationId}', function (Application $app, Request $request, $stationId) {

	$result = StationApiLogic::Get($stationId);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

$app->GET('/station/googleMarkers/XML', function (Application $app, Request $request) {
	$result = StationLogic::GenerateGoogleMapsXMLMarkers2();

	$resp = new Response(json_encode($result));
	$resp->setStatusCode(200);

	return $resp;
});


$app->POST('/station/googleMarkers/ImportKML', function (Application $app, Request $request) {
	//get file 
	$resp = new Response(json_encode($result));

	$uploaddir = '/var/www/html/kml/';
	$uploadfile = $uploaddir . $_FILES['file']['name'];
	$file_moved = move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);

	if ($file_moved) {
		$result = StationLogic::ImportKML($uploadfile);

		if ($result) {
			$resp->setStatusCode(200);
			return $resp;
		}
	}

	$resp->setStatusCode(420);
	return $resp;
});


$app->POST('/station/googleMarkers/ExportKML', function (Application $app, Request $request) {
	$result = StationLogic::ExportKML();

	$resp = new Response(json_encode($result));
	$resp->setStatusCode(420);

	return $resp;
});

/**
 *
 * GET LIST
 *
 **/

$app->GET('/station', function (Application $app, Request $request) {

	$result = StationApiLogic::GetList();
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET DATATABLE
 *
 **/

$app->GET('/station/datatable/list', function (Application $app, Request $request) {

	$result = StationApiLogic::GetListDatatable();
	$resp = new Response(json_encode($result));
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET AUTOCOMPLETE
 *
 **/

$app->GET('/station/autocomplete/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = StationApiLogic::GetListFilterAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET FOREIGN KEY
 *
 **/

$app->GET('/station/foreignkey/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = StationApiLogic::GetListFKAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/************************************************************

SYSTEMCONFIGURATION

 ************************************************************/

/**
 *
 * INSERT
 *
 **/

$app->POST('/systemconfiguration', function (Application $app, Request $request) {

	$result = SystemConfigurationApiLogic::Save($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * UPDATE
 *
 **/

$app->PUT('/systemconfiguration', function (Application $app, Request $request) {

	$result = SystemConfigurationApiLogic::Update($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * DELETE
 *
 **/

$app->DELETE('/systemconfiguration', function (Application $app, Request $request) {

	$result = SystemConfigurationApiLogic::Delete($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * ERASED
 *
 **/

$app->PATCH('/systemconfiguration', function (Application $app, Request $request) {

	$result = SystemConfigurationApiLogic::Erase($request->request);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET
 *
 **/

$app->GET('/systemconfiguration/{systemconfigurationId}', function (Application $app, Request $request, $systemconfigurationId) {

	$result = SystemConfigurationApiLogic::Get($systemconfigurationId);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET LIST
 *
 **/

$app->GET('/systemconfiguration', function (Application $app, Request $request) {

	$result = SystemConfigurationApiLogic::GetList();
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET DATATABLE
 *
 **/

$app->GET('/systemconfiguration/datatable/list', function (Application $app, Request $request) {

	$result = SystemConfigurationApiLogic::GetListDatatable();
	$resp = new Response(json_encode($result));
	$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET AUTOCOMPLETE
 *
 **/

$app->GET('/systemconfiguration/autocomplete/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = SystemConfigurationApiLogic::GetListFilterAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/**
 *
 * GET FOREIGN KEY
 *
 **/

$app->GET('/systemconfiguration/foreignkey/{companyColumn}', function (Application $app, Request $request, $companyColumn) {

	$result = SystemConfigurationApiLogic::GetListFKAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

$app->run();
