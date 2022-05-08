<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Allow-Headers: *");
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
            $requestBody = json_decode(file_get_contents('php://input'), true);

            if (isset($requestBody['clientId'])) {
                echo SaleOrderService::postSaleOrder(
                    $requestBody['clientId'],
                    (isset($requestBody['expectedDeliveryDate'])) ? $requestBody['expectedDeliveryDate'] : null,
                    (isset($requestBody['deliveryDate'])) ? $requestBody['deliveryDate'] : null
                );
            }

            break;

        case 'PUT':
            $requestBody = json_decode(file_get_contents('php://input'), true);

            if (isset($requestBody['id'])) {
                echo SaleOrderService::putSaleOrder(
                    $requestBody['id'],
                    (isset($requestBody['expectedDeliveryDate'])) ? $requestBody['expectedDeliveryDate'] : null,
                    (isset($requestBody['deliveryDate'])) ? $requestBody['deliveryDate'] : null
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
