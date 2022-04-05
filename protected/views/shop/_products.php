<?php

/**
 * @var Product $data
 */


use settings\components\helpers\HSettings;
$shopSettings = HSettings::getById('shop');
$generalSaleText = $shopSettings->saleText;
 
$cache = \Yii::app()->user->isGuest;
// if (!$cache || $this->beginCache('shop__product_card', ['varyByParam' => [$data->id]])) : // cache begin

if (empty($category)) 
	$categoryId = $data->category_id;
else 
	$categoryId = $category->id;
	
$productUrl = Yii::app()->createUrl('shop/product', ['id' => $data->id, 'category_id' => $categoryId]);



?>

<div class="col-lg-4 col-sm-6 col-6 d-flex">
	<div class="product-item">
		<? if (!\Yii::app()->user->isGuest) echo CHtml::link('редактировать', ['/cp/shop/productUpdate', 'id' => $data->id], ['class' => 'btn-product-edit', 'target' => '_blank']); ?>
		<div class="product">
			<div class="product__mark">
				<?php 
					
				$saleText = $generalSaleText ?? sprintf('Акция %s', $data->sale_text);

				foreach (['sale', 'new', 'hit'] as $mark) {
					if ($data->$mark) {
						$htmlOptions = ['class' => "product__mark-{$mark}"];
						
						if ($mark == 'sale' && !empty($saleText)) { 
							$htmlOptions['data-label'] = $saleText;
						}
						echo \CHtml::tag('span', $htmlOptions, '', true);
					}
				} 
				?>
			</div>
			<?php if ($data->old_price > 0) : ?>
				<div class="discount">
					<span class="discount-percent">
						<?= round(($data->old_price - $data->price) / $data->old_price * 100) ?>%
					</span>
				</div>
			<?php endif ?>

			<div class="product-content">
				<div class="product-top">
					<div class="product__image product-block">
						<?= CHtml::link(CHtml::image($data->getSrc()), $productUrl); ?>
					</div>
					<div class="product__title product-block">
						<?= CHtml::link($data->title, $productUrl, array('title' => $data->link_title)); ?>
						<div class='product-code'>
							<?= ($data->code); ?>
						</div>
					</div>
					<div class="product__price">
						<?php if ($data->price > 0) : ?>
							<p class="order__price">
								<? if (D::cms('shop_enable_old_price')) : ?>
									<?php if ($data->old_price > 0) : ?>
										<span class="old_price"><?= HtmlHelper::priceFormat($data->old_price); ?>
											<span class="rub">&#8381;</span>
										</span>
									<?php endif; ?>
								<? endif; ?>
								<span class="new_price"><?= HtmlHelper::priceFormat($data->price); ?>
									<span class="rub">&#8381;</span>
								</span>
							</p>
						<?php endif; ?>
					</div>
				</div>

				<div class="product__to-cart">
					<? if ($data->notexist) : ?>
						<div class="btn to-cart shop-button notexist">Нет в наличии</div>
					<? else : ?>
						<? $this->widget('\DCart\widgets\AddToCartButtonWidget', array(
							'id' => $data->id,
							'model' => $data,
							'title' => '<span>В корзину</span>',
							'cssClass' => 'btn shop-button to-cart button_1 js__in-cart open-cart',
							'attributes' => [
								// ['count', '#js-product-count-' . $data->id],
							]
						));
						?>
					<? endif ?>
				</div>
			</div>

		</div>
	</div>
</div>


<? /*if ($cache) {
		$this->endCache();
	}
endif;
*/ // cache end