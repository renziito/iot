<?php

/**
 * This is the model class for table "user_roles".
 *
 * The followings are the available columns in table 'user_roles':
 * @property integer $userrole_id
 * @property integer $user_id
 * @property integer $role_id
 * @property string $userrole_date_created
 * @property string $userrole_date_updated
 * @property integer $userrole_status
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property RbacRoles $role
 */
class UserRolesModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_roles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, role_id', 'required'),
			array('user_id, role_id, userrole_status, status', 'numerical', 'integerOnly'=>true),
			array('userrole_date_created, userrole_date_updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('userrole_id, user_id, role_id, userrole_date_created, userrole_date_updated, userrole_status, status', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'role' => array(self::BELONGS_TO, 'RbacRoles', 'role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userrole_id' => 'Userrole',
			'user_id' => 'User',
			'role_id' => 'Role',
			'userrole_date_created' => 'Userrole Date Created',
			'userrole_date_updated' => 'Userrole Date Updated',
			'userrole_status' => 'Userrole Status',
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

		$criteria->compare('userrole_id',$this->userrole_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('userrole_date_created',$this->userrole_date_created,true);
		$criteria->compare('userrole_date_updated',$this->userrole_date_updated,true);
		$criteria->compare('userrole_status',$this->userrole_status);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserRolesModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
