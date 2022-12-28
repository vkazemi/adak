<?php

class User{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Get all users
    public function getUsers(){
        $this->db->query("SELECT * FROM user");
  
        $results = $this->db->resultSet();
  
        return $results;
    }

    // Get user by id
    public function getUserById($id){
        $this->db->query("SELECT * FROM user WHERE id = :id");
  
        $this->db->bind(':id', $id);
        $row = $this->db->single();
  
        return $row;
    }

    //Register user
    public function register($data){

        $this->db->query('INSERT INTO user (name, password, username, user_access, sender_access,
         destination_access, invoice_access, ship_access, driver_access, owner_access, cargo_access)
         VALUES(:name, :password, :username, :user_access, :sender_access,
         :destination_access, :invoice_access, :ship_access, :driver_access, :owner_access, :cargo_access)');

        //Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':user_access', $data['user_access']);
        $this->db->bind(':sender_access', $data['sender_access']);
        $this->db->bind(':destination_access', $data['destination_access']);
        $this->db->bind(':invoice_access', $data['invoice_access']);
        $this->db->bind(':ship_access', $data['ship_access']);
        $this->db->bind(':driver_access', $data['driver_access']);
        $this->db->bind(':owner_access', $data['owner_access']);
        $this->db->bind(':cargo_access', $data['cargo_access']);
        //Execute 
        if($this->db->execute()){
            return true;
          } 
        else {
            return false;
          }

    }

    // Login user
    public function login($username, $password){
        $this->db->query('SELECT * FROM user WHERE username = :username');

         //Bind values
         $this->db->bind(':username', $username);
           
         $row = $this->db->single();

         $hashed_password = $row->password;

         if(password_verify($password, $hashed_password)){
            return $row;
         }
         else{
            return false;
         }
    }
    
    //find user by username
    public function findUserByUsername($username){
        $this->db->query('SELECT * FROM user WHERE username = :username');

        //Bind values
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        //Check row 
        if($this->db->rowCount() > 0)
        {
            return true;
        }
        else{
            return false;
        }
    }

    // Edit user
     public function updateUser($data){

        // Check if new password entered
        if(!empty($data['current_password'])){
            
            $this->db->query('UPDATE user SET name = :name, password = :password, username = :username,
             user_access = :user_access, sender_access = :sender_access, destination_access = :destination_access
             , invoice_access = :invoice_access, ship_access = :ship_access, driver_access = :driver_access,
              owner_access = :owner_access, cargo_access = :cargo_access WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':user_access', $data['user_access']);
            $this->db->bind(':sender_access', $data['sender_access']);
            $this->db->bind(':destination_access', $data['destination_access']);
            $this->db->bind(':invoice_access', $data['invoice_access']);
            $this->db->bind(':ship_access', $data['ship_access']);
            $this->db->bind(':driver_access', $data['driver_access']);
            $this->db->bind(':owner_access', $data['owner_access']);
            $this->db->bind(':cargo_access', $data['cargo_access']);
        }
        // If password not changed so new password not entered
        else{
            $this->db->query('UPDATE user SET name = :name, username = :username,
            user_access = :user_access, sender_access = :sender_access, destination_access = :destination_access
            , invoice_access = :invoice_access, ship_access = :ship_access, driver_access = :driver_access,
             owner_access = :owner_access, cargo_access = :cargo_access WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':user_access', $data['user_access']);
            $this->db->bind(':sender_access', $data['sender_access']);
            $this->db->bind(':destination_access', $data['destination_access']);
            $this->db->bind(':invoice_access', $data['invoice_access']);
            $this->db->bind(':ship_access', $data['ship_access']);
            $this->db->bind(':driver_access', $data['driver_access']);
            $this->db->bind(':owner_access', $data['owner_access']);
            $this->db->bind(':cargo_access', $data['cargo_access']);
        }
  
        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }    

    public function deleteUser($id){
        $this->db->query('DELETE FROM user WHERE id = :id');
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