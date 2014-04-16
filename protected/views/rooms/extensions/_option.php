<?php

$this->widget('zii.widgets.CListView', 
  array(
    'dataProvider' => $roomOptionsDataProvider,
        'itemView' => '/roomOptions/_view'
  ));
?>
