<?php
/* @var $this RoomImagesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Room Images',
);

$this->menu=array(
	array('label'=>'Create RoomImages', 'url'=>array('create')),
	array('label'=>'Manage RoomImages', 'url'=>array('admin')),
);
?>

<h1>Room Images</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
