<?php
    header("Content-Type: application/json");
    include("ProductService.php");

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            if (count($_GET) == 0) {
                // api/product.php
                echo ProductService::getAllProducts();
                break;
            }

            if (isset($_GET['id'])) {
                // api/product.php?id=1
                echo ProductService::getProductById($_GET['id']);
                break;
            }

            break;

        case 'POST':
            if (isset($_GET['name']) && isset($_GET['stock']) &&
                isset($_GET['unitOfMeasure']) && isset($_GET['pricePerUnit'])) {
                echo ProductService::postProduct(
                    $_GET['name'],
                    $_GET['stock'],
                    $_GET['unitOfMeasure'],
                    $_GET['pricePerUnit']
                );
            }
            
            break;

        case 'PUT':
            if (isset($_GET['id'])) {
                echo ProductService::putProduct(
                    $_GET['id'],
                    (isset($_GET['name'])) ? $_GET['name'] : null,
                    (isset($_GET['stock'])) ? $_GET['stock'] : null,
                    (isset($_GET['unitOfMeasure'])) ? $_GET['unitOfMeasure'] : null,
                    (isset($_GET['pricePerUnit'])) ? $_GET['pricePerUnit'] : null
                );
            }

            break;

        case 'DELETE':
            if (isset($_GET['id'])) {
                echo ProductService::deleteProduct($_GET['id']);
            }
            
            break;
    }
?>
