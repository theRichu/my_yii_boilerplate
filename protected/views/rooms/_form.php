<?php
/* @var $this RoomsController */
/* @var $model Rooms */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rooms-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
  'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'capacity'); ?>
		<?php echo $form->textField($model,'capacity'); ?>
		<?php echo $form->error($model,'capacity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'floorspace'); ?>
		<?php echo $form->textField($model,'floorspace'); ?>
		<?php echo $form->error($model,'floorspace'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contactnumber'); ?>
		<?php echo $form->textField($model,'contactnumber',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'contactnumber'); ?>
	</div>

<div class="row">
		<?php echo $form->labelEx($model,'workstart'); ?>
		<?php 
        $this->widget(
                'yiiwheels.widgets.timepicker.WhTimePicker',
            array(
                'name' => 'Rooms[workstart]',
                'value' => '09:00 AM',

            )
        );        		
		?>
		<?php echo $form->error($model,'workstart'); ?>
		</div><!-- row -->
		
		<div class="row">
		<?php echo $form->labelEx($model,'workto'); ?>
				<?php 
        $this->widget(
                'yiiwheels.widgets.timepicker.WhTimePicker',
            array(
                'name' => 'Rooms[workto]',
                'value' => '06:00 PM',

            )
        );        		
		?>
		<?php echo $form->error($model,'workto'); ?>
		</div><!-- row -->

		
		
		

		<div class="row">
		<?php 
		$charges = $model->roomCharges;
		
		$this->widget('ext.widgets.tabularinput.XTabularInput',array(
      'models'=>$charges,
      'containerTagName'=>'table',
      'headerTagName'=>'thead',
      'header'=>'
          <tr>
              <td>설명</td>
              <td>가격</td>
              <td></td>
          </tr>
      ',
      'inputContainerTagName'=>'tbody',
      'inputTagName'=>'tr',
      'inputView'=>'extensions/_roomCharge',
      'inputUrl'=>$this->createUrl('request/addRoomCharge'),
      'addTemplate'=>'<tbody><tr><td colspan="4">{link}</td></tr></tbody>',
      'addLabel'=>Yii::t('ui','Add new Price'),
      'addHtmlOptions'=>array('class'=>'blue pill full-width'),
      'removeTemplate'=>'<td>{link}</td>',
      'removeLabel'=>Yii::t('ui','Delete'),
      'removeHtmlOptions'=>array('class'=>'red pill'),
    ));
    ?>
		</div><!-- row -->
		
				<div class="row">
		<?php 
		$options = $model->roomOptions;
		
		$this->widget('ext.widgets.tabularinput.XTabularInput',array(
      'models'=>$options,
      'containerTagName'=>'table',
      'headerTagName'=>'thead',
      'header'=>'
          <tr>
              <td>옵션</td>
              <td>가격</td>
              <td>설명</td>
              <td></td>
          </tr>
      ',
      'inputContainerTagName'=>'tbody',
      'inputTagName'=>'tr',
      'inputView'=>'extensions/_roomOption',
      'inputUrl'=>$this->createUrl('request/addRoomOption'),
      'addTemplate'=>'<tbody><tr><td colspan="4">{link}</td></tr></tbody>',
      'addLabel'=>Yii::t('ui','Add new Option'),
      'addHtmlOptions'=>array('class'=>'blue pill full-width'),
      'removeTemplate'=>'<td>{link}</td>',
      'removeLabel'=>Yii::t('ui','Delete'),
      'removeHtmlOptions'=>array('class'=>'red pill'),
    ));
    ?>
		</div><!-- row -->
	
	
				<div class="row">
		<?php 
		$roomImages = $model->roomImages;
		
		$this->widget('ext.widgets.tabularinput.XTabularInput',array(
      'models'=>$roomImages,
      'containerTagName'=>'div',
      'inputTagName'=>'div',
      'inputView'=>'extensions/_roomImage',
      'inputUrl'=>$this->createUrl('request/addRoomImage'),
      'addTemplate'=>'{link}',
      'addLabel'=>Yii::t('ui','Add new Photo'),
      'addHtmlOptions'=>array('class'=>'blue pill full-width'),
      'removeTemplate'=>'<td>{link}</td>',
      'removeLabel'=>Yii::t('ui','Delete'),
      'removeHtmlOptions'=>array('class'=>'red pill'),
    ));
    ?>
		</div><!-- row -->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
    
<script type="text/javascript">
// I need to know how many photos I've already added when the validate return FALSE
var photosAdded = 0<?php //echo $photosNumber; ?>;
 
// Add the event to the period's add button
$('#addPhotos').click(function () {
    // I'm going to clone the first div containing the Model input couse I don't want to create a new div and add every single structure
    var divCloned = $('#photo-0').clone();      
    // I'm attaching the div to the last input created
    $('#photo-'+(photosAdded++)).after(divCloned);
    // Changin the div id
    divCloned.attr('id', 'photo-'+photosAdded);
    // Initializing the div contents
    initNewInputs(divCloned.children('.simple'), photosAdded);
});
 
function initNewInputs( divs, idNumber ) {
    // Taking the div labels and resetting them. If you send wrong information,
    // Yii will show the errors. If you than clone that div, the css will be cloned too, so we have to reset it
    var labels = divs.children('label').get();
    for ( var i in labels )
        labels[i].setAttribute('class', 'required');      
 
    // Taking all inputs and resetting them.
    // We have to set value to null, set the class attribute to null and change their id and name with the right id.
    var inputs = divs.children('input').get();      
 
    for ( var i in inputs  ) {
        inputs[i].value = "";
        inputs[i].setAttribute('class', '');
        inputs[i].id = inputs[i].id.replace(/\d+/, idNumber);
        inputs[i].name = inputs[i].name.replace(/\d+/, idNumber);
    }
}
</script>