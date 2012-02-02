<?php

/**
 * This is the model class for table "element".
 *
 * The followings are the available columns in table 'element':
 * @property integer $idelement
 * @property integer $sprache_idsprache
 * @property string $name
 * @property string $expression
 *
 * The followings are the available model relations:
 * @property Sprache $spracheIdsprache
 */
class Element extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Element the static model class
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
		return 'element';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idelement, sprache_idsprache', 'required'),
			array('idelement, sprache_idsprache', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('expression', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idelement, sprache_idsprache, name, expression', 'safe', 'on'=>'search'),
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
			'spracheIdsprache' => array(self::BELONGS_TO, 'Sprache', 'sprache_idsprache'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idelement' => 'Idelement',
			'sprache_idsprache' => 'Sprache Idsprache',
			'name' => 'Name',
			'expression' => 'Expression',
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

		$criteria->compare('idelement',$this->idelement);
		$criteria->compare('sprache_idsprache',$this->sprache_idsprache);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('expression',$this->expression,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}