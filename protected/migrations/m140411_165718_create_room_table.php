<?php

class m140411_165718_create_room_table extends CDbMigration
{
	public function safeUp()
	{
	  $this->createTable('tbl_rooms', array(
	    'id' => 'pk',
	    'name' => 'string NOT NULL',
	    'place_id' => 'integer NOT NULL',
	    'capacity' => 'integer DEFAULT NULL',
	    'floorspace' => 'integer DEFAULT NULL',
	    'contactnumber' => 'string DEFAULT NULL',
	    'workstart' => 'time DEFAULT NULL',
	    'workto' => 'time DEFAULT NULL',
 	    'create_time' => 'datetime DEFAULT NULL',
	    'create_user_id' => 'integer NOT NULL',
	    'update_time' => 'datetime DEFAULT NULL',
	    'update_user_id' => 'integer DEFAULT NULL',
	  ), 'ENGINE=InnoDB');
	  $this->addForeignKey("fk_rooms_places", "tbl_rooms", "place_id", "tbl_places", "id", "CASCADE", "RESTRICT");

	  
	  $this->createTable('tbl_room_images', array(
	  		'id' => 'pk',
	  		'room_id' => 'integer NOT NULL',
	  		'title' => 'string DEFAULT NULL',
	  		'description' => 'text DEFAULT NULL',
	  		'filename' => 'text DEFAULT NULL',
	  		'size' => 'integer DEFAULT NULL',
	  		'mime_type' => 'varchar(45) DEFAULT NULL',
	  		'create_time' => 'datetime DEFAULT NULL',
	  		'create_user_id' => 'integer NOT NULL',
	  		'update_time' => 'datetime DEFAULT NULL',
	  		'update_user_id' => 'integer DEFAULT NULL',
	  ), 'ENGINE=InnoDB');
	  $this->addForeignKey("fk_room_images_rooms", "tbl_room_images", "room_id", "tbl_rooms", "id", "CASCADE", "RESTRICT");
	  
	  /*
	  $this->createTable('tbl_rooms_has_images', array(
	  		'image_id' => 'integer NOT NULL',
	  		'room_id' => 'integer NOT NULL',
	  		'PRIMARY KEY (`image_id`,`room_id`)',
	  ), 'ENGINE=InnoDB');
	  //the tbl_project_image_assignment.project_id is a reference to tbl_project.id
	  $this->addForeignKey("fk_rooms_images", "tbl_rooms_has_images", "room_id", "tbl_rooms", "id", "CASCADE", "RESTRICT");
	  //the tbl_project_image_assignment.image_id is a reference to tbl_image.id
	  $this->addForeignKey("fk_images_rooms", "tbl_rooms_has_images", "image_id", "tbl_images", "id", "CASCADE", "RESTRICT");
	  	  */
	  
	  $this->createTable('tbl_room_options', array(
	    'id' => 'pk',
	    'room_id' => 'integer NOT NULL',
	    'option_id' => 'integer NOT NULL',
	    'price' => 'integer NOT NULL',
	    'description' => 'string DEFAULT NULL',
	    'create_time' => 'datetime DEFAULT NULL',
	    'create_user_id' => 'integer NOT NULL',
	    'update_time' => 'datetime DEFAULT NULL',
	    'update_user_id' => 'integer DEFAULT NULL',
	  ), 'ENGINE=InnoDB');
	  $this->addForeignKey("fk_room_options_options", "tbl_room_options", "option_id", "tbl_options", "id", "CASCADE", "RESTRICT");
	  $this->addForeignKey("fk_room_options_rooms", "tbl_room_options", "room_id", "tbl_rooms", "id", "CASCADE", "RESTRICT");

	  
	  $this->createTable('tbl_room_charges', array(
	    'id' => 'pk',
	    'room_id' => 'integer NOT NULL',
	    'price' => 'integer NOT NULL',
	    'description' => 'string DEFAULT NULL',
	    'create_time' => 'datetime DEFAULT NULL',
	    'create_user_id' => 'integer NOT NULL',
	    'update_time' => 'datetime DEFAULT NULL',
	    'update_user_id' => 'integer DEFAULT NULL',
	  ), 'ENGINE=InnoDB');
	  $this->addForeignKey("fk_room_charges_rooms", "tbl_room_charges", "room_id", "tbl_rooms", "id", "CASCADE", "RESTRICT");
	
	}

	public function safeDown()
	{
		$this->truncateTable('tbl_room_charges');
		$this->dropTable('tbl_room_charges');
		$this->truncateTable('tbl_room_options');
		$this->dropTable('tbl_room_options');
/* 		$this->truncateTable('tbl_rooms_has_images');
		$this->dropTable('tbl_rooms_has_images'); */
		$this->truncateTable('tbl_rooms_room_images');
		$this->dropTable('tbl_rooms_room_images');
		$this->truncateTable('tbl_rooms');
		$this->dropTable('tbl_rooms');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}