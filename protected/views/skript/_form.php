<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'skript-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'user_iduser'); ?>
		<?php echo $form->hiddenField($model, 'user_iduser'); ?>
		<?php echo $form->error($model,'user_iduser'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->hiddenField($model, 'json_skript'); ?>
		<?php echo $form->error($model,'json_skript'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('spraches')); ?></label>
		<?php echo $form->checkBoxList($model, 'spraches', GxHtml::encodeEx(GxHtml::listDataEx(Sprache::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->