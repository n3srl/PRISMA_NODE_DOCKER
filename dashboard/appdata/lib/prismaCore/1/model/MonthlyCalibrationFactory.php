<?php

/**
 * Class for StationFactory
 * 
 * @author: N3 S.r.l.
 */
class MonthlyCalibrationFactory extends MonthlyCalibrationFactoryBase
{

    public static function CheckData($object, $clean = true)
    {
        $errors = array();
        $parse_error = false;
    }

    public static function SetDefaultCalibration($ob)
    {
        global $db_conn;
        MonthlyCalibrationFactory::ResetDefaultCalibration($ob);
        $query = "UPDATE pr_drv_monthly_calibration SET is_default=1 WHERE name = '$ob->name'";
        $res = mysqli_query($db_conn, $query);
        if ($res === false) return false;
        else return true;
    }

    public static function ResetDefaultCalibration($ob)
    {
        global $db_conn;
        $node_code = substr($ob->name, 0, 6);
        $query = "UPDATE pr_drv_monthly_calibration SET is_default=0 WHERE node_code LIKE '%$node_code%'";
        $res = mysqli_query($db_conn, $query);
        if ($res === false) return false;
        else return true;
    }
}
