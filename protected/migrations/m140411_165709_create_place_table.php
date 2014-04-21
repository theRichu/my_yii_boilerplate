<?php

class m140411_165709_create_place_table extends CDbMigration
{
	public function safeUp()
	{
	  $this->createTable('tbl_places', array(
	    'id' => 'pk',
	    'name' => 'string NOT NULL',
	    'address' => 'string NOT NULL',
	    'state' => 'varchar(45) NOT NULL',
	    'city' => 'varchar(45) NOT NULL',
	    'district' => 'varchar(45) NOT NULL',
	    'description' => 'text DEFAULT NULL',
	    'map_lat' => 'FLOAT(20, 15) DEFAULT NULL',
	    'map_lag' => 'FLOAT(20, 15) DEFAULT NULL',
	    'create_time' => 'datetime DEFAULT NULL',
	    'create_user_id' => 'integer NOT NULL',
	    'update_time' => 'datetime DEFAULT NULL',
	    'update_user_id' => 'integer DEFAULT NULL',
	  ), 'ENGINE=InnoDB');
	  
	  $this->createTable('tbl_options', array(
	  		'id' => 'pk',
	  		'name' => 'string NOT NULL',
	  		'type' => 'integer NOT NULL',
	  		'description' => 'string DEFAULT NULL',
	  		'create_time' => 'datetime DEFAULT NULL',
	  		'create_user_id' => 'integer NOT NULL',
	  		'update_time' => 'datetime DEFAULT NULL',
	  		'update_user_id' => 'integer DEFAULT NULL',
	  ), 'ENGINE=InnoDB');
	   
	  $this->createTable('tbl_place_services', array(
	  		'id' => 'pk',
	  		'place_id' => 'integer NOT NULL',
	  		'option_id' => 'integer NOT NULL',
	  		'type' => 'integer DEFAULT NULL',
	  		'price' => 'integer DEFAULT NULL',
	  		'description' => 'text DEFAULT NULL',
	  		'create_time' => 'datetime DEFAULT NULL',
	  		'create_user_id' => 'integer NOT NULL',
	  		'update_time' => 'datetime DEFAULT NULL',
	  		'update_user_id' => 'integer DEFAULT NULL',
	  ), 'ENGINE=InnoDB');
	  $this->addForeignKey("fk_place_services_options", "tbl_place_services", "option_id", "tbl_options", "id", "CASCADE", "RESTRICT");
	  $this->addForeignKey("fk_place_services_places", "tbl_place_services", "place_id", "tbl_places", "id", "CASCADE", "RESTRICT");
	   
	  
	  $this->createTable('tbl_places_has_users', array(
	    'user_id' => 'integer NOT NULL',
	    'place_id' => 'integer NOT NULL',
	    'PRIMARY KEY (`user_id`,`place_id`)',
	  ), 'ENGINE=InnoDB');
	  //the tbl_project_user_assignment.project_id is a reference to tbl_project.id
	  $this->addForeignKey("fk_places_users", "tbl_places_has_users", "place_id", "tbl_places", "id", "CASCADE", "RESTRICT");
	  //the tbl_project_user_assignment.user_id is a reference to tbl_user.id
	  $this->addForeignKey("fk_users_places", "tbl_places_has_users", "user_id", "tbl_users", "id", "CASCADE", "RESTRICT");

	  
	  $this->createTable('tbl_place_images', array(
	  		'id' => 'pk',
	  		'place_id' => 'integer NOT NULL',
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
	  $this->addForeignKey("fk_place_images_places", "tbl_place_images", "place_id", "tbl_places", "id", "CASCADE", "RESTRICT");
	   

	  /*
	  $this->createTable('tbl_images', array(
	    'id' => 'pk',
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


	  $this->createTable('tbl_places_has_images', array(
	  		'image_id' => 'integer NOT NULL',
	  		'place_id' => 'integer NOT NULL',
	  		'PRIMARY KEY (`image_id`,`place_id`)',
	  ), 'ENGINE=InnoDB');
	  //the tbl_project_image_assignment.project_id is a reference to tbl_project.id
	  $this->addForeignKey("fk_places_images", "tbl_places_has_images", "place_id", "tbl_places", "id", "CASCADE", "RESTRICT");
	  //the tbl_project_image_assignment.image_id is a reference to tbl_image.id
	  $this->addForeignKey("fk_images_places", "tbl_places_has_images", "image_id", "tbl_images", "id", "CASCADE", "RESTRICT");
	   
	  */
	  
	  $this->createTable('tbl_comments', array(
	    'id' => 'pk',
	  	'patent_id' => 'integer DEFAULT NULL',	 
	  	'type' => 'integer DEFAULT NULL',
	    'content' => 'text NOT NULL',
	    'create_time' => 'datetime DEFAULT NULL',
	    'create_user_id' => 'integer NOT NULL',
	    'update_time' => 'datetime DEFAULT NULL',
	    'update_user_id' => 'integer DEFAULT NULL',
	  ), 'ENGINE=InnoDB');
	}

	public function safeDown()
	{
		$this->truncateTable('tbl_comments');
		$this->dropTable('tbl_comments');
		/*
		$this->truncateTable('tbl_images');
		$this->dropTable('tbl_images');
		$this->truncateTable('tbl_places_has_users');
		$this->dropTable('tbl_places_has_users');
		$this->truncateTable('tbl_places_has_images');
		$this->dropTable('tbl_places_has_images');
		*/
		$this->truncateTable('tbl_place_images');
		$this->dropTable('tbl_place_images');
		$this->truncateTable('tbl_place_services');
		$this->dropTable('tbl_place_services');
		$this->truncateTable('tbl_options');
		$this->dropTable('tbl_options');
		$this->truncateTable('tbl_places');
		$this->dropTable('tbl_places');
	}

}