<?php
class Cargo {

    private $db;
    
    public function __construct()
    {
       $this->db = new Database(); 
    }

    // Get all cargoes
    public function getCargoes(){

        $this->db->query("SELECT * FROM cargo");
        $results = $this->db->resultSet();
        return $results;
    }

    // Get  cargoes by name
    public function getcargoesByName($name){

        $this->db->query("SELECT * FROM cargo WHERE name = :name");
        $this->db->bind(':name', $name);
        $results = $this->db->resultSet();
        return $results;
    }

    // Get cargo by id
    public function getCargoById($id){
        $this->db->query("SELECT * FROM cargo WHERE id = :id");
      
        $this->db->bind(':id', $id);
        $row = $this->db->single();
      
        return $row;
    }

    // Add Cargo
    public function add($data){

        $this->db->query('INSERT INTO cargo (name, unit, price)
        VALUES(:name, :unit, :price)');
    
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':unit', $data['unit']);        
        $this->db->bind(':price', $data['price']);        
        // Execute 
        if($this->db->execute()){
            return true;
        } 
        else {
            return false;
        }
    }

        // Edit cargo
        public function updateCargo($data){
                
            $this->db->query('UPDATE cargo SET name = :name, unit = :unit, price = :price WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':unit', $data['unit']);
            $this->db->bind(':price', $data['price']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        } 

    // Remove cargo
    public function deleteCargo($id){
        $this->db->query('DELETE FROM cargo WHERE id = :id');
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