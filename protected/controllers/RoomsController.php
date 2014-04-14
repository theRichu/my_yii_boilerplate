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
   $data=Places::model()->findAll('state=:state', array(':state'=>$_POST['state']));
 
   $data=CHtml::listData($data,'city','city');
 
   echo "<option value=''>시/군/구</option>";
   foreach($data as $value=>$city_name)
   echo CHtml::tag('option', array('value'=>$value),CHtml::encode($city_name),true);
}

public function actionLoaddistricts()
{


  $data=Places::model()->findAll('city=:city', array(':city'=>$_POST['city']));
  
  $data=CHtml::listData($data,'district','district');
  fb($data);
  echo "<option value=''>동/면/읍</option>";
  foreach($data as $value=>$district_name)
    echo CHtml::tag('option', array('value'=>$value),CHtml::encode($district_name),true);
}
 
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
/* 		$this->render('view',array(
			'model'=>$this->loadModel($id),
		)); */

	  $roomOptionsDataProvider=new CActiveDataProvider('RoomOptions',array(
	    'criteria'=>array(
	      'condition'=>'room_id=:roomId',
	      'params'=>array(':roomId'=>$this->loadModel($id)->id),
	    ),
	    'pagination'=>array(
	      'pageSize'=>10,
	    ),
	  ));
	  $roomChargesDataProvider=new CActiveDataProvider('RoomCharges',array(
	    'criteria'=>array(
	      'condition'=>'room_id=:roomId',
	      'params'=>array(':roomId'=>$this->loadModel($id)->id),
	    ),
	    'pagination'=>array(
	      'pageSize'=>10,
	    ),
	  ));
	  $roomImagesDataProvider=new CActiveDataProvider('RoomImages',array(
	    'criteria'=>array(
	      'condition'=>'room_id=:roomId',
	      'params'=>array(':roomId'=>$this->loadModel($id)->id),
	    ),
	    'pagination'=>array(
	      'pageSize'=>10,
	    ),
	  ));
	  
	  $this->render('view',array(
	    'model'=>$this->loadModel($id),
	    'roomOptionsDataProvider'=>$roomOptionsDataProvider,
	    'roomChargesDataProvider'=>$roomChargesDataProvider,
	    'roomImagesDataProvider'=>$roomImagesDataProvider,
	  ));
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

		if(isset($_POST['Rooms']))
		{
			$model->attributes=$_POST['Rooms'];
			fb(isset($_POST['RoomCharges']));
			if (isset($_POST['RoomCharges'])) {
			  $model->roomCharges = $_POST['RoomCharges'];
			  //			  fb($model->roomCharges);
			  $model->saveWithRelated('roomCharges');
			}
			fb(isset($_POST['RoomOptions']));
			if (isset($_POST['RoomOptions'])) {
			  $model->roomOptions = $_POST['RoomOptions'];
			  //			  fb($model->roomOptions);
			  $model->saveWithRelated('roomOptions');
			}
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
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
		// $this->performAjaxValidation($model);

		if(isset($_POST['Rooms']))
		{
			$model->attributes=$_POST['Rooms'];

			fb(isset($_POST['RoomCharges']));
			if (isset($_POST['RoomCharges'])) {
			  $model->roomCharges = $_POST['RoomCharges'];
			  //			  fb($model->roomCharges);
			  $model->saveWithRelated('roomCharges');
			}
			fb(isset($_POST['RoomOptions']));
			if (isset($_POST['RoomOptions'])) {
			  $model->roomOptions = $_POST['RoomOptions'];
			  //			  fb($model->roomOptions);
			  $model->saveWithRelated('roomOptions');
			}
				
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
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
	  $model=new Rooms('search');
	  $model->unsetAttributes();  // clear any default values

	  $model_place=new Places('search');
	  $model_place->unsetAttributes();  // clear any default values
	  
	  if(isset($_GET['Rooms']))
	    $model->attributes=$_GET['Rooms'];


	  $criteria = new CDbCriteria();

	  if(isset($_GET['state']))
	  {
	    $state = $_GET['state'];
	  }
	  if(isset($_GET['city']))
	  {
	    $state = $_GET['city'];
	  }

	  if(isset($_GET['district']))
	  {
	    $state = $_GET['district'];
	  }
	  $criteria->with = array( 'Places' );
	  $criteria->with = array( 'RoomOptions' );
	  $criteria->with = array( 'RoomCharges' );
	   /* 
	  if(!empty($this->minPrice))
	    $criteria->addCondition('RoomCharges.price > '.(int)$this->minPrice);
	   
	  if(!empty($this->maxPrice))
	    $criteria->addCondition('RoomCharges.price < '.(int)$this->maxPrice);
	    */
	  if(!empty($this->state))
	    $criteria->addInCondition('Places.state', $state);
	  if(!empty($this->city))
	    $criteria->addInCondition('Places.city', $city);
	  if(!empty($this->district))
	    $criteria->addInCondition('Places.district', $district);
	   
	  
		$dataProvider=new CActiveDataProvider('Rooms');

		$this->render('index',array(
		  'model'=>$model,
		  'model_place'=>$model_place,
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
