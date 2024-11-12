<?php
    class Account {
        protected $db;
        public $ID;
        public $email;
        public $info;
        public $isAdmin;
        public $defaultAddress;

        public function __construct ($account, $db) {
            $this->db = $db;

            $this->ID = $account->ID;
            $this->email = $account->Email;
            $this->info = $account;
            $this->isAdmin = $account->IsAdmin;

            if (strlen($account->FirstName) > 0 or strlen($account->LastName) > 0) {
                $this->info->Name = $account->FirstName." ".$account->LastName;
            } else {
                $this->info->Name = $account->Email;
            }

            $this->defaultAddress = $this->getAccountDefaultAddress();
        }

        public function getAccountDefaultAddress () {
            if ($this->info->DefaultAddressID != 0) {
                $sql = "SELECT * FROM `addresses` WHERE `ID` = :aId";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(":aId", $this->info->DefaultAddressID);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_OBJ);
            }

            return false;
        }
    }
?>