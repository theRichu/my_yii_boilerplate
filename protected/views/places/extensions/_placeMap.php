<?php 
Yii::import('ext.EGMAP.*');

$gMap = new EGMap();

$gMap->setJsName('place_map');
$gMap->width = '100%';
$gMap->height = '300';
$gMap->zoom = 11;


  for($i = 0; $i < count ( $dataProvider->getData () ); $i ++) {
  	$place = $dataProvider->getData ()[$i];
  	fb($place->name);
  	$array_lat [] = $place->map_lat;
  	$array_lag [] = $place->map_lag;
  }
  
  $sum_lat = array_sum ( $array_lat );
  $sum_lag = array_sum ( $array_lag );
  $avg_lat = $sum_lat / sizeof ( $array_lat );
  $avg_lag = $sum_lag / sizeof ( $array_lag );
  
  $gMap->setCenter($avg_lat, $avg_lag);
  /*  
  $iterator =$dataProvider->getData();

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

    // with the second info box, we don't need to
    // set its properties as we are sharing a global
    // Create marker
    $marker[$i] = new EGMapMarker($category->map_lat, $category->map_lag, array('title' => $category->name));
    $marker[$i]->addHtmlInfoBox($info_box[$i]);
    $gMap->addMarker($marker[$i]);
 }

 */
 $gMap->renderMap(); 
  
 
  ?>
