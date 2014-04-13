<?php
/* @var $this PlaceImagesController */
/* @var $model PlaceImages */

$this->breadcrumbs=array(
	'Place Images'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List PlaceImages', 'url'=>array('index')),
	array('label'=>'Create PlaceImages', 'url'=>array('create')),
	array('label'=>'Update PlaceImages', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PlaceImages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PlaceImages', 'url'=>array('admin')),
);
?>

<h1>View PlaceImages #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'caption',
		'filename',
		'place_id',
		'create_time',
		'create_user_id',
		'update_time',
		'update_user_id',
	),
)); ?>
