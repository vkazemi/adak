<?php
class Drivers extends Controller{

    public function __construct()
    {
        $this->driverModel = $this->model('Driver');
    }

    public function index(){
        // Get all drivers
        $drivers = $this->driverModel->getDrivers();
        $data =[
            'drivers'=> $drivers
        ];

        $this->view('drivers/index', $data);
    }

    public function add(){
         //Check POST form submited
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Process form

          // Check user access
          if(!$_SESSION['driver_access']){
            redirect('nafispanel');
           }

            $data = [
                'title' =>'Add driver',
                'name' => trim($_POST['name']),
                'address' => trim($_POST['address']),
                'phone' => trim($_POST['phone']),
                'cartag' => trim($_POST['cartag']),
                'card_number' => trim($_POST['card_number']),
                'state' => trim($_POST['state']),
                'name_err' =>'',
                'address_err' =>'',
                'phone_err' =>'',
                'cartag_err' =>'',
                'card_number_err' =>'',
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

            // Validate car tag
            if(empty($data['cartag'])){
                $data['cartag_err'] = 'Please enter car tag';
            }

            // Validate card number
            if(empty($data['card_number'])){
                $data['card_number_err'] = 'Please enter card number';
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
            && empty($data['cartag_err']) && empty($data['card_number_err']) && empty($data['state_err'])){
                //Validated

                // Add driver
                if($this->driverModel->add($data)){
                    flash('driver_message', 'Driver added.');
                    redirect('drivers/index');
                }
                else{
                    die('Something went wrong');
                }
            }
            else{
                //Load view with error
                $this->view('drivers/add', $data);
            }
        }
        else{
            //Init data
           $data = [
            'title' =>'Add driver',
            'name' =>'',
            'address' =>'',
            'phone' =>'',
            'cartag' =>'',
            'card_number' =>'',
            'state' =>'',
           ];

           //Load view
           $this->view('drivers/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

          $data = [
            'id' => $id,
            'name' => trim($_POST['name']),
            'address' => trim($_POST['address']),
            'phone' => trim($_POST['phone']),
            'cartag' => trim($_POST['cartag']),
            'card_number' => trim($_POST['card_number']),
            'state' => trim($_POST['state']),
            'name_err' =>'',
            'address_err' =>'',
            'phone_err' =>'',
            'cartag_err' =>'',
            'card_number_err' =>'',
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

            // Validate cartag
            if(empty($data['cartag'])){
                $data['cartag_err'] = 'Please enter cartag';
            }

            // Validate card_number
            if(empty($data['card_number'])){
                $data['card_number_err'] = 'Please enter card number';
            }

            // Validate state
            if(is_null($data['state'])){
                $data['state_err'] = 'Please select state';
            }


            // Make sure errors are empty
            if(empty($data['name_err']) && empty($data['address_err']) && empty($data['phone_err']) && 
            empty($data['cartag_err']) && empty($data['card_number_err'])
             && empty($data['state_err'])){

                // Validated

                if($this->driverModel->updateDriver($data)){
                    flash('driver_message', 'Driver updated');
                    redirect('drivers');
                } 
                else {
                die('Something went wrong');
                }
            } 
            else {
                // Load view with errors
                $this->view('drivers/edit', $data);
            }
  
        } 
        else {
            // Get existing driver from model
            $driver = $this->driverModel->getDriverById($id);

             // Check user access
             if(!$_SESSION['driver_access']){
                 redirect('nafispanel');
             }
  
            //Init data
            $data = [
                'title' => 'Edit driver',
                'id' => $id,
                'name' => $driver->name,
                'address' => $driver->address,
                'phone' => $driver->phone,
                'cartag' => $driver->cartag,
                'card_number' => $driver->card_number,
                'state' => $driver->state, 
               ];
    
            $this->view('drivers/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Get existing driver from model
          $user = $this->driverModel->getDriverById($id);
          
            // Check user access
            if(!$_SESSION['driver_access']){
                redirect('nafispanel');
            }
  
          if($this->driverModel->deleteDriver($id)){
            flash('driver_message', 'driver removed');
            redirect('drivers');
          } 
          else {
            die('Something went wrong');
          }
        } 
        else {
          redirect('drivers');
        }
    }
}