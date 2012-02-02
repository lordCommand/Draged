<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('idskript')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->idskript), array('view', 'id' => $data->idskript)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('user_iduser')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->userIduser)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('json_skript')); ?>:
	<?php echo GxHtml::encode($data->json_skript); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('zeit')); ?>:
	<?php echo GxHtml::encode($data->zeit); ?>
	<br />

</div>