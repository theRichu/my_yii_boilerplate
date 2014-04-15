<?php
/* @var $this NoticesController */
/* @var $model Notices */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notices-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'from'); ?>

<?php $this->widget(
  'yiiwheels.widgets.datetimepicker.WhDateTimePicker', 
  array(
    'attribute' => 'from',
    'name' => 'from',
    'model'=>$model,
    'pluginOptions' => array(
       'pickTime' => true,
      'format' => 'yyyy-MM-dd hh:mm',
      'pick12HourFormat' => true,
      'autoClose' => true,
    ),
    'htmlOptions' => array('placeholder' => '시작일시를 입력하세요','autoClose' => true),
    ));

?>
		
		<?php // echo $form->textField($model,'from'); ?>
		<?php echo $form->error($model,'from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'to'); ?>

<?php $this->widget(
  'yiiwheels.widgets.datetimepicker.WhDateTimePicker',
  array(
    'attribute' => 'to',
    'name' => 'to',
    'model'=>$model,
    'pluginOptions' => array(
       'pickTime' => true,
      'format' => 'yyyy-MM-dd hh:mm',
      'pick12HourFormat' => true,
      'autoClose' => true,
    ),
    'htmlOptions' => array('placeholder' => '종료일시를 입력하세요','autoClose' => true),
    ));

?>	
		<?php // echo $form->textField($model,'to'); ?>
		<?php echo $form->error($model,'to'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'specialprice'); ?>
		<?php echo $form->textField($model,'specialprice'); ?>
		<?php echo $form->error($model,'specialprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment'); ?>
		<?php echo $form->dropDownList($model,'payment', $model->getPaymentOptions()); ?>
		<?php echo $form->error($model,'payment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', $model->getStatusOptions()); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contactnumber'); ?>
		<?php echo $form->textField($model,'contactnumber',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'contactnumber'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->