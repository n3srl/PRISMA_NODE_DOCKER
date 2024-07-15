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

$app = new Silex\Application();

$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

$app->GET('/login', function(Application $app, Request $request) {
    /* $username = $request->get('username');
      $password = $request->get('password');
     */
    $result = CoreLogic::Login($request);
    if ($result->result) {
        $resp = new Response(json_encode($result));
        $resp->setStatusCode(200);
    } else {
        $resp = new Response();
        $resp->setStatusCode(401);
    }

    return $resp;
});

$app->GET('/logout', function(Application $app, Request $request) {

    $result = CoreLogic::Logout();
    if ($result->result) {
        $resp = new Response(json_encode($result));
        $resp->setStatusCode(200);
    } else {
        $resp = new Response();
        $resp->setStatusCode(401);
    }

    return $resp;
});

$app->GET('/menu', function(Application $app, Request $request) {

    $result = CoreLogic::Menu();

    if ($result->result) {
        $resp = new Response(json_encode($result));
        $resp->setStatusCode(200);
    } else {
        $resp = new Response();
        $resp->setStatusCode(401);
    }

    return $resp;
});

$app->GET('/getcurrentuser', function(Application $app, Request $request) {
    $result = CoreApiLogic::GetCurrentUser();
    if ($result->result) {
        $resp = new Response(json_encode($result));
        $resp->setStatusCode(200);
    } else {
        $resp = new Response();
        $resp->setStatusCode(401);
    }

    return $resp;
});

/* * **********************************************************

  GROUP

 * ********************************************************** */

/**
 *
 * INSERT
 *
 * */
$app->POST('/group', function(Application $app, Request $request) {

	$result = GroupApiLogic::Save($request->request);
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
 * */
$app->PUT('/group', function(Application $app, Request $request) {

	$result = GroupApiLogic::Update($request->request);
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
 * */
$app->DELETE('/group', function(Application $app, Request $request) {

	$result = GroupApiLogic::Delete($request->request);
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
 * */
$app->PATCH('/group', function(Application $app, Request $request) {

	$result = GroupApiLogic::Erase($request->request);
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
 * */
$app->GET('/group/{groupId}', function(Application $app, Request $request, $groupId) {

	$result = GroupApiLogic::Get($groupId);
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
 * */
$app->GET('/group', function(Application $app, Request $request) {

	$result = GroupApiLogic::GetList();
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
 * */
$app->GET('/group/datatable/list', function(Application $app, Request $request) {

	$result = GroupApiLogic::GetListDatatable();
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET AUTOCOMPLETE
 *
 * */
$app->GET('/group/autocomplete/{companyColumn}', function(Application $app, Request $request, $companyColumn) {

	$result = GroupApiLogic::GetListFilterAjax($companyColumn);
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
 * */
$app->GET('/group/foreignkey/{companyColumn}', function(Application $app, Request $request, $companyColumn) {

	$result = GroupApiLogic::GetListFKAjax($companyColumn);
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
 * GET LIST
 *
 * */
$app->GET('/grouplist', function(Application $app, Request $request) {

    $result = GroupApiLogic::GetListDropdown();
    if ($result->results) {
        $resp = new Response(json_encode($result));
        $resp->setStatusCode(200);
    } else {
        $resp = new Response(json_encode($result));
        $resp->setStatusCode(403);
    }
    return $resp;
});

/* * **********************************************************

  GROUPHASPERSON

 * ********************************************************** */

/**
 *
 * INSERT
 *
 * */
$app->POST('/grouphasperson', function(Application $app, Request $request) {

	$result = GroupHasPersonApiLogic::Save($request->request);
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
 * */
$app->PUT('/grouphasperson', function(Application $app, Request $request) {

	$result = GroupHasPersonApiLogic::Update($request->request);
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
 * */
$app->DELETE('/grouphasperson', function(Application $app, Request $request) {

	$result = GroupHasPersonApiLogic::Delete($request->request);
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
 * */
$app->PATCH('/grouphasperson', function(Application $app, Request $request) {

	$result = GroupHasPersonApiLogic::Erase($request->request);
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
 * */
$app->GET('/grouphasperson/{grouphaspersonId}', function(Application $app, Request $request, $grouphaspersonId) {

	$result = GroupHasPersonApiLogic::Get($grouphaspersonId);
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
 * */
$app->GET('/grouphasperson', function(Application $app, Request $request) {

	$result = GroupHasPersonApiLogic::GetList();
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
 * */
$app->GET('/grouphasperson/datatable/list', function(Application $app, Request $request) {

	$result = GroupHasPersonApiLogic::GetListDatatable();
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET AUTOCOMPLETE
 *
 * */
$app->GET('/grouphasperson/autocomplete/{companyColumn}', function(Application $app, Request $request, $companyColumn) {

	$result = GroupHasPersonApiLogic::GetListFilterAjax($companyColumn);
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
 * */
$app->GET('/grouphasperson/foreignkey/{companyColumn}', function(Application $app, Request $request, $companyColumn) {

	$result = GroupHasPersonApiLogic::GetListFKAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/* * **********************************************************

  GUI

 * ********************************************************** */

/**
 *
 * INSERT
 *
 * */
$app->POST('/gui', function(Application $app, Request $request) {

	$result = GuiApiLogic::Save($request->request);
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
 * */
$app->PUT('/gui', function(Application $app, Request $request) {

	$result = GuiApiLogic::Update($request->request);
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
 * */
$app->DELETE('/gui', function(Application $app, Request $request) {

	$result = GuiApiLogic::Delete($request->request);
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
 * */
$app->PATCH('/gui', function(Application $app, Request $request) {

	$result = GuiApiLogic::Erase($request->request);
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
 * */
$app->GET('/gui/{guiId}', function(Application $app, Request $request, $guiId) {

	$result = GuiApiLogic::Get($guiId);
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
 * */
$app->GET('/gui', function(Application $app, Request $request) {

	$result = GuiApiLogic::GetList();
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
 * */
$app->GET('/gui/datatable/list', function(Application $app, Request $request) {

	$result = GuiApiLogic::GetListDatatable();
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	return $resp;
});

/**
 *
 * GET AUTOCOMPLETE
 *
 * */
$app->GET('/gui/autocomplete/{companyColumn}', function(Application $app, Request $request, $companyColumn) {

	$result = GuiApiLogic::GetListFilterAjax($companyColumn);
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
 * */
$app->GET('/gui/foreignkey/{companyColumn}', function(Application $app, Request $request, $companyColumn) {

	$result = GuiApiLogic::GetListFKAjax($companyColumn);
	if ($result->results) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

/* * **********************************************************

  PERMISSION

 * ********************************************************** */

$app->GET('/permission', function(Application $app, Request $request) {

    $result = CoreLogic::Permission($request);

    if ($result->result) {
        $resp = new Response(json_encode($result));
        $resp->setStatusCode(200);
    } else {
        $resp = new Response();
        $resp->setStatusCode(401);
    }

    return $resp;
});

$app->GET('/csfr', function(Application $app, Request $request) {

    $result = CoreLogic::GenerateCSRF();

    if ($result->result) {
        $resp = new Response(json_encode($result));
        $resp->setStatusCode(200);
    } else {
        $resp = new Response();
        $resp->setStatusCode(401);
    }

    return $resp;
});

/* * **********************************************************

  PERSON

 * ********************************************************** */

/**
 *
 * INSERT
 *
 * */
$app->POST('/person', function(Application $app, Request $request) {

    $result = PersonApiLogic::Save($request->request);
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
 * */
$app->PUT('/person', function(Application $app, Request $request) {

    $result = PersonApiLogic::Update($request->request);
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
 * */
$app->DELETE('/person', function(Application $app, Request $request) {

    $result = PersonApiLogic::Delete($request->request);
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
 * */
$app->PATCH('/person', function(Application $app, Request $request) {

    $result = PersonApiLogic::Erase($request->request);
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
 * */
$app->GET('/person/{personId}', function(Application $app, Request $request, $personId) {

    $result = PersonApiLogic::Get($personId);
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
 * */
$app->GET('/person', function(Application $app, Request $request) {

    $result = PersonApiLogic::GetList();
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
 * */
$app->GET('/person/datatable/list', function(Application $app, Request $request) {

    $result = PersonApiLogic::GetListDatatable();
    $resp = new Response(json_encode($result));
    $resp->setStatusCode(200);
    return $resp;
});

/**
 *
 * GET CONTACTS DATATABLE
 *
 * */
// $app->GET('/person/contactdatatable/list', function(Application $app, Request $request) {

//     $result = PersonApiLogic::GetListContactDatatable();
//     $resp = new Response(json_encode($result));
//     $resp->setStatusCode(200);
//     return $resp;
// });

/**
 *
 * GET AUTOCOMPLETE
 *
 * */
$app->GET('/person/autocomplete/{companyColumn}', function(Application $app, Request $request, $companyColumn) {

    $result = PersonApiLogic::GetListFilterAjax($companyColumn);
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
 * */
$app->GET('/person/foreignkey/{companyColumn}', function(Application $app, Request $request, $companyColumn) {

    $result = PersonApiLogic::GetListFKAjax($companyColumn);
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
 * GET LIST
 *
 * */
$app->GET('/personddlist', function(Application $app, Request $request) {

    $result = PersonApiLogic::GetListPersonName();
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

SETTINGS

************************************************************/

/**
*
* INSERT
*
**/

$app->POST('/settings/{module}', function(Application $app, Request $request,$module) {

	$result = SettingsApiLogic::Save($request->request,$module);
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

$app->PUT('/settings/{module}', function(Application $app, Request $request, $module) {

	$result = SettingsApiLogic::Update($request->request,$module);
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

$app->GET('/settings/{module}', function(Application $app, Request $request, $module) {

	$result = SettingsApiLogic::Get($module);
	if ($result->result) {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(200);
	} else {
		$resp = new Response(json_encode($result));
		$resp->setStatusCode(403);
	}
	return $resp;
});

$app->GET('/session/checkperson', function(Application $app, Request $request) {

	CoreApiLogic::EventHandlerValidSession();

});

$app->run();

