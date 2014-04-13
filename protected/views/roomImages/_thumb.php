<li class="span3">
	<?php echo isset ( $data->filename ) ? CHtml::link(CHtml::image(Yii::app()->baseUrl."/upload/room/".$data->filename),array('roomImages/view', 'id'=>$data->id),array('class' => 'thumbnail', 'rel'=>'tooltip', 'data-title'=>$data->caption)) : "unknown"; ?>
	</li>