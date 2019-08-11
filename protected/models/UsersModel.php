<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $user_id
 * @property string $user_username
 * @property string $user_password
 * @property string $user_firstname
 * @property string $user_lastname
 * @property string $user_email
 * @property string $user_phone
 * @property string $user_gender
 * @property string $user_birthdate
 * @property string $user_date_registered
 * @property string $user_date_updated
 * @property string $user_date_validated
 * @property string $user_date_lastlogin
 * @property integer $user_must_change_password
 * @property string $user_img_profile
 * @property integer $user_status
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property NavigationFavorites[] $navigationFavorites
 * @property ProjectUsers[] $listUsers
 * @property UserRoles[] $userRoles
 * @property UserSessions[] $userSessions
 */
class UsersModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_username, user_password, user_firstname, user_lastname, user_email, user_phone, user_gender, user_birthdate', 'required'),
			array('user_must_change_password, user_status, status', 'numerical', 'integerOnly'=>true),
			array('user_username, user_email, user_phone', 'length', 'max'=>50),
			array('user_password, user_firstname', 'length', 'max'=>100),
			array('user_lastname', 'length', 'max'=>200),
			array('user_gender', 'length', 'max'=>1),
			array('user_img_profile', 'length', 'max'=>255),
			array('user_date_registered, user_date_updated, user_date_validated, user_date_lastlogin', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, user_username, user_password, user_firstname, user_lastname, user_email, user_phone, user_gender, user_birthdate, user_date_registered, user_date_updated, user_date_validated, user_date_lastlogin, user_must_change_password, user_img_profile, user_status, status', 'safe', 'on'=>'search'),
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
			'navigationFavorites' => array(self::HAS_MANY, 'NavigationFavorites', 'user_id'),
			'listUsers' => array(self::HAS_MANY, 'ProjectUsers', 'user_id'),
			'userRoles' => array(self::HAS_MANY, 'UserRoles', 'user_id'),
			'userSessions' => array(self::HAS_MANY, 'UserSessions', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'user_username' => 'User Username',
			'user_password' => 'User Password',
			'user_firstname' => 'User Firstname',
			'user_lastname' => 'User Lastname',
			'user_email' => 'User Email',
			'user_phone' => 'User Phone',
			'user_gender' => 'User Gender',
			'user_birthdate' => 'User Birthdate',
			'user_date_registered' => 'User Date Registered',
			'user_date_updated' => 'User Date Updated',
			'user_date_validated' => 'User Date Validated',
			'user_date_lastlogin' => 'User Date Lastlogin',
			'user_must_change_password' => 'User Must Change Password',
			'user_img_profile' => 'User Img Profile',
			'user_status' => 'User Status',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_username',$this->user_username,true);
		$criteria->compare('user_password',$this->user_password,true);
		$criteria->compare('user_firstname',$this->user_firstname,true);
		$criteria->compare('user_lastname',$this->user_lastname,true);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('user_phone',$this->user_phone,true);
		$criteria->compare('user_gender',$this->user_gender,true);
		$criteria->compare('user_birthdate',$this->user_birthdate,true);
		$criteria->compare('user_date_registered',$this->user_date_registered,true);
		$criteria->compare('user_date_updated',$this->user_date_updated,true);
		$criteria->compare('user_date_validated',$this->user_date_validated,true);
		$criteria->compare('user_date_lastlogin',$this->user_date_lastlogin,true);
		$criteria->compare('user_must_change_password',$this->user_must_change_password);
		$criteria->compare('user_img_profile',$this->user_img_profile,true);
		$criteria->compare('user_status',$this->user_status);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsersModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
