<?php
/* @var $this PlacesController */
/* @var $model Places */
/* @var $form CActiveForm */
$state = (isset ( $_POST ['state'] )) ? $_POST ['state'] : '';
$city = (isset ( $_POST ['city'] )) ? $_POST ['city'] : '';

$state_setting = array (
		'prompt' => '도/광역시',
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

?>

<div class="wide form">
<?php

/**
 * @var TbActiveForm $form
 */
$form = $this->beginWidget ( 'bootstrap.widgets.TbActiveForm', array (
		'action' => Yii::app ()->createUrl ( $this->route ),
		'method' => 'GET' 
) );

echo TbHtml::dropDownList ( 'state', 'state', $model->getStateOptions (), $state_setting );
echo TbHtml::dropDownList ( 'city', 'city', $model->getCityOptions ( $state ), array (
		'prompt' => '시/군/구',
		'options' => array (
				$city => array (
						'selected' => 'selected' 
				) 
		) 
) );

/*
 * 'ajax' => array( 'type'=>'POST', 'url'=>CController::createUrl('loaddistricts'), 'update'=>'#district_name', 'data'=>array('city'=>'js:this.value'), )
 */
// echo CHtml::dropDownList('district_name','', array(), array('prompt'=>'동/면/읍'));

?>
<br />
<?php

echo $form->textField ( $model, 'search', array (
		'name' => 'q',
		'value' => isset ( $_POST ['q'] ) ? CHtml::encode ( $_POST ['q'] ) : '',
		'placeholder' => '검색',
		'prepend' => '<i class="icon-search"></i>' 
) );
?>

<?php

echo TbHtml::formActions ( array (
		TbHtml::submitButton ( '검색', array (
				'color' => TbHtml::BUTTON_COLOR_PRIMARY 
		) ),
		TbHtml::button ( 'Cancel' ) 
) );
?>

<?php

$this->endWidget ();
unset ( $form );

?>


</div>
<!-- search-form -->
