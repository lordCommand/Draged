<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
    ' #' . $model->idskript,
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->idskript)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->idskript), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' #' . $model->idskript; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'idskript',
array(
			'name' => 'userIduser',
			'type' => 'raw',
			'value' => $model->userIduser !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->userIduser)), array('user/view', 'id' => GxActiveRecord::extractPkValue($model->userIduser, true))) : null,
			),
'json_skript',

                array(
                    'type' => 'raw',
                				'name'=>'zeit',
                				'value'=>date("H:i d.m.Y",$model->zeit),
                    ),	),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('sprache')); ?></h2>
<?php
	foreach($model->spraches as $relatedModel) {

		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('sprache/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
        $do = new convert(GxActiveRecord::extractPkValue($relatedModel, true));
        ?><br /><?php
        echo nl2br($do->parse( CJSON::decode( $model->json_skript ) ));
        ?><br /><?php
	}
?>