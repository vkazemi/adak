<?php
class Owner {

    private $db;
    
    public function __construct()
    {
       $this->db = new Database(); 
    }

    // Get all owners
    public function getOwners(){

        $this->db->query("SELECT * FROM owner");
        $results = $this->db->resultSet();
        return $results;
    }

    // Get owner by id
    public function getOwnerById($id){
        $this->db->query("SELECT * FROM owner WHERE id = :id");
      
        $this->db->bind(':id', $id);
        $row = $this->db->single();
      
        return $row;
    }

    public function getOwnersByName($name){
        // Get  owners by name
        $this->db->query("SELECT * FROM owner WHERE name = :name");
        $this->db->bind(':name', $name);
        $results = $this->db->resultSet();
        return $results;
    }

    // Add owner
    public function add($data){

        $this->db->query('INSERT INTO owner (name, address, phone, post_code, state)
        VALUES(:name, :address, :phone, :post_code, :state)');
    
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':post_code', $data['post_code']);
        $this->db->bind(':state', $data['state']);
        
        // Execute 
        if($this->db->execute()){
            return true;
        } 
        else {
            return false;
        }
    }

        // Edit owner
        public function updateOwner($data){
                
            $this->db->query('UPDATE owner SET name = :name, address = :address, phone = :phone,
            post_code = :post_code, state = :state WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':phone', $data['phone']);
            $this->db->bind(':post_code', $data['post_code']);
            $this->db->bind(':state', $data['state']);
      
            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        } 


    public function deleteOwner($id){
        $this->db->query('DELETE FROM owner WHERE id = :id');
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