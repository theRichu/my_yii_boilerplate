<?php
/* @var $this ReservationsController */
/* @var $model Reservations */

$this->breadcrumbs=array(
	'Reservations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Reservations', 'url'=>array('index')),
	array('label'=>'Create Reservations', 'url'=>array('create')),
	array('label'=>'Update Reservations', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Reservations', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Reservations', 'url'=>array('admin')),
);
?>

<h1>View Reservations #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'notice_id',
		'user_id',
		'from',
		'to',
		'people',
		'status',
		'additionalcharge',
		'contactnumber',
		'otherinfo',
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
