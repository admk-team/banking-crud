<?php
    class Account{
        // Connection
        private $conn;
        // Table
        private $db_table = "accounts";
        // Columns
        public $id;
        public $user_id;
        public $account_no;
       public $bank_name;
       public $branch_code;
       public $account_type;
       public $balance;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getUserAccount(){
            $sqlQuery = "SELECT id, user_id,account_no , bank_name , branch_code , account_type,balance FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createUserAccount(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        user_id= :user_id, 
                        account_no= :account_no, 
                        bank_name = :bank_name,
                        branch_code = :branch_code,
                        account_type = :account_type,
                        balance = :balance";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
            $this->account_no=htmlspecialchars(strip_tags($this->account_no));
            $this->bank_name=htmlspecialchars(strip_tags($this->bank_name));
            $this->branch_code=htmlspecialchars(strip_tags($this->branch_code));
            $this->account_type=htmlspecialchars(strip_tags($this->account_type));
            $this->balance=htmlspecialchars(strip_tags($this->balance));
   
        
            // bind data
            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":account_no", $this->account_no);
            $stmt->bindParam(":bank_name", $this->bank_name);
            $stmt->bindParam(":branch_code", $this->branch_code);
            $stmt->bindParam(":account_type", $this->account_type);
            $stmt->bindParam(":balance", $this->balance);
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSingleUserAccount(){
            $sqlQuery = "SELECT id, user_id,account_no , bank_name , branch_code , account_type,balance  FROM ". $this->db_table ." WHERE id = ?  LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->user_id = $dataRow['user_id'];
            $this->account_no = $dataRow['account_no'];
            $this->bank_name = $dataRow['bank_name'];
            $this->branch_code = $dataRow['branch_code'];
            $this->account_type = $dataRow['account_type'];
            $this->balance = $dataRow['balance'];
        }        
        // UPDATE
        public function updateUserAccount(){
            $sqlQuery = "UPDATE ".$this->db_table ." SET user_id = :user_id, account_no = :account_no ,bank_name = :bank_name , branch_code =:branch_code  , account_type=:account_type , balance=:balance WHERE id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
            $this->account_no=htmlspecialchars(strip_tags($this->account_no));
            $this->bank_name=htmlspecialchars(strip_tags($this->bank_name));
            $this->branch_code=htmlspecialchars(strip_tags($this->branch_code));
            $this->account_type=htmlspecialchars(strip_tags($this->account_type));
            $this->balance=htmlspecialchars(strip_tags($this->balance));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":account_no", $this->account_no);
            $stmt->bindParam(":bank_name", $this->bank_name);
            $stmt->bindParam(":branch_code", $this->branch_code);
            $stmt->bindParam(":account_type", $this->account_type);
            $stmt->bindParam(":balance", $this->balance);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteUserAccount(){
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