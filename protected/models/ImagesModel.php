<?php

/**
 * This is the model class for table "images".
 *
 * The followings are the available columns in table 'images':
 * @property integer $image_id
 * @property string $image_name
 * @property string $image_mimetype
 * @property string $image_extension
 * @property string $image_size
 * @property string $date_create
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Banners[] $banners
 */
class ImagesModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'images';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image_name, image_mimetype, image_extension, image_size', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('image_name, image_mimetype', 'length', 'max'=>255),
			array('image_extension', 'length', 'max'=>10),
			array('image_size', 'length', 'max'=>15),
			array('date_create', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('image_id, image_name, image_mimetype, image_extension, image_size, date_create, status', 'safe', 'on'=>'search'),
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
			'banners' => array(self::HAS_MANY, 'Banners', 'image_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'image_id' => 'Image',
			'image_name' => 'Image Name',
			'image_mimetype' => 'Image Mimetype',
			'image_extension' => 'Image Extension',
			'image_size' => 'Image Size',
			'date_create' => 'Date Create',
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

		$criteria->compare('image_id',$this->image_id);
		$criteria->compare('image_name',$this->image_name,true);
		$criteria->compare('image_mimetype',$this->image_mimetype,true);
		$criteria->compare('image_extension',$this->image_extension,true);
		$criteria->compare('image_size',$this->image_size,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ImagesModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
