<?php

/**
 * This is the model class for table "skript_has_sprache".
 *
 * The followings are the available columns in table 'skript_has_sprache':
 * @property integer $skript_idskript
 * @property integer $sprache_idsprache
 * @property string $gen_skript
 */
class SkriptHasSprache extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SkriptHasSprache the static model class
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
		return 'skript_has_sprache';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('skript_idskript, sprache_idsprache', 'required'),
			array('skript_idskript, sprache_idsprache', 'numerical', 'integerOnly'=>true),
			array('gen_skript', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('skript_idskript, sprache_idsprache, gen_skript', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'skript_idskript' => 'Skript Idskript',
			'sprache_idsprache' => 'Sprache Idsprache',
			'gen_skript' => 'Gen Skript',
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

		$criteria->compare('skript_idskript',$this->skript_idskript);
		$criteria->compare('sprache_idsprache',$this->sprache_idsprache);
		$criteria->compare('gen_skript',$this->gen_skript,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}