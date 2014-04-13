<?php
/* @var $this RoomChargesController */
/* @var $model RoomCharges */

$this->breadcrumbs=array(
	'Room Charges'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RoomCharges', 'url'=>array('index')),
	array('label'=>'Manage RoomCharges', 'url'=>array('admin')),
);
?>

<h1>Create RoomCharges</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>