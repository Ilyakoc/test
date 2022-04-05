<?php
	
//var_dump($dataProvider);
	
$this->widget('widget.listView.DSizerListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '/shop/_products',
// 	'viewData' => [],
// 	'enableHistory'=>true,
	'sorterHeader'=>'Сортировка:',
	'pagerCssClass'=>'pagination',
	'pager'=>[
		'class' => 'DLinkPager',
		'maxButtonCount'=>'5',
		'header'=>'',
	],
	'loadingCssClass'=>'loading-content',
	'itemsTagName'=>'div',
	'emptyText' => '<div class="category-empty col-12">Нет товаров для отображения.</div>',
	'itemsCssClass'=>'product-list row',
// 	'sortableAttributes'=>[
// 		'title',
// 		'price',
// 	],
	'afterAjaxUpdate'=>'function(){}',
	'id'=>'ajaxListView',
	'sizerHeader'=>'Показать: ',
	'sizerVariants'=>[15, 30, 60, 120],
	//'template'=>'{sizer}{sorter}{items}{pager}{sizer}<div class="sort-hidden">{sorter}</div>', // with sizer 
	'template'=>'{sorter}{items}{pager}<div class="sort-hidden">{sorter}</div>',
	'enableHistory' => true,
));