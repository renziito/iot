<?php

/**
 * This is the model class for table "rbac_actions".
 *
 * The followings are the available columns in table 'rbac_actions':
 * @property integer $action_id
 * @property integer $groupaction_id
 * @property string $action_key
 * @property string $action_name
 * @property string $action_description
 * @property integer $action_status
 * @property integer $status
 */
class ActionsModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rbac_actions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('groupaction_id, action_key, action_name', 'required'),
			array('groupaction_id, action_status, status', 'numerical', 'integerOnly'=>true),
			array('action_key, action_name', 'length', 'max'=>100),
			array('action_description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('action_id, groupaction_id, action_key, action_name, action_description, action_status, status', 'safe', 'on'=>'search'),
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
			'action_id' => 'Action',
			'groupaction_id' => 'Groupaction',
			'action_key' => 'Action Key',
			'action_name' => 'Action Name',
			'action_description' => 'Action Description',
			'action_status' => 'Action Status',
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

		$criteria->compare('action_id',$this->action_id);
		$criteria->compare('groupaction_id',$this->groupaction_id);
		$criteria->compare('action_key',$this->action_key,true);
		$criteria->compare('action_name',$this->action_name,true);
		$criteria->compare('action_description',$this->action_description,true);
		$criteria->compare('action_status',$this->action_status);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActionsModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
