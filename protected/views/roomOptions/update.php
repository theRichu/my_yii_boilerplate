<?php
/* @var $this RoomOptionsController */
/* @var $model RoomOptions */

$this->breadcrumbs=array(
	'Room Options'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RoomOptions', 'url'=>array('index')),
	array('label'=>'Create RoomOptions', 'url'=>array('create')),
	array('label'=>'View RoomOptions', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RoomOptions', 'url'=>array('admin')),
);
?>

<h1>Update RoomOptions <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>