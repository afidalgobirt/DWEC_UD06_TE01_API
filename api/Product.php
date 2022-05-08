<?php
    header("Content-Type: application/json");
	header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Allow-Headers: *");
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
            $requestBody = json_decode(file_get_contents('php://input'), true);

            if (isset($requestBody['name']) && isset($requestBody['stock']) &&
                isset($requestBody['unitOfMeasure']) && isset($requestBody['pricePerUnit'])) {
                echo ProductService::postProduct(
                    $requestBody['name'],
                    $requestBody['stock'],
                    $requestBody['unitOfMeasure'],
                    $requestBody['pricePerUnit']
                );
            }
            
            break;

        case 'PUT':
            $requestBody = json_decode(file_get_contents('php://input'), true);

            if (isset($requestBody['id'])) {
                echo ProductService::putProduct(
                    $requestBody['id'],
                    (isset($requestBody['name'])) ? $requestBody['name'] : null,
                    (isset($requestBody['stock'])) ? $requestBody['stock'] : null,
                    (isset($requestBody['unitOfMeasure'])) ? $requestBody['unitOfMeasure'] : null,
                    (isset($requestBody['pricePerUnit'])) ? $requestBody['pricePerUnit'] : null
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
