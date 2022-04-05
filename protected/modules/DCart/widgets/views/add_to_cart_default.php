<?php
/** @var \DCart\widgets\AddToCartButtonWidget $this */
/** @var string $modelClass имя класса добавляемой в корзину модели */
?>
<noindex><?php echo \CHtml::link($this->title, Yii::app()->createUrl('dCart/add', array('id'=>$this->id)), array(
	'class' => $this->cssClass . ' dcart-add-to-cart-btn',
	'data-dcart-model' => $modelClass,
	'data-dcart-attributes' => $this->getAttributesAsJSON(),
    'rel'=>'nofollow',
    'onclick' => "yaCounter54389128.reachGoal('click_korzina'); return true;",
)); ?></noindex>

