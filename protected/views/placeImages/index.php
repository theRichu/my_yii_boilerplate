<?php
/* @var $this PlaceImagesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Place Images',
);

$this->menu=array(
	array('label'=>'Manage PlaceImages', 'url'=>array('admin')),
);
?>

<h1>Place Images</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
