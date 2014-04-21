<?php
/* @var $this RoomsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Rooms',
);

$this->menu=array(
	array('label'=>'Create Rooms', 'url'=>array('create')),
	array('label'=>'Manage Rooms', 'url'=>array('admin')),
);
?>

<h1>Rooms</h1>

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

$state = (isset($_GET['state']))?$_GET['state']:'';
$city = (isset($_GET['city']))?$_GET['city']:'';

$state_setting = array(
  'prompt'=>'도/광역시',
  'ajax' => array(
    'type'=>'POST',
    'url'=>CController::createUrl('loadcities'),
    'update'=>'#city',
    'data'=>array('state'=>'js:this.value'),
  ),
  'options'=>array(
    $state=>array('selected'=>'selected'),
  )
);

echo CHtml::dropDownList(
   'state',
   'state',
   $model->getStateOptions(),
   $state_setting
); 

  
echo CHtml::dropDownList(
    'city',
    'city',
    $model->getCityOptions($state),
    array(
      'prompt'=>'시/군/구',
      'options'=>array(
        $city=>array('selected'=>'selected')
      )
  )
);

/* 'ajax' => array(
 'type'=>'POST',
  'url'=>CController::createUrl('loaddistricts'),
  'update'=>'#district_name',
  'data'=>array('city'=>'js:this.value'),
) */
//echo CHtml::dropDownList('district_name','', array(), array('prompt'=>'동/면/읍'));

/*echo $form->select2Row(
            $model,
            'name',
            array(
                'asDropDownList' => false,
                'options' => array(
                    'tags' => array('clever', 'is', 'better', 'clevertech'),
                    'placeholder' => 'type clever, or is, or just type!',
                    'width' => '40%',
                    'tokenSeparators' => array(',', ' ')
                )
            )
        );
*/


echo $form->textField(
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
<?php 
$option_model =  Options::model()->findAll();
$options = array();
foreach ($option_model as $record) {
   $options[$record->id] = $record->name;
}

echo  TbHtml::CheckBoxList('option', 'option', $options); 
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
