<?php
/* @var $this ReservationsController */
/* @var $model Reservations */

$this->breadcrumbs=array(
	'Reservations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Reservations', 'url'=>array('index')),
	array('label'=>'Manage Reservations', 'url'=>array('admin')),
);
?>

<h1>Create Reservations</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>