<?php

/**
 * This is the model class for table "{{room_images}}".
 *
 * The followings are the available columns in table '{{room_images}}':
 * @property integer $id
 * @property string $caption
 * @property string $content
 * @property string $filename
 * @property integer $room_id
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 *
 * The followings are the available model relations:
 * @property Rooms $room
 */
class RoomImages extends StoryBoxActiveRecord {
	/**
	 *
	 * @return string the associated database table name
	 */
	public $photo;
	public function tableName() {
		return '{{room_images}}';
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
						'photo',
						'file',
						'types' => 'jpg, gif, png',
						'maxSize' => 1024 * 1024 * 5,
						'on' => 'insert' ,
						'safe' => true ,
						'allowEmpty' => true,
				),
				array (
						'photo',
						'file',
						'allowEmpty' => true,
						'types' => 'jpg, gif, png',
						'maxSize' => 1024 * 1024 * 5,
						'on' => 'update' ,
						'safe' => true
				),

				array (
						'create_user_id, update_user_id',
						'numerical',
						'integerOnly' => true 
				),
				array (
						'title, filename',
						'length',
						'max' => 255 
				),
				array (
						'description, create_time, update_time',
						'safe' 
				),
				// The following rule is used by search().
				// @todo Please remove those attributes that should not be searched.
				array (
						'id, title, description, filename, room_id, create_time, create_user_id, update_time, update_user_id',
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
				'room' => array (
						self::BELONGS_TO,
						'Rooms',
						'room_id' 
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
				'caption' => 'Caption',
				'content' => 'Content',
				'filename' => 'Filename',
				'room_id' => 'Room',
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
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria = new CDbCriteria ();
		
		$criteria->compare ( 'id', $this->id );
		$criteria->compare ( 'caption', $this->caption, true );
		$criteria->compare ( 'content', $this->content, true );
		$criteria->compare ( 'filename', $this->filename, true );
		$criteria->compare ( 'room_id', $this->room_id );
		$criteria->compare ( 'create_time', $this->create_time, true );
		$criteria->compare ( 'create_user_id', $this->create_user_id );
		$criteria->compare ( 'update_time', $this->update_time, true );
		$criteria->compare ( 'update_user_id', $this->update_user_id );
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria 
		) );
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className
	 *        	active record class name.
	 * @return RoomImages the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
}