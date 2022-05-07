<?php
    header("Content-Type: application/json");
    include("SaleOrderService.php");

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            if (count($_GET) == 0) {
                // api/saleOrder.php
                echo SaleOrderService::getAllSaleOrders();
                break;
            }

            if (isset($_GET['id'])) {
                // api/saleOrder.php?id=1
                echo SaleOrderService::getSaleOrderById($_GET['id']);
                break;
            }

            // api/saleOrderLine.php?fromDate=2022-05-01&toDate=2022-05-31
            if (isset($_GET['fromDate']) && isset($_GET['toDate'])) {
                echo SaleOrderService::getSaleOrdersFromDateToDate($_GET['fromDate'], $_GET['toDate']);
            }

            break;

        case 'POST':
            if (isset($_GET['clientId'])) {
                echo SaleOrderService::postSaleOrder(
                    $_GET['clientId'],
                    (isset($_GET['expectedDeliveryDate'])) ? $_GET['expectedDeliveryDate'] : null,
                    (isset($_GET['deliveryDate'])) ? $_GET['deliveryDate'] : null
                );
            }

            break;

        case 'PUT':
            if (isset($_GET['id'])) {
                echo SaleOrderService::putSaleOrder(
                    $_GET['id'],
                    (isset($_GET['expectedDeliveryDate'])) ? $_GET['expectedDeliveryDate'] : null,
                    (isset($_GET['deliveryDate'])) ? $_GET['deliveryDate'] : null
                );
            }

            break;

        case 'DELETE':
            if (isset($_GET['id'])) {
                echo SaleOrderService::deleteSaleOrder($_GET['id']);
            }

            break;
    }
?>
