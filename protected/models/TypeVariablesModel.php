<?php

/**
 * This is the model class for table "type_variables".
 *
 * The followings are the available columns in table 'type_variables':
 * @property integer $typevariable_id
 * @property string $typevariable_denomination
 * @property string $typevariable_key
 * @property integer $active
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property TypeDeviceVariables[] $typeDeviceVariables
 */
class TypeVariablesModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'type_variables';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('typevariable_denomination, typevariable_key', 'required'),
			array('active, status', 'numerical', 'integerOnly'=>true),
			array('typevariable_denomination, typevariable_key', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('typevariable_id, typevariable_denomination, typevariable_key, active, status', 'safe', 'on'=>'search'),
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
			'typeDeviceVariables' => array(self::HAS_MANY, 'TypeDeviceVariables', 'typevariable_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'typevariable_id' => 'Typevariable',
			'typevariable_denomination' => 'Typevariable Denomination',
			'typevariable_key' => 'Typevariable Key',
			'active' => 'Active',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('typevariable_id',$this->typevariable_id);
		$criteria->compare('typevariable_denomination',$this->typevariable_denomination,true);
		$criteria->compare('typevariable_key',$this->typevariable_key,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TypeVariablesModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
