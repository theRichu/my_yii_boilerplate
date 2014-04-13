<?php
/* @var $this ReservationsController */
/* @var $model Reservations */

$this->breadcrumbs=array(
	'Reservations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Reservations', 'url'=>array('index')),
	array('label'=>'Create Reservations', 'url'=>array('create')),
	array('label'=>'View Reservations', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Reservations', 'url'=>array('admin')),
);
?>

<h1>Update Reservations <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>