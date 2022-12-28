<?php
class Senders extends Controller{

    public function __construct()
    {
        $this->senderModel = $this->model('Sender');
    }

    public function index(){
        // Get all sender
        $senders = $this->senderModel->getSenders();
        $data =[
            'senders'=> $senders
        ];

        $this->view('senders/index', $data);
    }

    public function add(){
         //Check POST form submited
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Process form

          // Check user access
          if(!$_SESSION['sender_access']){
            redirect('nafispanel');
           }

            $data = [
                'title' =>'Add sender',
                'name' => trim($_POST['name']),
                'state' => trim($_POST['state']),
                'name_err' =>'',
                'state_err' =>'',
               ];

            // Validate name
            if(empty($data['name'])){
                 $data['name_err'] = 'Please enter name';
            }

            // Validate state
            if(isset($data['state'])){
                $data['state_err'] = 'Please select state';
            }


            // Make sure errors are empty
            if(empty($data['name_err']) && (!isset($data['state_err']))){
                //Validated

                // Add sender
                if($this->senderModel->add($data)){
                    flash('sender_message', 'Sender added.');
                    redirect('senders/index');
                }
                else{
                    die('Something went wrong');
                }
            }
            else{
                //Load view with error
                $this->view('senders/add', $data);
            }
        }
        else{
            //Init data
           $data = [
            'title' =>'Add sender',
            'name' =>'',
            'state' =>'',
           ];

           //Load view
           $this->view('senders/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

          $data = [
            'title' => 'Edit sender',
            'id' => $id,
            'name' => trim($_POST['name']),
            'state' => trim($_POST['state']),
            'name_err' =>'',
            'state_err' =>'',
           ];

            // Validate name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter name';
            }

            // Validate state
            if(is_null($data['state'])){
                $data['state_err'] = 'Please select state';
            }

            // Make sure errors are empty
            if(empty($data['name_err']) && (empty($data['state_err']))){

                // Validated

                if($this->senderModel->updateSender($data)){
                    flash('sender_message', 'Sender updated');
                    redirect('senders');
                } 
                else {
                die('Something went wrong');
                }
            } 
            else {
                // Load view with errors
                $this->view('senders/edit', $data);
            }
  
        } 
        else {
            // Get existing sender from model
            $sender = $this->senderModel->getSenderById($id);

             // Check user access
             if(!$_SESSION['sender_access']){
                 redirect('nafispanel');
             }
  
            //Init data
            $data = [
                'title' => 'Edit sender',
                'id' => $id,
                'name' => $sender->name,
                'state' => $sender->state, 
               ];
    
            $this->view('senders/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Get existing sender from model
          $user = $this->senderModel->getSenderById($id);
          
            // Check user access
            if(!$_SESSION['sender_access']){
                redirect('nafispanel');
            }
  
          if($this->senderModel->deleteSender($id)){
            flash('sender_message', 'Sender removed');
            redirect('senders');
          } 
          else {
            die('Something went wrong');
          }
        } 
        else {
          redirect('senders');
        }
    }
}