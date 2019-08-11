<?php

/**
 * This is the model class for table "log_events".
 *
 * The followings are the available columns in table 'log_events':
 * @property integer $logevent_id
 * @property integer $action_id
 * @property integer $usersession_id
 * @property integer $logevent_code
 * @property string $logevent_message
 * @property string $logevent_params
 * @property integer $logevent_public
 * @property string $logevent_date_created
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property RbacActions $action
 * @property UserSessions $usersession
 */
class LogEventsModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'log_events';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('action_id, usersession_id, logevent_code, logevent_message, logevent_params, logevent_date_created', 'required'),
			array('action_id, usersession_id, logevent_code, logevent_public, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('logevent_id, action_id, usersession_id, logevent_code, logevent_message, logevent_params, logevent_public, logevent_date_created, status', 'safe', 'on'=>'search'),
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
			'action' => array(self::BELONGS_TO, 'RbacActions', 'action_id'),
			'usersession' => array(self::BELONGS_TO, 'UserSessions', 'usersession_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'logevent_id' => 'Logevent',
			'action_id' => 'Action',
			'usersession_id' => 'Usersession',
			'logevent_code' => 'Logevent Code',
			'logevent_message' => 'Logevent Message',
			'logevent_params' => 'Logevent Params',
			'logevent_public' => 'Logevent Public',
			'logevent_date_created' => 'Logevent Date Created',
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

		$criteria->compare('logevent_id',$this->logevent_id);
		$criteria->compare('action_id',$this->action_id);
		$criteria->compare('usersession_id',$this->usersession_id);
		$criteria->compare('logevent_code',$this->logevent_code);
		$criteria->compare('logevent_message',$this->logevent_message,true);
		$criteria->compare('logevent_params',$this->logevent_params,true);
		$criteria->compare('logevent_public',$this->logevent_public);
		$criteria->compare('logevent_date_created',$this->logevent_date_created,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LogEventsModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
