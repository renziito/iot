<?php

/**
 * This is the model class for table "devices".
 *
 * The followings are the available columns in table 'devices':
 * @property integer $device_id
 * @property integer $typedevice_id
 * @property string $device_code
 * @property string $device_serie
 * @property string $device_latitude
 * @property string $device_longitude
 * @property string $device_number_modem
 * @property string $device_provider_modem
 * @property integer $device_status
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property DeviceMaintenances[] $deviceMaintenances
 * @property DeviceResponsables[] $deviceResponsables
 * @property TypeDevices $typedevice
 * @property ListDevices[] $listDevices
 */
class DevicesModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'devices';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('typedevice_id, device_code, device_serie, device_latitude, device_longitude', 'required'),
			array('typedevice_id, device_status, status', 'numerical', 'integerOnly'=>true),
			array('device_code', 'length', 'max'=>20),
			array('device_serie, device_latitude, device_longitude', 'length', 'max'=>50),
			array('device_number_modem, device_provider_modem', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('device_id, typedevice_id, device_code, device_serie, device_latitude, device_longitude, device_number_modem, device_provider_modem, device_status, status', 'safe', 'on'=>'search'),
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
			'deviceMaintenances' => array(self::HAS_MANY, 'DeviceMaintenances', 'device_id'),
			'deviceResponsables' => array(self::HAS_MANY, 'DeviceResponsables', 'device_id'),
			'typedevice' => array(self::BELONGS_TO, 'TypeDevices', 'typedevice_id'),
			'listDevices' => array(self::HAS_MANY, 'ListDevices', 'device_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'device_id' => 'Device',
			'typedevice_id' => 'Typedevice',
			'device_code' => 'Device Code',
			'device_serie' => 'Device Serie',
			'device_latitude' => 'Device Latitude',
			'device_longitude' => 'Device Longitude',
			'device_number_modem' => 'Device Number Modem',
			'device_provider_modem' => 'Device Provider Modem',
			'device_status' => 'Device Status',
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

		$criteria->compare('device_id',$this->device_id);
		$criteria->compare('typedevice_id',$this->typedevice_id);
		$criteria->compare('device_code',$this->device_code,true);
		$criteria->compare('device_serie',$this->device_serie,true);
		$criteria->compare('device_latitude',$this->device_latitude,true);
		$criteria->compare('device_longitude',$this->device_longitude,true);
		$criteria->compare('device_number_modem',$this->device_number_modem,true);
		$criteria->compare('device_provider_modem',$this->device_provider_modem,true);
		$criteria->compare('device_status',$this->device_status);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DevicesModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
