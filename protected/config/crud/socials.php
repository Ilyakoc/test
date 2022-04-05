<?php
/**
 * Файл настроек модели
 */
return [
	'class'=>'\crud\models\ar\Social',
	'config'=>[
        'tablename'=>'crud_socials',
        'definitions'=>[
            'column.pk',
            'column.create_time'=>['label'=>'Дата создания'],
            'column.update_time',
            'column.published',
            'column.title',
			'column.sort',
			'icon_html'=>['type'=>'string', 'label'=>'Иконка (HTML)'],
			'icon_html_mobile'=>['type'=>'string', 'label'=>'Иконка (мобильная версия) (HTML)'],
            ['name'=>'icon_svg', 'type'=>'column.file', 'label'=>'Иконка (SVG)', 'behaviorName'=>'iconSvgBehavior', 'types'=>'svg'],
            ['name'=>'icon_svg_mobile', 'type'=>'column.file', 'label'=>'Иконка (мобильная версия) (SVG)', 'behaviorName'=>'iconSvgMobileBehavior', 'types'=>'svg'],
            ['name'=>'icon', 'type'=>'column.image', 'label'=>'Иконка', 'behaviorName'=>'iconBehavior'],
            ['name'=>'icon_mobile', 'type'=>'column.image', 'label'=>'Иконка (мобильная версия)', 'behaviorName'=>'iconMobileBehavior'],
            'url'=>['type'=>'string', 'label'=>'Ссылка']            
        ],
        'rules'=>[
            'safe',
            ['title', 'required'],
            ['title, icon_html, icon_html_mobile', 'length', 'max'=>255],
			['url', 'safe'],
        ],
        'scopes'=>[
            'byDefaultOrder'=>[
	            'order'=>'`t`.`sort`, `t`.`title`, `t`.`id` DESC'
            ]
        ],
        'methods'=>[
            'public static function getItems() {
				$items=[];
				if($models=static::model()->published()->byDefaultOrder()->findAll()) {
					foreach($models as $model) {
						$item=[
							"title"=>$model->title,
							"url"=>$model->url,
							"icon_html"=>trim($model->icon_html),
							"icon_html_mobile"=>trim($model->icon_html_mobile),
							"icon_svg"=>"",
							"icon_svg_mobile"=>"",
							"icon"=>"",
							"icon_mobile"=>"",
							"html"=>"",
							"html_mobile"=>""
						];
						if($item["icon_html"]) { $item["html"]=$item["icon_html"]; }
						if($item["icon_html_mobile"]) { $item["html_mobile"]=$item["icon_html_mobile"]; }
						if($model->iconSvgBehavior->exists()) {
							$item["icon_svg"]=$model->iconSvgBehavior->getSrc();
							if(!$item["html"]) { $item["html"]=\CHtml::image($item["icon_svg"], ""); }
						}
						if($model->iconSvgMobileBehavior->exists()) {
							$item["icon_svg_mobile"]=$model->iconSvgMobileBehavior->getSrc();
							if(!$item["html_mobile"]) { $item["html_mobile"]=\CHtml::image($item["icon_svg_mobile"], ""); }
						}
						if($model->iconBehavior->exists()) {
							$item["icon"]=$model->iconBehavior->getSrc();
							if(!$item["html"]) { $item["html"]=\CHtml::image($item["icon"], ""); }
						}
						if($model->iconMobileBehavior->exists()) {
							$item["icon_mobile"]=$model->iconMobileBehavior->getSrc();
							if(!$item["html_mobile"]) { $item["html_mobile"]=\CHtml::image($item["icon_mobile"], ""); }
						}
						$items[]=(object)$item;
					}
				}
				return $items;
			}',
			'public static function render($linkOptions=[]) {
				$items=static::getItems();
				foreach($items as $item) {
					if($item->url && $item->html) {
						echo \CHtml::link($item->html, $item->url, $linkOptions);
					}
				}
			}',
			'public static function renderMobile($linkOptions=[]) {
				$items=static::getItems();
				foreach($items as $item) {
					if($item->url && $item->html_mobile) {
						echo \CHtml::link($item->html_mobile, $item->url, $linkOptions);
					}
				}
			}',
        ]
    ],
	'menu'=>[
		'backend'=>['label'=>'Социальные сети']	
	],
	'buttons'=>[
		'create'=>['label'=>'Добавить'],
	],
	'crud'=>[
		'index'=>[
			'url'=>['/cp/crud/index'],
			'title'=>'Социальные сети',
			'gridView'=>[
				'dataProvider'=>[
					'sort'=>[
						'defaultOrder'=>'`t`.`sort`, `t`.`title`, `t`.`id` DESC'
					]						
				],
				'emptyText'=>'Соц. сетей не найдено',
				'columns'=>[
                    'column.id',
                    [
                        'name'=>'icon',
                        'header'=>'Иконка',
						'type'=>'raw',
						'value'=>function($data) {
							if($data->icon_html) {
								return \CHtml::tag('span', ['class'=>'label label-info'], 'HTML');
							}
							elseif($data->iconSvgBehavior->exists()) {
								return \CHtml::image($data->iconSvgBehavior->getSrc(), '', ['width'=>30, 'height'=>30]);
							}
							elseif($data->iconBehavior->exists()) {
								return $data->iconBehavior->img(30, 30);
							}
							else {
								return 'нет';
							}
						},
                        'headerHtmlOptions'=>['style'=>'width:10%;text-align:center'],
                        'htmlOptions'=>['style'=>'text-align:center'],
                    ],
                    [
                        'name'=>'icon',
                        'header'=>'Иконка (Моб)',
						'type'=>'raw',
						'value'=>function($data) {
							if($data->icon_html_mobile) {
								return \CHtml::tag('span', ['class'=>'label label-info'], 'HTML');
							}
							elseif($data->iconSvgMobileBehavior->exists()) {
								return \CHtml::image($data->iconSvgMobileBehavior->getSrc(), '', ['width'=>30, 'height'=>30]);
							}
							elseif($data->iconMobileBehavior->exists()) {
								return $data->iconMobileBehavior->img(30, 30);
							}
							else {
								return 'нет';
							}
						},
                        'headerHtmlOptions'=>['style'=>'width:10%;white-space:nowrap;text-align:center'],
                        'htmlOptions'=>['style'=>'text-align:center'],
                    ],
                    [
                        'type'=>'column.title',
                        'header'=>'Наименование',
                        'info'=>[
                        	'Ссылка'=>'$data->url ? \CHtml::link($data->url, $data->url, ["target"=>"_blank"]) : ""',                        	
						],
						'headerHtmlOptions'=>['style'=>'width:50%;'],
                    ],
                    'common.ext.sort',
                    [
                        'name'=>'published',
                        'header'=>'Опубл.',
                        'headerHtmlOptions'=>['style'=>'width:5%;text-align:center;white-space:nowrap;'],
                        'type'=>'common.ext.published'
                    ],
                    'crud.buttons'
				]
			]
		],
		'create'=>[
			'url'=>['/cp/crud/create'],
			'title'=>'Новая соц.сеть',
		],
		'update'=>[
			'url'=>['/cp/crud/update'],
			'title'=>'Редактирование соц.сети',
		],
		'delete'=>[
			'url'=>['/cp/crud/delete'],
		],
		'form'=>[
			'htmlOptions'=>['enctype'=>'multipart/form-data'],
			'attributes'=>function($model) {
				return [
					'published'=>'checkbox',
					'sort'=>[
                        'type'=>'number',
                        'params'=>['htmlOptions'=>['class'=>'form-control w10']]
                    ],
					'title'=>'text',					
					'url'=>'text',
					'icon_html'=>[
						'type'=>'text',
						'params'=>['htmlOptions'=>['class'=>'form-control w100']]
					],
					'icon_html_mobile'=>[
						'type'=>'text',
						'params'=>['htmlOptions'=>['class'=>'form-control w100']]
					],
					'icon_svg'=>[
						'type'=>'common.ext.file.file',
						'behaviorName'=>'iconSvgBehavior',
						'params'=>[
							'actionDelete'=>'/common/crud/admin/default/removeFile?cid=socials&id='.$model->id.'&b=iconSvgBehavior',
							'tmbWidth'=>30,
							'tmbHeight'=>30,
						]
					],
					'icon_svg_mobile'=>[
						'type'=>'common.ext.file.file',
						'behaviorName'=>'iconSvgMobileBehavior',
						'params'=>[
							'actionDelete'=>'/common/crud/admin/default/removeFile?cid=socials&id='.$model->id.'&b=iconSvgMobileBehavior',
							'tmbWidth'=>30,
							'tmbHeight'=>30,
						]
					],
					'icon'=>[
						'type'=>'common.ext.file.image',
						'behaviorName'=>'iconBehavior',
						'params'=>[
							'actionDelete'=>'/common/crud/admin/default/removeImage?cid=socials&id='.$model->id.'&b=iconBehavior',
							'tmbWidth'=>30,
							'tmbHeight'=>30,
						]
					],
					'icon_mobile'=>[
						'type'=>'common.ext.file.image',
						'behaviorName'=>'iconMobileBehavior',
						'params'=>[
							'actionDelete'=>'/common/crud/admin/default/removeImage?cid=socials&id='.$model->id.'&b=iconMobileBehavior',
							'tmbWidth'=>30,
							'tmbHeight'=>30,
						]
					]
				];
			}
		],
	],
];