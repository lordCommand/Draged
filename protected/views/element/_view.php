<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('idelement')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->idelement), array('view', 'id' => $data->idelement)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('sprache_idsprache')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->spracheIdsprache)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('name')); ?>:
	<?php echo GxHtml::encode($data->name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('expression')); ?>:
	<?php echo GxHtml::encode($data->expression); ?>
	<br />

</div>