<?php

/**
 * This is the model class for table "sprache".
 *
 * The followings are the available columns in table 'sprache':
 * @property integer $idsprache
 * @property string $name
 * @property string $beschreibung
 *
 * The followings are the available model relations:
 * @property Element[] $elements
 * @property Skript[] $skripts
 */
class Sprache extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Sprache the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sprache';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idsprache', 'required'),
			array('idsprache', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('beschreibung', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idsprache, name, beschreibung', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'elements' => array(self::HAS_MANY, 'Element', 'sprache_idsprache'),
			'skripts' => array(self::MANY_MANY, 'Skript', 'skript_has_sprache(sprache_idsprache, skript_idskript)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idsprache' => 'Idsprache',
			'name' => 'Name',
			'beschreibung' => 'Beschreibung',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idsprache',$this->idsprache);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('beschreibung',$this->beschreibung,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}