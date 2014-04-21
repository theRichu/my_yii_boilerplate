
<div>
		<div class="row">
        <?php echo CHtml::activeLabelEx($model,"[$index]photo"); ?>
        <?php echo CHtml::activeFileField($model, "[$index]photo"); ?>  
        <?php echo CHtml::error($model,"[$index]photo"); ?>
    </div>

    <?php  if($model->isNewRecord!='1'){ ?>
    <div class="row">
         <?php echo CHtml::image(Yii::app()->request->baseUrl.'/upload/place/'.$model->filename,"[$index]filename",array("width"=>200)); ?>
    </div>
		<?php } ?>

		<div class="row">
		<?php echo CHtml::activeLabelEx($model,"[$index]title"); ?>
		<?php echo CHtml::activeTextField($model, "[$index]title", array('maxlength' => 255)); ?>
		<?php echo CHtml::error($model,"[$index]title"); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo CHtml::activeLabelEx($model,"[$index]description"); ?>
		<?php echo CHtml::activetextArea($model, "[$index]description"); ?>
		<?php echo CHtml::error($model,"[$index]description"); ?>
		</div><!-- row -->
</div>