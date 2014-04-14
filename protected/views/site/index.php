<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>


<?php $this->beginWidget(
    'bootstrap.widgets.TbHeroUnit',
    array(
        'heading' => CHtml::encode(Yii::app()->name),
    )
); ?>
 
    <p>Welcome</p>
 
    <p><?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'type' => 'primary',
                'size' => 'large',
                'label' => 'Learn more',
            )
        ); ?></p>
 
<?php $this->endWidget(); ?>