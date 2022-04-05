<?php
	
class PdfGenerator
{
	private $data;
	private $order;
	private $htmlPath;
	
	private $pdfPath;
	private $pdfFilename;
	
	public function __construct($data)
	{
		$this->data = $data;	
	
		if (isset($data['order']))	
			$this->order = $data['order'];
	}
	
	public function renderPdf()
	{
		$content = $this->renderView();
		
		$path = Yii::getPathOfAlias('webroot.uploads.bills');
		
		if (!is_dir($path)) {
			mkdir($path, 0775, true);	
		}
		
		$filename = sprintf('bill-%s_%s.pdf', $this->data['number'], date('d-m-Y_H_i_s'));
		
		$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
		$fontDirs = $defaultConfig['fontDir'];
		
		$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];

		$options = [
			'mode' => 'UTF-8',
			'format' => 'A4',
			'orientation' => 'P',
			'default_font' => 'arial',
			'default_font_size' => 10,
			'margin_left' => 10,
			'margin_right' => 10,
			'margin_top' => 2,
			'margin_bottom' => 5,
			'margin_header' => 5,
			'margin_footer' => 5,
			'fontDir' => array_merge($fontDirs, [
				Yii::getPathOfAlias('application.pdf_fonts')
			]),
		    'fontdata' => $fontData + [
		        'arial' => [
		            'R' => 'Arial.ttf',
		            'B' => 'Arial Bold.ttf',
		            'I' => 'Arial Italic.ttf',
		        ]
		    ],
		];


		$mpdf = new \Mpdf\Mpdf($options);
		$mpdf->WriteHTML($content);
		$mpdf->SetTitle('Счет на оплату #'.$this->data['number']);
		
		$mpdf->Output($path .DS. $filename , 'F');   
		
		$this->pdfFilename = $filename;
		return $path .DS. $filename;    
	}
	
	public function renderView()
	{
		return Yii::app()->controller->renderPartial('/pdf/bill', [
			'number' => $this->data['number'],
			'date' => (new DateTime($this->order->create_time))->format('d.m.Y'),
			'totalPrice' => $this->data['totalPrice'],
			'nds' => 0,
			'items' => array_values($this->data['items']),
		], true);
	}
	
	public function getFileUrl() 
	{
		return Yii::app()->createAbsoluteUrl('/uploads/bills/'.$this->pdfFilename);	
	}
	
}
