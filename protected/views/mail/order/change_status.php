<?php

?>
<html>
<head>
<title>Изменение статуса заказа №<?= $order?></title>
</head>
<body>
<?if( $order == '1'){?>
        <p>Ваш заказ № <?= $order?> оплачен и комплектуется</p>
<?} else if($status == '2'){?>
        <p>Ваш заказ № <?= $order?> передан в транспортную компанию</p>
<?} else if($status  == '3'){?>
        <p>Ваш заказ № <?= $order?> выполнен</p>
<?}?>
    </body>
</html>