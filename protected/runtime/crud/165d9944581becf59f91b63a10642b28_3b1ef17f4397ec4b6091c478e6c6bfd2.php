<?php 
namespace crud\models\ar;
use common\components\helpers\HArray as A;
class Social extends \common\components\base\ActiveRecord
{
		public function tableName()
	{
		return 'crud_socials';
	}
	
	public function behaviors()
	{
		return A::m(parent::behaviors(), ['updateTimeBehavior'=>['class'=>'\common\ext\updateTime\behaviors\UpdateTimeBehavior', 'addColumn'=>false], 'publishedBehavior'=>['class'=>'\common\ext\active\behaviors\PublishedBehavior', 'attribute'=>'published', 'addColumn'=>false], 'sortFieldBehavior'=>['class'=>'\common\ext\sort\behaviors\SortFieldBehavior', 'addColumn'=>false, 'attribute'=>'sort', 'attributeLabel'=>'Сортировка', 'asc'=>true, 'step'=>10, 'default'=>0], 'iconSvgBehavior'=>['class'=>'\common\ext\file\behaviors\FileBehavior', 'attribute'=>'icon_svg', 'attributeLabel'=>'Иконка (SVG)', 'types'=>'svg', 'maxSize'=>10485760, 'attributeFileLabel'=>false], 'iconSvgMobileBehavior'=>['class'=>'\common\ext\file\behaviors\FileBehavior', 'attribute'=>'icon_svg_mobile', 'attributeLabel'=>'Иконка (мобильная версия) (SVG)', 'types'=>'svg', 'maxSize'=>10485760, 'attributeFileLabel'=>false], 'iconBehavior'=>['class'=>'\common\ext\file\behaviors\FileBehavior', 'attribute'=>'icon', 'attributeLabel'=>'Иконка', 'attributeAlt'=>'image_alt', 'attributeAltLabel'=>'ALT/TITLE изображения', 'attributeFileLabel'=>false, 'imageMode'=>true], 'iconMobileBehavior'=>['class'=>'\common\ext\file\behaviors\FileBehavior', 'attribute'=>'icon_mobile', 'attributeLabel'=>'Иконка (мобильная версия)', 'attributeAlt'=>'image_alt', 'attributeAltLabel'=>'ALT/TITLE изображения', 'attributeFileLabel'=>false, 'imageMode'=>true]]);
	}
	
	public function relations()
	{
		return $this->getRelations([]);
	}
	
	public function scopes()
	{
		return $this->getScopes(['byDefaultOrder'=>['order'=>'`t`.`sort`, `t`.`title`, `t`.`id` DESC']]);
	}
	
	public function rules()
	{
		return $this->getRules(['1'=>['0'=>'title', '1'=>'required'], '2'=>['0'=>'title, icon_html, icon_html_mobile', '1'=>'length', 'max'=>255], '3'=>['0'=>'url', '1'=>'safe'], '4'=>['0'=>'create_time,published,title', '1'=>'safe']]);
	}
	
	public function attributeLabels()
	{
		return $this->getAttributeLabels(array('id'=>'ID', 'create_time'=>'Дата создания', 'update_time'=>'Время обновления', 'published'=>'Опубликовать на сайте', 'title'=>'Наименование', 'sort'=>'Сортировка', 'icon_html'=>'Иконка (HTML)', 'icon_html_mobile'=>'Иконка (мобильная версия) (HTML)', 'icon_svg'=>'Иконка (SVG)', 'icon_svg_mobile'=>'Иконка (мобильная версия) (SVG)', 'icon'=>'Иконка', 'icon_mobile'=>'Иконка (мобильная версия)', 'url'=>'Ссылка'));
	}
	
public static function getItems() {
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
			}

public static function render($linkOptions=[]) {
				$items=static::getItems();
				foreach($items as $item) {
					if($item->url && $item->html) {
						echo \CHtml::link($item->html, $item->url, $linkOptions);
					}
				}
			}

public static function renderMobile($linkOptions=[]) {
				$items=static::getItems();
				foreach($items as $item) {
					if($item->url && $item->html_mobile) {
						echo \CHtml::link($item->html_mobile, $item->url, $linkOptions);
					}
				}
			}
}
