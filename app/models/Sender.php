<?php
class Sender {

    private $db;
    
    public function __construct()
    {
       $this->db = new Database(); 
    }

    // Get all senders
    public function getSenders(){

        $this->db->query("SELECT * FROM sender");
        $results = $this->db->resultSet();
        return $results;
    }

    // Get sender by id
    public function getSenderById($id){
        $this->db->query("SELECT * FROM sender WHERE id = :id");
      
        $this->db->bind(':id', $id);
        $row = $this->db->single();
      
        return $row;
    }

    // Add sender
    public function add($data){

        $this->db->query('INSERT INTO sender (name, state)
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

        // Edit sender
        public function updateSender($data){

            $this->db->query('UPDATE sender SET name = :name, state = :state WHERE id = :id');
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


    public function deleteSender($id){
        $this->db->query('DELETE FROM sender WHERE id = :id');
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