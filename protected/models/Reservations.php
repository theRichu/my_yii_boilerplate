<?php

/**
 * This is the model class for table "{{reservations}}".
 *
 * The followings are the available columns in table '{{reservations}}':
 * @property integer $id
 * @property integer $notice_id
 * @property integer $user_id
 * @property string $from
 * @property string $to
 * @property integer $people
 * @property integer $status
 * @property integer $additionalcharge
 * @property string $contactnumber
 * @property string $otherinfo
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 *
 * The followings are the available model relations:
 * @property ReservationComments[] $reservationComments
 * @property Notices $notice
 */
class Reservations extends StoryBoxActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{reservations}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('notice_id, user_id, from, to', 'required'),
			array('notice_id, user_id, people, status, additionalcharge, create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('contactnumber', 'length', 'max'=>255),
			array('otherinfo, create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, notice_id, user_id, from, to, people, status, additionalcharge, contactnumber, otherinfo, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
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
			'reservationComments' => array(self::HAS_MANY, 'ReservationComments', 'reservation_id'),
			'notice' => array(self::BELONGS_TO, 'Notices', 'notice_id'),
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
			'notice_id' => 'Notice',
			'user_id' => 'User',
			'from' => 'From',
			'to' => 'To',
			'people' => 'People',
			'status' => 'Status',
			'additionalcharge' => 'Additionalcharge',
			'contactnumber' => 'Contactnumber',
			'otherinfo' => 'Otherinfo',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('notice_id',$this->notice_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('to',$this->to,true);
		$criteria->compare('people',$this->people);
		$criteria->compare('status',$this->status);
		$criteria->compare('additionalcharge',$this->additionalcharge);
		$criteria->compare('contactnumber',$this->contactnumber,true);
		$criteria->compare('otherinfo',$this->otherinfo,true);
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
	 * @return Reservations the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
