<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'element-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'sprache_idsprache'); ?>
		<?php echo $form->dropDownList($model, 'sprache_idsprache', GxHtml::listDataEx(Sprache::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'sprache_idsprache'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model, 'name', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'expression'); ?>
		<?php echo $form->textarea($model, 'expression', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'expression'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->