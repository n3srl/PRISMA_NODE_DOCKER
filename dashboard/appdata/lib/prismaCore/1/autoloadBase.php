<?php
/**
*
* @author: N3 S.r.l.
*/

$dir = $_SERVER['DOCUMENT_ROOT']. "/lib/prismaCore/1/model";
$files_tmp = scandir($dir);
$files = array();
foreach ($files_tmp as $key => $value)
{
	if (!in_array($value, array(".", "..")) && !is_dir($dir . "/" . $value))
	{
		$files[] = $value;
	}
}
//Includo le classi singole senza factory.php
foreach ($files as $file){
	if (strpos($file, 'Factory.php') !== false)
		continue;
	include $dir."/".$file;
}
//Includo le factory
foreach ($files as $file){
	if (strpos($file, 'Factory.php') !== false)
		include $dir."/".$file;
}

$dir = $_SERVER['DOCUMENT_ROOT']. "/lib/prismaCore/1/model/view";
if(file_exists($dir)){
	$files_tmp = scandir($dir);
	$files = array();
	foreach ($files_tmp as $key => $value)
	{
		if (!in_array($value, array(".", "..")))
		{
			$files[] = $value;
		}
	}
	foreach ($files as $file){
		include $dir."/".$file;
	}
}
$dir = $_SERVER['DOCUMENT_ROOT']. "/lib/prismaCore/1/logic";
$files_tmp = scandir($dir);
$files = array();
foreach ($files_tmp as $key => $value)
{
	if (!in_array($value, array(".", "..")) && !is_dir($dir . "/" . $value))
	{
		$files[] = $value;
	}
}
//Includo le logic
foreach ($files as $file){
	if (strpos($file, 'Logic.php') !== false)
		include $dir."/".$file;
}

$dir = $_SERVER['DOCUMENT_ROOT']. "/lib/prismaCore/1/logic/api";
if(file_exists($dir)){
	$files_tmp = scandir($dir);
	$files = array();
	foreach ($files_tmp as $key => $value)
	{
		if (!in_array($value, array(".", "..")))
		{
			$files[] = $value;
		}
	}
	foreach ($files as $file){
		include $dir."/".$file;
	}
}

