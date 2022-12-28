<?php
class Driver {

    private $db;
    
    public function __construct()
    {
       $this->db = new Database(); 
    }

    // Get all drivers
    public function getDrivers(){

        $this->db->query("SELECT * FROM driver");
        $results = $this->db->resultSet();
        return $results;
    }

    // Get  drivers by name
    public function getDriversByName($name){

        $this->db->query("SELECT * FROM driver WHERE name = :name");
        $this->db->bind(':name', $name);
        $results = $this->db->resultSet();
        return $results;
    }

    // Get driver by id
    public function getDriverById($id){
        $this->db->query("SELECT * FROM driver WHERE id = :id");
      
        $this->db->bind(':id', $id);
        $row = $this->db->single();
      
        return $row;
    }

    // Add driver
    public function add($data){

        $this->db->query('INSERT INTO driver (name, address, phone, cartag, card_number, state)
        VALUES(:name, :address, :phone, :cartag, :card_number, :state)');
    
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':cartag', $data['cartag']);
        $this->db->bind(':card_number', $data['card_number']);
        $this->db->bind(':state', $data['state']);
        
        // Execute 
        if($this->db->execute()){
            return true;
        } 
        else {
            return false;
        }
    }

        // Edit driver
        public function updateDriver($data){
                
            $this->db->query('UPDATE driver SET name = :name, address = :address, phone = :phone,
            cartag = :cartag, card_number = :card_number, state = :state WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':phone', $data['phone']);
            $this->db->bind(':cartag', $data['cartag']);
            $this->db->bind(':card_number', $data['card_number']);
            $this->db->bind(':state', $data['state']);
      
            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        } 


    public function deleteDriver($id){
        $this->db->query('DELETE FROM driver WHERE id = :id');
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