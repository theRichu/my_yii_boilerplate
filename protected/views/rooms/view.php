<?php
/* @var $this RoomsController */
/* @var $model Rooms */

$this->breadcrumbs=array(
//	'Rooms'=>array('index'),
  'Places'=>array('places/view', 'id'=>$model->place_id),
  $model->name,
);

$this->menu=array(
	array('label'=>'List Rooms', 'url'=>array('index')),
  array('label'=>$model->label(). ' ' .Yii::t('app', '사진 등록하기') , 'url'=>array('roomImages/create','pid'=>$model->id)),

	array('label'=>'Update Rooms', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Rooms', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Rooms', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
    array (
      'name' => 'place',
      'type' => 'raw',
      'value' => isset ( $model->place_id ) ? CHtml::link(CHtml::encode ( $model->places->name ),array('places/view', 'id'=>$model->place_id)) : "unknown"
    ),
		'capacity',
		'floorspace',
		'contactnumber',
		'workstart',
		'workto',
	  
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


<br />
<h1>Room Images</h1>
<?php 
echo CHtml::openTag('div', array('class' => 'row-fluid'));
$this->widget(
    'bootstrap.widgets.TbThumbnails',
    array(
        'dataProvider' => $roomImagesDataProvider,
        'template' => "{items}\n{pager}",
        'itemView' => '/roomImages/_thumb',
    )
);
echo CHtml::closeTag('div');
?>
<br />
<h1>Room Charges</h1>
<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$roomChargesDataProvider,
    'itemView'=>'/roomCharges/_view',
)); 
?>

<br />
<h1>Room Options</h1>
<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$roomOptionsDataProvider,
    'itemView'=>'/roomOptions/_view',
  )); 
?>

