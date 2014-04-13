<?php

class m140411_165709_create_place_table extends CDbMigration
{
	public function up()
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
	    'create_user_id' => 'integer DEFAULT NULL',
	    'update_time' => 'datetime DEFAULT NULL',
	    'update_user_id' => 'integer DEFAULT NULL',
	  ), 'ENGINE=InnoDB');
	  
	  $this->createTable('tbl_users_has_places', array(
	    'user_id' => 'integer NOT NULL',
	    'place_id' => 'integer NOT NULL',
	    'PRIMARY KEY (`user_id`,`place_id`)',
	  ), 'ENGINE=InnoDB');
	  //the tbl_project_user_assignment.project_id is a reference to tbl_project.id
	  $this->addForeignKey("fk_places_users", "tbl_users_has_places", "place_id", "tbl_places", "id", "CASCADE", "RESTRICT");
	  //the tbl_project_user_assignment.user_id is a reference to tbl_user.id
	  $this->addForeignKey("fk_users_places", "tbl_users_has_places", "user_id", "tbl_users", "id", "CASCADE", "RESTRICT");

	  
	  $this->createTable('tbl_place_images', array(
	    'id' => 'pk',
	    'title' => 'string DEFAULT NULL',
	    'caption' => 'text DEFAULT NULL',
	    'filename' => 'string NOT NULL',
	    'place_id' => 'integer NOT NULL',
	    'create_time' => 'datetime DEFAULT NULL',
	    'create_user_id' => 'integer DEFAULT NULL',
	    'update_time' => 'datetime DEFAULT NULL',
	    'update_user_id' => 'integer DEFAULT NULL',
	  ), 'ENGINE=InnoDB');
	  $this->addForeignKey("fk_places_place_images", "tbl_place_images", "place_id", "tbl_places", "id", "NO ACTION", "RESTRICT");
	   
	  $this->createTable('tbl_place_comments', array(
	    'id' => 'pk',
	    'user_id' => 'integer NOT NULL',
	    'place_id' => 'integer NOT NULL',
	    'content' => 'text NOT NULL',
	    'create_time' => 'datetime DEFAULT NULL',
	    'create_user_id' => 'integer DEFAULT NULL',
	    'update_time' => 'datetime DEFAULT NULL',
	    'update_user_id' => 'integer DEFAULT NULL',
	  ), 'ENGINE=InnoDB');
	  $this->addForeignKey("fk_places_place_comments", "tbl_place_comments", "place_id", "tbl_places", "id", "NO ACTION", "RESTRICT");
	}

	public function down()
	{
		$this->truncateTable('tbl_place_comments');
		$this->dropTable('tbl_place_comments');
		$this->truncateTable('tbl_place_images');
		$this->dropTable('tbl_place_images');
		$this->truncateTable('tbl_users_has_places');
		$this->dropTable('tbl_users_has_places');
		$this->truncateTable('tbl_places');
		$this->dropTable('tbl_places');
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