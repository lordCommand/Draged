<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'idskript'); ?>
		<?php echo $form->textField($model, 'idskript'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'user_iduser'); ?>
		<?php echo $form->dropDownList($model, 'user_iduser', GxHtml::listDataEx(User::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'json_skript'); ?>
		<?php echo $form->textArea($model, 'json_skript'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'zeit'); ?>
		<?php echo $form->textField($model, 'zeit'); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
