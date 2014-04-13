<?php
/* @var $this PlaceImagesController */
/* @var $model PlaceImages */

$this->breadcrumbs=array(
	'Place Images'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PlaceImages', 'url'=>array('index')),
	array('label'=>'Create PlaceImages', 'url'=>array('create')),
	array('label'=>'View PlaceImages', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PlaceImages', 'url'=>array('admin')),
);
?>

<h1>Update PlaceImages <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>