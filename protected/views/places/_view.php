<?php
/* @var $this PlacesController */
/* @var $data Places */
?>

<div class="view">
<?php 
if(($data->map_lat) && ($data->map_lag)){
  Yii::import('ext.EGMAP.*');
  
  $gMap = new EGMap();
  $gMap->setJsName('test_map');
  $gMap->width = '200';
  $gMap->height = '200';
  $gMap->zoom = 13;
  $gMap->setCenter($data->map_lat, $data->map_lag);
  
  $info_box = new EGMapInfoBox('<div style="color:#fff;border: 1px solid black; margin-top: 8px; background: #000; padding: 5px;">'.$data->name.'<br/>'.$data->address.'</div>');
  
  // set the properties
  $info_box->pixelOffset = new EGMapSize('0','-140');
  $info_box->maxWidth = 0;
  $info_box->boxStyle = array(
    'width'=>'"280px"',
    'height'=>'"120px"',
    'background'=>'"url(http://google-maps-utility-library-v3.googlecode.com/svn/tags/infobox/1.1.9/examples/tipbox.gif) no-repeat"'
  );
  $info_box->closeBoxMargin = '"10px 2px 2px 2px"';
  $info_box->infoBoxClearance = new EGMapSize(1,1);
  $info_box->enableEventPropagation ='"floatPane"';
  
  // with the second info box, we don't need to
  // set its properties as we are sharing a global
  // Create marker
  $marker = new EGMapMarker($data->map_lat, $data->map_lag, array('title' => $data->name));
  $marker->addHtmlInfoBox($info_box);
  
  $gMap->addMarker($marker);
  
  $gMap->renderMap();
}
?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />
		<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />
		<b><?php echo CHtml::encode($data->getAttributeLabel('district')); ?>:</b>
	<?php echo CHtml::encode($data->district); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('map_lat')); ?>:</b>
	<?php echo CHtml::encode($data->map_lat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('map_lag')); ?>:</b>
	<?php echo CHtml::encode($data->map_lag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
	<b><?php echo isset ( $data->create_user_id ) ? CHtml::link(CHtml::encode ( $data->creater->username ),array('user/user/view', 'id'=>$data->create_user_id)) : "unknown"; ?></b>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user_id')); ?>:</b>
	<b><?php echo isset ( $data->update_user_id ) ? CHtml::link(CHtml::encode ( $data->updater->username ),array('user/user/view', 'id'=>$data->update_user_id)) : "unknown"; ?></b>
	<br />

	<?php 
	$this->widget(
    'bootstrap.widgets.TbButton',
    array(
        'label' => '자세히 보기',
        'type' => 'primary',
        'url' => array('places/view', 'id'=>$data->id),
    )
  );
  ?>
</div>