<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'sprache-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model, 'name', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'beschreibung'); ?>
		<?php echo $form->textField($model, 'beschreibung', array('maxlength' => 200)); ?>
		<?php echo $form->error($model,'beschreibung'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('elements')); ?></label>
		<?php echo $form->checkBoxList($model, 'elements', GxHtml::encodeEx(GxHtml::listDataEx(Element::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('skripts')); ?></label>
		<?php echo $form->checkBoxList($model, 'skripts', GxHtml::encodeEx(GxHtml::listDataEx(Skript::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->