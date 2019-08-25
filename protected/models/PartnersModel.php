<?php

/**
 * This is the model class for table "partners".
 *
 * The followings are the available columns in table 'partners':
 * @property integer $partner_id
 * @property string $image_id
 * @property string $partner_name
 * @property string $partner_url
 * @property string $partner_description
 * @property integer $partner_order
 * @property integer $status
 */
class PartnersModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'partners';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image_id, partner_name, partner_url', 'required'),
			array('partner_order, status', 'numerical', 'integerOnly'=>true),
			array('image_id, partner_name', 'length', 'max'=>255),
			array('partner_description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('partner_id, image_id, partner_name, partner_url, partner_description, partner_order, status', 'safe', 'on'=>'search'),
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
			'partner_id' => 'Partner',
			'image_id' => 'Image',
			'partner_name' => 'Partner Name',
			'partner_url' => 'Partner Url',
			'partner_description' => 'Partner Description',
			'partner_order' => 'Partner Order',
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

		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('image_id',$this->image_id,true);
		$criteria->compare('partner_name',$this->partner_name,true);
		$criteria->compare('partner_url',$this->partner_url,true);
		$criteria->compare('partner_description',$this->partner_description,true);
		$criteria->compare('partner_order',$this->partner_order);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PartnersModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
