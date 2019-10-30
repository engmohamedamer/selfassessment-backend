<?php
//
//echo \onmotion\survey\Survey::widget([
//    'surveyId' => 1
//]);

$t= "q-10";
$t = (int)preg_replace('/\D/ui','',$t);
echo $t;

die;

echo \backend\modules\assessment\Survey::widget([
    'surveyId' => 18
]);

?>
