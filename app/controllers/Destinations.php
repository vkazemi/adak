<?php
class Destinations extends Controller{

    public function __construct()
    {
        $this->destinationModel = $this->model('Destination');
    }

    public function index(){
        // Get all destinations
        $destinations = $this->destinationModel->getDestinations();
        $data =[
            'destinations'=> $destinations
        ];

        $this->view('destinations/index', $data);
    }

    public function add(){
         //Check POST form submited
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Process form

          // Check user access
          if(!$_SESSION['destination_access']){
            redirect('nafispanel');
           }

            $data = [
                'title' =>'Add destination',
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

            //Make sure errors are empty
            if(empty($data['name_err']) && empty($data['state_err'])){
                //Validated

                // Add destination
                if($this->destinationModel->add($data)){
                    flash('destination_message', 'Destination added.');
                    redirect('destinations/index');
                }
                else{
                    die('Something went wrong');
                }
            }
            else{
                //Load view with error
                $this->view('destinations/add', $data);
            }
        }
        else{
            //Init data
           $data = [
            'title' =>'Add destination',
            'name' =>'',
            'state' =>'',
           ];

           //Load view
           $this->view('destinations/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

          $data = [
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
            if(empty($data['name_err']) && empty($data['state_err'])){

                // Validated

                if($this->destinationModel->updateDestination($data)){
                    flash('destination_message', 'Destination updated');
                    redirect('destinations');
                } 
                else {
                die('Something went wrong');
                }
            } 
            else {
                // Load view with errors
                $this->view('destinations/edit', $data);
            }
  
        } 
        else {
            // Get existing destination from model
            $destination = $this->destinationModel->getDestinationById($id);

             // Check user access
             if(!$_SESSION['destination_access']){
                 redirect('nafispanel');
             }
  
            //Init data
            $data = [
                'title' => 'Edit destination',
                'id' => $id,
                'name' => $destination->name,
                'state' => $destination->state, 
               ];
    
            $this->view('destinations/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Get existing destination from model
          $user = $this->destinationModel->getDestinationById($id);
          
            // Check user access
            if(!$_SESSION['destination_access']){
                redirect('nafispanel');
            }
  
          if($this->destinationModel->deleteDestination($id)){
            flash('destination_message', 'Destination removed');
            redirect('destinations');
          } 
          else {
            die('Something went wrong');
          }
        } 
        else {
          redirect('destinations');
        }
    }
}