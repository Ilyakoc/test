<?php
/**
 * Виджет оформления заказа.
 * 
 * @use \YiiHelper (>=1.02)
 * @use \CmsCore
 * @use \DCart\components\DCart \Yii::app()->cart
 */
namespace DOrder\widgets\actions;

use common\components\helpers\HYii as Y;
use \DOrder\models\CustomerForm;
use \DOrder\models\DOrder;
use common\components\helpers\HEvent;

class OrderWidget extends BaseActionWidget
{
	/**
	 * Аттрибуты товара для отображения в письме уведомления для покупателя.
	 * Если установлено в null, будут отображены все аттрибуты
	 * @var array|null
	 */
	public $mailAttributes = null;
	
	/**
	 * Аттрибуты товара для отображения в письме уведомления для администратора.
	 * Если установлено в null, будут отображены все аттрибуты
	 * @var array|null
	 */
	public $adminMailAttributes = null;
	
	/**
	 * (non-PHPdoc)
	 * @see CWidget::run()
	 */
	public function run()
	{
		
		$customerForm = new CustomerForm();
		
		$attributes = \Yii::app()->request->getPost(\YiiHelper::slash2_($customerForm));
		if($attributes) {
			$customerForm->attributes = $attributes; 
			if($customerForm->validate()) {
				if(\Yii::app()->cart->isEmpty()) {
					\Yii::app()->user->setFlash('dorder', 'Ваша корзина пуста!');
					$this->owner->refresh();
				}
				
				$order = new DOrder();
				if($customerForm->scenario=='payment') {
					$payment=$customerForm->payment;
					$customerForm->paymentType=$payment;
					$customerForm->payment=Y::param('payment.types.'.$payment);
    			}
				$order->customer_data = $customerForm->getAttributes(null, true, true, true);
				$order->order_data = \Yii::app()->cart->getData(true, true);

				if($order->save()) {
					\Yii::app()->cart->clear();
					$order->refresh();
					
					$pdf = $this->sendBillPdf($order);
                    
                    HEvent::raise('onDOrderNewOrderSuccessCustom', [
                        'order'=>$order,
                        'clientEmail'=>$customerForm->getEmailForNotification(),
                        'pdf' => $pdf,
                    ]);
					
					if(($customerForm->scenario == 'payment') && (in_array($customerForm->paymentType, Y::param('payment.online', [])))) {
						$this->owner->redirect($this->owner->createUrl(Y::param('payment.action'), ['hash'=>$order->hash]));
					}
					else {
						\Yii::app()->user->setFlash('dorder', 'Спасибо, Ваш заказ отправлен!');
						$this->owner->refresh();				
					}

					$counter = new YaMetrika(54389128);
					$counter->hit();
					$counter->reachGoal('place_your_order');
				}
				elseif($customerForm->scenario == 'payment') {
					$customerForm->payment=$payment;
				}
			}			
		}
		
		$this->render('order', compact('customerForm'));
	}
	
	private function sendBillPdf($order)
	{
		$customer = $order->getCustomerData();
		$items = $order->getOrderData();
		
		$generator = new \PdfGenerator([
			'order' => $order,
			'totalPrice' => $order->getTotalPrice(),
			'number' => $order->id,
			'items' => $items,
		]);
		
		
		$pathFile = $generator->renderPdf();
		
		return [
			'path' => $pathFile,
			'url' => $generator->getFileUrl(),
		];
	}
}
