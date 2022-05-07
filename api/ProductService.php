<?php
    include("../model/DAO.php");

    class ProductService {
        public static function getAllProducts() {
            $ret = [];
            $dao = new DAO();
            $queryBuffer = $dao->getAllProducts();

            while ($product = $queryBuffer->fetch_assoc()) {
                array_push($ret, $product);
            }
            
            return json_encode($ret);
        }

        public static function getProductById($id) {
            $dao = new DAO();
            $queryBuffer = $dao->getProductById($id);
            $product = $queryBuffer->fetch_assoc();
            
            return json_encode($product);
        }

        public static function postProduct($name, $stock, $unitOfMeasure, $pricePerUnit) {
            $dao = new DAO();
            $queryBuffer = $dao->postProduct($name, $stock, $unitOfMeasure, $pricePerUnit);
            $product = $queryBuffer->fetch_assoc();

            return json_encode($product);
        }

        public static function putProduct($id, $name, $stock, $unitOfMeasure, $pricePerUnit) {
            $dao = new DAO();

            $queryBuffer = $dao->getProductById($id);
            $product = $queryBuffer->fetch_assoc();

            $name = ($name == null) ? $product['name'] : $name;
            $stock = ($stock == null) ? $product['stock'] : $stock;
            $unitOfMeasure = ($unitOfMeasure == null) ? $product['unitOfMeasure'] : $unitOfMeasure;
            $pricePerUnit = ($pricePerUnit == null) ? $product['pricePerUnit'] : $pricePerUnit;

            $queryBuffer = $dao->putProduct($id, $name, $stock, $unitOfMeasure, $pricePerUnit);
            $product = $queryBuffer->fetch_assoc();

            return json_encode($product);
        }

        public static function deleteProduct($id) {
            $dao = new DAO();
            $dao->deleteProduct($id);
        }
    }
?>
