<?php
    include("../model/DAO.php");

    class SaleOrderService {
        public static function getAllSaleOrders() {
            $ret = [];
            $dao = new DAO();
            $queryBuffer = $dao->getAllSaleOrders();

            while ($saleOrder = $queryBuffer->fetch_assoc()) {
                array_push($ret, $saleOrder);
            }
            
            return json_encode($ret);
        }

        public static function getSaleOrderById($id) {
            $dao = new DAO();
            $queryBuffer = $dao->getSaleOrderById($id);
            $saleOrder = $queryBuffer->fetch_assoc();
            
            return json_encode($saleOrder);
        }

        public static function getSaleOrdersFromDateToDate($fromDate, $toDate) {
            $ret = [];
            $dao = new DAO();
            $queryBuffer = $dao->getSaleOrdersFromDateToDate($fromDate, $toDate);

            while ($saleOrder = $queryBuffer->fetch_assoc()) {
                array_push($ret, $saleOrder);
            }

            return json_encode($ret);
        }

        public static function postSaleOrder($clientId, $expectedDeliveryDate, $deliveryDate) {
            $dao = new DAO();
            $queryBuffer = $dao->postSaleOrder($clientId, $expectedDeliveryDate, $deliveryDate);
            $saleOrder = $queryBuffer->fetch_assoc();

            return json_encode($saleOrder);
        }

        public static function putSaleOrder($id, $expectedDeliveryDate, $deliveryDate) {
            $dao = new DAO();

            $queryBuffer = $dao->getSaleOrderById($id);
            $saleOrder = $queryBuffer->fetch_assoc();

            $expectedDeliveryDate = ($expectedDeliveryDate == null) ? $saleOrder['expectedDeliveryDate'] : $expectedDeliveryDate;
            $deliveryDate = ($deliveryDate == null) ? $saleOrder['deliveryDate'] : $deliveryDate;

            $queryBuffer = $dao->putSaleOrder($id, $expectedDeliveryDate, $deliveryDate);
            $saleOrder = $queryBuffer->fetch_assoc();

            return json_encode($saleOrder);
        }

        public static function deleteSaleOrder($id) {
            $dao = new DAO();
            $dao->deleteSaleOrder($id);
        }
    }
?>
