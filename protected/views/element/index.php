<?php

$this->breadcrumbs = array(
	Element::label(2),
	Yii::t('app', 'Index'),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Element::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Element::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(Element::label(2)); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>


<?php

$do = new convert("Javascript");
echo nl2br($do->parse("debug"));

?>