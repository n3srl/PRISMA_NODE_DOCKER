<?php

/**
 * 
 * @author: N3 S.r.l.
 */
require($_SERVER['DOCUMENT_ROOT'] . '/dbms.php');
require($_SERVER['DOCUMENT_ROOT'] . '/lib/core/v1/model/N3Object.php');

$dir = $_SERVER['DOCUMENT_ROOT'] . "/lib/core/v1/model";
$files_tmp = scandir($dir);
$files = array();
foreach ($files_tmp as $key => $value) {
    if (!in_array($value, array(".", ".."))) {
        if($value != "N3Object.php" ){
            $files[] = $value;
        }
        
    }
}

//Includo le classi singole senza factory.php
foreach ($files as $file) {
    if (strpos($file, 'Factory.php') !== false)
        continue;
    if(!is_dir($dir . "/" . $file))
        include_once $dir . "/" . $file;
}
//Includo le factory
foreach ($files as $file) {
    if (strpos($file, 'Factory.php') !== false)
        include_once $dir . "/" . $file;
}

$dir = $_SERVER['DOCUMENT_ROOT'] . "/lib/core/v1/model/view";
if (file_exists($dir)) {
    $files_tmp = scandir($dir);
    $files = array();
    foreach ($files_tmp as $key => $value) {
        if (!in_array($value, array(".", ".."))) {
            $files[] = $value;
        }
    }
    foreach ($files as $file) {
        include $dir . "/" . $file;
    }
}

$dir = $_SERVER['DOCUMENT_ROOT'] . "/lib/core/v1/logic";

$files_tmp = scandir($dir);
$files = array();
foreach ($files_tmp as $key => $value) {
    if (!in_array($value, array(".", ".."))) {
        $files[] = $value;
    }
}

//Includo le logic
foreach ($files as $file) {
    if (strpos($file, 'Logic.php') !== false)
        include $dir . "/" . $file;
}
$dir = $_SERVER['DOCUMENT_ROOT'] . "/lib/core/v1/logic/api";
if (file_exists($dir)) {
    $files_tmp = scandir($dir);
    $files = array();
    foreach ($files_tmp as $key => $value) {
        if (!in_array($value, array(".", ".."))) {
            $files[] = $value;
        }
    }
    foreach ($files as $file) {
        include $dir . "/" . $file;
    }
}

//include $_SERVER['DOCUMENT_ROOT'].'/config/config_menu.php';
//include $_SERVER['DOCUMENT_ROOT'].'/config/config_mail.php';