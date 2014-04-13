<?php
/* @var $this RoomImagesController */
/* @var $model RoomImages */

$this->breadcrumbs=array(
	'Room Images'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RoomImages', 'url'=>array('index')),
	array('label'=>'Create RoomImages', 'url'=>array('create')),
	array('label'=>'Update RoomImages', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RoomImages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RoomImages', 'url'=>array('admin')),
);
?>

<h1>View RoomImages #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'caption',
		'content',
		'filename',
    array(
      'name'=>'picture',
      'type'=>'raw',
      'value'=>  CHtml::image(Yii::app()->baseUrl."/upload/room/".$model->filename),
    ),

		'room_id',
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
