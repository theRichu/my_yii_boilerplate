<?php
/* @var $this PlacesController */
/* @var $model Places */

$this->breadcrumbs=array(
	'Places'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'장소 리스트', 'url'=>array('index')),
	array('label'=>'장소 등록하기', 'url'=>array('create')),
	array('label'=>'장소 보기', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'장소 등록하기', 'url'=>array('admin')),
);
?>

<h1>Update Places <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>