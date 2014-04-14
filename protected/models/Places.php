<?php

/**
 * This is the model class for table "{{places}}".
 *
 * The followings are the available columns in table '{{places}}':
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $description
 * @property double $map_lat
 * @property double $map_lag
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 *
 * The followings are the available model relations:
 * @property PlaceComments[] $placeComments
 * @property PlaceImages[] $placeImages
 * @property Rooms[] $rooms
 * @property Users[] $tblUsers
 */
class Places extends StoryBoxActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{places}}';
	}

	public static function label($n = 1) {
	  return Yii::t('app', '장소|장소들', $n);
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('map_lat, map_lag', 'numerical'),
		  array('state, city, district','length', 'max'=>45),
			array('name, address', 'length', 'max'=>255),
			array('description, create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, address, description, map_lat, map_lag, state, city, district, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
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
			'placeComments' => array(self::HAS_MANY, 'PlaceComments', 'place_id'),
			'placeImages' => array(self::HAS_MANY, 'PlaceImages', 'place_id'),
			'rooms' => array(self::HAS_MANY, 'Rooms', 'place_id'),
		  'creater' => array(self::BELONGS_TO, 'User', 'create_user_id'),
		  'updater' => array(self::BELONGS_TO, 'User', 'update_user_id'),
			'tblUsers' => array(self::MANY_MANY, 'Users', '{{users_has_places}}(place_id, user_id)'),
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
			'address' => 'Address',
			'description' => 'Description',
			'map_lat' => 'Map Lat',
			'map_lag' => 'Map Lag',
			'state' => 'State',
			'city' => 'City',
			'district' => 'Districts',
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
		
		$criteria->with = array( 'Rooms' );

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('district',$this->distract,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('map_lat',$this->map_lat);
		$criteria->compare('map_lag',$this->map_lag);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Places the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
