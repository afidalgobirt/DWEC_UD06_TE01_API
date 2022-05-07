<?php
    include("../model/DAO.php");

    class ClientService {
        public static function getAllClients() {
            $ret = [];
            $dao = new DAO();
            $queryBuffer = $dao->getAllClients();

            while ($client = $queryBuffer->fetch_assoc()) {
                array_push($ret, $client);
            }
            
            return json_encode($ret);
        }

        public static function getClientById($id) {
            $dao = new DAO();
            $queryBuffer = $dao->getClientById($id);
            $client = $queryBuffer->fetch_assoc();
            
            return json_encode($client);
        }

        public static function getClientsFromDateToDate($fromDate, $toDate) {
            $ret = [];
            $dao = new DAO();
            $queryBuffer = $dao->getClientsFromDateToDate($fromDate, $toDate);

            while ($client = $queryBuffer->fetch_assoc()) {
                array_push($ret, $client);
            }

            return json_encode($ret);
        }

        public static function postClient($name, $lastName, $address, $email, $phone) {
            $dao = new DAO();
            $queryBuffer = $dao->postClient($name, $lastName, $address, $email, $phone);
            $client = $queryBuffer->fetch_assoc();

            return json_encode($client);
        }

        public static function putClient($id, $name, $lastName, $address, $email, $phone) {
            $dao = new DAO();

            $queryBuffer = $dao->getClientById($id);
            $client = $queryBuffer->fetch_assoc();

            $name = ($name == null) ? $client['name'] : $name;
            $lastName = ($lastName == null) ? $client['lastName'] : $lastName;
            $address = ($address == null) ? $client['address'] : $address;
            $email = ($email == null) ? $client['email'] : $email;
            $phone = ($phone == null) ? $client['phone'] : $phone;

            $queryBuffer = $dao->putClient($id, $name, $lastName, $address, $email, $phone);
            $client = $queryBuffer->fetch_assoc();

            return json_encode($client);
        }

        public static function deleteClient($id) {
            $dao = new DAO();
            $dao->deleteClient($id);
        }
    }
?>
