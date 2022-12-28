<?php
class Ships extends Controller{

    public function __construct()
    {
        $this->shipModel = $this->model('Ship');
    }

    public function index(){
        // Get all ships
        $ships = $this->shipModel->getShips();
        $data =[
            'ships'=> $ships
        ];

        $this->view('ships/index', $data);
    }

    public function add(){
         //Check POST form submited
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Process form

          // Check user access
          if(!$_SESSION['ship_access']){
            redirect('nafispanel');
           }

            $data = [
                'title' =>'Add ship',
                'name' => trim($_POST['name']),
                'code' => trim($_POST['code']),
                'state' => trim($_POST['state']),
                'name_err' =>'',
                'code_err' =>'',
                'state_err' =>'',
               ];

            // Validate code
            if(empty($data['code'])){
                $data['code_err'] = 'Please enter code';
            }
            elseif($this->shipModel->findShipByCode($data['code'])){
                $data['code_err'] = 'Ship exists';
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
            if(empty($data['name_err']) && empty($data['code_err']) && empty($data['state_err'])){
                //Validated

                // Add ship
                if($this->shipModel->add($data)){
                    flash('ship_message', 'Ship added.');
                    redirect('ships/index');
                }
                else{
                    die('Something went wrong');
                }
            }
            else{
                //Load view with error
                $this->view('ships/add', $data);
            }
        }
        else{
            //Init data
           $data = [
            'title' =>'Add ship',
            'name' =>'',
            'code' =>'',
            'state' =>'',
           ];

           //Load view
           $this->view('ships/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

          $data = [
            'id' => $id,
            'name' => trim($_POST['name']),
            'code' => trim($_POST['code']),
            'state' => trim($_POST['state']),
            'name_err' =>'',
            'code_err' =>'',
            'state_err' =>'',
           ];

            // Validate name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter name';
            }

            // Validate code
            if(empty($data['code'])){
                $data['code_err'] = 'Please enter code';
            }

            // Validate state
            if(is_null($data['state'])){
                $data['state_err'] = 'Please select state';
            }


            // Make sure errors are empty
            if(empty($data['name_err']) && empty($data['code_err']) && empty($data['state_err'])){

                // Validated

                if($this->shipModel->updateShip($data)){
                    flash('ship_message', 'Ship updated');
                    redirect('ships');
                } 
                else {
                die('Something went wrong');
                }
            } 
            else {
                // Load view with errors
                $this->view('ships/edit', $data);
            }
  
        } 
        else {
            // Get existing ship from model
            $ship = $this->shipModel->getShipById($id);

             // Check user access
             if(!$_SESSION['ship_access']){
                 redirect('nafispanel');
             }
  
            //Init data
            $data = [
                'title' => 'Edit ship',
                'id' => $id,
                'name' => $ship->name,
                'code' => $ship->code,
                'state' => $ship->state, 
               ];
    
            $this->view('ships/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Get existing ship from model
          $user = $this->shipModel->getShipById($id);
          
            // Check user access
            if(!$_SESSION['ship_access']){
                redirect('nafispanel');
            }
  
          if($this->shipModel->deleteShip($id)){
            flash('ship_message', 'Ship removed');
            redirect('ships');
          } 
          else {
            die('Something went wrong');
          }
        } 
        else {
          redirect('ships');
        }
    }
}