<?php

/**
 * This is the model class for table "device_maintenances".
 *
 * The followings are the available columns in table 'device_maintenances':
 * @property integer $devicemaintenance_id
 * @property integer $device_id
 * @property string $devicemaintenance_date
 * @property integer $responsable_id
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Devices $device
 * @property Responsables $responsable
 */
class DeviceMaintenancesModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'device_maintenances';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('device_id, devicemaintenance_date, responsable_id', 'required'),
			array('device_id, responsable_id, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('devicemaintenance_id, device_id, devicemaintenance_date, responsable_id, status', 'safe', 'on'=>'search'),
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
			'responsable' => array(self::BELONGS_TO, 'Responsables', 'responsable_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'devicemaintenance_id' => 'Devicemaintenance',
			'device_id' => 'Device',
			'devicemaintenance_date' => 'Devicemaintenance Date',
			'responsable_id' => 'Responsable',
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

		$criteria->compare('devicemaintenance_id',$this->devicemaintenance_id);
		$criteria->compare('device_id',$this->device_id);
		$criteria->compare('devicemaintenance_date',$this->devicemaintenance_date,true);
		$criteria->compare('responsable_id',$this->responsable_id);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DeviceMaintenancesModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
