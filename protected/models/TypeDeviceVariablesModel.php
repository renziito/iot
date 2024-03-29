<?php

/**
 * This is the model class for table "type_device_variables".
 *
 * The followings are the available columns in table 'type_device_variables':
 * @property integer $typedevicevariable_id
 * @property integer $typedevice_id
 * @property integer $typevariable_id
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property TypeDevices $typedevice
 * @property TypeVariables $typevariable
 */
class TypeDeviceVariablesModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'type_device_variables';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('typedevice_id, typevariable_id', 'required'),
			array('typedevice_id, typevariable_id, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('typedevicevariable_id, typedevice_id, typevariable_id, status', 'safe', 'on'=>'search'),
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
			'typedevice' => array(self::BELONGS_TO, 'TypeDevices', 'typedevice_id'),
			'typevariable' => array(self::BELONGS_TO, 'TypeVariables', 'typevariable_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'typedevicevariable_id' => 'Typedevicevariable',
			'typedevice_id' => 'Typedevice',
			'typevariable_id' => 'Typevariable',
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

		$criteria->compare('typedevicevariable_id',$this->typedevicevariable_id);
		$criteria->compare('typedevice_id',$this->typedevice_id);
		$criteria->compare('typevariable_id',$this->typevariable_id);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TypeDeviceVariablesModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
