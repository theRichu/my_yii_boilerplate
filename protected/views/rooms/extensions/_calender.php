<?php
$items = array();
foreach ($model->notices as $record) {
  $items[] = array(
        'title' => $record->specialprice,
        'start' => $record->from,
        'end' => $record->to,
        'url' => Yii::app()->createUrl('notices', array('view' => $record->id)),
  );
}

$this->widget('ext.efullcalendar.EFullCalendar', array(
  // polish version available, uncomment to use it
   'lang'=>'ko',
  // you can create your own translation by copying locale/pl.php
  // and customizing it

  // remove to use without theme
  // this is relative path to:
  // themes/<path>
  'themeCssFile'=>'cupertino/theme.css',

  // raw html tags
  'htmlOptions'=>array(
    // you can scale it down as well, try 80%
    'style'=>'width:100%'
  ),
  // FullCalendar's options.
  // Documentation available at
  // http://arshaw.com/fullcalendar/docs/
  'options'=>array(
    'header'=>array(
      'left'=>'prev,next',
      'center'=>'title',
      'right'=>'today'
    ),
    'lazyFetching'=>true,
  //  'events'=>$calendarEventsUrl, // action URL for dynamic events, or
    'events'=>$items, // pass array of events directly

    // event handling
    // mouseover for example
    //'eventMouseover'=>new CJavaScriptExpression("js_function_callback"),
  )
));

?>
