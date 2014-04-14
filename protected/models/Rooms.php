<?php

/**
 * This is the model class for table "{{rooms}}".
 *
 * The followings are the available columns in table '{{rooms}}':
 * @property integer $id
 * @property string $name
 * @property integer $place_id
 * @property integer $capacity
 * @property integer $floorspace
 * @property string $contactnumber
 * @property string $workstart
 * @property string $workto
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 *
 * The followings are the available model relations:
 * @property Notices[] $notices
 * @property RoomCharges[] $roomCharges
 * @property RoomComments[] $roomComments
 * @property RoomImages[] $roomImages
 * @property RoomOptions[] $roomOptions
 * @property Places $place
 */
class Rooms extends StoryBoxActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{rooms}}';
	}

	public static function label($n = 1) {
	  return Yii::t('app', '공간|공간들', $n);
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, place_id', 'required'),
			array('place_id, capacity, floorspace, create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('name, contactnumber', 'length', 'max'=>255),
			array('workstart, workto, create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, place_id, capacity, floorspace, contactnumber, workstart, workto, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
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
			'notices' => array(self::HAS_MANY, 'Notices', 'room_id'),
			'roomCharges' => array(self::HAS_MANY, 'RoomCharges', 'room_id'),
			'roomComments' => array(self::HAS_MANY, 'RoomComments', 'room_id'),
			'roomImages' => array(self::HAS_MANY, 'RoomImages', 'room_id'),
			'roomOptions' => array(self::HAS_MANY, 'RoomOptions', 'room_id'),
			'places' => array(self::BELONGS_TO, 'Places', 'place_id'),
		  'creater' => array(self::BELONGS_TO, 'User', 'create_user_id'),
		  'updater' => array(self::BELONGS_TO, 'User', 'update_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'place_id' => 'Place',
			'capacity' => 'Capacity',
			'floorspace' => 'Floorspace',
			'contactnumber' => 'Contactnumber',
			'workstart' => 'Workstart',
			'workto' => 'Workto',
			'create_time' => 'Create Time',
			'create_user_id' => 'Create User',
			'update_time' => 'Update Time',
			'update_user_id' => 'Update User',
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

		
//		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('Places.name',$this->place_name, true);
		
		$criteria->compare('RoomOptions.name',$this->option_name, true);
		$criteria->compare('RoomCharges.price',$this->price, true);
		
		
		
		//$criteria->compare('place_id',$this->place_id);
		$criteria->compare('capacity',$this->capacity);
		$criteria->compare('floorspace',$this->floorspace);
		//$criteria->compare('contactnumber',$this->contactnumber,true);
		$criteria->compare('workstart',$this->workstart,true);
		$criteria->compare('workto',$this->workto,true);
		//$criteria->compare('create_time',$this->create_time,true);
		//$criteria->compare('create_user_id',$this->create_user_id);
		//$criteria->compare('update_time',$this->update_time,true);
		//$criteria->compare('update_user_id',$this->update_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function getStateOptions()
	{
	  $data=Places::model()->findAll();
	  $data=CHtml::listData($data,'state','state');
	  return $data;
	}
	public function getCityOptions($state)
	{
	  $data=Places::model()->findAll('state=:state', array(':state'=>$state));

	  $data=CHtml::listData($data,'city','city');
	  return $data;
	}
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Rooms the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
