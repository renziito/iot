<?php

/**
 * This is the model class for table "menu.navigation_favorites".
 *
 * The followings are the available columns in table 'menu.navigation_favorites':
 * @property integer $navigationfavorite_id
 * @property integer $user_id
 * @property string $navigationfavorite_name
 * @property string $navigationfavorite_url
 * @property boolean $status
 */
class NavigationFavoritesModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'menu.navigation_favorites';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, navigationfavorite_name, navigationfavorite_url', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('navigationfavorite_name, navigationfavorite_url', 'length', 'max'=>255),
			array('status', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('navigationfavorite_id, user_id, navigationfavorite_name, navigationfavorite_url, status', 'safe', 'on'=>'search'),
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
			'navigationfavorite_id' => 'Navigationfavorite',
			'user_id' => 'User',
			'navigationfavorite_name' => 'Navigationfavorite Name',
			'navigationfavorite_url' => 'Navigationfavorite Url',
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

		$criteria->compare('navigationfavorite_id',$this->navigationfavorite_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('navigationfavorite_name',$this->navigationfavorite_name,true);
		$criteria->compare('navigationfavorite_url',$this->navigationfavorite_url,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NavigationFavoritesModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
