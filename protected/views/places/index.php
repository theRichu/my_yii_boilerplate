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

<?php 
/** @var TbActiveForm $form */
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id' => 'searchForm',
        'type' => 'search',
        'method'=> 'get',
        'action'=> 'places',
        'htmlOptions' => array('class' => 'well well-large'),
    )
);
?>
 <?php
echo $form->textFieldRow(
    $model,
    'textField',
    array(
        'class' => 'input-medium',
        'name'=>'q',
        'value'=>isset($_GET['q']) ? CHtml::encode($_GET['q']) : '',
    ),
    array(
        'prepend' => '<i class="icon-search"></i>'
    )
);
?>

<?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => 'Submit'
            )
        ); ?>
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array('buttonType' => 'reset', 'label' => 'Reset')
        ); ?>

<?php 
  $this->endWidget();
  unset($form);
?>

<?php 
  Yii::import('ext.EGMAP.*');
  
  $gMap = new EGMap();
  $gMap->setJsName('place_map');
  $gMap->width = '100%';
  $gMap->height = '300';
  $gMap->zoom = 11;
  $gMap->setCenter(37.541, 126.986);
  
  $iterator = new CDataProviderIterator($dataProvider);
  foreach($iterator as $i => $category) {


    $info_box[$i] = new EGMapInfoBox('<div style="color:#fff;border: 1px solid black; margin-top: 8px; background: #000; padding: 5px;">'.CHtml::link(CHtml::encode($category->name), array('places/view', 'id'=>$category->id)).'<br/>'.$category->address.'</div>');

    // set the properties
    $info_box[$i]->pixelOffset = new EGMapSize('0','-140');
    $info_box[$i]->maxWidth = 0;
    $info_box[$i]->boxStyle = array(
      'width'=>'"280px"',
      'height'=>'"120px"',
      'background'=>'"url(http://google-maps-utility-library-v3.googlecode.com/svn/tags/infobox/1.1.9/examples/tipbox.gif) no-repeat"'
    );
    $info_box[$i]->closeBoxMargin = '"10px 2px 2px 2px"';
    $info_box[$i]->infoBoxClearance = new EGMapSize(1,1);
    $info_box[$i]->enableEventPropagation ='"floatPane"';
    fb($info_box[$i]);
    // with the second info box, we don't need to
    // set its properties as we are sharing a global
    // Create marker
    $marker[$i] = new EGMapMarker($category->map_lat, $category->map_lag, array('title' => $category->name));
    $marker[$i]->addHtmlInfoBox($info_box[$i]);
    $gMap->addMarker($marker[$i]);

 }
  

 
  $gMap->renderMap();
?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
