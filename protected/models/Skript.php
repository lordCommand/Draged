<?php

/**
 * This is the model class for table "skript".
 *
 * The followings are the available columns in table 'skript':
 * @property integer $idskript
 * @property integer $user_iduser
 * @property string $json_skript
 * @property integer $zeit
 *
 * The followings are the available model relations:
 * @property User $userIduser
 * @property Sprache[] $spraches
 */
class Skript extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Skript the static model class
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
		return 'skript';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idskript, user_iduser, json_skript', 'required'),
			array('idskript, user_iduser, zeit', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idskript, user_iduser, json_skript, zeit', 'safe', 'on'=>'search'),
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
			'userIduser' => array(self::BELONGS_TO, 'User', 'user_iduser'),
			'spraches' => array(self::MANY_MANY, 'Sprache', 'skript_has_sprache(skript_idskript, sprache_idsprache)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idskript' => 'Idskript',
			'user_iduser' => 'User Iduser',
			'json_skript' => 'Json Skript',
			'zeit' => 'Zeit',
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

		$criteria->compare('idskript',$this->idskript);
		$criteria->compare('user_iduser',$this->user_iduser);
		$criteria->compare('json_skript',$this->json_skript,true);
		$criteria->compare('zeit',$this->zeit);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}