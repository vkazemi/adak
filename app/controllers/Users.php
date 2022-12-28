<?php

class Users extends Controller {

    public function __construct()
    {
       $this->userModel = $this->model('User'); 
    }

    public function index(){
        // Get all users
        $users = $this->userModel->getUsers();

        $data =[
            'users' => $users
        ];

        $this->view('users/index', $data);
    }

    public function login(){
        //Check POST form submited
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Process form
            $data = [
                'title' =>'Login',
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'username_err' =>'',
                'password_err' =>'',
               ];
               $result = $this->userModel->findUserByUsername($data['username']);
      

                //Validate Username
            if(empty($data['username'])){
                $data['username'] = 'Please enter username';
            }
    
            //Validate Password
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            }

            // Check for user/username
            if($this->userModel->findUserByUsername($data['username'])){
                // User found

            }
            else{
                // User not found
                $data['username_err'] = "No user found";
            }

            //Make sure errors are empty
            if(empty($data['username_err']) && empty($data['password_err'])){
                //Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                if($loggedInUser){
                    // Create session
                    $this->createUserSession($loggedInUser);
                }
                else{
                    $data['password_err'] = 'Password incorrect';
                    $this->view('users/login', $data);
                }
            }
            else{
                //Load view with error
                $this->view('users/login', $data);
            }
            
        }
        else{
            //Init data
           $data = [
            'title' =>'Login',
            'username' =>'',
            'password' =>'',
            'username_err' =>'',
            'password_err' =>'',
           ];

           //Load view
           $this->view('users/login', $data);
        }
    }

    public function register(){
        //Check POST form submited
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Process form

          // Check user access
          if(!$_SESSION['user_access']){
            redirect('nafispanel');
           }

            $data = [
                'title' =>'Create An Account',
                'name' => trim($_POST['name']),
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' =>'',
                'username_err' =>'',
                'password_err' =>'',
                'confirm_password_err' =>''
               ];

            //Validate Username
            if(empty($data['username'])){
                $data['username_err'] = 'Please enter username';
            }
            elseif($this->userModel->findUserByUsername($data['username'])){
                $data['username_err'] = 'Username exists';
            }

            //Validate Name
            if(empty($data['name'])){
                 $data['name_err'] = 'Please enter your name';
            }

            //Validate Password
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            }
            elseif(strlen($data['password']) < 6){
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            //Validate confirm password
            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Please enter confirm password';
            }
            elseif($data['password'] != $data['confirm_password']){
                $data['confirm_password_err'] = 'Password do not match';
            }

            //Make sure errors are empty
            if(empty($data['name_err']) && empty($data['username_err']) && empty($data['password_err']) && 
            empty($data['confirm_password_err'])){
                //Validated

                //Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register User
                if($this->userModel->register($data)){
                    flash('user_message', 'You are registered and can log in');
                    redirect('users/index');
                }
                else{
                    die('Something went wrong');
                }
            }
            else{
                //Load view with error
                $this->view('users/register', $data);
            }
        }
        else{
            //Init data
           $data = [
            'title' =>'Create An Account',
            'name' =>'',
            'username' =>'',
            'password' =>'',
            'confirm_password' =>'',
            'user_access' =>'',
            'sender_access' =>'',
            'destination_access' =>'',
            'invoice_access' =>'',
            'ship_access' =>'',
            'driver_access' =>'',
            'owner_access' =>'',
            'cargo_access' =>'',
            'name_err' =>'',
            'username_err' =>'',
            'password_err' =>'',
            'confirm_password_err' =>''
           ];

           //Load view
           $this->view('users/register', $data);
        }
    }


    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

          $data = [
            'id' => $id,
            'name' => trim($_POST['name']),
            'username' => trim($_POST['username']),
            'current_password' => trim($_POST['current_password']),
            'password' => trim($_POST['password']),
            'confirm_password' => trim($_POST['confirm_password']),
            'user_access' => in_array('user_access',$_POST['access']) ? 1 : 0,
            'ship_access' => in_array('ship_access',$_POST['access']) ? 1 : 0,
            'sender_access' => in_array('sender_access',$_POST['access']) ? 1 : 0,
            'destination_access' => in_array('destination_access',$_POST['access']) ? 1 : 0,
            'invoice_access' => in_array('invoice_access',$_POST['access']) ? 1 : 0,
            'driver_access' => in_array('driver_access',$_POST['access']) ? 1 : 0,
            'owner_access' => in_array('owner_access',$_POST['access']) ? 1 : 0,
            'cargo_access' => in_array('cargo_access',$_POST['access']) ? 1 : 0,
            'name_err' =>'',
            'username_err' =>'',
            'current_password_err' =>'',
            'password_err' =>'',
            'confirm_password_err' =>''
           ];

            // Validate Username
            if(empty($data['username'])){
                $data['username_err'] = 'Please enter username';
            }

            // Validate Name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter your name';
            }

            // Validate current password
            if(!empty($data['current_password'])){

                 //Hash entered current password
                 $current_password = password_hash($data['current_password'], PASSWORD_DEFAULT);

                 // Get user
                 $user = $this->userModel->getUserById($id);

                 // Check current password entered is valid
                 if(password_verify($current_password, $user->password)){
                    $data['current_password_err'] = 'Current password is invalid';
                 }

                // Validate Password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password';
                }
                else if(strlen($data['password']) < 6){
                    $data['password_err'] = 'New password must be at least 6 characters';
                }

                //Validate confirm password
                if(empty($data['confirm_password'])){
                    $data['confirm_password_err'] = 'Please enter confirm new password';
                }
                elseif($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'New password do not match';
                }
            }

            // Make sure errors are empty
            if(empty($data['name_err']) && empty($data['username_err']) && empty($data['current_password_err']) && empty($data['password_err']) && 
            empty($data['confirm_password_err'])){
                // Validated
                
                //Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if($this->userModel->updateUser($data)){
                    flash('user_message', 'User Updated');
                    redirect('users');
                } 
                else {
                die('Something went wrong');
                }
            } 
            else {
                // Load view with errors
                $this->view('users/edit', $data);
            }
  
        } 
        else {
            // Get existing user from model
            $user = $this->userModel->getUserById($id);

             // Check user access
             if(!$_SESSION['user_access']){
                 redirect('nafispanel');
             }
  
            //Init data
            $data = [
                'id' => $id,
                'name' => $user->name,
                'username' => $user->username,
                'user_access' => $user->user_access, 
                'sender_access' => $user->sender_access,
                'destination_access' => $user->destination_access,
                'invoice_access' => $user->invoice_access,
                'ship_access' => $user->ship_access,
                'driver_access' => $user->driver_access,
                'owner_access' => $user->owner_access,
                'cargo_access' => $user->cargo_access,
                'current_password' =>'',
                'password' =>'',
                'confirm_password' =>'',
               ];
    
            $this->view('users/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Get existing user from model
          $user = $this->userModel->getUserById($id);
          
            // Check user access
            if(!$_SESSION['user_access']){
                redirect('users');
            }
  
          if($this->userModel->deleteUser($id)){
            flash('user_message', 'User Removed');
            redirect('nafispanel');
          } 
          else {
            die('Something went wrong');
          }
        } 
        else {
          redirect('users');
        }
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_username']);
        unset($_SESSION['user_name']);
        session_destroy();

        redirect('users/login');

    }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_username'] = $user->username;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_access'] = $user->user_access;
        $_SESSION['sender_access'] = $user->sender_access;
        $_SESSION['destination_access'] = $user->destination_access;
        $_SESSION['invoice_access'] = $user->invoice_access;
        $_SESSION['ship_access'] = $user->ship_access;
        $_SESSION['driver_access'] = $user->driver_access;
        $_SESSION['owner_access'] = $user->owner_access;
        $_SESSION['cargo_access'] = $user->cargo_access;
        redirect('');
    }

}