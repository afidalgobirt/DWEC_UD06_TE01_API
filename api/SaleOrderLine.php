<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Allow-Headers: *");
    include("SaleOrderLineService.php");

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            if (count($_GET) == 0) {
                // api/saleOrderLine.php
                echo SaleOrderLineService::getAllSaleOrderLines();
                break;
            }

            if (isset($_GET['id'])) {
                // api/saleOrderLine.php?id=1
                echo SaleOrderLineService::getSaleOrderLineById($_GET['id']);
                break;
            }

            if (isset($_GET['orderId'])) {
                // api/saleOrderLine.php?orderId=1
                echo SaleOrderLineService::getSaleOrderLinesByOrderId($_GET['orderId']);
                break;
            }

            // api/saleOrderLine.php?fromDate=2022-05-01&toDate=2022-05-31
            if (isset($_GET['fromDate']) && isset($_GET['toDate'])) {
                echo SaleOrderLineService::getSaleOrderLinesFromDateToDate($_GET['fromDate'], $_GET['toDate']);
            }

            break;

        case 'POST':
            $requestBody = json_decode(file_get_contents('php://input'), true);

            if (isset($requestBody['saleOrderId']) &&
                isset($requestBody['productId']) &&
                isset($requestBody['quantity'])) {
                echo SaleOrderLineService::postSaleOrderLine(
                    $requestBody['saleOrderId'],
                    $requestBody['productId'],
                    $requestBody['quantity']
                );
            }

            break;

        case 'PUT':
            $requestBody = json_decode(file_get_contents('php://input'), true);

            if (isset($requestBody['id']) && isset($requestBody['quantity'])) {
                echo SaleOrderLineService::putSaleOrderLine(
                    $requestBody['id'],
                    $requestBody['quantity']
                );
            }

            break;

        case 'DELETE':
            if (isset($_GET['id'])) {
                echo SaleOrderLineService::deleteSaleOrderLine($_GET['id']);
            }

            break;
    }
?>
