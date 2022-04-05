<?php
/**
 * Дополнительные события модуля Заказы
 * 
 * Список событий модуля "Заказы"
 * 
 * "OnDOrderNewOrderSuccess" - новый заказ (параметры: $order, $clientEmail)
 * 
 */
use common\components\helpers\HYii as Y;
use common\components\helpers\HArray as A;
use common\ext\email\components\helpers\HEmail;

return [
    'OnDOrderNewOrderSuccess'=>[
        function($event) {
            $order=A::get($event->params, 'order');
            if($order instanceof \DOrder\models\DOrder) {
                $t=Y::ct('\DOrderModule.events');
                $sitename=D::cms('sitename', $_SERVER['SERVER_NAME']);
                
                HEmail::cmsAdminSend(
                    $t('email.neworder.admin.subject', ['{sitename}'=>$sitename]), 
                    ['model'=>$order, 'eavAttributes'=>[]], 
                    'DOrder.views._email.neworder_admin_success'
                );
                
                if($clientEmail=A::get($event->params, 'clientEmail')) {
                    HEmail::cmsSend(
                        $clientEmail, 
                        $t('email.neworder.client.subject', ['{sitename}'=>$sitename, '{order_number}'=>$order->id]), 
                        ['model'=>$order, 'eavAttributes'=>[]], 
                        'DOrder.views._email.neworder_client_success'
                    );
                }
            }
        }
    ],
    'onDOrderNewOrderSuccessCustom'=>[
        function($event) {
            $order=A::get($event->params, 'order');
            
            if($order instanceof \DOrder\models\DOrder) {
                $t=Y::ct('\DOrderModule.events');
                $sitename=D::cms('sitename', $_SERVER['SERVER_NAME']);

				$data = ['model'=>$order, 'eavAttributes'=>[], 'pdf'=>$event->params['pdf']];
                
                $config = HEmail::config();      
                $config['address']['to'] = [HEmail::normalizeAddress(A::toa(\D::cms('email')))];
				$config['ishtml'] = true;
				$config['subject'] = $t('email.neworder.admin.subject', ['{sitename}'=>$sitename]);
				$config['attachment'] = [
					$event->params['pdf']['path'],
				];
                  
                HEmail::send($config, $data, 'DOrder.views._email.neworder_admin_success');
                
                if ($clientEmail=A::get($event->params, 'clientEmail')) {                 
	                $config = HEmail::config();      
	                $config['address']['to'] = [HEmail::normalizeAddress(A::toa($clientEmail))];
					$config['ishtml'] = true;
					$config['subject'] = $t('email.neworder.client.subject', ['{sitename}'=>$sitename, '{order_number}'=>$order->id]);
					$config['attachment'] = [
						$event->params['pdf']['path'],
					];
                    
                    HEmail::send($config, $data, 'DOrder.views._email.neworder_client_success');
                }
            }
        }
    ]
];
