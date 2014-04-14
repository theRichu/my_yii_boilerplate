<?php 
class SearchRooms extends CFormModel
{
    public $minPrice;
    public $maxPrice;
    public $state;
    public $city;
    public $district;
    
    // Add a public property for each search form element here

    public function rules()
    {
        return array(
            // You should validate your search parameters here
            array('minPrice,maxPrice,state,city,district', 'safe'),
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->with = array( 'RoomCharges' );
        
        if(!empty($this->minPrice))
            $criteria->addCondition('RoomCharges.price > '.(int)$this->minPrice);

        if(!empty($this->maxPrice))
            $criteria->addCondition('RoomCharges.price < '.(int)$this->maxPrice);

        if(!empty($this->state))
            $criteria->addInCondition('state', $this->state);
        if(!empty($this->city))
          $criteria->addInCondition('city', $this->city);
        if(!empty($this->district))
          $criteria->addInCondition('district', $this->district);
        
        
        // Add more conditions for each property here

        return new CActiveDataProvider('Place', array(
            'criteria' => $criteria,
            // more options here, e.g. sorting, pagination, ...
        ));
    }
}

?>