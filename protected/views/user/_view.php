<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('iduser')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->iduser), array('view', 'id' => $data->iduser)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('username')); ?>:
	<?php echo GxHtml::encode($data->username); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('password')); ?>:
	<?php echo GxHtml::encode($data->password); ?>
	<br />

</div>