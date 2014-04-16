<?php

class RoomsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		  'placeContext + create', //check to ensure valid project context
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','loadcities', 'loaddistricts'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	

	
public function actionLoadcities()
{
  fb("loadcities");
  
  if (Yii::app()->request->isAjaxRequest){
    $data=Places::model()->findAll('state=:state', array(':state'=>$_POST['state']));    
    $data=CHtml::listData($data,'city','city');

    echo "<option value=''>시/군/구</option>";
    foreach($data as $value=>$city_name)
      echo CHtml::tag('option', array('value'=>$value),CHtml::encode($city_name),true);
  }
    
  else
  {
  	
  }
}

/* 
public function actionLoaddistricts()
{


  $data=Places::model()->findAll('city=:city', array(':city'=>$_POST['city']));
  
  $data=CHtml::listData($data,'district','district');
  fb($data);
  echo "<option value=''>동/면/읍</option>";
  foreach($data as $value=>$district_name)
    echo CHtml::tag('option', array('value'=>$value),CHtml::encode($district_name),true);
}
  */
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{

	  $roomNoticesDataProvider=new CActiveDataProvider('Notices',array(
	    'criteria'=>array(
	      'condition'=>'room_id=:roomId',
	      'params'=>array(':roomId'=>$this->loadModel($id)->id),
	    ),
	    'pagination'=>false,
	  ));
	  $roomOptionsDataProvider=new CActiveDataProvider('RoomOptions',array(
	    'criteria'=>array(
	      'condition'=>'room_id=:roomId',
	      'params'=>array(':roomId'=>$this->loadModel($id)->id),
	    ),
	    'pagination'=>false,
	  ));
	  $roomChargesDataProvider=new CActiveDataProvider('RoomCharges',array(
	    'criteria'=>array(
	      'condition'=>'room_id=:roomId',
	      'params'=>array(':roomId'=>$this->loadModel($id)->id),
	    ),
	    'pagination'=>false,
	  ));
	  $roomImagesDataProvider=new CActiveDataProvider('RoomImages',array(
	    'criteria'=>array(
	      'condition'=>'room_id=:roomId',
	      'params'=>array(':roomId'=>$this->loadModel($id)->id),
	    ),
	    'pagination'=>false,
	  ));
	  
	  $this->render('view',array(
	    'model'=>$this->loadModel($id),
	    'roomNoticesDataProvider'=>$roomNoticesDataProvider,
	    'roomOptionsDataProvider'=>$roomOptionsDataProvider,
	    'roomChargesDataProvider'=>$roomChargesDataProvider,
	    'roomImagesDataProvider'=>$roomImagesDataProvider,
	  ));
	}

	
	public function actionTest(){
		$model=new Rooms;
		$model->place_id = $this->_place->id;
	
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Rooms;
		$model->place_id = $this->_place->id;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$related = array();
		$images = array();
		if(isset($_POST['Rooms']))
		{
			$model->attributes=$_POST['Rooms'];
			
			if (isset($_POST['RoomCharges'])) {
			  $model->roomCharges = $_POST['RoomCharges'];
			  $related[] = 'roomCharges';
			}

			if (isset($_POST['RoomOptions'])) {
			  $model->roomOptions = $_POST['RoomOptions'];
			   $related[] = 'roomOptions';
			}
			if (isset($_POST['RoomImages'])) {
				//$model->roomImages = $_POST['RoomImages'];
				
					foreach ( $_POST['RoomImages'] as $i => $roomImage ) {
						$image = new RoomImages ();
						$image->setAttributes ( $roomImage );
						$rnd = $random = date ( time () );
						$image->photo = CUploadedFile::getInstance ( $image, "[$i]photo" );
						$fileName = "{$rnd}-{$image->photo->getName()}"; // random number + file name
						$image->filename = $fileName;
						$image->photo->saveAs ( Yii::app ()->basePath . '/../upload/room/' . $fileName ); // image will uplode to rootDirectory/banner/
						Yii::import ( 'application.extensions.image.Image' );
						$thumb = new Image ( Yii::app ()->basePath . '/../upload/room/' . $fileName );
						$thumb->resize ( 200, 200 );
						$thumb->save ( Yii::app ()->basePath . '/../upload/room/t_' . $fileName );
						// @FIXME : 일단 올리고보자..?
						if ($image->validate ()) {
							$images[]=array(
									'filename' => $image->filename,
									'caption' => $image->caption,
									'content' => $image->content,
							);
						}
				}
								
				$model->roomImages = $images;
				fb($model->roomImages);
				
				$related[] = 'roomImages';
			  
			}
				fb($model);
			if($re = $model->saveWithRelated($related)){
				fb($re);
				$this->redirect(array('view','id'=>$model->id));
			}
				fb($re);			
		}


		
		$this->render('create',array(
			'model'=>$model,
		  'photosNumber' => isset($_POST['PhotoEvent']) ? count($_POST['PhotoEvent'])-1 : 0, //How many PhotoEvent the user added
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
			// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$related = array();
		$images = array();
		if(isset($_POST['Rooms']))
		{
			$model->attributes=$_POST['Rooms'];
			
			if (isset($_POST['RoomCharges'])) {
			  $model->roomCharges = $_POST['RoomCharges'];
			  $related[] = 'roomCharges';
			}

			if (isset($_POST['RoomOptions'])) {
			  $model->roomOptions = $_POST['RoomOptions'];
			   $related[] = 'roomOptions';
			}
			if (isset($_POST['RoomImages'])) {
				//$model->roomImages = $_POST['RoomImages'];
				
					foreach ( $_POST['RoomImages'] as $i => $roomImage ) {
						$image = new RoomImages ();
						$image->setAttributes ( $roomImage );
						$rnd = $random = date ( time () );
						$image->photo = CUploadedFile::getInstance ( $image, "[$i]photo" );
						$fileName = "{$rnd}-{$image->photo->getName()}"; // random number + file name
						$image->filename = $fileName;
						$image->photo->saveAs ( Yii::app ()->basePath . '/../upload/room/' . $fileName ); // image will uplode to rootDirectory/banner/
						Yii::import ( 'application.extensions.image.Image' );
						$thumb = new Image ( Yii::app ()->basePath . '/../upload/room/' . $fileName );
						$thumb->resize ( 200, 200 );
						$thumb->save ( Yii::app ()->basePath . '/../upload/room/t_' . $fileName );
						// @FIXME : 일단 올리고보자..?
						if ($image->validate ()) {
							$images[]=array(
									'filename' => $image->filename,
									'caption' => $image->caption,
									'content' => $image->content,
							);
						}
				}
								
				$model->roomImages = $images;
				fb($model->roomImages);
				
				$related[] = 'roomImages';
			  
			}
				fb($model);
			if($re = $model->saveWithRelated($related)){
				fb($re);
				$this->redirect(array('view','id'=>$model->id));
			}
				fb($re);			
		}


		
		$this->render('create',array(
			'model'=>$model,
		  'photosNumber' => isset($_POST['PhotoEvent']) ? count($_POST['PhotoEvent'])-1 : 0, //How many PhotoEvent the user added
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	 // $model=new Rooms('search');
	  $model=new SearchRooms();
	  $model->unsetAttributes();  // clear any default values
	  	 
	  //$model_place=new Places('search');
	  //$model_place->unsetAttributes();  // clear any default values
	  
	  if(isset($_GET['Rooms']))
	    $model->attributes=$_GET['Rooms'];
	  if(isset($_GET['state']))
	    $state = array($_GET['state']);
	  if(isset($_GET['city']))
	    $city = array($_GET['city']);
	  if(isset($_GET['max']))
	    $max_price = $_GET['max'];
	  if(isset($_GET['min']))
	    $min_price = $_GET['min'];


	  /* 	  if(isset($_GET['district']))
	   {
	  $state = $_GET['district'];
	  } 
	  
	  */

	  $criteria = new CDbCriteria();
	  $criteria->with = array( 'places' );
	  //$criteria->with = array( 'roomCharges' );
   
	  if(isset($state) && $state!=['']){
	    $criteria->compare('places.state', $state, false);
	  }
	  if(isset($city) && $city!=['']){
	    $criteria->compare('places.city', $city, false);
	  }
/* 
	  if(!empty($this->district))
	    $criteria->addInCondition('places.district', $district);
*/	  
 	  //if(isset($max_price) && $max_price!='')
	   // $criteria->addCondition('roomCharges.price > '.$max_price);
	  
	  //if(isset($min_price) && $min_price!='')
	  //  $criteria->addCondition('roomCharges.price < '.$min_price);
	   
		$dataProvider=new CActiveDataProvider('Rooms',
		  array('criteria'=>$criteria)
		);  
	
		$this->render('index',array(
		  'model'=>$model,
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Rooms('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Rooms']))
			$model->attributes=$_GET['Rooms'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Rooms the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Rooms::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Rooms $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='rooms-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	

	/**
	 * @var private property containing the associated Project model instance.
	 */
	private $_place = null;
	/**
	 * Protected method to load the associated Project model class
	 * @param integer placeId the primary identifier of the associated Place
	 * @return object the Place data model based on the primary key
	 */
	protected function loadPlace($placeId)
	{
	  //if the project property is null, create it based on input id
	  if($this->_place===null)
	  {
	    $this->_place=Places::model()->findByPk($placeId);
	
	    if($this->_place===null)
	    {
	      throw new CHttpException(404,'The requested place does not exist.');
	    }
	  }
	  return $this->_place;
	}
	/**
	 * In-class defined filter method, configured for use in the above filters()
	 * method. It is called before the actionCreate() action method is run in
	 * order to ensure a proper project context
	 */
	public function filterPlaceContext($filterChain)
	{
	  //set the project identifier based on GET input request variables
	  if(isset($_GET['pid']))
	    $this->loadPlace($_GET['pid']);
	  else
	    throw new CHttpException(403,'Must specify a place before performing this action.');
	  //complete the running of other filters and execute the requested action
	  $filterChain->run();
	}
	
}
