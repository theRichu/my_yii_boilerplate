<?php
/* @var $this RoomOptionsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Room Options',
);

$this->menu=array(
	array('label'=>'Create RoomOptions', 'url'=>array('create')),
	array('label'=>'Manage RoomOptions', 'url'=>array('admin')),
);
?>

<h1>Room Options</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
