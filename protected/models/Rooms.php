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
class Rooms extends StoryBoxActiveRecord {
	
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{rooms}}';
	}
	public static function label($n = 1) {
		return Yii::t ( 'app', '공간|공간들', $n );
	}
	
	/**
	 *
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array (
				array (
						'name, place_id',
						'required' 
				),
				array (
						'place_id, capacity, floorspace, create_user_id, update_user_id',
						'numerical',
						'integerOnly' => true 
				),
				array (
						'name, contactnumber',
						'length',
						'max' => 255 
				),
				array (
						'workstart, workto, create_time, update_time',
						'safe' 
				),
				// The following rule is used by search().
				// @todo Please remove those attributes that should not be searched.
				array (
						'id, name, place_id, capacity, floorspace, contactnumber, workstart, workto, create_time, create_user_id, update_time, update_user_id',
						'safe',
						'on' => 'search' 
				) 
		);
	}
	
	/**
	 *
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array (
				'notices' => array (
						self::HAS_MANY,
						'Notices',
						'room_id' 
				),
				'roomCharges' => array (
						self::HAS_MANY,
						'RoomCharges',
						'room_id' 
				),
				'roomComments' => array (
						self::HAS_MANY,
						'RoomComments',
						'room_id' 
				),
				'roomImages' => array (
						self::HAS_MANY,
						'RoomImages',
						'room_id' 
				),
				'roomOptions' => array (
						self::HAS_MANY,
						'RoomOptions',
						'room_id' 
				),
				'places' => array (
						self::BELONGS_TO,
						'Places',
						'place_id' 
				),
				'creater' => array (
						self::BELONGS_TO,
						'User',
						'create_user_id' 
				),
				'updater' => array (
						self::BELONGS_TO,
						'User',
						'update_user_id' 
				) 
		);
	}
	
	/**
	 *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array (
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
				'update_user_id' => 'Update User' 
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
	 *         based on the search/filter conditions.
	 */
	public function search() {
		fb ( "IN SEARCH" );
		

		$state = Yii::app()->request->getQuery('state');
		$city = Yii::app()->request->getQuery('city');
		$p = Yii::app()->request->getQuery('p');
		$q = Yii::app()->request->getQuery('q');	
		$options = Yii::app()->request->getQuery('option');
		
		$price_min = Yii::app()->request->getQuery('slider_priceleft');
		$price_max = Yii::app()->request->getQuery('slider_priceright');

		
		$criteria = new CDbCriteria ();
		$criteria->with = array (
				'places' => array (
						'alias' => 'pl' ,
						'together' => false,
				),
				'roomOptions' => array (
						'alias' => 'ro',
						'select' => false,
						'together' => true,
				),
				'roomCharges' => array (
						'alias' => 'rc',
						'select' => false,
						'together' => true,
				)
				
		);

		// $criteria->with = array( 'roomCharges' );
		
		if (isset ( $state ) && $state != '') {
			$criteria->compare ( 'pl.state', $state, false );
		}
		if (isset ( $city ) && $city != '') {
			$criteria->compare ( 'pl.city', $city, false );
		}
		if (isset ( $p ) && $p != '') {
			$criteria->compare ( 't.capacity', '>=' . $p );
		}
		
		if (isset ( $q ) && $q != '') {
			$criteria->compare ( 'pl.name', $q, true, 'OR' );
			$criteria->compare ( 'pl.description', $q, true, 'OR' );
		}
		
		if (isset ( $options ) && $options != ['']) {
			//fb(gettype($options));
			foreach($options as $option){
				$criteria->compare ( 'ro.option_id', $option, true, 'AND' );					
			}
		}
		
		if (isset ( $price_min ) && $price_min != '') {
			$criteria->compare ( 'rc.price', '>='.$price_min);
		}
		if (isset ( $price_max ) && $price_max != '') {
			$criteria->compare ( 'rc.price', '<='.$price_max);
		}
		
		/*
		 * if(isset($max_price) && $max_price!='') $criteria->compare('rc.price > '.$max_price, false); if(isset($min_price) && $min_price!='') $criteria->compare('rc.price < '.$min_price, false);
		 */
		

		/*
		//To get Max/Min
		$criteria_max = $criteria;
		$criteria_max->select = 'MAX(rc.price) as maxprice';
		$max = Rooms::model()->find($criteria);
		fb($max);
		$criteria_min = $criteria;
		//$criteria_min->select = 'MIN(rc.price) as minprice';
		$min = Rooms::model()->find($criteria);
		fb($min);
		*/
		

		$pagination = array (
				'pageSize' => 3,
				'pageVar' => 'page' 
		);
		$dp = new CActiveDataProvider ( $this, array (
				'criteria' => $criteria,
				'pagination' => $pagination 
		) );

		return $dp;
	}
	public function getStateOptions() {
		$data = Places::model ()->findAll ();
		$data = CHtml::listData ( $data, 'state', 'state' );
		return $data;
	}
	public function getCityOptions($state) {
		$data = Places::model ()->findAll ( 'state=:state', array (
				':state' => $state 
		) );
		$data = CHtml::listData ( $data, 'city', 'city' );
		return $data;
	}
	function addComment(RoomComments $comment) {
		$comment->room_id = $this->id;
		
		// creating event class instance
		$event = new NewCommentEvent ( $this );
		$event->post = $this;
		$event->comment = $comment;
		
		// triggering event
		
		$this->onNewComment ( $event );
		return $event->isValid;
	}
	// defining onNewComment event
	public function onNewComment($event) {
		// Event is actually triggered here. This way we can use
		// onNewComment method instead of raiseEvent.
		$this->raiseEvent ( 'onNewComment', $event );
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * 
	 * @param string $className
	 *        	active record class name.
	 * @return Rooms the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
}