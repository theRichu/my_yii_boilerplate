<?php
/* @var $this RoomsController */
/* @var $model Rooms */
/* @var $form CActiveForm */


$state = Yii::app()->request->getQuery('state');
$city = Yii::app()->request->getQuery('city');
$p = Yii::app()->request->getQuery('p');
$q = Yii::app()->request->getQuery('q');
$options = Yii::app()->request->getQuery('option');

$option_model = Options::model ()->findAll ();
$options = array ();
foreach ( $option_model as $record ) {
	$options [$record->id] = $record->name;
}

$state_setting = array (
		'prompt' => '도/광역시',
		'span' => 2,
		'ajax' => array (
				'type' => 'POST',
				'url' => CController::createUrl ( 'loadcities' ),
				'update' => '#city',
				'data' => array (
						'state' => 'js:this.value' 
				) 
		),
		'options' => array (
				$state => array (
						'selected' => 'selected' 
				) 
		) 
);

$city_setting = array (
		'prompt' => '시/군/구',
		'span' => 2,
		'options' => array (
				$city => array (
						'selected' => 'selected' 
				) 
		) 
);
?>

<div class="wide form">

<?php

$form = $this->beginWidget ( 'bootstrap.widgets.TbActiveForm', array (
		'action' => Yii::app ()->createUrl ( $this->route ),
		'method' => 'GET' 
) );

echo TbHtml::dropDownList ( 'state', 'state', $model->getStateOptions (), $state_setting );
echo TbHtml::dropDownList ( 'city', 'city', $model->getCityOptions ( $state ), $city_setting );

?>
<div class="row">
<?php

echo TbHtml::textField ( 'q', '', array (
		// 'class' => 'input-medium',
		'value' => isset ( $_GET ['q'] ) ? CHtml::encode ( $_GET ['q'] ) : '',
		'placeholder' => '검색',
		'prepend' => '<i class="icon-search"></i>',
		'span' => 4 
)
 );
?>
	</div>
  <div class="row">
<?php
echo TbHtml::textField ( 'p', '', array (
		'value' => isset ( $_GET ['p'] ) ? CHtml::encode ( $_GET ['p'] ) : '',
		'placeholder' => '인원수',
		'span' => 1 
) );
?>
	</div>

  <div class="row">
<?php
echo TbHtml::inlineCheckBoxList ( 'option', '', $options, array (
		'span' => 2 
) );
?>
</div>
<?php

$max = (isset ( $_GET ['max'] )) ? $_GET ['max'] : 80000;
$min = (isset ( $_GET ['min'] )) ? $_GET ['min'] : 20000;

$this->widget ( 'yiiwheels.widgets.rangeslider.WhRangeSlider', array (
		'id' => 'price',
		'name' => 'price',
		'delayOut' => 4000,
		'type' => 'editRange',
		'minDefaultValue' => $min,
		'maxDefaultValue' => $max,
		'minValue' => $min,
		'maxValue' => $max,
		'step' => 10000 
)
 );
?>



<?php

echo TbHtml::formActions ( array (
		TbHtml::submitButton ( '검색', array (
				'color' => TbHtml::BUTTON_COLOR_PRIMARY 
		) ),
		TbHtml::button ( 'Cancel' ) 
) );

$this->endWidget ();
unset ( $form );
?>


</div>
<!-- search-form -->