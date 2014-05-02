
<div>
<style>
  .thumb {
    height: 75px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
  }
</style>
<div class="row">
    <?php echo CHtml::activeFileField($model, "[$index]photo"); ?>  
		<output id="list"></output>
    <?php echo CHtml::error($model,"[$index]photo"); ?>
    </div>
    <?php  if($model->filename){ ?>
    <div class="row">
         <?php echo CHtml::image(Yii::app()->request->baseUrl.'/upload/place/'.$model->filename,"[$index]filename",array("width"=>200)); ?>
    </div>
<script>
 
</script>









    
    <div class="row">
		<?php echo CHtml::activeTextField($model, "[$index]filename"); ?>
		<?php echo CHtml::error($model,"[$index]filename"); ?>
		</div><!-- row -->
    
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

