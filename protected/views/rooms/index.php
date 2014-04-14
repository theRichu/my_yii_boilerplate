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
        'type' => 'search',
        'method'=> 'get',
        'htmlOptions' => array('class' => 'well well-large'),
    )
);
?>


<?php 
  echo $form->dropDownList(
  $model_place,
  'state',
   $model->getStateOptions(),
   array(
     'prompt'=>'도/광역시',
     'ajax' => array(
       'type'=>'POST',
       'url'=>CController::createUrl('loadcities'),
       'update'=>'#city_name',
       'data'=>array('state'=>'js:this.value'),
      ) 
)); 

echo CHtml::dropDownList(
    'city_name',
    '',
    array(), 
    array(
      'prompt'=>'시/군/구',
      /* 'ajax' => array(
        'type'=>'POST',
        'url'=>CController::createUrl('loaddistricts'),
        'update'=>'#district_name',
        'data'=>array('city'=>'js:this.value'),
      ) */ 
));


//echo CHtml::dropDownList('district_name','', array(), array('prompt'=>'동/면/읍'));
 ?>



 <?php echo $form->select2Row(
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
        );?>
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

    <?php 
    // range slider
    $this->widget('zii.widgets.jui.CJuiSlider', array(
      'options'=>array(
        'min'=>10,
        'max'=>50,
        'range'=>true,
        'values'=>array(5, 20)
      ),
    ));
    ?>
 <?php
echo $form->textFieldRow(
    $model,
    'textField',
    array(
        'class' => 'input-medium',
        'name'=>'capacity',
        'value'=>isset($_GET['c']) ? CHtml::encode($_GET['c']) : '',
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


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
