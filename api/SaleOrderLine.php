<?php
    header("Content-Type: application/json");
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
            if (isset($_GET['saleOrderId']) && isset($_GET['productId']) && isset($_GET['quantity'])) {
                echo SaleOrderLineService::postSaleOrderLine(
                    $_GET['saleOrderId'],
                    $_GET['productId'],
                    $_GET['quantity']
                );
            }

            break;

        case 'PUT':
            if (isset($_GET['id']) && isset($_GET['quantity'])) {
                echo SaleOrderLineService::putSaleOrderLine($_GET['id'], $_GET['quantity']);
            }

            break;

        case 'DELETE':
            if (isset($_GET['id'])) {
                echo SaleOrderLineService::deleteSaleOrderLine($_GET['id']);
            }

            break;
    }
?>
