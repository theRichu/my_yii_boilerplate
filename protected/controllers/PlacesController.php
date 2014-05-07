<?php

class PlacesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $onloadFunctions;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','view', 'loadcities', 'map'),
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
	
	
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
	  $roomsDataProvider=new CActiveDataProvider('Rooms',array(
	    'criteria'=>array(
	      'condition'=>'place_id=:place_id',
	      'params'=>array(':place_id'=>$id),
	    ),
	    'sort'=>array(
	      'defaultOrder'=>'create_time DESC',
	    ),
	  ));
	  $this->render('view',array(
	    'model'=>$this->loadModel($id),
	    'roomsDataProvider'=>$roomsDataProvider,
	  ));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Places;
		$related = array();
		$tempImages = array();
		$tempFilenames = array();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Places']))
		{
			$model->attributes=$_POST['Places'];
			
			if (isset($_POST['PlaceImages'])) {
				$tempPost = $_POST['PlaceImages'];
				$image = new PlaceImages();
				foreach ( $_POST['PlaceImages'] as $i => $placeImage ) {
					$image -> setAttributes($placeImage);
					$rnd = $random = date ( time () );
					$image->photo = CUploadedFile::getInstance ( $image, "[$i]photo" );
						
					$tempImages["{$i}"] = CUploadedFile::getInstance ( $image, "[$i]photo" );
					$tempFileNames["{$i}"] = md5("{$rnd}-{$tempImages[$i]->getName()}"); // random number + file name
					$tempFileNames["{$i}"] .= ".".$tempImages[$i]->getExtensionName( );
					$tempPost[$i]['filename'] = $tempFileNames[$i];
					unset($tempPost[$i]['photo']);
				}
				$model->placeImages = $tempPost;
				$related[] = 'placeImages';
			}
			
			if($re = $model->saveWithRelated($related)){
				foreach($tempImages as $i => $tempImage){
					$tempImages["{$i}"]->saveAs ( Yii::app ()->basePath . '/../upload/place/' . $tempFileNames["{$i}"] ); // image will uplode to rootDirectory/banner/
					Yii::import ( 'application.extensions.image.Image' );
					$thumb = new Image ( Yii::app ()->basePath . '/../upload/place/' . $tempFileNames["{$i}"] );
					$thumb->resize ( 200, 200 );
					$thumb->save ( Yii::app ()->basePath . '/../upload/place/t_' . $tempFileNames["{$i}"] );
				}
				$this->redirect(array('view','id'=>$model->id));
			}
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
		$tempImages = array();
		$tempFilenames = array();
		$related = array();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Places']))
		{
			$model->attributes=$_POST['Places'];
			if (isset($_POST['PlaceImages'])) {
				$tempPost = $_POST['PlaceImages'];
				$image = new PlaceImages();
				foreach ( $_POST['PlaceImages'] as $i => $placeImage ) {
					$image = new PlaceImages();
					$image -> setAttributes($placeImage);		

					if(!(isset($image->filename)?$image->filename:'') !='')
					{
						$rnd = $random = date ( time () );

						$tempImages["{$i}"] = CUploadedFile::getInstance ( $image, "[$i]photo" );

						$tempFileNames["{$i}"] = md5("{$rnd}-{$tempImages[$i]->getName()}"); // random number + file name
						$tempFileNames["{$i}"] .= ".".$tempImages[$i]->getExtensionName();

						$tempPost[$i]['filename'] = $tempFileNames[$i];
						
						unset($tempPost[$i]['photo']);						

					}
				}
				$model->placeImages = $tempPost;				
			}else{
				$model->placeImages = NULL;
			}
			$related[] = 'placeImages';
				
			if($re = $model->saveWithRelated($related)){
				foreach($tempImages as $i => $tempImage){
					$tempImages["{$i}"]->saveAs ( Yii::app ()->basePath . '/../upload/place/' . $tempFileNames["{$i}"] ); // image will uplode to rootDirectory/banner/
					Yii::import ( 'application.extensions.image.Image' );
					$thumb = new Image ( Yii::app ()->basePath . '/../upload/place/' . $tempFileNames["{$i}"] );
					$thumb->resize ( 200, 200 );
					$thumb->save ( Yii::app ()->basePath . '/../upload/place/t_' . $tempFileNames["{$i}"] );
				}
				$this->redirect(array('view','id'=>$id));
			}
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
		$model=new Places('search');
		$model->unsetAttributes();  // clear any default values

		$this->render('index',array(
		  'model'=>$model,
		), false);
	}

	public function actionMap()
	{
		$model=new Places('search');
		$model->unsetAttributes();  // clear any default values
		
			fb("MAP");
			$this->renderPartial('extensions/_placeNewMap',array(
					'dataProvider'=>$model->search(),
	//				'state' => 'AJAX CONTENTS'
			), false, true);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Places('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Places']))
			$model->attributes=$_GET['Places'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Places the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Places::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	


	/**
	 * @var private property containing the associated Project model instance.
	 */
	private $_room = null;
	/**
	 * Protected method to load the associated Project model class
	 * @param integer placeId the primary identifier of the associated Place
	 * @return object the Place data model based on the primary key
	 */
	protected function loadRoom($placeId)
	{
	  //if the project property is null, create it based on input id
	  if($this->_room===null)
	  {
	    $this->_room=Rooms::model()->findByPk($placeId);
	    if($this->_room===null)
	    {
	      throw new CHttpException(404,'The requested room does not exist.');
	    }
	  }
	  return $this->_room;
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
	

	/**
	 * Performs the AJAX validation.
	 * @param Places $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='places-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
