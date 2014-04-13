<?php
/* @var $this RoomOptionsController */
/* @var $model RoomOptions */

$this->breadcrumbs=array(
	'Room Options'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RoomOptions', 'url'=>array('index')),
	array('label'=>'Create RoomOptions', 'url'=>array('create')),
	array('label'=>'Update RoomOptions', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RoomOptions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RoomOptions', 'url'=>array('admin')),
);
?>

<h1>View RoomOptions #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'room_id',
		'option_id',
		'price',
		'description',
    'create_time',
    array (
      'name' => 'create_user_id',
      'type' => 'raw',
      'value' => isset ( $model->create_user_id ) ? CHtml::link(CHtml::encode ( $model->creater->username ),array('user/user/view', 'id'=>$model->create_user_id)) : "unknown"
    ),
    'update_time',
    array (
      'name' => 'update_user_id',
      'type' => 'raw',
      'value' => isset ( $model->update_user_id ) ? CHtml::link(CHtml::encode ( $model->updater->username ),array('user/user/view', 'id'=>$model->update_user_id)) : "unknown"
    ),
	),
)); ?>
