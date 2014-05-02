<?php
/* @var $this PlacesController */
/* @var $model Places */

$this->breadcrumbs=array(
	'Places'=>array('index'),
	$model->name,
);

$images = array();

foreach ($model->placeImages as $record) {
	$images[] = array(
			'url' => Yii::app()->request->baseUrl . '/upload/place/' . $record->filename,
			'src' => Yii::app()->request->baseUrl . '/upload/place/t_' . $record->filename,
			'options' => array('title' => $record->title)
	);
}

$this->menu=array(
 
  array('label'=>'여기에 ' . Yii::t('app', '강의실 등록하기') , 'url'=>array('rooms/create','pid'=>$model->id)),
  array('label'=>$model->label(2). ' ' . Yii::t('app', '더 보기'), 'url'=>array('index')),
  array('label'=>$model->label(). ' ' . Yii::t('app', '등록하기'), 'url'=>array('create')),
  array('label'=>$model->label(). ' ' . Yii::t('app', '수정') , 'url'=>array('update', 'id' => $model->id)),
  array('label'=>$model->label(). ' ' . Yii::t('app', '삭제') , 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
  array('label'=>$model->label(2). ' ' . Yii::t('app', '관리하기') , 'url'=>array('admin')),
);
?>

<h1><?php echo $model->name; ?></h1>


<?php
if (count($images)) {
 $this->widget('yiiwheels.widgets.gallery.WhCarousel', array('items' => $images));
 ?>
<br/>
<h1>Place Images</h1>
<?php $this->widget('yiiwheels.widgets.gallery.WhGallery', array('items' => $images)); }?>

<h2>공간들</h2>
<?php
$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$roomsDataProvider,
		'id'=>'placeSearchResult',
		'itemView'=>'/rooms/_view',
		'itemsTagName'=>'ul',
		'itemsCssClass'=>'thumbnails',
		'htmlOptions' => array(
				'class' => 'row-fluid',
		),
		'summaryText'=>'Displaying {start}-{end} of {count} results.',
		'template' => "{pager}{items}{summary}",
		'enablePagination'=>true,
		'ajaxUpdate'=>true,
)); 
 ?>

<?php 
if(($model->map_lat) && ($model->map_lag)){
  Yii::import('ext.EGMAP.*');
  
  $gMap = new EGMap();
  $gMap->setJsName('test_map');
  $gMap->width = '100%';
  $gMap->height = '300';
  $gMap->zoom = 13;
  $gMap->setCenter($model->map_lat, $model->map_lag);
  
  $info_box = new EGMapInfoBox('<div style="color:#fff;border: 1px solid black; margin-top: 8px; background: #000; padding: 5px;">'.$model->name.'<br/>'.$model->address.'</div>');

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
  $marker = new EGMapMarker($model->map_lat, $model->map_lag, array('title' => $model->name));
  $marker->addHtmlInfoBox($info_box);
  
  $gMap->addMarker($marker);
  
  $gMap->renderMap();
}
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'address',
		'description',
		'map_lat',
		'map_lag',
    'create_time',
    array (
      'name' => 'create_user_id',
      'type' => 'raw',
      'value' => isset ( $model->create_user_id ) ? CHtml::link(CHtml::encode ( $model->creater->username ),array('user/user/view', 'id'=>$model->create_user_id)) : "unknown"
    ),
    'update_time',
    array (
      'name' => 'update_user_id',
      'type' => 'raw',
      'value' => isset ( $model->update_user_id ) ? CHtml::link(CHtml::encode ( $model->updater->username ),array('user/user/view', 'id'=>$model->update_user_id)) : "unknown"
    ),
	),
)); ?>

