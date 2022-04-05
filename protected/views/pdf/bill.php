<style>
	.main {
	  width: 978px;
	  margin: 0 auto;
	  font-size: 17px;
	}
	
	.items-table td,
	.items-table th {
		border: solid 1px #333;
	}
	
</style>

<div class="main">
	<table width="100%" style="font-family: Arial;">
	    <tr >
	        <td style="width: 68%; padding: 20px 0;">
	            <div style="text-align: justify; font-size: 8pt;">Внимание! Оплата данного счета означает согласие с условиями поставки товара. Счет действителен в течение 5(пяти) банковских дней, не считая дня выписки счета. Уведомление об оплате  обязательно, в противном случае НЕ ГАРАНТИРУЕТСЯ наличие товара на складе. Товар отпускается по факту прихода денег на р/с Поставщика, самовывозом, при наличии доверенности и паспорта.</div>
	        </td>
	      <td style="width: 32%; text-align: center; padding: 30px 0;">
	<!-- 	      <img src="" style="width: 70%;"> -->
		   </td>
	    </tr>
	    
	</table>


	<table width="100%" style="border-collapse: collapse; width: 100%; font-family: Arial; border: solid 1px #333;" cellpadding="2" cellspacing="2" border="2">
	    <tr style="">
	        <td colspan="2" rowspan="2" style="min-height:13mm; width: 105mm; border: solid 1px #333;">
	            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="height: 13mm;">
	                <tr>
	                    <td valign="top">
	                        <div>ПАО "Банк Уралсиб"</div>
	                    </td>
	                </tr>
	                <tr>
	                    <td valign="bottom" style="height: 3mm;">
	                        <div style="font-size:10pt;">Банк получателя</div>
	                    </td>
	                </tr>
	            </table>
	        </td>
	        <td style="min-height:7mm;height:auto; width: 25mm; border: solid 1px #333;">
	            <div>БИK</div>
	        </td>
	        <td rowspan="2" style="vertical-align: top; width: 60mm; border: solid 1px #333;">
	            <div style=" height: 7mm; line-height: 7mm; vertical-align: middle;">044525787</div>
	            <div>30101810100000000787</div>
	        </td>
	    </tr>
	    <tr>
	        <td style="width: 25mm; border: solid 1px #333;">
	            <div>Корр.Сч. №</div>
	        </td>
	    </tr>
	    <tr>
	        <td style="min-height:6mm; height:auto; width: 50mm; border: solid 1px #333;">
	            <div>ИНН 9723130600</div>
	        </td>
	        <td style="min-height:6mm; height:auto; width: 55mm; border: solid 1px #333;">
	            <div>КПП 772301001</div>
	        </td>
	        <td rowspan="2" style="min-height:19mm; height:auto; vertical-align: top; width: 25mm; border: solid 1px #333;">
	            <div>Р/С №</div>
	        </td>
	        <td rowspan="2" style="min-height:19mm; height:auto; vertical-align: top; width: 60mm; border: solid 1px #333;">
	            <div>40702810600290002056</div>
	        </td>
	    </tr>
	    <tr>
	        <td colspan="2" style="min-height:13mm; height:auto; border: solid 1px #333;">
	
	            <table border="0" cellpadding="0" cellspacing="0" style="height: 13mm; width: 105mm;">
	                <tr>
	                    <td valign="top">
	                        <div>ООО "СИРИУС"</div>
	                    </td>
	                </tr>
	                <tr>
	                    <td valign="bottom" style="height: 3mm;">
	                        <div style="font-size: 10pt;">Получатель</div>
	                    </td>
	                </tr>
	            </table>
	
	        </td>
	    </tr>
	</table>
	<br/>
	
	<div style="font-weight: bold; font-size: 25pt; padding-left:5px; font-family: Arial;">
	    Счет № <?= $number ?> от <?= $date ?></div>
	<br/>
	
	<div style="background-color:#000000; width:100%; font-size:1px; height:2px;">&nbsp;</div>
	
	<table width="100%" style="font-family: Arial;">
	    <tr>
	        <td style="width: 30mm; vertical-align: top;">
	            <div style="padding-left:2px; ">Поставщик: </div>
	        </td>
	        <td>
	            <div style="font-weight:bold;  padding-left:2px;">
	                ООО "СИРИУС" ИНН 9723130600, КПП 772301001<br>
					<span style="font-weight: normal;">109428, Российская Федерация, г. Москва, 1-й Вязовский проезд. д.4, ст.3
<br> тел.: +7 (495) 103-16-91</span>
				</div>
	        </td>
	    </tr>
	    <tr>
	        <td style="width: 30mm; vertical-align: top;">
	            <div style=" padding-left:2px;">Покупатель:    </div>
	        </td>
	        <td>
	            <!--div style="font-weight:bold;  padding-left:2px;">
	               ИП , ИНН , КПП 45465446456,<br><span style="font-weight: normal;">213245, Российская Федерация, г. ,  пр-кт, д.151 лит. А,<br> пом. , тел.: +7() , факс: +7()  </span>            
	            </div-->
	        </td>
	    </tr>
	</table>
	
	
	<table border="2" width="100%" cellpadding="2" cellspacing="2" style="border-collapse: collapse; width: 100%; font-family: Arial;" class="items-table">
	    <thead>
	    <tr>
	        <th style="width:13mm; ">№</th>	       
	        <th>Товары (работы, услуги)</th>
	        <th style="width:20mm; ">Кол-во</th>
	        <th style="width:17mm; ">Ед.</th>
	        <th style="width:27mm;  ">Цена</th>
	        <th style="width:27mm;  ">Сумма</th>
	    </tr>
	    </thead>
	    <tbody>
		    <?php foreach($items as $i=>$item) { ?>
			<tr>
				<td style="width:13mm; text-align: center;"><?= $i+1 ?></td>	       
				<td><?= $item['title']['value'] ?> (арт: <?= $item['code']['value'] ?>)</td>
				<td style="width:20mm;  text-align: center;"><?= $item['count']['value'] ?></td>
				<td style="width:17mm;  text-align: center;">Шт.</td>
				<td style="width:27mm; text-align: center; "><?= number_format($item['price']['value'], 2) ?></td>
				<td style="width:27mm; text-align: center; "><?= number_format($item['price']['value'] * $item['count']['value'], 2) ?></td>
			</tr>
	    	<?php } ?>
	    </tbody>
	</table>
	
	<table style="font-family: Arial;" border="0" width="100%" cellpadding="1" cellspacing="1">
	    <tr>
	        <td></td>
	        <td style="width:27mm; font-weight:bold; text-align: right;">Итого:</td>
	        <td style="width:27mm; font-weight:bold; text-align: right; "><?= number_format($totalPrice, 2) ?></td>
	    </tr>
		<tr>
	        <td></td>
	        <td style="width:27mm; font-weight:bold; text-align: right;">Итого НДС:</td>
	        <td style="width:27mm; font-weight:bold; text-align: right; "><?= number_format($nds, 2) ?></td>
	    </tr>
		<tr>
	        <td></td>
	        <td style="width:37mm; font-weight:bold; text-align: right;">Всего к оплате:</td>
	        <td style="width:27mm; font-weight:bold; text-align: right; "><?= number_format($totalPrice, 2) ?></td>
	    </tr>
	</table>
	
	<br />
	<div style="font-family: Arial;">
	Всего наименований <?= count($items) ?> на сумму <?= number_format($totalPrice, 2) ?> рублей.<br />
<!-- 	Ноль рублей 00 копеек -->
	</div>
	<br /><br />
	<div style="background-color:#000000; width:100%; font-size:1px; height:2px;">&nbsp;</div>
	<br/>
	  <div style="font-family: Arial; font-size: 10pt;">
	1. Счет действителен в течении 5 (пяти) банковских дней, не считая дня выписки счета. В случае нарушения срока оплаты сохранение цены на товар и наличие товара на складе НЕ ГАРАНТИРУЕТСЯ.<br />
	2. Оплата данного счета означает согласие с условиями изложенными в п.1</div>
	  <br />
	  <br />
	  <div style="background: url(<?= $this->createAbsoluteUrl('/images/pdf_files/stamp.png') ?>); background-repeat: no-repeat; padding: 30px 10px; width: 400px; height: 250px; background-position: 30px 0; position: relative;">
		  <img src="<?= $this->createAbsoluteUrl('/images/pdf_files/signature.png') ?>" style="width: 140px; height: auto; margin-left: 130px; " />
		  <div style="margin-top: -30px;">Руководитель ______________________ </div>
		  <br/><br /><br />	
		  <div>Главный бухгалтер ______________________</div>
		  <br/>	
		  <div style="width: 85mm;text-align:center;">М.П.</div>
		  <br/>
	</div>
</div>
