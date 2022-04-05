<?php
/* @var RadioArchive $order */
use common\components\helpers\HRequest as R;
?>
<html>
<head>
<title>Изменение статуса заказа №<?= $order?></title>
</head>
<body>';
<?if( $order == '1'){?>
        <p>Ваш заказ № <?= $order?> оплачен и комплектуется</p>
<?} else if(R::post('status') == '2'){?>
        <p>Ваш заказ № <?= $order?> передан в транспортную компанию</p>
<?} else if(R::post('status') == '3'){?>
        <p>Ваш заказ № <?= $order?> выполнен</p>
<?}?>
    </body>
</html>