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
            'bootstrap.widgets.TbTimePicker',
            array(
                'name' => 'Rooms[workstart]',
                'value' => '09:00',
                'noAppend' => true,
                'options' => array(
                    'disableFocus' => true, // mandatory
                    'showMeridian' => false // irrelevant
                )
            )
        );        		
		?>
		<?php echo $form->error($model,'workstart'); ?>
		</div><!-- row -->
		
		<div class="row">
		<?php echo $form->labelEx($model,'workto'); ?>
				<?php 
        $this->widget(
            'bootstrap.widgets.TbTimePicker',
            array(
                'name' => 'Rooms[workto]',
                'value' => '18:00',
                'noAppend' => true,
                'options' => array(
                  'disableFocus' => true, // mandatory
                  'showMeridian' => false // irrelevant
                )
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
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->