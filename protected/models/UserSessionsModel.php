<?php

/**
 * This is the model class for table "user_sessions".
 *
 * The followings are the available columns in table 'user_sessions':
 * @property integer $usersession_id
 * @property integer $user_id
 * @property string $usersession_token
 * @property string $usersession_host
 * @property string $usersession_os
 * @property string $usersession_browser
 * @property string $usersession_browser_version
 * @property string $usersession_device
 * @property string $usersession_geoip
 * @property string $usersession_date_created
 * @property string $usersession_date_expired
 * @property integer $usersession_status
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property LogEvents[] $logEvents
 * @property Users $user
 */
class UserSessionsModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_sessions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('user_id, usersession_status, status', 'numerical', 'integerOnly'=>true),
			array('usersession_token', 'length', 'max'=>40),
			array('usersession_host, usersession_os, usersession_browser, usersession_browser_version, usersession_device', 'length', 'max'=>255),
			array('usersession_geoip, usersession_date_created, usersession_date_expired', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('usersession_id, user_id, usersession_token, usersession_host, usersession_os, usersession_browser, usersession_browser_version, usersession_device, usersession_geoip, usersession_date_created, usersession_date_expired, usersession_status, status', 'safe', 'on'=>'search'),
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
			'logEvents' => array(self::HAS_MANY, 'LogEvents', 'usersession_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'usersession_id' => 'Usersession',
			'user_id' => 'User',
			'usersession_token' => 'Usersession Token',
			'usersession_host' => 'Usersession Host',
			'usersession_os' => 'Usersession Os',
			'usersession_browser' => 'Usersession Browser',
			'usersession_browser_version' => 'Usersession Browser Version',
			'usersession_device' => 'Usersession Device',
			'usersession_geoip' => 'Usersession Geoip',
			'usersession_date_created' => 'Usersession Date Created',
			'usersession_date_expired' => 'Usersession Date Expired',
			'usersession_status' => 'Usersession Status',
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

		$criteria->compare('usersession_id',$this->usersession_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('usersession_token',$this->usersession_token,true);
		$criteria->compare('usersession_host',$this->usersession_host,true);
		$criteria->compare('usersession_os',$this->usersession_os,true);
		$criteria->compare('usersession_browser',$this->usersession_browser,true);
		$criteria->compare('usersession_browser_version',$this->usersession_browser_version,true);
		$criteria->compare('usersession_device',$this->usersession_device,true);
		$criteria->compare('usersession_geoip',$this->usersession_geoip,true);
		$criteria->compare('usersession_date_created',$this->usersession_date_created,true);
		$criteria->compare('usersession_date_expired',$this->usersession_date_expired,true);
		$criteria->compare('usersession_status',$this->usersession_status);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserSessionsModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
