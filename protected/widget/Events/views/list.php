
<?php if ($this->show_title): ?>
	<div class="module__head module-action__head">
		<a href="/news"><?=D::cms('events_title',Yii::t('events','events_title'))?></a>
	</div>
<?php endif; ?>

<ul class="news">
  <?php foreach($events as $event): ?>
	  <li>
    	<? if($event->previewEnable && !empty($event->preview)): ?>
    		<div class="item-img">
    			<a href="<?= Yii::app()->createUrl('site/event', array('id'=>$event->id)); ?>">
    				<img src="<?= ResizeHelper::resize($event->previewImg, 255, 222) ?>" alt="<?php echo $event->title; ?>" title="<?php echo $event->title; ?>">
    			</a>
    		</div>
			<? endif; ?>
			<p class="item-date"><?php echo $event->date; ?></p>
			<?php echo CHtml::link($event->title, array('site/event', 'id'=>$event->id), array('class'=>'item-head')); ?>
	  </li>
  <?php endforeach; ?>
</ul>
<div class="all_events_wrap">
	<?php if ($show_all) echo CHtml::link(D::cms('events_link_all_text', Yii::t('events','link_all_text')), array('site/events'), array('class'=>'all-items')); ?>
</div>
