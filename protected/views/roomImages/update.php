<?php
/* @var $this RoomImagesController */
/* @var $model RoomImages */

$this->breadcrumbs=array(
	'Room Images'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RoomImages', 'url'=>array('index')),
	array('label'=>'Create RoomImages', 'url'=>array('create')),
	array('label'=>'View RoomImages', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RoomImages', 'url'=>array('admin')),
);
?>

<h1>Update RoomImages <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>