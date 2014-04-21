<?php
/* @var $this RoomsController */
/* @var $data Rooms */
?>

<div class="view">
<?php
$images = array();
foreach ($data->roomImages as $record) {
  $images[] = array(
    
        'url' => Yii::app()->request->baseUrl . '/upload/room/' . $record->filename,
        'src' => Yii::app()->request->baseUrl . '/upload/room/' . $record->filename,
          'options' => array('title' => $record->title)
  );
}
if (count($images)) {
 $this->widget('yiiwheels.widgets.gallery.WhCarousel', array('items' => $images));
 }
?>



	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->name), array('rooms/view', 'id'=>$data->id)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('place_id')); ?>:</b>
	<b><?php echo isset ( $data->place_id ) ? CHtml::link(CHtml::encode ( $data->places->name .": " .$data->places->address ),array('/', 'places'=>$data->place_id)) : "unknown"; ?></b>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('capacity')); ?>:</b>
	<?php echo CHtml::encode($data->capacity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('floorspace')); ?>:</b>
	<?php echo CHtml::encode($data->floorspace); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contactnumber')); ?>:</b>
	<?php echo CHtml::encode($data->contactnumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('workstart')); ?>:</b>
	<?php echo CHtml::encode($data->workstart); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('workto')); ?>:</b>
	<?php echo CHtml::encode($data->workto); ?>
	<br />
	
	<b>Charges:</b>
<?php // echo CHtml::encode(count($data->roomCharges)); ?>

<?php   $roomChargesDataProvider=new CActiveDataProvider('RoomCharges',array(
	    'criteria'=>array(
	      'condition'=>'room_id=:roomId',
	      'params'=>array(':roomId'=>$data->id),
	    ),
	    'pagination'=>array(
	      'pageSize'=>10,
	    ),
	  ));
?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$roomChargesDataProvider,
  'summaryText'=>'Page {page} of {pages}',
  'template'=>'{items} {summary} {pager}',
  'pager'=>array(
    'class'=>'CLinkPager',
    'header'=>'',
  ),
	'itemView'=>'/rooms/extensions/_viewChargeSimple',
)); ?>
	<b>Options:</b>
<?php // echo CHtml::encode(count($data->roomOptions)); ?>

<br />

<?php   $roomOptionsDataProvider=new CActiveDataProvider('RoomOptions',array(
	    'criteria'=>array(
	      'condition'=>'room_id=:roomId',
	      'params'=>array(':roomId'=>$data->id),
	    ),
	    'pagination'=>array(
	      'pageSize'=>10,
	    ),
	  ));
?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$roomOptionsDataProvider,
  'summaryText'=>'Page {page} of {pages}',
  'template'=>'{items} {summary} {pager}',
  'pager'=>array(
    'class'=>'CLinkPager',
    'header'=>'',
  ),
	'itemView'=>'/rooms/extensions/_viewOptionSimple',
)); ?>




<br />
<?php echo TbHtml::linkButton('자세히 보기', 
  array(
    'color' => TbHtml::BUTTON_COLOR_INFO,
    'url' => array('rooms/view', 'id'=>$data->id),
)
); ?>
	

	



</div>