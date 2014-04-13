<?php
/* @var $this RoomChargesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Room Charges',
);

$this->menu=array(
	array('label'=>'Create RoomCharges', 'url'=>array('create')),
	array('label'=>'Manage RoomCharges', 'url'=>array('admin')),
);
?>

<h1>Room Charges</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
