
<div>
		<div class="row">
        <?php echo CHtml::activeLabelEx($model,"[$index]filename"); ?>
        <?php echo CHtml::activeFileField($model, "[$index]image"); ?>  
        <?php echo CHtml::error($model,"[$index]filename"); ?>
    </div>
    
    <?php /* if($model->isNewRecord!='1'){ ?>
    <div class="row">
         <?php echo CHtml::image(Yii::app()->request->baseUrl.'/upload/room/'.$model->filename,"[$index]filename",array("width"=>200)); ?>
    </div>
		<?php } */?>

		<div class="row">
		<?php echo CHtml::activeLabelEx($model,"[$index]caption"); ?>
		<?php echo CHtml::activeTextField($model, "[$index]caption", array('maxlength' => 255)); ?>
		<?php echo CHtml::error($model,"[$index]caption"); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo CHtml::activeLabelEx($model,"[$index]content"); ?>
		<?php echo CHtml::activetextArea($model, "[$index]content"); ?>
		<?php echo CHtml::error($model,"[$index]content"); ?>
		</div><!-- row -->
</div>