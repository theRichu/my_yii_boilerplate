<?php
/* @var $this ReservationsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reservations',
);

$this->menu=array(
	array('label'=>'Create Reservations', 'url'=>array('create')),
	array('label'=>'Manage Reservations', 'url'=>array('admin')),
);
?>

<h1>Reservations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
