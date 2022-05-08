<?php
    class DAO {
        private $connection;
        private $user;
        private $host;
        private $pass;
        private $db;
        
        public function __construct() {
            /* $this->user = "id18871277_dwec_ud06_te01_api_user";
            $this->host = "localhost";
            $this->pass = "zIxHMZ)1m0ZzXBFq";
            $this->db = "id18871277_dwec_ud06_te01_api"; */

            $this->user = "root";
            $this->host = "localhost";
            $this->pass = "";
            $this->db = "dwec_ud06_te01_api";

            $this->connect();
        }

        /**
         * Sets connection with the DB.
         */
        private function connect() {
            $this->connection = new mysqli(
                $this->host,
                $this->user,
                $this->pass,
                $this->db
            );

            if ($this->connection->connect_errno) {
                printf("Connect failed: %s\n", $mysqli->connect_error);
                exit();
            }
        }

        public function getAllProducts() {
            $query = "SELECT * FROM product";
            return $this->connection->query($query);
        }

        public function getProductById($id) {
            $query = "SELECT * FROM product WHERE product.id = $id";
            return $this->connection->query($query);
        }

        public function postProduct($name, $stock, $unitOfMeasure, $pricePerUnit) {
            $query = "INSERT INTO product " .
                        "(name, stock, unitOfMeasure, pricePerUnit) " .
                        "VALUES ('$name', $stock, '$unitOfMeasure', $pricePerUnit)";

            $this->connection->query($query);

            // Get the newly created product by selecting the one with the highest id.
            $query = "SELECT * FROM product " .
                        "ORDER BY product.id DESC " .
                        "LIMIT 1";

            return $this->connection->query($query);
        }

        public function putProduct($id, $name, $stock, $unitOfMeasure, $pricePerUnit) {
            $query = "UPDATE product SET " .
                        "product.name = '$name', " .
                        "product.stock = $stock, " .
                        "product.unitOfMeasure = '$unitOfMeasure', " .
                        "product.pricePerUnit = $pricePerUnit " .
                        "WHERE product.id = $id";

            $this->connection->query($query);

            return $this->getProductById($id);
        }

        public function deleteProduct($id) {
            $query = "DELETE FROM product " .
                        "WHERE product.id = $id";

            $this->connection->query($query);
        }

        public function getAllSaleOrders() {
            $query = "SELECT * FROM saleOrder";
            return $this->connection->query($query);
        }

        public function getSaleOrderById($id) {
            $query = "SELECT * FROM saleOrder WHERE saleOrder.id = $id";
            return $this->connection->query($query);
        }

        public function getSaleOrdersFromDateToDate($fromDate, $toDate) {
            $query = "SELECT * FROM saleOrder WHERE " .
                        "saleOrder.orderDateTime > '$fromDate' && " .
                        "saleOrder.orderDateTime < '$toDate'";

            return $this->connection->query($query);
        }

        public function postSaleOrder($clientId, $expectedDeliveryDate, $deliveryDate) {
            $orderDateTime = date("Y-m-d H-i-s"); // e.g. 2022-05-07 10:51:24
            $query = "INSERT INTO saleOrder " .
                        "(clientId, orderDateTime, expectedDeliveryDate, deliveryDate) " .
                        "VALUES ($clientId, '$orderDateTime', '$expectedDeliveryDate', '$deliveryDate')";

            $this->connection->query($query);

            // Get the newly created saleOrder by selecting the one with the highest id.
            $query = "SELECT * FROM saleOrder " .
                        "ORDER BY saleOrder.id DESC " .
                        "LIMIT 1";

            return $this->connection->query($query);
        }

        public function putSaleOrder($id, $expectedDeliveryDate, $deliveryDate) {
            $query = "UPDATE saleOrder SET " .
                        "saleOrder.expectedDeliveryDate = '$expectedDeliveryDate', " .
                        "saleOrder.deliveryDate = '$deliveryDate' " .
                        "WHERE saleOrder.id = $id";

            $this->connection->query($query);

            return $this->getSaleOrderById($id);
        }

        public function deleteSaleOrder($id) {
            $query = "DELETE FROM saleOrder " .
                        "WHERE saleOrder.id = $id";

            $this->connection->query($query);
        }

        public function getAllClients() {
            $query = "SELECT * FROM client";
            return $this->connection->query($query);
        }

        public function getClientById($id) {
            $query = "SELECT * FROM client WHERE client.id = $id";
            return $this->connection->query($query);
        }

        public function getClientsFromDateToDate($fromDate, $toDate) {
            $query = "SELECT * FROM client " .
                        "WHERE EXISTS(SELECT * FROM saleOrder " .
                            "WHERE saleOrder.clientId = client.id && " .
                            "saleOrder.orderDateTime > '$fromDate' && " .
                            "saleOrder.orderDateTime < '$toDate')";

            return $this->connection->query($query);
        }

        public function postClient($name, $lastName, $address, $email, $phone) {
            $query = "INSERT INTO client " .
                        "(name, lastName, address, email, phone) " .
                        "VALUES ('$name', '$lastName', '$address', '$email', '$phone')";

            $this->connection->query($query);

            // Get the newly created client by selecting the one with the highest id.
            $query = "SELECT * FROM client " .
                        "ORDER BY client.id DESC " .
                        "LIMIT 1";

            return $this->connection->query($query);
        }

        public function putClient($id, $name, $lastName, $address, $email, $phone) {
            $query = "UPDATE client SET " .
                        "client.name = '$name', " .
                        "client.lastName = '$lastName', " .
                        "client.address = '$address', " .
                        "client.address = '$address', " .
                        "client.phone = '$phone' " .
                        "WHERE client.id = $id";

            $this->connection->query($query);

            return $this->getClientById($id);
        }

        public function deleteClient($id) {
            $query = "DELETE FROM client " .
                        "WHERE client.id = $id";

            $this->connection->query($query);
        }

        public function getAllSaleOrderLines() {
            $query = "SELECT * FROM saleOrderLine";
            return $this->connection->query($query);
        }

        public function getSaleOrderLineById($id) {
            $query = "SELECT * FROM saleOrderLine WHERE saleOrderLine.id = $id";
            return $this->connection->query($query);
        }

        public function getSaleOrderLinesByOrderId($orderId) {
            $query = "SELECT * FROM saleOrderLine " .
                        "WHERE saleOrderLine.saleOrderId = $orderId";
            return $this->connection->query($query);
        }

        public function getSaleOrderLinesFromDateToDate($fromDate, $toDate) {
            $query = "SELECT saleOrderLine.*, product.pricePerUnit FROM saleOrderLine " .
                        "JOIN product " .
                        "ON product.id = saleOrderLine.productId " .
                        "WHERE EXISTS(SELECT * FROM saleOrder " .
                        " WHERE saleOrder.id = saleOrderLine.saleOrderId && " .
                            "saleOrder.orderDateTime > '$fromDate' && " .
                            "saleOrder.orderDateTime < '$toDate')";

            return $this->connection->query($query);
        }

        public function postSaleOrderLine($saleOrderId, $productId, $quantity) {
            $query = "INSERT INTO saleOrderLine " .
                        "(saleOrderId, productId, quantity) " .
                        "VALUES ($saleOrderId, $productId, $quantity)";

            $this->connection->query($query);

            // Get the newly created saleOrderLine by selecting the one with the highest id.
            $query = "SELECT * FROM saleOrderLine " .
                        "ORDER BY saleOrderLine.id DESC " .
                        "LIMIT 1";

            return $this->connection->query($query);
        }

        public function putSaleOrderLine($id, $quantity) {
            $query = "UPDATE saleOrderLine SET " .
                        "saleOrderLine.quantity = '$quantity' " .
                        "WHERE saleOrderLine.id = $id";

            $this->connection->query($query);

            return $this->getSaleOrderLineById($id);
        }

        public function deleteSaleOrderLine($id) {
            $query = "DELETE FROM saleOrderLine " .
                        "WHERE saleOrderLine.id = $id";

            $this->connection->query($query);
        }
    }
?>
