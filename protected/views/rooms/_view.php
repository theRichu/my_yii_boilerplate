<?php
/* @var $this RoomsController */
/* @var $data Rooms */
$images = array ();
foreach ( $data->roomImages as $record ) {
	$images [] = array (
			
			'url' => Yii::app ()->request->baseUrl . '/upload/room/' . $record->filename,
			'src' => Yii::app ()->request->baseUrl . '/upload/room/t_' . $record->filename,
			'options' => array (
					'title' => $record->title 
			) 
	);
}

$roomChargesDataProvider = new CActiveDataProvider ( 'RoomCharges', array (
		'criteria' => array (
				'condition' => 'room_id=:roomId',
				'params' => array (
						':roomId' => $data->id 
				) 
		),
		'pagination' => array (
				'pageSize' => 10 
		) 
) );

$roomOptionsDataProvider = new CActiveDataProvider ( 'RoomOptions', array (
		'criteria' => array (
				'condition' => 'room_id=:roomId',
				'params' => array (
						':roomId' => $data->id 
				) 
		),
		'pagination' => array (
				'pageSize' => 10 
		) 
) );
?>

<li class="span4">
  <div class="thumbnail">
    <div class="caption">
      <h3>
			<?php echo CHtml::link(CHtml::encode($data->name), array('rooms/view', 'id'=>$data->id)); ?>
		</h3>
<?php

if (count ( $images )) {
	echo Chtml::image($images[0]['url']);
}
?>




    <dl>
        <dt><?php echo CHtml::encode($data->getAttributeLabel('capacity')); ?></dt>
        <dd>		<?php echo CHtml::encode($data->capacity); ?></dd>

        <dt><?php echo CHtml::encode($data->getAttributeLabel('floorspace')); ?></dt>
        <dd>		<?php echo CHtml::encode($data->floorspace); ?></dd>

        <dt><?php echo CHtml::encode($data->getAttributeLabel('contactnumber')); ?></dt>
        <dd>		<?php echo CHtml::encode($data->contactnumber); ?></dd>

        <dt><?php echo CHtml::encode($data->getAttributeLabel('capacity')); ?></dt>
        <dd>		<?php echo CHtml::encode($data->capacity); ?></dd>

        <dt><?php echo CHtml::encode($data->getAttributeLabel('workstart')); ?></dt>
        <dd>		<?php echo CHtml::encode($data->workstart); ?></dd>

        <dt><?php echo CHtml::encode($data->getAttributeLabel('workto')); ?></dt>
        <dd>		<?php echo CHtml::encode($data->workto); ?></dd>

      </dl>

      <b>Charges:</b>
	<?php echo CHtml::encode(count($data->roomCharges)); ?>
	

	<?php
	
	$this->widget ( 'zii.widgets.CListView', array (
			'dataProvider' => $roomChargesDataProvider,
			'summaryText' => 'Page {page} of {pages}',
			'template' => '{items}',
			'pager' => array (
					'class' => 'CLinkPager',
					'header' => '' 
			),
			'itemView' => '/rooms/extensions/_viewChargeSimple' 
	) );
	?>
		<b>Options:</b>
	<?php  echo CHtml::encode(count($data->roomOptions)); ?>
	
	<br />
	

	<?php
	
	$this->widget ( 'zii.widgets.CListView', array (
			'dataProvider' => $roomOptionsDataProvider,
			'summaryText' => 'Page {page} of {pages}',
			'template' => '{items}',
			'pager' => array (
					'class' => 'CLinkPager',
					'header' => '' 
			),
			'itemView' => '/rooms/extensions/_viewOptionSimple' 
	) );
	?>
	
	<br />
	<?php
	
	echo TbHtml::linkButton ( '자세히 보기', array (
			'color' => TbHtml::BUTTON_COLOR_INFO,
			'url' => array (
					'rooms/view',
					'id' => $data->id 
			) 
	)); 
	?>
		
	</div>

  </div>
  </li>