<?php
/* @var $this PlaceImagesController */
/* @var $model PlaceImages */

$this->breadcrumbs=array(
	'Place Images'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PlaceImages', 'url'=>array('index')),
	array('label'=>'Manage PlaceImages', 'url'=>array('admin')),
);
?>

<h1>Create PlaceImages</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>