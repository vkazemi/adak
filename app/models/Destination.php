<?php
class Destination {

    private $db;
    
    public function __construct()
    {
       $this->db = new Database(); 
    }

    // Get all destinations
    public function getDestinations(){

        $this->db->query("SELECT * FROM destination");
        $results = $this->db->resultSet();
        return $results;
    }

    // Get destination by id
    public function getDestinationById($id){
        $this->db->query("SELECT * FROM destination WHERE id = :id");
      
        $this->db->bind(':id', $id);
        $row = $this->db->single();
      
        return $row;
    }

    // Add destination
    public function add($data){

        $this->db->query('INSERT INTO destination (name, state)
        VALUES(:name, :state)');
    
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':state', $data['state']);
        
        // Execute 
        if($this->db->execute()){
            return true;
        } 
        else {
            return false;
        }
    }

        // Edit destination
        public function updateDestination($data){
                
            $this->db->query('UPDATE destination SET name = :name, state = :state WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':state', $data['state']);
      
            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        } 


    public function deleteDestination($id){
        $this->db->query('DELETE FROM destination WHERE id = :id');
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