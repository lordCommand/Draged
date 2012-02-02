<?php

Yii::import('application.models._base.BaseElement');

class Element extends BaseElement
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}