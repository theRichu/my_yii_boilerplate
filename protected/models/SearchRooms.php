<?php 

class SearchRooms extends CFormModel
{
    public $min_price;
    public $max_price;
    public $current_max;
    public $current_min;
    
    public $state;
    public $city;
    public $option;
    public $name;
    
    // Add a public property for each search form element here

    public function rules()
    {
        return array(
            // You should validate your search parameters here
            array('min_price,max_price,state,city,name', 'safe'),
        );
    }

    
    public function getCurrentMaxPrice()
    {
      return (int)Yii::app()->db->createCommand()
      ->select('max(price) as max')
      ->from('tbl_room_charges')
      ->queryScalar();
    }
    
    public function getCurrentMinPrice()
    {
      return (int)Yii::app()->db->createCommand()
      ->select('min(price) as min')
      ->from('tbl_room_charges')
      ->queryScalar();
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

    
}

?>