<?php

/**
 * This is the model base class for the table "sprache".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Sprache".
 *
 * Columns in table "sprache" available as properties of the model,
 * followed by relations of table "sprache" available as properties of the model.
 *
 * @property integer $idsprache
 * @property string $name
 * @property string $beschreibung
 *
 * @property Element[] $elements
 * @property Skript[] $skripts
 */
abstract class BaseSprache extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'sprache';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Sprache|Spraches', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('name', 'length', 'max'=>45),
			array('beschreibung', 'length', 'max'=>200),
			array('name, beschreibung', 'default', 'setOnEmpty' => true, 'value' => null),
			array('idsprache, name, beschreibung', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'elements' => array(self::HAS_MANY, 'Element', 'sprache_idsprache'),
			'skripts' => array(self::MANY_MANY, 'Skript', 'skript_has_sprache(sprache_idsprache, skript_idskript)'),
		);
	}

	public function pivotModels() {
		return array(
			'skripts' => 'SkriptHasSprache',
		);
	}

	public function attributeLabels() {
		return array(
			'idsprache' => Yii::t('app', 'Idsprache'),
			'name' => Yii::t('app', 'Name'),
			'beschreibung' => Yii::t('app', 'Beschreibung'),
			'elements' => null,
			'skripts' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('idsprache', $this->idsprache);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('beschreibung', $this->beschreibung, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}