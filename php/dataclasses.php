<!-- tentative lang. might change dahil sa ibang properties (eg. $userID) basing sa DB IF may changes  -->

<?php

    class Users {
        private $userID;
        private $username;
        private $password;
        private $roleID;
        
        public function __construct($userID, $username, $password, $roleID) {
            $this->userID = $userID;
            $this->firstName = $username;
            $this->password = $password;
            $this->userRole = $roleID;
    
        }

        public function get_userID() {
            return $this->userID;
        }
    
        public function get_username() {
            return $this->username;
        }
    
        public function get_password() {
            return $this->password;
        }
    
        public function get_userRole() {
            return $this->roleID;
        }

    class Roles {
        private $roleID;
        private $roleName;
            
        public function __construct($roleID, $roleName) {
             $this->roleID = $roleID;
            $this->roleName = $roleName;
        
        }
    
        public function get_roleID() {
            return $this->roleID;
        }
        
        public function get_roleName() {
            return $this->roleName;
         }

        }

        class Document {
            private $documentID;
            private $documentName;
            private $documentFile;
            private $documentStatus;
        
            public function __construct($documentID, $documentName, $documentFile, $documentStatus) {
                $this->documentID = $documentID;
                $this->documentName = $documentName;
                $this->documentFile = $documentFile;
                $this->documentStatus = $documentStatus;
            }
        
            public function get_documentID() {
                return $this->documentID;
            }
        
            public function get_documentName() {
                return $this->documentName;
            }
        
            public function get_documentFile() {
                return $this->documentFile;
            }
        
            public function get_documentStatus() {
                return $this->$documentStatus;
            }

        }     

// from the basis pero need palitan HAHAHAH so tentative muna ito:

        // class Offices {
        //     private $officeID;
        //     private $officeName;
        //     private $officeEmail;
        
        //     public function __construct($officeID, $officeName, $officeEmail) {
        //         $this->officeID = $officeID;
        //         $this->officeName = $officeName;
        //         $this->officeEmail = $officeEmail;
        //     }
        
        //     public function get_officeID() {
        //         return $this->officeID;
        //     }
        
        //     public function get_officeName() {
        //         return $this->officeName;
        //     }
        
        //     public function get_officeEmail() {
        //         return $this->officeEmail;
        //     }
        // }    
?>