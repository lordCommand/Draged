<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('idsprache')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->idsprache), array('view', 'id' => $data->idsprache)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('name')); ?>:
	<?php echo GxHtml::encode($data->name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('beschreibung')); ?>:
	<?php echo GxHtml::encode($data->beschreibung); ?>
	<br />

</div>