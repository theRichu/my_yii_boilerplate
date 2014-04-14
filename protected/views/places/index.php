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
        'htmlOptions' => array('class' => 'well well-large'),
    )
);

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


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
