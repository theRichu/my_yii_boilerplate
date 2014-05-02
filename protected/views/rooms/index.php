<?php
/* @var $this RoomsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array (
		'Rooms' 
);

$this->menu = array (
	
		array (
				'label' => '강의실 관리',
				'url' => array (
						'admin' 
				) 
		) 
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
});
$('.search-form form').submit(function(){
         $.fn.yiiListView.update('roomSearchResult', { //this section is taken from admin.php. w/only this line diff
                data: $(this).serialize()
        });
        return false;
});
");
?>

<h1>Rooms</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:block">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
</div><!-- search-form -->
<br/>
<?php  

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$model->search(),
	'id'=>'roomSearchResult',			
	'itemView'=>'_view',
	'itemsTagName'=>'ul',
	'itemsCssClass'=>'thumbnails',
	'htmlOptions' => array(
	'class' => 'row-fluid',
	),
	'summaryText'=>'Displaying {start}-{end} of {count} results.',
	'template' => "{pager}{items}{summary}",
	'enablePagination'=>true,
	'ajaxUpdate'=>true,
)); 
?>  

