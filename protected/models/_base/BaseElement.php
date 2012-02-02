<?php

/**
 * This is the model base class for the table "element".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Element".
 *
 * Columns in table "element" available as properties of the model,
 * followed by relations of table "element" available as properties of the model.
 *
 * @property integer $idelement
 * @property integer $sprache_idsprache
 * @property string $name
 * @property string $expression
 *
 * @property Sprache $spracheIdsprache
 */
abstract class BaseElement extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'element';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Element|Elements', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('sprache_idsprache', 'required'),
			array('sprache_idsprache', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('expression', 'length', 'max'=>255),
			array('name, expression', 'default', 'setOnEmpty' => true, 'value' => null),
			array('idelement, sprache_idsprache, name, expression', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'spracheIdsprache' => array(self::BELONGS_TO, 'Sprache', 'sprache_idsprache'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'idelement' => Yii::t('app', 'Idelement'),
			'sprache_idsprache' => null,
			'name' => Yii::t('app', 'Name'),
			'expression' => Yii::t('app', 'Expression'),
			'spracheIdsprache' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('idelement', $this->idelement);
		$criteria->compare('sprache_idsprache', $this->sprache_idsprache);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('expression', $this->expression, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}