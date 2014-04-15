<?php
/* @var $this PlaceImagesController */
/* @var $model PlaceImages */

$this->breadcrumbs=array(
	'Place Images'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List PlaceImages', 'url'=>array('index')),

	array('label'=>'Create PlaceImages', 'url'=>array('create', 'pid'=>$model->place_id)),
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
		 array(
      'name'=>'picture',
      'type'=>'raw',
      'value'=>  CHtml::image(Yii::app()->baseUrl."/upload/place/".$model->filename),
    ),

		'place_id',
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
