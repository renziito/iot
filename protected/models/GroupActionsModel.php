<?php

/**
 * This is the model class for table "rbac_group_actions".
 *
 * The followings are the available columns in table 'rbac_group_actions':
 * @property integer $groupaction_id
 * @property string $groupaction_name
 * @property string $groupaction_description
 * @property integer $groupaction_order
 * @property integer $groupaction_status
 * @property integer $status
 */
class GroupActionsModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rbac_group_actions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('groupaction_name', 'required'),
			array('groupaction_order, groupaction_status, status', 'numerical', 'integerOnly'=>true),
			array('groupaction_name', 'length', 'max'=>100),
			array('groupaction_description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('groupaction_id, groupaction_name, groupaction_description, groupaction_order, groupaction_status, status', 'safe', 'on'=>'search'),
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
			'groupaction_id' => 'Groupaction',
			'groupaction_name' => 'Groupaction Name',
			'groupaction_description' => 'Groupaction Description',
			'groupaction_order' => 'Groupaction Order',
			'groupaction_status' => 'Groupaction Status',
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

		$criteria->compare('groupaction_id',$this->groupaction_id);
		$criteria->compare('groupaction_name',$this->groupaction_name,true);
		$criteria->compare('groupaction_description',$this->groupaction_description,true);
		$criteria->compare('groupaction_order',$this->groupaction_order);
		$criteria->compare('groupaction_status',$this->groupaction_status);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GroupActionsModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
