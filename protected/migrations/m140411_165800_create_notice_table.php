<?php

class m140411_165800_create_notice_table extends CDbMigration
{
	public function safeUp()
	{
	  $this->createTable('tbl_notices', array(
	    'id' => 'pk',
	    'room_id' => 'integer NOT NULL',
	    'from' => 'datetime NOT NULL',
	    'to' => 'datetime NOT NULL',
	    'specialprice'=>'integer DEFAULT NULL',   
	    'payment' => 'integer DEFAULT NULL',
	    'status' => 'integer DEFAULT 1',
	    'contactnumber' => 'string DEFAULT NULL',
	    'create_time' => 'datetime DEFAULT NULL',
	    'create_user_id' => 'integer DEFAULT NULL',
	    'update_time' => 'datetime DEFAULT NULL',
	    'update_user_id' => 'integer DEFAULT NULL',
	  ), 'ENGINE=InnoDB');
	  $this->addForeignKey("fk_rooms_notices", "tbl_notices", "room_id", "tbl_rooms", "id", "CASCADE", "RESTRICT");

	  
	  $this->createTable('tbl_reservations', array(
	    'id' => 'pk',
	    'notice_id' => 'integer NOT NULL',
	    'from' => 'datetime NOT NULL',
	    'to' => 'datetime NOT NULL',
	    'people' => 'integer DEFAULT NULL',
	    'status' => 'integer DEFAULT 0',
	    'additionalcharge' => 'integer DEFAULT NULL',
	    'contactnumber' => 'string DEFAULT NULL',
	    'otherinfo' =>'text DEFAULT NULL',
	    'create_time' => 'datetime DEFAULT NULL',
	    'create_user_id' => 'integer DEFAULT NULL',
	    'update_time' => 'datetime DEFAULT NULL',
	    'update_user_id' => 'integer DEFAULT NULL',
	  ), 'ENGINE=InnoDB');
	  $this->addForeignKey("fk_notices_reservations", "tbl_reservations", "notice_id", "tbl_notices", "id", "CASCADE", "RESTRICT");


	}

	public function safeDown()
	{
	  $this->truncateTable('tbl_reservations');
	  $this->dropTable('tbl_reservations');
	  $this->truncateTable('tbl_notices');
	  $this->dropTable('tbl_notices');

	
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