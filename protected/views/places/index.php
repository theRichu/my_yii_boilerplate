<?php
/* @var $this PlacesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Places',
);

$this->menu=array(
	array('label'=>'Create Places', 'url'=>array('create')),
	array('label'=>'Manage Places', 'url'=>array('admin')),
);
?>

<h1>Places</h1>

<form method="get">
<input type="search" placeholder="search" name="q" 

value="<?=isset($_GET['q']) ? CHtml::encode($_GET['q']) : '' ; 

?>" />
<input type="submit" value="search" />
</form>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
