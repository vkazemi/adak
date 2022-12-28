<?php
class Owners extends Controller{

    public function __construct()
    {
        $this->ownerModel = $this->model('Owner');
    }

    public function index(){
        // Get all owners
        $owners = $this->ownerModel->getOwners();
        $data =[
            'owners'=> $owners
        ];

        $this->view('owners/index', $data);
    }

    public function add(){
         //Check POST form submited
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Process form

          // Check user access
          if(!$_SESSION['owner_access']){
            redirect('nafispanel');
           }

            $data = [
                'title' =>'Add Owner',
                'name' => trim($_POST['name']),
                'address' => trim($_POST['address']),
                'phone' => trim($_POST['phone']),
                'post_code' => trim($_POST['post_code']),
                'state' => trim($_POST['state']),
                'name_err' =>'',
                'address_err' =>'',
                'phone_err' =>'',
                'post_code_err' =>'',
                'state_err' =>'',
               ];

            // Validate address
            if(empty($data['address'])){
                $data['address_err'] = 'Please enter address';
            }

            // Validate phone
            if(empty($data['phone'])){
                $data['phone_err'] = 'Please enter phone';
            }

            // Validate post code
            if(empty($data['post_code'])){
                $data['post_code_err'] = 'Please enter post code';
            }


            // Validate name
            if(empty($data['name'])){
                 $data['name_err'] = 'Please enter name';
            }

            // Validate state
            if(is_null($data['state'])){
                $data['state_err'] = 'Please select state';
            }

            //Make sure errors are empty
            if(empty($data['name_err']) && empty($data['address_err']) && empty($data['phone_err']) 
            && empty($data['post_code_err']) && empty($data['state_err'])){
                //Validated

                // Add owner
                if($this->ownerModel->add($data)){
                    flash('owner_message', 'owner added.');
                    redirect('owners/index');
                }
                else{
                    die('Something went wrong');
                }
            }
            else{
                //Load view with error
                $this->view('owners/add', $data);
            }
        }
        else{
            //Init data
           $data = [
            'title' =>'Add owner',
            'name' =>'',
            'address' =>'',
            'phone' =>'',
            'post_code' =>'',
            'state' =>'',
           ];

           //Load view
           $this->view('owners/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

          $data = [
            'id' => $id,
            'name' => trim($_POST['name']),
            'address' => trim($_POST['address']),
            'phone' => trim($_POST['phone']),
            'post_code' => trim($_POST['post_code']),
            'state' => trim($_POST['state']),
            'name_err' =>'',
            'address_err' =>'',
            'phone_err' =>'',
            'post_code_err' =>'',
            'state_err' =>'',
           ];

            // Validate name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter name';
            }

            // Validate address
            if(empty($data['address'])){
                $data['address_err'] = 'Please enter address';
            }
            // Validate phone
            if(empty($data['phone'])){
                $data['phone_err'] = 'Please enter phone number';
            }

            // Validate post code
            if(empty($data['post_code'])){
                $data['post_code_err'] = 'Please enter post code';
            }

            // Validate state
            if(is_null($data['state'])){
                $data['state_err'] = 'Please select state';
            }


            // Make sure errors are empty
            if(empty($data['name_err']) && empty($data['address_err']) && empty($data['phone_err'])
            && empty($data['post_code_err']) && empty($data['state_err'])){

                // Validated

                if($this->ownerModel->updateOwner($data)){
                    flash('owner_message', 'owner updated');
                    redirect('owners');
                } 
                else {
                die('Something went wrong');
                }
            } 
            else {
                // Load view with errors
                $this->view('owners/edit', $data);
            }
  
        } 
        else {
            // Get existing owner from model
            $owner = $this->ownerModel->getownerById($id);

             // Check user access
             if(!$_SESSION['owner_access']){
                 redirect('nafispanel');
             }
  
            //Init data
            $data = [
                'title' => 'Edit owner',
                'id' => $id,
                'name' => $owner->name,
                'address' => $owner->address,
                'phone' => $owner->phone,
                'post_code' => $owner->post_code,
                'state' => $owner->state, 
               ];
    
            $this->view('owners/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Get existing owner from model
          $user = $this->ownerModel->getOwnerById($id);
          
            // Check user access
            if(!$_SESSION['owner_access']){
                redirect('nafispanel');
            }
  
          if($this->ownerModel->deleteOwner($id)){
            flash('owner_message', 'owner removed');
            redirect('owners');
          } 
          else {
            die('Something went wrong');
          }
        } 
        else {
          redirect('owners');
        }
    }
}