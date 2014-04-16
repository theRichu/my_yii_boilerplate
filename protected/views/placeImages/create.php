<?php
/* @var $this PlaceImagesController */
/* @var $model PlaceImages */

$this->breadcrumbs = array (
		'Place Images' => array (
				'index' 
		),
		'Create' 
);

$this->menu = array (
		array (
				'label' => 'List PlaceImages',
				'url' => array (
						'index' 
				) 
		),
		array (
				'label' => 'Manage PlaceImages',
				'url' => array (
						'admin' 
				) 
		) 
);
?>

<h1>Create PlaceImages</h1>

<div class="form">
<?php echo CHtml::beginForm('','post',array
('enctype'=>'multipart/form-data'))?>
	<p class="note">
    Fields with <span class="required">*</span> are required.
  </p>



<ul class="tasks">
<?php for($i=0; $i<count($models); $i++):?>
<?php

	$this->renderPartial ( '_form', array (
			'model' => $models [$i],
			'index' => $i 
	) )?>
<?php endfor ?>
</ul>

  <div class="row buttons">
<?php

echo CHtml::button ( 'Add task', array (
		'class' => 'tasks-add' 
) )?>
<?php

Yii::app ()->clientScript->registerCoreScript ( "jquery" )?>
<script>
$(".tasks-add").click(function(){
$.ajax({
success: function(html){
$(".tasks").append(html);
},
type: 'get',
url: '<?php echo $this->createUrl ( 'field' )?>',
data: {
index: $(".tasks li").size()
},
cache: false,
dataType: 'html'
});
});
</script>
<?php echo CHtml::submitButton('Save')?>
</div>
<?php echo CHtml::endForm()?>
</div>
