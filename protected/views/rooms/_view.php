<?php
/* @var $this RoomsController */
/* @var $data Rooms */
?>

<div class="view">
	<?php 
$images = array();
foreach($data->roomImages as $record) {
  $images[] = array(
  'image' => Yii::app()->request->baseUrl.'/upload/room/'.$record->filename,
  'label' => $record->caption,
  'caption' => $record->content,
  );
}
if(count($images)){
    $this->widget('bootstrap.widgets.TbCarousel',
    array(
        'id'=>'Mycarouse1',//id of Carousel
        'slide'=>array(true,2000),//to slide after 2seconds   
        'items'=>$images,
    ));
}
?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('rooms/view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('place_id')); ?>:</b>
	<?php echo CHtml::encode($data->place_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('capacity')); ?>:</b>
	<?php echo CHtml::encode($data->capacity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('floorspace')); ?>:</b>
	<?php echo CHtml::encode($data->floorspace); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contactnumber')); ?>:</b>
	<?php echo CHtml::encode($data->contactnumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('workstart')); ?>:</b>
	<?php echo CHtml::encode($data->workstart); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('workto')); ?>:</b>
	<?php echo CHtml::encode($data->workto); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
	<b><?php echo isset ( $data->create_user_id ) ? CHtml::link(CHtml::encode ( $data->creater->username ),array('user/user/view', 'id'=>$data->create_user_id)) : "unknown"; ?></b>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user_id')); ?>:</b>
	<b><?php echo isset ( $data->update_user_id ) ? CHtml::link(CHtml::encode ( $data->updater->username ),array('user/user/view', 'id'=>$data->update_user_id)) : "unknown"; ?></b>
	<br />
	<?php 
	$this->widget(
    'bootstrap.widgets.TbButton',
    array(
        'label' => '자세히 보기',
        'type' => 'primary',
        'url' => array('rooms/view', 'id'=>$data->id),
    )
  );
  ?>

	



</div>