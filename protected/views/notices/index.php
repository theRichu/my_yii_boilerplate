<?php
/* @var $this NoticesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Notices',
);

$this->menu=array(
	array('label'=>'Manage Notices', 'url'=>array('admin')),
);
?>

<h1>Notices</h1>
<?php 
/** @var TbActiveForm $form */
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id' => 'searchForm',
      //  'type' => 'search',
        'method'=> 'get',
        'action'=> 'rooms',
        'htmlOptions' => array('class' => 'well well-large'),
    )
);

$max = (isset($_GET['max']))?$_GET['max']:80000;
$min = (isset($_GET['min']))?$_GET['min']:20000;

$this->widget(
  'yiiwheels.widgets.rangeslider.WhRangeSlider',
  array(
    'id'       => 'price',
    'name'     => 'price',
    'delayOut' => 4000,
    'type'     => 'editRange',
		'minDefaultValue' => $min,
		'maxDefaultValue' => $max,
    'minValue' => $min,
    'maxValue' => $max,
    'step' => 10000,
    
  )
  );
?>
<?php echo TbHtml::formActions(array(
    TbHtml::submitButton('검색', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
   // TbHtml::button('Cancel'),
)); ?>
<?php 
        
$this->endWidget();
unset($form);

?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
