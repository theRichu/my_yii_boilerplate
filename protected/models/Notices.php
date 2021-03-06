<?php

/**
 * This is the model class for table "{{notices}}".
 *
 * The followings are the available columns in table '{{notices}}':
 * @property integer $id
 * @property integer $room_id
 * @property string $from
 * @property string $to
 * @property integer $specialprice
 * @property integer $payment
 * @property integer $status
 * @property string $contactnumber
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 *
 * The followings are the available model relations:
 * @property Rooms $room
 * @property Reservations[] $reservations
 */
class Notices extends StoryBoxActiveRecord
{
  
  const STATUS_OPEN=0;
  const STATUS_PROCESS=1;
  const STATUS_CANCELED=2;
  const STATUS_COMPLETE=3;
  

  const PAYMENT_ONLINE=0;
  const PAYMENT_OFFLINE=1;
  const PAYMENT_TRANSFER=2;
  
  
  public static function getStatusOptions()
  {
    return array(
      self::STATUS_OPEN => '예약 가능',
      self::STATUS_PROCESS => '예약 진행중',
      self::STATUS_CANCELED => '예약 취소',
      self::STATUS_COMPLETE => '예약 완료',
      );
  }
  
  
  public static function getStatusColor()
  {
    return array(
      self::STATUS_OPEN => 'blue',
      self::STATUS_PROCESS => 'orange',
      self::STATUS_CANCELED => 'red',
      self::STATUS_COMPLETE => 'green',
    );
  }
  public static function getAllowedStatusRange()
  {
    return array(
      self::STATUS_OPEN,
      self::STATUS_PROCESS,
      self::STATUS_CANCELED,
      self::STATUS_COMPLETE,
      );
 }

  public function getStatusText()
  {
    $statusOptions=$this->getStatusOptions();

    return isset($statusOptions[$this->status])?$statusOptions[$this->status]:"unknown({$this->status})";
  }


  public static function getPaymentOptions()
  {
    return array(
      self::PAYMENT_ONLINE => '무통장 입금',
      self::PAYMENT_OFFLINE => '현장납부',
      self::PAYMENT_TRANSFER => '온라인 송금',
    );
  }
  
  public function getPaymentText()
  {
    $paymentOptions=$this->getPaymentOptions();
    
    return isset($paymentOptions[$this->payment])?$paymentOptions[$this->payment]:"unknown({$this->payment})";
  }

  public static function getAllowedPaymentRange()
  {
    return array(
      self::PAYMENT_ONLINE,
      self::PAYMENT_OFFLINE,
      self::PAYMENT_TRANSFER,
    );
  }
  
  
  
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{notices}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('from, to', 'required'),
			array('specialprice, payment, status, create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('contactnumber', 'length', 'max'=>255),
			array('create_time, update_time', 'safe'),
		  
		  array('from, to ', 'date', 'format'=>array('yyyy-MM-dd hh:mm','yyyy-MM-dd hh:mm'), 'allowEmpty'=>true),
		  array('to','compare','compareAttribute'=>'from','operator'=>'>','on'=>'insert','message'=>'종료일시는 시작일시 이후여야 합니다.'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, from, to, specialprice, payment, status, contactnumber, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
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
			'room' => array(self::BELONGS_TO, 'Rooms', 'room_id'),
			'reservations' => array(self::HAS_MANY, 'Reservations', 'notice_id'),
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
			'room_id' => 'Room',
			'from' => 'From',
			'to' => 'To',
			'specialprice' => 'Specialprice',
			'payment' => 'Payment',
			'status' => 'Status',
			'contactnumber' => 'Contactnumber',
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
		$criteria->compare('room_id',$this->room_id);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('to',$this->to,true);
		$criteria->compare('specialprice',$this->specialprice);
		$criteria->compare('payment',$this->payment);
		$criteria->compare('status',$this->status);
		$criteria->compare('contactnumber',$this->contactnumber,true);
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
	 * @return Notices the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
