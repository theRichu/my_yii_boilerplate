<?php
/* @var $this PlacesController */
/* @var $model Places */

$this->breadcrumbs=array(
	'Places'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'장소 리스트', 'url'=>array('index')),
	array('label'=>'장소 관리', 'url'=>array('admin')),
);
?>

<h1>Create Places</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>