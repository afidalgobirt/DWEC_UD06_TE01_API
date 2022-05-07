<?php
    header("Content-Type: application/json");
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
            if (isset($_GET['name']) && isset($_GET['lastName']) &&
                isset($_GET['address']) && isset($_GET['email'])) {
                echo ClientService::postClient(
                    $_GET['name'],
                    $_GET['lastName'],
                    $_GET['address'],
                    $_GET['email'],
                    (isset($_GET['phone'])) ? $_GET['phone'] : null
                );
            }

            break;

        case 'PUT':
            if (isset($_GET['id'])) {
                echo ClientService::putClient(
                    $_GET['id'],
                    (isset($_GET['name'])) ? $_GET['name'] : null,
                    (isset($_GET['lastName'])) ? $_GET['lastName'] : null,
                    (isset($_GET['address'])) ? $_GET['address'] : null,
                    (isset($_GET['email'])) ? $_GET['email'] : null,
                    (isset($_GET['phone'])) ? $_GET['phone'] : null
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
