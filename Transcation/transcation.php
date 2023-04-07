<?php
    class Transcation{
        // Connection
        private $conn;
        // Table
        private $db_table = "transcations";
        // Columns
        public $id;
        public $transcation_id;
        public $user_id;
        public $status;
      
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getUserTranscation(){
            $sqlQuery = "SELECT id, transcation_id, user_id , status FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createUserTranscation(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    transcation_id = :transcation_id, 
                    user_id = :user_id,
                    status= :status";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->transcation_id=htmlspecialchars(strip_tags($this->transcation_id));
            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        
            // bind data
            $stmt->bindParam(":transcation_id", $this->transcation_id);
            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":status", $this->status);
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSingleUserTranscation(){
            $sqlQuery = "SELECT id, transcation_id, user_id FROM ". $this->db_table ." WHERE id = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->transcation_id = $dataRow['transcation_id'];
            $this->user_id = $dataRow['user_id'];

        }        
        // UPDATE
        public function updateUserTranscation(){
            $sqlQuery = "UPDATE ".$this->db_table ." SET transcation_id = :transcation_id, user_id = :user_id WHERE id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->transcation_id=htmlspecialchars(strip_tags($this->transcation_id));
            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":transcation_id", $this->transcation_id);
            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteUserTranscation(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>