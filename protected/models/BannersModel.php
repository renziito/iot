<?php

/**
 * This is the model class for table "banners".
 *
 * The followings are the available columns in table 'banners':
 * @property integer $banner_id
 * @property integer $image_id
 * @property string $banner_title
 * @property string $banner_description
 * @property integer $banner_order
 * @property integer $active
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Images $image
 */
class BannersModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'banners';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image_id, banner_title, banner_description, banner_order', 'required'),
			array('image_id, banner_order, active, status', 'numerical', 'integerOnly'=>true),
			array('banner_title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('banner_id, image_id, banner_title, banner_description, banner_order, active, status', 'safe', 'on'=>'search'),
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
			'image' => array(self::BELONGS_TO, 'Images', 'image_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'banner_id' => 'Banner',
			'image_id' => 'Image',
			'banner_title' => 'Banner Title',
			'banner_description' => 'Banner Description',
			'banner_order' => 'Banner Order',
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

		$criteria->compare('banner_id',$this->banner_id);
		$criteria->compare('image_id',$this->image_id);
		$criteria->compare('banner_title',$this->banner_title,true);
		$criteria->compare('banner_description',$this->banner_description,true);
		$criteria->compare('banner_order',$this->banner_order);
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
	 * @return BannersModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
