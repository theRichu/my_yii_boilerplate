<li>
	<div class="row">
		<?php echo CHtml::activeLabel($model,"[$index]title"); ?>
		<?php echo CHtml::activeTextField($model,"[$index]title",array('size'=>60,'maxlength'=>255)); ?>
	</div>
	<div class="row">
		<?php echo CHtml::activeLabel($model,"[$index]photo"); ?>
		<?php echo CHtml::activeFileField($model,"[$index]photo"); ?>
	</div>
	<div class="row">
		<?php echo CHtml::activeLabel($model,"[$index]caption"); ?>
		<?php echo CHtml::activeTextArea($model,"[$index]caption",array('rows'=>6, 'cols'=>50)); ?>
	</div>
</li>