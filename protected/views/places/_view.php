<?php
/* @var $this PlacesController */
/* @var $data Places */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />
		<b>공간 개수:</b>
<?php echo CHtml::encode(count($data->rooms)); ?>
	<br />

  
  <?php echo TbHtml::linkButton('자세히 보기', 
  array(
    'color' => TbHtml::BUTTON_COLOR_INFO,
    'url' => array('places/view', 'id'=>$data->id),
)
); ?>
	
</div>