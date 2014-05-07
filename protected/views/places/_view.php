<?php
/* @var $this PlacesController */
/* @var $data Places */

$images = array ();
foreach ( $data->placeImages as $record ) {
	$images [] = array (
			
			'url' => Yii::app ()->request->baseUrl . '/upload/place/' . $record->filename,
			'src' => Yii::app ()->request->baseUrl . '/upload/place/t_' . $record->filename,
			'options' => array (
					'title' => $record->title 
			) 
	);
}
?>

<li class="span4">
  <div class="thumbnail">
		<?php	if (count ( $images )) {	 echo Chtml::image($images[0]['url']);} ?>
	
			<div class="caption">
      <h3><?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?></h3>

      <dl>
        <dt><?php echo CHtml::encode($data->getAttributeLabel('description')); ?></dt>
        <dd><?php echo CHtml::encode($data->description); ?></dd>
        <dt>공간 개수</dt>
        <dd><?php echo CHtml::encode(count($data->rooms)); ?></dd>
      </dl>
      <address><?php echo CHtml::encode($data->address); ?> </address>
      <p>
			  <?php
					echo TbHtml::linkButton ( '자세히 보기', array (
							'block' => true,
							'size' => TbHtml::BUTTON_SIZE_LARGE,
							'color' => TbHtml::BUTTON_COLOR_INFO,
							'url' => array (
									'places/view',
									'id' => $data->id 
							) 
					) );
					?>
		</p>
    </div>

  </div>


</li>
