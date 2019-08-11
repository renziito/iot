<?php

/**
 * This is the model class for table "lists".
 *
 * The followings are the available columns in table 'lists':
 * @property integer $list_id
 * @property string $list_code
 * @property string $list_name
 * @property string $list_resumen
 * @property integer $list_status
 * @property integer $active
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property ListDevices[] $listDevices
 * @property ListResponsables[] $listResponsables
 * @property ListUsers[] $listUsers
 */
class ListsModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lists';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('list_code, list_name', 'required'),
			array('list_status, active, status', 'numerical', 'integerOnly'=>true),
			array('list_code', 'length', 'max'=>10),
			array('list_name', 'length', 'max'=>255),
			array('list_resumen', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('list_id, list_code, list_name, list_resumen, list_status, active, status', 'safe', 'on'=>'search'),
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
			'listDevices' => array(self::HAS_MANY, 'ListDevices', 'list_id'),
			'listResponsables' => array(self::HAS_MANY, 'ListResponsables', 'list_id'),
			'listUsers' => array(self::HAS_MANY, 'ListUsers', 'list_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'list_id' => 'List',
			'list_code' => 'List Code',
			'list_name' => 'List Name',
			'list_resumen' => 'List Resumen',
			'list_status' => 'List Status',
			'active' => 'Active',
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

		$criteria->compare('list_id',$this->list_id);
		$criteria->compare('list_code',$this->list_code,true);
		$criteria->compare('list_name',$this->list_name,true);
		$criteria->compare('list_resumen',$this->list_resumen,true);
		$criteria->compare('list_status',$this->list_status);
		$criteria->compare('active',$this->active);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ListsModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
