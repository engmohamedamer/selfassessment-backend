<?php

namespace common\helpers;

use common\models\OrganizationStructure;
use yii\helpers\ArrayHelper;

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

    public static function organizationStructureQuery()
    {
        $sector_id = \Yii::$app->user->identity->userProfile->sector_id;
        if ($sector_id) {
            $str = OrganizationStructure::findOne($sector_id);
            return OrganizationStructure::find()->where(['root'=>$str->root])
            ->andWhere(['>=','lvl',$str->lvl])
            ->addOrderBy('root, lft');
        }
        return OrganizationStructure::find()->addOrderBy('root, lft');
    }

    public static function adminAllowedSectorIds()
    {
        $organizationStructure = self::organizationStructureQuery()->all();
        if (count($organizationStructure)) {
            return ArrayHelper::getColumn($organizationStructure,'id');
        }
        return [];
    }
}