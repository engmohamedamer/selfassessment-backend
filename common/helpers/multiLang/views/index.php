<?php
/**
 * @var View $this
 */
use yii\helpers\Html;
use yii\web\View;

?>
<?php $sid = uniqid() ?>


<ul class="nav nav-pills">
	<?php foreach (Yii::$app->params['mlConfig']['languages'] as $languageCode => $languageName): ?>

		<li class="nav-item  ">
			<a class="nav-link <?= (Yii::$app->language == $languageCode) ? 'active' : '' ?>" href="#ddd<?= $languageCode ?>" data-toggle="tab" aria-expanded="true">
				<?= $languageName ?>
			</a>
		</li>
	<?php endforeach ?>

</ul>




<div class="tab-content mt-2">

	<?php foreach (Yii::$app->params['mlConfig']['languages'] as $languageCode => $languageName): ?>

		<?php
		$attribute = $this->context->attribute;

		if ( $languageCode != Yii::$app->params['mlConfig']['default_language'] )
		{
			$attribute .= '_' . $languageCode;
		}

		$activeClass = (Yii::$app->language == $languageCode) ? 'active' : '';
		?>


		<div class="tab-pane <?= $activeClass ?>" id="ddd<?=  $languageCode ?>">

			<?= $this->context->getInputField($attribute) ?>
		</div>


	<?php endforeach ?>
</div>
