<?php

/**
 * This is the model class for table "device_activities".
 *
 * The followings are the available columns in table 'device_activities':
 * @property integer $deviceactivity_id
 * @property integer $device_id
 * @property integer $typevariable_id
 * @property string $deviceactivity_value
 * @property string $date_created
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Devices $device
 * @property TypeVariables $typevariable
 */
class DeviceActivitiesModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'device_activities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('device_id, typevariable_id, deviceactivity_value, date_created', 'required'),
			array('device_id, typevariable_id, status', 'numerical', 'integerOnly'=>true),
			array('deviceactivity_value', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('deviceactivity_id, device_id, typevariable_id, deviceactivity_value, date_created, status', 'safe', 'on'=>'search'),
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
			'device' => array(self::BELONGS_TO, 'Devices', 'device_id'),
			'typevariable' => array(self::BELONGS_TO, 'TypeVariables', 'typevariable_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'deviceactivity_id' => 'Deviceactivity',
			'device_id' => 'Device',
			'typevariable_id' => 'Typevariable',
			'deviceactivity_value' => 'Deviceactivity Value',
			'date_created' => 'Date Created',
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

		$criteria->compare('deviceactivity_id',$this->deviceactivity_id);
		$criteria->compare('device_id',$this->device_id);
		$criteria->compare('typevariable_id',$this->typevariable_id);
		$criteria->compare('deviceactivity_value',$this->deviceactivity_value,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DeviceActivitiesModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
