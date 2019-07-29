<?php

/**
 * This is the model class for table "rbac_roles".
 *
 * The followings are the available columns in table 'rbac_roles':
 * @property integer $role_id
 * @property string $role_key
 * @property string $role_name
 * @property string $role_description
 * @property integer $role_default
 * @property integer $role_status
 * @property integer $status
 */
class RolesModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rbac_roles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_key, role_name', 'required'),
			array('role_default, role_status, status', 'numerical', 'integerOnly'=>true),
			array('role_key, role_name', 'length', 'max'=>100),
			array('role_description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('role_id, role_key, role_name, role_description, role_default, role_status, status', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'role_id' => 'Role',
			'role_key' => 'Role Key',
			'role_name' => 'Role Name',
			'role_description' => 'Role Description',
			'role_default' => 'Role Default',
			'role_status' => 'Role Status',
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

		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('role_key',$this->role_key,true);
		$criteria->compare('role_name',$this->role_name,true);
		$criteria->compare('role_description',$this->role_description,true);
		$criteria->compare('role_default',$this->role_default);
		$criteria->compare('role_status',$this->role_status);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RolesModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
