<?php

$this->widget('zii.widgets.CListView', 
  array(
    'dataProvider' => $roomChargesDataProvider,
        'itemView' => '/roomCharges/_view'
  ));
?>