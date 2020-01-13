<?php

namespace common\helpers;

class Filter  
{
    public static function dateFilter($column_date, $unix = false, $prefix = '')
    {
        $key = $_GET['date'] ?: null;

        if ($key == null) return ['IS NOT',$prefix.$column_date,null];
        $column_date = empty($prefix) ? $column_date : $prefix.$column_date;
        $dateFormat  = $unix ? "DATE(FROM_UNIXTIME($column_date))"  : "DATE($column_date)";
        $monthFormat = $unix ? "MONTH(FROM_UNIXTIME($column_date))" : "MONTH($column_date)";
        $yearForamt  = $unix ? "YEAR(FROM_UNIXTIME($column_date))"  : "YEAR($column_date)";

        $date['dateCurrentDay']   = [$dateFormat => date('Y-m-d')];
        $date['dateLastDay']      = [$dateFormat => date('Y-m-d',strtotime("-1 day"))];
        
        $date['dateCurrentWeek']   = ["BETWEEN", "$column_date",date("Y-m-d",strtotime("last saturday")),date("Y-m-d",strtotime("1 day"))];
        $date["dateLastWeek"]      = ["BETWEEN", "$column_date", date("Y-m-d",strtotime("-7 days",strtotime(date("Y-m-d",strtotime("last saturday"))))),date("Y-m-d",strtotime("last saturday"))];

        $date["dateCurrentMonth"]  = [ $monthFormat => date("m"),$yearForamt=>date("Y")];
        $date["dateLastMonth"]     = [  $monthFormat => date("m",strtotime("-1 month")),
            $yearForamt => (date("m",strtotime("-1 month")) == "12" ) ? date("Y",strtotime("-1 year")) : date("Y")
        ];
        
        $date["dateCurrentYear"]  = [ $yearForamt => date("Y")];
        $date["dateLastYear"]     = [ $yearForamt => date("Y",strtotime("-1 year"))];

        return $date[$key];
    }
}