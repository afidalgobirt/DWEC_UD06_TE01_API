<?php
    include("../model/DAO.php");

    class SaleOrderLineService {
        public static function getAllSaleOrderLines() {
            $ret = [];
            $dao = new DAO();
            $queryBuffer = $dao->getAllSaleOrderLines();

            while ($saleOrderLine = $queryBuffer->fetch_assoc()) {
                array_push($ret, $saleOrderLine);
            }
            
            return json_encode($ret);
        }

        public static function getSaleOrderLineById($id) {
            $dao = new DAO();
            $queryBuffer = $dao->getSaleOrderLineById($id);
            $saleOrderLine = $queryBuffer->fetch_assoc();
            
            return json_encode($saleOrderLine);
        }

        public static function getSaleOrderLinesByOrderId($orderId) {
            $dao = new DAO();
            $queryBuffer = $dao->getSaleOrderLinesByOrderId($orderId);
            $saleOrderLine = $queryBuffer->fetch_assoc();
            
            return json_encode($saleOrderLine);
        }

        public static function getSaleOrderLinesFromDateToDate($fromDate, $toDate) {
            $ret = [];
            $dao = new DAO();
            $queryBuffer = $dao->getSaleOrderLinesFromDateToDate($fromDate, $toDate);

            while ($saleOrderLine = $queryBuffer->fetch_assoc()) {
                array_push($ret, $saleOrderLine);
            }

            return json_encode($ret);
        }

        public static function postSaleOrderLine($saleOrderId, $productId, $quantity) {
            $dao = new DAO();
            $queryBuffer = $dao->postSaleOrderLine($saleOrderId, $productId, $quantity);
            $saleOrderLine = $queryBuffer->fetch_assoc();

            return json_encode($saleOrderLine);
        }

        public static function putSaleOrderLine($id, $quantity) {
            $dao = new DAO();

            $queryBuffer = $dao->putSaleOrderLine($id, $quantity);
            $saleOrderLine = $queryBuffer->fetch_assoc();

            return json_encode($saleOrderLine);
        }

        public static function deleteSaleOrderLine($id) {
            $dao = new DAO();
            $dao->deleteSaleOrderLine($id);
        }
    }
?>
