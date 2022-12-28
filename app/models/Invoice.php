<?php
class Invoice {

    private $db;
    
    public function __construct()
    {
       $this->db = new Database(); 
    }

    // Get all invoices
    public function getInvoices(){

        $this->db->query("SELECT * FROM invoice");
        $results = $this->db->resultSet();
        return $results;
    }

    // Get invoice by id
    public function getInvoiceById($id){
        $this->db->query("SELECT * FROM invoice WHERE id = :id");
      
        $this->db->bind(':id', $id);
        $row = $this->db->single();
      
        return $row;
    }

    // Add invoice
    public function add($data){

        $this->db->query('INSERT INTO invoice (owner, driver, cargo, sender, destination, ship, amount)
         VALUES(:owner, :driver, :cargo, :sender, :destination, :ship, :amount)');
    
        // Bind values
        $this->db->bind(':owner', $data['owner']);
        $this->db->bind(':driver', $data['driver']);
        $this->db->bind(':cargo', $data['cargo']);
        $this->db->bind(':sender', $data['sender']);
        $this->db->bind(':destination', $data['destination']);
        $this->db->bind(':ship', $data['ship']);
        $this->db->bind(':amount', $data['amount']);

        // Execute 
        if($this->db->execute()){
            return true;
        } 
        else {
            return false;
        }
    }

        // Edit invoice
        public function updateInvoice($data){
           
            $this->db->query('UPDATE invoice SET owner = :owner, driver = :driver, cargo = :cargo,
            sender = :sender, destination = :destination, ship = :ship, amount = :amount
             WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':owner', $data['owner']);
            $this->db->bind(':driver', $data['driver']);
            $this->db->bind(':cargo', $data['cargo']);
            $this->db->bind(':sender', $data['sender']);
            $this->db->bind(':destination', $data['destination']);
            $this->db->bind(':ship', $data['ship']);
            $this->db->bind(':amount', $data['amount']);
      
            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        } 


    public function deleteInvoice($id){
        $this->db->query('DELETE FROM invoice WHERE id = :id');
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
    // get invoices with entered search params
    public function searchResult($sqlQueryConditions = array()){
        $sqlQuery = 'SELECT ';
        $sqlQuery .= '*';
         
        $sqlQuery .= ' FROM invoice';
        if(array_key_exists("where",$sqlQueryConditions)){
            $sqlQuery .= ' WHERE (';
            $i = 0;

           $old_key = '';
   
            foreach($sqlQueryConditions['where'] as $key=>$value){
                  foreach($value as $val){
                    
                    if($old_key == $key){
                        $pre = ($i > 0)?' OR ':'';
                    }
                        
                    else{
                        $pre = ($i > 0)?' AND (':'';
                    }
                    $sqlQuery .= $pre.$key." = '".$val."'";
                    $i++;
                    $old_key = $key;
                  } 
                  $sqlQuery .= ")";                 
            }
        }             

		$this->db->query($sqlQuery); 
        $results = $this->db->resultSet();
        return $results;
    }
}