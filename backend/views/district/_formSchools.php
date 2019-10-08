<div class="form-group" id="add-schools">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'Schools',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'title' => ['type' => TabularForm::INPUT_TEXT],
        'slug' => ['type' => TabularForm::INPUT_TEXT],
        'school_identity_number' => ['type' => TabularForm::INPUT_TEXT],
        'city_id' => ['type' => TabularForm::INPUT_TEXT],
        'stage' => ['type' => TabularForm::INPUT_TEXT],
        'gender' => ['type' => TabularForm::INPUT_TEXT],
        'category' => ['type' => TabularForm::INPUT_TEXT],
        'email' => ['type' => TabularForm::INPUT_TEXT],
        'admin_name' => ['type' => TabularForm::INPUT_TEXT],
        'admin_phone' => ['type' => TabularForm::INPUT_TEXT],
        'admin_email' => ['type' => TabularForm::INPUT_TEXT],
        'supervisor_phone' => ['type' => TabularForm::INPUT_TEXT],
        'owner_name' => ['type' => TabularForm::INPUT_TEXT],
        'owner_phone' => ['type' => TabularForm::INPUT_TEXT],
        'owner_identity' => ['type' => TabularForm::INPUT_TEXT],
        'owner_gender' => ['type' => TabularForm::INPUT_TEXT],
        'owner_email' => ['type' => TabularForm::INPUT_TEXT],
        'nour_rep_phone' => ['type' => TabularForm::INPUT_TEXT],
        'owner_id' => ['type' => TabularForm::INPUT_TEXT],
        'lock' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('backend', 'Delete'), 'onClick' => 'delRowSchools(' . $key . '); return false;', 'id' => 'schools-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('backend', 'Add Schools'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowSchools()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

