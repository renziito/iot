<?php

/**
 * This is the model class for table "list_responsables".
 *
 * The followings are the available columns in table 'list_responsables':
 * @property integer $listresponsable_id
 * @property integer $list_id
 * @property integer $responsable_id
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Lists $list
 * @property Responsables $responsable
 */
class ListResponsablesModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'list_responsables';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('list_id, responsable_id', 'required'),
			array('list_id, responsable_id, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('listresponsable_id, list_id, responsable_id, status', 'safe', 'on'=>'search'),
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
			'list' => array(self::BELONGS_TO, 'Lists', 'list_id'),
			'responsable' => array(self::BELONGS_TO, 'Responsables', 'responsable_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'listresponsable_id' => 'Listresponsable',
			'list_id' => 'List',
			'responsable_id' => 'Responsable',
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

		$criteria->compare('listresponsable_id',$this->listresponsable_id);
		$criteria->compare('list_id',$this->list_id);
		$criteria->compare('responsable_id',$this->responsable_id);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ListResponsablesModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
