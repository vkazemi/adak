<?php
class Ship {

    private $db;
    
    public function __construct()
    {
       $this->db = new Database(); 
    }

    // Get all ships
    public function getShips(){

        $this->db->query("SELECT * FROM ship");
        $results = $this->db->resultSet();
        return $results;
    }

    // Get ship by id
    public function getShipById($id){
        $this->db->query("SELECT * FROM ship WHERE id = :id");
      
        $this->db->bind(':id', $id);
        $row = $this->db->single();
      
        return $row;
    }

    // Find ship by code
    public function findShipByCode($code){
        $this->db->query("SELECT * FROM ship WHERE code = :code");
          
        $this->db->bind(':code', $code);
        $row = $this->db->single();
          
        return $row;
    }

    // Add ship
    public function add($data){

        $this->db->query('INSERT INTO ship (name, code, state)
        VALUES(:name, :code, :state)');
    
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':code', $data['code']);
        $this->db->bind(':state', $data['state']);
        
        // Execute 
        if($this->db->execute()){
            return true;
        } 
        else {
            return false;
        }
    }

        // Edit ship
        public function updateShip($data){
                
            $this->db->query('UPDATE ship SET name = :name, code = :code, state = :state WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':code', $data['code']);
            $this->db->bind(':state', $data['state']);
      
            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        } 


    public function deleteShip($id){
        $this->db->query('DELETE FROM ship WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);
  
        // Execute
        if($this->db->execute()){
          return true;
        } 
        else {
          return false;
        }
    }
}