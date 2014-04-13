<?php
/* @var $this RoomChargesController */
/* @var $model RoomCharges */

$this->breadcrumbs=array(
	'Room Charges'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RoomCharges', 'url'=>array('index')),
	array('label'=>'Create RoomCharges', 'url'=>array('create')),
	array('label'=>'Update RoomCharges', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RoomCharges', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RoomCharges', 'url'=>array('admin')),
);
?>

<h1>View RoomCharges #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'room_id',
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
