<?php
/* @var $this RoomOptionsController */
/* @var $model RoomOptions */

$this->breadcrumbs=array(
	'Room Options'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RoomOptions', 'url'=>array('index')),
	array('label'=>'Manage RoomOptions', 'url'=>array('admin')),
);
?>

<h1>Create RoomOptions</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>