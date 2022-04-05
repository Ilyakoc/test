<?
/** @var \widget\sale\SaleList $this */
/** @var array[\Sale] $models */
?>
<?if($this->wrapperTagName) echo \CHtml::openTag($this->wrapperTagName, $this->wrapperOptions)?>

<?if($this->showTitle):?>
	<div class="module__head module-action__head">
		<a href="/sale"><?=\D::cms('sale_title', \Yii::t('sale','title'))?></a>
	</div>
<?endif?>

<?=\CHtml::openTag($this->itemsTagName, $this->htmlOptions)?>
  <?foreach($models as $model):?>
	  <?=\CHtml::openTag($this->itemTagName)?>
    	<?if(!empty($model->preview)):?>
    		<div class="item-img">
    			<a href="<?=\Yii::app()->createUrl('sale/view', array('id'=>$model->id))?>">
    				<img src="<?= ResizeHelper::resize($model->imageBehavior->getSrc(), 255, 222) ?>" alt="<?=$model->title?>" title="<?=$model->title?>" class="img-responsive">
    			</a>
    		</div>
			<?endif?>
			<p class="item-date"><?php echo $model->date; ?></p>
			<?=D::c($this->showSaleTitle, \CHtml::link($model->title, array('sale/view', 'id'=>$model->id), array('class'=>'item-head')))?>
	  <?=\CHtml::closeTag($this->itemTagName)?>
  <?endforeach?>
<?=\CHtml::closeTag($this->itemsTagName)?>

<?if($this->showLinkAll)
	echo \CHtml::link(\D::cms('sale_link_all_text', \Yii::t('sale','link.all')), array('/sale'), array('class'=>'all-items'), $this->linkAllOptions)?>

<?if($this->wrapperTagName) echo \CHtml::closeTag($this->wrapperTagName)?>
