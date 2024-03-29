<?php

/**
 * This is the model class for table "type_devices".
 *
 * The followings are the available columns in table 'type_devices':
 * @property integer $typedevice_id
 * @property string $typedevice_denomination
 * @property string $typedevice_origin
 * @property integer $typedevice_modem
 * @property integer $typedevice_maintenance_frequency
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Devices[] $devices
 * @property TypeDeviceVariables[] $typeDeviceVariables
 */
class TypeDevicesModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'type_devices';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('typedevice_denomination, typedevice_origin', 'required'),
			array('typedevice_modem, typedevice_maintenance_frequency, status', 'numerical', 'integerOnly'=>true),
			array('typedevice_denomination, typedevice_origin', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('typedevice_id, typedevice_denomination, typedevice_origin, typedevice_modem, typedevice_maintenance_frequency, status', 'safe', 'on'=>'search'),
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
			'devices' => array(self::HAS_MANY, 'Devices', 'typedevice_id'),
			'typeDeviceVariables' => array(self::HAS_MANY, 'TypeDeviceVariables', 'typedevice_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'typedevice_id' => 'Typedevice',
			'typedevice_denomination' => 'Typedevice Denomination',
			'typedevice_origin' => 'Typedevice Origin',
			'typedevice_modem' => 'Typedevice Modem',
			'typedevice_maintenance_frequency' => 'Typedevice Maintenance Frequency',
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

		$criteria->compare('typedevice_id',$this->typedevice_id);
		$criteria->compare('typedevice_denomination',$this->typedevice_denomination,true);
		$criteria->compare('typedevice_origin',$this->typedevice_origin,true);
		$criteria->compare('typedevice_modem',$this->typedevice_modem);
		$criteria->compare('typedevice_maintenance_frequency',$this->typedevice_maintenance_frequency);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TypeDevicesModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
