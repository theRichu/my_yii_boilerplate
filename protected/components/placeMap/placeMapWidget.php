<?php 
class placeMapWidget extends CWidget{
	public $dataProvider;// = new CActiveDataProvider;
	
    //init() method is called automatically before all others 
    public function init(){
        /*you can set initial default values and other stuff here.
         * it's also a good place to register any CSS or Javascript your
         * widget may need. */  
    }
    public function run(){
        /* here stuff gets actually done: you can echo the actual HTML that
         * makes up your widget.*/
    	$this->render('application.components.placeMap._placeMap');
    }
}
?>
