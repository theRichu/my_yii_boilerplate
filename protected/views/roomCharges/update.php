<?php
/* @var $this RoomChargesController */
/* @var $model RoomCharges */

$this->breadcrumbs=array(
	'Room Charges'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RoomCharges', 'url'=>array('index')),
	array('label'=>'Create RoomCharges', 'url'=>array('create')),
	array('label'=>'View RoomCharges', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RoomCharges', 'url'=>array('admin')),
);
?>

<h1>Update RoomCharges <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>