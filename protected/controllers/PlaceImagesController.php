<?php
class PlaceImagesController extends Controller {
	/**
	 *
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 *      using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';
	
	/**
	 *
	 * @return array action filters
	 */
	public function filters() {
		return array (
				'accessControl', // perform access control for CRUD operations
				'postOnly + delete', // we only allow deletion via POST request
				'placeContext + create', // check to ensure valid project context
				'ajaxOnly + field' 
		);
	}
	public function actionField($index) {
		$model = new PlaceImages ();
		$this->renderPartial ( '_form', array (
				'model' => $model,
				'index' => $index 
		) );
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 *
	 * @return array access control rules
	 */
	public function accessRules() {
		return array (
				array (
						'allow', // allow all users to perform 'index' and 'view' actions
						'actions' => array (
								'index',
								'view' 
						),
						'users' => array (
								'*' 
						) 
				),
				array (
						'allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions' => array (
								'create',
								'update',
								'field' 
						),
						'users' => array (
								'@' 
						) 
				),
				array (
						'allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions' => array (
								'admin',
								'delete' 
						),
						'users' => array (
								'admin' 
						) 
				),
				array (
						'deny', // deny all users
						'users' => array (
								'*' 
						) 
				) 
		);
	}
	
	/**
	 * Displays a particular model.
	 *
	 * @param integer $id
	 *        	the ID of the model to be displayed
	 */
	public function actionView($id) {
		$this->render ( 'view', array (
				'model' => $this->loadModel ( $id ) 
		) );
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */

	public function actionCreate() {
		
		$models = array ();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if (isset ( $_POST ['PlaceImages'] )) {
			
			fb ( "GOT PLACE IMAGE POST" );
			foreach ( $_POST ['PlaceImages'] as $i => $placeImage ) {
	
				$model = new PlaceImages ();
				$model->setAttributes ( $placeImage );
				$model->place_id = $this->_place->id;
				fb ( $model );
				$rnd = $random = date ( time () );
				$model->photo = CUploadedFile::getInstance ( $model, "[$i]photo" );
				fb ( $model->photo );
				$fileName = "{$rnd}-{$model->photo->getName()}"; // random number + file name
				$model->filename = $fileName;
				fb ( $model->validate () );
				if ($model->validate ()) {
					$models [] = $model;
					$model->photo->saveAs ( Yii::app ()->basePath . '/../upload/place/' . $fileName ); // image will uplode to rootDirectory/banner/
					Yii::import ( 'application.extensions.image.Image' );
					$thumb = new Image ( Yii::app ()->basePath . '/../upload/place/' . $fileName );
					$thumb->resize ( 200, 200 );
					$thumb->save ( Yii::app ()->basePath . '/../upload/place/t_' . $fileName );
				}
			}
		}
	
		if (! empty ( $models )) {
				
			foreach ( $models as $model ) {
	
				$model->save();
			
			}

			if (Yii::app ()->getRequest ()->getIsAjaxRequest ())
				Yii::app ()->end ();
			else
				$this->redirect ( array (
						'index'
				));
		} else {
			$models [] = new PlaceImages ();
		}
		
		

		
		
	
		$this->render ( 'create', array (
				'models' => $models
		) );
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *        	the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model = $this->loadModel ( $id );
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if (isset ( $_POST ['PlaceImages'] )) {
			$model->attributes = $_POST ['PlaceImages'];
			if ($model->save ())
				$this->redirect ( array (
						'view',
						'id' => $model->id 
				) );
		}
		
		$this->render ( 'update', array (
				'model' => $model 
		) );
	}
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 *
	 * @param integer $id
	 *        	the ID of the model to be deleted
	 */
	public function actionDelete($id) {
		$this->loadModel ( $id )->delete ();
		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (! isset ( $_GET ['ajax'] ))
			$this->redirect ( isset ( $_POST ['returnUrl'] ) ? $_POST ['returnUrl'] : array (
					'admin' 
			) );
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex() {
		$dataProvider = new CActiveDataProvider ( 'PlaceImages' );
		$this->render ( 'index', array (
				'dataProvider' => $dataProvider 
		) );
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model = new PlaceImages ( 'search' );
		$model->unsetAttributes (); // clear any default values
		if (isset ( $_GET ['PlaceImages'] ))
			$model->attributes = $_GET ['PlaceImages'];
		
		$this->render ( 'admin', array (
				'model' => $model 
		) );
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 *
	 * @param integer $id
	 *        	the ID of the model to be loaded
	 * @return PlaceImages the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id) {
		$model = PlaceImages::model ()->findByPk ( $id );
		if ($model === null)
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		return $model;
	}
	
	/**
	 * Performs the AJAX validation.
	 *
	 * @param PlaceImages $model
	 *        	the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'place-images-form') {
			echo CActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
	}
	
	/**
	 *
	 * @var private property containing the associated Project model instance.
	 */
	private $_place = null;
	/**
	 * Protected method to load the associated Project model class
	 *
	 * @param
	 *        	integer placeId the primary identifier of the associated Place
	 * @return object the Place data model based on the primary key
	 */
	protected function loadPlace($placeId) {
		// if the project property is null, create it based on input id
		if ($this->_place === null) {
			$this->_place = Places::model ()->findByPk ( $placeId );
			
			if ($this->_place === null) {
				throw new CHttpException ( 404, 'The requested place does not exist.' );
			}
		}
		return $this->_place;
	}
	/**
	 * In-class defined filter method, configured for use in the above filters()
	 * method.
	 * It is called before the actionCreate() action method is run in
	 * order to ensure a proper project context
	 */
	public function filterPlaceContext($filterChain) {
		// set the project identifier based on GET input request variables
		if (isset ( $_GET ['pid'] ))
			$this->loadPlace ( $_GET ['pid'] );
		else
			throw new CHttpException ( 403, 'Must specify a place before performing this action.' );
			// complete the running of other filters and execute the requested action
		$filterChain->run ();
	}
}
