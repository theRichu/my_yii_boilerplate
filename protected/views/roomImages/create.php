<?php
/* @var $this RoomImagesController */
/* @var $model RoomImages */

$this->breadcrumbs=array(
	'Room Images'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RoomImages', 'url'=>array('index')),
	array('label'=>'Manage RoomImages', 'url'=>array('admin')),
);
?>

<h1>Create RoomImages</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>