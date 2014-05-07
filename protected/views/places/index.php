<?php
/* @var $this PlacesController */
/* @var $dataProvider CActiveDataProvider */


$this->breadcrumbs = array (
		'Places' 
);
$data = $model->search ();

$cs = Yii::app ()->getClientScript ();
$cs->registerCoreScript('bbq');
$cs->registerScriptFile ( 'http://maps.googleapis.com/maps/api/js?key=AIzaSyCSQjUlw9IP0QN7qeZ9Ii9NlmvhNIMusJ0&sensor=true&region=KR' );

$this->menu = array (
		array (
				'label' => '장소 등록',
				'url' => array (
						'create' 
				) 
		),
		array (
				'label' => '장소 관리',
				'url' => array (
						'admin' 
				) 
		) 
);



Yii::app ()->clientScript->registerScript ( 'search', "
initialize();
$('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
});
$('.search-form form').submit(function(){

         $.fn.yiiListView.update('placeSearchResult', { //this section is taken from admin.php. w/only this line diff
                data: $(this).serialize()
        });
		
        return false;
});		
");
//CClientScript::POS_HEAD
?>

<h1>Places</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display: block">
<?php $this->renderPartial ( '_search', array ('model' => $model) );?>
</div>

<div id="data">
<?php $this->renderPartial ( 'extensions/_placeNewMap', array ('dataProvider' => $data));?>
</div>



<?php
$this->widget ( 'zii.widgets.CListView', array (
		'dataProvider' => $data,
		'id' => 'placeSearchResult',
		'itemView' => '_view',
		'itemsTagName' => 'ul',
		'itemsCssClass' => 'thumbnails',
	//	'beforeAjaxUpdate' => "function(id){console.log(id)}",
		'htmlOptions' => array (
				'class' => 'row-fluid' 
		),
		'summaryText' => 'Displaying {start}-{end} of {count} results.',
		'template' => "{pager}{items}{summary}",
		//'afterAjaxUpdate'=>'function(){jQuery("#data").html("'.json_encode($data->getData()).'")}',
'afterAjaxUpdate'=>'function(id) { dataChanged() }',
		'enablePagination' => true 
) );
?>


<script type="text/javascript">

function dataChanged() {
	$.get('<?php echo Yii::app()->baseUrl ?>'+ '/places/map', {page: $("li.page.selected a").html()}, function(data) {
        $("#data").html(data);
        initialize();
    });
//  initialize();
}
</script>

