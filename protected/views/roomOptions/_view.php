<?php
/* @var $this RoomOptionsController */
/* @var $data RoomOptions */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('option_id')); ?>:</b>
	<?php echo isset($data->option_id)?
							CHtml::link(CHtml::encode($data->option->name), CHtml::encode("/storybox/options/".$data->option_id))
							:"unknown" ; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

</div>