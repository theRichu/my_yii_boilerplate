<?php
/* @var $this RoomsController */
/* @var $model Rooms */

$this->breadcrumbs = array(
// 'Rooms'=>array('index'),
'Places' => array(
  'places/view','id' => $model->place_id
),$model->name
);

$this->menu = array(
  array(
  'label' => 'List Rooms','url' => array(
  'index'
)
),
      array(
        'label' => $model->label() . ' ' . Yii::t('app', '사진   등록하기'),
            'url' => array(
              'roomImages/create','rid' => $model->id
            )
      ),
      array(
        'label' => $model->label() . ' ' . Yii::t('app', '공지 등록하기'),
        'url' => array(
          'notices/create','rid' => $model->id
        )
      ),

      array(
        'label' => 'Update Rooms','url' => array(
        'update','id' => $model->id
      )
      ),
      array(
        'label' => 'Delete Rooms','url' => '#',
            'linkOptions' => array(
              'submit' => array(
              'delete','id' => $model->id
            ),'confirm' => 'Are you sure you want to delete this item?'
            )
      ),array(
        'label' => 'Manage Rooms','url' => array(
        'admin'
      )
      )
);
?>

<h1><?php echo $model->name; ?></h1>
<?php
$images = array();
foreach ($model->roomImages as $record) {
  $images[] = array(
    
        'url' => Yii::app()->request->baseUrl . '/upload/room/' . $record->filename,
        'src' => Yii::app()->request->baseUrl . '/upload/room/t_' . $record->filename,
          'options' => array('title' => $record->title)
  );
}
if (count($images)) {
 $this->widget('yiiwheels.widgets.gallery.WhCarousel', array('items' => $images));
 }
?>




<br />
<h1>Room Images</h1>

<?php $this->widget('yiiwheels.widgets.gallery.WhGallery', array('items' => $images));?>

<br />

	



<br />
<?php 
$charges = array();
foreach ($model->roomCharges as $record) {
  $charges[] = array(
    $record->id => $record->description ." : " .$record->price ,
  );
}

echo TbHtml::dropDownList('dropDown', '', $charges);
?>

<?php
$options = array();
foreach ($model->roomOptions as $record) {
  $options[] = array(
    $record->option_id => $record->option->name,
  );
}

echo TbHtml::dropDownList('dropDown', '', $options);
?>
<?php /*  echo TbHtml::linkButton('지금 예약하기', 
  array(
    'color' => TbHtml::BUTTON_COLOR_PRIMARY,
    'size' => TbHtml::BUTTON_SIZE_LARGE,
    'url' => array('reservations/create', 'id'=>$model->id, 'rid'=>$model->id),
)
); */?>

<?php $this->widget('bootstrap.widgets.TbModal', array(
    'id' => 'myModal',
    'header' => 'Modal Heading',
    'content' => '<p>One fine body...</p>',
    'footer' => array(
        TbHtml::button('Save Changes', array('data-dismiss' => 'modal', 'color' => TbHtml::BUTTON_COLOR_PRIMARY)),
        TbHtml::button('Close', array('data-dismiss' => 'modal')),
     ),
)); ?>
 
<?php 
echo TbHtml::button('지금 예약하기', array(
    'color' => TbHtml::BUTTON_COLOR_PRIMARY,
    'size' => TbHtml::BUTTON_SIZE_LARGE,
    'data-toggle' => 'modal',
    'data-target' => '#myModal',
)); 
?>

<br/>
	
	<?php echo TbHtml::tabbableTabs(array(
    array('label' => '예약현황', 'active' => true,
 'content' => $this->renderPartial("extensions/_calender", array('model' => $model), $this)),
    array('label' => '가격정보', 
'content' => $this->renderPartial("extensions/_charge", array('roomChargesDataProvider' => $roomChargesDataProvider), $this)),
    array('label' => '옵션정보', 
'content' => $this->renderPartial("extensions/_option", array('roomOptionsDataProvider' => $roomOptionsDataProvider), $this)),
), array('placement' => TbHtml::TABS_PLACEMENT_LEFT)); ?>

<?php


$this->widget('zii.widgets.CDetailView', 
  array(
    'data' => $model,
        'attributes' => array(
          'id','name',
              array(
                'name' => 'place','type' => 'raw',
                    'value' => isset($model->place_id) ? CHtml::link(
                      CHtml::encode($model->places->name), 
                      array(
                        'places/view','id' => $model->place_id
                      )) : "unknown"
              ),'capacity','floorspace','contactnumber','workstart','workto',
              
              'create_time',
              array(
                'name' => 'create_user_id','type' => 'raw',
                    'value' => isset($model->create_user_id) ? CHtml::link(
                      CHtml::encode($model->creater->username), 
                      array(
                        'user/user/view','id' => $model->create_user_id
                      )) : "unknown"
              ),'update_time',
              array(
                'name' => 'update_user_id','type' => 'raw',
                    'value' => isset($model->update_user_id) ? CHtml::link(
                      CHtml::encode($model->updater->username), 
                      array(
                        'user/user/view','id' => $model->update_user_id
                      )) : "unknown"
              )
        )
        
  ));
?>



