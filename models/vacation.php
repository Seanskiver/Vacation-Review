<?php 
    require_once('gateway.php');
    
    class Vacation {
        public function __construct() {
            $this->gateway = Gateway::getInstance();
        }
        
        // CREATE
        public function addVacation($name, $imagePath, $description) {
            //--------------------Check if vacation already exists
            // Query
            $sql = 'SELECT * FROM vacation where name = :name';
            $params = array(':name'=>$name);
            
            $vacation = $this->gateway->bindParams($sql, $params);
            
            echo $name."<br>";
            print_r($vacation);
            
            if (!empty($vacation)) {
                return $vacation;
            }
            
            $sql = 'CALL create_vacation(:name, :img, :description)';
            $params = array(':name'=>$name, ':img'=>$imagePath, ':description'=>$description);

            // Bind Params
            $this->gateway->bindParams($sql, $params);
        }
    
        // READ 
        public function getVacations() {
            $sql = 'CALL get_vacations()';
            $stmt = $this->gateway->dbh->prepare($sql);
            try {
                $stmt->execute();
                
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetchAll();
                return $result;                
            } catch(PDOException $e) {
                echo "Database error. check back later";
            }

        }
        
        // READ ONE
        public function getOneVacation($id) {
            $sql = 'CALL get_one_vacation(:id)';
            $params = array(':id'=>$id);
            
            $vacation = $this->gateway->bindParams($sql, $params);
            
            return $vacation;
        }
        
        // UPDATE
        public function editVacation($id, $name, $imagePath, $description) {
            $sql = 'CALL edit_vacation(:id, :name, :img, :description)';
            $params = array(':id'=>$id, ':name'=>$name, ':img'=>$imagePath, ':description'=>$description);
            
            $this->gateway->bindParams($sql, $params);
        }         
        
        // DELETE
        public function deleteVacation($id) {
            $sql = 'CALL delete_vacation(:id)';
            $params = array(':id' => $id);
            
            $this->gateway->bindParams($sql, $params);
        }
        

    }
    
    
    
    
    // TESTING 
    
    $vac = new Vacation();
    // try {
    //     $vac->addVacation('Name', 'path/to/image.jpg', 'Description');
    // } catch (Exception $e) {
    //     echo $e->getMessage();
    // }
    
    // Delete vacation
    // try { $vac->deleteVacation(2); }
    // catch (Exception $e) { echo $e->getMessage; }
    
    // GET
    
?>
