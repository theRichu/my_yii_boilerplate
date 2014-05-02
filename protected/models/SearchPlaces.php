<?php 
class SearchPlaces extends CFormModel
{
    public $min_price;
    public $max_price;
    public $current_max;
    public $current_min;
    
    public $state;
    public $city;
//    public $district;
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
    
    public function search()
    {
    	// @todo Please modify the following code to remove attributes that should not be searched.
    
    	$criteria=new CDbCriteria;
    
    
    	if(isset($_GET['Places']))
    		$model->attributes=$_GET['Places'];
    	if(isset($_GET['state']))
    		$state = array($_GET['state']);
    	if(isset($_GET['city']))
    		$city = array($_GET['city']);
    	if(isset($_GET['q']))
    		$q = array($_GET['q']);
    		
    		
    	$criteria = new CDbCriteria();
    	if(isset($state) && $state!=['']){
    		$criteria->compare('t.state', $state, false);
    	}
    	if(isset($city) && $city!=['']){
    		$criteria->compare('t.city', $city, false);
    	}
    	if(isset($q) && $q!=[''])
    	{
    		$criteria->compare('name', $q, true, 'OR');
    		$criteria->compare('description', $q, true, 'OR');
    	}
    
    	return new CActiveDataProvider($this, array(
    			'criteria'=>$criteria,
    	));
    }
    
}

?>