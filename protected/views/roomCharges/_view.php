<?php
/* @var $this RoomChargesController */
/* @var $data RoomCharges */
?>

<div class="view">

	<b>
		<?php echo CHtml::encode($data->description); ?> :
	</b>
	<?php echo CHtml::encode($data->price); ?>
	
	<?php //echo CHtml::encode($data->getAttributeLabel('price')); ?>
	<?php // echo CHtml::encode($data->getAttributeLabel('description')); ?>
	<br />

</div>