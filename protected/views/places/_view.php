<?php
/* @var $this PlacesController */
/* @var $data Places */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />
		<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />
		<b><?php echo CHtml::encode($data->getAttributeLabel('district')); ?>:</b>
	<?php echo CHtml::encode($data->district); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('map_lat')); ?>:</b>
	<?php echo CHtml::encode($data->map_lat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('map_lag')); ?>:</b>
	<?php echo CHtml::encode($data->map_lag); ?>
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
        'url' => array('places/view', 'id'=>$data->id),
    )
  );
  ?>
</div>