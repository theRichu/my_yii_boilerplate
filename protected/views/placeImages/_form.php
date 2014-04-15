<?php
/* @var $this PlaceImagesController */
/* @var $model PlaceImages */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'place-images-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
  'htmlOptions'=>array('enctype' => 'multipart/form-data')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'caption'); ?>
		<?php echo $form->textArea($model,'caption',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'caption'); ?>
	</div>


		<div class="row">
        <?php echo $form->labelEx($model,'filename'); ?>
        <?php echo CHtml::activeFileField($model, 'filename'); ?>  
        <?php echo $form->error($model,'filename'); ?>
    </div>
    
    <?php if($model->isNewRecord!='1'){ ?>
    <div class="row">
         <?php echo CHtml::image(Yii::app()->request->baseUrl.'/upload/place/'.$model->filename,"filename",array("width"=>200)); ?>
    </div>
		<?php }?>
	
	


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->