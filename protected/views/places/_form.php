<?php
/* @var $this PlacesController */
/* @var $model Places */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'places-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php //echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php 
		$this->widget('ext.RGmapPicker.RGmapPicker',
                array(
                    'title' => 'Address',
                    'element_id' => 'Places',
                    'map_width' => 670,
                    'map_height' => 300,
                    'map_latitude' => isset($model->map_lat)?CHtml::encode($model->map_lat):'37.54', 
                    'map_longitude' => isset($model->map_lag)?CHtml::encode($model->map_lag):'126.96',
                    'map_location_name' => isset($model->address)?CHtml::encode($model->address):'대한민국 서울특별시 용산구',
                 )
            );
    ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->