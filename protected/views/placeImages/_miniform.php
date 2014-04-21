<div class="form">
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

<ul class="images">
<?php for($i=0; $i<count($models); $i++):?>
<?php

	
$this->renderPartial ( 'form', array (
			'model' => $models[$i],
			'index' => $i 
	) )?>
<?php endfor ?>
</ul>

  <div class="row buttons">
<?php

echo CHtml::button ( 'Add image', array (
		'class' => 'images-add' 
) )?>
<?php


Yii::app ()->clientScript->registerCoreScript ( "jquery" )?>
<script>
$(".images-add").click(function(){
	$.ajax({
		success: function(html){
		$(".images").append(html);
		},
		type: 'get',
		url: '<?php echo $this->createUrl ('field')?>',
		data: {
			index: $(".images li").size()
		},
		cache: false,
		dataType: 'html'
	});
});
</script>
<?php echo CHtml::submitButton('Save')?>
</div>

<?php $this->endWidget(); ?>

</div>
