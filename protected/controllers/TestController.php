<?php

use common\components\helpers\HYii as Y;
use common\components\helpers\HArray as A;	
use common\ext\email\components\helpers\HEmail;
	
class TestController extends CController
{
	public function actionIndex()
	{
		$order = DOrder\models\DOrder::model()->findByPk(29);
		
		
		$customer = $order->getCustomerData();
		$items = $order->getOrderData();
		
// 		print_r($order->attributes); 
// 		print_r($customer);
// 		print_r($data);
		
		$generator = new PdfGenerator([
			'order' => $order,
			'totalPrice' => $order->getTotalPrice(),
			'number' => $order->id,
			'items' => $items,
		]);

		
		$pathFile = $generator->renderPdf();
		$pdf = [
			'path' => $pathFile,
			'url' => $generator->getFileUrl(),
		];
		var_dump($pdf);
		
		/*$data = [
			'model'=>$order, 
			'eavAttributes'=>[], 
			'pdf'=>$pdf
		];
		
		$config = HEmail::config();      
        $config['address']['to'] = [HEmail::normalizeAddress(A::toa(\D::cms('email')))];
		$config['ishtml'] = true;
		$config['subject'] = 'Test';
		$config['attachment'] = [$pathFile];
          
        HEmail::send($config, $data, 'DOrder.views._email.neworder_admin_success');*/
	}
}