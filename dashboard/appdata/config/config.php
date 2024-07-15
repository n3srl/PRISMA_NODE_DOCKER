<?php
define("_PROD_HOSTNAME_", "34.77.178.151");
$PROD = $_SERVER['SERVER_NAME'] == _PROD_HOSTNAME_;

if ($PROD) {
    
    /* PROD */

    $db_rdbms = "inaf_prisma";
    $db_name = 'inaf_prisma';
    $db_user = 'prisma';
    $db_pass = 'zC3!#A#h2bEEKENY';
    $db_host = 'localhost';
    $db_port = '3306';

    date_default_timezone_set('UTC');

    define('_DB_NAME_', $db_name);
    define('_EXTLIB_', '/var/www/html/ext_lib/');
    define('_WEBROOTDIR_', '/var/www/html/');
    define('_IMGFILEURL_', 'http://34.77.178.151/img/');
    define('_FILEUPLADPATH_', '/var/www/html');
    
    define('_ENABLEWAREHOUSE_', false);

    define('_SMSMITTENTE_', '+39000000000');
    define('_SEVERNAMEC_', '34.77.178.151');
} else {
    
    /* PREPROD */

    $db_rdbms = "inaf_prisma";
    $db_name = 'inaf_prisma';
    $db_user = 'root';
    $db_pass = 'f746e17c26dceaf750c471788c854bc0';
    $db_host = '192.168.17.197';
    $db_port = '3306';

    date_default_timezone_set('UTC');

    define('_DB_NAME_', $db_name);
    define('_EXTLIB_', '/var/www/html/ext_lib/');
    define('_WEBROOTDIR_', '/var/www/html/');
    define('_IMGFILEURL_', 'http://34.77.178.151/img/');
    define('_FILEUPLADPATH_', '/var/www/html');
    
    define('_ENABLEWAREHOUSE_', false);

    define('_SMSMITTENTE_', '+39000000000');
    define('_SEVERNAMEC_', '34.77.178.151');

}

$elabIp = '10.8.0.3';
$elabUsr = 'bianchi';
$elabPsw = 'Cambiami';

define('__TMP_CONFIG__', 'tmp-config/');
define('__VPN_CERTIFICATE_PATH__', 'vpn-certificates/');
define('__FREETURE_CFG_FILE__', "configuration.cfg");

$elabDetectFolder = '/prismadata/detections/single';
