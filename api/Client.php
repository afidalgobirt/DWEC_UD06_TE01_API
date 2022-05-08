<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Allow-Headers: *");
    include("ClientService.php");

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            if (count($_GET) == 0) {
                // api/client.php
                echo ClientService::getAllClients();
                break;
            }

            if (isset($_GET['id'])) {
                // api/client.php?id=1
                echo ClientService::getClientById($_GET['id']);
                break;
            }

            // api/client.php?fromDate=2022-05-01&toDate=2022-05-31
            if (isset($_GET['fromDate']) && isset($_GET['toDate'])) {
                echo ClientService::getClientsFromDateToDate($_GET['fromDate'], $_GET['toDate']);
            }

            break;

        case 'POST':
            $requestBody = json_decode(file_get_contents('php://input'), true);

            if (isset($requestBody['name']) && isset($requestBody['lastName']) &&
                isset($requestBody['address']) && isset($requestBody['email'])) {
                echo ClientService::postClient(
                    $requestBody['name'],
                    $requestBody['lastName'],
                    $requestBody['address'],
                    $requestBody['email'],
                    (isset($requestBody['phone'])) ? $requestBody['phone'] : null
                );
            }

            break;

        case 'PUT':
            $requestBody = json_decode(file_get_contents('php://input'), true);

            if (isset($requestBody['id'])) {
                echo ClientService::putClient(
                    $requestBody['id'],
                    (isset($requestBody['name'])) ? $requestBody['name'] : null,
                    (isset($requestBody['lastName'])) ? $requestBody['lastName'] : null,
                    (isset($requestBody['address'])) ? $requestBody['address'] : null,
                    (isset($requestBody['email'])) ? $requestBody['email'] : null,
                    (isset($requestBody['phone'])) ? $requestBody['phone'] : null
                );
            }

            break;

        case 'DELETE':
            if (isset($_GET['id'])) {
                echo ClientService::deleteClient($_GET['id']);
            }

            break;
    }
?>
